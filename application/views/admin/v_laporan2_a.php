<!--Counter Inbox-->
<?php
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan = $query->num_rows();
$query1 = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
$jum_komentar = $query1->num_rows();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

  <!-- Tambahkan script CKEditor -->
  <script src="<?= base_url() . 'assets/ckeditor/ckeditor.js' ?>"></script>

  <!-- Inisialisasi CKEditor -->
  <script>
    CKEDITOR.replace('x_tindaklanjut_inputtl');
  </script>

  <?php
  function limit_words($string, $word_limit)
  {
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
  }

  ?>

</head>

<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    <!--Header-->
    <?php
    $this->load->view('admin/v_header');
    $level = $this->session->userdata('pengguna_level');
    ?>
    <?php if ($level === '1') : ?>
      <?php $this->load->view('admin/v_sidebar2'); ?>
    <?php endif; ?>

    <?php if ($level === '2') : ?>
      <?php $this->load->view('admin/v_sidebar2_opd'); ?>
    <?php endif; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Data Aduan
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('admin/laporan'); ?>">Semua Aduan</a></li>
        </ol>
      </section>

      <!-- <section>
          <div class="col-xs-6">
              < ?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-< ?= $this->session->flashdata('message_type'); ?>" style="max-width: 500px;">
                    < ?= $this->session->flashdata('message'); ?>
                </div>
              < ?php endif; ?>
          </div>
        </section> -->

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <div class="box">
                <div class="box-header">
                  <a class="btn btn-success btn-circle" href="<?php echo base_url() . 'admin/laporan/add_laporan' ?>"><span class="fa fa-plus"></span>&nbsp; Input</a>
                  <!-- <a class="btn btn-danger btn-flat" href="< ?php echo base_url().'admin/laporan/add_tambahan'?>"><span class="fa fa-plus"></span> Tambahan</a> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="tbl_laporan" class="table table-striped" style="font-size:13px;">
                    <thead>
                      <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Tiket Aduan | Tgl. | Sumber</th>
                        <th style="text-align:center;">Judul | Rincian Laporan | Lokasi | Bukti</th>
                        <th style="text-align:center;" title="Nama / HP/WA / ID Medsos Pelapor">Nama | HP/WA/ID</th>
                        <th style="text-align:center;" title="Perangkat Daerah Terkait">OPD</th>
                        <th style="text-align:center;" title="Status Aduan / Durasi TL / Rating Jawaban">Sts | Dur | Rat</th>
                        <th style="text-align:center;">Tayang</th>
                        <th style="text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tbl_laporan">

                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 3.0
      </div>
      <strong>© Lapor Bupati Wonosobo</strong>
    </footer>

    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!--- Awal Modal View Laporan--->
  <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h3 class="modal-title" id="myModalLabel">Rincian Aduan</h3>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_view' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:blue; font-size:21px;"><b>Identitas Pelapor</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <input type="hidden" name="xkode_view" id="xkode_view">
              <label for="inputUserName" class="col-sm-3 control-label">Nama</label>
              <div class="col-sm-8">
                <input type="text" name="x_nama_view" id="x_nama_view" class="form-control pull-right datepicker4" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">NIK</label>
              <div class="col-sm-8">
                <input type="text" name="x_nik_view" id="x_nik_view" class="form-control pull-right datepicker4" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-8">
                <input type="text" name="x_alamat_view" id="x_alamat_view" class="form-control pull-right datepicker4" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-8">
                <input type="text" name="x_email_view" class="form-control" id="x_email_view" placeholder="email" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">HP</label>
              <div class="col-sm-8">
                <input type="text" name="x_hp_view" id="x_hp_view" class="form-control pull-right datepicker4" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Sumber Kanal Aduan</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_sumberaduan_view" disabled required>
                  <option value="">- Pilih -</option>
                  <option value="LB">Website Lapor Bupati</option>
                  <option value="LG">Website Lapor Gubernur</option>
                  <option value="SP">SP4N LAPOR</option>
                  <option value="WA">Whatsapp Laporbup</option>
                  <option value="SM">SMS Laporbup</option>
                  <option value="IG">Instagram Laporbup</option>
                  <option value="FB">Facebook Laporbup</option>
                  <option value="TW">Twitter Laporbup</option>
                </select>
              </div>
            </div>

            <hr>
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:red; font-size:21px;"><b>Materi Aduan</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">No. Tiket Aduan</label>
              <div class="col-sm-8">
                <input type="text" name="x_tiket_view" id="x_tiket_view" class="form-control" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Tgl. Aduan Masuk</label>
              <div class="col-sm-8">
                <input type="text" name="x_tanggal_laporan_view" class="form-control" id="x_tanggal_laporan_view" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Kategori</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_kategori_laporan_view" style="width: 100%;" disabled required>
                  <option value="">- Pilih -</option>
                  <option value="1">Fisik / Infrastruktur</option>
                  <option value="2">Non Fisik / Non Infrastruktur</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Sub Kategori</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_subkategori_laporan_view" id="x_subkategori_laporan_view" style="width: 100%;" disabled required>
                  <option value="">- Pilih -</option>
                  <?php
                  $no = 0;
                  foreach ($subkatall->result_array() as $i) :
                    $no++;
                    $subkategori_id = $i['subkategori_id'];
                    $subkategori_nama = $i['subkategori_nama'];
                  ?>
                    <option value="<?php echo $subkategori_id; ?>"><?php echo $subkategori_nama; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Topik</label>
              <div class="col-sm-8">
                <input type="text" name="x_topik_laporan_view" class="form-control" id="x_topik_laporan_view" placeholder="Topik Aduan" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">OPD Tujuan</label>
              <div class="col-sm-8">
                <input type="hidden" name="kode_view" id="kode">
                <input type="text" name="x_ditujukan_kepada_view" class="form-control" id="x_ditujukan_kepada_view" placeholder="-" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Judul Aduan</label>
              <div class="col-sm-8">
                <input type="hidden" name="kode" id="kode">
                <input type="text" name="x_judul_laporan_view" class="form-control" id="x_judul_laporan_view" placeholder="Judul Aduan" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Isi Aduan</label>
              <div class="col-sm-8">
                <textarea class="form-control" rows="5" name="x_isi_laporan_view" id="x_isi_laporan_view" placeholder="Isi Aduan ..." disabled required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Lokasi</label>
              <div class="col-sm-8">
                <input type="text" name="x_lokasi_view" id="x_lokasi_view" class="form-control pull-right datepicker4" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Foto Aduan</label>
              <div class="col-sm-8" id="foto_view" name="foto_view">
                <img src="">
              </div>
            </div>

            <hr>
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:forestgreen; font-size:21px;"><b>Tindak Lanjut</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-8">
                <input type="text" name="x_keterangan_status_view" disabled class="form-control" id="x_keterangan_status_view" placeholder="Keterangan" required disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Status</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_laporan_status_view" style="width: 100%;" required="required" disabled>
                  <option value="">- Pilih -</option>
                  <option value="1">verifikasi</option>
                  <option value="2">Sedang Proses</option>
                  <option value="3">Selesai</option>
                  <option value="99">Ditolak</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Tindaklanjut (TL)</label>
              <div class="col-sm-8">
                <textarea name="x_tindaklanjut_view" class="ckeditor" id="x_tindaklanjut_view" disabled></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Tgl. TL</label>
              <div class="col-sm-8">
                <input type="text" name="x_tanggal_tindaklanjut_view" id="x_tanggal_tindaklanjut_view" class="form-control pull-right datepicker4" required disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Keterangan TL</label>
              <div class="col-sm-8">
                <textarea type="text" rows="3" name="x_keterangan_tindaklanjut_view" class="form-control" id="x_keterangan_tindaklanjut_view" placeholder="..." disabled></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Foto TL</label>
              <div class="col-sm-8" id="foto_tindaklanjut_view" name="foto_tindaklanjut_view">
                <img src="">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Durasi TL</label>
              <div class="col-sm-8">
                <input type="text" name="x_durasi_tindaklanjut_view" id="x_durasi_tindaklanjut_view" class="form-control pull-right datepicker4" required disabled>
              </div>
            </div>
            <!-- <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Rating Jawaban</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_rating_jawaban_view"  id="x_rating_jawaban_view" class="form-control pull-right" required>
                  </div>
                </div> -->
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Rating Jawaban</label>
              <div class="col-sm-8">
                <output for="x_rating_jawaban_view" id="rating" name="x_rating_jawaban_view"></output>
                <input type="range" min="0" max="5" value="" name="x_rating_jawaban_view" id="x_rating_jawaban_view" oninput="nilai(value)" style="width: 100%;">
                <script>
                  function nilai(x_rating_jawaban_view) {
                    document.querySelector('#rating').value = x_rating_jawaban_view;
                  }
                </script>
                <!-- <select class="form-control select2" name="x_rating_jawaban_view" id="x_rating_jawaban_view" style="width: 25%;">
                            <option value="0">- Pilih -</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select> -->
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Akhir modal view Laporan -->

  <!-- Modal Edit Laporan -->
  <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h3 class="modal-title" id="myModalLabel">Update Aduan</h3>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_laporan' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:blue; font-size:21px;"><b>Identitas Pelapor</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Nama</label>
              <div class="col-sm-8">
                <input type="text" name="x_nama_edit" id="x_nama_edit" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">NIK</label>
              <div class="col-sm-8">
                <input type="text" name="x_nik_edit" id="x_nik_edit" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-8">
                <input type="text" name="x_alamat_edit" id="x_alamat_edit" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-8">
                <input type="text" name="x_email_edit" id="x_email_edit" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">HP</label>
              <div class="col-sm-8">
                <input type="text" name="x_hp_edit" id="x_hp_edit" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Sumber Kanal Aduan</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_sumberaduan_edit" required>
                  <option value="">- Pilih -</option>
                  <option value="LB">Website Lapor Bupati</option>
                  <option value="LG">Website Lapor Gubernur</option>
                  <option value="SP">SP4N LAPOR</option>
                  <option value="WA">Whatsapp Laporbup</option>
                  <option value="SM">SMS Laporbup</option>
                  <option value="IG">Instagram Laporbup</option>
                  <option value="FB">Facebook Laporbup</option>
                  <option value="TW">Twitter Laporbup</option>
                </select>
              </div>
            </div>

            <hr>
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:red; font-size:21px;"><b>Materi Aduan</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">No. Tiket Aduan</label>
              <div class="col-sm-8">
                <input type="text" name="x_tiket_edit" id="x_tiket_edit" class="form-control pull-right datepicker4" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Tgl. Aduan Masuk</label>
              <div class="col-sm-8">
                <input type="text" name="x_tanggal_laporan_edit" id="x_tanggal_laporan_edit" class="form-control pull-right datepicker4" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Kategori</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_kategori_laporan_edit" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <option value="1">Fisik</option>
                  <option value="2">Non Fisik</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Sub Kategori</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_subkategori_laporan_edit" id="x_subkategori_laporan_edit" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <?php
                  $no = 0;
                  foreach ($subkatall->result_array() as $i) :
                    $no++;
                    $subkategori_id = $i['subkategori_id'];
                    $subkategori_nama = $i['subkategori_nama'];
                  ?>
                    <option value="<?php echo $subkategori_id; ?>"><?php echo $subkategori_nama; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Topik</label>
              <div class="col-sm-8">
                <input type="text" name="x_topik_laporan_edit" id="x_topik_laporan_edit" class="form-control pull-right" placeholder="Topik Aduan" required>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="xkode_edit" id="xkode_edit">
              <label for="inputUserName" class="col-sm-3 control-label">OPD Tujuan</label>
              <div class="col-sm-8">
                <input type="hidden" name="x_id_kepada_edit" id="x_id_kepada_edit" required>
                <input type="text" name="x_ditujukan_kepada_edit" disabled class="form-control" id="x_ditujukan_kepada_edit" placeholder="Kepada" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Judul Aduan</label>
              <div class="col-sm-8">
                <input type="text" name="x_judul_laporan_edit" class="form-control" id="x_judul_laporan_edit" placeholder="Judul Aduan" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Isi Aduan</label>
              <div class="col-sm-8">
                <textarea class="form-control" rows="5" name="x_isi_laporan_edit" id="x_isi_laporan_edit" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Lokasi</label>
              <div class="col-sm-8">
                <input type="text" name="x_lokasi_edit" id="x_lokasi_edit" class="form-control pull-right datepicker4" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Foto Aduan</label>
              <div class="col-sm-8" id="foto_edit_view" name="foto_edit_view">
                <img src="">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Upload / Ubah Foto Aduan</label>
              <div class="col-sm-8">
                <input type="file" name="x_foto_edit">
                <input type="hidden" name="x_foto">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o"></i>&nbsp; Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--- Akhir Modal Edit Laporan--->

  <!-- Awal Modal Input TL -->
  <div class="modal fade" id="ModalInputtl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h3 class="modal-title" id="myModalLabel">Input TL by Admin</h3>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/input_tindaklanjut' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body mr-1">
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:forestgreen; font-size:21px;"><b>Tindak Lanjut</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <input type="hidden" name="xkode_inputtl" id="xkode_inputtl">
              <label for="inputUserName" class="col-sm-3 control-label">Status</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_laporan_status_inputtl" style="width: 100%;">
                  <option value="">- Pilih -</option>
                  <option value="1">Verifikasi</option>
                  <option value="2">Sedang Proses</option>
                  <option value="3">Selesai</option>
                  <option value="99">Ditolak</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Keterangan</label>
              <div class="col-sm-8">
                <input type="text" name="x_keterangan_status_inputtl" class="form-control" id="x_keterangan_status_inputtl" placeholder="Keterangan">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Tindaklanjut (TL)</label>
              <div class="col-sm-8">
                <textarea name="x_tindaklanjut_inputtl" class="ckeditor" id="x_tindaklanjut_inputtl"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Tgl. TL</label>
              <div class="col-sm-8">
                <input type="text" name="x_tanggal_tindaklanjut_inputtl" id="x_tanggal_tindaklanjut_inputtl" class="form-control pull-right datepicker4" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Keterangan TL Tambahan</label>
              <div class="col-sm-8">
                <textarea type="text" rows="3" name="x_keterangan_tindaklanjut_inputtl" class="form-control" id="x_keterangan_tindaklanjut_inputtl" placeholder="..."></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Foto TL</label>
              <div class="col-sm-8" id="foto_tindaklanjut_inputtl_view" name="foto_tindaklanjut_inputtl_view">
                <img src="">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Upload / Ubah Foto TL</label>
              <div class="col-sm-8">
                <input type="file" name="x_foto_tindaklanjut_inputtl">
                <input type="hidden" name="x_foto_tindaklanjut">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o"></i>&nbsp; Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Akhir Modal Input TL -->

  <!-- Awal Modal Copy Laporan -->
  <div class="modal fade" id="ModalCopy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h3 class="modal-title" id="myModalLabel">Duplikat Aduan</h3>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/copy_laporan' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:blue; font-size:21px;"><b>Identitas Pelapor</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Nama</label>
              <div class="col-sm-8">
                <input type="text" name="x_nama_copy" id="x_nama_copy" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">NIK</label>
              <div class="col-sm-8">
                <input type="text" name="x_nik_copy" id="x_nik_copy" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-8">
                <input type="text" name="x_alamat_copy" id="x_alamat_copy" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-8">
                <input type="text" name="x_email_copy" id="x_email_copy" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">HP</label>
              <div class="col-sm-8">
                <input type="text" name="x_hp_copy" id="x_hp_copy" class="form-control pull-right datepicker4">
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Sumber Kanal Aduan</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_sumberaduan_copy" required>
                  <option value="">- Pilih -</option>
                  <option value="LB">Website Lapor Bupati</option>
                  <option value="LG">Website Lapor Gubernur</option>
                  <option value="SP">SP4N LAPOR</option>
                  <option value="WA">Whatsapp Laporbup</option>
                  <option value="SM">SMS Laporbup</option>
                  <option value="IG">Instagram Laporbup</option>
                  <option value="FB">Facebook Laporbup</option>
                  <option value="TW">Twitter Laporbup</option>
                </select>
              </div>
            </div>

            <hr>
            <h4 class="modal-title" id="myModalLabel" align="center">
              <p style="color:red; font-size:21px;"><b>Materi Aduan</b></p>
            </h4>
            <hr>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Tgl. Aduan</label>
              <div class="col-sm-8">
                <input type="text" name="x_tanggal_laporan_copy" id="x_tanggal_laporan_copy" class="form-control pull-right datepicker4" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Kategori</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_kategori_laporan_copy" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <option value="1">Fisik</option>
                  <option value="2">Non Fisik</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Sub Kategori</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_subkategori_laporan_copy" id="x_subkategori_laporan_copy" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <?php
                  $no = 0;
                  foreach ($subkatall->result_array() as $i) :
                    $no++;
                    $subkategori_id = $i['subkategori_id'];
                    $subkategori_nama = $i['subkategori_nama'];
                  ?>
                    <option value="<?php echo $subkategori_id; ?>"><?php echo $subkategori_nama; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Topik</label>
              <div class="col-sm-8">
                <input type="text" name="x_topik_laporan_copy" id="x_topik_laporan_copy" class="form-control pull-right" placeholder="Topik Aduan" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">OPD Tujuan</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="x_ditujukan_kepada_copy" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <?php
                  $no = 0;
                  foreach ($kpd->result_array() as $i) :
                    $no++;
                    $id_opd = $i['id_opd'];
                    $opd_singkat = $i['opd_singkat'];
                  ?>
                    <option value="<?php echo $id_opd; ?>"><?php echo $opd_singkat; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Judul Aduan</label>
              <div class="col-sm-8">
                <input type="text" name="x_judul_laporan_copy" class="form-control" id="x_judul_laporan_copy" placeholder="Judul Aduan" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Isi Aduan</label>
              <div class="col-sm-8">
                <textarea class="form-control" rows="10" name="x_isi_laporan_copy" id="x_isi_laporan_copy" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Lokasi</label>
              <div class="col-sm-8">
                <input type="text" name="x_lokasi_copy" id="x_lokasi_copy" class="form-control pull-right datepicker4" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-3 control-label">Upload Foto Aduan</label>
              <div class="col-sm-8">
                <input type="file" name="filefoto">
                <!-- <input type="hidden" name="x_foto"> -->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--- Akhir Modal Copy Laporan--->

  <!--Modal Hapus Laporan -->
  <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h3 class="modal-title" id="myModalLabel">Hapus Aduan</h3>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/hapus_laporan' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="x_kode_hapus" id="x_kode_hapus" />
            <input type="hidden" name="x_foto_hapus" id="x_foto_hapus" />
            <p>Apakah Anda yakin mau menghapus Aduan dari <b name="x_nama_hapus"></b>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger btn-circle" id="simpan"><i class="fa fa-trash-o"></i>&nbsp; Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Teruskan -->
  <div class="modal fade" id="ModalTeruskan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h3 class="modal-title" id="myModalLabel">Teruskan Aduan</h3>
        </div>
        <form id="form_teruskan" class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_teruskan' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="x_kode_teruskan" id="x_kode_teruskan">
              <label for="inputUserName" class="col-sm-4 control-label">Teruskan Kepada</label>
              <div class="col-sm-7">
                <select class="form-control select2" name="x_id_kepada_teruskan" id="x_id_kepada_teruskan" style="width: 100%;" required>
                  <option value="">- Pilih -</option>
                  <?php
                  $no = 0;
                  foreach ($kpd->result_array() as $i) :
                    $no++;
                    $id_opd = $i['id_opd'];
                    $opd_singkat = $i['opd_singkat'];
                  ?>
                    <option value="<?php echo $id_opd; ?>"><?php echo $opd_singkat; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
              <div class="col-sm-7">
                <input type="text" name="x_judul_laporan_teruskan" class="form-control" id="x_judul_laporan_teruskan" placeholder="Judul aduan" disabled>
              </div>
            </div>

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
              <div class="col-sm-7">
                <textarea class="form-control" rows="3" name="x_isi_laporan_teruskan" id="x_isi_laporan_teruskan" disabled></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
              <div class="col-sm-7">
                <input type="text" name="x_keterangan_status_teruskan" class="form-control" id="x_keterangan_status_teruskan" placeholder="Keterangan" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-paper-plane"></i>&nbsp; Teruskan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Kirim Notifikasi WA ke Pengadu -->
  <div class="modal fade" id="ModalNotifpengadu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h3 class="modal-title" id="myModalLabel">Kirim Notifikasi Whatsapp ke Pengadu</h3>
        </div>
        <form id="form_teruskan" class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_notifwapengadu' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="x_kode_notifwapengadu" id="x_kode_notifwapengadu">
              <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
              <div class="col-sm-7">
                <input type="text" name="x_nama_notifwapengadu" class="form-control" id="x_nama_notifwapengadu" placeholder="Nama Pengadu" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Whatsapp</label>
              <div class="col-sm-7">
                <input type="text" name="x_nohp_notifwapengadu" class="form-control" id="x_nohp_notifwapengadu" placeholder="Nomor Whatsapp" disabled>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success btn-circle" id="simpan"><i class="fa fa-whatsapp"></i>&nbsp; Kirim Notifikasi</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- jQuery 3.3.1 -->
  <!-- <script src="< ?php echo base_url().'assets/plugins/jQuery/jquery-3.3.1.js'?>"></script> -->
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
  <!-- page script -->

  <script type="text/javascript">
    $(document).ready(function() {
      tampil_data(); //pemanggilan fungsi tampil_data

      //fungsi tampil data
      function tampil_data() {
        $.ajax({
          type: 'GET',
          url: '<?php echo base_url() ?>admin/laporan/get_semua',
          async: true,
          dataType: 'json',
          success: function(data) {
            var base_urlx = "<?php echo base_url('assets/images/') ?>";
            var html = '';
            var i;
            var no = 0;
            for (i = 0; i < data.length; i++) {
              var no = no + 1;
              var jenis = data[i].id_jenis;
              if (jenis == 1) {
                id_jenis = "Aduan";
              }
              var pemberitahuan = data[i].kirim_pemberitahuan;
              if (pemberitahuan == 'Ya') {
                pemberitahuan_kirim = '';
              } else {
                pemberitahuan_kirim = '<a href="javascript:;" class="btn btn-primary btn-xs item_kirim_pemberitahuan" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-envelope"> kirim email</span></a>';
              }

              var laporan = data[i].laporan_status;
              if (laporan == 1) {
                laporan_status = '<a href="javascript:;" data-toggle="tooltip" title="Aduan Belum Direspon, segera Teruskan ke OPD terkait" class="btn btn-danger btn-xs item_teruskan" data="' + data[i].id + '" style="width:90px;">Verifikasi</a>';
              } else if (laporan == 2) {
                laporan_status = '<a href="#" data-toggle="tooltip" title="Aduan Sedang di Proses oleh OPD terkait" class="btn btn-warning btn-xs item_kirim_pemberitahuan" style="width:90px;">Sedang Proses</a>';
              } else if (laporan == 99) {
                laporan_status = '<a href="javascript:;" data-toggle="tooltip" title="Teruskan Aduan ke OPD lain yang terkait" class="btn btn-info btn-xs item_teruskan" data="' + data[i].id + '" style="width:90px;">Ditolak</a>';
              } else {
                laporan_status = '<a href="javascript:;" data-toggle="tooltip" title="Lihat Rincian Aduan & Beri Rating Jawaban TL" class="btn btn-success btn-xs item_view" data="' + data[i].id + '" style="width:90px;">Selesai</a>';
              }

              var sumber = data[i].sumber_aduan;
              if (sumber == 'LB') {
                sumber = 'Website Lapor Bupati';
              } else if (sumber == 'LG') {
                sumber = 'Website Lapor Gubernur';
              } else if (sumber == 'SP') {
                sumber = 'SP4N LAPOR';
              } else if (sumber == 'WA') {
                sumber = 'Whatsapp Lapor Bupati';
              } else if (sumber == 'SM') {
                sumber = 'SMS Lapor Bupati';
              } else if (sumber == 'IG') {
                sumber = 'Instagram Lapor Bupati';
              } else if (sumber == 'FB') {
                sumber = 'Facebook Lapor Bupati';
              } else if (sumber == 'TW') {
                sumber = 'Twitter Lapor Bupati';
              } else {
                sumber = '';
              }

              var rating = data[i].rating_jawaban;
              if (rating == 1) {
                rating = '<a href="javascript:;" style="color:gold;" title="1 Bintang" class="item_view" data="' + data[i].id + '"><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
              } else if (rating == 2) {
                rating = '<a href="javascript:;" style="color:gold;" title="2 Bintang" class="item_view" data="' + data[i].id + '"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
              } else if (rating == 3) {
                rating = '<a href="javascript:;" style="color:gold;" title="3 Bintang" class="item_view" data="' + data[i].id + '"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
              } else if (rating == 4) {
                rating = '<a href="javascript:;" style="color:gold;" title="4 Bintang" class="item_view" data="' + data[i].id + '"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></a>';
              } else if (rating == 5) {
                rating = '<a href="javascript:;" style="color:gold;" title="5 Bintang" class="item_view" data="' + data[i].id + '"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a>';
              } else {
                rating = '<a href="javascript:;" style="color:gold;" title="0 Bintang" class="item_view" data="' + data[i].id + '"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
              }

              // Keterangan Ditolak
              var ditolak = data[i].laporan_status;
              if (ditolak == 99) {
                keterangan_tolak = '<br><br><b style="color:red">[ ' + data[i].keterangan_tolak + ' ]</b>';
              } else {
                keterangan_tolak = '';
              }

              // Durasi TL
              var awal = new Date(data[i].tanggal_laporan);
              var akhir = new Date(data[i].tanggal_tindaklanjut);

              selisihDetik = Math.floor((akhir - (awal)) / 1000);
              selisihMenit = Math.floor(selisihDetik / 60);
              selisihJam = Math.floor(selisihMenit / 60);
              selisihHari = Math.floor(selisihJam / 24);

              jamTl = selisihJam - (selisihHari * 24);
              menitTl = selisihMenit - (selisihHari * 24 * 60) - (jamTl * 60);
              detikTl = selisihDetik - (selisihHari * 24 * 60 * 60) - (jamTl * 60 * 60) - (menitTl * 60);

              var fileName = data[i].foto;
              var fileExtension = fileName.split('.').pop();
              if (fileExtension == "pdf") {
                tampilimagefoto = '<embed src="' + base_urlx + data[i].foto + '" width="90px" height="90px" /><a href="' + base_urlx + data[i].foto + '" style="width:90px;"><br>View Dokumen</a>';
              } else if (fileExtension === "") {
                tampilimagefoto = '[ - ]';
              } else {
                tampilimagefoto = '<a href="' + base_urlx + data[i].foto + '" target="_blank" style="width:90px;" title="Klik untuk melihat detail foto aduan"><img src="' + base_urlx + data[i].foto + '" style="width:90px;"></a>';
              }

              html += '<tr>' +
                '<td>' + no + '</td>' +
                '<td>' + '<b style="color:red;">' + 'LB' + data[i].sumber_aduan + '-' + data[i].id + '</b><br><br>' + data[i].tanggal_laporan + '<br><br>' + sumber + '</td>' +
                '<td style="text-align:justify;">' + '<b>[' + data[i].judul_laporan + ']</b><br><br>' + data[i].isi_laporan + '<br><br><i class="fa fa-map-marker"></i> ' + data[i].lokasi + '<br><br>' + tampilimagefoto + '</td>' +
                '<td>' + data[i].nama + '<br>' + data[i].hp + '</td>' +
                '<td>' + data[i].ditujukan_kepada + '</td>' +
                '<td style="text-align:center;">' + laporan_status + keterangan_tolak + '<br><br><b>' + selisihHari + '</b>' + " hari " + '<b>' + jamTl + '</b>' + " jam " + '<b><br>' + menitTl + '</b>' + " menit " + '<b>' + detikTl + '</b>' + " detik" +
                '<br><br>' + rating + '</td>' +
                // pemberitahuan_kirim+'</td>'+
                '<td style="text-align:center;">' + '<a href="javascript:;" class="btn btn-primary btn-xs item_tayang" data="' + data[i].id + '">' + data[i].tayang + '</a>' + '</td>' +
                '<td style="text-align:left;">' +
                '<div class="btn-group" role="group">' +
                '<button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-gear"></span></button>' +
                '<div class="dropdown-menu">' +
                '<a href="javascript:;" data-toggle="tooltip" title="Rincian Aduan & Rating" class="btn btn-success btn-xs item_view" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-eye"> View</span></a><br>' +
                '<a href="javascript:;" data-toggle="tooltip" title="Edit Aduan" class="btn btn-warning btn-xs item_edit" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-pencil"> Edit</span></a><br>' +
                '<a href="javascript:;" data-toggle="tooltip" title="Input TL by Admin" class="btn btn-secondary btn-xs item_inputtl" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-pencil"> Input TL</span></a><br>' +
                '<a href="javascript:;" data-toggle="tooltip" title="Hapus Aduan" class="btn btn-danger btn-xs item_hapus" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-trash"> Hapus</span></a><br>' +
                '<a href="<?php echo base_url('home/detail/'); ?>' + data[i].id + '" target="_blank" data-toggle="tooltip" title="Lihat Nomor Tiket Aduan" class="btn btn-primary btn-xs item_detail" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-arrow-right"> Detail</span></a><br>' +
                '<a href="javascript:;" data-toggle="tooltip" title="Teruskan Aduan ke OPD" class="btn btn-info btn-xs item_teruskan" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-paper-plane"> Teruskan</span></a><br>' +
                '<a href="javascript:;" data-toggle="tooltip" title="Kirim Notifikasi Progres TL ke Pelapor" class="btn btn-dark btn-xs item_notif_pengadu" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-whatsapp"> Tracking</span></a><br>' +
                '<a href="javascript:;" data-toggle="tooltip" title="Copy Aduan" class="btn btn-warning btn-xs item_copy" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-copy"> Duplikat</span></a><br>' +
                '<a href="javascript:;" data-toggle="tooltip" title="Cetak Dokumen" class="btn btn-info btn-xs item_cetak" data="' + data[i].id + '" style="width:90px;"><span class="fa fa-print"> Cetak</span></a>' + '<br>' +
                '</div>' +
                '</div>' +
                //pemberitahuan_kirim+
                '</td>' +
                '</tr>';
            }
            $('#tbody_tbl_laporan').html(html);
            // tambahan
            $('#tbl_laporan').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": true,
              "scrollX": true
              // "processing": true,
              // "serverSide": true,
            });
            // tutuptambahan
          }
        });
      }

      // View Aduan
      $('#tbl_laporan').on('click', '.item_view', function() {
        var id = $(this).attr('data');
        var gbr1 = '';
        var gbr2 = '';
        var base_urlx = "<?php echo base_url('assets/images/') ?>";

        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              // Status Laporan
              var laporan_status = data[i].laporan_status;
              if (laporan_status == 1) {
                laporan_status = "Verifikasi";
              } else if (laporan_status == 2) {
                laporan_status = "Sedang Proses";
              } else if (laporan_status == 3) {
                laporan_status = "Selesai";
              }

              // Tiket Laporan
              var sumber_aduan = data[i].sumber_aduan;
              var id = data[i].id;
              if (id !== '') {
                nomor_tiket = 'LB' + data[i].sumber_aduan + '-' + data[i].id;
              } else {
                nomor_tiket = '';
              }

              // Durasi TL
              var awal = new Date(data[i].tanggal_laporan);
              var akhir = new Date(data[i].tanggal_tindaklanjut);

              selisihDetik = Math.floor((akhir - (awal)) / 1000);
              selisihMenit = Math.floor(selisihDetik / 60);
              selisihJam = Math.floor(selisihMenit / 60);
              selisihHari = Math.floor(selisihJam / 24);

              jamTl = selisihJam - (selisihHari * 24);
              menitTl = selisihMenit - (selisihHari * 24 * 60) - (jamTl * 60);
              detikTl = selisihDetik - (selisihHari * 24 * 60 * 60) - (jamTl * 60 * 60) - (menitTl * 60);
              durasiTl = selisihHari + " hari  " + jamTl + " jam  " + menitTl + " menit  " + detikTl + " detik"
              // var awal  = new Date(data[i].tanggal_laporan);
              // var akhir = new Date(data[i].tanggal_tindaklanjut);
              // var awalDalamMilidetik = awal.getTime();
              // var akhirDalamMilidetik = akhir.getTime();

              // var selisihMilidetik = akhirDalamMilidetik - awalDalamMilidetik;
              // var selisihDetik = selisihMilidetik/1000;
              // var selisihMenit = selisihDetik/60;
              // // var selisihJam = selisihMenit/60;
              // var selisihJam = (selisihMenit/60).toFixed(2);
              // // var selisihHari = selisihJam/24;
              // var selisihHari = (selisihJam/24).toFixed(2);

              $('#ModalView').modal('show');
              $('[name="xkode_view"]').val(data[i].id);
              $('[name="x_nama_view"]').val(data[i].nama);
              $('[name="x_nik_view"]').val(data[i].nik);
              $('[name="x_alamat_view"]').val(data[i].alamat);
              $('[name="x_email_view"]').val(data[i].email);
              $('[name="x_hp_view"]').val(data[i].hp);
              $('[name="x_sumberaduan_view"]').val(data[i].sumber_aduan);
              $('[name="x_tiket_view"]').val(nomor_tiket);
              $('[name="x_tanggal_laporan_view"]').val(data[i].tanggal_laporan);
              $('[name="x_kategori_laporan_view"]').val(data[i].kategori_laporan);
              $('[name="x_subkategori_laporan_view"]').val(data[i].subkategori_laporan);
              $('[name="x_topik_laporan_view"]').val(data[i].topik_laporan);
              $('[name="x_ditujukan_kepada_view"]').val(data[i].ditujukan_kepada);
              $('[name="x_judul_laporan_view"]').val(data[i].judul_laporan);
              $('[name="x_isi_laporan_view"]').val(data[i].isi_laporan);
              $('[name="x_lokasi_view"]').val(data[i].lokasi);
              $('[name="foto_view"]').html('');
              $('[name="x_keterangan_status_view"]').val(data[i].keterangan_status);
              $('[name="x_laporan_status_view"]').val(data[i].laporan_status);
              CKEDITOR.instances.x_tindaklanjut_view.setData(data[i].tindaklanjut);
              $('[name="x_tanggal_tindaklanjut_view"]').val(data[i].tanggal_tindaklanjut);
              $('[name="x_keterangan_tindaklanjut_view"]').val(data[i].keterangan_tindaklanjut);
              $('[name="foto_tindaklanjut_view"]').html('');
              // $('[name="x_durasi_tindaklanjutHari_view"]').val(Math.round(selisihHari));
              $('[name="x_durasi_tindaklanjut_view"]').val(durasiTl);
              // $('[name="x_durasi_tindaklanjutJam_view"]').val(Math.round(selisihJam));
              // $('[name="x_durasi_tindaklanjutJam_view"]').val(jamTl);
              $('[name="x_rating_jawaban_view"]').val(data[i].rating_jawaban);

              // Foto Aduan
              var fileNameFotoView = data[i].foto;
              var fileExtension = fileNameFotoView.split('.').pop();
              if (fileExtension == "pdf") {
                gbr1 += '<embed src="' + base_urlx + data[i].foto + '" width="90px" height="90px" alt="no img"/><a href="' + base_urlx + data[i].foto + '" target="_blank" style="width:90px;"><br>View Dokumen</a>';
                $('#foto_view').append(gbr1);
              } else if (fileNameFotoView == "") {
                gbr1 += '[ - ]';
                $('#foto_view').append(gbr1);
              } else {
                gbr1 += '<a href="' + base_urlx + data[i].foto + '" target="_blank" style="width:90px;" title="Klik untuk melihat detail foto aduan"><img src="' + base_urlx + data[i].foto + '" style="height:250px;width:350px;" alt="no img"></a>';
                $('#foto_view').append(gbr1);
              }

              // Foto Tindak Lanjut
              var fileNameFotoTL = data[i].foto_tindaklanjut;
              var fileExtension = fileNameFotoTL.split('.').pop();
              if (fileExtension == "pdf") {
                gbr2 += '<embed src="' + base_urlx + data[i].foto_tindaklanjut + '" width="90px" height="90px" alt="no img"/><a href="' + base_urlx + data[i].foto_tindaklanjut + '" target="_blank" style="width:90px;"><br>View Bukti TL</a>';
                $('#foto_tindaklanjut_view').append(gbr2);
              } else if (fileNameFotoTL == "") {
                gbr2 += '[ - ]';
                $('#foto_tindaklanjut_view').append(gbr2);
              } else {
                gbr2 += '<a href="' + base_urlx + data[i].foto_tindaklanjut + '" target="_blank" style="width:90px;" title="Klik untuk melihat detail foto TL"><img src="' + base_urlx + data[i].foto_tindaklanjut + '" style="height:250px;width:350px;" alt="no img"></a>';
                $('#foto_tindaklanjut_view').append(gbr2);
              }

            });
          }
        });
        return false;
      });


      //Edit Aduan
      $('#tbl_laporan').on('click', '.item_edit', function() {
        var id = $(this).attr('data');
        var base_urlx = "<?php echo base_url('assets/images/') ?>";
        var gbr1 = '';
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {

              // Tiket Laporan
              var id = data[i].id;
              if (id !== '') {
                nomor_tiket = 'LB' + data[i].sumber_aduan + '-' + data[i].id;
              } else {
                nomor_tiket = '';
              }

              $('#ModalEdit').modal('show');
              $('[name="xkode_edit"]').val(data[i].id);
              $('[name="x_nama_edit"]').val(data[i].nama);
              $('[name="x_nik_edit"]').val(data[i].nik);
              $('[name="x_alamat_edit"]').val(data[i].alamat);
              $('[name="x_email_edit"]').val(data[i].email);
              $('[name="x_hp_edit"]').val(data[i].hp);
              $('[name="x_sumberaduan_edit"]').val(data[i].sumber_aduan);
              $('[name="x_tiket_edit"]').val(nomor_tiket);
              $('[name="x_tanggal_laporan_edit"]').val(data[i].tanggal_laporan);
              $('[name="x_kategori_laporan_edit"]').val(data[i].kategori_laporan);
              $('[name="x_subkategori_laporan_edit"]').val(data[i].subkategori_laporan);
              $('[name="x_topik_laporan_edit"]').val(data[i].topik_laporan);
              $('[name="x_id_kepada_edit"]').val(data[i].id_kepada);
              $('[name="x_ditujukan_kepada_edit"]').val(data[i].ditujukan_kepada);
              $('[name="x_judul_laporan_edit"]').val(data[i].judul_laporan);
              $('[name="x_isi_laporan_edit"]').val(data[i].isi_laporan);
              $('[name="x_lokasi_edit"]').val(data[i].lokasi);
              $('[name="foto_edit_view"]').html('');
              $('[name="x_foto"]').val(data[i].foto);

              var fileNameFotoView = data[i].foto;
              var fileExtension = fileNameFotoView.split('.').pop();
              if (fileExtension == "pdf") {
                gbr1 += '<embed src="' + base_urlx + data[i].foto + '" width="90px" height="90px" alt="no img"/><a href="' + base_urlx + data[i].foto + '" target="_blank" style="width:90px;"><br>View Dokumen</a>';
                $('#foto_edit_view').append(gbr1);
              } else if (fileNameFotoView == "") {
                gbr1 += '[ - ]';
                $('#foto_edit_view').append(gbr1);
              } else {
                gbr1 += '<a href="' + base_urlx + data[i].foto + '" target="_blank" style="width:90px;" title="Klik untuk melihat detail foto aduan"><img src="' + base_urlx + data[i].foto + '" style="height:250px;width:350px;" alt="no img"></a>';
                $('#foto_edit_view').append(gbr1);
              }

            });
          }
        });
        return false;
      });

      //Copy Aduan
      $('#tbl_laporan').on('click', '.item_copy', function() {
        var id = $(this).attr('data');
        var base_urlx = "<?php echo base_url('assets/images/') ?>";
        var gbr2 = '';
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              $('#ModalCopy').modal('show');
              $('[name="x_nama_copy"]').val(data[i].nama);
              $('[name="x_nik_copy"]').val(data[i].nik);
              $('[name="x_alamat_copy"]').val(data[i].alamat);
              $('[name="x_email_copy"]').val(data[i].email);
              $('[name="x_hp_copy"]').val(data[i].hp);
              $('[name="x_sumberaduan_copy"]').val(data[i].sumber_aduan);
              $('[name="x_tanggal_laporan_copy"]').val(data[i].tanggal_laporan);
              $('[name="x_kategori_laporan_copy"]').val(data[i].kategori_laporan);
              $('[name="x_subkategori_laporan_copy"]').val(data[i].subkategori_laporan);
              $('[name="x_topik_laporan_copy"]').val(data[i].topik_laporan);
              $('[name="x_id_kepada_copy"]').val(data[i].id_kepada);
              $('[name="x_ditujukan_kepada_copy"]').val(data[i].ditujukan_kepada);
              $('[name="x_judul_laporan_copy"]').val(data[i].judul_laporan);
              $('[name="x_isi_laporan_copy"]').val(data[i].isi_laporan);
              $('[name="x_lokasi_copy"]').val(data[i].lokasi);
              $('[name="x_foto"]').val(data[i].foto);

              gbr2 += '<img src="' + base_urlx + data[i].foto + '" style="height:190px;" alt="no img">';
              $('[name="foto_view"]').append(gbr2);
              $('[name="foto_view"]').refresh;
            });
          }
        });
        return false;
      });

      //get Input TL
      $('#tbl_laporan').on('click', '.item_inputtl', function() {
        var id = $(this).attr('data');
        var base_urlx = "<?php echo base_url('assets/images/') ?>";
        var gbr2 = '';
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              $('#ModalInputtl').modal('show');
              $('[name="xkode_inputtl"]').val(data[i].id);
              $('[name="x_laporan_status_inputtl"]').val(data[i].laporan_status);
              $('[name="x_keterangan_status_inputtl"]').val(data[i].keterangan_status);
              CKEDITOR.instances.x_tindaklanjut_inputtl.setData(data[i].tindaklanjut);
              $('[name="x_tanggal_tindaklanjut_inputtl"]').val(data[i].tanggal_tindaklanjut);
              $('[name="x_keterangan_tindaklanjut_inputtl"]').val(data[i].keterangan_tindaklanjut);
              $('[name="foto_tindaklanjut_inputtl_view"]').html('');
              $('[name="x_foto_tindaklanjut"]').val(data[i].foto_tindaklanjut);

              // Foto Tindak Lanjut
              var fileNameFotoTL = data[i].foto_tindaklanjut;
              var fileExtension = fileNameFotoTL.split('.').pop();
              if (fileExtension == "pdf") {
                gbr2 += '<embed src="' + base_urlx + data[i].foto_tindaklanjut + '" width="90px" height="90px" alt="no img"/><a href="' + base_urlx + data[i].foto_tindaklanjut + '" target="_blank" style="width:90px;"><br>View Bukti TL</a>';
                $('#foto_tindaklanjut_inputtl_view').append(gbr2);
              } else if (fileNameFotoTL == "") {
                gbr2 += '[ - ]';
                $('#foto_tindaklanjut_inputtl_view').append(gbr2);
              } else {
                gbr2 += '<a href="' + base_urlx + data[i].foto_tindaklanjut + '" target="_blank" style="width:90px;" title="Klik untuk melihat detail foto TL"><img src="' + base_urlx + data[i].foto_tindaklanjut + '" style="height:250px;width:350px;" alt="no img"></a>';
                $('#foto_tindaklanjut_inputtl_view').append(gbr2);
              }

            });
          }
        });
        return false;
      });


      //TERUSKAN
      $('#tbl_laporan').on('click', '.item_teruskan', function() {
        var id = $(this).attr('data');

        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {

              $('#ModalTeruskan').modal('show');
              $('[name="x_kode_teruskan"]').val(data[i].id);
              $('[name="x_id_kepada_teruskan"]').val(data[i].ditujukan_kepada);
              $('[name="x_judul_laporan_teruskan"]').val(data[i].judul_laporan);
              $('[name="x_isi_laporan_teruskan"]').val(data[i].isi_laporan);
              $('[name="x_keterangan_status_teruskan"]').val(data[i].keterangan_status);

            });
          }
        });
        return false;
      });

      // Script Cetak Dokumen Aduan
      $('#tbl_laporan').on('click', '.item_cetak', function() {
        var id = $(this).attr('data');
        var gbr = '';
        var gbr1 = '';
        var gbr2 = '';
        var base_urlx = "<?php echo base_url('assets/images/') ?>";

        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_cetaksubkategori') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              // Status Laporan
              var laporan = data[i].laporan_status;
              if (laporan == 1) {
                laporan_status = 'Verifikasi';
              } else if (laporan == 2) {
                laporan_status = 'Sedang Proses';
              } else if (laporan == 99) {
                laporan_status = 'Ditolak';
              } else {
                laporan_status = 'Selesai';
              }

              // Tiket Laporan
              var sumber_aduan = data[i].sumber_aduan;
              var id = data[i].id;
              if (id !== '') {
                nomor_tiket = 'LB' + data[i].sumber_aduan + '-' + data[i].id;
              } else {
                nomor_tiket = '';
              }

              // Foto Aduan
              var fileNameFotoView = data[i].foto;
              var fileExtension = fileNameFotoView.split('.').pop();
              if (fileExtension == "pdf") {

                gbr1 += '<embed src="' + base_urlx + data[i].foto + '" width="90px" height="90px" alt="no img"/>';
                $('#foto_view').append(gbr1);
              } else if (fileNameFotoView == "") {
                gbr1 += '[ - ]';
                $('#foto_view').append(gbr1);
              } else {
                gbr1 += '<img src="' + base_urlx + data[i].foto + '" style="height:250px;width:350px;" alt="no img">';
                $('#foto_view').append(gbr1);
              }

              // Foto Tindak Lanjut
              var fileNameFotoTL = data[i].foto_tindaklanjut;
              var fileExtension = fileNameFotoTL.split('.').pop();
              if (fileExtension == "pdf") {

                gbr2 += '<embed src="' + base_urlx + data[i].foto_tindaklanjut + '" width="90px" height="90px" alt="no img"/>';
                $('#foto_tindaklanjut_view').append(gbr2);
              } else if (fileNameFotoTL == "") {
                gbr2 += '[ - ]';
                $('#foto_tindaklanjut_view').append(gbr2);
              } else {
                gbr2 += '<img src="' + base_urlx + data[i].foto_tindaklanjut + '" style="height:250px;width:350px;" alt="no img">';
                $('#foto_tindaklanjut_view').append(gbr2);
              }

              // Tanggal Tindak Lanjut
              var tgl_tl = data[i].tanggal_tindaklanjut;
              if (tgl_tl !== "0000-00-00 00:00:00") {
                tanggal_tindaklanjut = data[i].tanggal_tindaklanjut;
              } else {
                tanggal_tindaklanjut = '';
              }

              // Membuka tab baru dan mencetak
              var printWindow = window.open('', '_blank');
              printWindow.document.write('<html><head><title>Cetak Aduan</title></head><body>');

              // Wrapping div with border
              printWindow.document.write('<div style="border: 1px solid black;">');
              printWindow.document.write('<h3 align="center">Data Aduan</h3>');
              printWindow.document.write('<hr style="border: 1px solid black;">');

              // Tabel Detail Aduan
              printWindow.document.write('<table border="0" cellspacing="3" cellpadding="2">');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>No. Tiket</strong></td valign="top"><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top">' + nomor_tiket + '</td><td valign="top">&nbsp;&nbsp;&nbsp;</td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Tgl. Aduan</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].tanggal_laporan + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Kepada</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].ditujukan_kepada + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Judul</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].judul_laporan + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Kategori</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].kategori_nama + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Subkategori</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].subkategori_nama + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Topik</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].topik_laporan + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Isi</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top" align="justify">' + data[i].isi_laporan + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Lokasi</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].lokasi + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Foto</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top" align="justify">' + gbr1 + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Pelapor</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].nama + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>NIK</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].nik + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Nomor HP</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].hp + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Email</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].email + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Disposisi</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + data[i].keterangan_status + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Status</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + laporan_status + '</td><td></td></tr>');
              printWindow.document.write('</table>');
              // End of Tabel Detail Aduan

              // Tabel Tindak Lanjut Aduan
              printWindow.document.write('<table border="0" cellspacing="3" cellpadding="2">');
              printWindow.document.write('<hr style="border: 1px solid black;">');
              printWindow.document.write('<h3 align="center">Tindak Lanjut Aduan</h3>');
              printWindow.document.write('<hr style="border: 1px solid black;">');

              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Tindaklanjut</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top" align="justify">' + data[i].tindaklanjut + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Tgl. TL</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td>' + tanggal_tindaklanjut + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Keterangan</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top" align="justify">' + data[i].keterangan_tindaklanjut + '</td><td></td></tr>');
              printWindow.document.write('<tr><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"><strong>Foto TL</strong></td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top"> : </td><td>&nbsp;&nbsp;&nbsp;</td><td valign="top" align="justify">' + gbr2 + '</td><td></td></tr>');
              printWindow.document.write('</table>');
              // End of Tabel Tindak Lanjut Aduan

              printWindow.document.write('</div>');

              printWindow.document.write('</body></html>');
              printWindow.document.close();
              printWindow.print();

            });
          }
        });
        return false;
      });

      //KIRIM NOTIFIKASI KE PELAPOR
      $('#tbl_laporan').on('click', '.item_notif_pengadu', function() {
        var id = $(this).attr('data');

        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {

              $('#ModalNotifpengadu').modal('show');
              $('[name="x_kode_notifwapengadu"]').val(data[i].id);
              $('[name="x_nama_notifwapengadu"]').val(data[i].nama);
              $('[name="x_nohp_notifwapengadu"]').val(data[i].hp);

            });
          }
        });
        return false;
      });

      // Lihat Detail Aduan
      $('#tbl_laporan').on('click', '.item_detail', function() {
        var id = $(this).attr('data');
        // window.location.href = "< ?php echo base_url('home/detail/'); ?>"

        // var Url = "< ?php echo base_url('home/detail/')?>";
        // Url.select();
        // document.execCommand("copy");
        // alert("Text berhasil dicopy");

      });


      //TAYANG
      $('#tbl_laporan').on('click', '.item_tayang1', function() {
        var id = $(this).attr('data');
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/laporan/update_tayang') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: window.location.href = "<?php echo base_url('admin/laporan'); ?>"
          //  alert("data berhasil diupdate");
        });

        return false;
      });


      //GET UPDATE
      $('#tbl_laporan').on('click', '.item_hapus', function() {
        var id = $(this).attr('data');
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              $('#ModalHapus').modal('show');
              $('[name="x_judul_laporan_hapus"]').html('');
              $('[name="x_nama_hapus"]').html('');
              $('[name="x_kode_hapus"]').val(data[i].id);
              // $('[name="x_judul_laporan_hapus"]').html(data[i].judul_laporan);
              $('[name="x_nama_hapus"]').html(data[i].nama);
              $('[name="x_isi_laporan_hapus"]').val(data[i].isi_laporan);
              $('[name="x_foto_hapus"]').val(data[i].foto);

            });
          }
        });
        return false;
      });


    });
  </script>

  <script>
    function number_format(number, decimals, decPoint, thousandsSep) {
      number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
      var n = !isFinite(+number) ? 0 : +number
      var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
      var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
      var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
      var s = ''

      var toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
          .toFixed(prec)
      }

      // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
      }

      return s.join(dec)
    }
  </script>

  <script>
    $(document).ready(function() {
      $('#form_teruskan1').submit(function(e) { //matikan

        e.preventDefault();
        $.ajax({
          url: '<?php echo base_url(); ?>admin/laporan/update_teruskan',
          type: "post",
          data: new FormData(this),
          processData: false,
          contentType: false,
          cache: false,
          async: false,
          success: function(data) {
            alert("data berhasil diteruskan");
            $('#ModalTeruskan').modal('hide');
            window.location.href = "<?php echo base_url('admin/laporan'); ?>"
            // tampil_data();
          }
        });
      });
    });
  </script>

  <!-- < ?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-< ?= $this->session->flashdata('message_type'); ?>">
            < ?= $this->session->flashdata('message'); ?>
        </div>
      < ?php endif; ?> -->

  <!-- <script>
        setTimeout(function() {
          $('.alert').fadeOut('slow');
        }, 3000); // hilangkan notifikasi flash data setelah 3 detik
      </script> -->

  <?php if ($this->session->flashdata('msg') == 'error') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Error',
        text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
        showHideTransition: 'slide',
        icon: 'error',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#FF4859'
      });
    </script>

  <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Sukses',
        text: "Data Berhasil disimpan ke database.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
      });
    </script>
  <?php elseif ($this->session->flashdata('msg') == 'info') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Data berhasil di update",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php elseif ($this->session->flashdata('message') == 'email gagal') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Pesan Notifikasi Gagal Dikirim! Cek Email & WhatsApp.",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php elseif ($this->session->flashdata('message') == 'email') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Laporan Berhasil diteruskan! Notifikasi Telah Dikirim ke Admin OPD.",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php elseif ($this->session->flashdata('message') == 'email2') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Notifikasi Tracking Telah Dikirim ke Pelapor!",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php elseif ($this->session->flashdata('msg') == 'success-hapus') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Sukses',
        text: "Data Berhasil dihapus.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
      });
    </script>
  <?php else : ?>
  <?php endif; ?>
</body>

</html>