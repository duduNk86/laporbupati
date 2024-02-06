<!--Counter Inbox-->
<?php
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan = $query->num_rows();
$query1 = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
$jum_komentar = $query1->num_rows();

$level = $this->session->userdata('pengguna_level');
$id_kepada = $this->session->userdata('pengguna_idskpd');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Ionicons -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">

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
      <section class="content">
        <section class="content-header">

          <!-- Custome Statistik -->
          <div class="row" style="margin-top: -25pt; margin-bottom: -5pt;">
            <div class="col">
              <div class="col-xl-6 col-lg-6">
                <div class="btn-group" role="group">
                  <button type="button" title="Custom Rekap & Statistik Aduan"><a href="#" data-toggle="modal" data-target="#ModalCustomStatistik"><i class="fa fa-bar-chart"></i></a></button>
                  <button type="button" title="Reset Data"><a href="<?php echo base_url() . 'admin/dashboard/opd' ?>"><i class="fa fa-refresh"></i></a></button>
                  &nbsp;Statistik &nbsp;:&nbsp; <b style="color:red;"><?php echo mediumdate_indo($tanggal_dari); ?></b> s/d <b style="color:red;"><?php echo mediumdate_indo($tanggal_sampai); ?></b>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="btn-group pull-right" role="group">
                  <button id="clock" class="date" style="letter-spacing: 0.1em; font-size: 14px;" disabled><b>{{ date }}</b> | <b style="color:red;">{{ time }}</b></button>
                </div>
              </div>
            </div>
          </div>

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
                    <h3><?php echo $jml_laporan_opd; ?></h3>
                    <p>
                    <h2>∑ Aduan</h2>
                    </p>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url() . 'admin/laporan/opd' ?>" class="small-box-footer"> Semua Aduan <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <center>
                    <h3><?php echo $jml_diterima_opd; ?></h3>
                    <p>
                    <h2>Verifikasi</h2>
                    </p>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <!-- <div class="col-lg-3 col-xs-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-red">
                <div class="inner">
                  <center>
                    <h3>< ?php echo $jml_ditolak_opd; ?></h3>
                    <p>
                    <h2>Ditolak</h2>
                    </p>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div> -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <center>
                    <h3><?php echo $jml_diproses_opd; ?></h3>
                    <p>
                    <h2>Proses</h2>
                    </p>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <center>
                    <h3><?php echo $jml_selesai_opd; ?></h3>
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
          </div>
          <!----row----->
          <div class="row">
            <!-- ./col -->

            <!-- <div class="col-lg-3 col-xs-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-yellow">
                <div class="inner">
                  <center>
                    <h3>< ?php echo $jml_inbox; ?></h3>
                    <h2>Inbox</h2>
                  </center>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div> -->

            <?php if ($level === '1') : ?>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-navy">
                  <div class="inner">
                    <center>
                      <h3><?php echo $jml_user; ?></h3>
                      <h2>User</h2>
                    </center>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <?php endif; ?>
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
                      <h3 class="m-0 font-weight-bold text-black" align="center"><b>Sumber Kanal Aduan</b></h3>
                    </div>
                    <div class="card-body text-bg-light" style="margin-top:20pt;">
                      <div class="chart-area">
                        <canvas id="myPieChart2"></canvas>
                        <table style="margin-top:10pt;">
                          <?php
                          foreach ($piechart2_opd_custome as $i) :
                          ?>
                            <tr>
                              <td style="font-size: 10pt;"><b><?php if ($i->sumber_aduan == 'LB') echo "Website Lapor Bupati";
                                                              else if ($i->sumber_aduan == 'LG') echo "Website Lapor Gubernur";
                                                              else if ($i->sumber_aduan == 'SP') echo "SP4N LAPOR";
                                                              else if ($i->sumber_aduan == 'WA') echo "Whatsapp";
                                                              else if ($i->sumber_aduan == 'SM') echo "SMS";
                                                              else if ($i->sumber_aduan == 'IG') echo "Instagram";
                                                              else if ($i->sumber_aduan == 'FB') echo "Facebook";
                                                              else if ($i->sumber_aduan == 'TW') echo "Twitter";
                                                              else echo "Belum Verifikasi"; ?></b></td>
                              <td style="font-size: 10pt;"><b><?php echo "&nbsp; : &nbsp;" . $i->total; ?></b></td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
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
              <div class="card shadow mb-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                      <h3 class="m-0 font-weight-bold text-black" align="center"><b>Statistik Kategori Aduan</b></h3>
                    </div>
                    <div class="card-body text-bg-light" style="margin-top:20pt;">
                      <div class="chart-area">
                        <canvas id="myPieChart"></canvas>
                        <table style="margin-top:10pt;">
                          <?php
                          foreach ($piechart_opd_custome as $i) :
                          ?>
                            <tr>
                              <td style="font-size: 10pt;"><b><?php if ($i->kategori_laporan == 1) echo "Infrastruktur";
                                                              else if ($i->kategori_laporan == 2) echo "Non-Infrastruktur";
                                                              else echo "Belum Verifikasi"; ?></b></td>
                              <td style="font-size: 10pt;"><b><?php echo "&nbsp; : &nbsp;" . $i->total; ?></b></td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6">
              <div class="card">
                <div class="box box-danger">
                  <div class="card-header">
                    <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;margin-bottom:17pt;"><b>Top #10 Topik Aduan</b></h3>
                  </div>
                  <table class="table">
                    <tbody>
                      <?php
                      foreach ($tablechart1_opd_custome as $i) :
                      ?>
                        <tr>
                          <td style="color:red;"><b><?php echo $i->topik_laporan; ?></b></td>
                          <td align="right"><b><?php echo $i->total; ?></b></td>
                          <td align="left">Aduan</td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
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
                <div class="box box-success">
                  <div class="card-header">
                    <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;margin-bottom:17pt;"><b>Rating Jawaban Tindak Lanjut</b></h3>
                  </div>
                  <table class="table">
                    <tbody>
                      <?php
                      foreach ($tablechart2_opd_custome as $i) :
                      ?>
                        <tr>
                          <td align="center" style="color:red;"><b><?php echo $i->ditujukan_kepada; ?></b></td>
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
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>

      <!-- Main row -->
      <section class="content" style="margin-top: -30pt;">
        <section class="content-header">
          <!-- <h3 align="center" style="margin-bottom: 15pt; margin-top: -50pt;">
        <b>Top #5 Aduan Terbaru</b>
      </h3> -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->
              <h3 align="center" class="box-title" style="margin-bottom: 15pt; margin-top: -60pt;"><b>Top #5 Aduan Terbaru</b></h3>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <table class="table">
                    <thead>
                      <tr>
                        <th align="center">#</th>
                        <th align="center">Aduan Terbaru</th>
                        <th align="center">Isi</th>
                        <th align="center">Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $code = $this->session->userdata("pengguna_idskpd");
                      $query = $this->db->query("SELECT * FROM tbl_laporan WHERE id_kepada = '$code' ORDER BY nomor DESC limit 5");
                      $no = 1;
                      foreach ($query->result_array() as $i) :
                        $judul_laporan = $i['judul_laporan'];
                        $isi_laporan = $i['isi_laporan'];
                        $tanggal_laporan = $i['tanggal_laporan'];
                      ?>
                        <tr>
                          <td align="justify"><?= $no++; ?></td>
                          <td align="justify"><?php echo $judul_laporan; ?></td>
                          <td align="justify"><?php echo $isi_laporan; ?></td>
                          <td align="left"><?php echo $tanggal_laporan; ?></td>
                        </tr>
                      <?php endforeach; ?>
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
                $query = $this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Chrome'");
                $jml = $query->num_rows();
                ?>
                <div class="info-box-content">
                  <span class="info-box-text">Chrome</span>
                  <span class="info-box-number"><?php echo $jml; ?></span>
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
                $query = $this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Firefox' OR pengunjung_perangkat='Mozilla'");
                $jml = $query->num_rows();
                ?>
                <div class="info-box-content">
                  <span class="info-box-text">Mozilla Firefox</span>
                  <span class="info-box-number"><?php echo $jml; ?></span>
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
                $query = $this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Googlebot'");
                $jml = $query->num_rows();
                ?>
                <div class="info-box-content">
                  <span class="info-box-text">Googlebot</span>
                  <span class="info-box-number"><?php echo $jml; ?></span>
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
                $query = $this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_perangkat='Opera'");
                $jml = $query->num_rows();
                ?>
                <div class="info-box-content">
                  <span class="info-box-text">Opera</span>
                  <span class="info-box-number"><?php echo $jml; ?></span>
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
        <b>Version</b> 3.0
      </div>
      <strong>© Lapor Bupati Wonosobo</strong>
    </footer>

    <!-- MODAL CUSTOM -->
    <!-- Awal Modal Custom Statistik Aduan -->
    <div class="modal fade" id="ModalCustomStatistik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Custom Statistik Aduan</h4>
          </div>
          <form id="form_cetak_antara" class="form-horizontal" action="<?php echo base_url() . 'admin/dashboard2/opd' ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="inputUserName" class="col-sm-3 control-label">Format</label>
                <div class="col-sm-9">
                  <select class="form-control select2" name="x_format" required>
                    <option value="">- Pilih -</option>
                    <option value="tahun">Tahunan</option>
                    <option value="bulan">Bulanan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-3 control-label">Dari</label>
                <div class="col-sm-9">
                  <input type="date" name="x_dari" class="form-control" id="x_dari">
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-3 control-label">Sampai</label>
                <div class="col-sm-9">
                  <input type="date" name="x_sampai" class="form-control" id="x_sampai">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger btn-sm btn-circle">Reset</button>
              <button type="submit" class="btn btn-primary btn-sm btn-circle" id="cetak">Proses</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Akhir Modal Custom Statistik Aduan -->

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url() . 'assets/plugins/sparkline/jquery.sparkline.min.js' ?>"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ?>"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
  <!-- ChartJS 1.0.1 -->
  <script src="<?php echo base_url() . 'assets/plugins/chart.js/Chart.min.js' ?>"></script>
  <!-- <script src="< ?php echo base_url().'assets/plugins/chartjs/Chart.min.js'?>"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url() . 'assets/dist/js/pages/dashboard2.js' ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>

  <!-- Jam JS -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.min.js"></script>
  <script type="text/javascript">
    var clock = new Vue({
      el: "#clock",
      data: {
        time: "",
        date: ""
      }
    });

    var week = ["Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jum'at,", "Sabtu,"];
    var timerID = setInterval(updateTime, 1000);
    updateTime();

    function updateTime() {
      var cd = new Date();
      clock.time =
        zeroPadding(cd.getHours(), 2) +
        ":" +
        zeroPadding(cd.getMinutes(), 2) +
        ":" +
        zeroPadding(cd.getSeconds(), 2);
      clock.date =
        week[cd.getDay()] +
        " " + zeroPadding(cd.getDate(), 2) +
        "-" +
        zeroPadding(cd.getMonth() + 1, 2) +
        "-" +
        zeroPadding(cd.getFullYear(), 4) +
        " ";
    }

    function zeroPadding(num, digit) {
      var zero = "";
      for (var i = 0; i < digit; i++) {
        zero += "0";
      }
      return (zero + num).slice(-digit);
    }
  </script>

  <!-- Chart -->
  <script type="text/javascript">
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          <?php
          if (count($linechart_opd_custome) > 0) {
            foreach ($linechart_opd_custome as $data) {
              if ($data->month == 1)
                echo "'" . "Jan " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 2)
                echo "'" . "Feb " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 3)
                echo "'" . "Mar " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 4)
                echo "'" . "Apr " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 5)
                echo "'" . "Mei " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 6)
                echo "'" . "Jun " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 7)
                echo "'" . "Jul " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 8)
                echo "'" . "Agu " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 9)
                echo "'" . "Sep " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 10)
                echo "'" . "Okt " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 11)
                echo "'" . "Nov " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
              else if ($data->month == 12)
                echo "'" . "Des " . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
            }
          }
          ?>
        ],
        datasets: [{
          label: 'Jumlah Aduan per Bulan ',
          backgroundColor: '#ADD8E6',
          borderColor: '##93C3D2',
          // backgroundColor: ['rgb(255, 99, 132)', 'rgb(252, 165, 3)', 'rgb(56, 86, 255, 0.87)','rgb(60, 179, 113)'],
          // borderColor: ['rgb(255, 99, 132)'],
          data: [
            <?php
            if (count($linechart_opd_custome) > 0) {
              foreach ($linechart_opd_custome as $data) {
                echo $data->jumlah_aduan . ", ";
              }
            }
            ?>
          ]
        }]
      },
    });
  </script>

  <script type="text/javascript">
    var ctx = document.getElementById('myPieChart2').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [
          <?php
          if (count($piechart2_opd_custome) > 0) {
            foreach ($piechart2_opd_custome as $data) {
              if ($data->sumber_aduan == 'LB')
                echo "'" . "Website Lapor Bupati" . "',";
              else if ($data->sumber_aduan == 'LG')
                echo "'" . "Website Lapor Gubernur" . "',";
              else if ($data->sumber_aduan == 'SP')
                echo "'" . "SP4N LAPOR" . "',";
              else if ($data->sumber_aduan == 'WA')
                echo "'" . "Whatsapp" . "',";
              else if ($data->sumber_aduan == 'SM')
                echo "'" . "SMS" . "',";
              else if ($data->sumber_aduan == 'IG')
                echo "'" . "Instagram" . "',";
              else if ($data->sumber_aduan == 'FB')
                echo "'" . "Facebook" . "',";
              // else if ($data->kategori_laporan=='TW')
              //   echo "'" ."Twitter" ."',";
              else
                echo "'" . "Twitter" . "',";
            }
          }
          ?>
        ],
        datasets: [{
          label: 'Sumber Kanal Aduan',
          // backgroundColor: '#ADD8E6',
          // borderColor: '##93C3D2',
          backgroundColor: [
            'rgba(204, 204, 204, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(189, 8, 92, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgba(204, 204, 204, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(189, 8, 92, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255,99,132,1)',
            'rgba(75, 192, 192, 1)'
          ],
          data: [
            <?php
            if (count($piechart2_opd_custome) > 0) {
              foreach ($piechart2_opd_custome as $data) {
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
      var ctx = document.getElementById('myBarChart').getContext('2d');
      var chart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: [
            < ?php
            if (count($barchart) > 0) {
              foreach ($barchart as $data) {
                echo "'" . $data->ditujukan_kepada . "',";
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
                < ?php
                if (count($barchart) > 0) {
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
          if (count($piechart_opd_custome) > 0) {
            foreach ($piechart_opd_custome as $data) {
              if ($data->kategori_laporan == 1)
                echo "'" . "Infrastruktur" . "',";
              else
                echo "'" . "Non-Infrastruktur" . "',";
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
            if (count($piechart_opd_custome) > 0) {
              foreach ($piechart_opd_custome as $data) {
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
            < ?php
            if (count($doughnutchart) > 0) {
              foreach ($doughnutchart as $data) {
                if ($data->subkategori_laporan == 1)
                  echo "'" . "Jalan dan Jembatan" . "',";
                else if ($data->subkategori_laporan == 2)
                  echo "'" . "Bangunan dan Gedung" . "',";
                else if ($data->subkategori_laporan == 3)
                  echo "'" . "Sarana dan Prasarana Pengairan" . "',";
                else if ($data->subkategori_laporan == 4)
                  echo "'" . "Bidang Fisik lainnya" . "',";
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
                < ?php
                if (count($doughnutchart) > 0) {
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
            < ?php
            if (count($radarchart) > 0) {
              foreach ($radarchart as $data) {
                if ($data->subkategori_laporan == 5)
                  echo "'" . "Pendidikan : " . $data->total . "',";
                else if ($data->subkategori_laporan == 6)
                  echo "'" . "Kesehatan : " . $data->total . "',";
                else if ($data->subkategori_laporan == 7)
                  echo "'" . "Kependudukan : " . $data->total . "',";
                else if ($data->subkategori_laporan == 8)
                  echo "'" . "Kepegawaian : " . $data->total . "',";
                else if ($data->subkategori_laporan == 9)
                  echo "'" . "Energi : " . $data->total . "',";
                else if ($data->subkategori_laporan == 10)
                  echo "'" . "Pertanian : " . $data->total . "',";
                else if ($data->subkategori_laporan == 11)
                  echo "'" . "Pembangunan Daerah : " . $data->total . "',";
                else if ($data->subkategori_laporan == 12)
                  echo "'" . "Keuangan dan Aset : " . $data->total . "',";
                else if ($data->subkategori_laporan == 13)
                  echo "'" . "Bencana : " . $data->total . "',";
                else if ($data->subkategori_laporan == 14)
                  echo "'" . "Ekonomi dan Industri : " . $data->total . "',";
                else if ($data->subkategori_laporan == 15)
                  echo "'" . "Sosial Masyarakat : " . $data->total . "',";
                else if ($data->subkategori_laporan == 16)
                  echo "'" . "Lingkungan : " . $data->total . "',";
                else if ($data->subkategori_laporan == 17)
                  echo "'" . "Pariwisata dan Budaya : " . $data->total . "',";
                else if ($data->subkategori_laporan == 18)
                  echo "'" . "Ketentraman dan Ketertiban : " . $data->total . "',";
                else if ($data->subkategori_laporan == 19)
                  echo "'" . "Tenaga Kerja dan Transmigrasi : " . $data->total . "',";
                else if ($data->subkategori_laporan == 20)
                  echo "'" . "Perhubungan : " . $data->total . "',";
                else if ($data->subkategori_laporan == 21)
                  echo "'" . "Bidang Non-Fisik lainnya : " . $data->total . "',";
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
                < ?php
                if (count($radarchart) > 0) {
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