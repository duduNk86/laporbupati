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
    <title><?=$title;?></title>
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

        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box">
                  <div class="box-header">
                   <!--  <a class="btn btn-success btn-flat" href="<?php echo base_url().'admin/laporan/add_laporan'?>"><span class="fa fa-plus"></span> Add New</a> -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tbl_laporan" class="table table-striped" style="font-size:13px;">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>kepada</th>
                          <th>Jenis</th>
                          <th>Rincian</th>
                          <th>Lokasi Aduan</th>
                          <!-- <th>Anggaran</th> -->
                          <th>nama</th>
                          <th>Alamat</th>
                          <th>hp</th>
                          <th>Tanggal</th>
                          <th>status</th>
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
          <strong>@LaporBupati</strong>
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
              <h4 class="modal-title" id="myModalLabel">Tindak Lanjut Laporan</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_status'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                  <div class="col-sm-7">
                    

                    <input type="hidden" name="kode" value="">
                    <input type="text" name="xnama_agenda" disabled class="form-control" value="" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" value="">
                    <input type="text" name="xnama_agenda" disabled class="form-control" value="" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" disabled name="xisilaporan" placeholder="Judul Laporan ..." required></textarea>
                  </div>
                </div>

                <!-- /.form group -->
                <!-- Date range -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">nama</label>
                  <div class="col-sm-7">
                    
                      <input type="text" name="nama" disabled value="" class="form-control pull-right datepicker4" required>
                    
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">email</label>
                  <div class="col-sm-7">
                    <input type="text" name="email" disabled class="form-control" value="" id="inputUserName" placeholder="Tempat" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-7">
                    <input type="text" name="xwaktu" disabled dlass="form-control" value="" id="inputUserName" placeholder="Contoh: 10.30-11.00 WIB" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">
                     <select class="form-control select2" name="laporan_status" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <option value="1">belum proses</option>
                        <option value="2">Tercatat</option>
                        <option value="3">Ditolak</option>
                        <option value="4">Selesai</option>           
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="xketeranganstatus" class="form-control" value="" id="inputUserName" placeholder="Keterangan" required>
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
      
      <!-- Akhir modal edit Laporan -->

      <!--- awaal modal view Laporan--->

      
      <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Rincian</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/agenda/update_agenda'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" value="">
                    <input type="text" name="xnama_agenda" disabled class="form-control" value="" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" value="">
                    <input type="text" name="xnama_agenda" disabled class="form-control" value="" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" disabled name="xisilaporan" placeholder="Judul Laporan ..." required></textarea>
                  </div>
                </div>

                <!-- /.form group -->
                <!-- Date range -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">
                      <input type="text" name="xnama" disabled value="" class="form-control pull-right datepicker4" required>
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="xlokasi" disabled value="" class="form-control pull-right datepicker4" required>            
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Anggaran</label>
                  <div class="col-sm-7">
                    
                      <input type="text" name="xanggaran" disabled value="" class="form-control pull-right datepicker4" required>            
                  </div>
                </div>


                <!-- /.form group -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">email</label>
                  <div class="col-sm-7">
                    <input type="text" name="xtempat" disabled class="form-control" value="" id="inputUserName" placeholder="Tempat" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-7">
                    <input type="text" name="xwaktu" disabled class="form-control" value="" id="inputUserName" placeholder="Contoh: 10.30-11.00 WIB" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">

                  </div>
                </div>


                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="xketeranganstatus" disabled class="form-control" value="" id="inputUserName" placeholder="Keterangan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Galeri</label>
                  <div class="col-sm-7">
                    <img src="" style="width:190px;">
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
      
      <!-- Akhir modal edit Laporan -->


      <!---- akhir view laporan --->
      <!--Modal Hapus Laporan masyon-->
      <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Hapus Laporan</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/hapus_laporan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="kode" value=""/>
                <input type="hidden" value="" name="gambar">
                <p>Apakah Anda yakin mau menghapus data ini <b></b> ?</p>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
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
		        url   : '<?php echo base_url()?>admin/laporan/get_semua',
		        async : true,
		        dataType : 'json',
		        success : function(data){
          
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
                  if (laporan =1){
                     laporan_status = '<span class="label label-success">belum proses</span>';
                  }else if(laporan =2){
                    laporan_status = '<span class="label label-primary">tercatat</span>';
                  }else if(laporan =3){
                    laporan_status = '<span class="label label-danger">ditolak</span>';
                  }else{
                    laporan_status = '<span class="label label-warning">selesai</span>';
                  }

		                html += '<tr>'+
		                  		'<td>'+no+'</td>'+
		                        '<td>'+data[i].ditujukan_kepada+'</td>'+
		                        '<td>'+id_jenis+'</td>'+
		                        '<td>'+data[i].isi_laporan+'</td>'+
		                        '<td>'+data[i].lokasi+'</td>'+
		                        // '<td>'+data[i].anggaran+'</td>'+
		                        '<td>'+data[i].nama+'</td>'+
		                        '<td>'+data[i].alamat+'</td>'+
		                        '<td>'+data[i].hp+'</td>'+
		                        '<td>'+data[i].tanggal_laporan+'</td>'+
		                        '<td>'+laporan_status+'</td>'+
		                        '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info btn-xs item_view" data="'+data[i].id+'">view</a>'+' '+
                                
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
      
		});
      </script>


    
    </body>
  </html>