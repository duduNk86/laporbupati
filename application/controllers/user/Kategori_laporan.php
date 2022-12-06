<?php
class Kategori_laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata("logged_in") !==TRUE){
        	redirect('login');
        };
		$this->load->model('m_kategori_laporan');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_kategori_laporan->get_all_kategori_laporan();
		//print_r($x);
		$this->load->view('user/v_kategori_laporan',$x);
	}

	function simpan_kategori(){
		$kategori=strip_tags($this->input->post('xkategori'));
		$this->m_kategori_laporan->simpan_kategori_laporan($kategori);
		echo $this->session->set_flashdata('msg','success');
		redirect('user/kategori');
	}

	function update_kategori(){
		$kode=strip_tags($this->input->post('kode'));
		$kategori=strip_tags($this->input->post('xkategori'));
		$this->m_kategori_laporan->update_kategori_laporan($kode,$kategori);
		echo $this->session->set_flashdata('msg','info');
		redirect('user/kategori');
	}
	function hapus_kategori(){
		$kode=strip_tags($this->input->post('kode'));
		$this->m_kategori_laporan->hapus_kategori_laporan($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('user/kategori');
	}
	

}