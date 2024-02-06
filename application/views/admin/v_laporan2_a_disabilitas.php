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
          Data Aduan Disabilitas
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Aduan</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <div class="box">
                <div class="box-header">
                  <a class="btn btn-success btn-circle" data-toggle="tooltip" title="Integrasikan ke Database Aduan Utama !" href="<?php echo base_url() . 'admin/laporan/add_laporan' ?>"><span class="fa fa-plus"></span>&nbsp; Input</a>
                  <!-- <a class="btn btn-danger btn-flat" href="< ?php echo base_url().'admin/laporan/add_tambahan'?>"><span class="fa fa-plus"></span> Tambahan</a> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="tbl_laporan_disabilitas" class="table table-striped" style="font-size:13px;">
                    <thead>
                      <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Rekaman Aduan</th>
                        <th style="text-align:center;">Datetime Aduan</th>
                        <th style="text-align:center;">Status</th>
                        <th style="text-align:center;">Keterangan</th>
                        <th style="text-align:center;">Datetime Status</th>
                        <th style="text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tbl_laporan_disabilitas">

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

  <!-- view Laporan -->
  <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Rincian View</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_view' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="xkode_view" id="xkode_view">
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Aduan</label>
              <div class="col-sm-7">
                <input type="text" name="x_aduan_view" id="x_aduan_view" class="form-control pull-right" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Tanggal Aduan</label>
              <div class="col-sm-7">
                <input type="text" name="x_tanggal_aduan_view" class="form-control" id="x_tanggal_aduan_view" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Status</label>
              <div class="col-sm-7">
                <select class="form-control select2" name="x_status_view" style="width: 100%;" required="required" disabled>
                  <option value="">-Pilih-</option>
                  <option value="1">Belum</option>
                  <option value="2">Proses</option>
                  <option value="3">Selesai</option>
                  <option value="99">Ditolak</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
              <div class="col-sm-7">
                <textarea class="form-control" rows="3" name="x_keterangan_view" id="x_keterangan_view" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Tanggal Status</label>
              <div class="col-sm-7">
                <input type="text" name="x_tanggal_status_view" class="form-control" id="x_tanggal_status_view" disabled required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- akhir modal view Laporan -->

  <!-- modal Edit Laporan -->
  <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Update Aduan</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_laporan_disabilitas' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <input type="hidden" name="xkode_edit" id="xkode_edit">
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Aduan</label>
              <div class="col-sm-7">
                <input type="text" name="x_aduan_edit" id="x_aduan_edit" class="form-control pull-right" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Tanggal Aduan</label>
              <div class="col-sm-7">
                <input type="text" name="x_tanggal_aduan_edit" class="form-control" id="x_tanggal_aduan_edit" disabled required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Status</label>
              <div class="col-sm-7">
                <select class="form-control select2" name="x_status_edit" style="width: 100%;" required="required">
                  <option value="">-Pilih-</option>
                  <option value="1">Belum</option>
                  <option value="2">Proses</option>
                  <option value="3">Selesai</option>
                  <option value="99">Ditolak</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
              <div class="col-sm-7">
                <textarea class="form-control" rows="3" name="x_keterangan_edit" id="x_keterangan_edit"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Tanggal Status</label>
              <div class="col-sm-7">
                <input type="text" name="x_tanggal_status_edit" class="form-control" id="x_tanggal_status_edit" required readonly>
              </div>
            </div>

            <!-- <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_kategori_laporan_edit" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <option value="1">Fisik</option>
                        <option value="2">Non Fisik</option>        
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <input type="hidden" name="xkode_edit" id="xkode_edit">
                  <label for="inputUserName" class="col-sm-4 control-label">OPD tujuan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="x_id_kepada_edit"  id = "x_id_kepada_edit" required>
                    <input type="text" name="x_ditujukan_kepada_edit" disabled class="form-control"  id = "x_ditujukan_kepada_edit" placeholder="Kepada " required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_judul_laporan_edit"  class="form-control" id="x_judul_laporan_edit" placeholder="Judul Aduan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isi_laporan_edit" id="x_isi_laporan_edit" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_lokasi_edit"  id="x_lokasi_edit" class="form-control pull-right datepicker4" required>
                  </div>
                </div>
 
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">tanggal</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_tanggal_laporan_edit"  id="x_tanggal_laporan_edit" class="form-control pull-right datepicker4" required>
                  </div>
                </div>
                          
                <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Upload/ubah Foto Aduan</label>
                    <div class="col-sm-7">
                    <input type="file" name="x_foto_edit" >
                    <input type="hidden" name="x_foto" >
                    </div>
                </div> -->


            <!-- /.form group -->
            <!-- Date range -->

            <!-- <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_nama_edit" id="x_nama_edit" class="form-control pull-right datepicker4" >
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_nik_edit" id="x_nik_edit" class="form-control pull-right datepicker4" >
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sumber Medsos/ HP </label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_hp_edit" id="x_hp_edit" class="form-control pull-right datepicker4" >
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_laporan_status_edit" style="width: 100%;" >
                        <option value="">-Pilih-</option>
                        <option value="1">verifikasi</option>
                        <option value="2">Sedang Proses</option>
                        <option value="3">Selesai</option>
                        <option value="99">Ditolak</option>           
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_status_edit" class="form-control" id="x_keterangan_status_edit" placeholder="Keterangan" >
                  </div>
                </div>
     
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label"> Tindak Lanjut</label>
                  <div class="col-sm-7">
                
                    <textarea name="x_tindaklanjut_edit" class="form-control" id="x_tindaklanjut_edit" rows="3"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label"> Keterangan TL</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_tindaklanjut_edit" class="form-control" id="x_keterangan_tindaklanjut_edit" placeholder="..." >
                  </div>
                </div>


                <div class="form-group">
                    <label for="inputUserName" class="col-sm-4 control-label">Upload/Ubah Foto TL</label>
                    <div class="col-sm-7">
                    <input type="file" name="x_foto_tindaklanjut_edit" >
                    <input type="hidden" name="x_foto_tindaklanjut"  >
                    </div>
                </div> -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Akhir modal edit Laporan -->

  <!--Modal Hapus Laporan -->
  <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Hapus Aduan</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/hapus_laporan_disabilitas' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="xkode_hapus" id="xkode_hapus" />
            <input type="hidden" name="x_nama_file_hapus" id="x_nama_file_hapus" />
            <p>Apakah Anda yakin mau menghapus Aduan ini?</p>
            <!-- <p>Apakah Anda yakin mau menghapus Aduan tentang <b name="x_keterangan_hapus"></b>?</p> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger btn-flat" id="simpan">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Modal Hapus Laporan -->

  <!-- Modal Teruskan -->
  <div class="modal fade" id="ModalTeruskan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Teruskan Aduan</h4>
        </div>
        <form id="form_teruskan" class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_teruskan' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="x_kode_teruskan" id="x_kode_teruskan">
              <label for="inputUserName" class="col-sm-4 control-label">Teruskan Kepada</label>
              <div class="col-sm-7">
                <select class="form-control select2" name="x_id_kepada_teruskan" id="x_id_kepada_teruskan" style="width: 100%;" required>
                  <option value="">-Pilih-</option>
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
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
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
          url: '<?php echo base_url() ?>admin/laporan/get_semua_disabilitas',
          async: true,
          dataType: 'json',
          success: function(data) {
            var base_urlx = "<?php echo base_url('assets/audio/') ?>";
            var html = '';
            var i;
            var no = 0;
            for (i = 0; i < data.length; i++) {

              var no = no + 1;

              /* var jenis = data[i].id_jenis;
              if (jenis = 1) {
                 id_jenis ="Aduan";                     
              } */

              /* var pemberitahuan = data[i].kirim_pemberitahuan;
              if (pemberitahuan =='ya'){
                pemberitahuan_kirim = '';
              }else{
                pemberitahuan_kirim = '<a href="javascript:;" class="btn btn-primary btn-xs item_kirim_pemberitahuan" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-envelope"> kirim email</span></a>';
              } */

              var laporan = data[i].status;
              if (laporan == 1) {
                status = '<a href="#" class="btn btn-danger btn-xs" style="width:60px;" data-toggle="tooltip" title="Aduan belum diverifikasi oleh Admin">Verifikasi</a>';
              } else if (laporan == 2) {
                status = '<a href="#" class="btn btn-warning btn-xs" style="width:60px;" data-toggle="tooltip" title="Aduan telah diteruskan & dalam proses tindak lanjut oleh OPD terkait">Proses</a>';
              } else if (laporan == 3) {
                status = '<a href="#" class="btn btn-success btn-xs" style="width:60px;" data-toggle="tooltip" title="Aduan telah selesai ditindaklanjuti">Selesai</a>';
              } else {
                status = '<a href="#" class="btn btn-info btn-xs" style="width:60px;" data-toggle="tooltip" title="Aduan ditolak karena alasan yang sah">Ditolak</a>';
              }

              /* var fileName = data[i].foto;
              var fileExtension = fileName.split('.').pop(); 
              if (fileExtension == "pdf") {
                // tampilimagefoto = '<a href="'+ base_urlx + data[i].foto +'" style="width:90px;">view Pdf</a>';
                tampilimagefoto = '<embed src="'+ base_urlx + data[i].foto +'" width="90px" height="90px" /> <center><a href="'+ base_urlx + data[i].foto +'" style="width:90px;">view Pdf</a></center>';
                
                // tampilimagefoto = '<embed type="application/pdf" src="'+ base_urlx + data[i].foto +'" style="width:90px;">view</embed>';
                // <embed type="application/pdf" src="contoh.pdf" width="600" height="400"></embed>
              }else{
                tampilimagefoto = '<img src="'+ base_urlx + data[i].foto +'" style="width:90px;">';
              } */

              html += '<tr>' +
                '<td>' + no + '</td>' +
                '<td><a href="' + base_urlx + data[i].nama_file + '" target="_blank" data-toggle="tooltip" title="Klik untuk mendengarkan Rekaman Aduan!">' + data[i].nama_file + '</a></td>' +
                //'<td>'+tampilimagefoto+'</td>'+
                //'<td>'+data[i].ditujukan_kepada+'</td>'+
                //'<td>'+data[i].nama_file+'</td>'+
                '<td>' + data[i].created_at + '</td>' +
                '<td>' + status + '</td>' +
                '<td>' + data[i].keterangan + '</td>' +
                '<td>' + data[i].modified_at + '</td>' +
                //'<td>'+laporan_status+'</td>'+
                // pemberitahuan_kirim+'</td>'+
                //'<td>'+'<a href="javascript:;" class="btn btn-info btn-xs item_tayang" data="'+data[i].id+'">'+data[i].tayang+'</a>'+'</td>'+
                '<td style="text-align:center;">' +
                /* '<a href="javascript:;" data-toggle="tooltip" title="Rincian Aduan" class="btn btn-success btn-xs item_view" data="'+data[i].id+'" style="width:60px;"><span class="fa fa-eye"> view</span></a>'+'&nbsp;&nbsp;'+ */
                '<a href="javascript:;" data-toggle="tooltip" title="Edit Aduan" class="btn btn-warning btn-xs item_edit" data="' + data[i].id + '" style="width:25px;"><span class="fa fa-pencil"></span></a>' + '&nbsp;&nbsp;' +
                '<a href="javascript:;" data-toggle="tooltip" title="Hapus Aduan" class="btn btn-danger btn-xs item_hapus" data="' + data[i].id + '" style="width:25px;"><span class="fa fa-close"></span></a>' +
                /* '<a href="javascript:;" data-toggle="tooltip" title="Teruskan Aduan" class="btn btn-info btn-xs item_teruskan" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-arrow-right"> teruskan</span></a>'+
                '<a href="< ?php echo base_url('home/detail/');?>'+data[i].id+'" data-toggle="tooltip" title="Copylink" class="btn btn-primary btn-xs item_detail" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-copy"> progres</span></a>'+
                pemberitahuan_kirim+ */
                '</td>' +
                '</tr>';
            }
            $('#tbody_tbl_laporan_disabilitas').html(html);
            // tambahan
            $('#tbl_laporan_disabilitas').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": true,
              "scrollX": true
            });
            // tutuptambahan
          }
        });
      }

      // Modal View
      $('#tbl_laporan_disabilitas').on('click', '.item_view', function() {
        var id = $(this).attr('data');
        //var gbr1='';
        //var gbr2='';
        //var base_urlx="< ?php echo base_url('assets/images/')?>";

        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modalview_disabilitas') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              /* var laporan = data[i].status;
              if (laporan == 1) {
                status ="Belum";
              }
              else if(laporan == 2){
                status ="Proses";
              }
              else if(laporan == 3){
                status ="Selesai";
              }
              else{
                status ="Ditolak";
              } */

              $('#ModalView').modal('show');
              $('[name="xkode_view"]').val(data[i].id);
              //$('[name="x_ditujukan_kepada_view"]').val(data[i].ditujukan_kepada);
              $('[name="x_aduan_view"]').val(data[i].nama_file);
              //$('[name="x_kategori_laporan_view"]').val(data[i].kategori_laporan);
              //$('[name="x_isi_laporan_view"]').val(data[i].isi_laporan);
              //$('[name="x_nik_view"]').val(data[i].nik);
              //$('[name="x_nama_view"]').val(data[i].nama);
              //$('[name="x_hp_view"]').val(data[i].hp);
              //$('[name="x_lokasi_view"]').val(data[i].lokasi);
              //$('[name="x_email_view"]').val(data[i].email);
              //$('[name="x_tindaklanjut_view"]').val(data[i].tindaklanjut);
              //$('[name="x_keterangan_tindaklanjut_view"]').val(data[i].keterangan_tindaklanjut);
              $('[name="x_tanggal_aduan_view"]').val(data[i].created_at);
              $('[name="x_status_view"]').val(data[i].status);
              $('[name="x_keterangan_view"]').val(data[i].keterangan);
              $('[name="x_tanggal_status_view"]').val(data[i].modified_at);
              //$('[name="foto_view"]').html('');
              //$('[name="foto_tindaklanjut_view"]').html('');

              /* var fileNameFotoView = data[i].foto;
              var fileExtension = fileNameFotoView.split('.').pop(); 
                if (fileExtension == "pdf") {
                  
                   
                  gbr1 += '<embed src="'+ base_urlx + data[i].foto +'" width="90px" height="90px" alt="no img"/>';
                      $('#foto_view').append(gbr1);

                }else{
                  gbr1 += '<img src="'+ base_urlx + data[i].foto +'" style="height:250px;width:350px;" alt="no img">';
                    $('#foto_view').append(gbr1);
                }


              var fileNameFotoTL = data[i].foto_tindaklanjut;
              var fileExtension = fileNameFotoTL.split('.').pop(); 
                if (fileExtension == "pdf") {    
                   
                  gbr2 += '<embed src="'+ base_urlx + data[i].foto_tindaklanjut +'" width="90px" height="90px" alt="no img"/>';
                      $('#foto_tindaklanjut_view').append(gbr2);

                }else{
                  gbr2 += '<img src="'+ base_urlx + data[i].foto_tindaklanjut +'" style="height:250px;width:350px;" alt="no img">';
                    $('#foto_tindaklanjut_view').append(gbr2);
                } */

            });
          }
        });
        return false;
      });


      //GET UPDATE
      $('#tbl_laporan_disabilitas').on('click', '.item_edit', function() {
        var id = $(this).attr('data');
        //var base_urlx="< ?php echo base_url('assets/images/')?>";
        //var gbr2='';
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modaledit_disabilitas') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              $('#ModalEdit').modal('show');
              $('[name="xkode_edit"]').val(data[i].id);
              //$('[name="x_id_kepada_edit"]').val(data[i].id_kepada);
              //$('[name="x_ditujukan_kepada_edit"]').val(data[i].ditujukan_kepada);
              $('[name="x_aduan_edit"]').val(data[i].nama_file);
              //$('[name="x_judul_laporan_edit"]').val(data[i].judul_laporan);
              //$('[name="x_kategori_laporan_edit"]').val(data[i].kategori_laporan);
              //$('[name="x_isi_laporan_edit"]').val(data[i].isi_laporan);
              //$('[name="x_nik_edit"]').val(data[i].nik);
              //$('[name="x_nama_edit"]').val(data[i].nama);
              //$('[name="x_hp_edit"]').val(data[i].hp);
              //$('[name="x_alamat_edit"]').val(data[i].alamat);
              //$('[name="x_lokasi_edit"]').val(data[i].lokasi);
              //$('[name="x_email_edit"]').val(data[i].email);
              //$('[name="x_tindaklanjut_edit"]').val(data[i].tindaklanjut);
              //$('[name="x_keterangan_tindaklanjut_edit"]').val(data[i].keterangan_tindaklanjut);
              $('[name="x_tanggal_aduan_edit"]').val(data[i].created_at);
              $('[name="x_status_edit"]').val(data[i].status);
              $('[name="x_keterangan_edit"]').val(data[i].keterangan);
              $('[name="x_tanggal_status_edit"]').val(data[i].modified_at);
              //$('[name="x_tanggal_laporan_edit"]').val(data[i].tanggal_laporan);
              //$('[name="x_laporan_status_edit"]').val(data[i].laporan_status);
              //$('[name="x_keterangan_status_edit"]').val(data[i].keterangan_status);
              //$('[name="x_foto_tindaklanjut"]').val(data[i].foto_tindaklanjut);
              //$('[name="x_foto"]').val(data[i].foto);

              /* gbr2 += '<img src="'+ base_urlx + data[i].foto +'" style="height:190px;" alt="no img">';
              $('[name="foto_view"]').append(gbr2);
              $('[name="foto_view"]').refresh; */

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



      $('#tbl_laporan').on('click', '.item_detail', function() {
        var id = $(this).attr('data');
        window.location.href = "<?php echo base_url('home/detail/'); ?>"

        // var Url = "<?php echo base_url('home/detail/') ?>";
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


      //Modal Hapus Laporan Disabilitas
      $('#tbl_laporan_disabilitas').on('click', '.item_hapus', function() {
        var id = $(this).attr('data');
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/laporan/get_modalhapus_disabilitas') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {
              $('#ModalHapus').modal('show');
              $('[name="xkode_hapus"]').val(data[i].id);
              $('[name="x_keterangan_hapus"]').val(data[i].keterangan);
              $('[name="x_nama_file_hapus"]').val(data[i].nama_file);
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
        position: 'top-right',
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
        position: 'top-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php elseif ($this->session->flashdata('message') == 'email gagal') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Email Notifikasi Gagal Dikirim",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'top-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php elseif ($this->session->flashdata('message') == 'email') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Laporan Berhasil diterukan dan notifikasi email terkirim",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'top-right',
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
        position: 'top-right',
        bgColor: '#7EC857'
      });
    </script>
  <?php else : ?>
  <?php endif; ?>
</body>

</html>