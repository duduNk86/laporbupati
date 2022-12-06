<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?= $title;?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="<?= base_url('assets/frontend_aduan/');?>fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="<?= base_url('assets/frontend_aduan/');?>css/style.css">
	</head>

	<body>
		<div class="wrapper">
             <?= $script_captcha; ?>
			<div class="image-holder">
				<img src="<?= base_url('assets/frontend_aduan/');?>images/form_aduan.jpg" >
			</div>

			<div class="form-inner">
            <form action="<?php echo base_url().'user/aduan/kirim'?>" method="post" enctype="multipart/form-data">
					<div class="form-header">
						<h4>FORMULIR LAPORAN</h4>
						<p><?php echo $this->session->flashdata('gagal');?></p>
   						<p><?php echo $this->session->flashdata('sukses');?></p>
						<img src="<?= base_url('assets/frontend_aduan/');?>images/sign-up.png" alt="" class="sign-up-icon">
					</div>
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control" name="x_nama" required>
					</div>
					<div class="form-group">
						<label for="">No Hp (Harus Aktif)</label>
						<input type="text" class="form-control" name="x_hp" required>
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="text" class="form-control" name="x_email">
					</div>
					<div class="form-group">
						<label for="">Lokasi</label>
						<input type="text" class="form-control"  name="x_lokasi" required>
					</div>
                    <div class="form-group">
						<label for="">Judul Laporan</label>
						<input type="text" class="form-control" name="x_judul_laporan" required>
					</div>
					<div class="form-group">
                        <label for="">Uraian Laporan Anda</label>
						<textarea class="form-control"name="x_isi_laporan" required></textarea>
					</div>
                    <div class="form-group">
                        <label for="">Lampiran Foto</label>
                        <input type="file" class="form-control" name="x_foto" >
                    </div>
                    <?= $captcha; ?> 
        
					<button>Laporkan</button>

				</form>
			</div>
			
		</div>
		
		<script src="<?= base_url('assets/frontend_aduan/');?>js/jquery-3.3.1.min.js"></script>
		<script src="<?= base_url('assets/frontend_aduan/');?>js/jquery.form-validator.min.js"></script>
	</body>
</html>