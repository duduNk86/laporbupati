<?php
class M_login extends CI_Model{
    function cekadmin($username,$password){
        $hasil=$this->db->query("SELECT * FROM tbl_admin WHERE pengguna_username='$username' AND pengguna_password=sha1(sha1(md5('$password')))");
        return $hasil;
    }


    function cekadmin_user($username,$password){
        $hasil=$this->db->query("SELECT * FROM tbl_user WHERE username='$username' AND password=sha1(sha1(md5('$password')))");
        return $hasil;
    }
  
}
