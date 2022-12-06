<?php
class Kategori extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata("logged_in") !==TRUE){
        	redirect('login');
        }
		$this->load->model('m_kategori');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_kategori->get_all_kategori();
	//	print_r($x['data']);
		$this->load->view('user/v_kategori',$x);
	}

	function simpan_kategori_laporan(){
		$kategori=strip_tags($this->input->post('xkategori'));
		$this->m_kategori_laporan->simpan_kategori($kategori);
		echo $this->session->set_flashdata('msg','success');
		redirect('user/kategori_laporan');
	}

	function update_kategori_laporan(){
		$kode=strip_tags($this->input->post('kode'));
		$kategori=strip_tags($this->input->post('xkategori'));
		$this->m_kategori_laporan->update_kategori($kode,$kategori);
		echo $this->session->set_flashdata('msg','info');
		redirect('user/kategori_laporan');
	}
	
	function hapus_kategori_laporan(){
		$kode=strip_tags($this->input->post('kode'));
		$this->m_kategori_laporan->hapus_kategori($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('user/kategori_laporan');
	}
	

}