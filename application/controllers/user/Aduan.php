<?php
class Aduan extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('m_kategori_laporan');  //belum
		$this->load->model('m_aduan');
		$this->load->model('c_model');
		$this->load->model('m_laporan');   //sudah
		$this->load->model('m_admin');  //belum
		$this->load->model('m_kepada');
		$this->load->library('upload');    //belum
	}


	function index(){
		$x['data']=$this->m_aduan->get_all_aduan();
		$this->load->view('user/v_aduan',$x);
	}

	function byid(){
		$code=$this->session->userdata("id");
		$x['data']=$this->m_aduan->view_aduan_byid($code);
		$this->load->view('user/v_aduan_byid',$x);
	}	

	function add_aduan(){    //masyon
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada(); //===> get fraksi //masyon
		//$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan(); ===> get anggota dewan  //masyon
		$this->load->view('user/v_add_aduan',$x);
	}

	function get_edit(){
		$kode=$this->uri->segment(4); //ambil yuri
		//print_r($this->uri->segment(4));
		$x['data']=$this->m_aduan->get_aduan_by_kode($kode);
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada();
		//print_r($this->m_laporan->get_laporan_by_kode($kode));
		$this->load->view('user/v_edit_aduan',$x);
	}

	function view(){
		$kode=$this->uri->segment(4); //ambil yuri
		//print_r($this->uri->segment(4));
		$x['data']=$this->m_aduan->get_aduan_by_kode($kode);
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada();
		//print_r($this->m_laporan->get_laporan_by_kode($kode));
		$this->load->view('user/v_view_aduan',$x);
	}


	function kirim(){
		$config['upload_path'] = './assets/images/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
		$config['encrypt_name'] = TRUE; 
		$this->upload->initialize($config);
		$recaptcha = $this->input->post('g-recaptcha-response');
		//////////////////////////////////////////////////////////
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$id = substr(str_shuffle($set), 0, 15);

		$kategori_laporan=1;
		$lokasi=$this->input->post('x_lokasi');
		$judul_laporan=$this->input->post('x_judul_laporan'); //--
		$isi_laporan=$this->input->post('x_isi_laporan');  //--
		
		$nama=$this->input->post('x_nama'); //--
		$email=$this->input->post('x_email');  //--
		$hp=$this->input->post('x_hp').'-'."Website Lapor Bupati";
		$laporan_status=1;
		$status=1;
		$tayang= 'tidak';
	
		if (!empty($recaptcha)) {
			if(!empty($_FILES['x_foto']['name']))
			{
				if ($this->upload->do_upload('x_foto'))
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
							'penginput'=>$nama,
							'kategori_laporan'=>$kategori_laporan,
							'judul_laporan'=>$judul_laporan,
							'lokasi'=>$lokasi,
							'isi_laporan'=>$isi_laporan,
							'nama'=>$nama,
							'email'=>$email,
							'hp'=>$hp,
							'laporan_status'=>$laporan_status,
							'tayang'=>$tayang,
							'status'=>$status,
							'foto'=>$foto
						);
						$table  = 'tbl_laporan';
						$this->c_model->simpan($data,$table);		

						$this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu pemberitahuan selanjutnya melalui email/kontak hp yang tercantum </a>');
						redirect('');
				}else{
					echo $this->session->set_flashdata('gagal','warning');
					redirect('');
				}
					
			}else{
				$data= array(
					'id'=>$id,
					'penginput'=>$nama,
					'kategori_laporan'=>$kategori_laporan,
					'judul_laporan'=>$judul_laporan,
					'lokasi'=>$lokasi,
					'isi_laporan'=>$isi_laporan,
					'nama'=>$nama,
					'email'=>$email,
					'hp'=>$hp,
					'laporan_status'=>$laporan_status,
					'tayang'=>$tayang,
					'status'=>$status
				);
				$table  = 'tbl_laporan';
				$this->c_model->simpan($data,$table);
				
				$this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu pemberitahuan selanjutnya melalui email/kontak hp yang tercantum </a>');
				redirect('');
			}
		}else{
			echo $this->session->set_flashdata('gagal','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Isikan Captcha !!</a></div>');
			redirect('');
		}
	}

	function kirim_aduan_disabilitas(){
		// echo $_FILES['x_audio']['name'];
		// $aud = $this->upload->data();
		// 				$audio=$aud['file_name'];
		// 				$nama_file=$audio;
		// 				echo $nama_file;
						// die();
		$config['upload_path']   = './assets/audio/'; 
		$config['allowed_types'] = "*"; 
		$config['file_name']     = 'Rekaman_'.time().".webm";
        $config['overwrite']     = true;
        $config['max_size']      = 2048; // 1024, 2048
		$this->upload->initialize($config);
		$status=1;
		$keterangan="";
			
		if(!empty($_FILES['x_audio']['name'])) {
		
			if ($this->upload->do_upload('x_audio')) {
						$aud = $this->upload->data();
						$audio=$aud['file_name'];
						$nama_file=$audio;
						$data= array(
							'nama_file'=>$nama_file,
							'status'=>$status,
							'keterangan'=>$keterangan,
							'created_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
						);
						$table  = 'tbl_laporan_disabilitas';
						$this->c_model->simpan($data,$table);		
						$this->output->set_header('HTTP/1.0 200 OK');

						// $this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu pemberitahuan selanjutnya melalui email/kontak hp yang tercantum </a>');
						// redirect('');
						
					
				}else{
					
					
					$this->output->set_header('HTTP/1.0 400 BAD sudahlah');
				}	
			}else{
				$data= array(
					'status'=>$status,
					'keterangan'=>$keterangan,
					'created_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
				);
				$table  = 'tbl_laporan_disabilitas';
				$this->c_model->simpan($data,$table);
				
				$this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu pemberitahuan selanjutnya melalui email/kontak hp yang tercantum </a>');
				redirect('');
			}
	}
	
	function kirim_aduan_disabilitas2(){
		$config['upload_path'] = './assets/audio/'; 
		$config['allowed_types'] = 'wav|webm'; 
		$config['encrypt_name'] = TRUE; 
		$this->upload->initialize($config);
		//$recaptcha = $this->input->post('g-recaptcha-response');
		//////////////////////////////////////////////////////////
		//$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		//$id = substr(str_shuffle($set), 0, 15);

		//$kategori_laporan=1;
		$status=1;
		$keterangan="";
		//$isi_laporan=$this->input->post('x_isi_laporan');  //--
		//$nama=$this->input->post('x_nama'); //--
		//$email=$this->input->post('x_email');  //--
		//$hp=$this->input->post('x_hp').'-'."Website Lapor Bupati";
		//$laporan_status=1;
		//$status=1;
		//$tayang= 'tidak';
			
			 if (!isset($_POST['audio-filename']) && !isset($_POST['video-filename'])) {
        echo 'Empty file name.';
        return;
    }

    // do NOT allow empty file names
    if (empty($_POST['audio-filename']) && empty($_POST['video-filename'])) {
        echo 'Empty file name.';
        return;
    }

    // do NOT allow third party audio uploads
    if (false && isset($_POST['audio-filename']) && strrpos($_POST['audio-filename'], "RecordRTC-") !== 0) {
        echo 'File name must start with "RecordRTC-"';
        return;
    }

    // do NOT allow third party video uploads
    if (false && isset($_POST['video-filename']) && strrpos($_POST['video-filename'], "RecordRTC-") !== 0) {
        echo 'File name must start with "RecordRTC-"';
        return;
    }
    
    $fileName = '';
    $tempName = '';
    $file_idx = '';
    
    if (!empty($_FILES['audio-blob'])) {
        $file_idx = 'audio-blob';
        $fileName = $_POST['audio-filename'];
        $tempName = $_FILES[$file_idx]['tmp_name'];
    } else {
        $file_idx = 'video-blob';
        $fileName = $_POST['video-filename'];
        $tempName = $_FILES[$file_idx]['tmp_name'];
    }
    
    if (empty($fileName) || empty($tempName)) {
        if(empty($tempName)) {
            echo 'Invalid temp_name: '.$tempName;
            return;
        }

        echo 'Invalid file name: '.$fileName;
        return;
    }

    /*
    $upload_max_filesize = return_bytes(ini_get('upload_max_filesize'));
    if ($_FILES[$file_idx]['size'] > $upload_max_filesize) {
       echo 'upload_max_filesize exceeded.';
       return;
    }
    $post_max_size = return_bytes(ini_get('post_max_size'));
    if ($_FILES[$file_idx]['size'] > $post_max_size) {
       echo 'post_max_size exceeded.';
       return;
    }
    */

    //$filePath = 'uploads/' . $fileName;
    
    $filePath = 'assets/audio/' . $fileName;
    
    // make sure that one can upload only allowed audio/video files
    $allowed = array(
        'webm',
        'wav',
        'mp4',
        'mkv',
        'mp3',
        'ogg'
    );
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
        echo 'Invalid file extension: '.$extension;
        return;
    }
    
    if (!move_uploaded_file($tempName, $filePath)) {
        if(!empty($_FILES["file"]["error"])) {
            $listOfErrors = array(
                '1' => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                '2' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                '3' => 'The uploaded file was only partially uploaded.',
                '4' => 'No file was uploaded.',
                '6' => 'Missing a temporary folder. Introduced in PHP 5.0.3.',
                '7' => 'Failed to write file to disk. Introduced in PHP 5.1.0.',
                '8' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
            );
            $error = $_FILES["file"]["error"];

            if(!empty($listOfErrors[$error])) {
                echo $listOfErrors[$error];
            }
            else {
                echo 'Not uploaded because of error #'.$_FILES["file"]["error"];
            }
        }
        else {
            echo 'Problem saving file: '.$tempName;
        }
        return;
    }
    
    echo 'success';
		

			if(!empty($_FILES['audio-filename']['name']))
			{
				if ($this->upload->do_upload('audio-filename'))
				{
						$gbr = $this->upload->data();
						$audio=$gbr['file_name'];
			
	$fileName = '';
    $tempName = '';
    $file_idx = '';
    
    if (!empty($_FILES['audio-blob'])) {
        $file_idx = 'audio-blob';
        $fileName = $_POST['audio-filename'];
        $tempName = $_FILES[$file_idx]['tmp_name'];
    } else {
        $file_idx = 'video-blob';
        $fileName = $_POST['video-filename'];
        $tempName = $_FILES[$file_idx]['tmp_name'];
    }
    
    if (empty($fileName) || empty($tempName)) {
        if(empty($tempName)) {
            echo 'Invalid temp_name: '.$tempName;
            return;
        }

        echo 'Invalid file name: '.$fileName;
        return;
    }

						$nama_file=$filename;

						$data= array(
							'nama_file'=>$nama_file,
							'status'=>$status,
							'keterangan'=>$keterangan,
							'created_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
							//'modifed_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
						);
						$table  = 'tbl_laporan_disabilitas';
						$this->c_model->simpan($data,$table);		

						$this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu pemberitahuan selanjutnya melalui email/kontak hp yang tercantum </a>');
						redirect('');
				}else{
					echo $this->session->set_flashdata('gagal','warning');
					redirect('');
				}
					
			}else{
				$data= array(
					//'nama_file'=>$nama_file,
					'status'=>$status,
					'keterangan'=>$keterangan,
					'created_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
					//'modifed_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
				);
				$table  = 'tbl_laporan_disabilitas';
				$this->c_model->simpan($data,$table);
				
				$this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu pemberitahuan selanjutnya melalui email/kontak hp yang tercantum </a>');
				redirect('');
			}
		
	}

	function hapus_aduan(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_aduan->hapus_aduan($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('user/aduan/byid');
	}

}