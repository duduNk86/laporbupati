<?php
class M_home extends CI_Model{


	function get_laporan_tayang(){
		// $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' ORDER BY nomor DESC");
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE tayang = 'ya' ORDER BY nomor DESC");
		return $hsl;
	}
	
	function get_laporan_tayang_detail($id){
		// $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' ORDER BY nomor DESC");
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id='$id'");
		return $hsl;
	}
	
}