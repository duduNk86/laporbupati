<?php
class Selesai extends CI_Controller{
	function __construct(){
		parent::__construct();
        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
        }
        $this->load->model('m_laporan');
		$this->load->model('m_admin');
		$this->load->library('upload');
		$x['title']='Laporan TL Laporbup';
	}

	function index(){
		$x['title']='Lapor Bupati Wonosobo';
		$code=3;
		$x['data']=$this->m_laporan->view_laporan_selesai($code);
		$this->load->view('admin/v_laporan_selesai2',$x);
	}

}