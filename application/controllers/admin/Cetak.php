<?php
class Cetak extends CI_Controller{
	function __construct(){
		parent::__construct();
	        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
        }
		$this->load->model('m_kategori_laporan');  
		$this->load->model('c_model');  
		$this->load->model('m_laporan');   
		$this->load->model('m_admin'); 
		$this->load->model('m_kepada');
		$this->load->model('m_cetak');
		$this->load->library('upload');  
	}
	
	function index(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		if ($pengguna_level=='1'){
		$x['title']='Cetak Laporan';

		$bulan = date('m');
		// print_r($bulan);
		echo "<html>";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
		echo "<body>";
		$urut = 0;

		echo '<tr>';
			echo '<th colspan=11><b> Rekap Aduan Lapor Bupati Wonosobo</b>';
			echo '</th>';
		echo '</tr>';

		echo '<table cellspacing="0" border="1">';
		echo '<tr>';
		echo '</tr>';
		echo '<tr>';
		echo '<th>No</th><th>Nama</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tanggal</th><th>Tindaklanjut</th><th>Status</th><th>Tema Aduan</th><th>Sumber</th><th>OPD</th>';
		echo '</tr>';

		$this->db->order_by('nomor', 'DESC');
		$query = $this->db->get('tbl_laporan');
		
		// $query =  "SELECT * FROM tbl_laporan where month(tanggal_laporan)='$bulan' ";
		$no=1;
		foreach ($query->result() as $br)
		{
			if ($br->laporan_status ==1){
				$laporanstatus = 'Verifikasi';
			}else if($br->laporan_status ==2){
				  $laporanstatus = 'Sedang Proses';
				}else if($br->laporan_status ==99){
				  $laporanstatus = 'ditolak';
			  }else{
				$laporanstatus = 'Selesai';
			}

			if ($br->kategori_laporan ==1){
				$kategori = 'Fisik';
			  }else{
				$kategori = 'Non Fisik';
			}

			echo
			'
			<tr>
			<td>'.$no++.'</td>
			<td>'.$br->nama.'</td>
			<td>'.$br->judul_laporan.'</td>
			<td>'.$br->isi_laporan.'</td>
			<td>'.$br->lokasi.'</td>
			<td>'.$br->tanggal_laporan.'</td>
			<td>'.$br->tindaklanjut.'</td>
			<td>'.$laporanstatus.'</td>
			<td>'.$kategori.'</td>
			<td>'.$br->hp.'</td>
			<td>'.$br->ditujukan_kepada.'</td>
			</tr>
			';
		}
		echo '</table>';
		echo "</body>";
		echo "</html>";
		}
	}

	function cetak_excel()
	{
		$pengguna_level=$this->session->userdata('pengguna_level');
		if ($pengguna_level=='1'){
		$x['title']='Cetak Laporan';
		$x['data']=$this->m_cetak->cetak_laporan_semua2();
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=LaporBupati_".date('Ymdhis').".xls");
		echo "<html>";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
		echo "<body>";
		$urut = 0;
		echo '<table cellspacing="0" border="1">';
		echo '<tr>';
			echo '<th colspan=11><b> Rekap Aduan Lapor Bupati Wonosobo</b>';
			echo '</th>';
		echo '</tr>';
		echo '<tr>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>No</th><th>Nama</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tanggal</th><th>Tindaklanjut</th><th>Status</th><th>Tema Aduan</th><th>Sumber</th><th>OPD</th>';
		echo '</tr>';

		$this->db->order_by('nomor', 'DESC');
		$query = $this->db->get('tbl_laporan');

		$no=1;
		foreach ($query->result() as $br)
		{
			if ($br->laporan_status ==1){
				$laporanstatus = 'Verifikasi';
			}else if($br->laporan_status ==2){
				  $laporanstatus = 'Sedang Proses';
				}else if($br->laporan_status ==99){
				  $laporanstatus = 'ditolak';
			  }else{
				$laporanstatus = 'Selesai';
			}

			if ($br->kategori_laporan ==1){
				$kategori = 'Fisik';
			  }else{
				$kategori = 'Non Fisik';
			}
			echo
			'
			<tr>
			<td>'.$no++.'</td>
			<td>'.$br->nama.'</td>
			<td>'.$br->judul_laporan.'</td>
			<td>'.$br->isi_laporan.'</td>
			<td>'.$br->lokasi.'</td>
			<td>'.$br->tanggal_laporan.'</td>
			<td>'.$br->tindaklanjut.'</td>
			<td>'.$laporanstatus.'</td>
			<td>'.$kategori.'</td>
			<td>'.$br->hp.'</td>
			<td>'.$br->ditujukan_kepada.'</td>
			</tr>
			';
		}
		echo '</table>';
		echo "</body>";
		echo "</html>";
	   }
	}

	function antara()
	{
		$dari=$this->input->post('x_dari');
		$sampai=$this->input->post('x_sampai');
		$format=$this->input->post('x_format');
		$pengguna_level=$this->session->userdata('pengguna_level');
		// var_dump($pengguna_level);
		// die;
		if ($pengguna_level=='1'){
			if($format=='excel'){
				$x['title']='Cetak Laporan';
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment;Filename=LaporBupati_".date('Ymdhis').".xls");
				echo "<html>";
				echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
				echo "<body>";
				$urut = 0;
				echo '<table cellspacing="0" border="1">';
				echo '<tr>';
					echo '<th colspan=11><b> Rekap Aduan Lapor Bupati Wonosobo</b>';
					echo '</th>';
				echo '</tr>';
				echo '<tr>';
				echo '</tr>';

				echo '<tr>';
				echo '<th>No</th><th>Nama</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tanggal</th><th>Tindaklanjut</th><th>Status</th><th>Tema Aduan</th><th>Sumber</th><th>OPD</th>';
				echo '</tr>';

				$this->db->order_by('nomor', 'DESC');
				$query = $this->db->where('tanggal_laporan >=', $dari);
				$query = $this->db->where('tanggal_laporan <=', $sampai);
				$query = $this->db->get('tbl_laporan');

				$no=1;
				foreach ($query->result() as $br)
				{
					if ($br->laporan_status ==1){
						$laporanstatus = 'Verifikasi';
					}else if($br->laporan_status ==2){
						$laporanstatus = 'Sedang Proses';
						}else if($br->laporan_status ==99){
						$laporanstatus = 'ditolak';
					}else{
						$laporanstatus = 'Selesai';
					}

					if ($br->kategori_laporan ==1){
						$kategori = 'Fisik';
					}else{
						$kategori = 'Non Fisik';
					}
					echo
					'
					<tr>
					<td>'.$no++.'</td>
					<td>'.$br->nama.'</td>
					<td>'.$br->judul_laporan.'</td>
					<td>'.$br->isi_laporan.'</td>
					<td>'.$br->lokasi.'</td>
					<td>'.$br->tanggal_laporan.'</td>
					<td>'.$br->tindaklanjut.'</td>
					<td>'.$laporanstatus.'</td>
					<td>'.$kategori.'</td>
					<td>'.$br->hp.'</td>
					<td>'.$br->ditujukan_kepada.'</td>
					</tr>
					';
				}
				echo '</table>';
				echo "</body>";
				echo "</html>";
			}
		if($format=='web'){
			$x['title']='Cetak Laporan';

			$bulan = date('m');
			// print_r($bulan);
			echo "<html>";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
			echo "<body>";
			$urut = 0;
	
			echo '<tr>';
				echo '<th colspan=11><b> Rekap Aduan Lapor Bupati Wonosobo</b>';
				echo '</th>';
			echo '</tr>';
	
			echo '<table cellspacing="0" border="1">';
			echo '<tr>';
			echo '</tr>';
			echo '<tr>';
			echo '<th>No</th><th>Nama</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tanggal</th><th>Tindaklanjut</th><th>Status</th><th>Tema Aduan</th><th>Sumber</th><th>OPD</th>';
			echo '</tr>';
	
			$this->db->order_by('nomor', 'DESC');
			$query = $this->db->where('tanggal_laporan >=', $dari);
			$query = $this->db->where('tanggal_laporan <=', $sampai);
			$query = $this->db->get('tbl_laporan');
			
			$no=1;
			foreach ($query->result() as $br)
			{
				if ($br->laporan_status ==1){
					$laporanstatus = 'Verifikasi';
				}else if($br->laporan_status ==2){
					  $laporanstatus = 'Sedang Proses';
					}else if($br->laporan_status ==99){
					  $laporanstatus = 'ditolak';
				  }else{
					$laporanstatus = 'Selesai';
				}
	
				if ($br->kategori_laporan ==1){
					$kategori = 'Fisik';
				  }else{
					$kategori = 'Non Fisik';
				}
	
				echo
				'
				<tr>
				<td>'.$no++.'</td>
				<td>'.$br->nama.'</td>
				<td>'.$br->judul_laporan.'</td>
				<td>'.$br->isi_laporan.'</td>
				<td>'.$br->lokasi.'</td>
				<td>'.$br->tanggal_laporan.'</td>
				<td>'.$br->tindaklanjut.'</td>
				<td>'.$laporanstatus.'</td>
				<td>'.$kategori.'</td>
				<td>'.$br->hp.'</td>
				<td>'.$br->ditujukan_kepada.'</td>
				</tr>
				';
			}
			echo '</table>';
			echo "</body>";
			echo "</html>";
			}

	   }
	}

	function komisi($id){
		$id=$this->uri->segment(4);
		//$id=$xid-1;
		$x['data']=$this->m_cetak->cetak_laporan_admin2($id);
		$x['jml']=$this->m_cetak->get_jml_komisi($id);
		$this->load->view('admin/v_cetak_laporan2',$x);
	}
	
	function cetak_komisi_json($id){
		$data=$this->m_cetak->cetak_laporan_admin2($id)->result();
		echo json_encode($data);
		// print_r($data);
		
	}
	
	function komisi_tambahan($id){
		$id=$this->uri->segment(4);
		$x['data']=$this->m_cetak->cetak_laporan_admin2_tambahan($id);
		$x['jml']=$this->m_cetak->get_jml_komisi_tambahan($id);
		$this->load->view('admin/v_cetak_laporan2_tambahan',$x);
	}
	
	
	function cetak_komisi_tambahan_json($id){
		$data=$this->m_cetak->cetak_laporan_admin2_tambahan($id)->result();
		echo json_encode($data);
		// print_r($data);
		
	}

//////////////////////////////////////////////////////////////////
	function semua(){
		$x['data']=$this->m_cetak->cetak_laporan_semua2_tambahan();
		$x['jml']=$this->m_cetak->get_jml_semua();

		$this->load->view('admin/v_cetak_laporan_semua2',$x);
	}

	function cetak_semua_json(){
		$data=$this->m_cetak->cetak_laporan_semua2()->result();
		echo json_encode($data);

	}


	function byid(){
		$code=$this->session->userdata("komisi");
		$x['data']=$this->m_cetak->view_laporan_komisi($code);
		$this->load->view('admin/v_laporan2',$x);
	}


	function add_laporan(){    //masyon
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada(); //===> get fraksi //masyon
		//$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan(); ===> get anggota dewan  //masyon
		$this->load->view('admin/v_add_laporan2',$x);
	}

	function get_edit_laporan(){
		$kode=$this->uri->segment(4); //ambil yuri
		$x['data']=$this->m_tulisan->get_tulisan_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$this->load->view('admin/v_edit_tulisan2',$x);
	}
	
	
}