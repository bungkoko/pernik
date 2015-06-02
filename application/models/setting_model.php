<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*  function get_data_admin() {
      $this->db->where('KdAdmin', $this->session->userdata('user_id'));
      return $this->db->get('tbAdmin')->row();
      }

      function update_user() {
      $this->db->set('user_login', $this->input->post('login'));
      $this->db->set('user_display_name', $this->input->post('display_name'));
      $this->db->set('user_email', $this->input->post('email'));

      $this->db->where('user_id', $this->session->userdata('user_id'));
      $this->db->update('user');
      }
     */

    function check_password() {
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->where('pass', md5($this->input->post('old_password')));
        $result = $this->db->get('tbadmin')->num_rows();

        if ($result == 1)
            return true;
        else
            return false;
    }

    function change_password() {

        $this->db->set('pass', md5($this->input->post('new_password')));
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('tbadmin');
    }

}

?>
