<?php

use GuzzleHttp\Client;

class Aduan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_kategori_laporan');
		$this->load->model('m_aduan');
		$this->load->model('c_model');
		$this->load->model('m_laporan');
		$this->load->model('m_admin');
		$this->load->model('m_kepada');
		$this->load->library('upload');
		$this->load->library('guzzle');
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

		// $kategori_laporan=1;
		$lokasi=$this->input->post('x_lokasi');
		$judul_laporan=$this->input->post('x_judul_laporan');
		$kategori_laporan=$this->input->post('x_kategorilaporan');
		$subkategori_laporan=$this->input->post('x_subkategorilaporan');
		$topik_laporan=$this->input->post('x_topiklaporan');
		$isi_laporan=$this->input->post('x_isi_laporan');
		$nama=$this->input->post('x_nama');
		$alamat=$this->input->post('x_alamat'); 
		$email=$this->input->post('x_email');
		$hp=$this->input->post('x_hp');
		$sumber_aduan='LB';
		$laporan_status=1;
		$status=1;
		$rating_jawaban=0;
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
						$config['width']= 1080; //840
						$config['height']= 960; //450
						$config['new_image']= './assets/images/'.$gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$gambar=$gbr['file_name'];
						$foto=$gambar;

						//Conversi Nomor Handphone menjadi 62
						$this->load->library('hp_converter');
						$phone_number = $hp;
						$converted_phone_number = $this->hp_converter->convert($phone_number);

						$data= array(
							'id'=>$id,
							'penginput'=>$nama,
							// 'kategori_laporan'=>$kategori_laporan,
							'judul_laporan'=>$judul_laporan,
							'kategori_laporan'=>$kategori_laporan,
							'subkategori_laporan'=>$subkategori_laporan,
							'topik_laporan'=>$topik_laporan,
							'lokasi'=>$lokasi,
							'isi_laporan'=>$isi_laporan,
							'nama'=>$nama,
							'alamat'=>$alamat,
							'email'=>$email,
							'hp'=>$converted_phone_number,
							'sumber_aduan'=>$sumber_aduan,
							'laporan_status'=>$laporan_status,
							'tayang'=>$tayang,
							'status'=>$status,
							'rating_jawaban'=>$rating_jawaban,
							'foto'=>$foto
						);
						$table  = 'tbl_laporan';
						$this->c_model->simpan($data,$table);		

						// Config Send Whatsapp
						// Ambil nomor penerima dan pesan dari post data
						// $whatsapp = '6282111557773'; //Nomer Admin Lapor Bupati
						// $whatsapp = array('6282111557773', '6281234567890', '6289876543210');
						// $whatsapp = '6285727809909-1486974576'; //Group Diskominfo - Bot Diskominfo
						// $whatsapp = '6285867450008-1497845195'; //Group DC - Bot Diskominfo
						// $whatsapp = '6285228496532-1572318378'; //Group IKP - Bot Diskominfo
						$whatsapp = '6282314313335-1589939868'; // Group Tim Lapor Bupati - Bot Lapor Bupati

						$message2 = "*Notifikasi Laporan Aduan Baru*\n\nKepada Yth. :\n*Admin Lapor Bupati Wonosobo*\n\nDengan hormat,\nDimohon untuk segera *Memproses/Verifikasi* laporan Aduan baru sebagai berikut:\n\n*No. Tiket Aduan :*\nLBLB-".$id."\n\n*Judul Laporan :*\n".$judul_laporan."\n\n*Proses Verifikasi Disini :*\nhttps://laporbupati.wonosobokab.go.id/admin\n\nTerima Kasih\n*Lapor Bupati Wonosobo*";

						// $url_whatsapp = 'https://api.whatsapp.com/send?phone=' . $whatsapp . '&text=' . urlencode($message2);
						
						// Inisialisasi client Guzzle
						// $client = new Client(['base_uri' => 'https://api.chat-api.com/']); // Diganti sesuai URL Langganan API Whatsapp
						$client = new Client(['base_uri' => 'https://pati.wablas.com/api/']);

						// Set konfigurasi untuk request
						$requestConfig = [
							'headers' => [
								'Content-Type' => 'application/json',
								'Authorization' => 'ACUaUOlDCKoy8XkWsfmDBfr8hQM7zqs7sp18OStbMZ7lTWHz9pDaEAcOM5oEMnKj' // Bot Lapor Bupati
								//'Authorization' => 'y59Vw77031Tpb0Cv8dbO5QyJVKVKi6EXoWqHCVZaVDntDUIViSMQuWvz2jkNwePM' //Bot Diskominfo
							],
							'json' => [
								'phone' => $whatsapp,
								'message' => $message2,
								'isGroup' => 'true'
							]
						];

						// Kirim request ke API Chat API untuk mengirim pesan WhatsApp
						$response = $client->request('POST', 'send-message', $requestConfig);

						// Ambil status code dari response
						$statusCode = $response->getStatusCode();

						// Tampilkan response dalam bentuk JSON
						$this->output->set_content_type('application/json')->set_output(json_encode($data));

						$this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu Notifikasi melalui Email/HP/WhatsApp yang dicantumkan. Selanjutnya, luangkan waktu Anda sejenak untuk mengisi Survey Layanan dibawah ini. Jawaban Anda digunakan sebagai bahan Evaluasi Kinerja kami. Terima Kasih.');
						redirect('home/survei');
				}else{
					echo $this->session->set_flashdata('gagal','warning');
					redirect('');
				}
					
			}else{
				
				// Conversi Nomor Handphone menjadi 62
				$this->load->library('hp_converter');
				$phone_number = $hp;
				$converted_phone_number = $this->hp_converter->convert($phone_number);
				
				$data= array(
					'id'=>$id,
					'penginput'=>$nama,
					'judul_laporan'=>$judul_laporan,
					'kategori_laporan'=>$kategori_laporan,
					'subkategori_laporan'=>$subkategori_laporan,
					'topik_laporan'=>$topik_laporan,
					'lokasi'=>$lokasi,
					'isi_laporan'=>$isi_laporan,
					'nama'=>$nama,
					'alamat'=>$alamat,
					'email'=>$email,
					'hp'=>$converted_phone_number,
					'sumber_aduan'=>$sumber_aduan,
					'laporan_status'=>$laporan_status,
					'tayang'=>$tayang,
					'status'=>$status,
					'rating_jawaban'=>$rating_jawaban
				);
				$table  = 'tbl_laporan';
				$this->c_model->simpan($data,$table);
				
				// Config Send Whatsapp
				// Ambil nomor penerima dan pesan dari post data
				$whatsapp = '6282314313335-1589939868'; // Group Tim Lapor Bupati - Bot Lapor Bupati

				$message2 = "*Notifikasi Laporan Aduan Baru*\n\nKepada Yth. :\n*Admin Lapor Bupati Wonosobo*\n\nDengan hormat,\nDimohon untuk segera *Memproses/Verifikasi* laporan Aduan baru sebagai berikut:\n\n*No. Tiket Aduan :*\nLBLB-".$id."\n\n*Judul Laporan :*\n".$judul_laporan."\n\n*Proses Verifikasi Disini :*\nhttps://laporbupati.wonosobokab.go.id/admin\n\nTerima Kasih\n*Lapor Bupati Wonosobo*";
				
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
						'message' => $message2,
						'isGroup' => 'true'
					]
				];

				// Kirim request ke API Chat API untuk mengirim pesan WhatsApp
				$response = $client->request('POST', 'send-message', $requestConfig);

				// Ambil status code dari response
				$statusCode = $response->getStatusCode();

				// Tampilkan response dalam bentuk JSON
				$this->output->set_content_type('application/json')->set_output(json_encode($data));

				$this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu Notifikasi melalui Email/HP/WhatsApp yang dicantumkan. Selanjutnya, luangkan waktu Anda sejenak untuk mengisi Survey Layanan dibawah ini. Jawaban Anda digunakan sebagai bahan Evaluasi Kinerja kami. Terima Kasih.');
				redirect('home/survei');
			}
		}else{
			echo $this->session->set_flashdata('gagal','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Isikan Captcha !!</div>');
			redirect('');
		}
	}

	function kirim_aduan_disabilitas(){
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
						
						// Config Send Whatsapp
						// Ambil nomor penerima dan pesan dari post data
						// $whatsapp = '6282111557773';
						$whatsapp = '6282314313335-1589939868'; // Group Tim Lapor Bupati - Bot Lapor Bupati

						$message2 = "*Notifikasi Laporan Aduan Disabilitas Baru*\n\nKepada Yth. :\n*Admin Lapor Bupati Wonosobo*\n\nDengan hormat,\nDimohon untuk segera *Memproses/Verifikasi* laporan Aduan Disabilitas baru sebagai berikut:\n\n*File Audio Aduan :*\n".$nama_file."\n\n*Proses Verifikasi Disini :*\nhttps://laporbupati.wonosobokab.go.id/admin\n\nTerima Kasih\n*Lapor Bupati Wonosobo*";
						
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
								'message' => $message2,
								'isGroup' => 'true'
							]
						];

						// Kirim request ke API Chat API untuk mengirim pesan WhatsApp
						$response = $client->request('POST', 'send-message', $requestConfig);

						// Ambil status code dari response
						$statusCode = $response->getStatusCode();

						// Tampilkan response dalam bentuk JSON
						// $this->output->set_content_type('application/json')->set_output(json_encode($data));
						
						$this->output->set_header('HTTP/1.0 200 Ok');
						// $this->session->set_flashdata('sukses','Laporan Anda sudah terkirim, silahkan menunggu pemberitahuan selanjutnya melalui email/kontak hp yang tercantum </a>');
						// redirect('');
						
				}else{
					$this->output->set_header('HTTP/1.0 400 Bad Request');
				}	
			}else{
				$data= array(
					'status'=>$status,
					'keterangan'=>$keterangan,
					'created_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
				);
				$table  = 'tbl_laporan_disabilitas';
				$this->c_model->simpan($data,$table);

				$this->session->set_flashdata('sukses','Laporan Anda telah terkirim! silahkan menunggu Link Tracking untuk Progres Tindaklanjutnya yang akan dikirimkan melalui nomor HP/WA yang telah disampaikan.');
				redirect('');
			}
	}

	function kirim_survei(){
		$recaptcha = $this->input->post('g-recaptcha-response');
		$nama=$this->input->post('x_nama');
		$email=$this->input->post('x_email');
		$pertanyaan1=$this->input->post('x_pertanyaan1');
		$pertanyaan2=$this->input->post('selected_rating1');
		$pertanyaan3=$this->input->post('selected_rating2');
		$pertanyaan4=$this->input->post('selected_rating3');
		$pertanyaan5=$this->input->post('selected_rating4');
		$kritik_saran=$this->input->post('x_kritik_saran');
	
		if (!empty($recaptcha)) {
				$data= array(
					'nama'=>$nama,
					'email'=>$email,
					'pertanyaan1'=>$pertanyaan1,
					'pertanyaan2'=>$pertanyaan2,
					'pertanyaan3'=>$pertanyaan3,
					'pertanyaan4'=>$pertanyaan4,
					'pertanyaan5'=>$pertanyaan5,
					'kritik_saran'=>$kritik_saran,
					'created_at'=>date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s'),
				);
				$table  = 'tbl_survei';
				$this->c_model->simpan($data,$table);
				
				$this->session->set_flashdata('sukses','Jawaban Anda sudah terkirim, terimakasih telah mengisi Survei. Jawaban Anda akan membantu kami dalam upaya untuk meningkatkan Layanan Lapor Bupati Wonosobo.');
				redirect('home/survei');
		} else {
			echo $this->session->set_flashdata('gagal','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Isikan Captcha !!</a></div>');
			redirect('home/survei');
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