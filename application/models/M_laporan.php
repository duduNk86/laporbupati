<?php
class M_laporan extends CI_Model
{

	function get_all_laporan()
	{
		// $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' ORDER BY nomor DESC");
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan ORDER BY nomor DESC");
		return $hsl;
	}

	function get_all_laporan_verifikasi()
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE laporan_status='1' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_all_laporan_progres()
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE laporan_status='2' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_all_laporan_selesai()
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE laporan_status='3' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_all_laporan_ditolak()
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE laporan_status='99' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_all_notifadmin()
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE laporan_status='1' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_all_laporan_disabilitas()
	{
		$hsl = $this->db->query("SELECT tbl_laporan_disabilitas.*,DATE_FORMAT(created_at,'%d/%m/%Y') AS tanggal FROM tbl_laporan_disabilitas ORDER BY id DESC");
		return $hsl;
	}

	function get_all_notifadmin_disabilitas()
	{
		$hsl = $this->db->query("SELECT tbl_laporan_disabilitas.*,DATE_FORMAT(created_at,'%d/%m/%Y') AS tanggal FROM tbl_laporan_disabilitas WHERE status='1' ORDER BY id DESC");
		return $hsl;
	}

	function get_laporan_by_kode($kode)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_laporan where id='$kode'");
		return $hsl;
	}

	function get_laporan_by_kode_cetak($kode)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_laporan a LEFT JOIN tbl_subkategori_laporan b ON b.subkategori_id = a.subkategori_laporan LEFT JOIN tbl_kategori_laporan c ON c.kategori_id = a.kategori_laporan WHERE id = '$kode'");
		return $hsl;
	}

	//Update Dudunk
	function get_laporan_disabilitas_by_kode($kode)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_laporan_disabilitas where id='$kode'");
		return $hsl;
	}

	function get_laporan_opd($code)
	{
		// $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' ORDER BY nomor DESC");
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_kepada ='$code'AND laporan_status NOT LIKE '1' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_laporan_notifopd($code)
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_kepada ='$code'AND laporan_status ='2' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_laporan_belum_teruskan()
	{
		// $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' ORDER BY nomor DESC");
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE laporan_status ='1' ORDER BY nomor DESC");
		return $hsl;
	}

	function get_tayang($id)
	{
		$hsl = $this->db->query("SELECT *FROM tbl_laporan WHERE id ='$id'");
		return $hsl;
	}

	// Chart JS - Dashboard Admin

	// Statistik Aduan 
	function linechart()
	{
		$hsl = $this->db->query("SELECT
  		EXTRACT(year FROM tanggal_laporan) AS year,
  		COUNT(nomor) AS jumlah_aduan
		FROM tbl_laporan
		GROUP BY EXTRACT(year FROM tanggal_laporan)
		ORDER BY EXTRACT(year FROM tanggal_laporan) ASC");
		return $hsl->result();
	}

	// TOP #10 Aduan Terbanyak pada OPD
	function barchart()
	{
		$this->db->select('ditujukan_kepada');
		$this->db->select('count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->limit('10');
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('total', 'DESC');
		return $this->db->get()->result();
	}

	// function barchart_old()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_laporan');
	// 	$this->db->select('ditujukan_kepada');
	// 	$this->db->select('count(*) as total');
	// 	$this->db->limit('10');
	// 	$this->db->group_by('ditujukan_kepada');
	// 	$this->db->order_by('total', 'DESC');
	// 	return $this->db->get()->result();
	// }

	// Sumber Kanal Aduan
	function piechart2()
	{
		$this->db->select('sumber_aduan');
		$this->db->select('count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->group_by('sumber_aduan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// function piechart2_old()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_laporan');
	// 	$this->db->select('sumber_aduan');
	// 	$this->db->select('count(*) as total');
	// 	$this->db->group_by('sumber_aduan');
	// 	$this->db->order_by('total', 'ASC');
	// 	return $this->db->get()->result();
	// }

	// sql_mode=only_full_group_by
	// Statistik Kategori Aduan
	function piechart()
	{
		$this->db->select('kategori_laporan');
		$this->db->select('COUNT(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->group_by('kategori_laporan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// function piechart_old()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_laporan');
	// 	$this->db->select('kategori_laporan');
	// 	$this->db->select('count(*) as total');
	// 	$this->db->group_by('kategori_laporan');
	// 	$this->db->order_by('total', 'ASC');
	// 	return $this->db->get()->result();
	// }

	// Statistik Sub-Kategori Aduan Infrastruktur
	function doughnutchart()
	{
		$this->db->select('subkategori_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("subkategori_laporan in ('1', '2', '3', '4')");
		$this->db->group_by('subkategori_laporan', 'DESC');
		return $this->db->get()->result();
	}

	// Statistik Sub-Kategori Aduan Non-Infrastruktur
	function radarchart()
	{
		$this->db->select('subkategori_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("subkategori_laporan in ('5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21')");
		$this->db->group_by('subkategori_laporan', 'DESC');
		return $this->db->get()->result();
	}

	// Top #50 Topik Aduan
	function tablechart1()
	{
		$this->db->select('topik_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("topik_laporan != ''");
		$this->db->group_by('topik_laporan');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(50);
		return $this->db->get()->result();
	}

	// Top #50 Jawaban Aduan Terbaik
	function tablechart2()
	{
		$this->db->select('rating_jawaban, SUM(rating_jawaban) as total1');
		$this->db->select('ditujukan_kepada, COUNT(*) as total2');
		$this->db->select('ROUND(SUM(rating_jawaban)/COUNT(*), 0) as hasil_bagi');
		$this->db->from('tbl_laporan');
		$this->db->where("rating_jawaban != ''");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('hasil_bagi', 'DESC');
		$this->db->limit(50);
		return $this->db->get()->result();
	}

	// Top #10 Topik Aduan khusus Dashboard Bupati
	function tablechart1_bupati()
	{
		$this->db->select('topik_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("topik_laporan != ''");
		$this->db->group_by('topik_laporan');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}

	// Top #10 Jawaban Aduan Terbaik khusus Dashboard Bupati
	function tablechart2_bupati()
	{
		$this->db->select('rating_jawaban, SUM(rating_jawaban) as total1');
		$this->db->select('ditujukan_kepada, COUNT(*) as total2');
		$this->db->select('ROUND(SUM(rating_jawaban)/COUNT(*), 0) as hasil_bagi');
		$this->db->from('tbl_laporan');
		$this->db->where("rating_jawaban != ''");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('hasil_bagi', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}

	// Daftar OPD Belum Selesai TL Aduan khusus Dashboard Bupati
	function tablechart3_bupati()
	{
		$this->db->select('ditujukan_kepada, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status = '2'");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('total', 'DESC');
		// $this->db->limit(10);
		return $this->db->get()->result();
	}

	function opd_tlproses()
	{
		$this->db->select('ditujukan_kepada, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status = '2'");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('total', 'DESC');
		// $this->db->limit(10);
		return $this->db->get()->result();
	}

	function opd_tlproses_custome($dari, $sampai)
	{
		$this->db->select('ditujukan_kepada, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status = '2'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('total', 'DESC');
		// $this->db->limit(10);
		return $this->db->get()->result();
	}

	// Chart JS - Dashboard OPD
	// Statistik Aduan
	function linechart_opd($id_kepada)
	{
		$hsl = $this->db->query("SELECT
  		EXTRACT(year FROM tanggal_laporan) AS year,
  		COUNT(nomor) AS jumlah_aduan
		FROM tbl_laporan
		WHERE id_kepada = '$id_kepada'
		GROUP BY EXTRACT(year FROM tanggal_laporan)
		ORDER BY EXTRACT(year FROM tanggal_laporan) ASC");
		return $hsl->result();
	}

	// Statistik Kategori Aduan
	function piechart_opd($id_kepada)
	{
		$this->db->select('kategori_laporan');
		$this->db->select('COUNT(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->group_by('kategori_laporan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// sql_mode=only_full_group_by
	// function piechart_opd_old($id_kepada)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_laporan');
	// 	$this->db->select('kategori_laporan');
	// 	$this->db->select('count(*) as total');
	// 	$this->db->where("id_kepada ='$id_kepada'");
	// 	$this->db->group_by('kategori_laporan');
	// 	$this->db->order_by('total', 'ASC');
	// 	return $this->db->get()->result();
	// }

	// Sumber Kanal Aduan
	function piechart2_opd($id_kepada)
	{
		$this->db->select('sumber_aduan');
		$this->db->select('count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->group_by('sumber_aduan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// function piechart2_opd_old($id_kepada)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_laporan');
	// 	$this->db->select('sumber_aduan');
	// 	$this->db->select('count(*) as total');
	// 	$this->db->where("id_kepada ='$id_kepada'");
	// 	$this->db->group_by('sumber_aduan');
	// 	$this->db->order_by('total', 'ASC');
	// 	return $this->db->get()->result();
	// }

	// Top #10 Topik Aduan
	function tablechart1_opd($id_kepada)
	{
		$this->db->select('topik_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->where("topik_laporan != ''");
		$this->db->group_by('topik_laporan');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}

	// Rating Jawaban Tindak Lanjut
	function tablechart2_opd($id_kepada)
	{
		$this->db->select('rating_jawaban, SUM(rating_jawaban) as total1');
		$this->db->select('ditujukan_kepada, COUNT(*) as total2');
		$this->db->select('ROUND(SUM(rating_jawaban)/COUNT(*), 0) as hasil_bagi');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->where("rating_jawaban != ''");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('hasil_bagi', 'DESC');
		return $this->db->get()->result();
	}


	// Chart JS - Dashboard Admin 2 (Custom Statistik)
	// Statistik Aduan
	function linechart_custome($dari, $sampai)
	{
		$hsl = $this->db->query("SELECT
	  	EXTRACT(month FROM tanggal_laporan) AS month,
	  	EXTRACT(year FROM tanggal_laporan) AS year,
	  	COUNT(nomor) AS jumlah_aduan
		FROM tbl_laporan
		WHERE tanggal_laporan >= '$dari' AND tanggal_laporan <= '$sampai'
		GROUP BY EXTRACT(year FROM tanggal_laporan), EXTRACT(month FROM tanggal_laporan)");
		return $hsl->result();
	}

	function linechart_custome_bulan($dari, $sampai)
	{
		$hsl = $this->db->query("SELECT
	  	EXTRACT(day FROM tanggal_laporan) AS day,
	  	EXTRACT(month FROM tanggal_laporan) AS month,
	  	EXTRACT(year FROM tanggal_laporan) AS year,
	  	COUNT(nomor) AS jumlah_aduan
		FROM tbl_laporan
		WHERE tanggal_laporan >= '$dari' AND tanggal_laporan <= '$sampai'
		GROUP BY EXTRACT(year FROM tanggal_laporan), EXTRACT(month FROM tanggal_laporan), EXTRACT(day FROM tanggal_laporan)");
		return $hsl->result();
	}

	// Sumber Kanal Aduan
	function piechart2_custome($dari, $sampai)
	{
		$this->db->select('sumber_aduan, COUNT(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->group_by('sumber_aduan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// TOP #10 Perangkat Daerah
	function barchart_custome($dari, $sampai)
	{
		$this->db->select('ditujukan_kepada, COUNT(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	// Statistik Kategori Aduan
	function piechart_custome($dari, $sampai)
	{
		$this->db->select('kategori_laporan, COUNT(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->group_by('kategori_laporan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// Statistik Sub-Kategori Aduan Infrastruktur
	function doughnutchart_custome($dari, $sampai)
	{
		$this->db->select('subkategori_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("subkategori_laporan in ('1', '2', '3', '4')");
		$this->db->group_by('subkategori_laporan', 'DESC');
		return $this->db->get()->result();
	}

	// Statistik Sub-Kategori Aduan Non-Infrastruktur
	function radarchart_custome($dari, $sampai)
	{
		$this->db->select('subkategori_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("subkategori_laporan in ('5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21')");
		$this->db->group_by('subkategori_laporan', 'DESC');
		return $this->db->get()->result();
	}

	// Top #50 Topik Aduan
	function tablechart1_custome($dari, $sampai)
	{
		$this->db->select('topik_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("topik_laporan != ''");
		$this->db->group_by('topik_laporan');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(50);
		return $this->db->get()->result();
	}

	// Top #50 Jawaban Aduan Terbaik
	function tablechart2_custome($dari, $sampai)
	{
		$this->db->select('rating_jawaban, SUM(rating_jawaban) as total1');
		$this->db->select('ditujukan_kepada, COUNT(*) as total2');
		$this->db->select('ROUND(SUM(rating_jawaban)/COUNT(*), 0) as hasil_bagi');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("rating_jawaban != ''");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('hasil_bagi', 'DESC');
		$this->db->limit(50);
		return $this->db->get()->result();
	}

	// Top #10 Topik Aduan khusus Dashboard Bupati
	function tablechart1_custome_bupati($dari, $sampai)
	{
		$this->db->select('topik_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("topik_laporan != ''");
		$this->db->group_by('topik_laporan');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}

	// Top #10 Jawaban Aduan Terbaik khusus Dashboard Bupati
	function tablechart2_custome_bupati($dari, $sampai)
	{
		$this->db->select('rating_jawaban, SUM(rating_jawaban) as total1');
		$this->db->select('ditujukan_kepada, COUNT(*) as total2');
		$this->db->select('ROUND(SUM(rating_jawaban)/COUNT(*), 0) as hasil_bagi');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("rating_jawaban != ''");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('hasil_bagi', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}

	// Daftar OPD Belum Selesai TL Aduan khusus Dashboard Bupati
	function tablechart3_custome_bupati($dari, $sampai)
	{
		$this->db->select('ditujukan_kepada, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status = '2'");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(50);
		return $this->db->get()->result();
	}

	// Chart JS - Dashboard OPD 2 (Custom Statistik)
	// Statistik Aduan
	function linechart_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('EXTRACT(MONTH FROM tanggal_laporan) AS month');
		$this->db->select('EXTRACT(YEAR FROM tanggal_laporan) AS year');
		$this->db->select('COUNT(nomor) AS jumlah_aduan');
		$this->db->from('tbl_laporan');
		$this->db->where('id_kepada', $id_kepada);
		$this->db->where("tanggal_laporan >= '$dari' AND tanggal_laporan <= '$sampai'");
		$this->db->group_by('EXTRACT(YEAR FROM tanggal_laporan), EXTRACT(MONTH FROM tanggal_laporan)');

		$query = $this->db->get();
		return $query->result();
	}

	function linechart_opd_custome_bulan($id_kepada, $dari, $sampai)
	{
		$this->db->select('EXTRACT(DAY FROM tanggal_laporan) AS day');
		$this->db->select('EXTRACT(MONTH FROM tanggal_laporan) AS month');
		$this->db->select('EXTRACT(YEAR FROM tanggal_laporan) AS year');
		$this->db->select('COUNT(nomor) AS jumlah_aduan');
		$this->db->from('tbl_laporan');
		$this->db->where('id_kepada', $id_kepada);
		$this->db->where("tanggal_laporan >= '$dari' AND tanggal_laporan <= '$sampai'");
		$this->db->group_by('EXTRACT(YEAR FROM tanggal_laporan), EXTRACT(MONTH FROM tanggal_laporan), EXTRACT(DAY FROM tanggal_laporan)');

		$query = $this->db->get();
		return $query->result();
	}

	// Sumber Kanal Aduan
	function piechart2_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('sumber_aduan, COUNT(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->group_by('sumber_aduan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// Statistik Kategori Aduan
	function piechart_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('kategori_laporan, COUNT(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->group_by('kategori_laporan');
		$this->db->order_by('total', 'ASC');
		return $this->db->get()->result();
	}

	// Top #10 Topik Aduan
	function tablechart1_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('topik_laporan, count(*) as total');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("topik_laporan != ''");
		$this->db->group_by('topik_laporan');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}

	// Rating Jawaban Tindak Lanjut OPD
	function tablechart2_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('rating_jawaban, SUM(rating_jawaban) as total1');
		$this->db->select('ditujukan_kepada, COUNT(*) as total2');
		$this->db->select('ROUND(SUM(rating_jawaban)/COUNT(*), 0) as hasil_bagi');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada ='$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("rating_jawaban != ''");
		$this->db->group_by('ditujukan_kepada');
		$this->db->order_by('hasil_bagi', 'DESC');
		return $this->db->get()->result();
	}

	// Dashboard Rekapitulasi Penanganan Aduan All
	function get_jml_laporan()
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		return $this->db->get()->num_rows();
	}

	function get_jml_diterima()
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status ='1'");
		return $this->db->get()->num_rows();
	}

	function get_jml_diproses()
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status ='2'");
		return $this->db->get()->num_rows();
	}

	function get_jml_ditolak()
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status ='99'");
		return $this->db->get()->num_rows();
	}

	function get_jml_selesai()
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status ='3'");
		return $this->db->get()->num_rows();
	}

	function get_durasi_tl()
	{
		$this->db->select('tanggal_laporan, tanggal_tindaklanjut');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_tindaklanjut IS NOT NULL', null, false);
		$this->db->where('laporan_status', '3');
		$query = $this->db->get();

		$totalDetik = 0;
		$jumlahBarisDenganDurasiValid = 0;

		foreach ($query->result() as $row) {
			$tanggalLaporan = new DateTime($row->tanggal_laporan);
			$tanggalTindaklanjut = new DateTime($row->tanggal_tindaklanjut);

			if ($tanggalLaporan < $tanggalTindaklanjut) {
				$durasi = $tanggalLaporan->diff($tanggalTindaklanjut);
				$totalDetik += $durasi->days * 24 * 60 * 60 + $durasi->h * 60 * 60 + $durasi->i * 60 + $durasi->s;
				$jumlahBarisDenganDurasiValid++;
			}
		}

		if ($jumlahBarisDenganDurasiValid > 0) {
			$durasiRataRata = round($totalDetik / $jumlahBarisDenganDurasiValid);

			// Hitung jumlah hari, jam, menit, dan detik
			$hari = floor($durasiRataRata / (24 * 60 * 60));
			$jam = floor(($durasiRataRata % (24 * 60 * 60)) / (60 * 60));
			$menit = floor(($durasiRataRata % (60 * 60)) / 60);
			// $detik = $durasiRataRata % 60;

			// $rataRataWaktu = "{$hari} hari, {$jam} jam, {$menit} menit, {$detik} detik";
			$rataRataWaktu = "{$hari} h {$jam} j {$menit} m";
			return $rataRataWaktu;
		} else {
			return 'Tidak ada data';
		}
	}

	// Dashboard Rekapitulasi Penanganan Aduan All per OPD masing-masing
	function get_jml_laporan_opd($id_kepada)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		return $this->db->get()->num_rows();
	}

	function get_jml_diterima_opd($id_kepada)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where("laporan_status ='1'");
		return $this->db->get()->num_rows();
	}

	function get_jml_diproses_opd($id_kepada)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where("laporan_status ='2'");
		return $this->db->get()->num_rows();
	}

	function get_jml_ditolak_opd($id_kepada)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where("laporan_status ='99'");
		return $this->db->get()->num_rows();
	}

	function get_jml_selesai_opd($id_kepada)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where("laporan_status ='3'");
		return $this->db->get()->num_rows();
	}

	function get_durasi_tl_opd($id_kepada)
	{
		$this->db->select('tanggal_laporan, tanggal_tindaklanjut');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_tindaklanjut IS NOT NULL', null, false);
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where('laporan_status', '3');
		$query = $this->db->get();

		$totalDetik = 0;
		$jumlahBarisDenganDurasiValid = 0;

		foreach ($query->result() as $row) {
			$tanggalLaporan = new DateTime($row->tanggal_laporan);
			$tanggalTindaklanjut = new DateTime($row->tanggal_tindaklanjut);

			if ($tanggalLaporan < $tanggalTindaklanjut) {
				$durasi = $tanggalLaporan->diff($tanggalTindaklanjut);
				$totalDetik += $durasi->days * 24 * 60 * 60 + $durasi->h * 60 * 60 + $durasi->i * 60 + $durasi->s;
				$jumlahBarisDenganDurasiValid++;
			}
		}

		if ($jumlahBarisDenganDurasiValid > 0) {
			$durasiRataRata = round($totalDetik / $jumlahBarisDenganDurasiValid);

			// Hitung jumlah hari, jam, menit, dan detik
			$hari = floor($durasiRataRata / (24 * 60 * 60));
			$jam = floor(($durasiRataRata % (24 * 60 * 60)) / (60 * 60));
			$menit = floor(($durasiRataRata % (60 * 60)) / 60);
			// $detik = $durasiRataRata % 60;

			// $rataRataWaktu = "{$hari} hari, {$jam} jam, {$menit} menit, {$detik} detik";
			$rataRataWaktu = "{$hari} h {$jam} j {$menit} m";
			return $rataRataWaktu;
		} else {
			return 'Tidak ada data';
		}
	}

	// Dashboard Admin Rekapitulasi Penanganan Aduan Custome
	function get_jml_laporan_custome($dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		return $this->db->get()->num_rows();
	}

	function get_jml_diterima_custome($dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='1'");
		return $this->db->get()->num_rows();
	}

	function get_jml_diproses_custome($dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='2'");
		return $this->db->get()->num_rows();
	}

	function get_jml_ditolak_custome($dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='99'");
		return $this->db->get()->num_rows();
	}

	function get_jml_selesai_custome($dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='3'");
		return $this->db->get()->num_rows();
	}

	function get_durasi_tl_custome($dari, $sampai)
	{
		$this->db->select('tanggal_laporan, tanggal_tindaklanjut');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_tindaklanjut IS NOT NULL', null, false);
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where('laporan_status', '3');
		$query = $this->db->get();

		$totalDetik = 0;
		$jumlahBarisDenganDurasiValid = 0;

		foreach ($query->result() as $row) {
			$tanggalLaporan = new DateTime($row->tanggal_laporan);
			$tanggalTindaklanjut = new DateTime($row->tanggal_tindaklanjut);

			if ($tanggalLaporan < $tanggalTindaklanjut) {
				$durasi = $tanggalLaporan->diff($tanggalTindaklanjut);
				$totalDetik += $durasi->days * 24 * 60 * 60 + $durasi->h * 60 * 60 + $durasi->i * 60 + $durasi->s;
				$jumlahBarisDenganDurasiValid++;
			}
		}

		if ($jumlahBarisDenganDurasiValid > 0) {
			$durasiRataRata = round($totalDetik / $jumlahBarisDenganDurasiValid);

			// Hitung jumlah hari, jam, menit, dan detik
			$hari = floor($durasiRataRata / (24 * 60 * 60));
			$jam = floor(($durasiRataRata % (24 * 60 * 60)) / (60 * 60));
			$menit = floor(($durasiRataRata % (60 * 60)) / 60);
			// $detik = $durasiRataRata % 60;

			// $rataRataWaktu = "{$hari} hari, {$jam} jam, {$menit} menit, {$detik} detik";
			$rataRataWaktu = "{$hari} h {$jam} j {$menit} m";
			return $rataRataWaktu;
		} else {
			return 'Tidak ada data';
		}
	}

	// Dashboard OPD Rekapitulasi Penanganan Aduan Custome
	function get_jml_laporan_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		return $this->db->get()->num_rows();
	}

	function get_jml_diterima_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='1'");
		return $this->db->get()->num_rows();
	}

	function get_jml_diproses_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='2'");
		return $this->db->get()->num_rows();
	}

	function get_jml_ditolak_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='99'");
		return $this->db->get()->num_rows();
	}

	function get_jml_selesai_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where("laporan_status ='3'");
		return $this->db->get()->num_rows();
	}

	function get_durasi_tl_opd_custome($id_kepada, $dari, $sampai)
	{
		$this->db->select('tanggal_laporan, tanggal_tindaklanjut');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_tindaklanjut IS NOT NULL', null, false);
		$this->db->where("id_kepada = '$id_kepada'");
		$this->db->where('tanggal_laporan >=', $dari);
		$this->db->where('tanggal_laporan <=', $sampai);
		$this->db->where('laporan_status', '3');
		$query = $this->db->get();

		$totalDetik = 0;
		$jumlahBarisDenganDurasiValid = 0;

		foreach ($query->result() as $row) {
			$tanggalLaporan = new DateTime($row->tanggal_laporan);
			$tanggalTindaklanjut = new DateTime($row->tanggal_tindaklanjut);

			if ($tanggalLaporan < $tanggalTindaklanjut) {
				$durasi = $tanggalLaporan->diff($tanggalTindaklanjut);
				$totalDetik += $durasi->days * 24 * 60 * 60 + $durasi->h * 60 * 60 + $durasi->i * 60 + $durasi->s;
				$jumlahBarisDenganDurasiValid++;
			}
		}

		if ($jumlahBarisDenganDurasiValid > 0) {
			$durasiRataRata = round($totalDetik / $jumlahBarisDenganDurasiValid);

			// Hitung jumlah hari, jam, menit, dan detik
			$hari = floor($durasiRataRata / (24 * 60 * 60));
			$jam = floor(($durasiRataRata % (24 * 60 * 60)) / (60 * 60));
			$menit = floor(($durasiRataRata % (60 * 60)) / 60);
			// $detik = $durasiRataRata % 60;

			// $rataRataWaktu = "{$hari} hari, {$jam} jam, {$menit} menit, {$detik} detik";
			$rataRataWaktu = "{$hari} h {$jam} j {$menit} m";
			return $rataRataWaktu;
		} else {
			return 'Tidak ada data';
		}
	}

	// Dashboard Jumlah Inbox & User (Seluruh & Custome)
	function get_jml_inbox()
	{
		$this->db->select('*');
		$this->db->from('tbl_inbox');
		return $this->db->get()->num_rows();
	}

	function get_jml_user()
	{
		$this->db->select('*');
		$this->db->from('tbl_admin');
		return $this->db->get()->num_rows();
	}

	// Dashboard Bupati
	function get_jml_tayang_dashboard_bupati()
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("tayang ='ya'");
		return $this->db->get()->num_rows();
	}

	function get_jml_prosestl_dashboard_bupati()
	{
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where("laporan_status ='2'");
		$this->db->where("tayang ='ya'");
		return $this->db->get()->num_rows();
	}


	function simpan_laporan($id, $id_pelapor, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $nama, $email, $hp, $gambar, $laporan_status, $keterangan_status, $status)
	{
		$hsl = $this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,foto,laporan_status,keterangan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$gambar','$laporan_status','$keterangan_status','$status')");
		return $hsl;
	}

	function simpan_laporan_noimg($id, $id_pelapor, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $nama, $email, $hp, $laporan_status, $keterangan_status, $status)
	{
		$hsl = $this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,laporan_status,keterangan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$laporan_status','$keterangan_status','$status')");
		return $hsl;
	}

	function simpan_laporan_tambahan($id, $id_pelapor, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $nama, $email, $hp, $gambar, $laporan_status, $keterangan_status, $status, $tambahan)
	{
		$hsl = $this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,foto,laporan_status,keterangan_status,status,tambahan) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$gambar','$laporan_status','$keterangan_status','$status','$tambahan')");
		return $hsl;
	}

	function simpan_laporan_noimg_tambahan($id, $id_pelapor, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $nama, $email, $hp, $laporan_status, $keterangan_status, $status, $tambahan)
	{
		$hsl = $this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,laporan_status,keterangan_status,status,tambahan) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$laporan_status','$keterangan_status','$status','$tambahan')");
		return $hsl;
	}

	function simpan_laporan_user($id, $id_pelapor, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $nama, $alamat, $email, $hp, $gambar, $laporan_status, $status)
	{
		$hsl = $this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,alamat,email,hp,foto,laporan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$alamat','$email','$hp','$gambar','$laporan_status','$status')");
		return $hsl;
	}

	function simpan_laporan_user_noimg($id, $id_pelapor, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $nama, $alamat, $email, $hp, $laporan_status, $status)
	{
		$hsl = $this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,alamat,email,hp,laporan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$alamat','$email','$hp','$laporan_status','$status')");
		return $hsl;
	}

	function update_laporan($id_laporan, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $gambar, $laporan_status, $keterangan_status)
	{
		$hsl = $this->db->query("update tbl_laporan set 
			id_kepada='$id_kepada',
			ditujukan_kepada='$ditujukan_kepada',
			id_komisi='$id_komisi',
			kategori_laporan='$kategori_laporan',
			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			id_jenis='$id_jenis',
			isi_laporan='$isi_laporan', 
			foto='$gambar', 
			laporan_status='$laporan_status',
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}

	function update_laporan_noimg($id_laporan, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $isi_laporan, $laporan_status, $keterangan_status)
	{
		$hsl = $this->db->query("update tbl_laporan set 
			id_kepada='$id_kepada',
			ditujukan_kepada='$ditujukan_kepada',
			id_komisi='$id_komisi',
			kategori_laporan='$kategori_laporan',
			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			id_jenis='$id_jenis',
			isi_laporan='$isi_laporan',
			laporan_status='$laporan_status', 
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}

	function update_laporan_admin2(
		$id_laporan,
		$judul_laporan,
		$anggaran,
		$lokasi,
		$isi_laporan,
		$gambar,
		$laporan_status,
		$keterangan_status
	) {
		$hsl = $this->db->query("update tbl_laporan set 

			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			isi_laporan='$isi_laporan', 
			foto='$gambar',
			laporan_status='$laporan_status', 
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}

	function update_laporan_noimg_admin2(
		$id_laporan,
		$judul_laporan,
		$anggaran,
		$lokasi,
		$isi_laporan,
		$laporan_status,
		$keterangan_status
	) {
		$hsl = $this->db->query("update tbl_laporan set 
			
			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			isi_laporan='$isi_laporan',
			laporan_status='$laporan_status', 
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}

	function update_laporan_user($id_laporan, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan, $gambar)
	{
		$hsl = $this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan', foto='$gambar' where id='$id_laporan'");
		return $hsl;
	}

	function update_laporan_user_noimg($id_laporan, $id_kepada, $ditujukan_kepada, $id_komisi, $kategori_laporan, $judul_laporan, $anggaran, $lokasi, $id_jenis, $isi_laporan)
	{
		$hsl = $this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan' where id='$id_laporan'");
		return $hsl;
	}

	function update_status($id, $laporan_status, $keterangan_status)
	{
		$hsl = $this->db->query("update tbl_laporan set laporan_status='$laporan_status',keterangan_status='$keterangan_status' where id='$id'");
		return $hsl;
	}

	function view_laporan_byid($kode)
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id_pelapor='$kode'");
		return $hsl;
	}

	function view_laporan_komisi($kode)
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id_komisi='$kode'");
		return $hsl;
	}


	function view_laporan_selesai($kode)
	{
		$hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where laporan_status='$kode' ORDER BY tanggal_laporan DESC");
		return $hsl;
	}

	function xapi($id = null)
	{
		if ($id === null) {
			return $this->db->query("SELECT 
			tbl_laporan.id,
			tbl_laporan.id_kepada id_anggota,
            tbl_laporan.ditujukan_kepada x_lewat,
            tbl_laporan.judul_laporan x_judul,
            tbl_laporan.isi_laporan x_rincian_kegiatan,
            tbl_laporan.lokasi x_lokasi,
            tbl_laporan.anggaran x_anggaran,
            tbl_laporan.nama x_dari,
            tbl_laporan.alamat x_alamat,
            tbl_laporan.email x_email,
            tbl_laporan.hp x_hp,
            tbl_laporan.status x_status,    
          
			DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS x_tanggal FROM tbl_laporan where status='1'")->result_array();
		} else
			return $this->db->query("SELECT 
	    	tbl_laporan.id,
			tbl_laporan.id_kepada id_anggota,
            tbl_laporan.ditujukan_kepada x_lewat,
            tbl_laporan.judul_laporan x_judul,
            tbl_laporan.isi_laporan x_rincian_kegiatan,
            tbl_laporan.lokasi x_lokasi,
            tbl_laporan.anggaran x_anggaran,
            tbl_laporan.nama x_dari,
            tbl_laporan.alamat x_alamat,
            tbl_laporan.email x_email,
            tbl_laporan.hp x_hp,
            tbl_laporan.status x_status,  


	    	DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where status='1' AND id_kepada='$id'")->result_array();
	}

	function status($id, $status)
	{
		$hsl = $this->db->query("update tbl_laporan set status='$status' where id='$id'");
		return $hsl;
	}



	function hapus_laporan($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_laporan where id='$kode'");
		return $hsl;
	}

	//Update Dudunk
	function hapus_laporan_disabilitas($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_laporan_disabilitas where id='$kode'");
		return $hsl;
	}

	function get_jml()
	{
		$hsl = "SELECT sum(id_penginput) as komisi FROM tbl_laporan";
		$result = $this->db->query($hsl);
		return $result->row()->komisi;
	}


	//Front-End

	function get_post_home()
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d %M %Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC limit 3");
		return $hsl;
	}

	function get_berita_slider()
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_img_slider='1' ORDER BY tulisan_id DESC");
		return $hsl;
	}

	function berita_perpage($offset, $limit)
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC limit $offset,$limit");
		return $hsl;
	}

	function berita()
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC");
		return $hsl;
	}
	function get_berita_by_slug($slug)
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_slug='$slug'");
		return $hsl;
	}

	function get_tulisan_by_kategori($kategori_id)
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_kategori_id='$kategori_id'");
		return $hsl;
	}

	function get_tulisan_by_kategori_perpage($kategori_id, $offset, $limit)
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_kategori_id='$kategori_id' limit $offset,$limit");
		return $hsl;
	}

	function search_tulisan($keyword)
	{
		$hsl = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan WHERE tulisan_judul LIKE '%$keyword%'");
		return $hsl;
	}

	function post_komentar($nama, $email, $web, $msg, $tulisan_id)
	{
		$hsl = $this->db->query("INSERT INTO tbl_komentar (komentar_nama,komentar_email,komentar_web,komentar_isi,komentar_tulisan_id) VALUES ('$nama','$email','$web','$msg','$tulisan_id')");
		return $hsl;
	}


	function count_views($kode)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$cek_ip = $this->db->query("SELECT * FROM tbl_post_views WHERE views_ip='$user_ip' AND views_tulisan_id='$kode' AND DATE(views_tanggal)=CURDATE()");
		if ($cek_ip->num_rows() <= 0) {
			$this->db->trans_start();
			$this->db->query("INSERT INTO tbl_post_views (views_ip,views_tulisan_id) VALUES('$user_ip','$kode')");
			$this->db->query("UPDATE tbl_tulisan SET tulisan_views=tulisan_views+1 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if ($this->db->trans_status() == TRUE) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	//Count rating Good
	function count_good($kode)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$cek_ip = $this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
		if ($cek_ip->num_rows() <= 0) {
			$this->db->trans_start();
			$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','1','$kode')");
			$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+1 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if ($this->db->trans_status() == TRUE) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	//Count rating Like
	function count_like($kode)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$cek_ip = $this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
		if ($cek_ip->num_rows() <= 0) {
			$this->db->trans_start();
			$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','2','$kode')");
			$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+2 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if ($this->db->trans_status() == TRUE) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	//Count rating Like
	function count_love($kode)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$cek_ip = $this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
		if ($cek_ip->num_rows() <= 0) {
			$this->db->trans_start();
			$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','3','$kode')");
			$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+3 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if ($this->db->trans_status() == TRUE) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	//Count rating Like
	function count_genius($kode)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$cek_ip = $this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
		if ($cek_ip->num_rows() <= 0) {
			$this->db->trans_start();
			$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','4','$kode')");
			$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+4 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if ($this->db->trans_status() == TRUE) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	function cek_ip_rate($kode)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$hsl = $this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
		return $hsl;
	}

	function get_tulisan_populer()
	{
		$hasil = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d %M %Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_views DESC limit 10");
		return $hasil;
	}

	function get_tulisan_terbaru()
	{
		$hasil = $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d %M %Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC limit 10");
		return $hasil;
	}

	function get_kategori_for_blog()
	{
		$hasil = $this->db->query("SELECT COUNT(tulisan_kategori_id) AS jml,kategori_id,kategori_nama FROM tbl_tulisan JOIN tbl_kategori ON tulisan_kategori_id=kategori_id GROUP BY tulisan_kategori_id");
		return $hasil;
	}
}
