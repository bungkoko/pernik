<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class pesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('bank_model');
    }

    function index() {
        if (($this->user_library->is_logged() == true)):
            $data['content'] = 'pesanan/pesanan';
        else:
            $this->session->set_flashdata('message', 'Anda harus login terlebih dahulu');
            redirect('home');
        endif;
        $data['bank']=$this->bank_model->daftar_bank();
         $data['laris']=$this->produk_model->produk_laris('2');
        $this->load->view('index', $data);
    }

    function tambah_barang() {
        if (($this->user_library->is_logged() == true)):
       
            foreach ($this->produk_model->daftar_produk()->result() as $df):
                if ($df->stok > 0):
                    if ($this->user_library->is_logged() == true):
                        $data = array(
                            'id' => $this->input->post('kd_produk'),
                            'qty' => $this->input->post('jumlah_item'),
                            'price' => $this->input->post('harga'),
                            'name' => $this->input->post('produk'));
                        if ($df->stok > 0):
                            $this->cart->insert($data);
                        else:
                            $this->session->set_flashdata('message', 'Stok Sudah Habis');
                        endif;
                        redirect('pesanan/index');

                    endif;
                else:
                    $this->session->set_flashdata('message', 'Maaf produk yang anda pilih stoknya habis');
                endif;
            endforeach;
        else:
              $this->session->set_flashdata('message', 'Anda harus login terlebih dahulu');
            redirect('home');
        endif;
    }

    function update_pesanan() {
        $total = $this->cart->total_items();
        $item = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        for ($i = 0; $i <= $total; $i++) {
            $data = array(
                'rowid' => $item[$i],
                'qty' => $qty[$i]);
            $this->cart->update($data);
        }
        redirect('pesanan/index');
    }

    function hapus_pesanan($id) {
        $id = '';
        if ($this->uri->segment(3) === FALSE) {
            $id = '';
        } else {
            $id = $this->uri->segment(3);
        }
        $data = array(
            'rowid' => $id,
            'qty' => 0);
        $this->cart->update($data);
        redirect('home');
    }

}

?>
