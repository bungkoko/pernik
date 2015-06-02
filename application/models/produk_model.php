<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class produk_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    function input() {
        $this->db->set('Produk',$this->input->post('produk'));
        $this->db->set('harga_per_item',$this->input->post('harga'));
        $this->db->set('stok',$this->input->post('stok'));
        $this->db->set('beli','0');
    }
    function simpan_produk($path) {
        $this->input();
        $this->db->set('image',$this->config->item("upload_path_photo").$path);
        return $this->db->insert('tbproduk');
    }

     function daftar_produk($page=null, $uri=null) {
         //$this->db->limit($page,$uri);
         return $this->db->get('tbproduk',$page,$uri);
    }
    
    function produk_laris($limit){
        $this->db->limit($limit,0);
        $this->db->order_by('beli','DESC');
        return $this->db->get('tbproduk');
    }

    function getprodukUpdate($id){
        $this->db->where('kdproduk',$id);
        return $this->db->get('tbproduk')->row();
    }
    function updateproduk($id){
        $this->db->where('kdproduk',$id);
        $this->db->set('stok',$this->input->post('stok'));
        return $this->db->update('tbproduk');
    }
    function hapus_produk($id) {
        $this->db->where('KdProduk',$id);
        $this->db->delete('tbproduk');
    }
    
  
    function update_stok($id) {
        $this->db->set('Produk',$this->input->post('produk'));
        $this->db->set('harga_per_item',$this->input->post('harga'));
        $this->db->set('stok',$this->input->post('stok'));
        $this->db->where('KdProduk',$id);
        $this->db->update('tbproduk');
    }
}
?>
