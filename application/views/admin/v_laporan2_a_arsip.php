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
        <meta
            content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
            name="viewport">
        <link
            rel="shorcut icon"
            type="text/css"
            href="<?php echo base_url().'assets/images/favicon.png'?>">
        <!-- Bootstrap 3.3.6 -->
        <link
            rel="stylesheet"
            href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
        <!-- DataTables -->
        <link
            rel="stylesheet"
            href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
        <!-- Theme style -->
        <link
            rel="stylesheet"
            href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of
        downloading all of them to reduce the load. -->
        <link
            rel="stylesheet"
            href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

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
                        <li>
                            <a href="<?php echo base_url('admin/dashboard');?>">
                                <i class="fa fa-dashboard"></i>
                                Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/laporan');?>">Aduan</a>
                        </li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">

                                <div class="box">
                                    <div class="box-header">
                                        <a
                                            class="btn btn-success btn-flat"
                                            href="<?php echo base_url().'admin/laporan/add_laporan'?>">
                                            <span class="fa fa-plus"></span>
                                            Add New</a>
                                        <!-- <a class="btn btn-danger btn-flat" href="<?php echo
                                        base_url().'admin/laporan/add_tambahan'?>"><span class="fa fa-plus"></span>
                                        Tambahan</a> -->
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
                                                    <th>Medsos/hp</th>
                                                    <th>tanggal</th>
                                                    <th>status</th>
                                                    <th>tayang</th>
                                                    <th style="text-align:right;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_tbl_laporan"></tbody>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b>
                    1.0
                </div>
                <strong>@laporbupati</strong>
            </footer>

        </div>
    </div>
    <!-- ./wrapper -->
    <!-- modal Edit Laporan -->

    <div
        class="modal fade"
        id="ModalEdit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Aduan</h4>
                </div>
                <form
                    class="form-horizontal"
                    action="<?php echo base_url().'admin/laporan/update_laporan'?>"
                    method="post"
                    enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Kategori Laporan</label>
                            <div class="col-sm-7">
                                <select
                                    class="form-control select2"
                                    name="x_kategori_laporan_edit"
                                    style="width: 100%;"
                                    required="required">
                                    <option value="">-Pilih-</option>
                                    <option value="1">Fisik</option>
                                    <option value="2">Non Fisik</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="xkode_edit" id="xkode_edit">
                            <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_ditujukan_kepada_edit"
                                    disabled="disabled"
                                    class="form-control"
                                    id="x_ditujukan_kepada_edit"
                                    placeholder="Kepada "
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_judul_laporan_edit"
                                    class="form-control"
                                    id="x_judul_laporan_edit"
                                    placeholder="Judul Aduan"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                            <div class="col-sm-7">
                                <textarea
                                    class="form-control"
                                    rows="3"
                                    name="x_isi_laporan_edit"
                                    id="x_isi_laporan_edit"
                                    required="required"></textarea>
                            </div>
                        </div>

                        <!-- /.form group -->
                        <!-- Date range -->
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_nik_edit"
                                    disabled="disabled"
                                    id="x_nik_edit"
                                    class="form-control pull-right datepicker4"
                                    required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_nama_edit"
                                    disabled="disabled"
                                    id="x_nama_edit"
                                    class="form-control pull-right datepicker4"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_lokasi_edit"
                                    id="x_lokasi_edit"
                                    class="form-control pull-right datepicker4"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                            <div class="col-sm-7">
                                <select
                                    class="form-control select2"
                                    name="x_laporan_status_edit"
                                    style="width: 100%;"
                                    required="required">
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
                                <input
                                    type="text"
                                    name="x_keterangan_status_edit"
                                    class="form-control"
                                    id="x_keterangan_status_edit"
                                    placeholder="Keterangan"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Tindak Lanjut</label>
                            <div class="col-sm-7">
                                <textarea
                                    type="text"
                                    name="x_tindak_lanjut_edit"
                                    class="form-control"
                                    id="x_keterangan_status_edit"
                                    placeholder="Keterangan"
                                    required="required"></div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Sumber Medsos / HP Pelapor</label>
                                <div class="col-sm-7">
                                    <input
                                        type="text"
                                        name="x_hp_edit"
                                        class="form-control"
                                        id="x_keterangan_status_edit"
                                        placeholder="Keterangan"
                                        required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Upload/Ganti Foto</label>
                                <div class="col-sm-7">
                                    <input type="file" name="x_foto_edit">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Akhir modal edit Laporan -->

    <!--- awaal modal view Laporan--->

    <div
        class="modal fade"
        id="ModalView"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Aduan</h4>
                </div>
                <form
                    class="form-horizontal"
                    action="<?php echo base_url().'admin/laporan/update_laporan'?>"
                    method="post"
                    enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Kategori Laporan</label>
                            <div class="col-sm-7">
                                <select
                                    class="form-control select2"
                                    name="x_kategori_laporan_view"
                                    style="width: 100%;"
                                    required="required">
                                    <option value="">-Pilih-</option>
                                    <option value="1">Fisik</option>
                                    <option value="2">Non Fisik</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="xkode_view" id="xkode_view">
                            <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_ditujukan_kepada_view"
                                    disabled="disabled"
                                    class="form-control"
                                    id="x_ditujukan_kepada_view"
                                    placeholder="Kepada "
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_judul_laporan_view"
                                    class="form-control"
                                    id="x_judul_laporan_view"
                                    placeholder="Judul Aduan"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                            <div class="col-sm-7">
                                <textarea
                                    class="form-control"
                                    rows="3"
                                    name="x_isi_laporan_view"
                                    id="x_isi_laporan_view"
                                    required="required"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="x_nik_view"
                                    disabled="disabled"
                                    id="x_nik_view"
                                    class="form-control pull-right datepicker4"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="x_nama_view" id="x_nama_view">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Lokasi</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="x_lokasi_view" id="x_lokasi_view">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                            <div class="col-sm-7">
                                <select
                                    class="form-control select2"
                                    name="x_laporan_status_view"
                                    style="width: 100%;"
                                    required="required">
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
                                <input
                                    type="text"
                                    name="x_keterangan_status_view"
                                    class="form-control"
                                    id="x_keterangan_status_view"
                                    placeholder="Keterangan"
                                    required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Tindak Lanjut</label>
                            <div class="col-sm-7">
                                <textarea
                                    type="text"
                                    name="x_tindak_lanjut_view"
                                    class="form-control"
                                    id="x_keterangan_status_view"
                                    placeholder="Keterangan"
                                    required="required"></div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Sumber Medsos / HP Pelapor</label>
                                <div class="col-sm-7">
                                    <input
                                        type="text"
                                        name="x_hp_view"
                                        class="form-control"
                                        id="x_keterangan_status_view"
                                        placeholder="Keterangan"
                                        required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Upload/Ganti Foto</label>
                                <div class="col-sm-7">
                                    <input type="file" name="x_foto_view">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!---- akhir view laporan --->

    <!--Modal Hapus Laporan masyon-->

    <!-- Modal Teruskan -->
    <div
        class="modal fade"
        id="ModalTeruskan"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Teruskan Aduan</h4>
                </div>
                <form
                    id="form_teruskan"
                    class="form-horizontal"
                    action="<?php echo base_url().'admin/laporan/update_laporan'?>"
                    method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="xkode_teruskan" id="xkode_teruskan">
                            <label for="inputUserName" class="col-sm-4 control-label">Teruskan Kepada</label>
                            <div class="col-sm-7">
                                <select
                                    class="form-control select2"
                                    name="xidkepada_teruskan"
                                    id="xidkepada_teruskan"
                                    style="width: 100%;"
                                    required="required">
                                    <option value="">-Pilih-</option>
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
                                <input
                                    type="text"
                                    name="xjudullaporan_teruskan"
                                    class="form-control"
                                    id="xjudullaporan_teruskan"
                                    placeholder="Nama Agenda"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                            <div class="col-sm-7">
                                <textarea
                                    class="form-control"
                                    rows="3"
                                    name="xisilaporan_teruskan"
                                    id="xisilaporan_teruskan"
                                    required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Keterangan</label>
                            <div class="col-sm-7">
                                <input
                                    type="text"
                                    name="xketeranganstatus_teruskan"
                                    class="form-control"
                                    id="xketeranganstatus_teruskan"
                                    placeholder="Keterangan"
                                    required="required">
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
    <script
        src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
    <!-- DataTables -->
    <script
        src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
    <script
        src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
    <!-- SlimScroll -->
    <script
        src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
    <script
        type="text/javascript"
        src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
    <!-- page script -->

    <script type="text/javascript">
        $(document).ready(function () {
            tampil_data(); //pemanggilan fungsi tampil_data

            //fungsi tampil data
            function tampil_data() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url()?>admin/laporan/get_semua',
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        var base_urlx = "<?php echo base_url('assets/images/')?>";
                        var html = '';
                        var i;
                        var no = 0;
                        for (i = 0; i < data.length; i++) {
                            var no = no + 1;
                            var jenis = data[i].id_jenis;
                            if (jenis = 1) {
                                id_jenis = "Aduan";
                            }
                            var laporan = data[i].laporan_status;
                            if (laporan == 1) {
                                laporan_status = '<span class="label label-success">Verifikasi</span>';
                            } else if (laporan == 2) {
                                laporan_status = '<span class="label label-danger">Belum Proses</span>';
                            } else if (laporan == 99) {
                                laporan_status = '<span class="label label-warning">ditolak</span>';
                            } else {
                                laporan_status = '<span class="label label-info">selesai</span>';
                            }

                            html += '<tr><td>' + no + '</td>' +
                            // '<td>'+data[i].foto+'</td>'+
                            '<td><img src="' + base_urlx + data[i].foto + '" style="width:90px;" alt="no img"></td><td>'
                             + data[i].ditujukan_kepada + '</td><td>' + data[i].isi_laporan +
                                    '</td><td>' + data[i].nama + '</td><td>' + data[i].hp + '</td><td>' + data[i].tanggal_laporan +
                                    '</td><td>' + laporan_status + '</td><td><a href="javascript:;" class="btn btn-' +
                                    'info btn-xs item_tayang" data="' + data[i].id + '">' + data[i].tayang + '</a><' +
                                    '/td><td style="text-align:right;"><a href="javascript:;" class="btn btn-info b' +
                                    'tn-xs item_view" data="' + data[i].id + '">view</a> <a href="javascript:;" cla' +
                                    'ss="btn btn-info btn-xs item_edit" data="' + data[i].id + '">edit</a> <a href=' +
                                    '"javascript:;" class="btn btn-info btn-xs item_teruskan" data="' + data[i].id +
                                    '">teruskan</a> </td></tr>';
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

            //GET UPDATE
            $('#tbl_laporan').on('click', '.item_edit', function () {
                var id = $(this).attr('data');
                var base_urlx = "<?php echo base_url('assets/images/')?>";
                var gbr;
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('admin/laporan/get_modaledit')?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $.each(data, function (i, field) {
                            $('#ModalEdit').modal('show');
                            $('[name="xkode_edit"]').val(data[i].id);
                            $('[name="x_ditujukan_kepada_edit"]').val(data[i].ditujukan_kepada);
                            $('[name="x_judul_laporan_edit"]').val(data[i].judul_laporan);
                            $('[name="x_kategori_laporan_edit"]').val(data[i].kategori_laporan);
                            $('[name="x_isi_laporan_edit"]').val(data[i].isi_laporan);
                            $('[name="x_nik_edit"]').val(data[i].nik);
                            $('[name="x_nama_edit"]').val(data[i].nama);
                            $('[name="x_hp_edit"]').val(data[i].hp);
                            $('[name="x_lokasi_edit"]').val(data[i].lokasi);
                            $('[name="x_email_edit"]').val(data[i].email);
                            $('[name="x_tindak_lanjut_edit"]').val(data[i].tindak_lanjut);
                            $('[name="x_tanggallaporan"]').val(data[i].tanggal_laporan);
                            $('[name="x_laporan_status_edit"]').val(data[i].laporan_status);
                            $('[name="x_keterangan_status_edit"]').val(data[i].keterangan_status);

                            gbr += '<img src="' + base_urlx + data[i].foto + '" style="height:190px;">';
                            $('[name="foto_view"]').append(gbr);
                            $('[name="foto_view"]').refresh;
                        });
                    }
                });
                return false;
            });

            $('#tbl_laporan').on('click', '.item_view', function () {
                var id = $(this).attr('data');
                var gbr1 = '';
                var base_urlx = "<?php echo base_url('assets/images/')?>";

                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('admin/laporan/get_modaledit')?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $.each(data, function (i, field) {
                            var laporan_status = data.laporan_status;
                            if (laporan_status == 1) {
                                laporan_status = "verifikasi";
                            } else if (laporan_status == 2) {
                                laporan_status = "belum proses";
                            } else if (laporan_status == 3) {
                                laporan_status = "selesai";
                            }
                            $('#ModalView').modal('show');
                            $('[name="xkode_view"]').val(data[i].id);
                            $('[name="x_ditujukan_kepada_view"]').val(data[i].ditujukan_kepada);
                            $('[name="x_judul_laporan_view"]').val(data[i].judul_laporan);
                            $('[name="x_kategori_laporan_view"]').val(data[i].kategori_laporan);
                            $('[name="x_isi_laporan_view"]').val(data[i].isi_laporan);
                            $('[name="x_nik_view"]').val(data[i].nik);
                            $('[name="x_nama_view"]').val(data[i].nama);
                            $('[name="x_hp_view"]').val(data[i].hp);
                            $('[name="x_lokasi_view"]').val(data[i].lokasi);
                            $('[name="x_email_view"]').val(data[i].email);
                            $('[name="x_tindak_lanjut_view"]').val(data[i].tindak_lanjut);
                            $('[name="x_tanggallaporan"]').val(data[i].tanggal_laporan);
                            $('[name="x_laporan_status_view"]').val(data[i].laporan_status);
                            $('[name="x_keterangan_status_view"]').val(data[i].keterangan_status);

                            gbr1 += '<img src="' + base_urlx + data[i].foto + '" style="height:250px;widt:350px;" a' +
                                    'lt="Foto blm di Upload">';
                            $('#foto_view').append(gbr1);
                        });
                    }
                });
                return false;
            });

            //TERUSKAN
            $('#tbl_laporan').on('click', '.item_teruskan', function () {
                var id = $(this).attr('data');
                var gbr = '';
                var base_urlx = "<?php echo base_url('assets/images/')?>";;

                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('admin/laporan/get_modalteruskan')?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $.each(data, function () {
                            var laporan_status = data.laporan_status;
                            if (laporan_status == 1) {
                                laporan_status = "verifikasi";
                            } else if (laporan_status == 2) {
                                laporan_status = "belum proses";
                            } else if (laporan_status == 3) {
                                laporan_status = "selesai";
                            }

                            $('#ModalTeruskan').modal('show');
                            $('[name="xkode_teruskan"]').val(data.id);
                            $('[name="xidkepada_teruskan"]').val(data.ditujukan_kepada);
                            $('[name="xjudullaporan_teruskan"]').val(data.judul_laporan);
                            $('[name="xisilaporan_teruskan"]').val(data.isi_laporan);
                            $('[name="xnama_teruskan"]').val(data.nama);
                            $('[name="xlokasi_teruskan"]').val(data.lokasi);
                            $('[name="xanggaran_teruskan"]').val(data.anggaran);
                            $('[name="xemail_teruskan"]').val(data.email);
                            $('[name="xtanggallaporan_teruskan"]').val(data.tanggal_laporan);
                            $('[name="xlaporanstatus_teruskan"]').val(laporan_status);
                            $('[name="xketeranganstatus_teruskan"]').val(data.keterangan_status);

                        });
                    }
                });
                return false;
            });
            //TAYANG
            $('#tbl_laporan').on('click', '.item_tayang', function () {
                var id = $(this).attr('data');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/laporan/update_tayang')?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: window.location.href = "<?php echo base_url('admin/laporan');?>"
                    //  alert("data berhasil diupdate");
                });

                return false;
            });

            //GET HAPUS
            $('#myexample1').on('click', '.item_hapus', function () {
                var id = $(this).attr('data');
                $('#ModalHapus').modal('show');
                $('[name="kode"]').val(id);
            });

            //Simpan Barang
            $('#btn_simpan').on('click', function () {
                var kobar = $('#kode_barang').val();
                var nabar = $('#nama_barang').val();
                var harga = $('#harga').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('index.php/barang/simpan_barang')?>",
                    dataType: "JSON",
                    data: {
                        kobar: kobar,
                        nabar: nabar,
                        harga: harga
                    },
                    success: function (data) {
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
        function number_format(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number)
                ? 0
                : +number
            var prec = !isFinite(+decimals)
                ? 0
                : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined')
                ? ','
                : thousandsSep
            var dec = (typeof decPoint === 'undefined')
                ? '.'
                : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec)
                return '' + (
                    Math.round(n * k) / k
                ).toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (
                prec
                    ? toFixedFix(n, prec)
                    : '' + Math.round(n)
            ).split('.')
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
        $(document).ready(function () {
            $('#form_teruskan').submit(function (e) {

                e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url();?>admin/laporan/update_teruskan',
                    type: "post",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function (data) {
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