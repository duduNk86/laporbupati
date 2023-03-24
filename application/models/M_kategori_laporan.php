<?php
class M_kategori_laporan extends CI_Model{

	function get_all_kategori_laporan(){
		$hsl=$this->db->query("select * from tbl_kategori_laporan");
		return $hsl;
	}

	// function get_all_subkategori_laporan(){
	// 	$hsl=$this->db->query("select * from tbl_subkategori_laporan");
	// 	return $hsl;
	// }	
	
	function get_all_subkategori_laporan(){
    	$hsl = $this->db->query("SELECT * FROM tbl_subkategori_laporan JOIN tbl_kategori_laporan ON subkategori_kategori_id=kategori_id GROUP BY subkategori_id ORDER BY subkategori_id ASC");
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

	function simpan_subkategori_laporan($subkategori){
		$hsl=$this->db->query("insert into tbl_subkategori_laporan(subkategori_nama) values('$subkategori')");
		return $hsl;
	}

	function update_subkategori_laporan($kode,$subkategori){
		$hsl=$this->db->query("update tbl_subkategori_laporan set subkategori_nama='$subkategori' where subkategori_id='$kode'");
		return $hsl;
	}

	function hapus_subkategori_laporan($kode){
		$hsl=$this->db->query("delete from tbl_subkategori_laporan where subkategori_id='$kode'");
		return $hsl;
	}

	function get_kategori_byid_laporan($kategori_id){
		$hsl=$this->db->query("select * from tbl_kategori_laporan where kategori_id='$kategori_id'");
		return $hsl;
	}

	function get_subkategori_laporan($kategori_id){
		// return $kategori_id;
        // $hsl=$this->db->query("select * from tbl_subkategori_laporan where subkategori_kategori_id='$kategori_id'");
        $hsl = $this->db->get_where('tbl_subkategori_laporan', array('subkategori_kategori_id' => $kategori_id));
        return $hsl;
    }

}