<!--Counter Inbox-->
<?php 
    $query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
    $jum_pesan=$query->num_rows();
    $query1=$this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
    $jum_komentar=$query1->num_rows();

    $level=$this->session->userdata('pengguna_level');
    $id_kepada=$this->session->userdata('pengguna_idskpd');
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
  
  <!-- < ?php
        /* Mengambil query report*/
        foreach($visitor as $result){
            $bulan[] = $result->tgl; //ambil bulan
            $value[] = (float) $result->jumlah; //ambil nilai
        }
        /* end mengambil query*/
    ?> -->

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
        Dashboard Lapor Bupati
        <small>[Laporbup]</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <hr>

    <!-- Main content -->
    <section class="content" style="margin-top:-40pt;">
      <section class="content-header">
        <h3 align="center">
          <b>Rekap Penanganan Aduan</b>
        </h3>
      <!----row----->
          <div class="row" style="margin-top: 15pt;">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <center>
                  <h3><?php echo $jml_laporan_opd;?></h3>
                  <p><h2>∑ Aduan</h2></p>
                </center>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url().'admin/laporan/opd'?>" class="small-box-footer"> Semua Aduan <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <center>
                  <h3><?php echo $jml_diterima_opd;?></h3>
                  <p><h2>Verifikasi</h2></p>
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
                  <h3><?php echo $jml_ditolak_opd;?></h3>
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
                  <h3><?php echo $jml_diproses_opd;?></h3>
                  <p><h2>Proses</h2></p>
                </center>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
      <!----row----->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <center>
                  <h3><?php echo $jml_selesai_opd;?></h3>
                  <h2>Selesai</h2>
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
                 <h2>Inbox</h2>
                </center>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                  <h2>User</h2>
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
    </section>
  </section>

  <!-- Chart JS -->
  <section class="content" style="margin-top: -30pt;">
    <section class="content-header">
      <div class="row">
          <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-black" align="center"><b>Statistik Aduan</b></h3>
                  </div>
                  <div class="card-body text-bg-light" style="margin-top:20pt;">
                    <div class="chart-area">
                      <canvas id="myLineChart"></canvas>
                    </div>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-black" align="center"><b>Statistik Kategori Aduan</b></h3>
                  </div>
                  <div class="card-body text-bg-light" style="margin-top:20pt;">
                    <div class="chart-area">
                      <canvas id="myPieChart"></canvas>
                    </div>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>

    <br>

    <section class="content" style="margin-top: -30pt;">
      <div class="row">
          <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="box box-danger">
                  <div class="card-header">
                    <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;margin-bottom:17pt;"><b>Top #10 Topik Aduan</b></h3>
                  </div>
                  <table class="table">
                    <tbody>       
                      <?php 
                        foreach ($tablechart1_opd as $i) :
                        ?>
                        <tr>
                          <td style="color:red;"><b><?php echo $i->topik_laporan;?></b></td>
                          <td align="right"><b><?php echo $i->total;?></b></td>
                          <td align="left">Aduan</td>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="box box-success">
                  <div class="card-header">
                    <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;margin-bottom:17pt;"><b>Rating Jawaban Tindak Lanjut</b></h3>
                  </div>
                  <table class="table">
                    <tbody>       
                      <?php
                        foreach ($tablechart2_opd as $i) :
                        ?>
                        <tr>
                          <td align="center" style="color:red;"><b><?php echo $i->ditujukan_kepada;?></b></td>
                          <td align="center">
                            <b>
                              <?php 
                                if ($i->hasil_bagi == 1) {
                                  echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
                                } else if ($i->hasil_bagi == 2) {
                                  echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
                                } else if ($i->hasil_bagi == 3) {
                                  echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
                                } else if ($i->hasil_bagi == 4) {
                                  echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i></b>";
                                } else if ($i->hasil_bagi == 5) {
                                  echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></b>";
                                }
                              ?>                              
                            </b>
                          </td>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
      </div>
    </section>
  </section>

  <!-- Main row -->
  <section class="content">
    <section class="content-header">
      <h3 align="center" style="margin-bottom: 15pt; margin-top: -50pt;">
        <b>Top #5 Aduan Terbaru</b>
      </h3>
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
              <!-- <h3 class="box-title">Aduan Terbaru</h3> -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <table class="table">
              <thead>
                <tr>
                  <th align="center">Aduan Terbaru</th>
                  <th align="center">Isi</th>
                  <th align="center">Tanggal</th>
                </tr>
              </thead>
              <tbody>      
                <?php 
                    $code=$this->session->userdata("pengguna_idskpd");
                    $query=$this->db->query("SELECT * FROM tbl_laporan WHERE id_kepada = '$code' ORDER BY nomor DESC limit 5 ");
                    foreach ($query->result_array() as $i) :
                        $judul_laporan=$i['judul_laporan'];
                        $isi_laporan=$i['isi_laporan'];
                        $tanggal_laporan=$i['tanggal_laporan'];
                ?>
                <tr>
                  <td align="justify"><?php echo $judul_laporan;?></td>
                  <td align="justify"><?php echo $isi_laporan;?></td>
                  <td align="left"><?php echo $tanggal_laporan;?></td>
                </tr>
                <?php endforeach;?>
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
  </section>

  <!-- Statistik Pengunjung Laporbup -->
  <section class="content">
    <section class="content-header">
      <h3 align="center" style="margin-bottom: 15pt; margin-top: -20pt;">
        <b>Statistik Pengunjung</b>
      </h3>
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
    </section>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
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
<script src="<?php echo base_url().'assets/plugins/chart.js/Chart.min.js'?>"></script>
<!-- <script src="< ?php echo base_url().'assets/plugins/chartjs/Chart.min.js'?>"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url().'assets/dist/js/pages/dashboard2.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>

