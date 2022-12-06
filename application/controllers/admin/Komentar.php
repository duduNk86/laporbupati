<?php
class Komentar extends CI_Controller{
	function __construct(){
		parent::__construct();
        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
        }
		$this->load->model('m_komentar');
		
	}

	function index(){
		$x['title']='Komentar';
		$x['data']=$this->m_komentar->get_komentar();
		$this->load->view('admin/v_komentar2',$x);
	} 

	function reply(){
		$kode=$this->input->post('kode');
		$tulisan_id=$this->input->post('tulisan_id');
		$komentar=strip_tags(str_replace("'", "", htmlspecialchars($this->input->post('komentar',TRUE))));
		$this->m_komentar->reply_komentar($kode,$komentar,$tulisan_id);
		echo $this->session->set_flashdata('msg','success');
		redirect('admin/komentar');
	}

	function publish(){
		$kode=$this->input->post('kode');
		$this->m_komentar->publish_komentar($kode);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/komentar');
	}

	function hapus_komentar(){
		$kode=$this->input->post('kode');
		$this->m_komentar->hapus_komentar($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/komentar');
	}
} 