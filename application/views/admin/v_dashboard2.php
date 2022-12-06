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
        // foreach($visitor as $result){
        //     $bulan[] = $result->tgl; //ambil bulan
        //     $value[] = (float) $result->jumlah; //ambil nilai
        // }
        /* end mengambil query*/
    ?>

</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <!--Header-->
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
        Dashboard Aduan Masyarakat (Lapor Bupati)
        <small>Lapor</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
 
        <?php 
          $query=$this->db->query("SELECT * FROM tbl_laporan");
          $jml_laporan=$query->num_rows();
        ?>

        <?php
          $kode=1;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where laporan_status='$kode'");        
          $jml_diterima=$hsl->num_rows();
          ?>

        <?php
          $kode=2;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where laporan_status='$kode'");        
          $jml_diproses=$hsl->num_rows();
        ?>

        <?php
          $kode=99;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where laporan_status='$kode'");        
          $jml_ditolak=$hsl->num_rows();
        ?>

        <?php
          $kode=3;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan where laporan_status='$kode'");        
          $jml_selesai=$hsl->num_rows();
        ?>

        <?php
          $hsl=$this->db->query("SELECT * FROM tbl_komentar");        
          $jml_komentar=$hsl->num_rows();
        ?>

        <?php
          $hsl=$this->db->query("SELECT * FROM tbl_inbox");        
          $jml_inbox=$hsl->num_rows();
        ?>

        <?php
        $hsl=$this->db->query("SELECT * FROM tbl_user");
        $jml_user=$hsl->num_rows();
        ?>

        <?php
          $kode=1;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan ");        
          $count_komisia=$hsl->num_rows();
        ?>

        <?php
          $kode=2;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan ");        
          $count_komisib=$hsl->num_rows();
        ?>

        <?php
          $kode=3;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan ");        
          $count_komisic=$hsl->num_rows();
        ?>

        <?php
          $kode=4;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan ");        
          $count_komisid=$hsl->num_rows();
        ?>

        <?php
          $kode=5;
          $hsl=$this->db->query("SELECT * FROM tbl_laporan ");        
          $count_pimpinan=$hsl->num_rows();
        ?>
<!----row----->
          <div class="row">
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                      <div class="inner">
                        <center>
                        <h3><?php echo $jml_laporan;?></h3>
                        <p><h2>ADUAN</h2></p>
                      </center>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="<?php echo base_url().'admin/laporan/semua'?>" class="small-box-footer"> Semua Aduan <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                      <div class="inner">
                        <center>
                        <h3><?php echo $jml_diterima;?></h3>
                  <!--     <h3><?php echo $jml;?></h3>  -->
                        <p><h2>Terverifikasi</h2></p>
                      </center>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
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

                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <center>
                        <h3><?php echo $jml_diproses;?></h3>
                        <p><h2>Progres</h2></p>
                      </center>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
 
                  <!-- ./col -->
                </div>
 



      <!----row----->
          <div class="row">
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <center>
                        <h3><?php echo $jml_selesai;?></h3>
                        <h4>ADUAN</h4>
                        <h4>SELESAI</h4>
                      </center>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <center>
                       <h3><?php echo $jml_inbox;?></h3>
                       <h4>Kiriman</h4>
                        <h4>Inbox</h4>
                      </center>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                <a href="<?php echo base_url().'admin/inbox'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></i></a>
                    </div>
                  </div>

                  <?php if($level==='1'):?>
                  <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-navy">
                      <div class="inner">
                        <center>
                        <h3><?php echo $jml_user;?></h3>
                        <h4>JUMLAH</h4>
                        <H4>PENGGUNA</H4>
                      </center>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <?php endif;?>
                  <!-- ./col -->
              </div>

      <!-- Info boxes -->


      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-chrome"></i></span>
              <?php 
                  $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Chrome'");
                  $jml=$query->num_rows();
              ?>
            <div class="info-box-content">
              <span class="info-box-text">Chrome</span>
              <span class="info-box-number"><?php echo $jml;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-firefox"></i></span>
            <?php 
                  $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Firefox' OR pengunjung_perangkat='Mozilla'");
                  $jml=$query->num_rows();
            ?>
            <div class="info-box-content">
              <span class="info-box-text">Mozilla Firefox</span>
              <span class="info-box-number"><?php echo $jml;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bug"></i></span>
              <?php 
                    $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Googlebot'");
                    $jml=$query->num_rows();
              ?>
            <div class="info-box-content">
              <span class="info-box-text">Googlebot</span>
              <span class="info-box-number"><?php echo $jml;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-opera"></i></span>
            <?php 
                    $query=$this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Opera'");
                    $jml=$query->num_rows();
              ?>
            <div class="info-box-content">
              <span class="info-box-text">Opera</span>
              <span class="info-box-number"><?php echo $jml;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">

            <!-- /.box-header -->

            <!-- ./box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
              <!-- <h3 class="box-title">Aduan Terbaru</h3> -->
          <div class="box box-success">
            <div class="box-header with-border">

              <table class="table">
              <thead>
                        <tr>
                          <th>Aduan Terbaru</th>
                          <th>Isi</th>
                          <th>Tanggal</th>

                        </tr>
                      </thead>
                      <tbody>       
              <?php 
                  $query=$this->db->query("SELECT * FROM tbl_laporan ORDER BY nomor DESC limit 5");
                  foreach ($query->result_array() as $i) :
                      $judul_laporan=$i['judul_laporan'];
                      $isi_laporan=$i['isi_laporan'];
                      $tanggal_laporan=$i['tanggal_laporan'];
              ?>
    
                            
                  <tr>
                    <td><?php echo $judul_laporan;?></td>
                    <td><?php echo $isi_laporan;?></td>
                    <td><?php echo $tanggal_laporan;?></td>
                  </tr>
              <?php endforeach;?>
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
    <strong>@LaporBupati</strong>
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
