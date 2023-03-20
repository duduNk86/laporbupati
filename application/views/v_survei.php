<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?=$title;?></title>
<link href="<?= base_url('theme/');?>images/Lambang Wonosobo.png" rel="shortcut icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
 
<!-- costum css -->
<style>     
        body{
            background: #fff;
            padding-top: 2vh;  
        }
        
        form{
            background: #a60d0d;
        }
        
        .form-container{
        color: white;
            border-radius: 10px;
            padding: 30px;
        }

        /* not active */
        .nav-pills .nav-link:not(.active) {
            background-color: #fff;
            color: black;
        }

        /* active*/
        .nav-pills .nav-link {
            background-color: rgba(0, 255, 0, 0.5);
            color: white;
        }
</style>

</head>
  
<body style="background-image: url(<?php echo base_url().'assets/frontend_aduan/images/formaduan.png'?>);">
    <section class="container-fluid">
    <?= $script_captcha; ?>
        <section class="row justify-content-right">
            <section class="col-12 col-sm-6 col-md-4"  style="margin-bottom: 20px;">
            
            <div class="d-flex justify-content-center">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab1"><b>SURVEI</b></a>
                    </li>
                </ul>
            </div>  

                <div class="tab-content mt-3">
                    <!-- SURVEI LAYANAN LAPOR BUPATI -->
                    <div class="tab-pane show active" id="tab1" role="tabpanel">
                        <form class="form-container" action="<?php echo base_url().'user/aduan/kirim_survei'?>" method="post" enctype="multipart/form-data">
                            <div align="center">
                                <img src="<?php echo base_url(); ?>assets/frontend_aduan/images/logo_laporbup.jpg" style="width: 200px; height: 90px; margin-bottom: 20px;">
                            </div>
                            <h5 class="text-center font-weight-bold"> SURVEI LAYANAN LAPOR BUPATI </h5>
                            <p align="justify"><?php echo $this->session->flashdata('gagal');?></p>
                            <p align="justify"><?php echo $this->session->flashdata('sukses');?></p>
                            <div>
                                <label for="name" style="margin-top: 10px;"><b>Data Diri :</b></label>
                            </div>
                            <div class="form-group">
                                <label for="name">* Nama</label>
                                <input type="text" class="form-control" name="x_nama" required>
                            </div>
                            <div class="form-group">
                              <label for="">* Email <i>(Harus Aktif)</i></label>
                              <input type="email" class="form-control" name="x_email" required>
                            </div>
                            <div>
                                <label for="name" style="margin-top: 20px;"><b>Daftar Pertanyaan :</b></label>
                            </div>
                            <div class="form-group" align="justify">
                              <label for="">1. Darimana Anda tahu tentang layanan ini?</label>
                              <input type="text" class="form-control" name="x_pertanyaan1" required>
                            </div>
                            <div class="form-group" id="rating-ability-wrapper">
                                <label class="control-label" for="rating" align="justify">
                                <span class="field-label-header">2. Apakah Anda menyukai layanan ini?</span><br>
                                <span class="field-label-info"></span>
                                <input type="hidden" id="selected_rating1" name="selected_rating1" value="0" required="required">
                                </label>
                                <h4 class="bold rating-header" style="">
                                <span class="selected-rating1">0</span><small> / 5</small>
                                </h4>
                                <button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="1" id="rating-star1-1">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="2" id="rating-star1-2">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="3" id="rating-star1-3">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="4" id="rating-star1-4">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating1 btn btn-default btn-sm" data-attr="5" id="rating-star1-5">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="form-group" id="rating-ability-wrapper">
                                <label class="control-label" for="rating" align="justify">
                                <span class="field-label-header">3. Apakah layanan ini mudah digunakan?</span><br>
                                <span class="field-label-info"></span>
                                <input type="hidden" id="selected_rating2" name="selected_rating2" value="0" required="required">
                                </label>
                                <h4 class="bold rating-header" style="">
                                <span class="selected-rating2">0</span><small> / 5</small>
                                </h4>
                                <button type="button" class="btnrating2 btn btn-default btn-sm" data-attr="1" id="rating-star2-1">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating2 btn btn-default btn-sm" data-attr="2" id="rating-star2-2">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating2 btn btn-default btn-sm" data-attr="3" id="rating-star2-3">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating2 btn btn-default btn-sm" data-attr="4" id="rating-star2-4">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating2 btn btn-default btn-sm" data-attr="5" id="rating-star2-5">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="form-group" id="rating-ability-wrapper">
                                <label class="control-label" for="rating" align="justify">
                                <span class="field-label-header">4. Apakah layanan ini membantu penyelesaian masalah anda?</span>
                                <span class="field-label-info"></span>
                                <input type="hidden" id="selected_rating3" name="selected_rating3" value="0" required="required">
                                </label>
                                <h4 class="bold rating-header" style="">
                                <span class="selected-rating3">0</span><small> / 5</small>
                                </h4>
                                <button type="button" class="btnrating3 btn btn-default btn-sm" data-attr="1" id="rating-star3-1">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating3 btn btn-default btn-sm" data-attr="2" id="rating-star3-2">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating3 btn btn-default btn-sm" data-attr="3" id="rating-star3-3">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating3 btn btn-default btn-sm" data-attr="4" id="rating-star3-4">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating3 btn btn-default btn-sm" data-attr="5" id="rating-star3-5">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="form-group" id="rating-ability-wrapper">
                                <label class="control-label" for="rating" align="justify">
                                <span class="field-label-header">5. Apakah Anda akan merekomendasikan layanan ini kepada orang lain?</span><br>
                                <span class="field-label-info"></span>
                                <input type="hidden" id="selected_rating4" name="selected_rating4" value="0" required="required">
                                </label>
                                <h4 class="bold rating-header" style="">
                                <span class="selected-rating4">0</span><small> / 5</small>
                                </h4>
                                <button type="button" class="btnrating4 btn btn-default btn-sm" data-attr="1" id="rating-star4-1">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating4 btn btn-default btn-sm" data-attr="2" id="rating-star4-2">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating4 btn btn-default btn-sm" data-attr="3" id="rating-star4-3">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating4 btn btn-default btn-sm" data-attr="4" id="rating-star4-4">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating4 btn btn-default btn-sm" data-attr="5" id="rating-star4-5">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="form-group">
                              <label for="">6. Kritik dan Saran Anda:</label>
                              <textarea class="form-control" rows="3" name="x_kritik_saran"></textarea>
                            </div>
                            <div class="form-group">
                                <div align="center">
                                    <?= $captcha; ?>
                                </div>
                            </div>
                            <button type="submit" style="background-color:white; margin-top: 10px; margin-bottom: 10px;" class="btn btn-block" title="Klik untuk mengirim Survei Anda!"><b><a style="color: red;">Kirim Jawaban !</a></b></button>
                        </form>
                    </div>
                </div>
            </section>
        </section>
    </section>

    <!-- MDB -->
    
 
    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan yang terakhir Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($){
    
            $(".btnrating1").on('click',(function(e) {
            
            var previous_value = $("#selected_rating1").val();
            
            var selected_value = $(this).attr("data-attr");
            $("#selected_rating1").val(selected_value);
            
            $(".selected-rating1").empty();
            $(".selected-rating1").html(selected_value);
            
            for (i = 1; i <= selected_value; ++i) {
            $("#rating-star1-"+i).toggleClass('btn-warning');
            $("#rating-star1-"+i).toggleClass('btn-default');
            }
            
            for (ix = 1; ix <= previous_value; ++ix) {
            $("#rating-star1-"+ix).toggleClass('btn-warning');
            $("#rating-star1-"+ix).toggleClass('btn-default');
            }
            
            }));
            
        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($){
    
            $(".btnrating2").on('click',(function(e) {
            
            var previous_value = $("#selected_rating2").val();
            
            var selected_value = $(this).attr("data-attr");
            $("#selected_rating2").val(selected_value);
            
            $(".selected-rating2").empty();
            $(".selected-rating2").html(selected_value);
            
            for (i = 1; i <= selected_value; ++i) {
            $("#rating-star2-"+i).toggleClass('btn-warning');
            $("#rating-star2-"+i).toggleClass('btn-default');
            }
            
            for (ix = 1; ix <= previous_value; ++ix) {
            $("#rating-star2-"+ix).toggleClass('btn-warning');
            $("#rating-star2-"+ix).toggleClass('btn-default');
            }
            
            }));
            
        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($){
    
            $(".btnrating3").on('click',(function(e) {
            
            var previous_value = $("#selected_rating3").val();
            
            var selected_value = $(this).attr("data-attr");
            $("#selected_rating3").val(selected_value);
            
            $(".selected-rating3").empty();
            $(".selected-rating3").html(selected_value);
            
            for (i = 1; i <= selected_value; ++i) {
            $("#rating-star3-"+i).toggleClass('btn-warning');
            $("#rating-star3-"+i).toggleClass('btn-default');
            }
            
            for (ix = 1; ix <= previous_value; ++ix) {
            $("#rating-star3-"+ix).toggleClass('btn-warning');
            $("#rating-star3-"+ix).toggleClass('btn-default');
            }
            
            }));
            
        });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($){
    
            $(".btnrating4").on('click',(function(e) {
            
            var previous_value = $("#selected_rating4").val();
            
            var selected_value = $(this).attr("data-attr");
            $("#selected_rating4").val(selected_value);
            
            $(".selected-rating4").empty();
            $(".selected-rating4").html(selected_value);
            
            for (i = 1; i <= selected_value; ++i) {
            $("#rating-star4-"+i).toggleClass('btn-warning');
            $("#rating-star4-"+i).toggleClass('btn-default');
            }
            
            for (ix = 1; ix <= previous_value; ++ix) {
            $("#rating-star4-"+ix).toggleClass('btn-warning');
            $("#rating-star4-"+ix).toggleClass('btn-default');
            }
            
            }));
            
        });
    </script>

    <script>
        (function() {
            var params = {},
                r = /([^&=]+)=?([^&]*)/g;

            function d(s) {
                return decodeURIComponent(s.replace(/\+/g, ' '));
            }

            var match, search = window.location.search;
            while (match = r.exec(search.substring(1))) {
                params[d(match[1])] = d(match[2]);

                if(d(match[2]) === 'true' || d(match[2]) === 'false') {
                    params[d(match[1])] = d(match[2]) === 'true' ? true : false;
                }
            }

            window.params = params;
        })();
    </script>

</body>
</html>