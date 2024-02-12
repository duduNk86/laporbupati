<?php
$pengguna_level = $this->session->userdata('pengguna_level');
if (empty($pengguna_level)) {
  redirect('home');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="600" />
  <title><?= $title; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- <link rel="icon" href="favicon.ico" type="image/x-icon" /> -->
  <link href="<?= base_url('theme/'); ?>images/Lambang Wonosobo.png" rel="shortcut icon" />
  <!-- END META SECTION -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Share+Tech+Mono">
  <style type="text/css">
    #clock {
      font-family: 'Roboto', monospace;
      color: #ffffff;
      text-align: center;
      position: absolute;
      left: 91%;
      right: -30%;
      top: 40%;
      transform: translate(-50%, -50%);
      /* color: #daf6ff; */
      text-shadow: 0 0 20px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
    }
  </style>

  <!-- costum css -->
  <style>
    /* not active */
    .nav-tabs .nav-link:not(.active) {
      background-color: #fff;
      color: black;
    }

    /* active*/
    .nav-tabs .nav-link {
      background-color: rgb(60, 179, 113);
      color: white;
    }
  </style>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">


  <!-- CSS INCLUDE -->
  <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url() . 'assets/lapor/assets/css/theme-default.css' ?>" />'
  <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url() . 'assets/lapor/assets/css/custom.css' ?>" />

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- Bootstrap 3.3.6 -->
  <!-- <link rel="stylesheet" href="< ?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>"> -->

  <!-- EOF CSS INCLUDE -->
  <!-- START PLUGINS -->
  <script type="text/javascript" id="jquery" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/jquery/jquery.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/jquery/jquery-ui.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/bootstrap/bootstrap.min.js' ?>"></script>

</head>

