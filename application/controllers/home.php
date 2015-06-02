<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Home extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('member_model');
        $this->load->model('bank_model');

    }
    function index(){
        $this->page();
       
    }
    function page($offset=0){
         $config['base_url']=base_url().'home/page/';
        $config['total_rows']=$this->produk_model->daftar_produk()->num_rows();
        $config['per_page']='4';
        $config['uri_segment'] = 3;
        
        //$config['num_links']='6';
        $this->pagination->initialize($config);
        $data['paging']=$this->pagination->create_links();
        $data['bank']=$this->bank_model->daftar_bank();
        
        $data['laris']=$this->produk_model->produk_laris('2');
        $data['daftar']=$this->produk_model->daftar_produk($config['per_page'],$this->uri->segment(3));
        $data['content']="produk/daftar_produk";
        $this->load->view('index',$data);
    }
    function cara_beli(){
        $data['bank']=$this->bank_model->daftar_bank();
         $data['laris']=$this->produk_model->produk_laris('2');
        $data['content']='pesanan/carapemesanan';
        $this->load->view('index',$data);
    }
    function kontak(){
         $data['bank']=$this->bank_model->daftar_bank();
        
        //$data['laris']=$this->produk_model->produk_laris('2');
         $data['laris']=$this->produk_model->produk_laris('2');
        $data['content']='kontak/kontak';
        $this->load->view('index',$data);
    }
    

}
?>
