<?php
class Inbox extends CI_Controller{
	function __construct(){
		parent::__construct();
		        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
        }
		$this->load->model('m_kontak');
	}
	
	function index(){
		$x['title']='Inbox';
		$this->m_kontak->update_status_kontak();
		$x['data']=$this->m_kontak->get_all_inbox();
		//print_r($x);
		$this->load->view('admin/v_inbox2',$x);
	}

	function hapus_inbox(){
		$kode=$this->input->post('kode');
		$this->m_kontak->hapus_kontak($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/inbox');
	}
}