<?php
class M_home extends CI_Model
{


    function get_laporan_tayang()
    {
        // $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' ORDER BY nomor DESC");
        $hsl = $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE tayang = 'ya' ORDER BY nomor DESC");
        return $hsl;
    }

    function get_laporan_tayang_detail($id)
    {
        // $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' ORDER BY nomor DESC");
        // $hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id='$id'");
        // return $hsl;
        $id = $this->db->escape_str($id); // Mencegah SQL injection
        $hsl = $this->db->query("SELECT a.*, b.opd, DATE_FORMAT(a.tanggal_laporan, '%d/%m/%Y') AS tanggal FROM tbl_laporan a LEFT JOIN tbl_opd b ON b.id_opd = a.id_kepada WHERE a.id = '$id'");
        return $hsl;
    }

    // Chart JS - Dashboard Admin
    function linechart()
    {
        $hsl = $this->db->query("SELECT
  		EXTRACT(year FROM tanggal_laporan) AS year,
  		COUNT(nomor) AS jumlah_aduan
		FROM tbl_laporan
		GROUP BY EXTRACT(year FROM tanggal_laporan)");
        return $hsl->result();
    }

    function barchart()
    {
        $this->db->select('*');
        $this->db->from('tbl_laporan');
        $this->db->select('ditujukan_kepada');
        $this->db->select('count(*) as total');
        $this->db->limit('10');
        $this->db->group_by('ditujukan_kepada');
        $this->db->order_by('total', 'DESC');
        return $this->db->get()->result();
    }

    function piechart()
    {
        $this->db->select('*');
        $this->db->from('tbl_laporan');
        $this->db->select('kategori_laporan');
        $this->db->select('count(*) as total');
        $this->db->group_by('kategori_laporan');
        $this->db->order_by('total', 'ASC');
        return $this->db->get()->result();
    }

    function doughnutchart()
    {
        $this->db->select('subkategori_laporan, count(*) as total');
        $this->db->from('tbl_laporan');
        $this->db->where("subkategori_laporan in ('1', '2', '3', '4')");
        $this->db->group_by('subkategori_laporan', 'DESC');
        return $this->db->get()->result();
    }

    function radarchart()
    {
        $this->db->select('subkategori_laporan, count(*) as total');
        $this->db->from('tbl_laporan');
        $this->db->where("subkategori_laporan in ('5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21')");
        $this->db->group_by('subkategori_laporan', 'DESC');
        return $this->db->get()->result();
    }

    function tablechart1()
    {
        $this->db->select('topik_laporan, count(*) as total');
        $this->db->from('tbl_laporan');
        $this->db->where("topik_laporan != ''");
        $this->db->limit(10);
        $this->db->group_by('topik_laporan');
        $this->db->order_by('total', 'DESC');
        return $this->db->get()->result();
    }

    function tablechart2()
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

    // Chart JS - Dashboard 2 (Custom Statistik)
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

    function tablechart1_custome($dari, $sampai)
    {
        $this->db->select('topik_laporan, count(*) as total');
        $this->db->from('tbl_laporan');
        $this->db->where('tanggal_laporan >=', $dari);
        $this->db->where('tanggal_laporan <=', $sampai);
        $this->db->where("topik_laporan != ''");
        $this->db->limit(10);
        $this->db->group_by('topik_laporan');
        $this->db->order_by('total', 'DESC');
        return $this->db->get()->result();
    }

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
        $this->db->limit(10);
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

    // Dashboard Rekapitulasi Penanganan Aduan Custome
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
}
