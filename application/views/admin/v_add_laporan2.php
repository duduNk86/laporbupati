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
    <title><?= $title;?></title>
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
  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
    <?php
          $this->load->view('admin/v_header');
          $level=$this->session->userdata('pengguna_level');
      ?>
      <?php if($level==='1'):?>
        <?php $this->load->view('admin/v_sidebar2');?>
      <?php endif;?>
      
      <?php if($level==='2'):?>
        <?php $this->load->view('admin/v_sidebar2_opd');?>
      <?php endif;?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Input Aduan/Laporan
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'admin/dashboard'?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().'admin/laporan'?>"> Aduan</a></li>
            <li class="active">Input Aduan</li>
          </ol>
        </section>
        <!---------------------------------------->
        <!-- Main content -->
        <section class="content">

          <!-- SELECT2 EXAMPLE============================================ -->
          <div class="box box-primary" style="width: 80%;">
            <div class="box-header with-border">
              <p style="text-align:center; font-size:17pt; color:red;"><b>Materi Aduan</b></p>
            </div>
            
            <form action="<?php echo base_url().'admin/laporan/simpan_laporan'?>" method="post" enctype="multipart/form-data">
              
              <!-- /.box-header -->
              <div class="box-body">
              <div class="box-body" style="margin-top: 5pt;">
                <div class="row">
                  <div class="col-md-3">
                    <label>Kategori</label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <select class="form-control select2" name="x_kategorilaporan" id="x_kategorilaporan" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        <?php
                          $no=0;
                          foreach ($kat->result_array() as $i) :
                          $no++;
                          $kategori_id=$i['kategori_id'];
                          $kategori_nama=$i['kategori_nama'];
                        ?>
                        <option value="<?php echo $kategori_id;?>"><?php echo $kategori_nama;?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Sub Kategori</label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <select class="form-control select2" name="x_subkategorilaporan" id="x_subkategorilaporan" style="width: 100%;" required/>
                        <option value="">- Pilih -</option>
                        <?php
                          $no=0;
                          foreach ($subkat->result_array() as $i) :
                          $no++;
                          $subkategori_id=$i['subkategori_id'];
                          $subkategori_nama=$i['subkategori_nama'];
                        ?>
                        <option value="<?php echo $subkategori_id;?>"><?php echo $subkategori_nama;?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Topik</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_topiklaporan" class="form-control" placeholder="Topik Aduan (Ex : #Bansos #JalanRusak #PungutanLiar)" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Judul Aduan</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_judullaporan" class="form-control" placeholder="Judul Aduan / Laporan" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Rincian Aduan</label>
                  </div>
                  <div class="col-md-9">
                  <textarea class="form-control" rows="5" name="x_isilaporan" placeholder="Isi Aduan / Laporan" required></textarea>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Lokasi</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_lokasi" class="form-control" placeholder="Lokasi Kejadian" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Diteruskan Kepada</label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <select class="form-control select2" name="idkepada" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        <?php
                        $no=0;
                        foreach ($kpd->result_array() as $i) :
                        $no++;
                        $id_opd=$i['id_opd'];
                        $opd_singkat=$i['opd_singkat'];
                        ?>
                        <option value="<?php echo $id_opd;?>"><?php echo $opd_singkat;?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Gambar / Foto</label>
                  </div>
                  <div class="col-md-9">
                    <input type="file" name="filefoto" style="width: 100%;" >
                  </div>
                </div>
              </div>
              
              <hr>
              <div class="box-header with-border">
                <p style="text-align:center; font-size:17pt; color:blue; margin-top:-12px;"><b>Identitas Pelapor</b></p>
              </div>
              <div class="box-body" style="margin-top:16px;">
                <div class="row">
                  <div class="col-md-3">
                    <label>Nama Pelapor</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_nama" class="form-control" placeholder="Nama Pelapor" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>NIK</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_nik" class="form-control" placeholder="NIK" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Alamat Pelapor</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_alamat" class="form-control" placeholder="Alamat Pelapor" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Email Pelapor</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_email" class="form-control" placeholder="Email Pelapor" required/>
                    <!-- <input type="email" name="x_email" class="form-control" placeholder="Email Pelapor" required/> -->
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>HP Pelapor</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="x_hp" class="form-control" placeholder="Instagram / HP Pelapor" required/>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Sumber Aduan</label>
                  </div>
                  <div class="col-md-9">
                    <!-- <input type="text" name="x_sumberaduan" class="form-control" placeholder="Pilih Sumber Aduan Masuk" required/> -->
                    <select class="form-control select2" name="x_sumberaduan" required>
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
              </div>
              <hr>
              <div class="box-body">
                <div class="col-md-12">
                  <div class="btn-group pull-right" style="margin-bottom:25px;">
                    <button type="reset" class="btn btn-danger btn-circle"><span class="fa fa-refresh"></span> Reset</button>
                    <button type="submit" class="btn btn-primary btn-circle"><span class="fa fa-floppy-o"></span> Simpan</button>
                  </div>
                </div>
              </div>
              </div>
            </form>
              
              <!-- /.box -->
            </div>
            <!-- /.col (right) -->
          </div>
          <!-- ///////////////////////////////////////////////////////////////////////////////////////////.row -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>@laporbupati</strong>
      </footer>
      
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 2.2.3 -->
    <!-- <script src="< ?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script> -->
    <!-- jQuery 3.3.1 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-3.3.1.js'?>"></script>
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

    <script type="text/javascript">
      $(document).ready(function(){
        $('#x_kategorilaporan').change(function(){ 
          // alert ('abc');
          var id=$(this).val();
          $.ajax({
            url : "<?php echo site_url('admin/laporan/get_subkategori');?>",
            method : "GET",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
              var html = '';
              var i;
              for(i=0; i<data.length; i++){
                  html += '<option value='+data[i].subkategori_id+'>'+data[i].subkategori_nama+'</option>';
              }
              $('#x_subkategorilaporan').html(html);
            }
          });
          return false;
        }); 
      });
    </script>

  </body>
</html>