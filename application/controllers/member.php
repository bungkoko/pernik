<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class member extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('produk_model');
        $this->load->model('bank_model');
    }

    function index() {
        redirect('home');
       /* $data['bank']=$this->bank_model->daftar_bank();
         $data['laris']=$this->produk_model->produk_laris('2');
        $data['daftar'] = $this->produk_model->daftar_produk();
        $data['content'] = "produk/daftar_produk";
        $this->load->view('index', $data);*/
    }

    function daftar_member() {
        if ($this->input->post('submit')):
            $this->member_model->register();
            $this->session->set_flashdata('message', 'Anda Sudah Menjadi Member Silakan Login');
            redirect('home');
        endif;
        $data['bank']=$this->bank_model->daftar_bank();
         $data['laris']=$this->produk_model->produk_laris('2');
        $data['content'] = 'member/member';
        $this->load->view('index', $data);
    }

    function lupa_password() {
        $data['content'] = 'member/forget_password';
        $this->load->view('index', $data);
    }
    /*function lupa_password_process(){
     $this->form_validation->set_rules('email','email','required');
     if($this->form_validation->run()==true){
         $get=
     }
    }*/

}

?>
