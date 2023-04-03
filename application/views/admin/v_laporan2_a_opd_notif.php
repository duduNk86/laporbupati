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
          Data Aduan
          <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('admin/laporan');?>">Aduan</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box">
                  <div class="box-header">
                    <!-- <a class="btn btn-success btn-flat" href="< ?php echo base_url().'admin/laporan/add_laporan'?>"><span class="fa fa-plus"></span> Add New</a> -->
                   
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tbl_laporan" class="table table-striped" style="font-size:13px;">
                      <thead>
                        <tr>
                        <th style="text-align:center;">No</th>
                          <th style="text-align:center;">Tiket | Tgl-Jam | Sumber Aduan</th>
                          <th style="text-align:center;">Judul | Rincian | Bukti Dukung</th>
                          <th style="text-align:center;" title="Perangkat Daerah Terkait Penanganan Aduan">OPD</th>
                          <th style="text-align:center;" title="Status Aduan / Durasi TL / Rating Jawaban">Status | Durasi | Rating</th>
                          <th style="text-align:center;">Aksi</th>
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

     <!-- Modal Tindak Lanjut -->
     <div class="modal fade" id="ModalTindaklanjut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Tindaklanjut Aduan</h4>
            </div>
            <form id="form_tindaklanjut" class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_tindaklanjut'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="xkode_tindaklanjut" id="xkode_tindaklanjut">
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_judul_laporan_tindaklanjut"  class="form-control" id="x_judul_laporan_tindaklanjut" placeholder="Nama Aduan" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal Aduan Masuk</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_tanggal_laporan_tindaklanjut" class="form-control"  id="x_tanggal_laporan_tindaklanjut" required readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isi_laporan_tindaklanjut" id="x_isi_laporan_tindaklanjut" readonly=""></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_status_tindaklanjut" class="form-control" id="x_keterangan_status_tindaklanjut" placeholder="Keterangan" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status Tindaklanjut</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_laporan_status_tindaklanjut" style="width: 100%;" >
                        <option value="2">Tindaklanjut Awal</option>
                        <option value="3">Tindaklanjut Selesai</option>       
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tindaklanjut</label>
                  <div class="col-sm-7">
                    <textarea name="x_tindaklanjut" class="form-control" id="x_tindaklanjut" rows="3" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal Tindaklanjut</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_tanggal_tl" class="form-control"  id="x_tanggal_tl" required readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan Tambahan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_tindaklanjut" class="form-control" id="x_keterangan_tindaklanjut" placeholder="Keterangan tambahan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Upload Foto Tindaklanjut</label>
                  <div class="col-sm-7">
                    <input type="file" name="x_foto_tindaklanjut_edit" class="form-control" id="x_foto_tindaklanjut_edit" >
                    <input type="hidden" name="x_foto_tindaklanjut" id="x_foto_tindaklanjut">
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Teruskan -->
     <div class="modal fade" id="ModalTolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Tolak Aduan</h4>
            </div>
            <form id="form_tolak" class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_tolak'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="xkode_tolak" id="xkode_tolak">
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_judul_laporan_tolak"  class="form-control" id="x_judul_laporan_tolak" placeholder="Nama Aduan" readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isi_laporan_tolak" id="x_isi_laporan_tolak" readonly=""></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Alasan Aduan Ditolak</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_keterangan_tolak"  id="x_keterangan_tolak"></textarea>
                  </div>
                </div>
                     <input type="hidden" class="form-control" value="2" name="x_laporan_status_tolak" style="width: 100%;" >
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal View -->
      <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Rincian View</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_view'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">No. Tiket Aduan</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_tiket_view" id="x_tiket_view" class="form-control pull-right datepicker4" disabled required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_tanggal_laporan_view" class="form-control"  id="x_tanggal_laporan_view" disabled required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_kategori_laporan_view" style="width: 100%;" disabled required>
                        <option value="">-Pilih-</option>
                        <option value="1">Fisik / Infrastruktur</option>
                        <option value="2">Non Fisik / Non Infrastruktur</option>        
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Sub Kategori</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_subkategori_laporan_view" id="x_subkategori_laporan_view" style="width: 100%;" disabled required>
                        <option value="">- Pilih -</option>
                        <option value=""><?php echo $subkategori_nama;?></option>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Topik</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_topik_laporan_view"  class="form-control" id="x_topik_laporan_view" placeholder="Hashtag (#) Topik Aduan" disabled required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode_view" id="kode">
                    <input type="text" name="x_ditujukan_kepada_view"  class="form-control" id="x_ditujukan_kepada_view" placeholder="Nama Agenda" disabled required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" id="kode">
                    <input type="text" name="x_judul_laporan_view"  class="form-control" id="x_judul_laporan_view" placeholder="Nama Agenda" disabled required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3"  name="x_isi_laporan_view" id="x_isi_laporan_view" placeholder="Judul Laporan ..." disabled required></textarea>
                  </div>
                </div>
                <!-- <div class="form-group">
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
                </div> -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_lokasi_view" id="x_lokasi_view" class="form-control pull-right datepicker4" disabled required>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_email_view" class="form-control" id="x_email_view" placeholder="Tempat" disabled required>
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">
                  <input type="text" name="x_laporan_status_view" class="form-control"  id="x_laporan_status_view" placeholder="Status" disabled required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_status_view" disabled class="form-control"  id="x_keterangan_status_view" placeholder="Keterangan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tindak Lanjut</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_tindaklanjut_view" class="form-control" id="x_tindaklanjut_view" disabled >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan TL</label>
                  <div class="col-sm-7">
                    <textarea rows="3" type="text" name="x_keterangan_tindaklanjut_view" class="form-control" id="x_keterangan_tindaklanjut_view" disabled ></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Foto Aduan</label>
                  <div class="col-sm-7" id="foto_view" name="foto_view">
                     <img src="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Foto TL</label>
                  <div class="col-sm-7" id="foto_tindaklanjut_view" name="foto_tindaklanjut_view">
                     <img src="">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- jQuery 2.2.3 -->
      <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
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
		        url   : '<?php echo base_url()?>admin/laporan/get_notifopd',
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
                  var laporan = data[i].laporan_status;
                  if (laporan ==1){
                     laporan_status = '<span class="label label-danger">Verifikasi</span>';
                  }else if(laporan ==2){
                    laporan_status = '<span class="label label-warning">Sedang Proses</span>';
                  }else if(laporan ==99){
                    laporan_status = '<span class="label label-info">Ditolak</span>';
                  }else{
                    laporan_status = '<span class="label label-success">Selesai</span>';
                  }

                  var rating = data[i].rating_jawaban;
                  if (rating ==1){
                     rating = '<b href="javascript:;" style="color:gold;" title="1 Bintang" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></b>';
                  }else if(rating ==2){
                    rating = '<b href="javascript:;" style="color:gold;" title="2 Bintang" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></b>';
                  }else if(rating ==3){
                    rating = '<b href="javascript:;" style="color:gold;" title="3 Bintang" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></b>';
                  }else if(rating ==4){
                    rating = '<b href="javascript:;" style="color:gold;" title="4 Bintang" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></b>';
                  }else if(rating ==5){
                    rating = '<b href="javascript:;" style="color:gold;" title="5 Bintang" data="'+data[i].id+'"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></b>';
                  }else{
                    rating = '<b href="javascript:;" style="color:gold;" title="0 Bintang" data="'+data[i].id+'"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></b>';
                  }

                  var sumber = data[i].sumber_aduan;
                  if (sumber =='LB') {
                    sumber = 'LaporBup';
                  } else if (sumber =='LG') {
                    sumber = 'LaporGub';
                  } else if (sumber =='SP') {
                    sumber = 'SP4N Lapor';
                  } else if (sumber =='SM') {
                    sumber = 'SMS';
                  } else if (sumber =='WA') {
                    sumber = 'Whatsapp';
                  } else if (sumber =='IG') {
                    sumber = 'Instagram';
                  } else if (sumber =='FB') {
                    sumber = 'Facebook';
                  } else {
                    sumber = 'Twitter';
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
                    tampilimagefoto = '<embed src="'+ base_urlx + data[i].foto +'" width="90px" height="90px" /> <center><a href="'+ base_urlx + data[i].foto +'" style="width:90px;">view Pdf</a></center>';
                  }else if(fileExtension === "") {
                    tampilimagefoto = '[ - ]';
                  }else{
                    tampilimagefoto = '<img src="'+ base_urlx + data[i].foto +'" style="width:90px;">';
                  }

		                html += '<tr>'+
                              '<td>'+no+'</td>'+
                              '<td><b style="color:red;">'+'LB'+data[i].sumber_aduan+'-'+data[i].id+'</b><br><br>'+data[i].tanggal_laporan+'<br><br>'+sumber+'</td>'+
                              '<td style="text-align:justify;">'+'<b>['+data[i].judul_laporan+']</b><br><br>'+data[i].isi_laporan+'<br><br>'+tampilimagefoto+'</td>'+
                              '<td>'+data[i].ditujukan_kepada+'</td>'+
                              '<td style="text-align:center;">'+laporan_status+'<br><br>'+'<b>'+selisihHari +'</b>'+ " hari " +'<br><b>'+ jamTl +'</b>'+ " jam " +'<b>'+ menitTl +'</b>'+ " menit " +'<b>'+ detikTl +'</b>'+ " detik"+'<br><br>'+rating+'</td>'+
		                          '<td style="text-align:center;">'+
                                  '<a href="javascript:;" data-toggle="tooltip" title="Lihat Rincian" class="btn btn-success btn-xs item_view" data="'+data[i].id+'"><span class="fa fa-eye">&nbsp; Detail &nbsp;&nbsp;&nbsp;</span></a>'+'<br>'+
                                  '<a href="javascript:;" data-toggle="tooltip" title="Tindaklanjut" class="btn btn-warning btn-xs item_tindaklanjut" data="'+data[i].id+'"><span class="fa fa-arrow-right">&nbsp; Input TL</span></a>'+'<br>'+
                                  '<a href="javascript:;" data-toggle="tooltip" title="Tolak Aduan" class="btn btn-danger btn-xs item_tolak" data="'+data[i].id+'"><span class="fa fa-close">&nbsp; Tolak &nbsp;&nbsp;&nbsp;&nbsp;</span></a>'+'<br>'+
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


		$('#tbl_laporan').on('click','.item_view',function(){
            var id=$(this).attr('data');
            var gbr='';
            var gbr1='';
            var gbr2='';
            var base_urlx="<?php echo base_url('assets/images/')?>";
      
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(i,field){                
                  
                  // Status Laporan
                  var laporan = data[i].laporan_status;
                  if (laporan ==1){
                     laporan_status = 'Verifikasi';
                  }else if(laporan ==2){
                    laporan_status = 'Sedang Proses';
                  }else if(laporan ==99){
                    laporan_status = 'Ditolak';
                  }else{
                    laporan_status = 'Selesai';
                  }

                  // Tiket Laporan
                  var sumber_aduan = data[i].sumber_aduan;
                  var id = data[i].id;
                  if (id !==''){
                    nomor_tiket = 'LB'+data[i].sumber_aduan+'-'+data[i].id;
                  } else {
                    nomor_tiket = '';
                  }

                $('#ModalView').modal('show');
                $('[name="xkode_view"]').val(data[i].id);
                $('[name="x_tiket_view"]').val(nomor_tiket);
                $('[name="x_ditujukan_kepada_view"]').val(data[i].ditujukan_kepada);
                $('[name="x_judul_laporan_view"]').val(data[i].judul_laporan);
                $('[name="x_kategori_laporan_view"]').val(data[i].kategori_laporan);
                $('[name="x_subkategori_laporan_view"]').val(data[i].subkategori_laporan);
                $('[name="x_topik_laporan_view"]').val(data[i].topik_laporan);
                $('[name="x_isi_laporan_view"]').val(data[i].isi_laporan);
                $('[name="x_nik_view"]').val(data[i].nik);
                $('[name="x_nama_view"]').val(data[i].nama);
                $('[name="x_hp_view"]').val(data[i].hp);
                $('[name="x_lokasi_view"]').val(data[i].lokasi);
                $('[name="x_email_view"]').val(data[i].email);
                $('[name="x_tindaklanjut_view"]').val(data[i].tindaklanjut);
                $('[name="x_keterangan_tindaklanjut_view"]').val(data[i].keterangan_tindaklanjut);
                $('[name="x_tanggal_laporan_view"]').val(data[i].tanggal_laporan);
                $('[name="x_laporan_status_view"]').val(laporan_status);
                $('[name="x_keterangan_status_view"]').val(data[i].keterangan_status);
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


        //TERUSKAN
        $('#tbl_laporan').on('click','.item_tindaklanjut',function(){
            var id=$(this).attr('data');
            var gbr='';
            var base_urlx="<?php echo base_url('assets/images/')?>";;

            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(i,field){           

                  $('#ModalTindaklanjut').modal('show');
                  $('[name="xkode_tindaklanjut"]').val(data[i].id);
            			$('[name="x_id_kepada_tindaklanjut"]').val(data[i].ditujukan_kepada);
            			$('[name="x_judul_laporan_tindaklanjut"]').val(data[i].judul_laporan);
            			$('[name="x_isi_laporan_tindaklanjut"]').val(data[i].isi_laporan);
            			$('[name="x_tindaklanjut"]').val(data[i].tindaklanjut);
            			$('[name="x_keterangan_tindaklanjut"]').val(data[i].keterangan_tindaklanjut);
            			$('[name="x_laporan_status_tindaklanjut"]').val(data[i].laporan_status);
            			$('[name="x_foto_tindaklanjut"]').val(data[i].foto_tindaklanjut);
            			$('[name="x_nama_tindaklanjut"]').val(data[i].nama);
            			$('[name="x_lokasi_tindaklanjut"]').val(data[i].lokasi);
            			$('[name="x_anggaran_tindaklanjut"]').val(data[i].anggaran);
            			$('[name="x_email_tindaklanjut"]').val(data[i].email);
                  $('[name="x_tanggal_laporan_tindaklanjut"]').val(data[i].tanggal_laporan);
                  $('[name="x_laporanstatus_tindaklanjut"]').val(data[i].laporan_status);
                  $('[name="x_tanggal_tl"]').val(data[i].tanggal_tindaklanjut);
                  $('[name="x_keterangan_status_tindaklanjut"]').val(data[i].keterangan_status);

            		 });
                }
            });
            return false;
        });
 
        $('#tbl_laporan').on('click','.item_tolak',function(){
            var id=$(this).attr('data');
            var gbr='';
            var base_urlx="<?php echo base_url('assets/images/')?>";;

            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modaledit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(i,field){           

                  $('#ModalTolak').modal('show');
                  $('[name="xkode_tolak"]').val(data[i].id);
            			$('[name="x_judul_laporan_tolak"]').val(data[i].judul_laporan);
            			$('[name="x_isi_laporan_tolak"]').val(data[i].isi_laporan);
            			$('[name="x_keterangan_tolak"]').val(data[i].keterangan_tolak);
            			$('[name="x_laporan_status_tolak"]').val(data[i].laporan_status);

            		 });
                }
            });
            return false;
        });


		//GET HAPUS
		$('#myexample1').on('click','.item_hapus',function(){
            var id=$(this).attr('data');
            $('#ModalHapus').modal('show');
            $('[name="kode"]').val(id);
        });

		//Simpan Barang
		$('#btn_simpan').on('click',function(){
            var kobar=$('#kode_barang').val();
            var nabar=$('#nama_barang').val();
            var harga=$('#harga').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/simpan_barang')?>",
                dataType : "JSON",
                data : {kobar:kobar , nabar:nabar, harga:harga},
                success: function(data){
                    $('[name="kobar"]').val("");
                    $('[name="nabar"]').val("");
                    $('[name="harga"]').val("");
                    $('#ModalaAdd').modal('hide');
                    tampil_data();
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
      heading: 'Success',
      text: "Data Berhasil disimpan ke database.",
      showHideTransition: 'slide',
      icon: 'success',
      hideAfter: false,
      position: 'bottom-right',
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
      position: 'bottom-right',
      bgColor: '#00C9E6'
      });
      </script>
      <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
      <script type="text/javascript">
      $.toast({
      heading: 'Success',
      text: "Data Berhasil dihapus.",
      showHideTransition: 'slide',
      icon: 'success',
      hideAfter: false,
      position: 'bottom-right',
      bgColor: '#7EC857'
      });
      </script>
      <?php else:?>
      <?php endif;?>
    </body>
  </html>