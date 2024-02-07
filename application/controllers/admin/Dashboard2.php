<?php
class Dashboard2 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged_in") !== TRUE) {
			redirect('admin/administrator');
		}
		$this->load->model('m_dashboard');
		$this->load->model('m_laporan');
		$this->load->helper('dateindo_helper');
	}

	function index()
	{
		$format = $this->input->post('x_format');
		$dari = $this->input->post('x_dari');
		$sampai = $this->input->post('x_sampai');
		$pengguna_level = $this->session->userdata('pengguna_level');
		$x['title'] = 'Lapor Bupati Wonosobo';
		$x['tanggal_dari']	= $dari;
		$x['tanggal_sampai'] = $sampai;
		$x['total_laporan'] = $this->m_dashboard->total_laporan();
		$x['jml'] = $this->m_laporan->get_jml();
		$x['jml_laporan'] = $this->m_laporan->get_jml_laporan_custome($dari, $sampai);
		$x['jml_diterima'] = $this->m_laporan->get_jml_diterima_custome($dari, $sampai);
		$x['jml_diproses'] = $this->m_laporan->get_jml_diproses_custome($dari, $sampai);
		$x['jml_ditolak'] = $this->m_laporan->get_jml_ditolak_custome($dari, $sampai);
		$x['jml_selesai'] = $this->m_laporan->get_jml_selesai_custome($dari, $sampai);
		$x['jml_inbox'] = $this->m_laporan->get_jml_inbox();
		$x['jml_user'] = $this->m_laporan->get_jml_user();
		$x['durasi_tl_custome'] = $this->m_laporan->get_durasi_tl_custome($dari, $sampai);
		$x['linechart_custome'] = $this->m_laporan->linechart_custome($dari, $sampai);
		$x['linechart_custome_bulan'] = $this->m_laporan->linechart_custome_bulan($dari, $sampai);
		$x['barchart_custome'] = $this->m_laporan->barchart_custome($dari, $sampai);
		$x['piechart_custome'] = $this->m_laporan->piechart_custome($dari, $sampai);
		$x['piechart2_custome'] = $this->m_laporan->piechart2_custome($dari, $sampai);
		$x['doughnutchart_custome'] = $this->m_laporan->doughnutchart_custome($dari, $sampai);
		$x['radarchart_custome'] = $this->m_laporan->radarchart_custome($dari, $sampai);
		$x['tablechart1_custome'] = $this->m_laporan->tablechart1_custome($dari, $sampai);
		$x['tablechart2_custome'] = $this->m_laporan->tablechart2_custome($dari, $sampai);
		if ($pengguna_level == '1' && $format == 'tahun') {
			$this->load->view('admin/v_dashboard3', $x);
		}
		if ($pengguna_level == '1' && $format == 'bulan') {
			$this->load->view('admin/v_dashboard4', $x);
		}
		if ($pengguna_level == '2') {
			$this->load->view('admin/v_dashboard2_opd', $x);
		}
	}

	function opd()
	{
		$pengguna_level = $this->session->userdata('pengguna_level');
		$id_kepada = $this->session->userdata('pengguna_idskpd');
		$format = $this->input->post('x_format');
		$dari = $this->input->post('x_dari');
		$sampai = $this->input->post('x_sampai');
		$x['title'] = 'Lapor Bupati Wonosobo';
		$x['total_laporan'] = $this->m_dashboard->total_laporan();
		$x['jml'] = $this->m_laporan->get_jml();
		$x['tanggal_dari']	= $dari;
		$x['tanggal_sampai'] = $sampai;
		$x['jml_laporan_opd'] = $this->m_laporan->get_jml_laporan_opd_custome($id_kepada, $dari, $sampai);
		$x['jml_diterima_opd'] = $this->m_laporan->get_jml_diterima_opd_custome($id_kepada, $dari, $sampai);
		$x['jml_diproses_opd'] = $this->m_laporan->get_jml_diproses_opd_custome($id_kepada, $dari, $sampai);
		$x['jml_ditolak_opd'] = $this->m_laporan->get_jml_ditolak_opd_custome($id_kepada, $dari, $sampai);
		$x['jml_selesai_opd'] = $this->m_laporan->get_jml_selesai_opd_custome($id_kepada, $dari, $sampai);
		$x['jml_inbox'] = $this->m_laporan->get_jml_inbox();
		$x['jml_user'] = $this->m_laporan->get_jml_user();
		$x['durasi_tl_opd'] = $this->m_laporan->get_durasi_tl_opd_custome($id_kepada, $dari, $sampai);
		$x['linechart_opd_custome'] = $this->m_laporan->linechart_opd_custome($id_kepada, $dari, $sampai);
		$x['linechart_opd_custome_bulan'] = $this->m_laporan->linechart_opd_custome_bulan($id_kepada, $dari, $sampai);
		$x['piechart_opd_custome'] = $this->m_laporan->piechart_opd_custome($id_kepada, $dari, $sampai);
		$x['piechart2_opd_custome'] = $this->m_laporan->piechart2_opd_custome($id_kepada, $dari, $sampai);
		$x['tablechart1_opd_custome'] = $this->m_laporan->tablechart1_opd_custome($id_kepada, $dari, $sampai);
		$x['tablechart2_opd_custome'] = $this->m_laporan->tablechart2_opd_custome($id_kepada, $dari, $sampai);
		if ($pengguna_level == '2' && $format == 'tahun') {
			$this->load->view('admin/v_dashboard3_opd', $x);
		} else if ($pengguna_level == '2' && $format == 'bulan') {
			$this->load->view('admin/v_dashboard4_opd', $x);
		} else {
			$this->load->view('admin/v_dashboard2_opd', $x);
		}
	}

	// function opd()
	// {
	// 	$pengguna_level = $this->session->userdata('pengguna_level');
	// 	$x['title'] = 'Lapor Bupati Wonosobo';
	// 	$x['total_laporan'] = $this->m_dashboard->total_laporan();
	// 	$x['jml'] = $this->m_laporan->get_jml();
	// 	if ($pengguna_level == '2') {
	// 		$this->load->view('admin/v_dashboard2_opd', $x);
	// 	}
	// }
}
