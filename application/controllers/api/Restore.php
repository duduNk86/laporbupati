<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


 
class Restore extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_laporan');
	}


	public function index_get()
	{

	}


	public function index_delete()
	{

	}

	public function index_post()
	{


	}

	public function index_put()
	{
		$id = $this->put('id');

		$status = 1;

		if ($this->M_laporan->status($id,$status) > 0){
					$this->response([
                    'status' 	=> true,
                    'message' 	=> 'data telah berhasil diubah'
                ], REST_Controller::HTTP_NO_CONTENT);
		} else {
				    $this->response([
                    'status' => false,
                    'data' 	=> 'gagal ubah'
                ], REST_Controller::HTTP_BAD_REQUEST);
		}

	}



	// public function index_put()
	// {
	// 	$id = $this->put('id');

	// 	$data = [
	// 	'nrp'		=> $this->put('nrp'),
	// 	'nama'		=> $this->put('nama'),
	// 	'email'		=> $this->put('email'),
	// 	'jurusan'	=> $this->put('jurusan')
	// 	];

	// 	if ($this->Mahasiswa_model->updateMahasiswa($data, $id) > 0){
	// 				$this->response([
 //                    'status' 	=> true,
 //                    'message' 	=> 'data mahasiswa telah berhasil diubah'
 //                ], REST_Controller::HTTP_NO_CONTENT);
	// 	} else {
	// 			    $this->response([
 //                    'status' => false,
 //                    'data' 	=> 'gagal ubah data baru'
 //                ], REST_Controller::HTTP_BAD_REQUEST);
	// 	}

	// }



}