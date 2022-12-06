<?php
class M_cetak extends CI_Model{ 

	function cetak_laporan_semua2(){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan  ORDER BY nomor DESC");
		return $hsl;
	}

	function cetak_laporan_semua2_tambahan(){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' AND tambahan ='2' ORDER BY nomor DESC");
		return $hsl;
	}



	function cetak_laporan_admin2($id){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' AND id_komisi ='$id' ORDER BY ditujukan_kepada ASC");
		return $hsl;
	}


	function cetak_laporan_admin2_tambahan($id){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan WHERE id_jenis='1' AND id_komisi ='$id' AND tambahan = '2' ORDER BY ditujukan_kepada ASC");
		return $hsl;
	}



	function get_jml_semua(){
		$hsl= "SELECT sum(anggaran) as anggaran FROM tbl_laporan WHERE id_jenis='1'";
		$result=$this->db->query($hsl);
		return $result->row()->anggaran;
	}


	function get_jml_komisi($id){
		$hsl= "SELECT sum(anggaran) as anggaran FROM tbl_laporan WHERE id_komisi='$id'";
		$result=$this->db->query($hsl);
		return $result->row()->anggaran;
	}


	function get_jml_semua_tambahan(){
		$hsl= "SELECT sum(anggaran) as anggaran FROM tbl_laporan WHERE id_jenis='1' AND tambahan='2'";
		$result=$this->db->query($hsl);
		return $result->row()->anggaran;
	}


	function get_jml_komisi_tambahan($id){
		$hsl= "SELECT sum(anggaran) as anggaran FROM tbl_laporan WHERE id_komisi='$id' AND tambahan='2'";
		$result=$this->db->query($hsl);
		return $result->row()->anggaran;
	}



	function simpan_laporan($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$email,$hp,$gambar,$laporan_status,$keterangan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,foto,laporan_status,keterangan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$gambar','$laporan_status','$keterangan_status','$status')");
		return $hsl;
	}

	function simpan_laporan_noimg($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$email,$hp,$laporan_status,$keterangan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,email,hp,laporan_status,keterangan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$email','$hp','$laporan_status','$keterangan_status','$status')");
		return $hsl;
	}



	function simpan_laporan_user($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$alamat,$email,$hp,$gambar,$laporan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,alamat,email,hp,foto,laporan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$alamat','$email','$hp','$gambar','$laporan_status','$status')");
		return $hsl;
	}

