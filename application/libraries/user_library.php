<?php

class User_library {

    function __construct() {
        $this->ci =& get_instance();
        $this->base_url = base_url();
    }
    public function admin_logged() {
        $user_id=$this->ci->session->userdata('KdAdmin');
        $user=$this->ci->session->userdata('username');
        $fullname=$this->ci->session->userdata('fullname');
        $logged=$this->ci->session->userdata('logged');
        if(!$user || !$fullname || !$logged):
            return false;
        else:
            $this->ci->db->where('username',$user);
            $result=$this->ci->db->get('tbadmin')->num_rows();
            if($result==0):
                return false;
            else:
                return true;
        endif;
    endif;
    }
    public function is_logged() {
        $idmember=$this->ci->session->userdata('idmember');
        $username = $this->ci->session->userdata('username');
        $fullname = $this->ci->session->userdata('fullname');
        $logged = $this->ci->session->userdata('logged');

        if( !$username || !$fullname || !$logged ):
            return false;
        else:

            $this->ci->db->where('username', $username);
            $result =  $this->ci->db->get('tbmember')->num_rows();
            if ($result == 0):
                return false;
            else :
                return true;
        endif;
    endif;
    }






}
