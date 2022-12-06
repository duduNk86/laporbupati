<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_user','user');
		$this->load->model('m_cek');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');

        //get all users
        $this->data['users'] = $this->user->getAllUsers();
	}

	public function index(){
		$this->load->view('user/v_register2', $this->data);
	}

	function register2(){			
			// $nama=$this->input->post('nama');
			// $hp=$this->input->post('hp');
			// $email = $this->input->post('email');
			// $username=$this->input->post('username');
			// $password = $this->input->post('password');
			// print_r($nama);
			// print_r($hp);
			// print_r($email);
			// print_r($username);
			// print_r($password);

	}

	public function register(){
		$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]');
		$this->form_validation->set_rules('hp', 'Hp', 'required|min_length[11]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');		
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
		$this->form_validation->set_rules('username','Username','required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');




        if ($this->form_validation->run() == FALSE) {
         	$this->load->view('user/v_register2', $this->data);
		}
		else{
			// $this->session->set_flashdata('message','Kode Akvifasi telah dikirim ke email anda, silahkan buka email dan klik link aktivasi </br> Setelah Itu Klik Login <a href="login"><b>DISINI</b></a>');
			//----------------get user inputs
			$nama=$this->input->post('nama');
			$hp=$this->input->post('hp');
			$alamat=$this->input->post('alamat');
			$email = $this->input->post('email');
			$username=$this->input->post('username');
			$password = $this->input->post('password');


			$cemail=$this->m_cek->cek_email($email);
			$cuser=$this->m_cek->cek_user($username); //kurang elseif 29 01 2020

		        if($cemail->num_rows() > 0){
		        	$this->session->set_flashdata('message', 'registrasi gagal, email sudah terdaftar');
		        	redirect('registrasi');

		            
		        }else{
		        	//-----------------generate simple random code
					$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 12);

					//------------------insert user to users table and get id
					$setu = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$id = substr(str_shuffle($setu), 0, 17);
					$user['id'] = $id;
					$user['nama']=$nama;
					$user['hp']=$hp;
					$user['alamat']=$alamat;
					$user['email'] = $email;
					$user['username']=$username;
					$user['password'] = sha1(sha1(md5($password)));
					$user['code'] = $code;
					$user['active'] = false;
					$anggaran=$this->input->post('xanggaran');
					

					$this->user->insert($user);


					//-------------------set up email
					$config = array(
				  		'protocol' => 'smtp',
				  		'smtp_host' => 'ssl://smtp.gmail.com',  //harus pakai ssl
				  		'smtp_port' => 465,
				  		'smtp_user' => 'dprdwonosobo@gmail.com',
				  		'smtp_pass' => '123jirolu',
				  		'smtp_username' => 'dprdwonosobo@gmail.com',
				  		'mailtype' => 'html',
				  		'charset' => 'iso-8859-1',
				  		'Content-Type'=>'text/plain',
				  		'Content-Transfer-Encoding'=>'8bit',
				  		'wordwrap' => TRUE
					);

					$message = 	"
								<html>
								<head>
									<title>Verifikasi Email</title>
								</head>
								<body>
									<h2>Terimakasih Saudara " .$nama." Sudah Mendaftar Dewan Dengar Dewan Jawab (D3J).</h2>
									<p>Your Account:</p>
									<p>Email pendaftaran: ".$email."</p>
									<p>Username: ".$username."</p>
									<p>Password: ".$password."</p>
									<p> Silahkan Klik link dibawah ini untuk mengaktifkan akun.</p>
									<h4><a href='".base_url()."registrasi/activate/".$id."/".$code."'>Klik disini untuk aktifkan Akun</a></h4>
									<p>Kebijakan Privasi dan Keamanan</p>
									<p> DPR Wonosobo! tidak akan pernah meminta anda untuk memberi tahu kata sandi atau informasi akun pribadi anda kepada kami melalui email. Anda hanya akan diminta untuk memasukkan password anda ketika anda masuk ke website kami. Kami menggunakan langkah-langkah untuk memastikan keamanan anda melakukan kegiatan di website kami dan melindungi kerahasiaan informasi pribadi yang anda berikan kepada kami. Kami juga melakukan segala upaya untuk memastikan email-email yang kami kirimkan telah melalui proses pengecekan virus sebelum dikirimkan. Jika anda menerima email yang mencurigakan atau terjadi kesalahan tujuan pengiriman, mohon laporkan hal tersebut kepada kami di contact dprdwonosobo@gmail.com untuk penyelidikan lebih lanjut.</p>
								</body>
								</html>
								";
			 		
				    $this->load->library('email', $config);
				    $this->email->set_newline("\r\n");
				    $this->email->from($config['smtp_user']);
				    $this->email->to($email);
				    $this->email->subject('Verifikasi Pendaftaran Email');
				    $this->email->message($message);

				    //---------sending email//////
				    if($this->email->send()){
				    	$this->session->set_flashdata('message','Kode Akvifasi telah dikirim ke email anda, silahkan buka email dan klik link aktivasi </br> Setelah Itu Klik Login <a href="login"><b>DISINI</b></a>');
				    }
				    else{
				    	$this->session->set_flashdata('message', 'pendaftaran gagal');
				    	// $this->session->set_flashdata('message', '$this->email->print_debugger()');
			 
				    }
				    ///////////////////////////////
		        	redirect('registrasi');
		            
		        }
			



		}

	}

	public function activate(){
		$id =  $this->uri->segment(3);
		$code = $this->uri->segment(4);

		//fetch user details
		$user = $this->user->getUser($id);

		//if code matches
		if($user['code'] == $code){
			//update user active status
			$data['active'] = true;
			$query = $this->user->activate($data, $id);

			if($query){
				$this->session->set_flashdata('message', 'Aktivasi User Sukses, Silahkan login lewat aplikasi');
			}
			else{
				$this->session->set_flashdata('message', 'Something went wrong in activating account');
			}
		}
		else{
			$this->session->set_flashdata('message', 'User gagal aktivasi, kode tidak ditemukan');
		}

		redirect('sukses');

	}

}
