<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class login_model extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    function cek_user($username,$password){
        $user=array('username'=>$username,'pass'=>$password);
        $query=$this->db->get_where('tbmember',$user,1,0);
        if($query->num_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
   
}
?>
