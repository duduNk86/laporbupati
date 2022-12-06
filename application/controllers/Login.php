<?php
class Login extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_login');
    }

    function index(){
        if($this->session->userdata("logged_in") ==TRUE){
            redirect('admin/dashboard');
        }else{
        //$this->load->view('user/v_login'); //jika sudah mulai dibuka pendaftar
        redirect('admin');
      }
    }


    function auth(){
        $username=strip_tags(str_replace("'", "", $this->input->post('username',TRUE)));
        $password=strip_tags(str_replace("'", "", $this->input->post('password',TRUE)));
        $cuser=$this->m_login->cekadmin_user($username,$password);
        if($cuser->num_rows() > 0){
            $xcuser=$cuser->row_array();
            if($xcuser['active']<1){ redirect('login/belumaktif'); }
            else{
            $newdata = array(
                'id'   => $xcuser['id'],
                'nama' => $xcuser['nama'],
                'hp'   => $xcuser['hp'],
                'alamat'=>$xcuser['alamat'],
                'email'   => $xcuser['email'],
                'username'   => $xcuser['username'],
                'level'   => $xcuser['level'],
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);
            redirect('admin/dashboard'); 
          }
        }
        else{
            redirect('login/gagallogin');
        }
    }


    function gagallogin(){
        $url=base_url('login');
        echo $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah </br> Jika belum memiliki akun daftarkan <a href="registrasi"><b>DISINI</b></a></div>');
        redirect($url);
    }

    function belumaktif(){
        $url=base_url('login');
        echo $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Akun Anda Belum Aktif ! </br> Silahkan lakukan aktivasi, dengan klik konfirmasi pada alamat email yang sudah didaftarkan</div>');
        redirect($url);
    }

    function logout(){
        $this->session->sess_destroy();
        $url=base_url('login');
        redirect($url);
    }
}