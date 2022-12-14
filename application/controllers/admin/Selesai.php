<?php
class Selesai extends CI_Controller{
	function __construct(){
		parent::__construct();
        if($this->session->userdata("logged_in") !==TRUE){
        	redirect('admin/administrator');
        }
        $this->load->model('m_laporan');
		$this->load->model('m_admin');
		$this->load->library('upload');
		$x['title']='Laporan TL';
	}



	function index(){
		$x['title']="Lapor Bupati";
		$code=3;
		$x['data']=$this->m_laporan->view_laporan_selesai($code);
		$this->load->view('admin/v_laporan_selesai2',$x);
	}
	function add_portfolio(){
		$this->load->view('admin/v_add_portfolio2');
	}
	function get_edit(){
		$x['title']="Lapor Bupati";
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_portfolio->get_portfolio_by_kode($kode);
		$this->load->view('admin/v_edit_portfolio2',$x);
	}
	function simpan_portfolio(){
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
	                        $config['width']= 710;
	                        $config['height']= 455;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();

	                        $gambar=$gbr['file_name'];
							$judul=strip_tags($this->input->post('xjudul'));
							$isi=$this->input->post('xisi');
							$kode=$this->session->userdata('idadmin');
							$user=$this->m_admin->get_pengguna_login($kode);
							$p=$user->row_array();
							$user_id=$p['pengguna_id'];
							$user_nama=$p['pengguna_nama'];
							$this->m_portfolio->simpan_portfolio($judul,$isi,$user_nama,$gambar);
							echo $this->session->set_flashdata('msg','success');
							redirect('admin/portfolio');
					}else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('admin/portfolio');
	                }
	                 
	            }else{
					redirect('admin/portfolio');
				}
				
	}
	
	function update_portfolio(){
				
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
	                        $config['width']= 710;
	                        $config['height']= 455;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();

	                        $gambar=$gbr['file_name'];
	                        $port_id=$this->input->post('kode');
	                        $judul=strip_tags($this->input->post('xjudul'));
							$isi=$this->input->post('xisi');
							$kode=$this->session->userdata('idadmin');
							$user=$this->m_admin->get_pengguna_login($kode);
							$p=$user->row_array();
							$user_id=$p['pengguna_id'];
							$user_nama=$p['pengguna_nama'];
							$this->m_portfolio->update_portfolio($port_id,$judul,$isi,$user_nama,$gambar);
							echo $this->session->set_flashdata('msg','info');
							redirect('admin/portfolio');
	                    
	                }else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('admin/portfolio');
	                }
	                
	            }else{
							$port_id=$this->input->post('kode');
	                        $judul=strip_tags($this->input->post('xjudul'));
							$isi=$this->input->post('xisi');
							$kode=$this->session->userdata('idadmin');
							$user=$this->m_admin->get_pengguna_login($kode);
							$p=$user->row_array();
							$user_id=$p['pengguna_id'];
							$user_nama=$p['pengguna_nama'];
							$this->m_portfolio->update_portfolio_tanpa_img($port_id,$judul,$isi,$user_nama);
							echo $this->session->set_flashdata('msg','info');
							redirect('admin/portfolio');
	            } 

	}

	function hapus_portfolio(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_portfolio->hapus_portfolio($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/portfolio');
	}

}