<!-- Chart -->
<script type="text/javascript">
      var ctx = document.getElementById('myLineChart').getContext('2d');
      var chart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [
            <?php 
              if (count($linechart_opd)>0) {
                foreach ($linechart_opd as $data) {
                  echo "'" .$data->year ."',";
                }
              }
            ?>
          ],
          datasets: [{
              label: 'Jumlah Aduan',
              backgroundColor: '#ADD8E6',
              borderColor: '##93C3D2',
              // backgroundColor: ['rgb(255, 99, 132)', 'rgb(252, 165, 3)', 'rgb(56, 86, 255, 0.87)','rgb(60, 179, 113)'],
              // borderColor: ['rgb(255, 99, 132)'],
              data: [
                <?php 
                  if (count($linechart_opd)>0) {
                     foreach ($linechart_opd as $data) {
                      echo $data->jumlah_aduan . ", ";
                    }
                  }
                ?>
              ]
          }]
      },
  });
         
</script>

<!-- <script type="text/javascript">
      var ctx = document.getElementById('myBarChart').getContext('2d');
      var chart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [
            <?php 
              if (count($barchart)>0) {
                foreach ($barchart as $data) {
                  echo "'" .$data->ditujukan_kepada ."',";
                }
              }
            ?>
          ],
          datasets: [{
              label: 'Top #10 Perangkat Daerah',
              // backgroundColor: '#ADD8E6',
              // borderColor: '##93C3D2',
              backgroundColor: ['rgb(252, 3, 3)', 'rgb(255, 99, 132)', 'rgb(252, 165, 3)', 'rgb(56, 86, 255, 0.87)','rgb(60, 179, 113)'],
              // borderColor: ['rgb(255, 99, 132)'],
              data: [
                <?php 
                  if (count($barchart)>0) {
                     foreach ($barchart as $data) {
                      echo $data->total . ", ";
                    }
                  }
                ?>
              ]
          }]
      },
  });        
</script> -->

<script type="text/javascript">
      var ctx = document.getElementById('myPieChart').getContext('2d');
      var chart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: [
            <?php 
              if (count($piechart_opd)>0) {
                foreach ($piechart_opd as $data) {
                  if ($data->kategori_laporan==1)
                    echo "'" ."Infrastruktur" ."',";
                  else
                    echo "'" ."Non-Infrastruktur" ."',";
                }
              }
            ?>
          ],
          datasets: [{
              label: 'Kategori Aduan',
              // backgroundColor: '#ADD8E6',
              // borderColor: '##93C3D2',
              backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
              borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
              data: [
                <?php 
                  if (count($piechart_opd)>0) {
                     foreach ($piechart_opd as $data) {
                      echo $data->total . ", ";
                    }
                  }
                ?>
              ]
          }]
      },
  });        
</script>

