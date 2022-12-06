<?php
$pengguna_level=$this->session->userdata('pengguna_level');
if(empty($pengguna_level)){
   redirect ('home');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="refresh" content="600" />
    <title><?=$title;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Share+Tech+Mono">
    <style type="text/css">
        #clock {
            font-family: 'Share Tech Mono', monospace;
            color: #ffffff;
            text-align: center;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: #daf6ff;
            text-shadow: 0 0 20px rgba(10, 175, 230, 1),  0 0 20px rgba(10, 175, 230, 0);
        }
    </style>
        <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">


    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url().'assets/lapor/assets/css/theme-default.css'?>"/>'
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url().'assets/lapor/assets/css/custom.css'?>"/>
    <!-- EOF CSS INCLUDE -->
    <!-- START PLUGINS -->
    <script type="text/javascript" id="jquery" src="<?php echo base_url().'assets/lapor/assets/js/plugins/jquery/jquery.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/jquery/jquery-ui.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/bootstrap/bootstrap.min.js'?>"></script>
    </head>
    <body>
      <!-- <marquee behavior="scroll" direction="down" scrollamount="2"></marquee> -->
        <!-- START PAGE CONTAINER -->
        <div class="panel panel-primary">            
            <!-- PAGE CONTENT -->
            <div class="panel-body">
                <div class="page-content-wrap" style="font-size: medium;">
                    <!-- START WIDGETS -->
                    <div class="row">
                        <div class="col-md-3"><img src="<?php echo base_url().'assets/lapor/dashboardlapor.png'?>" width="600px" ></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        
                        <div class="col-md-3">
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-primary">
                                <div id="clock"><br>
                                    <p class="date" style="letter-spacing: 0.0em; font-size: 20px;">Lapor Bupati</p>
                                    <p class="date" style="letter-spacing: 0.1em; font-size: 15px;">{{ date }}</p>
                                    <p class="time" style="letter-spacing: 0.05em; font-size: 20px; padding: 5px 0;">{{ time }}</p>
                                </div>
                            </div>
                            <!-- END WIDGET CLOCK -->
                        </div>
                    </div>
                    <!-- END WIDGETS -->                    
                    <?php
                    $kode=2;
                    $hsl=$this->db->query("SELECT * FROM tbl_laporan where tayang='ya'");        
                    $jml_tayang=$hsl->num_rows();
                    $btl=$this->db->query("SELECT * FROM tbl_laporan where laporan_status='$kode' AND tayang='ya'");        
                    $jml_btl=$btl->num_rows();
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-colorful">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h4><b>PENGADUAN AKTIF  : <?php echo $jml_tayang;?> &nbsp;,&nbsp; BELUM TL : <?php echo $jml_btl;?></b> </h4>
                                    </div>
                                    <ul class="panel-controls" style="margin-top: 1px;">
                                        @LaporBupati
                                        <a class="btn btn-success btn-flat" href="<?php echo base_url().'admin/administrator/logout'?>"></span> Logout</a>
                                    </ul> 
                                        
                                </div>
                                
                                <div class="panel-body padding-0">
                                    <div id="wrapper">
                                        <div id="carousel">
                                            <?php
                                            $no=0;
                                            foreach ($tayang->result_array() as $i) :
                                            $no++;
                                            $nomor=$i['nomor'];
                                            $id=$i['id'];
                                            $id_pelapor=$i['id_pelapor'];
                                            $id_kepada=$i['id_kepada'];
                                            $ditujukan_kepada=$i['ditujukan_kepada'];
                                            $id_penginput=$i['id_penginput'];
                                            $penginput=$i['penginput'];
                                            $kategori_laporan=$i['kategori_laporan'];
                                            $judul_laporan=$i['judul_laporan'];
                                            $lokasi=$i['lokasi'];
                                            $isi_laporan=$i['isi_laporan'];
                                            $nama=$i['nama'];
                                            $alamat=$i['alamat'];
                                            $tanggal=$i['tanggal_laporan'];
                                            $laporan_status=$i['laporan_status'];
                                            $tindaklanjut=$i['tindaklanjut'];
                                            ?>
                                            <div class="item panel panel-colorful">
                                                <div>
                                                    <div class="panel-heading">
                                                    <h4><center><span class="fa fa-user">&nbsp;<?php if ($kategori_laporan=="1") { echo "<b> Fisik </b>"; }else{echo "<b> Non Fisik </b>";} ?></span>&nbsp;<span class="fa fa-briefcase"></span>&nbsp;<b><?php echo $ditujukan_kepada;?> </b></center></h4>
                                                    </div>

                                                <div class="panel-body">
                                                    <div class="text">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="col-md-12">
                                                                <center><b>Dari</b></center><hr>
                                                                    <center><?php echo $nama;?></center>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="col-md-12">
                                                                <center><b>Waktu Masuk</b></center><hr>
                                                                    <center><?php echo $tanggal;?></center>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="col-md-12">
                                                                <center><b>Aduan</b></center><hr>
                                                                <center>
                                                                    <?php echo $judul_laporan;?></center>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                    <div class="col-md-6">
                                                                            <center><b>Keterangan</b><hr>
                                                                            <b><?php if ($laporan_status=="1") { ?>
                                                                            <span class="label label-success">Verifikasi</span>
                                                                            <?php }else if ($laporan_status=="2") { ?>
                                                                                <span class="label label-danger">Belum Proses</span>
                                                                            <?php }else if ($laporan_status=="3") { ?>
                                                                                <span class="label label-info">Selesai</span>
                                                                                <?php } ?>
                                                                            </b></center>
                                                                    </div>   
                                                                    <div class="col-md-6">
                                                                    <b>
                                                                    <center>Detail<hr>
                                                                    <?php if ($laporan_status=="1") { ?>
                                                                            <a href="<?= base_url('home/detail/').$id;?>" class="label label-success"><?php echo 'View';?></a>
                                                                            <?php }else if ($laporan_status=="2") { ?>
                                                                                <a href="<?= base_url('home/detail/').$id;?>" class="label label-danger"><?php echo 'View';?></a>
                                                                            <?php }else if ($laporan_status=="3") { ?>
                                                                                <a href="<?= base_url('home/detail/').$id;?>" class="label label-info"><?php echo 'view';?></a>
                                                                                <?php } ?>
                                                                            </b></center></center>
                                                                    
                                                                    </div>                             
                                                            </div>
                                                        </div>                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
           <h4> <center> Dashboard Lapor Bupati-@msyon</center><h4>
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
            setTimeout(function(){
        window.location.reload(1);
        }, 500000);
        </script>
        <script type='text/javascript' src="<?php echo base_url().'assets/lapor/assets/js/plugins/icheck/icheck.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/scrolltotop/scrolltopcontrol.js'?>"></script>

        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/morris/raphael-min.js'?>"></script>
        <script type='text/javascript' src='<?php echo base_url().'assets/lapor/assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'?>'></script>
        <script type='text/javascript' src='<?php echo base_url().'assets/lapor/assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'?>'></script>
        <script type='text/javascript' src='<?php echo base_url().'assets/lapor/assets/js/plugins/bootstrap/bootstrap-datepicker.js'?>'></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/owl/owl.carousel.min.js'?>"></script>

        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/moment.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins/daterangepicker/daterangepicker.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/jquery.carouFredSel-6.2.1-packed.js'?>"></script>
        <!-- END THIS PAGE PLUGINS-->  

        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/demo_dashboard.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/plugins.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/actions.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/lapor/assets/js/myjs.js'?>"></script>        
        <!-- END TEMPLATE -->
    </body>
</html>






