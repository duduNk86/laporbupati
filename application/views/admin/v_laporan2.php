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
          Data Usulan
          <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Aduan</a></li>
            <li class="active">Data Aduan</li>
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
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-striped" style="font-size:13px;">
                      <thead>
                        <tr>
                          <th>id</th>
                          <!--         <th>id_kepada</th>  -->
                          <th>kepada</th>
                          <th>kategori</th>
                          <th>Rincian</th>
                          <th>lokasi Aduan</th>
                          <th>anggaran</th>
                          <th>nama</th>
                          <th>alamat</th>
                          <th>hp</th>
                          <th>tanggal</th>
                          <th>status</th>
                          <th style="text-align:right;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no=0;
                        foreach ($data->result_array() as $i) :
                        $no++;
                        $id=$i['id'];
                        $id_kepada=$i['id_kepada'];
                        $ditujukan_kepada=$i['ditujukan_kepada'];
                        $id_jenis=$i['id_jenis'];
                        $isi_laporan=$i['isi_laporan'];
                        $lokasi=$i['lokasi'];
                        $xanggaran=$i['anggaran'];
                        $anggaran = preg_replace("/[^0-9]/", "", $xanggaran);





                        $nama=$i['nama'];
                        $alamat=$i['alamat'];
                        $hp=$i['hp'];
                        $tanggal_laporan=$i['tanggal_laporan'];
                        $laporan_status=$i['laporan_status'];
                        $foto=$i['foto'];
                        ?>
                        <tr>
                          <td><?php echo $no;?></td>
                          <!--        <td><?php echo $id_kepada;?></td>   -->
                          <td><?php echo $ditujukan_kepada;?></td>
                          <td>

                            <?php if ($i['id_jenis']=="1") { ?>
                            Aduan
                            <?php }else if ($i['id_jenis']=="2") { ?>
                            Aduan
                            <?php } ?>

                          </td>
                          <td><?php echo $isi_laporan;?></td>
                          <td><?php echo $lokasi;?></td>
                          <td><?php echo number_format($anggaran);?></td>
<!--                           <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo 'Rp '.number_format($d['d_jual_barang_harjul']); ?></td>
 -->
                          <!-- <td><img src="<?php echo base_url().'assets/images/'.$foto;?>" style="width:90px;"></td> -->
                          <td><?php echo $nama;?></td>
                          <td><?php echo $alamat;?></td>
                          <td><?php echo $hp;?></td>
                          <td><?php echo $tanggal_laporan;?></td>
                          <td>
                            <?php if ($i['laporan_status']=="1") { ?>
                            <span class="label label-success">belum proses</span>
                            <?php }else if ($i['laporan_status']=="2") { ?>
                            <span class="label label-primary">tercatat</span>
                            <?php }else if ($i['laporan_status']=="3") { ?>
                            <span class="label label-danger">ditolak</span>
                            <?php }else if ($i['laporan_status']=="4"){ ?>
                            <span class="label label-warning">selesai</span>
                            <?php } ?>
                          </td>
                          
                          
                          <td style="text-align:right;">
                            <a class="btn" data-toggle="modal" data-target="#ModalView<?php echo $id;?>"><span class="fa fa-eye"></span></a>
                            <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-pencil"></span></a>
                            <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id;?>"><span class="fa fa-trash"></span></a>
                          </td>
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
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
          </div>
          <strong>@LaporBupati</strong>
        </footer>
        
        <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- modal Edit Laporan -->
      <?php
      foreach ($data->result_array() as $i) :
      $no++;
      $id=$i['id'];
      $judul_laporan=$i['judul_laporan'];
      $id_kepada=$i['id_kepada'];
      $ditujukan_kepada=$i['ditujukan_kepada'];
      $kategori_laporan=$i['kategori_laporan'];
      $isi_laporan=$i['isi_laporan'];
      $lokasi=$i['lokasi'];
      $anggaran=$i['anggaran'];

      $id_pelapor=$i['id_pelapor'];
      $nama=$i['nama'];
      $email=$i['email'];
      $hp=$i['hp'];
      $tanggal_laporan=$i['tanggal_laporan'];
      $laporan_status=$i['laporan_status'];
      $keterangan_status=$i['keterangan_status'];
      $foto=$i['foto'];
      ?>
      
      <div class="modal fade" id="ModalEdit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Update Usulan</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/update_laporan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="kode" value="<?php echo $id;?>">
                  <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                  <div class="col-sm-7">

                    <input type="text" name="xnama_agenda" disabled class="form-control" value="<?php echo $ditujukan_kepada;?>" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" value="<?php echo $id;?>">
                    <input type="text" name="xjudullaporan"  class="form-control" value="<?php echo $judul_laporan;?>" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" name="xisilaporan" placeholder="Judul Laporan ..." required><?php echo $isi_laporan;?></textarea>
                  </div>
                </div>

                <!-- /.form group -->
                <!-- Date range -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-7">                   
                      <input type="text" name="xnama" disabled value="<?php echo $nama;?>" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="xlokasi"  value="<?php echo $lokasi;?>" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Anggaran</label>
                  <div class="col-sm-7">
                      <input type="text" name="xanggaran"  value="<?php echo $anggaran;?>" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <!-- /.form group -->
<!--                 <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                  <div class="col-sm-7">
                    <input type="text" name="xemail" disabled class="form-control" value="<?php echo $email;?>" id="inputUserName" placeholder="Tempat" required>
                  </div>
                </div> -->
