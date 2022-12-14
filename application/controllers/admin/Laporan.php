<?php
class Laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
	        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
			
        }
		$this->load->model('m_kategori_laporan');  //belum
		$this->load->model('m_laporan');   //sudah
		$this->load->model('m_admin');  //belum
		$this->load->model('m_kepada');
		$this->load->model('C_model','c_model');
		$this->load->library('upload');    //belum
	}

	function index(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$x['data']=$this->m_laporan->get_all_laporan();
		if ($pengguna_level=='1'){
		$this->load->view('admin/v_laporan2_a',$x);
		}
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd',$x);
		}
	}

	function opd(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd',$x);
		}
	}

	function disabilitas(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$x['data']=$this->m_laporan->get_all_laporan_disabilitas();
		if ($pengguna_level=='1'){
		$this->load->view('admin/v_laporan2_a_disabilitas',$x);
		}
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd',$x);
		}
	}

	function notifikasi(){
		$x['title']='Lapor Bupati';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$level=$this->session->userdata('pengguna_level');
		if ($level==='1'){
			$this->load->view('admin/v_laporan2_a_belum_teruskan',$x);
		}
		if ($level==='2'){
			$this->load->view('admin/v_laporan2_a_belum_teruskan_opd',$x);
		}
	}
	
	function semua(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$level=$this->session->userdata('pengguna_level');
		$x['title']="Lapor Bupati";
		$x['kpd']=$this->m_kepada->get_all_kepada();
		if ($pengguna_level=='2'){
			$this->load->view('admin/v_laporan2_a_opd',$x);
			}
		
			if ($level==='1'){
				$this->load->view('admin/v_laporan2_a',$x);
			}
	}

	function get_opd(){
		$x['title']="Lapor Bupati";
		$code=$this->session->userdata("pengguna_idskpd");
		$data=$this->m_laporan->get_laporan_opd($code)->result();
		echo json_encode($data);
	}

	function get_belum_teruskan(){
		$x['title']="Lapor Bupati";
		$code=$this->session->userdata("pengguna_idskpd");
		$data=$this->m_laporan->get_laporan_belum_teruskan()->result();
		echo json_encode($data);
	}

	function get_semua(){
		$x['title']="Lapor Bupati";
		// $code=$this->session->userdata("komisi");
		$data=$this->m_laporan->get_all_laporan()->result();
		echo json_encode($data);
	}

	//Update Dudunk
	function get_semua_disabilitas(){
		$x['title']="Lapor Bupati";
		// $code=$this->session->userdata("komisi");
		$data=$this->m_laporan->get_all_laporan_disabilitas()->result();
		echo json_encode($data);
	}	

	function get_modalview(){
		$x['title']="Lapor Bupati";
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode);
		// var_dump($data);
		echo json_encode($data);
	}

	//Update Dudunk
	function get_modalview_disabilitas(){
		$x['title']="Lapor Bupati";
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_disabilitas_by_kode($kode);
		//var_dump($data);
		echo json_encode($data);
	}

	function get_modalteruskan(){
		$x['title']="Lapor Bupati";
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode);

		echo json_encode($data);
	}

	function get_modaltindaklanjut(){
		$x['title']="Lapor Bupati";
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode);
		echo json_encode($data);
	}

	function get_modaledit(){
		$x['title']="Lapor Bupati";
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode)->result();
		// var_dump($data);
		echo json_encode($data);
	}

	//Update Dudunk
	function get_modaledit_disabilitas(){
		$x['title']="Lapor Bupati";
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_disabilitas_by_kode($kode)->result();
		// var_dump($data);
		echo json_encode($data);
	}

	function byid(){
		$x['title']="Lapor Bupati";
		$code=$this->session->userdata("komisi");
		$x['data']=$this->m_laporan->view_laporan_komisi($code);
		$this->load->view('admin/v_laporan2_a',$x);
	}

	function add_laporan(){    
		$x['title']="Lapor Bupati";
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada(); //===> get fraksi 
		//$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan(); ===> get anggota dewan  
		$this->load->view('admin/v_add_laporan2',$x);
	}

	function add_tambahan(){    
		$x['title']="Lapor Bupati";
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada(); 
		//$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan(); ===> get anggota dewan  
		$this->load->view('admin/v_add_laporan_tambahan2',$x);
	}

	function get_edit_laporan(){
		$x['title']="Lapor Bupati";
		$kode=$this->uri->segment(4); //ambil yuri
		$x['data']=$this->m_tulisan->get_tulisan_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$this->load->view('admin/v_edit_tulisan2',$x);
	}
	
	function simpan_laporan(){
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);
		//////////////////////////////////////////////////////////
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$id = substr(str_shuffle($set), 0, 15);
		// $id_pelapor=$this->session->userdata('user_id'); //user_id pelapor 
		$id_penginput = $this->session->userdata('pengguna_id');
		$id_kepada=strip_tags($this->input->post('idkepada'));  //--
		// var_dump($id_penginput);
		// die;

		$datakepada=$this->m_kepada->get_kepada($id_kepada);
		$dk=$datakepada->row_array();
		$ditujukan_kepada=$dk['opd_singkat']; //---

		$kategori_laporan=$this->input->post('x_kategorilaporan');  //--
		$judul_laporan=$this->input->post('x_judullaporan'); //--
		$xanggaran=$this->input->post('x_anggaran');
		$anggaran = preg_replace("/[^0-9]/", "", $xanggaran);
		$lokasi=$this->input->post('x_lokasi');
		$id_jenis=1;
		$isi_laporan=$this->input->post('x_isilaporan');  //--
		$nama=$this->input->post('x_nama'); //--
		$nik=$this->input->post('x_nik'); //--
		$email=$this->input->post('x_email');  //--
		$hp=$this->input->post('x_hp');
		$alamat=$this->input->post('x_alamat');
		$laporan_status=1;
		$tayang= 'tidak';
		$keterangan_status=$this->input->post('xketeranganstatus');
		$status=1;

		if(!empty($_FILES['filefoto']['name']))
		{
			if ($this->upload->do_upload('filefoto'))
			{
					$gbr = $this->upload->data();
					//Compress Image
					$config['image_library']='gd2';
					$config['source_image']='./assets/images/'.$gbr['file_name'];
					$config['create_thumb']= FALSE;
					$config['maintain_ratio']= FALSE;
					$config['quality']= '60%';
					$config['width']= 840;
							$config['height']= 450;
					$config['new_image']= './assets/images/'.$gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$gambar=$gbr['file_name'];
					$foto=$gambar;

					$data= array(
						'id'=>$id,
						'id_pelapor'=>$id_penginput,
						'id_kepada'=>$id_kepada,
						'ditujukan_kepada'=>$ditujukan_kepada,
						'id_penginput'=>$id_penginput,
						'penginput'=>$this->session->userdata('pengguna_nama'),
						'kategori_laporan'=>$kategori_laporan,
						'judul_laporan'=>$judul_laporan,
						'anggaran'=>$anggaran,
						'lokasi'=>$lokasi,
						'id_jenis'=>$id_jenis,
						'isi_laporan'=>$isi_laporan,
						'nik'=>$nik,
						'nama'=>$nama,
						'alamat'=>$alamat,
						'alamat'=>$alamat,
						'email'=>$email,
						'hp'=>$hp,
						'laporan_status'=>$laporan_status,
						'foto'=>$foto,
						'tayang'=>$tayang,
						'status'=>$status
					);
					$table  = 'tbl_laporan';
					$this->c_model->simpan($data,$table);		

			echo $this->session->set_flashdata('msg','success');
					redirect('admin/laporan');
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/laporan');
			}
				
		}else{
			$data= array(
				'id'=>$id,
				'id_pelapor'=>$id_penginput,
				'id_kepada'=>$id_kepada,
				'ditujukan_kepada'=>$ditujukan_kepada,
				'id_penginput'=>$id_penginput,
				'penginput'=>$this->session->userdata('pengguna_nama'),
				'kategori_laporan'=>$kategori_laporan,
				'judul_laporan'=>$judul_laporan,
				'anggaran'=>$anggaran,
				'lokasi'=>$lokasi,
				'id_jenis'=>$id_jenis,
				'isi_laporan'=>$isi_laporan,
				'nama'=>$nama,
				'nik'=>$nik,
				'alamat'=>$alamat,
				'alamat'=>$alamat,
				'email'=>$email,
				'hp'=>$hp,
				'laporan_status'=>$laporan_status,
				'tayang'=>$tayang,
				'status'=>$status
			);
			$table  = 'tbl_laporan';
			$this->c_model->simpan($data,$table);
			
		echo $this->session->set_flashdata('msg','success');
		$level=$this->session->userdata('pengguna_level');
		if ($level==='1'){
			redirect('admin/laporan');
		}
		if ($level==='2'){
			redirect('admin/laporan/opd');
		}

		}
	}

	function update_laporan(){
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);

		$id=$this->input->post('xkode_edit');
		$id_penginput = $this->session->userdata('pengguna_id');
		$id_kepada=$this->input->post('x_id_kepada_edit');  //--

		$datakepada=$this->m_kepada->get_kepada($id_kepada);
		$dk=$datakepada->row_array();
		$ditujukan_kepada=$dk['opd_singkat']; //---

		$judul_laporan=$this->input->post('x_judul_laporan_edit'); //--
		$kategori_laporan=$this->input->post('x_kategori_laporan_edit'); //--
		$lokasi=$this->input->post('x_lokasi_edit');
		$id_jenis=1; //id jenis?
		$isi_laporan=$this->input->post('x_isi_laporan_edit');  //--
		$nik=$this->input->post('x_nik_edit'); //--
		$nama=$this->input->post('x_nama_edit'); //--
		$nik=$this->input->post('x_nik_edit'); //--
		$email=$this->input->post('x_email_edit');  //--
		$hp=$this->input->post('x_hp_edit');
		$tanggal_laporan=$this->input->post('x_tanggal_laporan_edit');
		$alamat=$this->input->post('x_alamat_edit');
		$tindaklanjut=$this->input->post('x_tindaklanjut_edit');
		$keterangan_tindaklanjut=$this->input->post('x_keterangan_tindaklanjut_edit');
		$laporan_status=$this->input->post('x_laporan_status_edit');
		$keterangan_status=$this->input->post('x_keterangan_status_edit');
		$status=1;


		$foto=$this->input->post('x_foto');
		$foto_tindaklanjut=$this->input->post('x_foto_tindaklanjut');

		if(!empty($_FILES['x_foto_edit']['name']))
		{
			$this->upload->do_upload('x_foto_edit');
			$gbr = $this->upload->data();
			$foto=$gbr['file_name'];
		}

		if(!empty($_FILES['x_foto_tindaklanjut_edit']['name']))
		{
			$this->upload->do_upload('x_foto_tindaklanjut_edit');
			$gbr1 = $this->upload->data();
			$foto_tindaklanjut=$gbr1['file_name'];
		}

			$data= array(
				'id'=>$id,
				'id_kepada'=>$id_kepada,
				'ditujukan_kepada'=>$ditujukan_kepada,
				'id_penginput'=>$id_penginput,
				'penginput'=>$this->session->userdata('pengguna_nama'),
				'kategori_laporan'=>$kategori_laporan,
				'judul_laporan'=>$judul_laporan,
				'lokasi'=>$lokasi,
				'id_jenis'=>$id_jenis,
				'isi_laporan'=>$isi_laporan,
				'nama'=>$nama,
				'nik'=>$nik,
				'alamat'=>$alamat,
				'alamat'=>$alamat,
				'email'=>$email,
				'hp'=>$hp,
				'tanggal_laporan'=>$tanggal_laporan,
				'laporan_status'=>$laporan_status,
				'tindaklanjut'=>$tindaklanjut,
				'keterangan_tindaklanjut'=>$keterangan_tindaklanjut,
				'keterangan_status'=>$keterangan_status,
				'foto'=>$foto,
				'foto_tindaklanjut'=>$foto_tindaklanjut,
				'status'=>$status
			);
			$where   = array(
				'id' => $id
			);
			// var_dump($data);
			// die;
			$table  = 'tbl_laporan';
			$this->c_model->update($data,$where,$table);

			 echo $this->session->set_flashdata('msg','success');
					redirect('admin/laporan');
			
	   }

	function update_laporan_disabilitas(){
		//$config['upload_path'] = './assets/images/'; //path folder
		//$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
		//$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		//$this->upload->initialize($config);

		$id=$this->input->post('xkode_edit');
		//$id_penginput = $this->session->userdata('pengguna_id');
		//$id_kepada=$this->input->post('x_id_kepada_edit');  //--

		//$datakepada=$this->m_kepada->get_kepada($id_kepada);
		//$dk=$datakepada->row_array();
		//$ditujukan_kepada=$dk['opd_singkat']; //---

	//$nama_file=$this->input->post('x_aduan_edit'); //--
		
		//$kategori_laporan=$this->input->post('x_kategori_laporan_edit'); //--
		//$lokasi=$this->input->post('x_lokasi_edit');
		//$id_jenis=1; //id jenis?
		//$isi_laporan=$this->input->post('x_isi_laporan_edit');  //--
		//$nik=$this->input->post('x_nik_edit'); //--
		//$nama=$this->input->post('x_nama_edit'); //--
		//$nik=$this->input->post('x_nik_edit'); //--
		//$email=$this->input->post('x_email_edit');  //--
		//$hp=$this->input->post('x_hp_edit');
	//$created_at=$this->input->post('x_tanggal_aduan_edit');
		//$alamat=$this->input->post('x_alamat_edit');
		//$tindaklanjut=$this->input->post('x_tindaklanjut_edit');
		//$keterangan_tindaklanjut=$this->input->post('x_keterangan_tindaklanjut_edit');
		$status=$this->input->post('x_status_edit');
		$keterangan=$this->input->post('x_keterangan_edit');
	//$modified_at=$this->input->post('x_tanggal_status_edit');
		//$status=1;


		//$foto=$this->input->post('x_foto');
		//$foto_tindaklanjut=$this->input->post('x_foto_tindaklanjut');

		/* if(!empty($_FILES['x_foto_edit']['name']))
		{
			$this->upload->do_upload('x_foto_edit');
			$gbr = $this->upload->data();
			$foto=$gbr['file_name'];
		}

		if(!empty($_FILES['x_foto_tindaklanjut_edit']['name']))
		{
			$this->upload->do_upload('x_foto_tindaklanjut_edit');
			$gbr1 = $this->upload->data();
			$foto_tindaklanjut=$gbr1['file_name'];
		} */

			$data= array(
				//'id'=>$id,
				//'nama_file'=>$nama_file,
				'status'=>$status,
				//'created_at'=>$created_at,
				'keterangan'=>$keterangan,
				'modified_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
			);
			$where   = array(
				'id' => $id
			);
			// var_dump($data);
			// die;
			$table  = 'tbl_laporan_disabilitas';
			$this->c_model->update($data,$where,$table);

			 echo $this->session->set_flashdata('msg','success');
					redirect('admin/laporan/disabilitas');
	   }

	function update_teruskan(){
		
				$id=$this->input->post('x_kode_teruskan');
				$datalaporan=$this->m_laporan->get_laporan_by_kode($id);
				$dl=$datalaporan->row_array();
				$judul_laporan=$dl['judul_laporan'];
				$isi_laporan=$dl['isi_laporan'];
				$foto=$dl['foto'];

				$keterangan_status=$this->input->post('x_keterangan_status_teruskan');
				$id_kepada=$this->input->post('x_id_kepada_teruskan');
				
				$datakepada=$this->m_kepada->get_kepada($id_kepada);
				$dk=$datakepada->row_array();
				$ditujukan_kepada=$dk['opd_singkat'];
				
				$dataadmin=$this->m_admin->getEmail($id_kepada);
				$da=$dataadmin->row_array();
				$email=$da['pengguna_email'];
				$email_tembusan=$da['pengguna_email_kantor'];
				$nama=$da['pengguna_nama'];
				

				$data = array(
				'laporan_status'=>2,                       
				'id_kepada'=>$id_kepada,
				'ditujukan_kepada'=>$ditujukan_kepada,
				'keterangan_status'=>$keterangan_status,
				'tayang'=>'ya');

				$where   = array(
					'id' => $id
				);
				$table  = 'tbl_laporan';


				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com', 
					'smtp_port' => 465,
					'smtp_user' => 'laporwonosobo@gmail.com',
					'smtp_pass' => 'nqudkgrsfhhsimbf',
					'smtp_username' => 'laporwonosobo@gmail.com',
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'Content-Type'=>'text/plain',
					'Content-Transfer-Encoding'=>'8bit',
					'wordwrap' => TRUE
			        );

			  $message = 	"
					<html>
					<head>
						<title>Laporan Masuk </title>
					</head>
					<body>
						<h2>Laporan baru mohon Kepada ".$nama." untuk segera ditindaklanjuti</h2>
						<p></p>
						<p>Judul Laporan    : ".$judul_laporan."</p>
						<p>Rincian Laporan  : ".$isi_laporan."</p>
						<p>Tindaklanjuti laporan dengan kunjungi <a href=https://laporbupati.wonosobokab.go.id/admin>Lapor Bupati Wonosobo</a> </p>
						<p>Lapor Bupati Wonosobo tidak akan pernah meminta anda untuk memberi tahu kata sandi atau informasi akun pribadi anda kepada kami melalui email. Anda hanya akan diminta untuk memasukkan password anda ketika anda masuk ke website kami.  Jika anda menerima email yang mencurigakan atau terjadi kesalahan tujuan pengiriman, mohon laporkan hal tersebut kepada kami di contact laporwonosobo@gmail.com untuk penyelidikan lebih lanjut.</p>
					</body>
					</html>
					";
			
					// var_dump($message);
					// die;
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				// $this->email->set_newline("\n");
				$this->email->from($config['smtp_user']);
				$this->email->to($email);
				$this->email->bcc($email_tembusan);
				$this->email->subject('Lapor Bupati Wonosobo');
				$this->email->message($message);
				$this->email->attach(base_url('assets/images/').$foto);
				// $this->email->print_debugger();
				if($this->email->send()){
					$this->session->set_flashdata('message','email');
				}
				else{
					$this->session->set_flashdata('message', 'email gagal');
					// echo $this->session->set_flashdata('msg','success');
					// $this->session->set_flashdata('message', '$this->email->print_debugger()');
				}

				$this->c_model->update($data,$where,$table);

				redirect('admin/laporan');
	}



	function update_tindaklanjut(){		
				$config['upload_path'] = './assets/images/'; //path folder
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				$this->upload->initialize($config);
				
				$id=$this->input->post('xkode_tindaklanjut');
				$tindaklanjut=$this->input->post('x_tindaklanjut');
				$laporan_status=$this->input->post('x_laporan_status_tindaklanjut');
				$keterangan_tindaklanjut=$this->input->post('x_keterangan_tindaklanjut');
				
				$foto_tindaklanjut=$this->input->post('x_foto_tindaklanjut');

				if(!empty($_FILES['x_foto_tindaklanjut_edit']['name']))
				{
					$this->upload->do_upload('x_foto_tindaklanjut_edit');
					$gbr1 = $this->upload->data();
					$foto_tindaklanjut=$gbr1['file_name'];
				}

				$data = array(
				'laporan_status'=>3,                       
				'tindaklanjut'=>$tindaklanjut,
				'laporan_status'=>$laporan_status,
				'foto_tindaklanjut'=> $foto_tindaklanjut,
				'keterangan_tindaklanjut'=>$keterangan_tindaklanjut,
				'tanggal_tindaklanjut'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s')
				);
				$where   = array(
					'id' => $id
				);
				$table  = 'tbl_laporan';
				$this->c_model->update($data,$where,$table);
				echo $this->session->set_flashdata('msg','success');
				redirect('admin/laporan/opd');

	}


	function update_tolak(){		
				$config['upload_path'] = './assets/images/'; //path folder
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				$this->upload->initialize($config);
				
				$id=$this->input->post('xkode_tolak');
				$keterangan_tolak=$this->input->post('x_keterangan_tolak');
				$laporan_status=$this->input->post('x_laporan_status_tolak');

				// $foto_tindaklanjut=$this->input->post('x_foto_tindaklanjut');

				// if(!empty($_FILES['x_foto_tindaklanjut_edit']['name']))
				// {
				// 	$this->upload->do_upload('x_foto_tindaklanjut_edit');
				// 	$gbr1 = $this->upload->data();
				// 	$foto_tindaklanjut=$gbr1['file_name'];
				// }

				$data = array(
				'laporan_status'=>1,                       
				// 'tindaklanjut'=>$tindaklanjut,
				'id_kepada'=>"",
				'ditujukan_kepada'=>"",
				// 'foto_tindaklanjut'=> $foto_tindaklanjut,
				'keterangan_tolak'=>$keterangan_tolak
				);
				$where   = array(
					'id' => $id
				);
				$table  = 'tbl_laporan';
				$this->c_model->update($data,$where,$table);
				echo $this->session->set_flashdata('msg','success');
				redirect('admin/laporan/opd');

	}

	function update_tayang(){		
				$id=$this->input->post('id');

				$datatayang=$this->m_laporan->get_tayang($id);
				$dk=$datatayang->row_array();
				$tayang=$dk['tayang'];
				
			if ($tayang =='ya'){
				$data = array(
					'tayang'=>'tidak'
					);
				}else{
				$data = array(
					'tayang'=>'ya'
					);
				}
			
				$where   = array(
					'id' => $id
				);
				$table  = 'tbl_laporan';
				$this->c_model->update($data,$where,$table);
				
	}


	function update_status(){
                $id=$this->input->post('kode');

              	$laporan_status=strip_tags($this->input->post('laporan_status')); 

              	$keterangan_status=$this->input->post('xketeranganstatus');

				$this->m_laporan->update_status(
					$id,
					$laporan_status,
					$keterangan_status);
				redirect('admin/laporan');

	}


	function hapus_laporan(){ 
		$kode=$this->input->post('x_kode_hapus');
		$foto=$this->input->post('x_foto_hapus');
		$path='./assets/images/'.$foto;
		unlink($path);
		$this->m_laporan->hapus_laporan($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/laporan');
	}

	//Update Dudunk
	function hapus_laporan_disabilitas(){ 
		$kode=$this->input->post('x_kode_hapus');
		$audio=$this->input->post('x_aduan_hapus');
		$path='./assets/audio/'.$audio;
		unlink($path);
		$this->m_laporan->hapus_laporan_disabilitas($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/laporan/disabilitas');
	}

}