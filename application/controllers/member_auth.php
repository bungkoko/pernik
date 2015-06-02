<?php

class Member_auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function login() {
        if($this->user_library->is_logged() == true) :
            redirect('member/index');
        endif;

        $data["error"] = "";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true):
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            //check user from database
            $this->db->where('username',$username);
            $this->db->where('pass',$password);
            $user_data = $this->db->get('tbmember');

            //store data to session
            if ($user_data->num_rows == 1):
               // $this->session->set_userdata('idmember',$user_data->row()->idmember);
                $this->session->set_userdata('username', $user_data->row()->username);
                $this->session->set_userdata('fullname', $user_data->row()->fullname);
                $this->session->set_userdata('logged', true);
                redirect('member');
            else :
                redirect('home');
        endif;
        else :
            $data["error"] = validation_errors();
    endif;

    }

    function logout() {

        $this->session->unset_userdata('username');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('logged');
         $this->cart->destroy();
        redirect('home');
    }
}
