<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class order_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function cek_kode($beli) {
        $query = $this->db->query("SELECT MAX(KdOrder) as kd FROM tborder WHERE KdOrder like '%$beli%'");
        return $query;
    }

    function simpan_order($sid) {
        $this->db->set('session_id', $sid);
        $this->db->set('nama_penerima', $this->input->post('namapen'));
        $this->db->set('email_penerima', $this->input->post('emailpen'));
        $this->db->set('alamat_penerima', $this->input->post('alamatpen'));
        $this->db->set('telepon', $this->input->post('telponpen'));
        $this->db->set('tanggal_order', date('Ymd'));
        $this->db->set('konfirmasi', 'belum');
        return $this->db->insert('tbOrder');
    }

    /* function order_laris(){
      $this->db->where('konfirmasi','sudah');
      $this->db->get('tbOrder');
      } */

    function update_beli($kd, $bl) {
        $query = $this->db->query("update tbproduk set beli=beli+$bl where KdProduk='$kd'");
        return $query;
    }

    function update_stok($kd, $bl) {
        $query = $this->db->query("update tbproduk set stok=stok-$bl where KdProduk='$kd'");
        return $query;
    }

    function bukti_invoice_identitas($id) {
        $this->db->join('tbOrder_detail', 'tbOrder.KdOrder=tbOrder_detail.TbOrder_KdOrder');
        $this->db->join('tbmember', 'tbmember.kdmember=tborder.tbmember_kdmember');
        $this->db->where('tbmember.KdMember', $id);
        $this->db->order_by('tbOrder.KdOrder', 'DESC');
        $this->db->limit('1');
        return $this->db->get('tbOrder');
    }

    function bukti_invoice_barang($id, $sid) {

        /* $query="SELECT *
          FROM tbmember, tborder, tborder_detail, tbproduk
          WHERE tbmember.KdMember = tborder.tbmember_kdmember
          AND tborder.KdOrder = tborder_detail.tborder_kdorder
          AND tbproduk.kdproduk = tborder_detail.tbproduk_kdproduk
          LIMIT 0,$ht and tb"; */
        $this->db->join('tbOrder', 'tbOrder.KdOrder=tbOrder_detail.TbOrder_KdOrder');
        $this->db->join('tbProduk', 'tbOrder_detail.TbProduk_KdProduk=tbProduk.KdProduk');
        $this->db->join('tbmember', 'tbmember.KdMember=tbOrder.TbMember_KdMember');
        $this->db->where('tbmember.KdMember', $id);
        $this->db->where('tbOrder.session_id', $sid);
        //$this->db->order_by('tbOrder.KdOrder','DESC');


        return $this->db->get('tbOrder_detail');
    }

    function hitung_invoice_barang($id) {
        $this->db->where('tbOrder.KdOrder', $id);
        $this->db->join('tbOrder_detail', 'tborder.KdOrder = tborder_detail.tborder_KdOrder');
        return $this->db->get('tborder')->num_rows();
        /* return $this->db->query("SELECT COUNT( TbOrder.TbMember_KdMember )
          FROM tborder, tborder_detail
          WHERE tborder.KdOrder = tborder_detail.tborder_KdOrder
          AND tbOrder.KdOrder ='$id'"); */
    }

    function total_invoice_barang($id, $sid) {

        $query = "select sum(harga_detail*jumlah_detail) as jumlah_detail 
            from tborder,tborder_detail,tbmember 
            where tborder.kdorder=tborder_detail.tborder_Kdorder 
            and tbmember.kdmember=tborder.tbmember_kdmember
            and tborder.tbmember_kdmember='$id'
            and tborder.session_id='$sid'";

        return $this->db->query($query);

        /* $this->db->select_sum("tborder_detail.harga_detail)*(tbOrder_detail.jumlah_detail");
          $this->db->join('tbOrder','tbOrder.KdOrder=tbOrder_detail.TbOrder_KdOrder');
          $this->db->join('tbProduk','tbOrder_detail.TbProduk_KdProduk=tbProduk.KdProduk');
          $this->db->where('TbMember_KdMember',$id);
          //$this->db->where('tbOrder.tanggal_order',$tgl);
          $this->db->where('tbOrder.session_id',$sid);
          //$this->db->where('tbOrder.KdOrder',$kdorder);
          //$this->db->distinct('tbOrder.KdOrder');
          $this->db->order_by('tbOrder.KdOrder','DESC');
          // $this->db->limit($ht,0);
          return $this->db->get('tbOrder_detail'); */
    }

    function daftar_invoice_barang() {
        $this->db->join('tborder', 'tborder.kdorder=tborder_detail.tborder_kdorder');
        $this->db->join('tbproduk', 'tborder_detail.TbProduk_KdProduk=tbProduk.kdproduk');
        $this->db->join('tbmember', 'tbmember.kdmember=tborder.tbmember_kdmember');
        $this->db->order_by('tborder.kdorder', 'desc');
        return $this->db->get('tborder_detail');
    }

    function hapus_otomatis() {
        $lama = 3;
        //$this->db->where("DATEDIFF(CURDATE(),tanggal_order),$lama");
        //$this->db->delete('tborder');
        return $this->db->query("DELETE FROM tborder where DATEDIFF(CURDATE(),tanggal_order)>=$lama and konfirmasi='belum'");
    }

    function bukti_invoice($id) {
        $this->db->select('tborder_detail.tborder_kdorder,tbmember.fullname,tborder.nama_penerima,tbproduk.produk,TbOrder_detail.harga_detail,tborder_detail.jumlah_detail');
        $this->db->join('tborder', 'tborder.kdorder=tborder_detail.tborder_kdorder');
        $this->db->join('tbproduk', 'tborder_detail.TbProduk_KdProduk=tbProduk.kdproduk');
        $this->db->join('tbmember', 'tbmember.kdmember=tborder.tbmember_kdmember');
        $this->db->where('tbmember_kdmember', $id);
        return $this->db->get('tborder_detail')->result();
    }

    /* function trans_harian($tgl){
      $this->db->join('tborder','tborder.kdorder=tborder_detail.tborder_kdorder');
      $this->db->join('tbproduk','tborder_detail.tbproduk_kdproduk=tbproduk.kdproduk');
      $this->db->join('tbmember','tbmember.kdmember=tborder.tbmember_kdmember');
      $this->db->like('tborder.tanggal_order',$tgl);
      $this->db->where('tborder.konfirmasi','sudah');
      return $this->db->get('tborder_detail');
      } */

    function trans_bulan($bln, $thn) {
        $this->db->join('tborder', 'tborder.kdorder=tborder_detail.tborder_kdorder');
        $this->db->join('tbproduk', 'tborder_detail.tbproduk_kdproduk=tbproduk.kdproduk');
        $this->db->join('tbmember', 'tbmember.kdmember=tborder.tbmember_kdmember');
        $this->db->where('month(tanggal_order)', $bln);
        $this->db->where('year(tanggal_order)', $thn);
        return $this->db->get('tborder_detail');
    }

    function trans_tahun($thn) {
        $this->db->join('tborder', 'tborder.kdorder=tborder_detail.tborder_kdorder');
        $this->db->join('tbproduk', 'tborder_detail.tbproduk_kdproduk=tbproduk.kdproduk');
        $this->db->join('tbmember', 'tbmember.kdmember=tborder.tbmember_kdmember');
        //$this->db->where('month(tanggal_order)',$bln);
        $this->db->where('year(tanggal_order)', $thn);
        // $this->db->where('limit',$limit);
        return $this->db->get('tborder_detail');
    }

}

?>
