<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


 
class Dewan extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_laporan');
	}


	public function index_get() 
	{
		$id = $this->get('id_anggota');
		if ($id === null){
			$data = $this->M_laporan->xapi();

		} else {
			$data = $this->M_laporan->xapi($id);
		}
		
		// var_dump($mahasiswa);
		if($data){
		    $this->response([
                    'status' => true,
                    'data' => $data
                ], REST_Controller::HTTP_OK);
		} else {
			   $this->response([
                    'status' => false,
                    'data' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);

		}
	}


	public function index_delete()
	{
		// $id = $this->delete('id');

		// if($id === null){
		// 		 $this->response([
  //                   'status' => false,
  //                   'data' => 'provide an id'
  //               ], REST_Controller::HTTP_BAD_REQUEST);
		// } else {

		// 	if ($this->Mahasiswa_model->deleteMahasiswa($id) > 0 ) {

		// 		$this->response([
  //                   'status' => true,
  //                   'id' => $id,
  //                   'message' => 'deleted'
  //               ], REST_Controller::HTTP_NO_CONTENT);
			
		// 	} else {
			
		// 		   $this->response([
  //                   'status' => false,
  //                   'data' 	=> 'id not found'
  //               ], REST_Controller::HTTP_BAD_REQUEST);
		// 	}
		// }
	}

	public function index_post()
	{
		// $data = [
		// 'nrp'		=> $this->post('nrp'),
		// 'nama'		=> $this->post('nama'),
		// 'email'		=> $this->post('email'),
		// 'jurusan'	=> $this->post('jurusan')
		// ];

		// if ($this->Mahasiswa_model->createMahasiswa($data) > 0){
		// 			$this->response([
  //                   'status' 	=> true,
  //                   'message' 	=> 'data mahasiswa baru telah berhasil ditambahkan'
  //               ], REST_Controller::HTTP_CREATED);
		// } else {
		// 		    $this->response([
  //                   'status' => false,
  //                   'data' 	=> 'gagal menambahkan data baru'
  //               ], REST_Controller::HTTP_BAD_REQUEST);
		// }

	}

	public function index_put()
	{
		$id = $this->put('id');

		$status = 2;

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