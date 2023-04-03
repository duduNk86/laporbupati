<?php
class Verifikasi extends CI_Controller{
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
		$x['title']='Lapor Bupati Wonosobo';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$x['subkatall']=$this->m_kategori_laporan->get_all_subkategori_laporan();
		$x['data']=$this->m_laporan->get_all_laporan_verifikasi();
		if ($pengguna_level=='1'){
		$this->load->view('admin/v_laporan2_a_verifikasi',$x);
		}
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd',$x);
		}
	}

	function opd(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati Wonosobo';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd',$x);
		}
	}

	function notifadmin(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati Wonosobo';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$x['data']=$this->m_laporan->get_all_notifadmin();
		if ($pengguna_level=='1'){
		$this->load->view('admin/v_laporan2_a_notif',$x);
		}
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd_notif',$x);
		}
	}

	function notifadmin_disabilitas(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati Wonosobo';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$x['data']=$this->m_laporan->get_all_notifadmin_disabilitas();
		if ($pengguna_level=='1'){
		$this->load->view('admin/v_laporan2_a_disabilitas_notif',$x);
		}
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd',$x);
		}
	}

	function notifopd(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati Wonosobo';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		if ($pengguna_level=='2'){
		$this->load->view('admin/v_laporan2_a_opd_notif',$x);
		}
	}

	function disabilitas(){
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['title']='Lapor Bupati Wonosobo';
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
		$x['title']='Lapor Bupati Wonosobo';
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
		$x['title']='Lapor Bupati Wonosobo';
		$x['kpd']=$this->m_kepada->get_all_kepada();
		if ($pengguna_level=='2'){
			$this->load->view('admin/v_laporan2_a_opd',$x);
			}
			if ($level==='1'){
				$this->load->view('admin/v_laporan2_a',$x);
			}
	}

	function get_opd(){
		$x['title']='Lapor Bupati Wonosobo';
		$code=$this->session->userdata("pengguna_idskpd");
		$data=$this->m_laporan->get_laporan_opd($code)->result();
		echo json_encode($data);
	}

	function get_notifopd(){
		$x['title']='Lapor Bupati Wonosobo';
		$code=$this->session->userdata("pengguna_idskpd");
		$data=$this->m_laporan->get_laporan_notifopd($code)->result();
		echo json_encode($data);
	}

	function get_belum_teruskan(){
		$x['title']='Lapor Bupati Wonosobo';
		$code=$this->session->userdata("pengguna_idskpd");
		$data=$this->m_laporan->get_laporan_belum_teruskan()->result();
		echo json_encode($data);
	}

	function get_semua(){
		$x['title']='Lapor Bupati Wonosobo';
		$data=$this->m_laporan->get_all_laporan()->result();
		echo json_encode($data);
	}

	function get_verifikasi(){
		$x['title']='Lapor Bupati Wonosobo';
		$data=$this->m_laporan->get_all_laporan_verifikasi()->result();
		echo json_encode($data);
	}

	//Update Dudunk
	function get_semua_notifadmin(){
		$x['title']='Lapor Bupati Wonosobo';
		$data=$this->m_laporan->get_all_notifadmin()->result();
		echo json_encode($data);
	}

	function get_semua_disabilitas(){
		$x['title']='Lapor Bupati Wonosobo';
		$data=$this->m_laporan->get_all_laporan_disabilitas()->result();
		echo json_encode($data);
	}	

	function get_semua_notifdisabilitas(){
		$x['title']='Lapor Bupati Wonosobo';
		$data=$this->m_laporan->get_all_notifadmin_disabilitas()->result();
		echo json_encode($data);
	}

	function get_modalview(){
		$x['title']='Lapor Bupati Wonosobo';
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode);
		// var_dump($data);
		echo json_encode($data);
	}

	//Update Dudunk
	function get_modalview_disabilitas(){
		$x['title']='Lapor Bupati Wonosobo';
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_disabilitas_by_kode($kode);
		echo json_encode($data);
	}

	function get_modalteruskan(){
		$x['title']='Lapor Bupati Wonosobo';
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode);
		echo json_encode($data);
	}

	function get_modaltindaklanjut(){
		$x['title']='Lapor Bupati Wonosobo';
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode);
		echo json_encode($data);
	}

	function get_modaledit(){
		$x['title']='Lapor Bupati Wonosobo';
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_by_kode($kode)->result();
		// var_dump($data);
		echo json_encode($data);
	}

	//Update Dudunk
	function get_modaledit_disabilitas(){
		$x['title']='Lapor Bupati Wonosobo';
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_disabilitas_by_kode($kode)->result();
		// var_dump($data);
		echo json_encode($data);
	}

	function get_modalhapus_disabilitas(){
		$x['title']='Lapor Bupati Wonosobo';
		$kode=$this->input->get('id');
		$data=$this->m_laporan->get_laporan_disabilitas_by_kode($kode)->result();
		echo json_encode($data);
	}

	function byid(){
		$x['title']='Lapor Bupati Wonosobo';
		$code=$this->session->userdata("komisi");
		$x['data']=$this->m_laporan->view_laporan_komisi($code);
		$this->load->view('admin/v_laporan2_a',$x);
	}

	function add_laporan(){    
		$x['title']='Lapor Bupati Wonosobo';
		$kategori_id = $this->input->post('id',TRUE);
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['subkat']=$this->m_kategori_laporan->get_subkategori_laporan($kategori_id);

        // $data = $this->product_model->get_sub_category($category_id)->result();
        // echo json_encode($data);

		$x['kpd']=$this->m_kepada->get_all_kepada();
		$this->load->view('admin/v_add_laporan2',$x);
	}

	function get_subkategori(){
		
        $kategori_id = $this->input->get('id',TRUE);
        $data = $this->m_kategori_laporan->get_subkategori_laporan($kategori_id)->result();
        // print_r($data);
        // die;
  		// echo $kategori_id;
		// die;
        echo json_encode($data);
    }

	function add_tambahan(){    
		$x['title']='Lapor Bupati Wonosobo';
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada();
		$this->load->view('admin$kategori_id/v_add_laporan_tambahan2',$x);
	}

	function get_edit_laporan(){
		$x['title']='Lapor Bupati Wonosobo';
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
		$id_kepada=strip_tags($this->input->post('idkepada'));
		// var_dump($id_penginput);
		// die;

		$datakepada=$this->m_kepada->get_kepada($id_kepada);
		$dk=$datakepada->row_array();
		$ditujukan_kepada=$dk['opd_singkat'];

		$kategori_laporan=$this->input->post('x_kategorilaporan');
		$subkategori_laporan=$this->input->post('x_subkategorilaporan');
		$topik_laporan=$this->input->post('x_topiklaporan');
		$judul_laporan=$this->input->post('x_judullaporan');
		$xanggaran=$this->input->post('x_anggaran');
		$anggaran = preg_replace("/[^0-9]/", "", $xanggaran);
		$lokasi=$this->input->post('x_lokasi');
		$id_jenis=1;
		$isi_laporan=$this->input->post('x_isilaporan');
		$nama=$this->input->post('x_nama');
		$nik=$this->input->post('x_nik');
		$email=$this->input->post('x_email');
		$hp=$this->input->post('x_hp');
		$alamat=$this->input->post('x_alamat');
		$laporan_status=1;
		$tayang= 'tidak';
		$keterangan_status=$this->input->post('xketeranganstatus');
		$status=1;
		$rating_jawaban=0;

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
					'subkategori_laporan'=>$subkategori_laporan,
					'topik_laporan'=>$topik_laporan,
					'judul_laporan'=>$judul_laporan,
					'anggaran'=>$anggaran,
					'lokasi'=>$lokasi,
					'id_jenis'=>$id_jenis,
					'isi_laporan'=>$isi_laporan,
					'nik'=>$nik,
					'nama'=>$nama,
					'alamat'=>$alamat,
					'email'=>$email,
					'hp'=>$hp,
					'laporan_status'=>$laporan_status,
					'foto'=>$foto,
					'tayang'=>$tayang,
					'status'=>$status,
					'rating_jawaban'=>$rating_jawaban
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
				'subkategori_laporan'=>$subkategori_laporan,
				'topik_laporan'=>$topik_laporan,
				'judul_laporan'=>$judul_laporan,
				'anggaran'=>$anggaran,
				'lokasi'=>$lokasi,
				'id_jenis'=>$id_jenis,
				'isi_laporan'=>$isi_laporan,
				'nama'=>$nama,
				'nik'=>$nik,
				'alamat'=>$alamat,
				'email'=>$email,
				'hp'=>$hp,
				'laporan_status'=>$laporan_status,
				'tayang'=>$tayang,
				'status'=>$status,
				'rating_jawaban'=>$rating_jawaban
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

	function copy_laporan(){
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);
		//////////////////////////////////////////////////////////
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$id = substr(str_shuffle($set), 0, 15);
		// $id_pelapor=$this->session->userdata('user_id'); //user_id pelapor 
		$id_penginput = $this->session->userdata('pengguna_id');
		$id_kepada=strip_tags($this->input->post('x_ditujukan_kepada_copy'));
		// var_dump($id_penginput);
		// die;

		$datakepada=$this->m_kepada->get_kepada($id_kepada);
		$dk=$datakepada->row_array();
		$ditujukan_kepada=$dk['opd_singkat'];

		$kategori_laporan=$this->input->post('x_kategori_laporan_copy');
		$subkategori_laporan=$this->input->post('x_subkategori_laporan_copy');
		$topik_laporan=$this->input->post('x_topik_laporan_copy');
		// $tanggal_laporan=$this->input->post('x_tanggal_laporan_copy');
		$judul_laporan=$this->input->post('x_judul_laporan_copy');
		$xanggaran=$this->input->post('x_anggaran_copy');
		$anggaran = preg_replace("/[^0-9]/", "", $xanggaran);
		$lokasi=$this->input->post('x_lokasi_copy');
		$id_jenis=1;
		$isi_laporan=$this->input->post('x_isi_laporan_copy');
		$nama=$this->input->post('x_nama_copy');
		$nik=$this->input->post('x_nik_copy');
		$email=$this->input->post('x_email_copy');
		$hp=$this->input->post('x_hp_copy');
		$alamat=$this->input->post('x_alamat_copy');
		$laporan_status=1;
		$tayang= 'tidak';
		$keterangan_status=$this->input->post('x_keterangan_status_copy');
		$status=1;
		$rating_jawaban=0;

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
					'subkategori_laporan'=>$subkategori_laporan,
					'topik_laporan'=>$topik_laporan,
					// 'tanggal_laporan'=>$tanggal_laporan,
					'judul_laporan'=>$judul_laporan,
					'anggaran'=>$anggaran,
					'lokasi'=>$lokasi,
					'id_jenis'=>$id_jenis,
					'isi_laporan'=>$isi_laporan,
					'nik'=>$nik,
					'nama'=>$nama,
					'alamat'=>$alamat,
					'email'=>$email,
					'hp'=>$hp,
					'laporan_status'=>$laporan_status,
					'foto'=>$foto,
					'tayang'=>$tayang,
					'status'=>$status,
					'rating_jawaban'=>$rating_jawaban
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
				'subkategori_laporan'=>$subkategori_laporan,
				'topik_laporan'=>$topik_laporan,
				// 'tanggal_laporan'=>$tanggal_laporan,
				'judul_laporan'=>$judul_laporan,
				'anggaran'=>$anggaran,
				'lokasi'=>$lokasi,
				'id_jenis'=>$id_jenis,
				'isi_laporan'=>$isi_laporan,
				'nama'=>$nama,
				'nik'=>$nik,
				'alamat'=>$alamat,
				'email'=>$email,
				'hp'=>$hp,
				'laporan_status'=>$laporan_status,
				'tayang'=>$tayang,
				'status'=>$status,
				'rating_jawaban'=>$rating_jawaban
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
		$id_kepada=$this->input->post('x_id_kepada_edit');

		$datakepada=$this->m_kepada->get_kepada($id_kepada);
		$dk=$datakepada->row_array();
		$ditujukan_kepada=$dk['opd_singkat'];

		$judul_laporan=$this->input->post('x_judul_laporan_edit');
		$kategori_laporan=$this->input->post('x_kategori_laporan_edit');
		$subkategori_laporan=$this->input->post('x_subkategori_laporan_edit');
		$topik_laporan=$this->input->post('x_topik_laporan_edit');
		$lokasi=$this->input->post('x_lokasi_edit');
		$id_jenis=1; //id jenis?
		$isi_laporan=$this->input->post('x_isi_laporan_edit');
		$nik=$this->input->post('x_nik_edit');
		$nama=$this->input->post('x_nama_edit');
		$email=$this->input->post('x_email_edit');
		$hp=$this->input->post('x_hp_edit');
		$tanggal_laporan=$this->input->post('x_tanggal_laporan_edit');
		$alamat=$this->input->post('x_alamat_edit');
		// $tindaklanjut=$this->input->post('x_tindaklanjut_edit');
		// $keterangan_tindaklanjut=$this->input->post('x_keterangan_tindaklanjut_edit');
		// $laporan_status=$this->input->post('x_laporan_status_edit');
		// $keterangan_status=$this->input->post('x_keterangan_status_edit');
		$status=1;

		$foto=$this->input->post('x_foto');
		// $foto_tindaklanjut=$this->input->post('x_foto_tindaklanjut');

		if(!empty($_FILES['x_foto_edit']['name']))
		{
			$this->upload->do_upload('x_foto_edit');
			$gbr = $this->upload->data();
			$foto=$gbr['file_name'];
		}

		// if(!empty($_FILES['x_foto_tindaklanjut_edit']['name']))
		// {
		// 	$this->upload->do_upload('x_foto_tindaklanjut_edit');
		// 	$gbr1 = $this->upload->data();
		// 	$foto_tindaklanjut=$gbr1['file_name'];
		// }

			$data= array(
				'id'=>$id,
				'id_kepada'=>$id_kepada,
				'ditujukan_kepada'=>$ditujukan_kepada,
				'id_penginput'=>$id_penginput,
				'penginput'=>$this->session->userdata('pengguna_nama'),
				'kategori_laporan'=>$kategori_laporan,
				'subkategori_laporan'=>$subkategori_laporan,
				'topik_laporan'=>$topik_laporan,
				'judul_laporan'=>$judul_laporan,
				'lokasi'=>$lokasi,
				'id_jenis'=>$id_jenis,
				'isi_laporan'=>$isi_laporan,
				'nama'=>$nama,
				'nik'=>$nik,
				'alamat'=>$alamat,
				'email'=>$email,
				'hp'=>$hp,
				'tanggal_laporan'=>$tanggal_laporan,
				// 'laporan_status'=>$laporan_status,
				// 'tindaklanjut'=>$tindaklanjut,
				// 'keterangan_tindaklanjut'=>$keterangan_tindaklanjut,
				// 'keterangan_status'=>$keterangan_status,
				'foto'=>$foto,
				// 'foto_tindaklanjut'=>$foto_tindaklanjut,
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

	function update_view(){
		$id=$this->input->post('xkode_view');
		$rating_jawaban=$this->input->post('x_rating_jawaban_view');
			$data= array(
				'id'=>$id,
				'rating_jawaban'=>$rating_jawaban
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

	function input_tindaklanjut(){
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$this->upload->initialize($config);

		$id=$this->input->post('xkode_inputtl');
		$laporan_status=$this->input->post('x_laporan_status_inputtl');
		$keterangan_status=$this->input->post('x_keterangan_status_inputtl');
		$tindaklanjut=$this->input->post('x_tindaklanjut_inputtl');
		$keterangan_tindaklanjut=$this->input->post('x_keterangan_tindaklanjut_inputtl');
		$status=1;
		$foto_tindaklanjut=$this->input->post('x_foto_tindaklanjut');

		if(!empty($_FILES['x_foto_tindaklanjut_inputtl']['name']))
		{
			$this->upload->do_upload('x_foto_tindaklanjut_inputtl');
			$gbr1 = $this->upload->data();
			$foto_tindaklanjut=$gbr1['file_name'];
		}
			$data= array(
				'id'=>$id,
				'laporan_status'=>$laporan_status,
				'keterangan_status'=>$keterangan_status,
				'tindaklanjut'=>$tindaklanjut,
				'keterangan_tindaklanjut'=>$keterangan_tindaklanjut,
				'tanggal_tindaklanjut'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
				'foto_tindaklanjut'=>$foto_tindaklanjut,
				'status'=>$status
			);
			$where   = array(
				'id' => $id
			);
			$table  = 'tbl_laporan';
			$this->c_model->update($data,$where,$table);
			 echo $this->session->set_flashdata('msg','success');
					redirect('admin/laporan');
	   }

	function update_laporan_disabilitas(){
		$id=$this->input->post('xkode_edit');
		$status=$this->input->post('x_status_edit');
		$keterangan=$this->input->post('x_keterangan_edit');
	
		$data= array(
			'status'=>$status,
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
		$tiketaduan=$dl['id'];
		$judul_laporan=$dl['judul_laporan'];
		$isi_laporan=$dl['isi_laporan'];
		$sumber_aduan=$dl['sumber_aduan'];
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

		$datawhatsapp=$this->m_admin->getWhatsapp($id_kepada);
		$da=$datawhatsapp->row_array();
		$whatsapp=$da['pengguna_nohp'];
		
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
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'ssl://smtp.gmail.com', 
			'smtp_port' 	=> 465,
			'smtp_user' 	=> 'laporbupatiwonosobo@gmail.com',
			'smtp_pass' 	=> 'nbubebgyefzppslm',
			// 'smtp_username' => 'laporbupatiwonosobo@gmail.com',
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'Content-Type'	=> 'text/plain',
			'Content-Transfer-Encoding'=> '8bit',
			'wordwrap' 		=> TRUE
	        );

	  	$message = 	"
			<html>
			<head>
				<title>Laporan Masuk </title>
			</head>
			<body>
				<h3>Laporan baru mohon Kepada ".$nama." untuk segera ditindaklanjuti</h3>
				<p></p>
				<p>Judul Laporan    : ".$judul_laporan."</p>
				<p>Rincian Laporan  : ".$isi_laporan."</p>
				<p>Tindaklanjuti laporan dengan kunjungi <a href=https://laporbupati.wonosobokab.go.id/admin><b>Lapor Bupati Wonosobo</b></a> </p>
				<p>Lapor Bupati Wonosobo tidak akan pernah meminta anda untuk memberi tahu kata sandi atau informasi akun pribadi anda kepada kami melalui email/whatsapp. Anda hanya akan diminta untuk memasukkan password anda ketika anda masuk ke sistem Lapor Bupati Wonosobo.  Jika anda menerima email/whatsapp yang mencurigakan atau terjadi kesalahan tujuan pengiriman, mohon laporkan hal tersebut kepada kami melalui kontak Email : <b>laporbupatiwonosobo@gmail.com</b> untuk penyelidikan lebih lanjut.</p>
			</body>
			</html>
			";
	
			// var_dump($message);
			// die;
		
		$message2 = "*Notifikasi Laporan Aduan Baru*\n\nKepada Yth. :\n*".$nama." Kab. Wonosobo*\n\nDengan hormat,\nDimohon untuk segera menindaklanjuti laporan Aduan baru sebagai berikut:\n\n*No. Tiket Aduan :*\nLB".$sumber_aduan."-".$tiketaduan."\n\n*Judul Laporan :*\n".$judul_laporan."\n\n*Tindaklanjuti laporan dengan kunjungi :*\nhttps://laporbupati.wonosobokab.go.id/admin\n\nTerima Kasih\n*Lapor Bupati Wonosobo*\n\n*NB :*\nLapor Bupati Wonosobo tidak akan pernah meminta anda untuk memberi tahu kata sandi atau informasi akun pribadi anda kepada kami melalui email/whatsapp. Anda hanya akan diminta untuk memasukkan password anda ketika anda masuk ke sistem Lapor Bupati Wonosobo.  Jika anda menerima email/whatsapp yang mencurigakan atau terjadi kesalahan tujuan pengiriman, mohon laporkan hal tersebut kepada kami melalui kontak Email : *laporbupatiwonosobo@gmail.com* untuk penyelidikan lebih lanjut.";

		// Inisialisasi client Guzzle
        $client = new Client(['base_uri' => 'https://pati.wablas.com/api/']);

        // Set konfigurasi untuk request
        $requestConfig = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'ACUaUOlDCKoy8XkWsfmDBfr8hQM7zqs7sp18OStbMZ7lTWHz9pDaEAcOM5oEMnKj'
            ],
            'json' => [
                'phone' => $whatsapp,
                'message' => $message2
            ]
        ];

        // Kirim request ke API Chat API untuk mengirim pesan WhatsApp
        $response = $client->request('POST', 'send-message', $requestConfig);

        // Ambil status code dari response
        $statusCode = $response->getStatusCode();

        // Tampilkan response dalam bentuk JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

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
		}

		$this->c_model->update($data,$where,$table);

		redirect('admin/laporan');
	}

	function update_notifwapengadu(){
		$id=$this->input->post('x_kode_notifwapengadu');
		$datalaporan=$this->m_laporan->get_laporan_by_kode($id);
		$dl=$datalaporan->row_array();
		$tiketaduan=$dl['id'];
		$email=$dl['email'];
		$whatsapp=$dl['hp'];
		$nama=$dl['nama'];
		$judul_laporan=$dl['judul_laporan'];
		$isi_laporan=$dl['isi_laporan'];

		// Config Send Email
		$config = array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'ssl://smtp.gmail.com', 
			'smtp_port' 	=> 465,
			'smtp_user' 	=> 'laporbupatiwonosobo@gmail.com',
			'smtp_pass' 	=> 'nbubebgyefzppslm',
			// 'smtp_username' => 'laporbupatiwonosobo@gmail.com',
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'Content-Type'	=> 'text/plain',
			'Content-Transfer-Encoding'=> '8bit',
			'wordwrap' 		=> TRUE
	        );

	  	$message = 	"
			<html>
			<head>
				<title>Tracking Progres Aduan Lapor Bupati Wonosobo</title>
			</head>
			<body>
				<h3>Kepada Yth.: ".$nama."</h3>
				<p></p>
				<p>Berikut Kami sampaikan Link Pantauan Aduan Saudara pada Kanal Lapor Bupati Wonosobo, sebagai berikut:</p>
				<p>No. Tiket Aduan  : <b>LB".$sumber_aduan."-".$tiketaduan."</b></p>
				<p>Judul Laporan    : ".$judul_laporan."</p>
				<p>Rincian Laporan  : ".$isi_laporan."</p>
				<p></p>
				<p>Silahkan Klik Link ini untuk melihat progres tindak lanjut : <a href=https://laporbupati.wonosobokab.go.id/home/detail/".$tiketaduan."><b>Pantau Progres Aduan</b></a></p>
				<p></p>
				<p>Lapor Bupati Wonosobo tidak akan pernah meminta anda untuk memberi tahu kata sandi atau informasi akun pribadi anda kepada kami melalui email/whatsapp. Jika anda menerima email/whatsapp yang mencurigakan atau terjadi kesalahan tujuan pengiriman, mohon laporkan hal tersebut kepada kami melalui kontak Email : <b>laporbupatiwonosobo@gmail.com</b> untuk penyelidikan lebih lanjut.</p>
			</body>
			</html>
			";
		
		// Config Send Whatsapp

	  	$message2 = "*Tracking Progres Lapor Bupati Wonosobo*\n\nKepada Yth. :\n*".$nama."*\n\nDengan hormat,\nBerikut kami sampaikan Link Pantauan Progres tindak lanjut Aduan Saudara pada Kanal Lapor Bupati Wonosobo sebagai berikut:\n\n*No. Tiket Aduan :*\nLB".$sumber_aduan."-".$tiketaduan."\n\n*Judul Laporan :*\n".$judul_laporan."\n\n*Silahkan klik Tautan dibawah untuk memantau Progres Tindaklanjut :*\nhttps://laporbupati.wonosobokab.go.id/home/detail/".$tiketaduan."\n\nTerima Kasih\n*Lapor Bupati Wonosobo*";

		// Inisialisasi client Guzzle
        $client = new Client(['base_uri' => 'https://pati.wablas.com/api/']); // Diganti sesuai URL Langganan API Whatsapp

        // Set konfigurasi untuk request
        $requestConfig = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'ACUaUOlDCKoy8XkWsfmDBfr8hQM7zqs7sp18OStbMZ7lTWHz9pDaEAcOM5oEMnKj'
            ],
            'json' => [
                'phone' => $whatsapp,
                'message' => $message2
            ]
        ];

        // Kirim request ke API Chat API untuk mengirim pesan WhatsApp
        $response = $client->request('POST', 'send-message', $requestConfig);

        // Ambil status code dari response
        $statusCode = $response->getStatusCode();

        // Tampilkan response dalam bentuk JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

		// var_dump($message2);
		// die;

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user']);
		$this->email->to($email);
		$this->email->subject('Tracking Progres Tindaklanjut Lapor Bupati Wonosobo');
		$this->email->message($message);

		if($this->email->send()){
			$this->session->set_flashdata('message','email2');
		}
		else{
			$this->session->set_flashdata('message', 'email gagal');
		}
		
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

		$data = array(
		'laporan_status'=>1,                       
		'id_kepada'=>"",
		'ditujukan_kepada'=>"",
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
		
		if ($tayang =='Ya'){
			$data = array(
				'tayang'=>'Tidak'
				);
			}else{
			$data = array(
				'tayang'=>'Ya'
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
		$kode=$this->input->post('xkode_hapus');
		$audio=$this->input->post('x_nama_file_hapus');
		$path='./assets/audio/'.$audio;
		unlink($path);
		$this->m_laporan->hapus_laporan_disabilitas($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/laporan/disabilitas');
	}

}