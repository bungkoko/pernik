<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class member_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    function input() {
        $this->db->set('username',$this->input->post('username'));
        $this->db->set('pass',md5($this->input->post('pass')));
        $this->db->set('fullname',$this->input->post('fullname'));

        //$this->db->set('tanggal_lahir',$this->input->post('thn').'-'.$this->input->post('bln').'-'.$this->input->post('tgl'));
        $this->db->set('telepon',$this->input->post('telepon'));
        $this->db->set('alamat',$this->input->post('alamat'));
    }
    function register() {
        $this->input();
        return $this->db->insert('tbmember');
    }
    function pilih_member($id) {
        $this->db->where('username',$id);
        $hasil = $this->db->get('tbmember');
        return $hasil;
    }
    function member_reset($id){
        $this->db->where('pass',$id);
        return $this->db->get('tbmember');
    }
}
?>
