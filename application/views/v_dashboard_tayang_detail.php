<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lapor Bupati Wonosobo</title>
	<link href="<?= base_url('theme/'); ?>images/Lambang Wonosobo.png" rel="shortcut icon" />
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<!-- <link rel="stylesheet" href="< ?= base_url();?>/template/plugins/fontawesome-free/css/all.min.css"> -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">

	<!-- Ekko Lightbox -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/ekko-lightbox/ekko-lightbox.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Include SweetAlert CSS and JS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

	<!-- jQuery -->
	<script src="<?= base_url(); ?>/template/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url(); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?= base_url(); ?>/template/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Ekko Lightbox -->
	<script src="<?= base_url(); ?>/template/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
	<!-- DataTables -->
	<script src="<?= base_url(); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>/template/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?= base_url(); ?>/template/dist/js/demo.js"></script>

	<!-- Leaflet -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
	<!-- Leaflet Draw -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

	<!-- daterange picker -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/daterangepicker/daterangepicker.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Bootstrap4 Duallistbox -->
	<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

	<!-- Select2 -->
	<script src="<?= base_url(); ?>/template/plugins/select2/js/select2.full.min.js"></script>
	<!-- Bootstrap4 Duallistbox -->
	<script src="<?= base_url(); ?>/template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
	<!-- InputMask -->
	<script src="<?= base_url(); ?>/template/plugins/moment/moment.min.js"></script>
	<script src="<?= base_url(); ?>/template/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
	<!-- date-range-picker -->
	<script src="<?= base_url(); ?>/template/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="<?= base_url(); ?>/template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?= base_url(); ?>/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Bootstrap Switch -->
	<script src="<?= base_url(); ?>/template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<?= $script_captcha; ?>
		<!-- /.navbar -->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container">
					<div class="row mb-2">
						<div class="col-sm-12">
							<!-- <h1 class="m-0 text-dark">Detail Laporan Aduan Masyarakat</h1> -->
							<!-- <center><div class="col-md-6"><img src="< ?php echo base_url().'assets/lapor/dashboardlapor.png'?>" width="400px" ></div></center> -->
							<center>
								<div class="col-md-6"><img src="<?php echo base_url() . 'assets/lapor/dashboardlapor-v2.png' ?>" height="60px" width="350px"></div>
							</center>
						</div><!-- /.col -->

					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->
			<div class="content">
				<?php
				$no = 0;
				foreach ($tayang->result_array() as $i) :
					$no++;
					$nomor = $i['nomor'];
					$id = $i['id'];
					$id_pelapor = $i['id_pelapor'];
					$id_kepada = $i['id_kepada'];
					// $ditujukan_kepada = $i['ditujukan_kepada'];
					$opd = $i['opd'];
					$id_penginput = $i['id_penginput'];
					$penginput = $i['penginput'];
					$kategori_laporan = $i['kategori_laporan'];
					$judul_laporan = $i['judul_laporan'];
					$lokasi = $i['lokasi'];
					$isi_laporan = $i['isi_laporan'];
					$nama = $i['nama'];
					$hp = $i['hp'];
					$sumber_aduan = $i['sumber_aduan'];
					$alamat = $i['alamat'];
					$tanggal_laporan = $i['tanggal_laporan'];
					$laporan_status = $i['laporan_status'];
					$tindaklanjut = $i['tindaklanjut'];
					$tanggal_tindaklanjut = $i['tanggal_tindaklanjut'];
					$keterangan_tindaklanjut = $i['keterangan_tindaklanjut'];
					$foto = $i['foto'];
					$foto_tindaklanjut = $i['foto_tindaklanjut'];
					$rating_jawaban = $i['rating_jawaban'];
				?>
					<div class="row">
						<div class="col-sm-6">
							<div class="card card-danger">
								<div class="card-header">
									<h3 class="card-title">Foto Aduan</h3>
								</div>
								<div class="card-body">
									<?php $fileName = $foto; ?>
									<?php $ext = pathinfo($fileName, PATHINFO_EXTENSION); ?>

									<?php if ($ext !== "pdf") { ?>
										<!-- <img src="< ?php echo base_url('assets/images/').$foto;?>" class="img-fluid mb-2" style="width: 100%; height: 400px;" alt="-" /> -->
										<img src="<?php echo base_url('assets/images/') . $foto; ?>" class="img-fluid mb-2" style="width: 100%; height: 100%;" alt="-" />
									<?php } else { ?>
										<!-- <iframe src="< ?php echo base_url('assets/images/').$foto;?>" class="img-fluid mb-2" style="width: 100%; height: 400px;" alt="-" /> -->
										<iframe src="<?php echo base_url('assets/images/') . $foto; ?>" class="img-fluid mb-2" style="width: 100%; height: 100%;" alt="-" />
									<?php } ?>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="card card-danger">
								<div class="card-header">
									<h3 class="card-title">Data Aduan</h3>
								</div>
								<div class="card-body">
									<table class="table">
										<tr>
											<th width="160px">No. Tiket Aduan</th>
											<th width="50px">:</th>
											<td><b style="color:blue;">LB<?php echo $sumber_aduan; ?>-<?php echo $id; ?></b></td>
										</tr>
										<tr>
											<th>Tanggal Aduan</th>
											<th>:</th>
											<td>
												<?php
												$tanggal_awal = $tanggal_laporan;
												$tanggal_baru = date('d M Y | H:i:s', strtotime($tanggal_awal));
												echo $tanggal_baru;
												?>
											</td>
										</tr>
										<tr>
											<th>Judul Aduan</th>
											<th>:</th>
											<td align="justify"><?php echo $judul_laporan; ?></td>
										</tr>
										<tr>
											<th>Isi Aduan</th>
											<th>:</th>
											<td align="justify"><?php echo $isi_laporan; ?></td>
										</tr>
										<tr>
											<th>Lokasi</th>
											<th>:</th>
											<td><?php echo $lokasi; ?></td>
										</tr>
										<tr>
											<th>OPD Terkait</th>
											<th>:</th>
											<td><?php echo $opd; ?></td>
										</tr>
										<tr>
											<th>Tindaklanjut [TL]</th>
											<th>:</th>
											<td align="justify"><?php echo $tindaklanjut; ?></td>
										</tr>
										<tr>
											<th>Keterangan TL</th>
											<th>:</th>
											<td align="justify"><?php echo $keterangan_tindaklanjut; ?></td>
										</tr>
										<tr>
											<th>Tanggal TL</th>
											<th>:</th>
											<td>
												<?php
												if ($tanggal_tindaklanjut !== '0000-00-00 00:00:00' and $tanggal_tindaklanjut !== $tanggal_laporan) {
													$tanggal_awal = $tanggal_tindaklanjut;
													$tanggal_baru = date('d M Y | H:i:s', strtotime($tanggal_awal));
													echo $tanggal_baru;
												} else echo '';
												?>
											</td>
										</tr>
										<tr>
											<th>Durasi / Lama TL</th>
											<th>:</th>
											<td>
												<?php
												if ($tanggal_tindaklanjut !== '0000-00-00 00:00:00') {
													$awal  = date_create($tanggal_laporan);
													$akhir = date_create($tanggal_tindaklanjut);
													$diff  = date_diff($awal, $akhir);
													echo $diff->format('<div style="color:red;"><b>%Y</b> tahun <b>%m</b> bulan <b>%d</b> hari <b>%h</b> jam <b>%i</b> menit <b>%s</b> detik</div>');
												} else echo '';
												?>
											</td>
										</tr>
										<tr>
											<th>Status Aduan</th>
											<th>:</th>
											<?php if ($laporan_status == 1) { ?>
												<td style="color:red;"><b>Verifikasi</b></td>
											<?php } else if ($laporan_status == 2) { ?>
												<td style="color:gold;"><b>Sedang Proses</b></td>
											<?php } else if ($laporan_status == 3) { ?>
												<td style="color:forestgreen;"><b>Selesai</b></td>
											<?php } else if ($laporan_status == 99) { ?>
												<td style="color:blue;"><b>Ditolak</b></td>
											<?php } ?>
										</tr>

										<?php if ($laporan_status == 3 && $rating_jawaban == 0) { ?>
											<tr>
												<th>Beri Rating atas Jawaban TL</th>
												<th>:</th>
												<td>
													<form action="<?php echo base_url() . 'user/aduan/kirim_rating_jawaban_pelapor' ?>" method="post" id="ratingForm">
														<div class="form-group" id="rating-ability-wrapper">
															<input type="hidden" id="selected_rating1" name="selected_rating1" value="0" required="required">
															<input type="hidden" id="xkode_detail" name="xkode_detail" value="<?php echo $id; ?>" required="required">
															<h4 class="bold rating-header">
																<span class="selected-rating1">0</span><small> / 5</small>
															</h4>
															<button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="1" id="rating-star1-1">
																<i class="fa fa-star" aria-hidden="true"></i>
															</button>
															<button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="2" id="rating-star1-2">
																<i class="fa fa-star" aria-hidden="true"></i>
															</button>
															<button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="3" id="rating-star1-3">
																<i class="fa fa-star" aria-hidden="true"></i>
															</button>
															<button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="4" id="rating-star1-4">
																<i class="fa fa-star" aria-hidden="true"></i>
															</button>
															<button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="5" id="rating-star1-5">
																<i class="fa fa-star" aria-hidden="true"></i>
															</button>
														</div>
														<div class="form-group">
															<div>
																<?= $captcha; ?>
															</div>
														</div>
														<div class="form-group">
															<button type="submit" style="background-color:green;" class="btn btn-success btn-sm" id="submitBtn"><i class="fa fa-paper-plane"></i><b><a style="color: white;">&nbsp; Kirim Penilaian</a></b></button>
														</div>
														<small class="form-text text-muted" align="justify">[ * Bantu kami dengan memberikan penilaian atas jawaban tindaklanjut yang telah diberikan oleh Perangkat Daerah terkait guna membantu kami dalam upaya meningkatkan Layanan Lapor Bupati Wonosobo. Terima kasih. ]</small>
													</form>
												</td>
											</tr>
										<?php } else { ?>
											<tr>
												<th>Rating Jawaban TL</th>
												<th>:</th>
												<td>
													<?php
													if ($rating_jawaban == 0) {
														echo "<b style='color:gold;'><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
													} else if ($rating_jawaban == 1) {
														echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
													} else if ($rating_jawaban == 2) {
														echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
													} else if ($rating_jawaban == 3) {
														echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
													} else if ($rating_jawaban == 4) {
														echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i></b>";
													} else if ($rating_jawaban == 5) {
														echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></b>";
													}
													?>
												</td>
											</tr>
										<?php } ?>
									</table>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="card card-danger">
								<div class="card-header">
									<h3 class="card-title">Bukti Tindaklanjut</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
											<a href="#" data-toggle="lightbox" data-title="Aduan" data-gallery="gallery">
												<?php $fileNameTL = $foto_tindaklanjut; ?>
												<?php $ext = pathinfo($fileNameTL, PATHINFO_EXTENSION); ?>

												<?php if ($ext !== "pdf") { ?>
													<!-- <img src="< ?php echo base_url('assets/images/').$foto_tindaklanjut;?>" class="img-fluid mb-2" style="width: 100%; height: 400px;" alt="-" /> -->
													<img src="<?php echo base_url('assets/images/') . $foto_tindaklanjut; ?>" class="img-fluid mb-2" style="width: 100%; height: 100%; align-content: center;" alt="-" />
												<?php } else { ?>
													<!-- <iframe src="< ?php echo base_url('assets/images/').$foto_tindaklanjut;?>" class="img-fluid mb-2" style="width: 100%; height: 400px;" alt="-" /> -->
													<iframe src="<?php echo base_url('assets/images/') . $foto_tindaklanjut; ?>" class="img-fluid mb-2" style="width: 100%; height: 300%;" alt="-" />
												<?php } ?>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				<?php endforeach; ?>
			</div>

			<!-- Main Footer -->
			<footer class="main-footer">
				<!-- To the right -->
				<div class="float-right d-none d-sm-inline">
					<b>Lapor Bupati Wonosobo V.3</b>
				</div>
				<!-- Default to the left -->
				<strong>Copyright &copy; 2021-<?php echo date('Y'); ?> <a href="https://diskominfo.wonosobokab.go.id">Diskominfo</a>.</strong> Mas-Yon & Mas@guNk86
			</footer>
		</div>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

		<!-- Include SweetAlert CSS and JS -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

		<!-- JS Beri Rating Jawaban TL -->
		<script type="text/javascript">
			jQuery(document).ready(function($) {

				$(".btnrating1").on('click', (function(e) {

					var previous_value = $("#selected_rating1").val();

					var selected_value = $(this).attr("data-attr");
					$("#selected_rating1").val(selected_value);

					$(".selected-rating1").empty();
					$(".selected-rating1").html(selected_value);

					for (i = 1; i <= selected_value; ++i) {
						$("#rating-star1-" + i).toggleClass('btn-warning');
						$("#rating-star1-" + i).toggleClass('btn-default');
					}

					for (ix = 1; ix <= previous_value; ++ix) {
						$("#rating-star1-" + ix).toggleClass('btn-warning');
						$("#rating-star1-" + ix).toggleClass('btn-default');
					}

				}));

			});
		</script>

		<!-- Include SweetAlert initialization script -->
		<script>
			function showSweetAlert(icon, title, text, buttonColor) {
				Swal.fire({
					icon: icon,
					title: title,
					text: text,
					showConfirmButton: false,
					timer: 3000
				});
			}
			document.getElementById('submitBtn').addEventListener('click', function() {
				showSweetAlert('success', 'Success!', 'Penilaian Anda berhasil dikirim.', '#28a745');
				document.getElementById('ratingForm').submit();
			});
		</script>

		<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function() {
					$(this).remove();
				});
			}, 3000);
		</script>

		<script>
			setTimeout(function() {
				window.location.href = "<?php echo base_url('home'); ?>";
			}, 100000);
		</script>
</body>

</html>