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
    <title><?echo $title;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>
    
    <?php
    function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
    }
    
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
          Data Aduan dengan Status : <b style="color:blue;">Ditolak</b>
          <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('admin/laporan');?>">Aduan Ditolak</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box">
                  <div class="box-header">
                    <!-- <a class="btn btn-success btn-circle" href="< ?php echo base_url().'admin/laporan/add_laporan'?>"><span class="fa fa-plus"></span>&nbsp; Input</a> -->
                    <!-- <a class="btn btn-danger btn-flat" href="< ?php echo base_url().'admin/laporan/add_tambahan'?>"><span class="fa fa-plus"></span> Tambahan</a> -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tbl_laporan" class="table table-striped" style="font-size:13px;">
                      <thead>
                        <tr>
                          <th style="text-align:center;">No</th>
                          <th style="text-align:center;">Foto</th>
                          <th style="text-align:center;">OPD</th>
                          <th style="text-align:center;">Rincian</th>
                          <th style="text-align:center;">Nama</th>
                          <th style="text-align:center;">HP/Sumber</th>
                          <th style="text-align:center;">Tanggal</th>
                          <th style="text-align:center;" title="Status Aduan / Durasi TL / Rating Jawaban">Sts/Dur/Rat</th>
                          <th style="text-align:center;">Tayang</th>
                          <th style="text-align:center;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="tbody_tbl_laporan">

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
     
      <!--- Awal Modal View Laporan--->
      <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h3 class="modal-title" id="myModalLabel">Rincian Aduan</h3>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_view'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
               
              <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:blue; font-size:21px;"><b>Identitas Pelapor</b></p></h4>
              <hr>

              <div class="form-group">
                  <input type="hidden" name="xkode_view" id="xkode_view">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_nama_view" id="x_nama_view" class="form-control pull-right datepicker4" disabled required>
                  </div>
                </div>
     
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_nik_view" id="x_nik_view" class="form-control pull-right datepicker4" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_alamat_view" id="x_alamat_view" class="form-control pull-right datepicker4" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_email_view" class="form-control" id="x_email_view" placeholder="email" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">HP</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_hp_view" id="x_hp_view" class="form-control pull-right datepicker4" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sumber Kanal Aduan</label>
                  <div class="col-sm-7">                   
                    <select class="form-control select2" name="x_sumberaduan_view" disabled required>
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

                <hr>
                <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:red; font-size:21px;"><b>Materi Aduan</b></p></h4>
                <hr>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_kategori_laporan_view" style="width: 100%;" disabled required>
                        <option value="">- Pilih -</option>
                        <option value="1">Fisik</option>
                        <option value="2">Non Fisik</option>        
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sub Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_subkategori_laporan_view" id="x_subkategori_laporan_view" style="width: 100%;" disabled required>
                        <option value="">- Pilih -</option>
                        <?php
                          $no=0;
                          foreach ($subkatall->result_array() as $i) :
                          $no++;
                          $subkategori_id=$i['subkategori_id'];
                          $subkategori_nama=$i['subkategori_nama'];
                        ?>
                        <option value="<?php echo $subkategori_id;?>"><?php echo $subkategori_nama;?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Topik</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_topik_laporan_view"  class="form-control" id="x_topik_laporan_view" placeholder="Topik Aduan" disabled required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">OPD Tujuan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode_view" id="kode">
                    <input type="text" name="x_ditujukan_kepada_view"  class="form-control" id="x_ditujukan_kepada_view" placeholder="-" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tgl. Aduan Masuk</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_tanggal_laporan_view" class="form-control"  id="x_tanggal_laporan_view" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" id="kode">
                    <input type="text" name="x_judul_laporan_view"  class="form-control" id="x_judul_laporan_view" placeholder="Judul Aduan" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isi_laporan_view" id="x_isi_laporan_view" placeholder="Isi Aduan ..." disabled required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_lokasi_view" id="x_lokasi_view" class="form-control pull-right datepicker4" disabled required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Foto Aduan</label>
                  <div class="col-sm-7" id="foto_view" name="foto_view">
                     <img src="">
                  </div>
                </div>

                <hr>
                <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:forestgreen; font-size:21px;"><b>Tindak Lanjut</b></p></h4>
                <hr>
                
                <div class="form-group">
                    <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="x_laporan_status_view" style="width: 100%;" required="required" disabled>
                            <option value="">- Pilih -</option>
                            <option value="1">verifikasi</option>
                            <option value="2">Sedang Proses</option>
                            <option value="3">Selesai</option>
                            <option value="99">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_status_view" disabled class="form-control"  id="x_keterangan_status_view" placeholder="Keterangan" required disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tindak Lanjut (TL)</label>
                  <div class="col-sm-7">
                    <textarea name="x_tindaklanjut_view" class="form-control" id="x_tindaklanjut_view" rows="3" disabled></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tgl. TL</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_tanggal_tindaklanjut_view"  id="x_tanggal_tindaklanjut_view" class="form-control pull-right datepicker4" required disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan TL</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_tindaklanjut_view" class="form-control" id="x_keterangan_tindaklanjut_view" placeholder="..." disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Foto TL</label>
                  <div class="col-sm-7" id="foto_tindaklanjut_view" name="foto_tindaklanjut_view">
                     <img src="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Durasi TL</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_durasi_tindaklanjut_view"  id="x_durasi_tindaklanjut_view" class="form-control pull-right datepicker4" required disabled>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Rating Jawaban</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_rating_jawaban_view"  id="x_rating_jawaban_view" class="form-control pull-right" required>
                  </div>
                </div> -->

                <div class="form-group">
                    <label for="inputUserName" class="col-sm-4 control-label">Rating Jawaban</label>
                    <div class="col-sm-7">
                        <output for="x_rating_jawaban_view" id="rating" name="x_rating_jawaban_view"></output>
                        <input type="range" min="0" max="5" value="" name="x_rating_jawaban_view" id="x_rating_jawaban_view" oninput="nilai(value)" style="width: 100%;">
                        
                          <script>
                              function nilai(x_rating_jawaban_view) {
                                  document.querySelector('#rating').value = x_rating_jawaban_view;
                              }
                          </script>

                        <!-- <select class="form-control select2" name="x_rating_jawaban_view" id="x_rating_jawaban_view" style="width: 25%;">
                            <option value="0">- Pilih -</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select> -->
                    </div>
                </div>                

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o">&nbsp; Simpan</i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Akhir modal view Laporan -->

      <!-- modal Edit Laporan -->
      <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h3 class="modal-title" id="myModalLabel">Update Aduan</h3>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_laporan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                
                <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:blue; font-size:21px;"><b>Identitas Pelapor</b></p></h4>
                <hr>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_nama_edit" id="x_nama_edit" class="form-control pull-right datepicker4">
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_nik_edit" id="x_nik_edit" class="form-control pull-right datepicker4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_alamat_edit" id="x_alamat_edit" class="form-control pull-right datepicker4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_email_edit" id="x_email_edit" class="form-control pull-right datepicker4">
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">HP</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_hp_edit" id="x_hp_edit" class="form-control pull-right datepicker4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sumber Kanal Aduan</label>
                  <div class="col-sm-7">                   
                      <select class="form-control select2" name="x_sumberaduan_edit" required>
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

                <hr>
                <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:red; font-size:21px;"><b>Materi Aduan</b></p></h4>
                <hr>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_kategori_laporan_edit" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        <option value="1">Fisik</option>
                        <option value="2">Non Fisik</option>        
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sub Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_subkategori_laporan_edit" id="x_subkategori_laporan_edit" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        <?php
                          $no=0;
                          foreach ($subkatall->result_array() as $i) :
                          $no++;
                          $subkategori_id=$i['subkategori_id'];
                          $subkategori_nama=$i['subkategori_nama'];
                        ?>
                        <option value="<?php echo $subkategori_id;?>"><?php echo $subkategori_nama;?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Topik</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_topik_laporan_edit"  id="x_topik_laporan_edit" class="form-control pull-right" placeholder="Topik Aduan" required>
                  </div>
                </div>

                <div class="form-group">
                  <input type="hidden" name="xkode_edit" id="xkode_edit">
                  <label for="inputUserName" class="col-sm-4 control-label">OPD Tujuan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="x_id_kepada_edit"  id = "x_id_kepada_edit" required>
                    <input type="text" name="x_ditujukan_kepada_edit" disabled class="form-control"  id = "x_ditujukan_kepada_edit" placeholder="Kepada" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tgl. Aduan</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_tanggal_laporan_edit"  id="x_tanggal_laporan_edit" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_judul_laporan_edit"  class="form-control" id="x_judul_laporan_edit" placeholder="Judul Aduan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isi_laporan_edit" id="x_isi_laporan_edit" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_lokasi_edit"  id="x_lokasi_edit" class="form-control pull-right datepicker4" required>
                  </div>
                </div>
                          
                <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Upload / Ubah Foto Aduan</label>
                    <div class="col-sm-7">
                    <input type="file" name="x_foto_edit">
                    <input type="hidden" name="x_foto">
                    </div>
                </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o"></i>&nbsp; Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--- Akhir Modal Edit Laporan--->

      <!-- Awal Modal Input TL -->
      <div class="modal fade" id="ModalInputtl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h3 class="modal-title" id="myModalLabel">Input TL by Admin</h3>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/input_tindaklanjut'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                
                <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:forestgreen; font-size:21px;"><b>Tindak Lanjut</b></p></h4>
                <hr>

                <div class="form-group">
                  <input type="hidden" name="xkode_inputtl" id="xkode_inputtl">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_laporan_status_inputtl" style="width: 100%;" >
                        <option value="">- Pilih -</option>
                        <option value="1">Verifikasi</option>
                        <option value="2">Sedang Proses</option>
                        <option value="3">Selesai</option>
                        <option value="99">Ditolak</option>           
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_status_inputtl" class="form-control" id="x_keterangan_status_inputtl" placeholder="Keterangan">
                  </div>
                </div>
     
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tindak Lanjut (TL)</label>
                  <div class="col-sm-7">
                    <textarea name="x_tindaklanjut_inputtl" class="form-control" id="x_tindaklanjut_inputtl" rows="3"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan TL</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_tindaklanjut_inputtl" class="form-control" id="x_keterangan_tindaklanjut_inputtl" placeholder="...">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tgl. TL</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_tanggal_tindaklanjut_inputtl"  id="x_tanggal_tindaklanjut_inputtl" class="form-control pull-right datepicker4" required readonly>
                  </div>
                </div>

                <div class="form-group">
                    <label for="inputUserName" class="col-sm-4 control-label">Upload / Ubah Foto TL</label>
                    <div class="col-sm-7">
                    <input type="file" name="x_foto_tindaklanjut_inputtl">
                    <input type="hidden" name="x_foto_tindaklanjut">
                    </div>
                </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o"></i>&nbsp; Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Akhir Modal Input TL -->

      <!-- Awal Modal Copy Laporan -->
      <div class="modal fade" id="ModalCopy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h3 class="modal-title" id="myModalLabel">Duplikat Aduan</h3>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/copy_laporan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                
                <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:blue; font-size:21px;"><b>Identitas Pelapor</b></p></h4>
                <hr>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_nama_copy" id="x_nama_copy" class="form-control pull-right datepicker4">
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_nik_copy" id="x_nik_copy" class="form-control pull-right datepicker4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_alamat_copy" id="x_alamat_copy" class="form-control pull-right datepicker4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_email_copy" id="x_email_copy" class="form-control pull-right datepicker4">
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">HP</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_hp_copy" id="x_hp_copy" class="form-control pull-right datepicker4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sumber Kanal Aduan</label>
                  <div class="col-sm-7">                   
                      <select class="form-control select2" name="x_sumberaduan_copy" required>
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

                <hr>
                <h4 class="modal-title" id="myModalLabel" align="center"><p style="color:red; font-size:21px;"><b>Materi Aduan</b></p></h4>
                <hr>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_kategori_laporan_copy" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        <option value="1">Fisik</option>
                        <option value="2">Non Fisik</option>        
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sub Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_subkategori_laporan_copy" id="x_subkategori_laporan_copy" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        <?php
                          $no=0;
                          foreach ($subkatall->result_array() as $i) :
                          $no++;
                          $subkategori_id=$i['subkategori_id'];
                          $subkategori_nama=$i['subkategori_nama'];
                        ?>
                        <option value="<?php echo $subkategori_id;?>"><?php echo $subkategori_nama;?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Topik</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_topik_laporan_copy"  id="x_topik_laporan_copy" class="form-control pull-right" placeholder="Topik Aduan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">OPD Tujuan</label>
                  <div class="col-sm-7">
                    <select class="form-control select2" name="x_ditujukan_kepada_copy" style="width: 100%;" required>
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

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tgl. Aduan</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_tanggal_laporan_copy"  id="x_tanggal_laporan_copy" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_judul_laporan_copy"  class="form-control" id="x_judul_laporan_copy" placeholder="Judul Aduan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isi_laporan_copy" id="x_isi_laporan_copy" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_lokasi_copy"  id="x_lokasi_copy" class="form-control pull-right datepicker4" required>
                  </div>
                </div>
                          
                <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Upload / Ubah Foto Aduan</label>
                    <div class="col-sm-7">
                    <input type="file" name="filefoto">
                    <!-- <input type="hidden" name="x_foto"> -->
                    </div>
                </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--- Akhir Modal Copy Laporan--->

      <!--Modal Hapus Laporan -->
      <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h3 class="modal-title" id="myModalLabel">Hapus Aduan</h3>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/hapus_laporan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="x_kode_hapus" id="x_kode_hapus"/>
                <input type="hidden" name="x_foto_hapus" id="x_foto_hapus"/>
                <p>Apakah Anda yakin mau menghapus Aduan dari <b name="x_nama_hapus"></b>?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger btn-circle" id="simpan"><i class="fa fa-trash-o"></i>&nbsp; Hapus</button>
              </div>
            </form>
          </div>
        </div>
      </div>

     <!-- Modal Teruskan -->
     <div class="modal fade" id="ModalTeruskan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h3 class="modal-title" id="myModalLabel">Teruskan Aduan</h3>
            </div>
            <form id="form_teruskan" class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_teruskan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="x_kode_teruskan" id="x_kode_teruskan">
                  <label for="inputUserName" class="col-sm-4 control-label">Teruskan Kepada</label>
                  <div class="col-sm-7">
                  <select class="form-control select2" name="x_id_kepada_teruskan" id="x_id_kepada_teruskan" style="width: 100%;" required>
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

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_judul_laporan_teruskan"  class="form-control" id="x_judul_laporan_teruskan" placeholder="Judul aduan" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isi_laporan_teruskan" id="x_isi_laporan_teruskan" disabled></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_status_teruskan" class="form-control" id="x_keterangan_status_teruskan" placeholder="Keterangan" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-circle" id="simpan"><i class="fa fa-paper-plane"></i>&nbsp; Teruskan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Kirim Notifikasi WA ke Pengadu -->
     <div class="modal fade" id="ModalNotifpengadu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h3 class="modal-title" id="myModalLabel">Kirim Notifikasi Whatsapp ke Pengadu</h3>
            </div>
            <form id="form_teruskan" class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_notifwapengadu'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="x_kode_notifwapengadu" id="x_kode_notifwapengadu">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_nama_notifwapengadu"  class="form-control" id="x_nama_notifwapengadu" placeholder="Nama Pengadu" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Whatsapp</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_nohp_notifwapengadu"  class="form-control" id="x_nohp_notifwapengadu" placeholder="Nomor Whatsapp" disabled>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-circle" id="simpan"><i class="fa fa-whatsapp"></i>&nbsp; Kirim Notifikasi</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- jQuery 2.2.3 -->
      <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
      <!-- jQuery 3.3.1 -->
      <!-- <script src="< ?php echo base_url().'assets/plugins/jQuery/jquery-3.3.1.js'?>"></script> -->
      <!-- Bootstrap 3.3.6 -->
      <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
      <!-- DataTables -->
      <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
      <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
      <!-- SlimScroll -->
      <script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
      <!-- AdminLTE App -->
      <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
      <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
      <!-- page script -->
      
    <script type="text/javascript">
	  $(document).ready(function(){
		tampil_data();	//pemanggilan fungsi tampil_data

    //fungsi tampil data
		function tampil_data(){
		    $.ajax({
		        type  : 'GET',
		        url   : '<?php echo base_url()?>admin/laporan/get_ditolak',
		        async : true,
		        dataType : 'json',
		        success : function(data){
              var base_urlx="<?php echo base_url('assets/images/')?>";
		            var html = '';
		            var i;
                var no=0;
		            for(i=0; i<data.length; i++){
                  var no = no+1;
                  var jenis = data[i].id_jenis;
                  if (jenis = 1) {
                     id_jenis ="Aduan";                     
                  }
                  var pemberitahuan = data[i].kirim_pemberitahuan;
                  if (pemberitahuan =='Ya'){
                    pemberitahuan_kirim = '';
                  }else{
                    pemberitahuan_kirim = '<a href="javascript:;" class="btn btn-info btn-xs item_kirim_pemberitahuan" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-envelope"> kirim email</span></a>';
                  }

                  var laporan = data[i].laporan_status;
                  if (laporan ==1){
                    //  laporan_status = '<span class="label label-success">Verifikasi</span>';
                     laporan_status = '<a href="javascript:;" data-toggle="tooltip" title="Aduan Belum Direspon, segera Teruskan ke OPD terkait" class="btn btn-danger btn-xs item_teruskan" data="'+data[i].id+'" style="width:90px;">Verifikasi</a>';
                  }else if(laporan ==2){
                    // laporan_status = '<span class="label label-danger">Sedang Proses</span>';
                    laporan_status = '<a href="#" data-toggle="tooltip" title="Aduan Sedang di Proses oleh OPD terkait" class="btn btn-warning btn-xs item_kirim_pemberitahuan" style="width:90px;">Sedang Proses</a>';
                  }else if(laporan ==99){
                    laporan_status = '<a href="javascript:;" data-toggle="tooltip" title="Teruskan Aduan ke OPD lain yang terkait" class="btn btn-info btn-xs item_teruskan" data="'+data[i].id+'" style="width:90px;">Ditolak</a>';
                    // laporan_status = '<span class="label label-warning">ditolak</span>';
                  }else{
                    // laporan_status = '<span class="label label-info">selesai</span>';
                    laporan_status = '<a href="javascript:;" data-toggle="tooltip" title="Lihat Rincian Aduan & Beri Rating Jawaban TL" class="btn btn-success btn-xs item_view" data="'+data[i].id+'" style="width:90px;">Selesai</a>';
                  }

                  var sumber = data[i].sumber_aduan;
                  if (sumber =='LB'){
                    sumber = 'Website Lapor Bupati';
                  }else if(sumber =='LG'){
                    sumber = 'Website Lapor Gubernur';
                  }else if(sumber =='SP'){
                    sumber = 'SP4N LAPOR';
                  }else if(sumber =='WA'){
                    sumber = 'Whatsapp Lapor Bupati';
                  }else if(sumber =='SM'){
                    sumber = 'SMS Lapor Bupati';
                  }else if(sumber =='IG'){
                    sumber = 'Instagram Lapor Bupati';
                  }else if(sumber =='FB'){
                    sumber = 'Facebook Lapor Bupati';
                  }else if(sumber =='TW'){
                    sumber = 'Twitter Lapor Bupati';
                  }else{
                    sumber = '';
                  }

                  var rating = data[i].rating_jawaban;
                  if (rating ==1){
                     rating = '<a href="javascript:;" style="color:gold;" title="1 Bintang" class="item_view" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
                  }else if(rating ==2){
                    rating = '<a href="javascript:;" style="color:gold;" title="2 Bintang" class="item_view" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
                  }else if(rating ==3){
                    rating = '<a href="javascript:;" style="color:gold;" title="3 Bintang" class="item_view" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
                  }else if(rating ==4){
                    rating = '<a href="javascript:;" style="color:gold;" title="4 Bintang" class="item_view" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></a>';
                  }else if(rating ==5){
                    rating = '<a href="javascript:;" style="color:gold;" title="5 Bintang" class="item_view" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a>';
                  }else{
                    rating = '<a href="javascript:;" style="color:gold;" title="0 Bintang" class="item_view" data="'+data[i].id+'"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></a>';
                  }

                  // Durasi TL
                  var awal  = new Date(data[i].tanggal_laporan);
                  var akhir = new Date(data[i].tanggal_tindaklanjut);

                  selisihDetik = Math.floor((akhir - (awal))/1000);
                  selisihMenit = Math.floor(selisihDetik/60);
                  selisihJam = Math.floor(selisihMenit/60);
                  selisihHari = Math.floor(selisihJam/24);

                  jamTl = selisihJam-(selisihHari*24);
                  menitTl = selisihMenit-(selisihHari*24*60)-(jamTl*60);
                  detikTl = selisihDetik-(selisihHari*24*60*60)-(jamTl*60*60)-(menitTl*60);

                  var fileName = data[i].foto;
                  var fileExtension = fileName.split('.').pop(); 
                  if (fileExtension == "pdf") {
                    // tampilimagefoto = '<a href="'+ base_urlx + data[i].foto +'" style="width:90px;">view Pdf</a>';
                    tampilimagefoto = '<embed src="'+ base_urlx + data[i].foto +'" width="90px" height="90px" /> <center><a href="'+ base_urlx + data[i].foto +'" style="width:90px;">view Pdf</a></center>';
                    
                    // tampilimagefoto = '<embed type="application/pdf" src="'+ base_urlx + data[i].foto +'" style="width:90px;">view</embed>';
                    // <embed type="application/pdf" src="contoh.pdf" width="600" height="400"></embed>
                  }else{
                    tampilimagefoto = '<img src="'+ base_urlx + data[i].foto +'" style="width:90px;">';
                  }

		                html += '<tr>'+
                                  '<td>'+no+'</td>'+
                                  
                                  // '<td><img src="'+ base_urlx + data[i].foto +'" style="width:90px;" alt="no img"></td>'+
                                  '<td>'+tampilimagefoto+'</td>'+
                                  '<td>'+data[i].ditujukan_kepada+'</td>'+
                                  '<td style="text-align:justify;">'+data[i].isi_laporan+'</td>'+
                                  '<td>'+data[i].nama+'</td>'+
                                  '<td>'+data[i].hp+'<br>'+sumber+'</td>'+
                                  '<td>'+data[i].tanggal_laporan+'</td>'+
                                  '<td style="text-align:center;">'+laporan_status+'<br><br>'+'<b>'+selisihHari +'</b>'+ " hari " +'<b>'+ jamTl +'</b>'+ " jam " +'<b>'+ menitTl +'</b>'+ " menit " +'<b>'+ detikTl +'</b>'+ " detik"
                                  +'<br><br>'+rating+'</td>'+
                                  // pemberitahuan_kirim+'</td>'+
                                  '<td style="text-align:center;">'+'<a href="javascript:;" class="btn btn-primary btn-xs item_tayang" data="'+data[i].id+'">'+data[i].tayang+'</a>'+'</td>'+
                                  
                                  // <div class="btn-group" role="group">
                                  //   <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  //     Dropdown
                                  //   </button>
                                  //   <div class="dropdown-menu">
                                  //     <a class="dropdown-item" href="#">Dropdown link</a>
                                  //     <a class="dropdown-item" href="#">Dropdown link</a>
                                  //   </div>
                                  // </div>

                                  '<td style="text-align:left;">'+
                                      '<div class="btn-group" role="group">'+
                                        '<button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-gear"></span></button>'+
                                        '<div class="dropdown-menu">'+
                                          '<a href="javascript:;" data-toggle="tooltip" title="Rincian Aduan & Rating" class="btn btn-success btn-xs item_view" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-eye"> View</span></a><br>'+
                                          '<a href="javascript:;" data-toggle="tooltip" title="Edit Aduan" class="btn btn-warning btn-xs item_edit" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-pencil"> Edit</span></a><br>'+
                                          '<a href="javascript:;" data-toggle="tooltip" title="Input TL by Admin" class="btn btn-secondary btn-xs item_inputtl" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-pencil"> Input TL</span></a><br>'+
                                          '<a href="javascript:;" data-toggle="tooltip" title="Hapus Aduan" class="btn btn-danger btn-xs item_hapus" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-trash"> Hapus</span></a><br>'+
                                          '<a href="<?php echo base_url('home/detail/');?>'+data[i].id+'" data-toggle="tooltip" title="Lihat Nomor Tiket Aduan" class="btn btn-primary btn-xs item_detail" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-arrow-right"> Tracking</span></a><br>'+
                                          '<a href="javascript:;" data-toggle="tooltip" title="Teruskan Aduan ke OPD" class="btn btn-info btn-xs item_teruskan" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-paper-plane"> Teruskan</span></a><br>'+
                                          '<a href="javascript:;" data-toggle="tooltip" title="Kirim Notifikasi Progres TL ke Pelapor" class="btn btn-dark btn-xs item_notif_pengadu" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-whatsapp"> Tracking</span></a><br>'+
                                          '<a href="javascript:;" data-toggle="tooltip" title="Copy Aduan" class="btn btn-warning btn-xs item_copy" data="'+data[i].id+'" style="width:90px;"><span class="fa fa-copy"> Duplikat</span></a><br>'+
                                        '</div>'+
                                      '</div>'+
                                      //pemberitahuan_kirim+
                                  '</td>'+
		                        '</tr>';
		            }
                    $('#tbody_tbl_laporan').html(html);
                    		// tambahan
                    $('#tbl_laporan').DataTable({
                      "paging": true,
                      "lengthChange": true,
                      "searching": true,
                      "ordering": true,
                      "info": true,
                      "autoWidth": true,
                      "scrollX": true
                      });
                    // tutuptambahan
		        }
		    });
		}

    // View Aduan
		$('#tbl_laporan').on('click','.item_view',function(){
            var id=$(this).attr('data');
            var gbr1='';
            var gbr2='';
            var base_urlx="<?php echo base_url('assets/images/')?>";
      
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(i, field){
                    var laporan_status = data[i].laporan_status;
                    if (laporan_status == 1) {
                      laporan_status ="Verifikasi";
                    }
                    else if(laporan_status == 2){
                      laporan_status ="Sedang Proses";
                    }
                    else if(laporan_status == 3){
                      laporan_status ="Selesai";
                    }                    

                // Durasi TL
                  var awal  = new Date(data[i].tanggal_laporan);
                  var akhir = new Date(data[i].tanggal_tindaklanjut);

                  selisihDetik = Math.floor((akhir - (awal))/1000);
                  selisihMenit = Math.floor(selisihDetik/60);
                  selisihJam = Math.floor(selisihMenit/60);
                  selisihHari = Math.floor(selisihJam/24);

                  jamTl = selisihJam-(selisihHari*24);
                  menitTl = selisihMenit-(selisihHari*24*60)-(jamTl*60);
                  detikTl = selisihDetik-(selisihHari*24*60*60)-(jamTl*60*60)-(menitTl*60);
                  durasiTl = selisihHari +" hari  " + jamTl + " jam  " + menitTl + " menit  " + detikTl + " detik"
                  // var awal  = new Date(data[i].tanggal_laporan);
                  // var akhir = new Date(data[i].tanggal_tindaklanjut);
                  // var awalDalamMilidetik = awal.getTime();
                  // var akhirDalamMilidetik = akhir.getTime();
                  
                  // var selisihMilidetik = akhirDalamMilidetik - awalDalamMilidetik;
                  // var selisihDetik = selisihMilidetik/1000;
                  // var selisihMenit = selisihDetik/60;
                  // // var selisihJam = selisihMenit/60;
                  // var selisihJam = (selisihMenit/60).toFixed(2);
                  // // var selisihHari = selisihJam/24;
                  // var selisihHari = (selisihJam/24).toFixed(2);

                $('#ModalView').modal('show');
                $('[name="xkode_view"]').val(data[i].id);
                $('[name="x_ditujukan_kepada_view"]').val(data[i].ditujukan_kepada);
                $('[name="x_judul_laporan_view"]').val(data[i].judul_laporan);
                $('[name="x_kategori_laporan_view"]').val(data[i].kategori_laporan);
                $('[name="x_subkategori_laporan_view"]').val(data[i].subkategori_laporan);
                $('[name="x_topik_laporan_view"]').val(data[i].topik_laporan);
                $('[name="x_isi_laporan_view"]').val(data[i].isi_laporan);
                $('[name="x_nik_view"]').val(data[i].nik);
                $('[name="x_nama_view"]').val(data[i].nama);
                $('[name="x_alamat_view"]').val(data[i].alamat);
                $('[name="x_hp_view"]').val(data[i].hp);
                $('[name="x_sumberaduan_view"]').val(data[i].sumber_aduan);
                $('[name="x_lokasi_view"]').val(data[i].lokasi);
                $('[name="x_email_view"]').val(data[i].email);
                $('[name="x_tindaklanjut_view"]').val(data[i].tindaklanjut);
                $('[name="x_keterangan_tindaklanjut_view"]').val(data[i].keterangan_tindaklanjut);
                $('[name="x_tanggal_laporan_view"]').val(data[i].tanggal_laporan);
                $('[name="x_laporan_status_view"]').val(data[i].laporan_status);
                $('[name="x_keterangan_status_view"]').val(data[i].keterangan_status);
                $('[name="x_tanggal_tindaklanjut_view"]').val(data[i].tanggal_tindaklanjut);
                $('[name="x_rating_jawaban_view"]').val(data[i].rating_jawaban);
                // $('[name="x_durasi_tindaklanjutHari_view"]').val(Math.round(selisihHari));
                $('[name="x_durasi_tindaklanjut_view"]').val(durasiTl);
                // $('[name="x_durasi_tindaklanjutJam_view"]').val(Math.round(selisihJam));
                // $('[name="x_durasi_tindaklanjutJam_view"]').val(jamTl);
                $('[name="foto_view"]').html('');
                $('[name="foto_tindaklanjut_view"]').html('');

                var fileNameFotoView = data[i].foto;
                var fileExtension = fileNameFotoView.split('.').pop(); 
                  if (fileExtension == "pdf") {
                    gbr1 += '<embed src="'+ base_urlx + data[i].foto +'" width="90px" height="90px" alt="no img"/>';
                        $('#foto_view').append(gbr1);

                  }else{
                    gbr1 += '<img src="'+ base_urlx + data[i].foto +'" style="height:250px;width:350px;" alt="no img">';
                      $('#foto_view').append(gbr1);
                  }

                var fileNameFotoTL = data[i].foto_tindaklanjut;
                var fileExtension = fileNameFotoTL.split('.').pop(); 
                  if (fileExtension == "pdf") {    
                     
                    gbr2 += '<embed src="'+ base_urlx + data[i].foto_tindaklanjut +'" width="90px" height="90px" alt="no img"/>';
                        $('#foto_tindaklanjut_view').append(gbr2);

                  }else{
                    gbr2 += '<img src="'+ base_urlx + data[i].foto_tindaklanjut +'" style="height:250px;width:350px;" alt="no img">';
                      $('#foto_tindaklanjut_view').append(gbr2);
                  }

            	  });
                }
            });
            return false;
        });


		//Edit Aduan
		$('#tbl_laporan').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            var base_urlx="<?php echo base_url('assets/images/')?>";
            var gbr2='';
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(i,field){
                 	$('#ModalEdit').modal('show');
                    $('[name="xkode_edit"]').val(data[i].id);
                    $('[name="x_id_kepada_edit"]').val(data[i].id_kepada);
                    $('[name="x_ditujukan_kepada_edit"]').val(data[i].ditujukan_kepada);
                    $('[name="x_tanggal_laporan_edit"]').val(data[i].tanggal_laporan);
                    $('[name="x_judul_laporan_edit"]').val(data[i].judul_laporan);
                    $('[name="x_kategori_laporan_edit"]').val(data[i].kategori_laporan);
                    $('[name="x_subkategori_laporan_edit"]').val(data[i].subkategori_laporan);
                    $('[name="x_topik_laporan_edit"]').val(data[i].topik_laporan);
                    $('[name="x_isi_laporan_edit"]').val(data[i].isi_laporan);
                    $('[name="x_nik_edit"]').val(data[i].nik);
                    $('[name="x_nama_edit"]').val(data[i].nama);
                    $('[name="x_hp_edit"]').val(data[i].hp);
                    $('[name="x_sumberaduan_edit"]').val(data[i].sumber_aduan);
                    $('[name="x_alamat_edit"]').val(data[i].alamat);
                    $('[name="x_lokasi_edit"]').val(data[i].lokasi);
                    $('[name="x_email_edit"]').val(data[i].email);
                    
                    // $('[name="x_laporan_status_edit"]').val(data[i].laporan_status);
                    // $('[name="x_keterangan_status_edit"]').val(data[i].keterangan_status);
                    // $('[name="x_tindaklanjut_edit"]').val(data[i].tindaklanjut);
                    // $('[name="x_keterangan_tindaklanjut_edit"]').val(data[i].keterangan_tindaklanjut);
                    // $('[name="x_tanggal_tindaklanjut_edit"]').val(data[i].tanggal_tindaklanjut);
                    // $('[name="x_foto_tindaklanjut"]').val(data[i].foto_tindaklanjut);
                    
                    $('[name="x_foto"]').val(data[i].foto);

                  gbr2 += '<img src="'+ base_urlx + data[i].foto +'" style="height:190px;" alt="no img">';
                  $('[name="foto_view"]').append(gbr2);
                  $('[name="foto_view"]').refresh;
            		});
                }
            });
            return false;
        });

    //Copy Aduan
    $('#tbl_laporan').on('click','.item_copy',function(){
            var id=$(this).attr('data');
            var base_urlx="<?php echo base_url('assets/images/')?>";
            var gbr2='';
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                  $.each(data,function(i,field){
                  $('#ModalCopy').modal('show');
                    // $('[name="xkode_copy"]').val(data[i].id);
                    $('[name="x_id_kepada_copy"]').val(data[i].id_kepada);
                    $('[name="x_ditujukan_kepada_copy"]').val(data[i].ditujukan_kepada);
                    $('[name="x_tanggal_laporan_copy"]').val(data[i].tanggal_laporan);
                    $('[name="x_judul_laporan_copy"]').val(data[i].judul_laporan);
                    $('[name="x_kategori_laporan_copy"]').val(data[i].kategori_laporan);
                    $('[name="x_subkategori_laporan_copy"]').val(data[i].subkategori_laporan);
                    $('[name="x_topik_laporan_copy"]').val(data[i].topik_laporan);
                    $('[name="x_isi_laporan_copy"]').val(data[i].isi_laporan);
                    $('[name="x_nik_copy"]').val(data[i].nik);
                    $('[name="x_nama_copy"]').val(data[i].nama);
                    $('[name="x_hp_copy"]').val(data[i].hp);
                    $('[name="x_sumberaduan_copy"]').val(data[i].sumber_aduan);
                    $('[name="x_alamat_copy"]').val(data[i].alamat);
                    $('[name="x_lokasi_copy"]').val(data[i].lokasi);
                    $('[name="x_email_copy"]').val(data[i].email);
                    $('[name="x_laporan_status_edit"]').val(data[i].laporan_status);
                    $('[name="x_keterangan_status_copy"]').val(data[i].keterangan_status);

                    // $('[name="x_laporan_status_copy"]').val(data[i].laporan_status);
                    // $('[name="x_keterangan_status_copy"]').val(data[i].keterangan_status);
                    // $('[name="x_tindaklanjut_edit"]').val(data[i].tindaklanjut);
                    // $('[name="x_keterangan_tindaklanjut_edit"]').val(data[i].keterangan_tindaklanjut);
                    // $('[name="x_tanggal_tindaklanjut_edit"]').val(data[i].tanggal_tindaklanjut);
                    // $('[name="x_foto_tindaklanjut"]').val(data[i].foto_tindaklanjut);
                    
                    $('[name="x_foto"]').val(data[i].foto);

                  gbr2 += '<img src="'+ base_urlx + data[i].foto +'" style="height:190px;" alt="no img">';
                  $('[name="foto_view"]').append(gbr2);
                  $('[name="foto_view"]').refresh;
                });
                }
            });
            return false;
        });

    //GET Input TL
    $('#tbl_laporan').on('click','.item_inputtl',function(){
            var id=$(this).attr('data');
            var base_urlx="<?php echo base_url('assets/images/')?>";
            var gbr2='';
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                  $.each(data,function(i,field){
                  $('#ModalInputtl').modal('show');
                    $('[name="xkode_inputtl"]').val(data[i].id);
                    // $('[name="x_id_kepada_edit"]').val(data[i].id_kepada);
                    // $('[name="x_ditujukan_kepada_edit"]').val(data[i].ditujukan_kepada);
                    // $('[name="x_judul_laporan_edit"]').val(data[i].judul_laporan);
                    // $('[name="x_kategori_laporan_edit"]').val(data[i].kategori_laporan);
                    // $('[name="x_isi_laporan_edit"]').val(data[i].isi_laporan);
                    // $('[name="x_nik_edit"]').val(data[i].nik);
                    // $('[name="x_nama_edit"]').val(data[i].nama);
                    // $('[name="x_hp_edit"]').val(data[i].hp);
                    // $('[name="x_alamat_edit"]').val(data[i].alamat);
                    // $('[name="x_lokasi_edit"]').val(data[i].lokasi);
                    // $('[name="x_email_edit"]').val(data[i].email);
                    // $('[name="x_tanggal_laporan_edit"]').val(data[i].tanggal_laporan);
                    $('[name="x_laporan_status_inputtl"]').val(data[i].laporan_status);
                    $('[name="x_keterangan_status_inputtl"]').val(data[i].keterangan_status);
                    $('[name="x_tindaklanjut_inputtl"]').val(data[i].tindaklanjut);
                    $('[name="x_keterangan_tindaklanjut_inputtl"]').val(data[i].keterangan_tindaklanjut);
                    $('[name="x_tanggal_tindaklanjut_inputtl"]').val(data[i].tanggal_tindaklanjut);
                    $('[name="x_foto_tindaklanjut"]').val(data[i].foto_tindaklanjut);
                    $('[name="x_foto"]').val(data[i].foto);

                  gbr2 += '<img src="'+ base_urlx + data[i].foto +'" style="height:190px;" alt="no img">';
                  $('[name="foto_view"]').append(gbr2);
                  $('[name="foto_view"]').refresh;
                });
                }
            });
            return false;
        });

        //TERUSKAN
        $('#tbl_laporan').on('click','.item_teruskan',function(){
            var id=$(this).attr('data');

            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(i,field){            

                  $('#ModalTeruskan').modal('show');
                  $('[name="x_kode_teruskan"]').val(data[i].id);
            			$('[name="x_id_kepada_teruskan"]').val(data[i].ditujukan_kepada);
            			$('[name="x_judul_laporan_teruskan"]').val(data[i].judul_laporan);
            			$('[name="x_isi_laporan_teruskan"]').val(data[i].isi_laporan);
                  $('[name="x_keterangan_status_teruskan"]').val(data[i].keterangan_status);
                  
            		 });
                }
            });
            return false;
        });

        //KIRIM NOTIFIKASI KE PELAPOR
        $('#tbl_laporan').on('click','.item_notif_pengadu',function(){
            var id=$(this).attr('data');

            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                  $.each(data,function(i,field){            

                  $('#ModalNotifpengadu').modal('show');
                  $('[name="x_kode_notifwapengadu"]').val(data[i].id);
                  $('[name="x_nama_notifwapengadu"]').val(data[i].nama);
                  $('[name="x_nohp_notifwapengadu"]').val(data[i].hp);
                  
                 });
                }
            });
            return false;
        });

        $('#tbl_laporan').on('click','.item_detail',function(){
            var id=$(this).attr('data');
            window.location.href = "<?php echo base_url('home/detail/');?>"

            // var Url = "<?php echo base_url('home/detail/')?>";
            // Url.select();
            // document.execCommand("copy");
            // alert("Text berhasil dicopy");

        });


        //TAYANG
        $('#tbl_laporan').on('click','.item_tayang1',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('admin/laporan/update_tayang')?>",
                dataType : "JSON",
                data : {id:id},
                success: window.location.href = "<?php echo base_url('admin/laporan');?>"
                //  alert("data berhasil diupdate");
              });
            
            return false;
        });


    //GET UPDATE
		$('#tbl_laporan').on('click','.item_hapus',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(i,field){
                 	$('#ModalHapus').modal('show');
                   $('[name="x_judul_laporan_hapus"]').html('');
                   $('[name="x_nama_hapus"]').html('');
                    $('[name="x_kode_hapus"]').val(data[i].id);
                    // $('[name="x_judul_laporan_hapus"]').html(data[i].judul_laporan);
                    $('[name="x_nama_hapus"]').html(data[i].nama);
                    $('[name="x_isi_laporan_hapus"]').val(data[i].isi_laporan);
                    $('[name="x_foto_hapus"]').val(data[i].foto);

            		});
                }
            });
            return false;
        });


	});

     </script>

     <script>
      function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }
     </script>

      <script>
            $(document).ready(function() {
            $('#form_teruskan1').submit(function(e){ //matikan

            e.preventDefault();
		         $.ajax({
                 url:'<?php echo base_url();?>admin/laporan/update_teruskan',
                 type:"post",
		             data:new FormData(this),
		             processData:false,
		             contentType:false,
		             cache:false,
		             async:false,
		              success: function(data){
		                  alert("data berhasil diteruskan");
                      $('#ModalTeruskan').modal('hide');
                      window.location.href = "<?php echo base_url('admin/laporan');?>"
                      // tampil_data();
		             }
		           });
            });
		    });
      </script>

      <?php if($this->session->flashdata('msg')=='error'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Error',
      text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
      showHideTransition: 'slide',
      icon: 'error',
      hideAfter: false,
      position: 'bottom-right',
      bgColor: '#FF4859'
      });
      </script>
      
      <?php elseif($this->session->flashdata('msg')=='success'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Sukses',
      text: "Data Berhasil disimpan ke database.",
      showHideTransition: 'slide',
      icon: 'success',
      hideAfter: false,
      position: 'top-right',
      bgColor: '#7EC857'
      });
      </script>
      <?php elseif($this->session->flashdata('msg')=='info'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Info',
      text: "Data berhasil di update",
      showHideTransition: 'slide',
      icon: 'info',
      hideAfter: false,
      position: 'top-right',
      bgColor: '#00C9E6'
      });
      </script>
      <?php elseif($this->session->flashdata('message')=='email gagal'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Info',
      text: "Email Notifikasi Gagal Dikirim",
      showHideTransition: 'slide',
      icon: 'info',
      hideAfter: false,
      position: 'top-right',
      bgColor: '#00C9E6'
      });
      </script>
      <?php elseif($this->session->flashdata('message')=='email'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Info',
      text: "Laporan Berhasil diteruskan! Notifikasi Email & Whatsapp ke Admin OPD telah terkirim.",
      showHideTransition: 'slide',
      icon: 'info',
      hideAfter: false,
      position: 'top-right',
      bgColor: '#00C9E6'
      });
      </script>
      <?php elseif($this->session->flashdata('message')=='email2'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Info',
      text: "Notifikasi Tracking Telah Terkirim ke Pelapor!",
      showHideTransition: 'slide',
      icon: 'info',
      hideAfter: false,
      position: 'top-right',
      bgColor: '#00C9E6'
      });
      </script>
      <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Sukses',
      text: "Data Berhasil dihapus.",
      showHideTransition: 'slide',
      icon: 'success',
      hideAfter: false,
      position: 'top-right',
      bgColor: '#7EC857'
      });
      </script>
      <?php else:?>
      <?php endif;?>
    </body>
  </html>