<?php
class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
		$this->load->model('m_laporan');
		$this->load->model('m_kategori_laporan');
		$this->load->helper('dateindo_helper');
	}

	function index()
	{
		$kategori_id = $this->input->get('id', TRUE);
		$x = array(
			'title'  => 'Lapor Bupati Wonosobo',
			'tayang' => $this->m_home->get_laporan_tayang(),
			'kat' 	 => $this->m_kategori_laporan->get_all_kategori_laporan(),
			'subkat' => $this->m_kategori_laporan->get_subkategori_laporan($kategori_id),
			'captcha' 		 => $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag()
		);

		// $this->load->view('v_dashboard_tayang',$x);
		$this->load->view('v_aduan_new', $x);
		//  $this->load->view('v_tes1');

	}

	function survei()
	{
		$x = array(
			'title'		=> 'Lapor Bupati Wonosobo',
			'tayang'	=> $this->m_home->get_laporan_tayang(),
			'captcha'	=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag()
		);
		$this->load->view('v_survei', $x);
	}

	function view()
	{
		$pengguna_level = $this->session->userdata('pengguna_level');
		$x = array(
			'title'			=> 'Lapor Bupati Wonosobo',
			'tayang'		=> $this->m_home->get_laporan_tayang(),
			'captcha'		=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
			'jml_laporan'  	=> $this->m_laporan->get_jml_laporan(),
			'jml_diterima' 	=> $this->m_laporan->get_jml_diterima(),
			'jml_diproses' 	=> $this->m_laporan->get_jml_diproses(),
			'jml_ditolak'  	=> $this->m_laporan->get_jml_ditolak(),
			'jml_selesai'  	=> $this->m_laporan->get_jml_selesai(),
			'jml_inbox'		=> $this->m_laporan->get_jml_inbox(),
			'jml_user' 		=> $this->m_laporan->get_jml_user(),
			'durasi_tl'		=> $this->m_laporan->get_durasi_tl(),
			'opd_tlproses'  => $this->m_laporan->opd_tlproses(),
			'linechart' 	=> $this->m_laporan->linechart(),
			'barchart' 		=> $this->m_laporan->barchart(),
			'piechart' 		=> $this->m_laporan->piechart(),
			'piechart2' 	=> $this->m_laporan->piechart2(),
			'doughnutchart' => $this->m_laporan->doughnutchart(),
			'radarchart' 	=> $this->m_laporan->radarchart(),
			'tablechart1' 	=> $this->m_laporan->tablechart1_bupati(),
			'tablechart2' 	=> $this->m_laporan->tablechart2_bupati(),
			'tablechart3' 	=> $this->m_laporan->tablechart3_bupati()

		);
		$this->load->view('v_dashboard_tayang', $x);
	}

	function view2()
	{
		$pengguna_level = $this->session->userdata('pengguna_level');
		$x = array(
			'title'			=> 'Lapor Bupati Wonosobo',
			'tayang'		=> $this->m_home->get_laporan_tayang(),
			'captcha'		=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
			'jml_tayang' 	=> $this->m_laporan->get_jml_tayang_dashboard_bupati(),
			'jml_prosestl' 	=> $this->m_laporan->get_jml_prosestl_dashboard_bupati()
		);
		$this->load->view('v_dashboard_tayang2', $x);
	}

	function view3()
	{
		$format = $this->input->post('x_format');
		$dari = $this->input->post('x_dari');
		$sampai = $this->input->post('x_sampai');
		$pengguna_level = $this->session->userdata('pengguna_level');
		$x = array(
			'title'			=> 'Lapor Bupati Wonosobo',
			'tayang'		=> $this->m_home->get_laporan_tayang(),
			'captcha' 		=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
			'tanggal_dari'	=> $dari,
			'tanggal_sampai' => $sampai,
			'jml_laporan' 	=> $this->m_laporan->get_jml_laporan_custome($dari, $sampai),
			'jml_diterima' 	=> $this->m_laporan->get_jml_diterima_custome($dari, $sampai),
			'jml_diproses' 	=> $this->m_laporan->get_jml_diproses_custome($dari, $sampai),
			'jml_ditolak' 	=> $this->m_laporan->get_jml_ditolak_custome($dari, $sampai),
			'jml_selesai' 	=> $this->m_laporan->get_jml_selesai_custome($dari, $sampai),
			'jml_inbox' 	=> $this->m_laporan->get_jml_inbox(),
			'jml_user' 		=> $this->m_laporan->get_jml_user(),
			'durasi_tl'		=> $this->m_laporan->get_durasi_tl_custome($dari, $sampai),
			'opd_tlproses_custome'  => $this->m_laporan->opd_tlproses_custome($dari, $sampai),
			'linechart_custome' 	 => $this->m_laporan->linechart_custome($dari, $sampai),
			'linechart_custome_bulan' => $this->m_laporan->linechart_custome_bulan($dari, $sampai),
			'barchart_custome' 		 => $this->m_laporan->barchart_custome($dari, $sampai),
			'piechart_custome' 		 => $this->m_laporan->piechart_custome($dari, $sampai),
			'piechart2_custome' 	 => $this->m_laporan->piechart2_custome($dari, $sampai),
			'doughnutchart_custome'  => $this->m_laporan->doughnutchart_custome($dari, $sampai),
			'radarchart_custome' 	 => $this->m_laporan->radarchart_custome($dari, $sampai),
			'tablechart1_custome' 	 => $this->m_laporan->tablechart1_custome_bupati($dari, $sampai),
			'tablechart2_custome' 	 => $this->m_laporan->tablechart2_custome_bupati($dari, $sampai),
			'tablechart3_custome' 	=> $this->m_laporan->tablechart3_custome_bupati($dari, $sampai)
		);
		if ($format == 'tahun') {
			$this->load->view('v_dashboard_tayang3', $x);
		}
		if ($format == 'bulan') {
			$this->load->view('v_dashboard_tayang4', $x);
		}
	}

	function detail($id)
	{
		$x['title'] = 'Lapor Bupati Wonosobo';
		$x['tayang'] = $this->m_home->get_laporan_tayang_detail($id);
		$x['captcha'] = $this->recaptcha->getWidget();
		$x['script_captcha'] = $this->recaptcha->getScriptTag();
		$this->load->view('v_dashboard_tayang_detail', $x);
	}

	function get_subkategori_home()
	{
		$kategori_id = $this->input->get('id', TRUE);
		$data = $this->m_kategori_laporan->get_subkategori_laporan($kategori_id)->result();
		// print_r($data);
		// die;
		// echo $kategori_id;
		// die;
		echo json_encode($data);
	}
}
