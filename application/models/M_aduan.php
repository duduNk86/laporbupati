<?php
class M_aduan extends CI_Model{ 

	function get_all_aduan(){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='2' ORDER BY id DESC");
		return $hsl;
	}



	function simpan_aduan($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$email,$hp,$gambar,$laporan_status,$keterangan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,foto,laporan_status,keterangan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$gambar','$laporan_status','$keterangan_status','$status')");
		return $hsl;
	}

	function simpan_aduan_noimg($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$email,$hp,$laporan_status,$keterangan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,laporan_status,keterangan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$laporan_status','$keterangan_status','$status')");
		return $hsl;
	}



	function simpan_aduan_user($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$alamat,$email,$hp,$gambar,$laporan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,alamat,email,hp,foto,laporan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$alamat','$email','$hp','$gambar','$laporan_status','$status')");
		return $hsl;
	}

	function simpan_aduan_user_noimg($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$alamat,$email,$hp,$laporan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,alamat,email,hp,laporan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$alamat','$email','$hp','$laporan_status','$status')");
		return $hsl;
	}



	function update_aduan($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$gambar,$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan', foto='$gambar', keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}


	function update_aduan_noimg($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan',keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}


	function update_aduan_user($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$gambar){
		$hsl=$this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan', foto='$gambar' where id='$id_laporan'");
		return $hsl;
	}


	function update_aduan_user_noimg($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan){
		$hsl=$this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan' where id='$id_laporan'");
		return $hsl;
	}


	function update_status($id,$laporan_status,$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set laporan_status='$laporan_status',keterangan_status='$keterangan_status' where id='$id'");
		return $hsl;
	}


	function get_aduan_by_kode($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id='$kode'");
		return $hsl;
	}



	function view_aduan_byid($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id_pelapor='$kode' AND id_jenis='2'");
		return $hsl;
	}

	function view_aduan_komisi($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id_komisi='$kode' AND id_jenis='2'");
		return $hsl;
	}


	function view_aduan_selesai($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where laporan_status='$kode' AND id_jenis='2'");
		return $hsl;
	}

	function xapi($id=null){
		if ($id===null){
		return $this->db->query("SELECT 
			tbl_laporan.id,
            tbl_laporan.ditujukan_kepada,
            tbl_laporan.judul_laporan,
            tbl_laporan.anggaran,
            tbl_laporan.lokasi,
            tbl_laporan.isi_laporan,
            tbl_laporan.nama,
            tbl_laporan.alamat,
            tbl_laporan.email,
            tbl_laporan.hp,
            tbl_laporan.status,    
          
			DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan")->result_array();
	
	 } else
	    return $this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where laporan_status='$id'")->result_array();
		
	}




	public function getMahasiswa($id = null)
	{
		if ($id === null) {

			return $this->db->get('mahasiswa')->result_array();

		} else {

		    return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
		}
	}

	
	//masyon
	function hapus_aduan($kode){
		$hsl=$this->db->query("delete from tbl_laporan where id='$kode'");
		return $hsl;
	}












	//Front-End

	function get_post_home(){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d %M %Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC limit 3");
		return $hsl;
	}

	function get_berita_slider(){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_img_slider='1' ORDER BY tulisan_id DESC");
		return $hsl;
	}

	function berita_perpage($offset,$limit){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC limit $offset,$limit");
		return $hsl;
	}

	function berita(){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC");
		return $hsl;
	} 
	function get_berita_by_slug($slug){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_slug='$slug'");
		return $hsl;
	}

	function get_tulisan_by_kategori($kategori_id){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_kategori_id='$kategori_id'");
		return $hsl;
	}

	function get_tulisan_by_kategori_perpage($kategori_id,$offset,$limit){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_kategori_id='$kategori_id' limit $offset,$limit");
		return $hsl;
	}

	function search_tulisan($keyword){
		$hsl=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan WHERE tulisan_judul LIKE '%$keyword%'");
		return $hsl;
	}

	function post_komentar($nama,$email,$web,$msg,$tulisan_id){
		$hsl=$this->db->query("INSERT INTO tbl_komentar (komentar_nama,komentar_email,komentar_web,komentar_isi,komentar_tulisan_id) VALUES ('$nama','$email','$web','$msg','$tulisan_id')");
		return $hsl;
	}


	function count_views($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_views WHERE views_ip='$user_ip' AND views_tulisan_id='$kode' AND DATE(views_tanggal)=CURDATE()");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_views (views_ip,views_tulisan_id) VALUES('$user_ip','$kode')");
				$this->db->query("UPDATE tbl_tulisan SET tulisan_views=tulisan_views+1 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Good
    function count_good($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','1','$kode')");
				$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+1 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Like
    function count_like($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','2','$kode')");
				$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+2 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Like
    function count_love($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','3','$kode')");
				$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+3 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Like
    function count_genius($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_tulisan_id) VALUES('$user_ip','4','$kode')");
				$this->db->query("UPDATE tbl_tulisan SET tulisan_rating=tulisan_rating+4 where tulisan_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    function cek_ip_rate($kode){
    	$user_ip=$_SERVER['REMOTE_ADDR'];
        $hsl=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_tulisan_id='$kode'");
        return $hsl;
    }


    function get_tulisan_populer(){
		$hasil=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d %M %Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_views DESC limit 10");
		return $hasil;
	}

	function get_tulisan_terbaru(){
		$hasil=$this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d %M %Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC limit 10");
		return $hasil;
	}

	function get_kategori_for_blog(){
		$hasil=$this->db->query("SELECT COUNT(tulisan_kategori_id) AS jml,kategori_id,kategori_nama FROM tbl_tulisan JOIN tbl_kategori ON tulisan_kategori_id=kategori_id GROUP BY tulisan_kategori_id");
		return $hasil;
	}
	

}