	function simpan_laporan_user_noimg($id,$id_pelapor,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$nama,$alamat,$email,$hp,$laporan_status,$status){
		$hsl=$this->db->query("insert into tbl_laporan(id,id_pelapor,id_kepada,ditujukan_kepada,id_komisi,kategori_laporan,judul_laporan,anggaran,lokasi,id_jenis,isi_laporan,nama,alamat,email,hp,laporan_status,status) values 
			('$id','$id_pelapor','$id_kepada','$ditujukan_kepada','$id_komisi','$kategori_laporan','$judul_laporan','$anggaran','$lokasi','$id_jenis','$isi_laporan','$nama','$alamat','$email','$hp','$laporan_status','$status')");
		return $hsl;
	}





	function update_laporan($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$gambar,$laporan_status,$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set 
			id_kepada='$id_kepada',
			ditujukan_kepada='$ditujukan_kepada',
			id_komisi='$id_komisi',
			kategori_laporan='$kategori_laporan',
			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			id_jenis='$id_jenis',
			isi_laporan='$isi_laporan', 
			foto='$gambar', 
			laporan_status='$laporan_status',
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}


	function update_laporan_noimg($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$isi_laporan,$laporan_status,$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set 
			id_kepada='$id_kepada',
			ditujukan_kepada='$ditujukan_kepada',
			id_komisi='$id_komisi',
			kategori_laporan='$kategori_laporan',
			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			id_jenis='$id_jenis',
			isi_laporan='$isi_laporan',
			laporan_status='$laporan_status', 
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}



	function update_laporan_admin2(
		$id_laporan,
		// $id_kepada,
		// $ditujukan_kepada,
		// $id_komisi,
		$judul_laporan,
		$anggaran,
		$lokasi,
		$isi_laporan,
		$gambar,
		$laporan_status,
		$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set 

			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			isi_laporan='$isi_laporan', 
			foto='$gambar',
			laporan_status='$laporan_status', 
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}


	function update_laporan_noimg_admin2(
		$id_laporan,
		// $id_kepada,
		// $ditujukan_kepada,
		// $id_komisi,
		$judul_laporan,
		$anggaran,
		$lokasi,
		$isi_laporan,
		$laporan_status,
		$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set 
			
			judul_laporan='$judul_laporan',
			anggaran='$anggaran',
			lokasi='$lokasi',
			isi_laporan='$isi_laporan',
			laporan_status='$laporan_status', 
			keterangan_status='$keterangan_status' where id='$id_laporan'");
		return $hsl;
	}




	function update_laporan_user($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan,$gambar){
		$hsl=$this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan', foto='$gambar' where id='$id_laporan'");
		return $hsl;
	}


	function update_laporan_user_noimg($id_laporan,$id_kepada,$ditujukan_kepada,$id_komisi,$kategori_laporan,$judul_laporan,$anggaran,$lokasi,$id_jenis,$isi_laporan){
		$hsl=$this->db->query("update tbl_laporan set id_kepada='$id_kepada',ditujukan_kepada='$ditujukan_kepada',id_komisi='$id_komisi',kategori_laporan='$kategori_laporan',judul_laporan='$judul_laporan',anggaran='$anggaran',lokasi='$lokasi',id_jenis='$id_jenis',isi_laporan='$isi_laporan' where id='$id_laporan'");
		return $hsl;
	}


	function update_status($id,$laporan_status,$keterangan_status){
		$hsl=$this->db->query("update tbl_laporan set laporan_status='$laporan_status',keterangan_status='$keterangan_status' where id='$id'");
		return $hsl;
	}

	function get_laporan_by_kode($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id='$kode'");
		return $hsl;
	}



	function view_laporan_byid($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id_pelapor='$kode'");
		return $hsl;
	}

	function view_laporan_komisi($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where id_komisi='$kode'");
		return $hsl;
	}


	function view_laporan_selesai($kode){
		$hsl=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where laporan_status='$kode'");
		return $hsl;
	}

	function xapi($id=null){
		if ($id===null){
		return $this->db->query("SELECT 
			tbl_laporan.id,
			tbl_laporan.id_kepada id_anggota,
            tbl_laporan.ditujukan_kepada x_lewat,
            tbl_laporan.judul_laporan x_judul,
            tbl_laporan.isi_laporan x_rincian_kegiatan,
            tbl_laporan.lokasi x_lokasi,
            tbl_laporan.anggaran x_anggaran,
            tbl_laporan.nama x_dari,
            tbl_laporan.alamat x_alamat,
            tbl_laporan.email x_email,
            tbl_laporan.hp x_hp,
            tbl_laporan.status x_status,    
          
			DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS x_tanggal FROM tbl_laporan where status='1'")->result_array();
	
	 } else
	    return $this->db->query("SELECT 
	    	tbl_laporan.id,
			tbl_laporan.id_kepada id_anggota,
            tbl_laporan.ditujukan_kepada x_lewat,
            tbl_laporan.judul_laporan x_judul,
            tbl_laporan.isi_laporan x_rincian_kegiatan,
            tbl_laporan.lokasi x_lokasi,
            tbl_laporan.anggaran x_anggaran,
            tbl_laporan.nama x_dari,
            tbl_laporan.alamat x_alamat,
            tbl_laporan.email x_email,
            tbl_laporan.hp x_hp,
            tbl_laporan.status x_status,  


	    	DATE_FORMAT(tanggal_laporan,'%d/%m/%Y') AS tanggal FROM tbl_laporan where status='1' AND id_kepada='$id'")->result_array();
		
	}

	function status($id,$status){
		$hsl=$this->db->query("update tbl_laporan set status='$status' where id='$id'");
		return $hsl;
	}



	
	//masyon
	function hapus_laporan($kode){
		$hsl=$this->db->query("delete from tbl_laporan where id='$kode'");
		return $hsl;
	}



	function get_jml(){
		$hsl= "SELECT sum(id_komisi) as komisi FROM tbl_laporan";
		$result=$this->db->query($hsl);
		return $result->row()->komisi;
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