<?php
class Laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
	        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('login');
        } 
		$this->load->model('m_kategori_laporan');  //belum
		$this->load->model('m_laporan');   //sudah
		$this->load->model('m_admin');  //belum
		$this->load->model('m_kepada');
		$this->load->library('upload');    //belum
	}


	function index(){
		$x['data']=$this->m_laporan->get_all_laporan();
		$this->load->view('user/v_laporan',$x);
	}


	
	function byid(){
		$code=$this->session->userdata("id");
		$x['data']=$this->m_laporan->view_laporan_byid($code);
		$this->load->view('user/v_laporan_byid',$x);
	}	

	function add_laporan(){    //masyon
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada(); //===> get fraksi //masyon
		//$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan(); ===> get anggota dewan  //masyon
		$this->load->view('user/v_add_laporan',$x);
	}

	function get_edit(){
		$kode=$this->uri->segment(4); //ambil yuri
		//print_r($this->uri->segment(4));
		$x['data']=$this->m_laporan->get_laporan_by_kode($kode);
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada();
		//print_r($this->m_laporan->get_laporan_by_kode($kode));
		$this->load->view('user/v_edit_laporan',$x);
	}

	function view(){
		$kode=$this->uri->segment(4); //ambil yuri
		//print_r($this->uri->segment(4));
		$x['data']=$this->m_laporan->get_laporan_by_kode($kode);
		$x['kat']=$this->m_kategori_laporan->get_all_kategori_laporan();
		$x['kpd']=$this->m_kepada->get_all_kepada();
		//print_r($this->m_laporan->get_laporan_by_kode($kode));
		$this->load->view('user/v_view_laporan',$x);
	}

	function simpan_laporan(){
				$config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
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
	                        $config['width']= 840;
	                        $config['height']= 450;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();
	                        $gambar=$gbr['file_name'];
	                       /////////////////masyon///////////////////////////////////////////////
							///////////
							$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$id = substr(str_shuffle($set), 0, 15);

	                        $id_pelapor=$this->session->userdata('id');  //sementera idadmin then iduser //--

							$id_kepada=strip_tags($this->input->post('idkepada'));  //--

							$datakepada=$this->m_kepada->get_kepada($id_kepada);
							$dk=$datakepada->row_array();
							$ditujukan_kepada=$dk['nama']; //---

							$id_komisi=$dk['kdkomisi'];

							$kategori_laporan=$this->input->post('xkategorilaporan');  //--

							$judul_laporan=$this->input->post('xjudullaporan'); //--

							$xanggaran=$this->input->post('xanggaran');

                            $anggaran = preg_replace("/[^0-9]/", "", $xanggaran);

							$lokasi=$this->input->post('xlokasi');

							$id_jenis=1;

							$isi_laporan=$this->input->post('xisilaporan');  //--

							$nama=$this->session->userdata('nama'); //--

							$alamat=$this->session->userdata('alamat');

							$email=$this->session->userdata('email');  //--
							
							$hp=$this->session->userdata('hp');

							$laporan_status=1;

							$status=1;
							////////////////				
							//$user=$this->m_admin->get_pengguna_login($id_pelapor);
							//$p=$user->row_array();
							
							


				$this->m_laporan->simpan_laporan_user(
					$id,
					$id_pelapor,
					$id_kepada,
					$ditujukan_kepada,
					$id_komisi,
					$kategori_laporan,
					$judul_laporan,
					$anggaran,
					$lokasi,
					$id_jenis,
					$isi_laporan,
					$nama,
					$alamat,
					$email,
					$hp,
					$gambar,
					$laporan_status,
					$status);
				
				 echo $this->session->set_flashdata('msg','success');
							redirect('user/laporan/byid');
					}else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('user/laporan/byid');
	                }
	                 
	            }else{
					//redirect('user/laporan/byid');
							$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$id = substr(str_shuffle($set), 0, 15);
							$id_pelapor=$this->session->userdata('id');  //sementera idadmin then iduser //--

							$id_kepada=strip_tags($this->input->post('idkepada'));  //--

							$datakepada=$this->m_kepada->get_kepada($id_kepada);
							$dk=$datakepada->row_array();
							$ditujukan_kepada=$dk['nama']; //---

							$id_komisi=$dk['kdkomisi'];

							$kategori_laporan=$this->input->post('xkategorilaporan');  //--

							$judul_laporan=$this->input->post('xjudullaporan'); //--

							$xanggaran=$this->input->post('xanggaran');

                            $anggaran = preg_replace("/[^0-9]/", "", $xanggaran);

							$lokasi=$this->input->post('xlokasi');

							$id_jenis=1;

							$isi_laporan=$this->input->post('xisilaporan');  //--

							$nama=$this->session->userdata('nama'); //--

							$alamat=$this->session->userdata('alamat');

							$email=$this->session->userdata('email');  //--
							
							$hp=$this->session->userdata('hp');

							$laporan_status=1;

							$status=1;
							////////////////				
							//$user=$this->m_admin->get_pengguna_login($id_pelapor);
							//$p=$user->row_array();

				$this->m_laporan->simpan_laporan_user_noimg(
					$id,
					$id_pelapor,
					$id_kepada,
					$ditujukan_kepada,
					$id_komisi,
					$kategori_laporan,
					$judul_laporan,
					$anggaran,
					$lokasi,
					$id_jenis,
					$isi_laporan,
					$nama,
					$alamat,
					$email,
					$hp,
					$laporan_status,
					$status);
				echo $this->session->set_flashdata('msg','success');
				redirect('user/laporan/byid');
				}
				
	}
	
	function update_laporan(){
				
	            $config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
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
	                        $config['width']= 840;
	                        $config['height']= 450;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();

	                        $gambar=$gbr['file_name'];


	                        $id_laporan=$this->input->post('kode');

	                      	$id_kepada=strip_tags($this->input->post('idkepada'));  //--

							$datakepada=$this->m_kepada->get_kepada($id_kepada);
							
							$dk=$datakepada->row_array();
							
							$ditujukan_kepada=$dk['nama']; //---

							$id_komisi=$dk['kdkomisi'];//---


							///////////////
							$kategori_laporan=$this->input->post('xkategorilaporan');  //--
							
							$judul_laporan=$this->input->post('xjudullaporan'); //--
							
							$isi_laporan=$this->input->post('xisilaporan');  //--
							////////////////
							$lokasi=$this->input->post('xlokasi');

							$id_jenis=$this->input->post('xid_jenis');

							$xanggaran=$this->input->post('xanggaran');

                            $anggaran = preg_replace("/[^0-9]/", "", $xanggaran);

							//$id_pelapor=$this->session->userdata('id');  //sementera idadmin then iduser //--
							//$user=$this->m_admin->get_pengguna_login($id_pelapor);
							//$p=$user->row_array();
						
						//	$nama=$this->session->userdata('nama'); //--
						//	$email=$this->session->userdata('email');  //--
						//	$hp=$this->session->userdata('hp');
							//$laporan_status=1;


				$this->m_laporan->update_laporan_user(
					$id_laporan,
					$id_kepada,
					$ditujukan_kepada,
					$id_komisi,
					$kategori_laporan,
					$judul_laporan,
					$anggaran,
					$lokasi,
					$id_jenis,
					$isi_laporan,
					$gambar);
							echo $this->session->set_flashdata('msg','info');
							redirect('user/laporan/byid');
	                    
	                }else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('user/pengguna');
	                }
	                

	            }else{
							$id_laporan=$this->input->post('kode');

						
							$id_kepada=strip_tags($this->input->post('idkepada'));  //--

							$datakepada=$this->m_kepada->get_kepada($id_kepada);
							$dk=$datakepada->row_array();
							$ditujukan_kepada=$dk['nama']; //---
							$id_komisi=$dk['kdkomisi']; //--

							$kategori_laporan=$this->input->post('xkategorilaporan');  //--

							$judul_laporan=$this->input->post('xjudullaporan'); //--

							$xanggaran=$this->input->post('xanggaran');

                            $anggaran = preg_replace("/[^0-9]/", "", $xanggaran);

							$lokasi=$this->input->post('xlokasi');

							$id_jenis=$this->input->post('xid_jenis');

							$isi_laporan=$this->input->post('xisilaporan');  //--


				$this->m_laporan->update_laporan_user_noimg(
					$id_laporan,
					$id_kepada,
					$ditujukan_kepada,
					$id_komisi,
					$kategori_laporan,
					$judul_laporan,
					$anggaran,
					$lokasi,
					$id_jenis,
					$isi_laporan);
							echo $this->session->set_flashdata('msg','info');
							redirect('user/laporan/byid');
	            } 

	}

	function hapus_laporan(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_laporan->hapus_laporan($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('user/laporan/byid');
	}

}