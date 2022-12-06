<?php
class M_cek extends CI_Model{
    function cek_email($email){
        $hasil=$this->db->query("SELECT * FROM tbl_user WHERE email='$email'");
        return $hasil;
    }


    function cek_user($user){
        $hasil=$this->db->query("SELECT * FROM tbl_user WHERE username='$user'");
        return $hasil;
    }



  
}

