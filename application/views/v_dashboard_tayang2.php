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

  <link href="<?= base_url('theme/'); ?>images/Lambang Wonosobo.png" rel="shortcut icon" />
  <!-- END META SECTION -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Share+Tech+Mono">
  <style type="text/css">
    #clock {
      font-family: 'Share Tech Mono', monospace;
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

  <!-- <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:-10pt;margin-bottom: -15pt;">
    <li class="nav-item">
      <a class="nav-link" href="< ?php echo base_url() . 'home/view' ?>">Statistik</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="< ?php echo base_url() . 'home/view2' ?>">Pengaduan Aktif</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="< ?php echo base_url() . 'admin/administrator/logout' ?>">Logout</a>
    </li>
  </ul> -->

  <div class="panel panel-primary">
    <!-- PAGE CONTENT -->
    <div class="panel-body">
      <div class="page-content-wrap" style="font-size: medium;">
        <!-- TITLE CONTENT -->
        <div class="row">
          <div class="col-md-12">
            <!-- <div class="text-center" style="margin-left: -30px;"><img src="< ?php echo base_url() . 'assets/lapor/dashboard-title.png' ?>" width="1920px" height="130px"> -->
            <div class="text-center" style="margin-left: -30px;"><img src="<?php echo base_url() . 'assets/lapor/dashboard-title.png' ?>" width="1530px" height="115px">
              <div id="clock"><br>
                <p class="date" style="color:black;letter-spacing: 0.1em; font-size: 14px;">{{ date }}</p>
                <p class="time" style="color:red;letter-spacing: 0.05em; font-size: 24px; padding: 2px 0;">{{ time }}</p>
              </div>
            </div>
          </div>
        </div>
        <!-- END TITLE CONTENT -->

        <!-- START WIDGETS -->
        <!-- <div class="row">
          <div class="col-md-9"><img src="< ?php echo base_url() . 'assets/lapor/dashboardlapor-v2.png' ?>" width="600px" height="110px"></div> -->
        <!-- <div class="col-md-3"></div>
                        <div class="col-md-3"></div> -->

        <!-- <div class="col-md-3"> -->
        <!-- START WIDGET CLOCK -->
        <!-- <div class="widget widget-primary">
              <div id="clock"><br>
                <p class="date" style="letter-spacing: 0.0em; font-size: 16px;">LAPORBUP WONOSOBO</p>
                <p class="date" style="letter-spacing: 0.1em; font-size: 14px;">{{ date }}</p>
                <p class="time" style="letter-spacing: 0.05em; font-size: 16px; padding: 5px 0;">{{ time }}</p>
              </div>
            </div> -->
        <!-- END WIDGET CLOCK -->
        <!-- </div> -->
        <!-- </div> -->
        <!-- END WIDGETS -->
        <!-- < ?php
                    $kode=2;
                    $hsl=$this->db->query("SELECT * FROM tbl_laporan where tayang='ya'");        
                    $jml_tayang=$hsl->num_rows();
                    $btl=$this->db->query("SELECT * FROM tbl_laporan where laporan_status='$kode' AND tayang='ya'");        
                    $jml_btl=$btl->num_rows();
                    ?> -->
        <div class="row">
          <!-- <div class="col-md-12" style="margin-top:5px;margin-bottom:15px;"> -->
          <div class="col-md-12" style="margin-left:-40px;margin-top:5px;margin-bottom:15px;">
            <div class="col-md-5">
            </div>
            <div class="col-md-4 justify-content-center">
              <a href="<?php echo base_url() . 'home/view' ?>" style="color:black">Statistik</a> &nbsp;&nbsp; | &nbsp;&nbsp;
              <a href="<?php echo base_url() . 'home/view2' ?>" class="btn btn-danger btn-md" style="font-size:12pt"><i class="fa fa-bullhorn"></i> Pengaduan Aktif</a> &nbsp;&nbsp; | &nbsp;&nbsp;
              <a href="<?php echo base_url() . 'admin/administrator/logout' ?>" style="color:black">Logout</a>
            </div>
            <div class="col-md-3">
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-colorful">
              <div class="panel-heading">
                <div class="panel-title-box">
                  <h4><b>PENGADUAN AKTIF : <?php echo $jml_tayang; ?> &nbsp;,&nbsp; SEDANG PROSES TL : <?php echo $jml_prosestl; ?></b> </h4>
                </div>
              </div>
              <div class="panel-body padding-0">
                <div id="wrapper">
                  <div id="carousel">
                    <?php
                    $no = 0;
                    foreach ($tayang->result_array() as $i) :
                      $no++;
                      $nomor = $i['nomor'];
                      $id = $i['id'];
                      $id_pelapor = $i['id_pelapor'];
                      $id_kepada = $i['id_kepada'];
                      $ditujukan_kepada = $i['ditujukan_kepada'];
                      $id_penginput = $i['id_penginput'];
                      $penginput = $i['penginput'];
                      $kategori_laporan = $i['kategori_laporan'];
                      $judul_laporan = $i['judul_laporan'];
                      $lokasi = $i['lokasi'];
                      $isi_laporan = $i['isi_laporan'];
                      $sumber_aduan = $i['sumber_aduan'];
                      // $nama=$i['nama'];
                      // $alamat=$i['alamat'];
                      $tanggal = $i['tanggal_laporan'];
                      $laporan_status = $i['laporan_status'];
                      $tindaklanjut = $i['tindaklanjut'];
                      $rating_jawaban = $i['rating_jawaban'];
                    ?>
                      <div class="item panel panel-colorful">
                        <div>
                          <div class="panel-heading">
                            <h4>
                              <center><span class="fa fa-user">&nbsp;<?php if ($kategori_laporan == "1") {
                                                                        echo "<b> Infrastruktur </b>";
                                                                      } else {
                                                                        echo "<b> Non-Infrastruktur </b>";
                                                                      } ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;<span class="fa fa-briefcase"></span>&nbsp;<b><?php echo $ditujukan_kepada; ?> </b></center>
                            </h4>
                          </div>

                          <div class="panel-body">
                            <div class="text">
                              <div class="row">
                                <div class="col-md-2">
                                  <div class="col-md-12">
                                    <center><b>Tiket Aduan</b></center>
                                    <hr>
                                    <center style="color:red;"><b><?php echo "LB" . $sumber_aduan . "-" . $id; ?></b></center>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="col-md-12">
                                    <center><b>Tanggal Masuk</b></center>
                                    <hr>
                                    <center>
                                      <?php
                                      $tanggal_awal = $tanggal;
                                      $tanggal_baru = date('d M Y | H:i:s', strtotime($tanggal_awal));
                                      echo $tanggal_baru;
                                      ?>
                                    </center>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="col-md-12">
                                    <center><b>Aduan</b></center>
                                    <hr>
                                    <center>
                                      <?php echo $judul_laporan; ?></center>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="col-md-4">
                                    <center><b>Keterangan</b>
                                      <hr>
                                      <b><?php if ($laporan_status == "1") { ?>
                                          <span class="label label-danger">Verifikasi</span>
                                        <?php } else if ($laporan_status == "2") { ?>
                                          <span class="label label-warning">Sedang Proses</span>
                                        <?php } else if ($laporan_status == "3") { ?>
                                          <span class="label label-success">Selesai</span>
                                        <?php } ?>
                                      </b>
                                    </center>
                                  </div>
                                  <div class="col-md-4">
                                    <center><b>Rating TL</b></center>
                                    <hr>
                                    <center>
                                      <?php
                                      if ($rating_jawaban == 0) {
                                        echo "<b style='color:gold;'><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
                                      } else if ($rating_jawaban == 1) {
                                        echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
                                      } else if ($rating_jawaban == 2) {
                                        echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
                                      } else if ($rating_jawaban == 3) {
                                        echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i></b>";
                                      } else if ($rating_jawaban == 4) {
                                        echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i></b>";
                                      } else if ($rating_jawaban == 5) {
                                        echo "<b style='color:gold;'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></b>";
                                      }
                                      ?>
                                    </center>
                                  </div>
                                  <div class="col-md-4">
                                    <b>
                                      <center>Detail
                                        <hr>
                                        <?php if ($laporan_status == "1") { ?>
                                          <a href="<?= base_url('home/detail/') . $id; ?>" class="label label-danger" target="_blank"><?php echo 'View'; ?></a>
                                        <?php } else if ($laporan_status == "2") { ?>
                                          <a href="<?= base_url('home/detail/') . $id; ?>" class="label label-warning" target="_blank"><?php echo 'View'; ?></a>
                                        <?php } else if ($laporan_status == "3") { ?>
                                          <a href="<?= base_url('home/detail/') . $id; ?>" class="label label-success" target="_blank"><?php echo 'view'; ?></a>
                                        <?php } ?>
                                    </b></center>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.min.js"></script>
    <script type="text/javascript">
      var clock = new Vue({
        el: "#clock",
        data: {
          time: "",
          date: ""
        }
      });

      var week = ["MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUM'AT", "SABTU"];
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