<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();

        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
        }
		$this->load->model('m_dashboard');
		$this->load->model('m_laporan');
	}
	
	function index(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati';
		$x['total_laporan'] = $this->m_dashboard->total_laporan();
		$x['jml']=$this->m_laporan->get_jml();
		$x['jml_laporan']=$this->m_laporan->get_jml_laporan();
		$x['jml_diterima']=$this->m_laporan->get_jml_diterima();
		$x['jml_diproses']=$this->m_laporan->get_jml_diproses();
		$x['jml_ditolak']=$this->m_laporan->get_jml_ditolak();
		$x['jml_selesai']=$this->m_laporan->get_jml_selesai();
		$x['jml_inbox']=$this->m_laporan->get_jml_inbox();
		$x['jml_user']=$this->m_laporan->get_jml_user();
		$x['linechart'] = $this->m_laporan->linechart();
		$x['barchart'] = $this->m_laporan->barchart();
		$x['piechart'] = $this->m_laporan->piechart();
		$x['piechart2'] = $this->m_laporan->piechart2();
		$x['doughnutchart'] = $this->m_laporan->doughnutchart();
		$x['radarchart'] = $this->m_laporan->radarchart();
		$x['tablechart1'] = $this->m_laporan->tablechart1();
		$x['tablechart2'] = $this->m_laporan->tablechart2();
		$x['opd_tlproses'] = $this->m_laporan->opd_tlproses();
		if ($pengguna_level=='1'){
		$this->load->view('admin/v_dashboard2',$x);
		}
		if ($pengguna_level=='2'){
			$this->load->view('admin/v_dashboard2_opd',$x);
		}
	}

	function opd(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$id_kepada=$this->session->userdata('pengguna_idskpd');
		$x['title']='Lapor Bupati';
		$x['total_laporan'] = $this->m_dashboard->total_laporan();
		$x['jml']=$this->m_laporan->get_jml();
		$x['jml_laporan_opd']=$this->m_laporan->get_jml_laporan_opd($id_kepada);
		$x['jml_diterima_opd']=$this->m_laporan->get_jml_diterima_opd($id_kepada);
		$x['jml_diproses_opd']=$this->m_laporan->get_jml_diproses_opd($id_kepada);
		$x['jml_ditolak_opd']=$this->m_laporan->get_jml_ditolak_opd($id_kepada);
		$x['jml_selesai_opd']=$this->m_laporan->get_jml_selesai_opd($id_kepada);
		$x['jml_inbox']=$this->m_laporan->get_jml_inbox();
		$x['jml_user']=$this->m_laporan->get_jml_user();
		$x['linechart_opd'] = $this->m_laporan->linechart_opd($id_kepada);
		$x['piechart_opd'] = $this->m_laporan->piechart_opd($id_kepada);
		$x['tablechart1_opd'] = $this->m_laporan->tablechart1_opd($id_kepada);
		$x['tablechart2_opd'] = $this->m_laporan->tablechart2_opd($id_kepada);
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_dashboard2_opd',$x);
		}
	}
	
}