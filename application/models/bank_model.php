<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class bank_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    function input() {
        $this->db->set('Bank_Nm',$this->input->post('bank'));
        $this->db->set('no_rekening', $this->input->post('no_rekening'));
        $this->db->set('nama_pemilik',$this->input->post('atasnama'));
    }

    function simpan($path) {
        $this->input();
        $this->db->set('Bank_Logo', $this->config->item("upload_path_bank").$path);
        return $this->db->insert('tbbank');
    }
    function daftar_bank(){
        return $this->db->get('tbbank');
    }
     function hapus_bank($id) {
        $this->db->where('idBank',$id);
        $this->db->delete('tbbank');
    }

}

?>
