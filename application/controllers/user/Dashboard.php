<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();

        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('login');
        }
		$this->load->model('m_pengunjung');
		$this->load->model('m_dashboard');
		 $this->load->library('Mobile_Detect');
	}
	
	function index(){
			$x['visitor'] = $this->m_pengunjung->statistik_pengujung();
			$x['total_laporan'] = $this->m_dashboard->total_laporan();
			//echo print_r($x);
			$this->load->view('user/v_dashboard',$x);
	}
////////////////////////////mobile deteksi/////////////////////////////////////
	public function deteksi()
    {
        $data['judul'] = 'Halaman Utama';
        $detect = new Mobile_Detect;
        $this->load->view('v_home', $data);
        
        if($detect->isMobile()) {
            redirect('http://m.blabla.com');
        }
    }
	
}