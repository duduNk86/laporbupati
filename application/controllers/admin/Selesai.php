<?php
class Selesai extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata("logged_in") !== TRUE) {
			redirect('admin/administrator');
		}
		$this->load->model('m_kategori_laporan');
		$this->load->model('m_laporan');
		$this->load->model('m_admin');
		$this->load->model('m_kepada');
		$this->load->model('C_model', 'c_model');
		$this->load->library('upload');
		// $x['title'] = 'Laporan TL Laporbup';
	}

	function index()
	{
		$x['title'] = 'Lapor Bupati Wonosobo';
		$x['kpd'] = $this->m_kepada->get_all_kepada();
		$x['subkatall'] = $this->m_kategori_laporan->get_all_subkategori_laporan();
		$x['data'] = $this->m_laporan->get_all_laporan_selesai();
		$this->load->view('admin/v_laporan2_a_selesai', $x);
	}

	// function index2()
	// {
	// 	$x['title'] = 'Lapor Bupati Wonosobo';
	// 	$code = 3;
	// 	$x['data'] = $this->m_laporan->view_laporan_selesai($code);
	// 	$this->load->view('admin/v_laporan_selesai2', $x);
	// }
}