<!--                 <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-7">
                    <input type="text" name="xwaktu" disabled dlass="form-control" value="<?php echo $tanggal_laporan;?>" id="inputUserName" placeholder="Contoh: 10.30-11.00 WIB" required>
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">

                       <td>
                            <?php if ($i['laporan_status']=="1") { ?>
                            <span class="label label-success">belum proses</span>
                            <?php }else if ($i['laporan_status']=="2") { ?>
                            <span class="label label-primary">tercatat</span>
                            <?php }else if ($i['laporan_status']=="3") { ?>
                            <span class="label label-danger">ditolak</span>
                            <?php }else if ($i['laporan_status']=="4"){ ?>
                            <span class="label label-warning">selesai</span>
                            <?php } ?>
                        </td>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">

                     <select class="form-control select2" name="laporan_status" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <option value="2">Diproses</option>
                        <option value="3">Ditolak</option>
                        <option value="4">Selesai</option>           
                      </select>
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="xketeranganstatus" class="form-control" value="<?php echo $keterangan_status;?>" id="inputUserName" placeholder="Keterangan" required>
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
      <?php endforeach;?>
      <!-- Akhir modal edit Laporan -->

      <!--- awaal modal view Laporan--->

       <?php
      foreach ($data->result_array() as $i) :
      $no++;
      $id=$i['id'];
      $judul_laporan=$i['judul_laporan'];
      $id_kepada=$i['id_kepada'];
      $ditujukan_kepada=$i['ditujukan_kepada'];
      $kategori_laporan=$i['kategori_laporan'];
      $isi_laporan=$i['isi_laporan'];
      $lokasi=$i['lokasi'];
      $anggaran=$i['anggaran'];

      $id_pelapor=$i['id_pelapor'];
      $nama=$i['nama'];
      $email=$i['email'];
      $hp=$i['hp'];
      $tanggal_laporan=$i['tanggal_laporan'];
      $laporan_status=$i['laporan_status'];
      $keterangan_status=$i['keterangan_status'];
      $foto=$i['foto'];
      ?>
      
      <div class="modal fade" id="ModalView<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <input type="hidden" name="kode" value="<?php echo $id;?>">
                    <input type="text" name="xnama_agenda" disabled class="form-control" value="<?php echo $ditujukan_kepada;?>" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="kode" value="<?php echo $id;?>">
                    <input type="text" name="xnama_agenda" disabled class="form-control" value="<?php echo $judul_laporan;?>" id="inputUserName" placeholder="Nama Agenda" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="3" disabled name="xisilaporan" placeholder="Judul Laporan ..." required><?php echo $isi_laporan;?></textarea>
                  </div>
                </div>

                <!-- /.form group -->
                <!-- Date range -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">nama</label>
                  <div class="col-sm-7">
                    
                      <input type="text" name="xselesai" disabled value="<?php echo $nama;?>" class="form-control pull-right datepicker4" required>
                    
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                  <div class="col-sm-7">
                      <input type="text" name="xlokasi" disabled value="<?php echo $lokasi;?>" class="form-control pull-right datepicker4" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Anggaran</label>
                  <div class="col-sm-7">
                      <input type="text" name="xanggaran" disabled value="<?php echo $anggaran;?>" class="form-control pull-right datepicker4" required>
                  </div>
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">email</label>
                  <div class="col-sm-7">
                    <input type="text" name="xtempat" disabled class="form-control" value="<?php echo $email;?>" id="inputUserName" placeholder="Tempat" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-7">
                    <input type="text" name="xwaktu" disabled class="form-control" value="<?php echo $tanggal_laporan;?>" id="inputUserName" placeholder="Contoh: 10.30-11.00 WIB" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-7">

                       <td>
                            <?php if ($i['laporan_status']=="1") { ?>
                            <span class="label label-success">belum proses</span>
                            <?php }else if ($i['laporan_status']=="2") { ?>
                            <span class="label label-primary">tercatat</span>
                            <?php }else if ($i['laporan_status']=="3") { ?>
                            <span class="label label-danger">ditolak</span>
                            <?php }else if ($i['laporan_status']=="4"){ ?>
                            <span class="label label-warning">selesai</span>
                            <?php } ?>
                          </td>
              <!--       <textarea class="form-control" name="xketerangan" rows="2" placeholder="Keterangan ..."><?php echo $laporan_status;?></textarea> -->
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <input type="text" name="xketeranganstatus" disabled class="form-control" value="<?php echo $keterangan_status;?>" id="inputUserName" placeholder="Keterangan" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Galeri</label>
                  <div class="col-sm-7">
                    <img src="<?php echo base_url().'assets/images/'.$foto;?>" style="width:190px;">
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
      <?php endforeach;?>
      <!-- Akhir modal edit Laporan -->


      <!---- akhir view laporan --->

      
      <?php foreach ($data->result_array() as $i) :
      $id=$i['id'];
      $judul_laporan=$i['judul_laporan'];
      $foto=$i['foto'];
      ?>
      <!--Modal Hapus Laporan masyon-->
      <div class="modal fade" id="ModalHapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title" id="myModalLabel">Hapus Laporan</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'admin/laporan/hapus_laporan'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="kode" value="<?php echo $id;?>"/>
                <input type="hidden" value="<?php echo $foto;?>" name="gambar">
                <p>Apakah Anda yakin mau menghapus Laporan <b><?php echo $judul_laporan;?></b> ?</p>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php endforeach;?>
      
      
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
      <script>
      $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
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