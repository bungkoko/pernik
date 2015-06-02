<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('order_model');
        $this->load->model('produk_model');
        $this->load->model('bank_model');
    }

    function index() {

        //$pilih=$this->session->userdata('idmember');
        if (($this->user_library->is_logged() == true)):
            //$pilih= $this->session->userdata('idmember');
            $data['calon_pembeli'] = $this->member_model->pilih_member($this->session->userdata('username'));


        endif;
        //print_r($this->session->userdata('username'));
        $data['bank']=$this->bank_model->daftar_bank();
         $data['laris']=$this->produk_model->produk_laris('2');
        $data['content'] = 'checkout/checkout';
        $this->load->view('index', $data);
    }

    function send_invoice() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namapen', 'Nama Penerima', 'required');
        $this->form_validation->set_rules('emailpen', 'Email Penerima', 'required');
        $this->form_validation->set_rules('alamatpen', 'Alamat Penerima', 'required');
        $this->form_validation->set_rules('telponpen', 'Telepon Penerima', 'required');
        $sid=$this->session->userdata('session_id');
        if ($this->form_validation->run() == true):

            $beli = date('Ymd');
            $cek_kode = $this->order_model->cek_kode($beli);
            $kode_order = "";
            foreach ($cek_kode->result() as $ck) {
                if ($ck->kd == NULL) {
                    $kode_order = $beli . '0001';
                } else {

                    $kode_order = $ck->kd + 1;
                }
                //$user_data = $this->db->get('tbmember');
                //store data to session
                //$this->session->set_userdata('idmember',$this->session->userdata('id'));

                $this->db->set('KdOrder', $kode_order);
                $this->db->set('TbMember_KdMember', $this->input->post('KdMember'));

                $this->order_model->simpan_order($sid);

                foreach ($this->cart->contents() as $items) {

                    $this->db->query("insert into tbOrder_detail(TbOrder_KdOrder,TbProduk_KdProduk,jumlah_detail,harga_detail) values('" . $kode_order . "','" . $items['id'] . "','" . $items['qty'] . "','" . $items['price'] . "')");
                    $this->order_model->update_beli($items['id'], $items['qty']);
                    $this->order_model->update_stok($items['id'], $items['qty']);
                }
                //print_r($this->session->userdata('idmember'));
            }
        else:
            $data['error'] = validation_errors();
        endif;
        $this->cart->destroy();
        redirect('checkout/bukti_invoice');
    }

    function bukti_invoice() {
        //$user_data = $this->db->get('tbmember');
        //store data to session
        $pilih = $this->member_model->pilih_member($this->session->userdata('username'))->row();
        //$this->session->set_userdata('idmember',$this->input->post('KdMember'));
        //$tgl="2013-06-21";
        $sid=$this->session->userdata('session_id');
        $data['bukti_invoice_identitas'] = $this->order_model->bukti_invoice_identitas($pilih->KdMember);
        foreach ($this->order_model->bukti_invoice_identitas($pilih->KdMember)->result() as $bk) {
            $ht = $this->order_model->hitung_invoice_barang($bk->KdOrder);
            $data['bukti_invoice_barang'] = $this->order_model->bukti_invoice_barang($pilih->KdMember, $sid);
            $data['total_invoice_barang'] = $this->order_model->total_invoice_barang($pilih->KdMember,$sid);
        }
        //print_r($pilih);
        $data['bank']=$this->bank_model->daftar_bank();
         $data['laris']=$this->produk_model->produk_laris('2');
        $data['content'] = 'checkout/checkout_bukti';
        $this->load->view('index', $data);
    }
        
    function printinvoice() {
        $this->load->library('cezpdf');
        $this->cezpdf->Cezpdf($paper = 'a4', $orientation = 'portrait');
        $this->cezpdf->selectFont('./fonts/Helvetica.afm');

        $pilih = $this->member_model->pilih_member($this->session->userdata('username'))->row();
        //$this->session->set_userdata('idmember',$this->input->post('KdMember'));
        $sid=$this->session->userdata('session_id');
        $bukti = $this->order_model->bukti_invoice_identitas($pilih->KdMember)->result();


        $this->cezpdf->ezText('BUKTI INVOICE TOKO ROTI BU BASUKI', 20, array('justification' => 'center'));
       
        $this->cezpdf->line(30, 780, 563, 780);
       
        foreach ($bukti as $bk) {
            $this->cezpdf->ezSetDy(-20);
            $this->cezpdf->ezText('Tanggal Order : ' . $bk->tanggal_order, 12,array('justification'=>'right'));
            $this->cezpdf->ezText('Pengirim : '.$bk->fullname,12,array('justification'=>'left'));
            $this->cezpdf->ezText('Tuan / Nona  ' . $bk->nama_penerima, 12,array('justification'=>'left'));
            $this->cezpdf->ezText($bk->alamat_penerima, 12,array('justification'=>'left'));
            $this->cezpdf->ezText($bk->telepon, 12,array('justification'=>'left'));
            $this->cezpdf->ezSetDy(-20);
            
        }
        $this->cezpdf->line(30,698,563,698); 
        
        $this->cezpdf->ezText('Barang Pesanan Anda');
        $this->cezpdf->ezSetDy(-20);
        

        // $bukti['nama_penerima'];
      
        foreach ($this->order_model->bukti_invoice_identitas($pilih->KdMember)->result() as $bk) {
            //$ht = $this->order_model->hitung_invoice_barang($bk->KdOrder);

            $total = $this->order_model->total_invoice_barang($pilih->KdMember, $sid)->result();
            $bukti_barang = $this->order_model->bukti_invoice_barang($pilih->KdMember, $sid)->result();
            foreach($bukti_barang as $barang){
                $bukti_db[]=array(
                    'jumlah'=>$barang->jumlah_detail,
                    'Produk'=>$barang->Produk,
                    'harga_detail'=>'Rp '.number_format($barang->harga_detail,0,",","."),
                    'sub_total'=>'Rp '.number_format($barang->harga_detail*$barang->jumlah_detail,0,",","."),
                     );
            }
            $col_names=array(
                'jumlah'=>'Jumlah Barang',
                'Produk'=>'Nama Barang',
                'harga_detail'=>'Harga Satuan',
                'sub_total'=>'Sub Total'
            );
            
            $this->cezpdf->ezTable($bukti_db,$col_names,'', array('width'=>520));
             $this->cezpdf->ezSetDy(-20);
            foreach($total as $tot):
                $this->cezpdf->ezText ('Total Belanja : Rp '.number_format($tot->jumlah_detail,0,",","."),12,array('justification' => 'right'))   ; 
            endforeach;
                    
            //$this->cezpdf->ezTable($data['bukti_invoice_barang']->result_array());
            
        }


        $this->cezpdf->line(20, 20, 580, 20);

        //$this->cezpdf->ezTable($data['bukti_invoice_identitas']->result_array());
        $this->cezpdf->ezStream();
    }

}

?>
