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
		$this->load->helper('dateindo_helper');
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
			echo '<th colspan=13><b>Rekap Aduan Lapor Bupati Wonosobo</b>';
			echo '</th>';
		echo '</tr>';

		echo '<table cellspacing="0" border="1">';
		echo '<tr>';
		echo '</tr>';
		echo '<tr>';
		// echo '<th>No</th><th>Nama</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tanggal</th><th>Tindaklanjut</th><th>Status</th><th>Tema Aduan</th><th>Sumber</th><th>OPD</th>';
		echo '<th>No</th><th>Pelapor</th><th>Sumber</th><th>Tema Aduan</th><th>Tanggal Aduan</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tindaklanjut</th><th>Tanggal TL</th><th>Status</th><th>OPD</th><th>Durasi TL</th>';
		echo '</tr>';

		$this->db->order_by('nomor', 'DESC');
		$query = $this->db->get('tbl_laporan');
		
		// $query =  "SELECT * FROM tbl_laporan where month(tanggal_laporan)='$bulan' ";
		$no=1;
		foreach ($query->result() as $br)
		{
			// Status Aduan
			if ($br->laporan_status ==1){
				$laporanstatus = 'Verifikasi';
			}else if($br->laporan_status ==2){
				  $laporanstatus = 'Sedang Proses';
				}else if($br->laporan_status ==99){
				  $laporanstatus = 'Ditolak';
			  }else{
				$laporanstatus = 'Selesai';
			}

			// Jenis Aduan
			if ($br->kategori_laporan ==1){
				$kategori = 'Infrastruktur';
			  }else{
				$kategori = 'Non Infrastruktur';
			}

			// Sumber Aduan
			if ($br->sumber_aduan =='LB') {
				$sumber = 'Website Lapor Bupati';
			} else if ($br->sumber_aduan =='LG') {
				$sumber = 'Website Lapor Gubernur';
			} else if ($br->sumber_aduan =='SP') {
				$sumber = 'SP4N Lapor';
			} else if ($br->sumber_aduan =='SM') {
				$sumber = 'SMS';
			} else if ($br->sumber_aduan =='WA') {
				$sumber = 'Whatsapp';
			} else if ($br->sumber_aduan =='IG') {
				$sumber = 'Instagram';
			} else if ($br->sumber_aduan =='FB') {
				$sumber = 'Facebook';
			} else {
				$sumber = 'Twitter';
			}

			// Hitung Durasi TL
			$awal  = date_create($br->tanggal_laporan);
            $akhir = date_create($br->tanggal_tindaklanjut);
            $diff  = date_diff($awal,$akhir);

			echo
			'
			<tr>
			<td>'.$no++.'</td>
			<td>'.$br->nama.'</td>
			<td>'.$sumber.'</td>
			<td>'.$kategori.'</td>
			<td>'.$br->tanggal_laporan.'</td>
			<td>'.$br->judul_laporan.'</td>
			<td>'.$br->isi_laporan.'</td>
			<td>'.$br->lokasi.'</td>
			<td>'.$br->tindaklanjut.'</td>
			<td>'.$br->tanggal_tindaklanjut.'</td>
			<td>'.$laporanstatus.'</td>
			<td>'.$br->ditujukan_kepada.'</td>
			<td>'.$diff->format('<p style="color:red; font-size:16px;"><b>%Y</b> th <b>%m</b> bl <b>%d</b> hr <b>%h</b> jam <b>%i</b> mnt <b>%s</b> dtk</p>').'</td>
			</tr>
			';
		}
		echo "</table>";
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
			echo '<th colspan=13><b> Rekap Aduan Lapor Bupati Wonosobo</b>';
			echo '</th>';
		echo '</tr>';
		echo '<tr>';
		echo '</tr>';

		echo '<tr>';
		// echo '<th>No</th><th>Nama</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tanggal</th><th>Tindaklanjut</th><th>Status</th><th>Tema Aduan</th><th>Sumber</th><th>OPD</th>';
		echo '<th>No</th><th>Pelapor</th><th>Sumber</th><th>Tema Aduan</th><th>Tanggal Aduan</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tindaklanjut</th><th>Tanggal TL</th><th>Status</th><th>OPD</th><th>Durasi TL</th>';
		echo '</tr>';

		$this->db->order_by('nomor', 'DESC');
		$query = $this->db->get('tbl_laporan');

		$no=1;
		foreach ($query->result() as $br)
		{
			// Status Aduan
			if ($br->laporan_status ==1){
				$laporanstatus = 'Verifikasi';
			}else if($br->laporan_status ==2){
				  $laporanstatus = 'Sedang Proses';
				}else if($br->laporan_status ==99){
				  $laporanstatus = 'Ditolak';
			  }else{
				$laporanstatus = 'Selesai';
			}

			// Kategori Aduan
			if ($br->kategori_laporan ==1){
				$kategori = 'Infrastruktur';
			  }else{
				$kategori = 'Non Infrastruktur';
			}
			
			// Sumber Aduan
			if ($br->sumber_aduan =='LB') {
				$sumber = 'Website Lapor Bupati';
			} else if ($br->sumber_aduan =='LG') {
				$sumber = 'Website Lapor Gubernur';
			} else if ($br->sumber_aduan =='SP') {
				$sumber = 'SP4N Lapor';
			} else if ($br->sumber_aduan =='SM') {
				$sumber = 'SMS';
			} else if ($br->sumber_aduan =='WA') {
				$sumber = 'Whatsapp';
			} else if ($br->sumber_aduan =='IG') {
				$sumber = 'Instagram';
			} else if ($br->sumber_aduan =='FB') {
				$sumber = 'Facebook';
			} else {
				$sumber = 'Twitter';
			}

			// Hitung Durasi TL
			$awal  = date_create($br->tanggal_laporan);
            $akhir = date_create($br->tanggal_tindaklanjut);
            $diff  = date_diff($awal,$akhir);

			echo
			'
			<tr>
			<td>'.$no++.'</td>
			<td>'.$br->nama.'</td>
			<td>'.$sumber.'</td>
			<td>'.$kategori.'</td>
			<td>'.$br->tanggal_laporan.'</td>
			<td>'.$br->judul_laporan.'</td>
			<td>'.$br->isi_laporan.'</td>
			<td>'.$br->lokasi.'</td>
			<td>'.$br->tindaklanjut.'</td>
			<td>'.$br->tanggal_tindaklanjut.'</td>
			<td>'.$laporanstatus.'</td>
			<td>'.$br->ditujukan_kepada.'</td>
			<td>'.$diff->format('<p style="color:red; font-size:16px;"><b>%Y</b> th <b>%m</b> bl <b>%d</b> hr <b>%h</b> jam <b>%i</b> mnt <b>%s</b> dtk</p>').'</td>
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
					// echo '<th colspan=13><b>Rekap Aduan Lapor Bupati Wonosobo</b>';
					echo '<th colspan=13><p align="center"><b>Rekap Aduan Lapor Bupati Wonosobo</b></p>'.'<p align="center">Periode : <b>'.mediumdate_indo($dari).'</b> s/d <b>'.mediumdate_indo($sampai).'</b></p>';
					echo '</th>';
				echo '</tr>';
				echo '<tr>';
				echo '</tr>';

				echo '<tr>';
				echo '<th>No</th><th>Pelapor</th><th>Sumber</th><th>Tema Aduan</th><th>Tanggal Aduan</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tindaklanjut</th><th>Tanggal TL</th><th>Status</th><th>OPD</th><th>Durasi TL</th>';
				echo '</tr>';

				$this->db->order_by('nomor', 'DESC');
				$query = $this->db->where('tanggal_laporan >=', $dari);
				$query = $this->db->where('tanggal_laporan <=', $sampai);
				$query = $this->db->get('tbl_laporan');

				$no=1;
				foreach ($query->result() as $br)
				{
					// Status Aduan
					if ($br->laporan_status ==1){
						$laporanstatus = 'Verifikasi';
					}else if($br->laporan_status ==2){
						$laporanstatus = 'Sedang Proses';
						}else if($br->laporan_status ==99){
						$laporanstatus = 'Ditolak';
					}else{
						$laporanstatus = 'Selesai';
					}

					// Kategori Aduan
					if ($br->kategori_laporan ==1){
						$kategori = 'Infrastruktur';
					}else{
						$kategori = 'Non Infrastruktur';
					}
					
					// Sumber Aduan
					if ($br->sumber_aduan =='LB') {
						$sumber = 'Website Lapor Bupati';
					} else if ($br->sumber_aduan =='LG') {
						$sumber = 'Website Lapor Gubernur';
					} else if ($br->sumber_aduan =='SP') {
						$sumber = 'SP4N Lapor';
					} else if ($br->sumber_aduan =='SM') {
						$sumber = 'SMS';
					} else if ($br->sumber_aduan =='WA') {
						$sumber = 'Whatsapp';
					} else if ($br->sumber_aduan =='IG') {
						$sumber = 'Instagram';
					} else if ($br->sumber_aduan =='FB') {
						$sumber = 'Facebook';
					} else {
						$sumber = 'Twitter';
					}

					// Hitung Durasi TL
					$awal  = date_create($br->tanggal_laporan);
	                $akhir = date_create($br->tanggal_tindaklanjut);
	                $diff  = date_diff($awal,$akhir);

					echo
					'
					<tr>
					<td>'.$no++.'</td>
					<td>'.$br->nama.'</td>
					<td>'.$sumber.'</td>
					<td>'.$kategori.'</td>
					<td>'.$br->tanggal_laporan.'</td>
					<td>'.$br->judul_laporan.'</td>
					<td>'.$br->isi_laporan.'</td>
					<td>'.$br->lokasi.'</td>
					<td>'.$br->tindaklanjut.'</td>
					<td>'.$br->tanggal_tindaklanjut.'</td>
					<td>'.$laporanstatus.'</td>
					<td>'.$br->ditujukan_kepada.'</td>
					<td>'.$diff->format('<p style="color:red; font-size:16px;"><b>%Y</b> th <b>%m</b> bl <b>%d</b> hr <b>%h</b> jam <b>%i</b> mnt <b>%s</b> dtk</p>').'</td>
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
				// echo '<th colspan=13><b>Rekap Aduan Lapor Bupati Wonosobo</b>';
				echo '<th colspan=13><p align="center"><b>Rekap Aduan Lapor Bupati Wonosobo</b></p>'.'<p align="center">Periode : <b>'.mediumdate_indo($dari).'</b> s/d <b>'.mediumdate_indo($sampai).'</b></p>';
				echo '</th>';
			echo '</tr>';
	
			echo '<table cellspacing="0" border="1">';
			echo '<tr>';
			echo '</tr>';
			echo '<tr>';
			echo '<th>No</th><th>Pelapor</th><th>Sumber</th><th>Tema Aduan</th><th>Tanggal Aduan</th><th>Judul Aduan</th><th>Rincian</th><th>Lokasi</th><th>Tindaklanjut</th><th>Tanggal TL</th><th>Status</th><th>OPD</th><th>Durasi TL</th>';
			echo '</tr>';
	
			$this->db->order_by('nomor', 'DESC');
			$query = $this->db->where('tanggal_laporan >=', $dari);
			$query = $this->db->where('tanggal_laporan <=', $sampai);
			$query = $this->db->get('tbl_laporan');
			
			$no=1;
			foreach ($query->result() as $br)
			{
				// Status Aduan
				if ($br->laporan_status ==1){
					$laporanstatus = 'Verifikasi';
				}else if($br->laporan_status ==2){
					  $laporanstatus = 'Sedang Proses';
					}else if($br->laporan_status ==99){
					  $laporanstatus = 'Ditolak';
				  }else{
					$laporanstatus = 'Selesai';
				}
				
				// Kategori Aduan
				if ($br->kategori_laporan ==1){
					$kategori = 'Infrastruktur';
				  }else{
					$kategori = 'Non Infrastruktur';
				}
				
				// Sumber Aduan
				if ($br->sumber_aduan =='LB') {
					$sumber = 'Website Lapor Bupati';
				} else if ($br->sumber_aduan =='LG') {
					$sumber = 'Website Lapor Gubernur';
				} else if ($br->sumber_aduan =='SP') {
					$sumber = 'SP4N Lapor';
				} else if ($br->sumber_aduan =='SM') {
					$sumber = 'SMS';
				} else if ($br->sumber_aduan =='WA') {
					$sumber = 'Whatsapp';
				} else if ($br->sumber_aduan =='IG') {
					$sumber = 'Instagram';
				} else if ($br->sumber_aduan =='FB') {
					$sumber = 'Facebook';
				} else {
					$sumber = 'Twitter';
				}

				// Hitung Durasi TL
				$awal  = date_create($br->tanggal_laporan);
                $akhir = date_create($br->tanggal_tindaklanjut);
                $diff  = date_diff($awal,$akhir);

				echo
				'
				<tr>
				<td>'.$no++.'</td>
				<td>'.$br->nama.'</td>
				<td>'.$sumber.'</td>
				<td>'.$kategori.'</td>
				<td>'.$br->tanggal_laporan.'</td>
				<td>'.$br->judul_laporan.'</td>
				<td>'.$br->isi_laporan.'</td>
				<td>'.$br->lokasi.'</td>
				<td>'.$br->tindaklanjut.'</td>
				<td>'.$br->tanggal_tindaklanjut.'</td>
				<td>'.$laporanstatus.'</td>
				<td>'.$br->ditujukan_kepada.'</td>
				<td>'.$diff->format('<p style="color:red; font-size:16px;"><b>%Y</b> th <b>%m</b> bl <b>%d</b> hr <b>%h</b> jam <b>%i</b> mnt <b>%s</b> dtk</p>').'</td>
				</tr>
				';
			}
			echo '</table>';
			echo "</body>";
			echo "</html>";
			}

	   }
	}

	function antara_survei()
	{
		$dari=$this->input->post('x_dari');
		$sampai=$this->input->post('x_sampai');
		$format=$this->input->post('x_format');
		$pengguna_level=$this->session->userdata('pengguna_level');
		
		if ($pengguna_level=='1'){
			if($format=='excel'){
				$x['title']='Cetak Laporan Survei';
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment;Filename=SurveiLaporBupati_".date('Ymdhis').".xls");
				echo "<html>";
				echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
				echo "<body>";
				$urut = 0;
				echo '<table cellspacing="0" border="1">';
				echo '<tr>';
					echo '<th colspan=11><p align="center"><b>Rekapitulasi Hasil Survei Layanan Lapor Bupati Wonosobo</b></p>'.'<p align="center">Periode : <b>'.mediumdate_indo($dari).'</b> s/d <b>'.mediumdate_indo($sampai).'</b></p>';
					echo '</th>';
				echo '</tr>';
				echo '<tr>';
				echo '</tr>';

				echo '<tr>';
				echo '<th>No</th><th>Nama Responden</th><th>Email</th><th>Jawaban 1</th><th>Jawaban 2</th><th>Jawaban 3</th><th>Jawaban 4</th><th>Jawaban 5</th><th>Rating</th><th>Kritik dan Saran</th><th>Tanggal Survei</th>';
				echo '</tr>';

				$this->db->order_by('id', 'ASC');
				$query = $this->db->where('created_at >=', $dari);
				$query = $this->db->where('created_at <=', $sampai);
				$query = $this->db->get('tbl_survei');

				$no=1;
				foreach ($query->result() as $br)
				{
					echo
					'
					<tr>
						<td align="left">'.$no++.'</td>
						<td>'.$br->nama.'</td>
						<td>'.$br->email.'</td>
						<td align="left">'.$br->pertanyaan1.'</td>
						<td align="right">'.$br->pertanyaan2.'</td>
						<td align="right">'.$br->pertanyaan3.'</td>
						<td align="right">'.$br->pertanyaan4.'</td>
						<td align="right">'.$br->pertanyaan5.'</td>
						<td align="right"><b>'.((($br->pertanyaan2)+($br->pertanyaan3)+($br->pertanyaan4)+($br->pertanyaan5))/4).'</b></td>
						<td>'.$br->kritik_saran.'</td>
						<td align="center">'.date('d-m-Y H:i:s',strtotime($br->created_at)).'</td>
					</tr>
					';
				}
				echo '</table>';
				echo "</body>";
				echo "</html>";
			}

		if($format=='web'){
			$x['title']='Cetak Laporan Survei';

			$bulan = date('M');
			// print_r($bulan);
			echo "<html>";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
			echo "<body>";
			$urut = 0;
	
			echo '<tr>';
				echo '<th><p align="center"><b>Rekapitulasi Hasil Survei Layanan Lapor Bupati Wonosobo</b></p>'.'<p align="center">Periode : <b>'.mediumdate_indo($dari).'</b> s/d <b>'.mediumdate_indo($sampai).'</b></p>';
				echo '</th>';
			echo '</tr>';
	
			echo '<table cellspacing="0" border="1">';
			echo '<tr>';
			echo '</tr>';
			echo '<tr>';
			echo '<th>No</th><th>Nama Responden</th><th>Email</th><th>Jawaban 1</th><th>Jawaban 2</th><th>Jawaban 3</th><th>Jawaban 4</th><th>Jawaban 5</th><th>Rating</th><th>Kritik dan Saran</th><th>Tanggal Survei</th>';
			echo '</tr>';
	
			$this->db->order_by('id', 'ASC');
			$query = $this->db->where('created_at >=', $dari);
			$query = $this->db->where('created_at <=', $sampai);
			$query = $this->db->get('tbl_survei');
			
			$no=1;
			foreach ($query->result() as $br)
			{
				echo
				'
				<tr>
					<td>'.$no++.'</td>
					<td>'.$br->nama.'</td>
					<td>'.$br->email.'</td>
					<td align="left">'.$br->pertanyaan1.'</td>
					<td align="right">'.$br->pertanyaan2.'</td>
					<td align="right">'.$br->pertanyaan3.'</td>
					<td align="right">'.$br->pertanyaan4.'</td>
					<td align="right">'.$br->pertanyaan5.'</td>
					<td align="right"><b>'.((($br->pertanyaan2)+($br->pertanyaan3)+($br->pertanyaan4)+($br->pertanyaan5))/4).'</b></td>
					<td>'.$br->kritik_saran.'</td>
					<td align="center">'.date('d-m-Y H:i:s',strtotime($br->created_at)).'</td>
					</tr>
				</tr>
				';
					// <td align="right">'.(($br->pertanyaan2)+($br->pertanyaan3)+($br->pertanyaan4)+($br->pertanyaan5)).'</td>
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