<body>
  <!-- <marquee behavior="scroll" direction="down" scrollamount="2"></marquee> -->
  <!-- START PAGE CONTAINER -->

  <!-- <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:-10pt;margin-bottom: 0pt;">
    <li class="nav-item">
      <a class="nav-link active" href="< ?php echo base_url() . 'home/view' ?>">Statistik</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="< ?php echo base_url() . 'home/view2' ?>">Pengaduan Aktif</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="< ?php echo base_url() . 'admin/administrator/logout' ?>">Logout</a>
    </li>
  </ul> -->
  <div class="panel panel-primary">
    <!-- PAGE CONTENT -->
    <div class="panel-body">
      <!-- TITLE CONTENT -->
      <div class="row">
        <div class="col-md-12">
          <div class="text-center" style="margin-left: -30px;"><img src="<?php echo base_url() . 'assets/lapor/dashboard-title.png' ?>" width="1920px" height="130px">
            <!-- <div class="text-center" style="margin-left: -30px;"><img src="< ?php echo base_url() . 'assets/lapor/dashboard-title.png' ?>" width="1530px" height="115px"> -->
            <div id="clock"><br>
              <p class="date" style="color:black;letter-spacing: 0.1em; font-size: 14px;">{{ date }}</p>
              <p class="time" style="color:red;letter-spacing: 0.05em; font-size: 24px; padding: 2px 0;">{{ time }}</p>
            </div>
          </div>
        </div>
      </div>
      <!-- END TITLE CONTENT -->
      <div class="page-content-wrap" style="font-size: medium;">
        <?php
        $kode = 2;
        $hsl = $this->db->query("SELECT * FROM tbl_laporan where tayang='ya'");
        $jml_tayang = $hsl->num_rows();
        $btl = $this->db->query("SELECT * FROM tbl_laporan where laporan_status='$kode' AND tayang='ya'");
        $jml_btl = $btl->num_rows();
        ?>
        <div class="row">
          <div class="col-md-12" style="margin-left:-10px;margin-top:5px;margin-bottom:15px;">
            <!-- <div class="col-md-12" style="margin-left:-40px;margin-top:5px;margin-bottom:15px;"> -->
            <div class="col-md-5">
            </div>
            <div class="col-md-4 justify-content-center">
              <a href="<?php echo base_url() . 'home/view' ?>" class="btn btn-danger btn-md" style="font-size:12pt"><i class="fa fa-bar-chart"></i>Statistik</a> &nbsp;&nbsp; | &nbsp;&nbsp;
              <a href="<?php echo base_url() . 'home/view2' ?>" style="color:black">Pengaduan Aktif</a> &nbsp;&nbsp; | &nbsp;&nbsp;
              <a href="<?php echo base_url() . 'admin/administrator/logout' ?>" style="color:black">Logout</a>
            </div>
            <div class="col-md-3">
            </div>
          </div>
          <div class="panel panel-colorful">
            <div class="panel-heading">
              <div class="panel-title-box">
                <b align="center" style="font-size: 14pt;">STATISTIK</b>
              </div>
            </div>
            <!-- Main content -->
            <section class="content">
              <section class="content-header">

                <!-- Custome Statistik -->
                <div class="row" style="margin-top: 25pt; margin-bottom: 15pt;">
                  <div class="col">
                    <div class="col-xl-6 col-lg-6">
                      <div class="btn-group" role="group">
                        <button type="button" title="Customize Rekap & Statistik" class="btn-lg" style="border: solid 1px;"><a href="#" data-toggle="modal" data-target="#ModalCustomStatistik"><i class="fa fa-bar-chart"></i>&nbsp; Filter</a></button>
                        <button type="button" title="Reset Data" class="btn-lg" style="border: solid 1px;"><a href="<?php echo base_url() . 'home/view' ?>"><i class="fa fa-refresh"></i>&nbsp; Reset</a></button>
                      </div>
                    </div>
                  </div>
                </div>

                <h3 align="center">
                  <b>Rekapitulasi Penanganan Aduan</b>
                </h3>
                <!----row----->
                <div class="row" style="margin-top: 20pt;">
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                      <div class="inner">
                        <center>
                          <h3 style="color:white;"><?php echo $jml_laporan; ?></h3>
                          <p>
                          <h2 style="color:white;">∑ Aduan</h2>
                          </p>
                        </center>
                      </div>
                      <div class="icon">
                        <i class="icon icon-bag" style="color:white;"></i>
                      </div>
                      <!-- <a href="< ?php echo base_url().'admin/laporan'?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a> -->
                      <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                      <div class="inner">
                        <center>
                          <h3 style="color:white;"><?php echo $jml_diterima; ?></h3>
                          <p>
                          <h2 style="color:white;">Verifikasi</h2>
                          </p>
                        </center>
                      </div>
                      <div class="icon">
                        <i class="icon icon-stats-bars" style="color:white;"></i>
                      </div>
                      <!-- <a href="< ?php echo base_url().'admin/verifikasi'?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a> -->
                      <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <center>
                          <h3 style="color:white;"><?php echo $jml_ditolak; ?></h3>
                          <p>
                          <h2 style="color:white;">Ditolak</h2>
                          </p>
                        </center>
                      </div>
                      <div class="icon">
                        <i class="icon icon-pie-graph" style="color:white;"></i>
                      </div>
                      <!-- <a href="< ?php echo base_url().'admin/ditolak'?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a> -->
                      <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <center>
                          <h3 style="color:white;"><?php echo $jml_diproses; ?></h3>
                          <p>
                          <h2 style="color:white;">Proses</h2>
                          </p>
                        </center>
                      </div>
                      <div class="icon">
                        <i class="icon icon-person-add" style="color:white;"></i>
                      </div>
                      <!-- <a href="< ?php echo base_url().'admin/progres'?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a> -->
                      <a href="#" class="small-box-footer" data-toggle="modal" data-target="#ModalCustomStatistik2"><i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                      <div class="inner">
                        <center>
                          <h3 style="color:white;"><?php echo $jml_selesai; ?></h3>
                          <h2 style="color:white;">Selesai</h2>
                        </center>
                      </div>
                      <div class="icon">
                        <i class="icon icon-bag" style="color:white;"></i>
                      </div>
                      <!-- <a href="< ?php echo base_url().'admin/selesai'?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a> -->
                      <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                      <div class="inner">
                        <center>
                          <h3 style="color:white;"><b><?php echo $durasi_tl; ?></b></h3>
                          <h2 style="color:white;">X̄ Kecepatan TL</h2>
                        </center>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add" style="color:white;"></i>
                      </div>
                      <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </section>
            </section>

            <br>

            <!-- Chart JS -->
            <section class="content" style="margin-top: -30pt;">
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
                              foreach ($piechart2 as $i) :
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

            <section class="content" style="margin-top: -35pt;">
              <div class="row">
                <div class="col-xl-6 col-lg-6">
                  <div class="card shadow mb-12">
                    <div class="box box-aqua">
                      <div class="box-header with-border">
                        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                          <h3 class="m-0 font-weight-bold text-black" align="center"><b>TOP #10 Aduan Terbanyak pada OPD</b></h3>
                        </div>
                        <div class="card-body text-bg-light" style="margin-top:20pt;">
                          <div class="chart-area">
                            <canvas id="myBarChart"></canvas>
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
                            <table style="margin-top:39pt;">
                              <?php
                              foreach ($piechart as $i) :
                              ?>
                                <tr>
                                  <td style="font-size: 10pt;"><b><?php if ($i->kategori_laporan == 1) echo "Infrastruktur";
                                                                  else echo "Non-Infrastruktur"; ?></b></td>
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

            <section class="content" style="margin-top: -35pt;">
              <div class="row">
                <div class="col-xl-6 col-lg-6">
                  <div class="card shadow mb-12">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                          <h3 class="m-0 font-weight-bold text-black" align="center"><b>Statistik Sub-Kategori Aduan Infrastruktur</b></h3>
                        </div>
                        <div class="card-body text-bg-light" style="margin-top:20pt;">
                          <div class="chart-area">
                            <canvas id="myDoughnutChart"></canvas>
                            <table style="margin-top: 10pt;">
                              <?php
                              foreach ($doughnutchart as $i) :
                              ?>
                                <tr>
                                  <td style="font-size: 10pt;"><b><?php if ($i->subkategori_laporan == 1) echo "Jalan dan Jembatan";
                                                                  else if ($i->subkategori_laporan == 2) echo "Bangunan dan Gedung";
                                                                  else if ($i->subkategori_laporan == 3) echo "Sarana dan Prasarana Pengairan";
                                                                  else echo "Bidang Fisik lainnya"; ?></b></td>
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
                  <div class="card shadow mb-12">
                    <div class="box box-success">
                      <div class="box-header with-border">
                        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                          <h3 class="m-0 font-weight-bold text-black" align="center"><b>Statistik Sub-Kategori Aduan Non-Infrastruktur</b></h3>
                        </div>
                      </div>
                      <div class="card-body text-bg-light" style="margin-top:20pt;">
                        <div class="chart-area">
                          <canvas id="myRadarChart"></canvas>
                        </div>
                        <br><br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <br>

            <section class="content" style="margin-top: -35pt;">
              <div class="row">
                <div class="col-xl-6 col-lg-6">
                  <div class="card">
                    <div class="box box-danger">
                      <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;"><b>Top #10 Topik Aduan</b></h3>
                      </div>
                      <table class="table">
                        <tbody>
                          <?php
                          foreach ($tablechart1 as $i) :
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
                <div class="col-xl-6 col-lg-6">
                  <div class="card">
                    <div class="box box-gold">
                      <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;"><b>Top #10 Jawaban Aduan Terbaik</b></h3>
                      </div>
                      <table class="table">
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($tablechart2 as $i) :
                          ?>
                            <tr>
                              <td align="center"><b>#<?= $no++; ?></b></td>
                              <td style="color:red;"><b><?php echo $i->ditujukan_kepada; ?></b></td>
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

            <br>

            <section class="content" style="margin-top: -35pt;">
              <div class="row">
                <div class="col-xl-6 col-lg-6">
                  <div class="card">
                    <div class="box box-warning">
                      <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;"><b>Daftar OPD Belum Selesai TL Aduan</b></h3>
                      </div>
                      <table class="table">
                        <tbody>
                          <?php
                          foreach ($tablechart3 as $i) :
                          ?>
                            <tr>
                              <td style="color:red;"><b><?php echo $i->ditujukan_kepada; ?></b></td>
                              <td align="right"><b><?php echo $i->total; ?></b></td>
                              <td align="left">Aduan</td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                  <div class="card">
                    <div class="box box-gold">
                      <div class="card-header">
                        <h3 class="m-0 font-weight-bold text-black" align="center" style="margin-top:20pt;"><b>X̄ Kecepatan TL OPD</b></h3>
                      </div>
                      <table class="table">
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($tablechart4 as $i) :
                            $durasiRataRata = round($i->durasi_rata_rata);
                            $formattedDurasi = formatDurasi($durasiRataRata);
                          ?>
                            <tr>
                              <td align="center"><b>#<?= $no++; ?></b></td>
                              <td style="color:red;"><b><?php echo $i->ditujukan_kepada; ?></b></td>
                              <td align="right"><?php echo $formattedDurasi; ?></td>
                              <td></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="panel-footer">
    <h5>
      <center>&copy; Lapor Bupati Wonosobo V.3 - by @msyon & Mas@guNk86</center>
      <h5>
  </div>

  <!-- MODAL CUSTOM -->
  <!-- Awal Modal Custom Tanggal Statistik Aduan -->
  <div class="modal fade" id="ModalCustomStatistik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Custom Statistik Aduan</h4>
        </div>
        <form id="form_cetak_antara" class="form-horizontal" action="<?php echo base_url() . 'home/view3' ?>" method="post" enctype="multipart/form-data">
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
  <!-- Akhir Modal Custom Tanggal Statistik Aduan -->

  <!-- Awal Modal Daftar Aduan Dalam Proses -->
  <div class="modal fade" id="ModalCustomStatistik2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center"><b>Daftar OPD Belum Selesai TL Aduan</b></h4>
        </div>
        <div class="modal-body">
          <div class="header" align="justify">
            Berikut kami sampaikan aduan masyarakat per tanggal <b style="color:red;"><?php echo date('d M Y'); ?></b> yang <b>Belum Tertangani</b>:
          </div>
          <br>
          <table class="table">
            <thead>
              <tr>
                <td align="center"><b>NO.</b></td>
                <td align="center"><b>OPD</b></td>
                <td align="center"><b>JUMLAH ADUAN</b></td>
                <td align="center"><b>STATUS</b></td>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($opd_tlproses as $i) :
              ?>
                <tr>
                  <td align="center"><b><?= $no++; ?>.</b></td>
                  <td style="color:red;"><b><?php echo $i->ditujukan_kepada; ?></b></td>
                  <td align="center"><b><?php echo $i->total; ?></b></td>
                  <td align="center">Dalam Proses</td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td align="center" colspan="2"><b>JUMLAH TOTAL</b></td>
                <td align="center"><b><?php echo $jml_diproses; ?></b></td>
                <td align="center"><b>Aduan</b></td>
              </tr>
            </tbody>
          </table>
          <!-- <hr> -->
          <div class="footer" align="justify">
            Mohon untuk dapat segera diselesaikan sesuai dengan ketentuan batas waktu penanganan Aduan pada Lapor Bupati Wonosobo. Terima kasih.
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="close" data-dismiss="modal">Tutup&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Modal Daftar Aduan Dalam Proses -->

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

  <script>
    setTimeout(function() {
      window.location.reload(1);
    }, 500000);
  </script>
  <script type='text/javascript' src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/icheck/icheck.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/scrolltotop/scrolltopcontrol.js' ?>"></script>

  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/morris/raphael-min.js' ?>"></script>
  <script type='text/javascript' src='<?php echo base_url() . 'assets/lapor/assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ?>'></script>
  <script type='text/javascript' src='<?php echo base_url() . 'assets/lapor/assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ?>'></script>
  <script type='text/javascript' src='<?php echo base_url() . 'assets/lapor/assets/js/plugins/bootstrap/bootstrap-datepicker.js' ?>'></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/owl/owl.carousel.min.js' ?>"></script>

  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/moment.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins/daterangepicker/daterangepicker.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/jquery.carouFredSel-6.2.1-packed.js' ?>"></script>
  <!-- END THIS PAGE PLUGINS-->

  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/demo_dashboard.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/plugins.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/actions.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/lapor/assets/js/myjs.js' ?>"></script>

  <!-- Bootstrap 3.3.6 -->
  <!-- <script src="< ?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script> -->
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- Chart JS -->
  <script src="<?php echo base_url() . 'assets/plugins/chart.js/Chart.min.js' ?>"></script>
  <!-- END TEMPLATE -->

  <!-- Chart -->
  <script type="text/javascript">
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          <?php
          if (count($linechart) > 0) {
            foreach ($linechart as $data) {
              echo "'" . $data->year . " (" . $data->jumlah_aduan . ")" . "',";
            }
          }
          ?>
        ],
        datasets: [{
          label: 'Jumlah Aduan ',
          backgroundColor: '#ADD8E6',
          borderColor: '##93C3D2',
          // backgroundColor: ['rgb(255, 99, 132)', 'rgb(252, 165, 3)', 'rgb(56, 86, 255, 0.87)','rgb(60, 179, 113)'],
          // borderColor: ['rgb(255, 99, 132)'],
          data: [
            <?php
            if (count($linechart) > 0) {
              foreach ($linechart as $data) {
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
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          <?php
          if (count($barchart) > 0) {
            foreach ($barchart as $data) {
              echo "'" . $data->ditujukan_kepada . " : " . $data->total . "',";
            }
          }
          ?>
        ],
        datasets: [{
          label: 'Jumlah Aduan ',
          // backgroundColor: '#ADD8E6',
          // borderColor: '##93C3D2',
          backgroundColor: ['rgb(252, 3, 3)', 'rgb(255, 99, 132)', 'rgb(252, 165, 3)', 'rgb(56, 86, 255, 0.87)', 'rgb(60, 179, 113)'],
          // borderColor: ['rgb(255, 99, 132)'],
          data: [
            <?php
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
  </script>

  <script type="text/javascript">
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [
          <?php
          if (count($piechart) > 0) {
            foreach ($piechart as $data) {
              if ($data->kategori_laporan == 1)
                echo "'" . "Infrastruktur " . "',";
              else
                echo "'" . "Non-Infrastruktur " . "',";
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
            if (count($piechart) > 0) {
              foreach ($piechart as $data) {
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
    var ctx = document.getElementById('myPieChart2').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [
          <?php
          if (count($piechart2) > 0) {
            foreach ($piechart2 as $data) {
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
            if (count($piechart2) > 0) {
              foreach ($piechart2 as $data) {
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
    var ctx = document.getElementById('myDoughnutChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: [
          <?php
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
            <?php
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
          <?php
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
            <?php
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
  </script>

</body>

</html>