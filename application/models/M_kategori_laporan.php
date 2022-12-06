<?php
class M_kategori_laporan extends CI_Model{

	function get_all_kategori_laporan(){
		$hsl=$this->db->query("select * from tbl_kategori_laporan");
		return $hsl;
	}
	
	function simpan_kategori_laporan($kategori){
		$hsl=$this->db->query("insert into tbl_kategori_laporan(kategori_nama) values('$kategori')");
		return $hsl;
	}
	function update_kategori_laporan($kode,$kategori){
		$hsl=$this->db->query("update tbl_kategori_laporan set kategori_nama='$kategori' where kategori_id='$kode'");
		return $hsl;
	}
	function hapus_kategori_laporan($kode){
		$hsl=$this->db->query("delete from tbl_kategori_laporan where kategori_id='$kode'");
		return $hsl;
	}
	function get_kategori_byid_laporan($kategori_id){
		$hsl=$this->db->query("select * from tbl_kategori_laporan where kategori_id='$kategori_id'");
		return $hsl;
	}

}