<!-- <script type="text/javascript">
      var ctx = document.getElementById('myDoughnutChart').getContext('2d');
      var chart = new Chart(ctx, {
      type: 'doughnut',
      data: {
          labels: [
            <?php 
              if (count($doughnutchart)>0) {
                foreach ($doughnutchart as $data) {
                  if ($data->subkategori_laporan==1)
                    echo "'" ."Jalan dan Jembatan" ."',";
                  else if($data->subkategori_laporan==2)
                    echo "'" ."Bangunan dan Gedung" ."',";
                  else if($data->subkategori_laporan==3)
                    echo "'" ."Sarana dan Prasarana Pengairan" ."',";
                  else if($data->subkategori_laporan==4)
                    echo "'" ."Bidang Fisik lainnya" ."',";
                }
              }
            ?>
          ],
          datasets: [{
              label: 'Statistik Sub-Kategori Infrastruktur',
              // backgroundColor: '#ADD8E6',
              // borderColor: '##93C3D2',
              backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
              borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
              data: [
                <?php 
                  if (count($doughnutchart)>0) {
                     foreach ($doughnutchart as $data) {
                      echo $data->total . ", ";
                    }
                  }
                ?>
              ]
          }]
      },
  });        
</script>

<script type="text/javascript">
      var ctx = document.getElementById('myRadarChart').getContext('2d');
      var chart = new Chart(ctx, {
      type: 'radar',
      data: {
          labels: [
            <?php 
              if (count($radarchart)>0) {
                foreach ($radarchart as $data) {
                  if ($data->subkategori_laporan==5)
                    echo "'" ."Pendidikan : ".$data->total ."',";
                  else if($data->subkategori_laporan==6)
                    echo "'" ."Kesehatan : ".$data->total ."',";
                  else if($data->subkategori_laporan==7)
                    echo "'" ."Kependudukan : ".$data->total ."',";
                  else if($data->subkategori_laporan==8)
                    echo "'" ."Kepegawaian : ".$data->total ."',";
                  else if($data->subkategori_laporan==9)
                    echo "'" ."Energi : ".$data->total ."',";
                  else if($data->subkategori_laporan==10)
                    echo "'" ."Pertanian : ".$data->total ."',";
                  else if($data->subkategori_laporan==11)
                    echo "'" ."Pembangunan Daerah : ".$data->total ."',";
                  else if($data->subkategori_laporan==12)
                    echo "'" ."Keuangan dan Aset : ".$data->total ."',";
                  else if($data->subkategori_laporan==13)
                    echo "'" ."Bencana : ".$data->total ."',";
                  else if($data->subkategori_laporan==14)
                    echo "'" ."Ekonomi dan Industri : ".$data->total ."',";
                  else if($data->subkategori_laporan==15)
                    echo "'" ."Sosial Masyarakat : ".$data->total ."',";
                  else if($data->subkategori_laporan==16)
                    echo "'" ."Lingkungan : ".$data->total ."',";
                  else if($data->subkategori_laporan==17)
                    echo "'" ."Pariwisata dan Budaya : ".$data->total ."',";
                  else if($data->subkategori_laporan==18)
                    echo "'" ."Ketentraman dan Ketertiban : ".$data->total ."',";
                  else if($data->subkategori_laporan==19)
                    echo "'" ."Tenaga Kerja dan Transmigrasi : ".$data->total ."',";
                  else if($data->subkategori_laporan==20)
                    echo "'" ."Perhubungan : ".$data->total ."',";
                  else if($data->subkategori_laporan==21)
                    echo "'" ."Bidang Non-Fisik lainnya : ".$data->total ."',";
                }
              }
            ?>
          ],
          datasets: [{
              label: 'Non-Infrastruktur',
              backgroundColor: 'rgba(255, 99, 132, 0.2)',
              borderColor: 'rgb(255, 99, 132)',
              // backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
              // borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
              data: [
                <?php 
                  if (count($radarchart)>0) {
                     foreach ($radarchart as $data) {
                      echo $data->total . ", ";
                    }
                  }
                ?>
              ]
          }]
      },
  });        
</script> -->

<!-- <script type="text/javascript">
      var ctx = document.getElementById('myBarChart2').getContext('2d');
      var chart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [
            < ?php 
              if (count($barchart2)>0) {
                foreach ($barchart2 as $data) {
                  echo "'" .$data->topik_laporan ."',";
                }
              }
            ?>
          ],
          datasets: [{
              label: 'Top #5 Topik Aduan',
              backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
              borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
              borderWidth: 1,
              data: [
                < ?php 
                  if (count($barchart2)>0) {
                     foreach ($barchart2 as $data) {
                      echo $data->total . ", ";
                    }
                  }
                ?>
              ]
          }]
      },
  });        
</script> -->

</body>
</html>
