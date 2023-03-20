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
                    <a class="btn btn-success btn-flat" href="<?php echo base_url().'admin/laporan/add_laporan'?>"><span class="fa fa-plus"></span> Add New</a>
                    <!-- <a class="btn btn-danger btn-flat" href="<?php echo base_url().'admin/laporan/add_tambahan'?>"><span class="fa fa-plus"></span> Tambahan</a> -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tbl_laporan" class="table table-striped" style="font-size:13px;">
                      <thead>
                        <tr>
                        <th>No</th>
                          <th>Foto</th>
                          <th>OPD</th>
                          <th>Rincian</th>
                          <th>nama</th>
                          <th>hp</th>
                          <th>tanggal</th>
                          <th>status</th>
                          <!-- <th>tayang</th> -->
                          <th style="text-align:right;">Aksi</th>
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
      <!-- modal Edit Laporan -->

      <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Update Aduan</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_laporan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="xkode_edit" id="xkode_edit">
                  <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                  <div class="col-sm-7">
                    <input type="text" name="xditujukankepada" disabled class="form-control"  id = "xditujukankepada" placeholder="Kepada " required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_judullaporan"  class="form-control" id="x_judullaporan" placeholder="Judul Aduan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="x_isilaporan" id="x_isilaporan" required></textarea>
                  </div>
                </div>

                <!-- /.form group -->
                <!-- Date range -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="x_nama" disabled id="x_nama" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="x_lokasi"  id="x_lokasi" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="x_laporanstatus" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <option value="1">verifikasi</option>
                        <option value="2">Belum Proses</option>
                        <option value="3">Selesai</option>
                        <option value="99">Ditolak</option>           
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="xketeranganstatus" class="form-control" id="xketeranganstatus" placeholder="Keterangan" required>
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

      <!--- awaal modal view Laporan--->
      
      <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Rincian View</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/agenda/update_agenda'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode_view" id="kode">
                    <input type="text" name="xditujukankepada_view"  class="form-control" id="xditujukankepada_view" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" id="kode">
                    <input type="text" name="xjudullaporan_view"  class="form-control" id="xjudullaporan_view" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3"  name="xisilaporan_view" id="xisilaporan_view" placeholder="Judul Laporan ..." required></textarea>
                  </div>
                </div>

                <!-- /.form group -->
                <!-- Date range -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">nama</label>
                  <div class="col-sm-7">
                    
                      <input type="text" name="xnama_view" disabled id="xnama_view" class="form-control pull-right datepicker4" required>
                    
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="xlokasi_view" disabled id="xlokasi_view" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <!-- /.form group -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">email</label>
                  <div class="col-sm-7">
                    <input type="text" name="xemail_view" disabled class="form-control" id="xemail_view" placeholder="Tempat" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-7">
                    <input type="text" name="xtanggallaporan_view" disabled class="form-control"  id="xtanggallaporan_view" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">
                  <input type="text" name="xlaporanstatus_view" disabled class="form-control"  id="xlaporanstatus_view" placeholder="Status" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="xketeranganstatus_view" disabled class="form-control"  id="xketeranganstatus_view" placeholder="Keterangan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Galeri</label>
                  <div class="col-sm-7" id="foto_view" name="foto_view">
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


     <!-- Modal Teruskan -->
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
                  <label for="inputUserName" class="col-sm-4 control-label">Tindaklanjut</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_tindaklanjut" class="form-control" id="x_tindaklanjut" placeholder="Keterangan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan Tambahan</label>
                  <div class="col-sm-7">
                    <input type="text" name="x_keterangan_tindaklanjut" class="form-control" id="x_keterangan_tindaklanjut" placeholder="Keterangan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Foto Tindaklanjut</label>
                  <div class="col-sm-7">
                    <input type="file" name="x_foto_tindaklanjut" class="form-control" id="x_foto_tindaklanjut" placeholder="Keterangan" >
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
		        url   : '<?php echo base_url()?>admin/laporan/get_opd',
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
                     laporan_status = '<span class="label label-success">Verifikasi</span>';
                  }else if(laporan ==2){
                    laporan_status = '<span class="label label-danger">Belum Proses</span>';
                  }else if(laporan ==99){
                    laporan_status = '<span class="label label-warning">ditolak</span>';
                  }else{
                    laporan_status = '<span class="label label-info">selesai</span>';
                  }

		                html += '<tr>'+
		                  		'<td>'+no+'</td>'+
		                        // '<td>'+data[i].foto+'</td>'+
		                        '<td><img src="'+ base_urlx + data[i].foto +'" style="width:90px;"></td>'+
		                        '<td>'+data[i].ditujukan_kepada+'</td>'+
		                        '<td>'+data[i].isi_laporan+'</td>'+
		                        '<td>'+data[i].nama+'</td>'+
		                        '<td>'+data[i].hp+'</td>'+
		                        '<td>'+data[i].tanggal_laporan+'</td>'+
		                        '<td>'+laporan_status+'</td>'+
		                        // '<td>'+data[i].tayang+'</td>'+
		                        '<td style="text-align:right;">'+
                                    // '<a href="javascript:;" class="btn btn-info btn-xs item_view" data="'+data[i].id+'">view</a>'+' '+
                                    // '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].id+'">edit</a>'+' '+
                                    '<a href="javascript:;" class="btn btn-info btn-xs item_tindaklanjut" data="'+data[i].id+'">Tindaklanjut</a>'+' '+
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
                    "autoWidth": true
                    });
                    // tutuptambahan
		        }

		    });
		}

		$('#tbl_laporan').on('click','.item_view',function(){
            var id=$(this).attr('data');
            var gbr='';
            var base_urlx="<?php echo base_url('assets/images/')?>";
      
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/laporan/get_modalview')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    var laporan_status = data.laporan_status;
                    if (laporan_status == 1) {
                      laporan_status ="verifikasi";
                    }
                    else if(laporan_status == 2){
                      laporan_status ="belum proses";
                    }
                    else if(laporan_status == 3){
                      laporan_status ="selesai";
                    }                    

                  $('#ModalView').modal('show');
                  $('[name="kode_view"]').val(data.id);
            			$('[name="xditujukankepada_view"]').val(data.ditujukan_kepada);
            			$('[name="xjudullaporan_view"]').val(data.judul_laporan);
            			$('[name="xisilaporan_view"]').val(data.isi_laporan);
            			$('[name="xnama_view"]').val(data.nama);
            			$('[name="xlokasi_view"]').val(data.lokasi);
            			$('[name="xanggaran_view"]').val(data.anggaran);
            			$('[name="xemail_view"]').val(data.email);
                  $('[name="xtanggallaporan_view"]').val(data.tanggal_laporan);
                  $('[name="xlaporanstatus_view"]').val(laporan_status);
                  $('[id="keteranganstatus_view"]').val(data.keterangan_status);

                  gbr1 += '<img src="'+ base_urlx + data[i].foto +'" style="height:250px;widt:350px;" alt="Foto blm di Upload">';
                      $('#foto_view').append(gbr1);
            		 });
                }
            });
            return false;
        });


		//GET UPDATE
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
            			$('[name="x_nama_tindaklanjut"]').val(data[i].nama);
            			$('[name="x_lokasi_tindaklanjut"]').val(data[i].lokasi);
            			$('[name="x_anggaran_tindaklanjut"]').val(data[i].anggaran);
            			$('[name="x_email_tindaklanjut"]').val(data[i].email);
                  $('[name="x_tanggal_laporan_tindaklanjut"]').val(data[i].tanggal_laporan);
                  $('[name="x_laporanstatus_tindaklanjut"]').val(data[i].laporan_status);
                  $('[name="x_keterangan_status_tindaklanjut"]').val(data[i].keterangan_status);

            		 });
                }
            });
            return false;
        });

        //TERUSKAN
       
        //TAYANG
        $('#tbl_laporan').on('click','.item_tayang',function(){
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

      <script>
            $(document).ready(function() {
            $('#form_teruskan').submit(function(e){

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