<!--Counter Inbox-->
<?php
$query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan=$query->num_rows();
$query1=$this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
$jum_komentar=$query1->num_rows();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lapor Bupati </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.css'?>">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datepicker/datepicker3.css'?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/all.css'?>">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/colorpicker/bootstrap-colorpicker.min.css'?>">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css'?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/select2/select2.min.css'?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
    
  </head>
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
      <?php
      $this->load->view('user/v_header');
      ?>
      
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu Utama</li>
            <li>
              <a href="<?php echo base_url().'user/dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>
            
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-commenting"></i>
                <span>Aduan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'user/laporan/add_laporan'?>"><i class="fa fa-thumb-tack"></i> Add New</a></li>
                <li><a href="<?php echo base_url().'user/laporan/byid'?>"><i class="fa fa-list"></i>Aduan Saya</a></li>
                <li><a href="<?php echo base_url().'user/laporan'?>"><i class="fa fa-wrench"></i> Semua Aduan</a></li>
              </ul>
            </li>

           <li class="treeview active">
              <a href="#">
                <i class="fa fa-commenting"></i>
                <span>Aduan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'user/aduan/add_aduan'?>"><i class="fa fa-thumb-tack"></i>Tambah Baru</a></li>
                <li><a href="<?php echo base_url().'user/aduan/byid'?>"><i class="fa fa-list"></i>Aduan Saya</a></li>
              </ul>
            </li>
            
            <li>
              <a href="<?php echo base_url().'user/inbox'?>">
                <i class="fa fa-envelope"></i> <span>Inbox</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green"><?php echo $jum_pesan;?></small>
                </span>
              </a>
            </li>
            
            
            <li>
              <a href="<?php echo base_url().'login/logout'?>">
                <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>
            
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Usulan / Aduan
          
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Post</a></li>
            <li class="active">Add New</li>
          </ol>
        </section>
        <!---------------------------------------->
        <!-- Main content -->
        <section class="content">
          <!-- SELECT2 EXAMPLE -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Input Data</h3>
            </div>
            <?php
            $b=$data->row_array();
            ?>
            <form action="<?php echo base_url().'user/laporan/byid'?>" method="post" enctype="multipart/form-data">
              
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <label>Usulan melalui </label>
                    <input type="hidden" name="kode" value="<?php echo $b['id'];?>">
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">


                      <select class="form-control select2" name="idkepada" disabled style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <?php
                        $no=0;
                        foreach ($kpd->result_array() as $i) :
                        $no++;
                        $id=$i['id'];
                        $nama=$i['nama'];
                        $fraksi=$i['fraksi'];?>

                        <?php if($b['id_kepada']==$id):?>
                          <option value="<?php echo $id;?>" selected><?php echo $nama." (".$fraksi.")";?></option>
                        <?php else:?>
                          <option value="<?php echo $id;?>"><?php echo $nama." (".$fraksi.")";?></option>
                        <?php endif;?>
                        <?php endforeach;?>
                      </select>
                    </div>
                    
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <label>Judul Usulan / Aduan </label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="xjudullaporan" disabled value="<?php echo $b['judul_laporan'];?>" class="form-control" placeholder="Judul Usulan / Aduan" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <label>Kategori </label>
                  </div>




                  <div class="col-md-6">
                    <div class="form-group">
                      
                      <select class="form-control select2" name="xkategorilaporan" disabled style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <?php
                        $no=0;
                        foreach ($kat->result_array() as $i) :
                        $no++;
                        $kategori_id=$i['kategori_id'];
                        $kategori_nama=$i['kategori_nama'];?>

                       <?php if($b['kategori_laporan']==$kategori_id):?>
                        <option value="<?php echo $kategori_id;?>" selected><?php echo $kategori_nama;?></option>
                        <?php else:?>
                          <option value="<?php echo $kategori_id;?>" ><?php echo $kategori_nama;?></option>
                        <?php endif;?>
                        <?php endforeach;?>

                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <label>Rincian Usulan / Aduan </label>
                  </div>
                  <div class="col-md-6">
                    <textarea id="ckeditor" name="xisilaporan" disabled ><?php echo $b['isi_laporan'];?> </textarea>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <label>Lokasi </label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="xlokasi" disabled value="<?php echo $b['lokasi'];?>" class="form-control" placeholder="lokasi" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <label>Anggaran</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="xanggaran" disabled value ="<?php echo $b['anggaran'];?>" class="form-control" placeholder="anggaran" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Gambar / Foto</label>
                  <input type="file" name="filefoto" disabled style="width: 100%;">
                </div>
              </div>
              
              <div class="box-body">
                <div class="col-md-8">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-flat pull-right"><span class="fa fa-reply"></span> Kembali</button>
                  </div>
                </div>
              </div>
              
              
            </form>
            
          </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>@LaporBupati</strong>
  </footer>
  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url().'assets/plugins/select2/select2.full.min.js'?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.date.extensions.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.extensions.js'?>"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.js'?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js'?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url().'assets/plugins/colorpicker/bootstrap-colorpicker.min.js'?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js'?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script src="<?php echo base_url().'assets/ckeditor/ckeditor.js'?>"></script>
<!-- Page script -->
<script>
$(function () {
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace('ckeditor');
});
</script>
<script>
$(function () {
//Initialize Select2 Elements
$(".select2").select2();
//Datemask dd/mm/yyyy
$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
//Datemask2 mm/dd/yyyy
$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
//Money Euro
$("[data-mask]").inputmask();
//Date range picker
$('#reservation').daterangepicker();
//Date range picker with time picker
$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
//Date range as a button
$('#daterange-btn').daterangepicker(
{
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
},
startDate: moment().subtract(29, 'days'),
endDate: moment()
},
function (start, end) {
$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}
);
//Date picker
$('#datepicker').datepicker({
autoclose: true
});
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass: 'iradio_minimal-blue'
});
//Red color scheme for iCheck
$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
checkboxClass: 'icheckbox_minimal-red',
radioClass: 'iradio_minimal-red'
});
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
checkboxClass: 'icheckbox_flat-green',
radioClass: 'iradio_flat-green'
});
//Colorpicker
$(".my-colorpicker1").colorpicker();
//color picker with addon
$(".my-colorpicker2").colorpicker();
//Timepicker
$(".timepicker").timepicker({
showInputs: false
});
});
</script>
</body>
</html>