<?php
class Kategori_laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_kategori_laporan');
		$this->load->library('upload');
	}
	
	function index(){
		$x['title']='Kategori Laporan';
		$x['data']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$this->load->view('admin/v_kategori_laporan2',$x);
	}

	function simpan_kategori(){
		$kategori=strip_tags($this->input->post('xkategori'));
		$this->m_kategori_laporan->simpan_kategori_laporan($kategori);
		echo $this->session->set_flashdata('msg','success');
		redirect('admin/kategori_laporan');
	}

	function update_kategori(){
		$kode=strip_tags($this->input->post('kode'));
		$kategori=strip_tags($this->input->post('xkategori'));
		$this->m_kategori_laporan->update_kategori_laporan($kode,$kategori);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/kategori_laporan');
	}

	function hapus_kategori(){
		$kode=strip_tags($this->input->post('kode'));
		$this->m_kategori_laporan->hapus_kategori_laporan($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/kategori_laporan');
	}

	function subkategori(){
		$x['title']='Sub-Kategori Laporan';
		$x['data']=$this->m_kategori_laporan->get_all_subkategori_laporan();
		$this->load->view('admin/v_kategori_laporan3',$x);
	}

	function simpan_subkategori(){
		$subkategori=strip_tags($this->input->post('xsubkategori'));
		$this->m_kategori_laporan->simpan_subkategori_laporan($subkategori);
		echo $this->session->set_flashdata('msg','success');
		redirect('admin/kategori_laporan/subkategori');
	}

	function update_subkategori(){
		$kode=strip_tags($this->input->post('kode'));
		$subkategori=strip_tags($this->input->post('xsubkategori'));
		$this->m_kategori_laporan->update_subkategori_laporan($kode,$subkategori);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/kategori_laporan/subkategori');
	}

	function hapus_subkategori(){
		$kode=strip_tags($this->input->post('kode'));
		$this->m_kategori_laporan->hapus_subkategori_laporan($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/kategori_laporan/subkategori');
	}

}