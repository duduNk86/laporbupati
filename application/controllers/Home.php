<?php 
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_home');
	}

	function index(){
		$x = array(
		'title'=>'Lapor Bupati Wonosobo',
		'tayang'=>$this->m_home->get_laporan_tayang(),
		'captcha' 		 => $this->recaptcha->getWidget(),
		'script_captcha' => $this->recaptcha->getScriptTag()
		);
		// $this->load->view('v_dashboard_tayang',$x);
		$this->load->view('v_aduan_new',$x);
      //  $this->load->view('v_tes1');

	}
	
	function view(){
		$x = array(
		'title'=>'Lapor Bupati Wonosobo',
		'tayang'=>$this->m_home->get_laporan_tayang(),
		'captcha' 		 => $this->recaptcha->getWidget(),
		'script_captcha' => $this->recaptcha->getScriptTag()
		);
		$this->load->view('v_dashboard_tayang',$x);

	}

	function detail($id){
		
		$x['title']='Lapor Bupati Wonosobo';
		$x['tayang']=$this->m_home->get_laporan_tayang_detail($id);

		$this->load->view('v_dashboard_tayang_detail',$x);
      //  $this->load->view('v_tes1');

	}



}