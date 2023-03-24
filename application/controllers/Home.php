<?php 
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_home');
		$this->load->model('m_laporan');
		$this->load->model('m_kategori_laporan');
	}

	function index(){
		$kategori_id = $this->input->get('id',TRUE);
		$x = array(
		'title' => 'Lapor Bupati Wonosobo',
		'tayang' => $this->m_home->get_laporan_tayang(),
		'kat' => $this->m_kategori_laporan->get_all_kategori_laporan(),
		'subkat' => $this->m_kategori_laporan->get_subkategori_laporan($kategori_id),
		// 'subkatall' => $this->m_kategori_laporan->get_all_subkategori_laporan(),
		'captcha' 		 => $this->recaptcha->getWidget(),
		'script_captcha' => $this->recaptcha->getScriptTag()
		);

		// $this->load->view('v_dashboard_tayang',$x);
		$this->load->view('v_aduan_new',$x);
      //  $this->load->view('v_tes1');

	}

	function survei(){
		$x = array(
		'title'=>'Lapor Bupati Wonosobo',
		'tayang'=>$this->m_home->get_laporan_tayang(),
		'captcha' 		 => $this->recaptcha->getWidget(),
		'script_captcha' => $this->recaptcha->getScriptTag()
		);
		$this->load->view('v_survei',$x);
	}
	
	function view(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x = array(
		'title'=>'Lapor Bupati Wonosobo',
		'tayang'=>$this->m_home->get_laporan_tayang(),
		'captcha' 		 => $this->recaptcha->getWidget(),
		'script_captcha' => $this->recaptcha->getScriptTag(),

		'jml_laporan' => $this->m_laporan->get_jml_laporan(),
		'jml_diterima' => $this->m_laporan->get_jml_diterima(),
		'jml_diproses' => $this->m_laporan->get_jml_diproses(),
		'jml_ditolak' => $this->m_laporan->get_jml_ditolak(),
		'jml_selesai' => $this->m_laporan->get_jml_selesai(),
		'jml_inbox' => $this->m_laporan->get_jml_inbox(),
		'jml_user' => $this->m_laporan->get_jml_user(),
		'linechart' => $this->m_laporan->linechart(),
		'barchart' => $this->m_laporan->barchart(),
		'piechart' => $this->m_laporan->piechart(),
		'doughnutchart' => $this->m_laporan->doughnutchart(),
		'radarchart' => $this->m_laporan->radarchart(),
		'tablechart1' => $this->m_laporan->tablechart1(),
		'tablechart2' => $this->m_laporan->tablechart2()

		);
		$this->load->view('v_dashboard_tayang',$x);

	}

	function view2(){
		$dari=$this->input->post('x_dari');
		$sampai=$this->input->post('x_sampai');
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x = array(
		'title'=>'Lapor Bupati Wonosobo',
		'tayang'=>$this->m_home->get_laporan_tayang(),
		'captcha' 		 => $this->recaptcha->getWidget(),
		'script_captcha' => $this->recaptcha->getScriptTag(),
		'jml_laporan' => $this->m_laporan->get_jml_laporan(),
		'jml_diterima' => $this->m_laporan->get_jml_diterima(),
		'jml_diproses' => $this->m_laporan->get_jml_diproses(),
		'jml_ditolak' => $this->m_laporan->get_jml_ditolak(),
		'jml_selesai' => $this->m_laporan->get_jml_selesai(),
		'jml_inbox' => $this->m_laporan->get_jml_inbox(),
		'jml_user' => $this->m_laporan->get_jml_user(),
		'linechart' => $this->m_laporan->linechart(),
		'barchart' => $this->m_laporan->barchart(),
		'piechart' => $this->m_laporan->piechart(),
		'doughnutchart' => $this->m_laporan->doughnutchart(),
		'radarchart' => $this->m_laporan->radarchart(),
		'tablechart1' => $this->m_laporan->tablechart1(),
		'tablechart2' => $this->m_laporan->tablechart2()
		);
		$this->load->view('v_dashboard_tayang2',$x);

	}

	function view3(){
		$dari=$this->input->post('x_dari');
		$sampai=$this->input->post('x_sampai');
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x = array(
		'title'=>'Lapor Bupati Wonosobo',
		'tayang'=>$this->m_home->get_laporan_tayang(),
		'captcha' 		 => $this->recaptcha->getWidget(),
		'script_captcha' => $this->recaptcha->getScriptTag(),
		'jml_laporan' => $this->m_laporan->get_jml_laporan_custome($dari,$sampai),
		'jml_diterima' => $this->m_laporan->get_jml_diterima_custome($dari,$sampai),
		'jml_diproses' => $this->m_laporan->get_jml_diproses_custome($dari,$sampai),
		'jml_ditolak' => $this->m_laporan->get_jml_ditolak_custome($dari,$sampai),
		'jml_selesai' => $this->m_laporan->get_jml_selesai_custome($dari,$sampai),
		'jml_inbox' => $this->m_laporan->get_jml_inbox(),
		'jml_user' => $this->m_laporan->get_jml_user(),
		'linechart_custome' => $this->m_laporan->linechart_custome($dari,$sampai),
		'barchart_custome' => $this->m_laporan->barchart_custome($dari,$sampai),
		'piechart_custome' => $this->m_laporan->piechart_custome($dari,$sampai),
		'doughnutchart_custome' => $this->m_laporan->doughnutchart_custome($dari,$sampai),
		'radarchart_custome' => $this->m_laporan->radarchart_custome($dari,$sampai),
		'tablechart1_custome' => $this->m_laporan->tablechart1_custome($dari,$sampai),
		'tablechart2_custome' => $this->m_laporan->tablechart2_custome($dari,$sampai)
		);
		$this->load->view('v_dashboard_tayang3',$x);

	}

	function detail($id){
		
		$x['title']='Lapor Bupati Wonosobo';
		$x['tayang']=$this->m_home->get_laporan_tayang_detail($id);

		$this->load->view('v_dashboard_tayang_detail',$x);
      //  $this->load->view('v_tes1');

	}

	function get_subkategori_home(){
        $kategori_id = $this->input->get('id',TRUE);
        $data = $this->m_kategori_laporan->get_subkategori_laporan($kategori_id)->result();
        // print_r($data);
        // die;
  		// echo $kategori_id;
		// die;
		echo json_encode($data);
	}



}