<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model'); //eksekusi model produk
        $this->load->model('order_model'); //eksekusi model order
        $this->load->model('bank_model');
         $this->load->model('setting_model');
    }

    function index() {
        $this->login();
    }

    function login() {
        if ($this->user_library->admin_logged() == true) :
            redirect('admin/dashboard');
        endif;

        $data["error"] = "";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        //kondisi jika user dan password benar
        if ($this->form_validation->run() == true):
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            //check user from database
            $this->db->where('username', $username);
            $this->db->where('pass', $password);
            $user_data = $this->db->get('tbadmin');

            //store data to session
            if ($user_data->num_rows == 1):
                // $this->session->set_userdata('idmember',$user_data->row()->idmember);
                //$this->session->set_userdata()
                $this->session->set_userdata('username', $user_data->row()->username);
                $this->session->set_userdata('fullname', $user_data->row()->fullname);
                $this->session->set_userdata('logged', true);
                redirect('admin/dashboard');
            else :
                redirect('admin/login');
            endif;
        else :
            $data["error"] = validation_errors();
        endif;
        $this->load->view('admin/login', $data);
    }

    function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('logged');
        $this->cart->destroy();
        redirect('admin/login');
    }

    function dashboard() {
        $data['content'] = 'dashboard';
        $this->load->view('admin/index', $data);
    }

    function produk() {
        $config['base_url']=base_url().'admin/produk/';
        $config['total_rows']=$this->produk_model->daftar_produk()->num_rows();
        $config['per_page']='10';
        $config['uri_segment'] = 3;
        
        //$config['num_links']='6';
        $this->pagination->initialize($config);
        $data['paging']=$this->pagination->create_links();
        
        if ($this->input->post('submit')) :
            $this->load->library('form_validation');
            $this->form_validation->set_rules('produk', 'produk', 'required');
            $this->form_validation->set_rules('harga', 'harga', 'required');
            if ($this->form_validation->run() == true):
                $this->load->library('upload');
                $this->load->library('image_lib');
                $this->load->helper('file');
                // config untuk upload
                $config['upload_path'] = '.' . $this->config->item("upload_path_photo");
                $config['allowed_types'] = $this->config->item("allowed_types");
                $config['max_size'] = $this->config->item("max_size");
                $config['max_width'] = 0;
                $config['max_height'] = 0;
                $config['encrypt_name'] = true;
                // inisialisasi library upload
                $this->upload->initialize($config);

                // uploading
                if (!$this->upload->do_upload('produk_photo')):
                    //redirect('inf-backend/photo_trashed');
                    $this->session->set_flashdata('error', $this->upload->display_errors());

                    redirect('admin/error');

                else:
                    $data_photo = $this->upload->data();

                    $photo_name = $data_photo['raw_name'];
                    $photo_ext = $data_photo['file_ext'];
                    $photo_path = $data_photo['file_name'];
                    $photo_fullpath = $data_photo['full_path'];

                    // config untuk resize
                    $config['image_library'] = $this->config->item("image_library");
                    $config['maintain_ratio'] = $this->config->item("maintain_ratio");
                    $config['width'] = 163;
                    $config['height'] = 143;
                    $config['source_image'] = $photo_fullpath;
                    //$absolutePath = $this->config->item("absolutePath");
                    // inisialisasi library resize image
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    //config untuk crop thumbnail
                    //$thumbnail_size = get_setting('photo_thumbnail_size');
                    //$thumbnail = crop_image($photo_fullpath, $photo_name, $photo_ext, $this->config->item("upload_path_thumb"), $thumbnail_size);
                    //$medium_width = get_setting('photo_medium_width');
                    //$medium_height = get_setting('photo_medium_height');
                    //$medium = crop_image($photo_fullpath, $photo_name, $photo_ext, $this->config->item("upload_path_thumb"), $medium_width, $medium_height);


                    $this->produk_model->simpan_produk($photo_path);

                endif;

                $this->session->set_flashdata('message', 'Berita telah berhasil ditambah');
                redirect('admin/produk');
            else:
                $data['error'] = validation_errors();
            endif;
        endif;
        // $data['usaha'] = $this->usaha_md->dropdown_data();
         $data['daftar']=$this->produk_model->daftar_produk($config['per_page'],$this->uri->segment(3));
       
        
        $data['content'] = 'produk/daftar';
        $this->load->view('admin/index', $data);
    }

    function update_produk($id='') {
        if ($id == '')
            redirect('admin/produk');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('produk', 'produk', 'required');
        $this->form_validation->set_rules('stok', 'stok', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        if ($this->form_validation->run() == true):
            $this->produk_model->updateproduk($id);
            $this->session->set_flashdata('message', 'Stok sudah di update');
            redirect('admin/produk');
        else:
            $data['error'] = validation_errors();
        endif;
        $data['get'] = $this->produk_model->getprodukUpdate($id);
        $data['content'] = 'produk/update';
        $this->load->view('admin/index', $data);
    }

    function hapus_produk($id) {
        $this->produk_model->hapus_produk($id);
        $this->session->set_flashdata('message', 'Produk telah berhasil di hapus');
        redirect('admin/produk');
    }

    function bank() {
        if ($this->input->post('submit')) :
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank', 'bank', 'required');
            $this->form_validation->set_rules('no_rekening', 'no_rekening', 'required');
            $this->form_validation->set_rules('atasnama', 'atasnama', 'required');
            if ($this->form_validation->run() == true):
                $this->load->library('upload');
                $this->load->library('image_lib');
                $this->load->helper('file');
                // config untuk upload
                $config['upload_path'] = '.' . $this->config->item("upload_path_bank");
                $config['allowed_types'] = $this->config->item("allowed_types");
                $config['max_size'] = $this->config->item("max_size");
                $config['max_width'] = 0;
                $config['max_height'] = 0;
                $config['encrypt_name'] = true;
                // inisialisasi library upload
                $this->upload->initialize($config);

                // uploading
                if (!$this->upload->do_upload('logo')):
                    //redirect('inf-backend/photo_trashed');
                    $this->session->set_flashdata('error', $this->upload->display_errors());

                    redirect('admin/error');

                else:
                    $data_photo = $this->upload->data();

                    $photo_name = $data_photo['raw_name'];
                    $photo_ext = $data_photo['file_ext'];
                    $photo_path = $data_photo['file_name'];
                    $photo_fullpath = $data_photo['full_path'];

                    // config untuk resize
                    $config['image_library'] = $this->config->item("image_library");
                    $config['maintain_ratio'] = $this->config->item("maintain_ratio");
                    $config['width'] = 163;
                    $config['height'] = 143;
                    $config['source_image'] = $photo_fullpath;
                    //$absolutePath = $this->config->item("absolutePath");
                    // inisialisasi library resize image
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    //config untuk crop thumbnail
                    //$thumbnail_size = get_setting('photo_thumbnail_size');
                    //$thumbnail = crop_image($photo_fullpath, $photo_name, $photo_ext, $this->config->item("upload_path_thumb"), $thumbnail_size);
                    //$medium_width = get_setting('photo_medium_width');
                    //$medium_height = get_setting('photo_medium_height');
                    //$medium = crop_image($photo_fullpath, $photo_name, $photo_ext, $this->config->item("upload_path_thumb"), $medium_width, $medium_height);


                    $this->bank_model->simpan($photo_path);

                endif;

                $this->session->set_flashdata('message', 'Daftar Bank telah berhasil ditambah');
                redirect('admin/bank');

            endif;
        endif;
        // $data['usaha'] = $this->usaha_md->dropdown_data();
        $data['daftar'] = $this->bank_model->daftar_bank();
        $data['content'] = 'bank/daftar';
        $this->load->view('admin/index', $data);
    }

    function hapus_bank($id) {
        $this->bank_model->hapus_bank($id);
        $this->session->set_flashdata('message', 'Bank telah berhasil di hapus');
        redirect('admin/bank');
    }

    function invoice_order() {
        $user_data = $this->db->get('tbmember');
        $produk = $this->db->get('tbproduk')->result();
        //store data to session
        $this->order_model->hapus_otomatis();
        if ($this->order_model->hapus_otomatis() == true):
            foreach ($produk as $pro):
                $pro->stok = $pro->beli + $pro->stok;
            endforeach;
        endif;

        $this->session->set_userdata('idmember', $user_data->row()->KdMember);
        $data['daftar'] = $this->order_model->daftar_invoice_barang();
        // $data['rowspan_tgl']=$this->order_model->rowspan_tanggal();
        foreach ($this->order_model->bukti_invoice_identitas($this->session->userdata('idmember'))->result() as $bk) {
            $data['ht'] = $this->order_model->hitung_invoice_barang($bk->KdOrder);
        }
        $data['content'] = 'order/invoice_order';
        $this->load->view('admin/index', $data);
    }

    function konfirmasi_order($id='', $konfirmasi='') {
        if ($id == '')
            redirect($this->uri->segment(3) . '/' . $this->uri->segment(4));

        if ($konfirmasi == 'belum')
            $konfirmasi = 'sudah';
        else
            $konfirmasi = 'belum';

        // $this->db->join('tborder','tborder.kdorder=tborder_detail.tborder_kdorder');
        // $this->db->join('tbproduk','tborder_detail.TbProduk_KdProduk=tbProduk.kdproduk');
        //$this->db->join('tbmember','tbmember.kdmember=tborder.tbmember_kdmember');
        $this->db->where('KdOrder', $id);
        $this->db->set('konfirmasi', $konfirmasi);
        $this->db->update('tborder');

        $this->session->set_flashdata('message', 'status berita telah berhasil di ubah');
        redirect('admin/invoice_order');
    }

    function change_password() {
        $this->load->library('form_validation');
        if ($this->input->post('change_password')):
            
            $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required');
            $this->form_validation->set_rules('new_password_confirm', 'Konfirmasi Password Baru', 'required|matches[new_password]');
            if ($this->setting_model->check_password() == true):
                $this->setting_model->change_password();
                $data['message'] = 'password telah berhasil diubah';
            else:
                $data['error'] = 'Password Lama salah';
            endif;
        else:
            $data['error'] = validation_errors();
        endif;
        $data['content'] = 'user/change_password';
        $this->load->view('admin/index', $data);
    }

    /* function transaksi_harian() {

      $tgl = $this->input->post('tanggal');
      $bln = $this->input->post('bulan');
      $thn = $this->input->post('tahun');
      $tanggal = $thn . '-' . $bln . '-' . $tgl;

      $data['tampil'] = $this->order_model->trans_harian($tanggal);
      $data['content'] = 'transaksi/transaksi_harian';
      $this->load->view('admin/index', $data);
     */

    function transaksi_bulanan() {
        $bln = $this->input->post('bulan');
        $thn = $this->input->post('tahun');

        //$bulantahun=$thn.'-'.$bln;

        $data['tampil'] = $this->order_model->trans_bulan($bln, $thn, 5, 1);
        $data['content'] = 'transaksi/transaksi_bulanan';
        $this->load->view('admin/index', $data);
    }

    function transaksi_tahunan() {


        $thn = $this->input->post('tahun');

        //$bulantahun=$thn.'-'.$bln;

        $data['tampil'] = $this->order_model->trans_tahun($thn, 5, 1);
        $data['content'] = 'transaksi/transaksi_tahunan';
        $this->load->view('admin/index', $data);
    }

    /* function cetak_harian() {

      } */
}

?>
