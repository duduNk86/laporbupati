<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_login');
    }
   
    function index(){
        $x = array(
			'title' 		 => 'Lapor Bupati Wonosobo',
			'captcha' 		 => $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
		);
        $this->load->view('admin/v_login',$x);
    }
    
    function auth(){
        $x['title']='Lapor Bupati Wonosobo';

        $username=strip_tags(str_replace("'", "", $this->input->post('username',TRUE)));
        $password=strip_tags(str_replace("'", "", $this->input->post('password',TRUE)));
        $recaptcha = $this->input->post('g-recaptcha-response');
        // var_dump($recaptcha);
        // die;

        $ceklogin=$this->m_login->cekadmin($username,$password);
    if (!empty($recaptcha)) {
        if($ceklogin->num_rows() > 0){
            $datarow=$ceklogin->row_array();
            $datasession = array(
                'pengguna_id'   => $datarow['pengguna_id'],
                'pengguna_nama'   => $datarow['pengguna_nama'],
                'pengguna_username'  => $datarow['pengguna_username'],
                'pengguna_idskpd'  => $datarow['pengguna_idskpd'],
                'pengguna_email'  => $datarow['pengguna_email'],
                'pengguna_opd'  => $datarow['pengguna_opd'],
                'pengguna_nohp'  => $datarow['pengguna_nohp'],
                'pengguna_status'  => $datarow['pengguna_status'],
                'pengguna_level'  => $datarow['pengguna_level'],
                'pengguna_photo'  => $datarow['pengguna_photo'],
                'logged_in' => TRUE
            );


            $this->session->set_userdata($datasession);
            // var_dump($datasession);
            // die;
     
            $pengguna_level=$this->session->userdata('pengguna_level');
            if ($pengguna_level=='1'){
            redirect('admin/dashboard');
            }
            if ($pengguna_level=='2'){
            redirect('admin/dashboard/opd');
            }
            if ($pengguna_level=='99'){
            redirect('home/view');
            }
       
                }else{
                    redirect('admin/gagal_login');
                }
        }else{
            echo $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Isikan Captcha !!</a></div>');
            redirect('admin');
        }
    }


    function gagal_login(){
        $url=base_url('admin');
        echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
        redirect($url);
    }

    function logout(){
        $this->session->sess_destroy();
        $url=base_url('admin');
        redirect($url);
    }
}