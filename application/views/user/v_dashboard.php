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
    <title>Lapor Bupati</title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
    <!-- Ionicons -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
    <?php
    /* Mengambil query report*/

    /* end mengambil query*/
    
    ?>
  </head>
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
      <!--Header-->
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
            <li class="active">
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
                <li><a href="<?php echo base_url().'user/laporan/add_laporan'?>"><i class="fa fa-thumb-tack"></i> Tambah Baru</a></li>
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
          Dashboard Lapor Bupati (D3J)
          <small>D3J</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          
          <?php
          $kode=$this->session->userdata('id');
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where id_pelapor='$kode'");        
          $jml_laporan=$hsl->num_rows();
          ?>
          <!----row----->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <center>
                  <h3><?php echo $jml_laporan;?></h3>
                  <p><h2>Masukan</h2></p>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url().'user/laporan/byid'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

          <?php
          $kode=$this->session->userdata('id');
          $status=2;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where id_pelapor='$kode' AND laporan_status='$status'");        
          $jml_diterima=$hsl->num_rows();
          ?>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <center>
                  <h3><?php echo $jml_diterima;?></h3>
                  <p><h2>Diproses</h2></p>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>



          <?php
          $kode=$this->session->userdata('id');
          $status=3;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where id_pelapor='$kode' AND laporan_status='$status'");        
          $jml_ditolak=$hsl->num_rows();
          ?>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <center>
                  <h3><?php echo $jml_ditolak;?></h3>
                  <p><h2>Ditolak</h2></p>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>



          <?php
          $kode=$this->session->userdata('id');
          $status=4;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where id_pelapor='$kode' AND laporan_status='$status'");        
          $jml_selesai=$hsl->num_rows();
          ?>
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <center>
                    <h3><?php echo $jml_selesai;?></h3>
                    <p><h2>Selesai</h2></p>
                    </center>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

            <!-- ./col -->
          </div>
          <!-- Info boxes -->
          <!----row----->
          <!-- Info boxes -->
          <div class="row">
            <!-- fix for small devices only -->
            
          </div>
          <!-- /.row -->
          <div class="row">
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
              <div class="box box-success">
              </div>
              <!-- /.box -->
              
              <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              
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
          <b>Version</b> 1.0
        </div>
        <strong>Aduan</strong>
      </footer>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url().'assets/plugins/sparkline/jquery.sparkline.min.js'?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url().'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url().'assets/plugins/chartjs/Chart.min.js'?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url().'assets/dist/js/pages/dashboard2.js'?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
    <script>
    var lineChartData = {
    labels : <?php echo json_encode($bulan);?>,
    datasets : [
    
    {
    fillColor: "rgba(60,141,188,0.9)",
    strokeColor: "rgba(60,141,188,0.8)",
    pointColor: "#3b8bba",
    pointStrokeColor: "#fff",
    pointHighlightFill: "#fff",
    pointHighlightStroke: "rgba(152,235,239,1)",
    data : <?php echo json_encode($value);?>
    }
    ]
    
    }
    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
    var canvas = new Chart(myLine).Line(lineChartData, {
    scaleShowGridLines : true,
    scaleGridLineColor : "rgba(0,0,0,.005)",
    scaleGridLineWidth : 0,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: true,
    bezierCurve : true,
    bezierCurveTension : 0.4,
    pointDot : true,
    pointDotRadius : 4,
    pointDotStrokeWidth : 1,
    pointHitDetectionRadius : 2,
    datasetStroke : true,
    tooltipCornerRadius: 2,
    datasetStrokeWidth : 2,
    datasetFill : true,
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
    responsive: true
    });
    
    </script>
  </body>
</html>