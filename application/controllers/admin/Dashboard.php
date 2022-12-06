<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();

        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
        }
		// $this->load->model('m_pengunjung');
		$this->load->model('m_dashboard');
		$this->load->model('m_laporan');
	}
	
	function index(){
			$pengguna_level=$this->session->userdata('pengguna_level');
			$x['title']='Lapor Bupati';
			$x['total_laporan'] = $this->m_dashboard->total_laporan();
			$x['jml']=$this->m_laporan->get_jml();
			if ($pengguna_level=='1'){
			$this->load->view('admin/v_dashboard2',$x);
			}
			if ($pengguna_level=='2'){
				$this->load->view('admin/v_dashboard2_opd',$x);
			}
	
	}

	function opd(){
		$pengguna_level=$this->session->userdata('pengguna_level');
			$x['title']='Lapor Bupati';
			$x['total_laporan'] = $this->m_dashboard->total_laporan();
			$x['jml']=$this->m_laporan->get_jml();
			if ($pengguna_level=='2'){
			$this->load->view('admin/v_dashboard2_opd',$x);
			}
	
	}
	
}