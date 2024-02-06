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
    $pengguna_id = $this->session->userdata('pengguna_id');
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
          Data Admin
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('admin/useradmin'); ?>">Data Admin</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="tbl_user" class="table table-striped" style="font-size:13px;">
                    <thead>
                      <tr>
                        <th style="text-align:center;">Photo</th>
                        <th style="text-align:center;">Nama Admin</th>
                        <th style="text-align:center;">Username</th>
                        <th style="text-align:center;">Email</th>
                        <th style="text-align:center;">WA Admin OPD</th>
                        <th style="text-align:center;">WA Pimpinan OPD</th>
                        <th style="text-align:center;">Level</th>
                        <th style="text-align:center;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tbl_user">

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


  <!-- modal Edit Laporan -->
  <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/useradmin/update_pengguna_opd' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
              <div class="col-sm-7">
                <input type="hidden" name="x_pengguna_id_edit" />
                <input type="text" name="x_pengguna_nama_edit" class="form-control" id="inputUserName" placeholder="Nama Lengkap" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Email Admin</label>
              <div class="col-sm-7">
                <input type="email" name="x_pengguna_email_edit" class="form-control" id="inputEmail3" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Email Instansi</label>
              <div class="col-sm-7">
                <input type="email" name="x_pengguna_email_kantor_edit" class="form-control" id="inputEmail3" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Whatsapp Admin OPD</label>
              <div class="col-sm-7">
                <input type="number" name="x_pengguna_nohp_edit" class="form-control" placeholder="Whatsapp Admin OPD" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Whatsapp Pimpinan OPD</label>
              <div class="col-sm-7">
                <input type="number" name="x_pengguna_nohp_pimpinan_edit" class="form-control" placeholder="Whatsapp Pimpinan OPD" required>
              </div>
            </div>

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Foto Profil</label>
              <div class="col-sm-7" id="tampil_pengguna_photo_edit" name="tampil_pengguna_photo_edit">
                <img src="">
              </div>
            </div>

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
              <div class="col-sm-7">
                <input type="hidden" name="x_pengguna_photo_now_edit">
                <input type="file" name="x_pengguna_photo_edit" />
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



  <!-- modal Reset Password -->
  <div class="modal fade" id="ModalReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/useradmin/update_pengguna_reset' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="x_pengguna_id_reset" />
              <label for="inputUserName" class="col-sm-4 control-label">Username</label>
              <div class="col-sm-7">
                <input type="text" name="x_pengguna_username_reset" class="form-control" id="inputUserName" placeholder="Username" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Password Baru</label>
              <div class="col-sm-7">
                <input type="password" name="x_pengguna_password_reset" class="form-control" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword4" class="col-sm-4 control-label">Ulangi Password</label>
              <div class="col-sm-7">
                <input type="password" name="x_pengguna_repassword_reset" class="form-control" placeholder="Ulangi Password" required>
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


  <script type="text/javascript">
    $(document).ready(function() {
      tampil_data();

      function tampil_data() {
        $.ajax({
          type: 'GET',
          url: '<?php echo base_url('admin/useradmin/get_opd/') . $pengguna_id ?>',
          async: true,
          dataType: 'json',
          success: function(data) {
            var base_urlx = "<?php echo base_url('assets/images/') ?>";
            var html = '';
            var i;
            var no = 0;
            for (i = 0; i < data.length; i++) {
              var no = no + 1;
              var pengguna_level = data[i].pengguna_level;
              if (pengguna_level == 1) {
                pengguna_level = '<span class="label label-success">Super Admin</span>';
              } else if (pengguna_level == 2) {
                pengguna_level = '<span class="label label-danger">Admin</span>';
              } else {
                pengguna_level = '<span class="label label-info"></span>';
              }

              var pengguna_nohp_pimpinan = data[i].pengguna_nohp_pimpinan;
              if (pengguna_nohp_pimpinan != null) {
                pengguna_nohp_pimpinan = data[i].pengguna_nohp_pimpinan;
              } else {
                pengguna_nohp_pimpinan = '';
              }

              html += '<tr>' +
                '<td><img src="' + base_urlx + data[i].pengguna_photo + '" style="width:90px;" alt="no img"></td>' +
                '<td>' + data[i].pengguna_nama + '</td>' +
                '<td>' + data[i].pengguna_username + '</td>' +
                '<td>' + data[i].pengguna_email + '</td>' +
                '<td>' + data[i].pengguna_nohp + '</td>' +
                '<td>' + pengguna_nohp_pimpinan + '</td>' +
                '<td>' + pengguna_level + '</td>' +
                '<td style="text-align:center;">' +
                '<a href="javascript:;" data-toggle="tooltip" title="edit data profil" class="btn btn-info btn-xs item_edit" data="' + data[i].pengguna_id + '"><span class="fa fa-pencil"></span></a>' + ' ' +
                '<a href="javascript:;" data-toggle="tooltip" title="reset password" class="btn btn-warning btn-xs item_reset" data="' + data[i].pengguna_id + '"><span class="fa fa-refresh"></span></a>' + ' ' +
                '</td>' +

                '</tr>';
            }
            $('#tbody_tbl_user').html(html);

            $('#tbl_user').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": true,
              "scrollX": true
            });
          }

        });
      }


      $('#tbl_user').on('click', '.item_edit', function() {
        var id = $(this).attr('data');
        var gbr1 = '';
        var gbr2 = '';
        var base_urlx = "<?php echo base_url('assets/images/') ?>";

        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/useradmin/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {

              $('#ModalEdit').modal('show');
              $('[name="x_pengguna_id"]').val(data[i].pengguna_id);
              $('[name="x_pengguna_id_edit"]').val(data[i].pengguna_id);
              $('[name="x_pengguna_nama_edit"]').val(data[i].pengguna_nama);
              $('[name="x_pengguna_email_edit"]').val(data[i].pengguna_email);
              $('[name="x_pengguna_email_kantor_edit"]').val(data[i].pengguna_email_kantor);
              $('[name="x_pengguna_username_edit"]').val(data[i].pengguna_username);
              $('[name="x_pengguna_photo_now_edit"]').val(data[i].pengguna_photo);
              $('[name="x_pengguna_level_edit"]').val(data[i].pengguna_level);
              $('[name="x_pengguna_nohp_edit"]').val(data[i].pengguna_nohp);
              $('[name="x_pengguna_nohp_pimpinan_edit"]').val(data[i].pengguna_nohp_pimpinan);
              $('[name="tampil_pengguna_photo_edit"]').html('');

              gbr1 += '<img src="' + base_urlx + data[i].pengguna_photo + '" style="height:250px;width:350px;" alt="no img">';
              $('#tampil_pengguna_photo_edit').append(gbr1);


            });
          }
        });
        return false;
      });


      $('#tbl_user').on('click', '.item_reset', function() {
        var id = $(this).attr('data');
        var gbr1 = '';
        var gbr2 = '';
        var base_urlx = "<?php echo base_url('assets/images/') ?>";

        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/useradmin/get_modaledit') ?>",
          dataType: "JSON",
          data: {
            id: id
          },
          success: function(data) {
            $.each(data, function(i, field) {

              $('#ModalReset').modal('show');
              $('[name="x_pengguna_id_reset"]').val(data[i].pengguna_id);
              $('[name="x_pengguna_id_reset"]').val(data[i].pengguna_id);
              $('[name="x_pengguna_username_reset"]').val(data[i].pengguna_username);

            });
          }
        });
        return false;
      });




      //TAYANG
      $('#tbl_user').on('click', '.item_tayang', function() {
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