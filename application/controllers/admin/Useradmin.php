<?php
class Useradmin extends CI_Controller{
	function __construct(){
		parent::__construct();
        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin');
        }
		$this->load->model('m_admin');
		$this->load->model('c_model');
		$this->load->library('upload');
	}


	function index(){
		$x['title']='Lapor Bupati';
		$kode=$this->session->userdata('idadmin');
		$pengguna_level=$this->session->userdata('pengguna_level');
		$x['user']=$this->m_admin->get_pengguna_login($kode);
		$x['data']=$this->m_admin->get_all_pengguna();
		if ($pengguna_level=='1'){
			$this->load->view('admin/v_user_admin_new',$x);
			}
		if ($pengguna_level=='2'){
			$this->load->view('admin/v_user_admin_new_opd',$x);
			}
	}

	function simpan_pengguna(){
	            $config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	            $this->upload->initialize($config);
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
	                        $config['width']= 300;
	                        $config['height']= 300;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();

	                        $gambar=$gbr['file_name'];
	                        $nama=$this->input->post('xnama');
	                        $jenkel=$this->input->post('xjenkel');
	                        $username=$this->input->post('xusername');
	                        $password=$this->input->post('xpassword');
                            $konfirm_password=$this->input->post('xpassword2');
                            $email=$this->input->post('xemail');
                            $nohp=$this->input->post('xkontak');
							$level=$this->input->post('xlevel');
     						if ($password <> $konfirm_password) {
     							echo $this->session->set_flashdata('msg','error');
	               				redirect('admin/pengguna');
     						}else{
	               				$this->m_admin->simpan_pengguna($nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar);
	                    		echo $this->session->set_flashdata('msg','success');
	               				redirect('admin/pengguna');	
	               			}
	                    
	                }else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('admin/pengguna');
	                }
	                 
	            }else{
	            	$nama=$this->input->post('xnama');
	                $jenkel=$this->input->post('xjenkel');
	                $username=$this->input->post('xusername');
	                $password=$this->input->post('xpassword');
                    $konfirm_password=$this->input->post('xpassword2');
                    $email=$this->input->post('xemail');
                    $nohp=$this->input->post('xkontak');
					$level=$this->input->post('xlevel');
	            	if ($password <> $konfirm_password) {
     					echo $this->session->set_flashdata('msg','error');
	               		redirect('admin/pengguna');
     				}else{
	               		$this->m_admin->simpan_pengguna_tanpa_gambar($nama,$jenkel,$username,$password,$email,$nohp,$level);
	                    echo $this->session->set_flashdata('msg','success');
	               		redirect('admin/pengguna');
	               	}
	            } 

	}

	function add_pengguna(){

		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; 
		$config['encrypt_name'] = TRUE; 
		$this->upload->initialize($config);

		$max_id=$this->input->post('x_max_id');

		
		$pengguna_nama=$this->input->post('x_pengguna_nama'); 
		$pengguna_email=$this->input->post('x_pengguna_email'); 
		$pengguna_email_kantor=$this->input->post('x_pengguna_email_kantor'); 
		$pengguna_nohp=$this->input->post('x_pengguna_nohp'); 
		$pengguna_level=$this->input->post('x_pengguna_level'); 

		$pengguna_username=$this->input->post('x_pengguna_username'); 
		$pengguna_password=$this->input->post('x_pengguna_password'); 
		$pengguna_repassword=$this->input->post('x_pengguna_repassword'); 

		if(!empty($_FILES['x_pengguna_photo']['name']))
		{
			$this->upload->do_upload('x_pengguna_photo');
			$gbr = $this->upload->data();
			$pengguna_photo=$gbr['file_name'];
		}

			$data= array(
				'pengguna_idskpd'=>$max_id,
				'pengguna_nama'=>$pengguna_nama,
				'pengguna_email'=>$pengguna_email,
				'pengguna_email_kantor'=>$pengguna_email_kantor,
				'pengguna_nohp'=>$pengguna_nohp,
				'pengguna_level'=>$pengguna_level,
				'pengguna_username'=>$pengguna_username,
				'pengguna_password'=>sha1(sha1(md5($pengguna_password))),
				'pengguna_repassword'=>$pengguna_repassword,
				'pengguna_photo'=>$pengguna_photo
			);

			$data1= array(
				'id_opd'=>$max_id,
				'opd'=>$pengguna_nama,
				'opd_singkat'=>$pengguna_nama,
				'idkoordinasi'=>1
			);

			$table  = 'tbl_admin';
			$table1  = 'tbl_opd';
			$this->c_model->simpan($data,$table);
			$this->c_model->simpan($data1,$table1);

			 echo $this->session->set_flashdata('msg','success');
					redirect('admin/useradmin');
			
	   }
	   
	   function update_pengguna_reset(){
		$this->form_validation->set_rules('x_pengguna_password_edit', 'Password', 'required', array(
			'required' => '%s Harus Diisi !!!'
		));
		$this->form_validation->set_rules('x_pengguna_password_edit', 'Re-Password', 'required|matches[x_pengguna_password_edit]', array(
			'required' => '%s Password harus sama !!!'
		));
		// if ($this->form_validation->run()==FALSE) {
		// 	$kode=$this->session->userdata('idadmin');
		// 	$x['user']=$this->m_admin->get_pengguna_login($kode);
		// 	$x['data']=$this->m_admin->get_all_pengguna();
		// 	$this->load->view('admin/v_user_admin_new',$x);
		// }

		$pengguna_id=$this->input->post('x_pengguna_id_reset');

		$pengguna_username=$this->input->post('x_pengguna_username_reset');
		$pengguna_password=$this->input->post('x_pengguna_password_reset');
		$pengguna_repassword=$this->input->post('x_pengguna_repassword_reset');

			$data= array(
				'pengguna_username'=>$pengguna_username,
				'pengguna_password'=>sha1(sha1(md5($pengguna_password))),
				'pengguna_repassword'=>$pengguna_repassword,
			);
			$where   = array(
				'pengguna_id' => $pengguna_id
			);

			$table  = 'tbl_admin';
			$this->c_model->update($data,$where,$table);

			 echo $this->session->set_flashdata('msg','success');
					redirect('admin/useradmin');
			
	   }


	function update_pengguna(){
		$this->form_validation->set_rules('x_pengguna_password_edit', 'Password', 'required', array(
			'required' => '%s Harus Diisi !!!'
		));
		$this->form_validation->set_rules('x_pengguna_password_edit', 'Re-Password', 'required|matches[x_pengguna_password_edit]', array(
			'required' => '%s Password harus sama !!!'
		));
		if ($this->form_validation->run()==FALSE) {
			$kode=$this->session->userdata('idadmin');
			$x['user']=$this->m_admin->get_pengguna_login($kode);
			$x['data']=$this->m_admin->get_all_pengguna();
			$this->load->view('admin/v_user_admin_new',$x);
		}

		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; 
		$config['encrypt_name'] = TRUE; 
		$this->upload->initialize($config);

		$pengguna_id=$this->input->post('x_pengguna_id_edit');

		
		$pengguna_nama=$this->input->post('x_pengguna_nama_edit'); 
		$pengguna_email=$this->input->post('x_pengguna_email_edit'); 
		$pengguna_email_kantor=$this->input->post('x_pengguna_email_kantor_edit'); 
		// $pengguna_username=$this->input->post('x_pengguna_username_edit'); 
		// $pengguna_password=$this->input->post('x_pengguna_password_edit'); 
		// $pengguna_repassword=$this->input->post('x_pengguna_repassword_edit'); 
		$pengguna_nohp=$this->input->post('x_pengguna_nohp_edit'); 
		$pengguna_level=$this->input->post('x_pengguna_level_edit'); 

		$pengguna_photo=$this->input->post('x_pengguna_photo_now_edit');

		if(!empty($_FILES['x_pengguna_photo_edit']['name']))
		{
			$this->upload->do_upload('x_pengguna_photo_edit');
			$gbr = $this->upload->data();
			$pengguna_photo=$gbr['file_name'];
		}

			$data= array(
				'pengguna_nama'=>$pengguna_nama,
				'pengguna_email'=>$pengguna_email,
				'pengguna_email_kantor'=>$pengguna_email_kantor,
				'pengguna_nohp'=>$pengguna_nohp,
				'pengguna_level'=>$pengguna_level,
				'pengguna_photo'=>$pengguna_photo
			);
			$where   = array(
				'pengguna_id' => $pengguna_id
			);
			// var_dump($data);
			// die;
			$table  = 'tbl_admin';
			$this->c_model->update($data,$where,$table);

			 echo $this->session->set_flashdata('msg','success');
					redirect('admin/useradmin');
			
	   }
	

	
	   function update_pengguna_opd(){
		$this->form_validation->set_rules('x_pengguna_password_edit', 'Password', 'required', array(
			'required' => '%s Harus Diisi !!!'
		));
		$this->form_validation->set_rules('x_pengguna_password_edit', 'Re-Password', 'required|matches[x_pengguna_password_edit]', array(
			'required' => '%s Password harus sama !!!'
		));
		if ($this->form_validation->run()==FALSE) {
			$kode=$this->session->userdata('idadmin');
			$x['user']=$this->m_admin->get_pengguna_login($kode);
			$x['data']=$this->m_admin->get_all_pengguna();
			$this->load->view('admin/v_user_admin_new',$x);
		}

		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; 
		$config['encrypt_name'] = TRUE; 
		$this->upload->initialize($config);

		$pengguna_id=$this->input->post('x_pengguna_id_edit');

		
		// $pengguna_username=$this->input->post('x_pengguna_username_edit'); 
		// $pengguna_password=$this->input->post('x_pengguna_password_edit'); 
		// $pengguna_repassword=$this->input->post('x_pengguna_repassword_edit'); 
		// $pengguna_level=$this->input->post('x_pengguna_level_edit'); 
		
		$pengguna_nama=$this->input->post('x_pengguna_nama_edit'); 
		$pengguna_email=$this->input->post('x_pengguna_email_edit'); 
		$pengguna_email_kantor=$this->input->post('x_pengguna_email_kantor_edit'); 
		$pengguna_nohp=$this->input->post('x_pengguna_nohp_edit'); 
		$pengguna_photo=$this->input->post('x_pengguna_photo_now_edit');

		if(!empty($_FILES['x_pengguna_photo_edit']['name']))
		{
			$this->upload->do_upload('x_pengguna_photo_edit');
			$gbr = $this->upload->data();
			$pengguna_photo=$gbr['file_name'];
		}

			$data= array(
				// 'pengguna_username'=>$pengguna_username,
				// 'pengguna_password'=>sha1(sha1(md5($pengguna_password))),
				// 'pengguna_repassword'=>$pengguna_repassword,
				// 'pengguna_level'=>$pengguna_level,
				'pengguna_nama'=>$pengguna_nama,
				'pengguna_email'=>$pengguna_email,
				'pengguna_email_kantor'=>$pengguna_email_kantor,
				'pengguna_nohp'=>$pengguna_nohp,
				'pengguna_photo'=>$pengguna_photo
			);
			$where   = array(
				'pengguna_id' => $pengguna_id
			);
			$table  = 'tbl_admin';
			$this->c_model->update($data,$where,$table);

			 echo $this->session->set_flashdata('msg','success');
				redirect('admin/useradmin');
			
	   }
	   
	   

	function hapus_pengguna(){
		$kode=$this->input->post('kode');
		$data=$this->m_admin->get_pengguna_login($kode);
		$q=$data->row_array();
		$p=$q['pengguna_photo'];
		$path=base_url().'assets/images/'.$p;
		delete_files($path);
		$this->m_admin->hapus_pengguna($kode);
	    echo $this->session->set_flashdata('msg','success-hapus');
	    redirect('admin/pengguna');
	}

	function reset_password(){
   
        $id=$this->uri->segment(4);
        $get=$this->m_admin->getusername($id);
        if($get->num_rows()>0){
            $a=$get->row_array();
            $b=$a['pengguna_username'];
        }
        $pass=rand(123456,999999);
        $this->m_admin->resetpass($id,$pass);
        echo $this->session->set_flashdata('msg','show-modal');
        echo $this->session->set_flashdata('uname',$b);
        echo $this->session->set_flashdata('upass',$pass);
	    redirect('admin/pengguna');
   
    }


	function get_modaledit(){
		$id=$this->input->get('id');
		$data=$this->m_admin->getAdmin($id)->result();
		echo json_encode($data);
	}

	function get_max_id(){
		$data = $this->m_admin->getmaxid()->result();
		// $max_id = $row['max_id']; 
		// $data = $max_id +1;
		echo json_encode($data);
	}

	function get_semua(){
		$data=$this->m_admin->get_all_pengguna()->result();
		echo json_encode($data);
	}

	function get_opd($pengguna_id){

		$data=$this->m_admin->get_pengguna_opd($pengguna_id)->result();
		echo json_encode($data);
	}


}