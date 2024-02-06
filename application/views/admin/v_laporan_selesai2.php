<!--Counter Inbox-->
<?php
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan = $query->num_rows();
$query1 = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
$jum_komentar = $query1->num_rows();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

  <?php
  function limit_words($string, $word_limit)
  {
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
  }

  ?>

</head>

<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    <!--Header-->
    <?php
    $this->load->view('admin/v_header');
    $level = $this->session->userdata('pengguna_level');
    ?>
    <?php if ($level === '1') : ?>
      <?php $this->load->view('admin/v_sidebar2'); ?>
    <?php endif; ?>

    <?php if ($level === '2') : ?>
      <?php $this->load->view('admin/v_sidebar2_opd'); ?>
    <?php endif; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Data Aduan dengan Status : <b style="color:forestgreen;">Selesai</b>
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Aduan Selesai</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="datatable_selesai" class="table table-striped" style="font-size:13px;">
                    <thead>
                      <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Tiket Aduan | Tgl. | Sumber</th>
                        <th style="text-align:center;">Rincian Laporan | Lokasi | Bukti Dukung</th>
                        <th style="text-align:center;" title="Nama / HP/WA / ID Medsos Pelapor">Pelapor | HP/WA/ID</th>
                        <th style="text-align:center;" title="Perangkat Daerah Terkait">OPD</th>
                        <th style="text-align:center;" title="Status TL / Durasi TL / Rating Jawaban">Status/Durasi/Rating</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      foreach ($data->result_array() as $i) :
                        $no++;
                        $id = $i['id'];
                        $id_kepada = $i['id_kepada'];
                        $ditujukan_kepada = $i['ditujukan_kepada'];
                        $isi_laporan = $i['isi_laporan'];
                        $lokasi = $i['lokasi'];
                        $nama = $i['nama'];
                        $alamat = $i['alamat'];
                        $hp = $i['hp'];
                        $sumber_aduan = $i['sumber_aduan'];
                        $tanggal_laporan = $i['tanggal_laporan'];
                        $tanggal_tindaklanjut = $i['tanggal_tindaklanjut'];
                        $laporan_status = $i['laporan_status'];
                        $rating_jawaban = $i['rating_jawaban'];
                        $foto = $i['foto'];
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td>
                            <?php if ($i['sumber_aduan'] == 'LB') { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'Website Lapor Bupati'; ?>
                            <?php } else if ($i['sumber_aduan'] == "LG") { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'Website Lapor Gubernur'; ?>
                            <?php } else if ($i['sumber_aduan'] == "SP") { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'SP4N LAPOR'; ?>
                            <?php } else if ($i['sumber_aduan'] == "WA") { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'Whatsapp Laporbup'; ?>
                            <?php } else if ($i['sumber_aduan'] == "SM") { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'SMS Laporbup'; ?>
                            <?php } else if ($i['sumber_aduan'] == "IG") { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'Instagram Laporbup'; ?>
                            <?php } else if ($i['sumber_aduan'] == "FB") { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'Facebook Laporbup'; ?>
                            <?php } else if ($i['sumber_aduan'] == "TW") { ?>
                              <?php echo '<b style="color:red;">LB' . $sumber_aduan . '-' . $id . '</b><br><br>' . $tanggal_laporan . '<br><br>' . 'Twitter Laporbup'; ?>
                            <?php } else echo "-"; ?>
                          </td>
                          <td align="justify"><?php echo $isi_laporan . '<br><br>' . '<i class="fa fa-map-marker" aria-hidden="true"></i> ' . $lokasi . '<br><br>'; ?><img src="<?php echo base_url() . 'assets/images/' . $foto; ?>" style="width:90px;"></td>
                          <td><?php echo $nama . '<br>' . $hp; ?></td>
                          <td><?php echo $ditujukan_kepada; ?></td>
                          <td>
                            <?php if ($i['laporan_status'] == "1") { ?>
                              <span class="label label-danger">Verifikasi</span>
                            <?php } else if ($i['laporan_status'] == "2") { ?>
                              <span class="label label-warning">Sedang Proses</span>
                            <?php } else if ($i['laporan_status'] == "99") { ?>
                              <span class="label label-info">Ditolak</span>
                            <?php } else if ($i['laporan_status'] == "3") { ?>
                              <a class="btn btn-xs btn-success btn-circle" data-toggle="modal" data-target="#ModalView<?php echo $id; ?>" title="View Detail"><span class="fa fa-eye"></span>&nbsp; Selesai</a>
                            <?php } ?>
                            <br><br>
                            <span>
                              <?php
                              $awal  = date_create($tanggal_laporan);
                              $akhir = date_create($tanggal_tindaklanjut);
                              $diff  = date_diff($awal, $akhir);
                              echo $diff->format('<p style="color:red;"><b>%Y</b> th <b>%m</b> bl <b>%d</b> hr<br><b>%h</b> jam <b>%i</b> menit <b>%s</b> detik</p>');
                              ?>
                            </span>
                            <?php if ($i['rating_jawaban'] == "1") { ?>
                              <span style="color:gold;"><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                            <?php } else if ($i['rating_jawaban'] == "2") { ?>
                              <span style="color:gold;"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                            <?php } else if ($i['rating_jawaban'] == "3") { ?>
                              <span style="color:gold;"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                            <?php } else if ($i['rating_jawaban'] == "4") { ?>
                              <span style="color:gold;"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></span>
                            <?php } else if ($i['rating_jawaban'] == "5") { ?>
                              <span style="color:gold;"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                            <?php } else { ?>
                              <span style="color:gold;"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                            <?php } ?>
                            <!-- < ?php echo $rating_jawaban;?> -->
                          </td>
                          <!-- <td style="text-align:center;">
                            <a class="btn btn-xs btn-primary btn-circle" data-toggle="modal" data-target="#ModalView< ?php echo $id;?>" title="View Detail"><span class="fa fa-eye"></span></a>
                          </td> -->
                        </tr>
                      <?php endforeach; ?>
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
        <b>Version</b> 3.0
      </div>
      <strong>© Lapor Bupati Wonosobo</strong>
    </footer>

    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- modal Edit Laporan -->
  <?php
  foreach ($data->result_array() as $i) :
    $no++;
    $id = $i['id'];
    $judul_laporan = $i['judul_laporan'];
    $id_kepada = $i['id_kepada'];
    $ditujukan_kepada = $i['ditujukan_kepada'];
    $kategori_laporan = $i['kategori_laporan'];
    $isi_laporan = $i['isi_laporan'];
    $id_pelapor = $i['id_pelapor'];
    $nama = $i['nama'];
    $email = $i['email'];
    $hp = $i['hp'];
    $tanggal_laporan = $i['tanggal_laporan'];
    $laporan_status = $i['laporan_status'];
    $keterangan_status = $i['keterangan_status'];
    $foto = $i['foto'];
  ?>

    <div class="modal fade" id="ModalEdit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Tindak Lanjut Laporan</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/update_status' ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Kepada</label>
                <div class="col-sm-7">

                  <input type="hidden" name="kode" value="<?php echo $id; ?>">
                  <input type="text" name="xnama_agenda" disabled class="form-control" value="<?php echo $ditujukan_kepada; ?>" id="inputUserName" placeholder="Nama Agenda" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                <div class="col-sm-7">
                  <input type="hidden" name="kode" value="<?php echo $id; ?>">
                  <input type="text" name="xnama_agenda" disabled class="form-control" value="<?php echo $judul_laporan; ?>" id="inputUserName" placeholder="Nama Agenda" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                <div class="col-sm-7">
                  <textarea class="form-control" rows="3" disabled name="xisilaporan" placeholder="Judul Laporan ..." required><?php echo $isi_laporan; ?></textarea>
                </div>
              </div>

              <!-- /.form group -->
              <!-- Date range -->
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">nama</label>
                <div class="col-sm-7">

                  <input type="text" name="nama" disabled value="<?php echo $nama; ?>" class="form-control pull-right datepicker4" required>

                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">email</label>
                <div class="col-sm-7">
                  <input type="text" name="email" disabled class="form-control" value="<?php echo $email; ?>" id="inputUserName" placeholder="Tempat" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                <div class="col-sm-7">
                  <input type="text" name="xwaktu" disabled dlass="form-control" value="<?php echo $tanggal_laporan; ?>" id="inputUserName" placeholder="Contoh: 10.30-11.00 WIB" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                <div class="col-sm-7">
                  <td>
                    <?php if ($i['laporan_status'] == "1") { ?>
                      <span class="label label-danger">belum proses</span>
                    <?php } else if ($i['laporan_status'] == "2") { ?>
                      <span class="label label-warning">diterima</span>
                    <?php } else if ($i['laporan_status'] == "3") { ?>
                      <span class="label label-info">ditolak</span>
                    <?php } else if ($i['laporan_status'] == "4") { ?>
                      <span class="label label-success">selesai</span>
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
                  <input type="text" name="xketeranganstatus" class="form-control" value="<?php echo $keterangan_status; ?>" id="inputUserName" placeholder="Keterangan" required>
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
  <?php endforeach; ?>
  <!-- Akhir modal edit Laporan -->

  <!--- Awal modal view Laporan--->

  <?php
  foreach ($data->result_array() as $i) :
    $no++;
    $id = $i['id'];
    $judul_laporan = $i['judul_laporan'];
    $id_kepada = $i['id_kepada'];
    $ditujukan_kepada = $i['ditujukan_kepada'];
    $kategori_laporan = $i['kategori_laporan'];
    $isi_laporan = $i['isi_laporan'];
    $lokasi = $i['lokasi'];
    $id_pelapor = $i['id_pelapor'];
    $nama = $i['nama'];
    $email = $i['email'];
    $hp = $i['hp'];
    $tanggal_laporan = $i['tanggal_laporan'];
    $laporan_status = $i['laporan_status'];
    $keterangan_tindaklanjut = $i['keterangan_tindaklanjut'];
    $tanggal_tindaklanjut = $i['tanggal_tindaklanjut'];
    $tindaklanjut = $i['tindaklanjut'];
    $foto = $i['foto'];
  ?>

    <div class="modal fade" id="ModalView<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h3 class="modal-title" id="myModalLabel">Rincian</h3>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'admin/agenda/update_agenda' ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <h4 class="modal-title" align="center">
                <p style="color:red; font-size:21px;"><b>Data Aduan</b></p>
              </h4>
              <hr>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">No. Tiket Aduan</label>
                <div class="col-sm-7">
                  <input type="text" name="xid" disabled class="form-control" value="<?php echo 'LB' . $sumber_aduan . '-' . $id; ?>" id="inputUserName" placeholder="No. Tiket Aduan" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Tgl. Aduan Masuk</label>
                <div class="col-sm-7">
                  <input type="text" name="xwaktu" disabled class="form-control" value="<?php echo $tanggal_laporan; ?>" id="inputUserName" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Judul Aduan</label>
                <div class="col-sm-7">
                  <input type="hidden" name="kode" value="<?php echo $id; ?>">
                  <input type="text" name="xnama_agenda" disabled class="form-control" value="<?php echo $judul_laporan; ?>" id="inputUserName" placeholder="Judul Aduan" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Lokasi Aduan</label>
                <div class="col-sm-7">
                  <input type="text" name="xlokasi" disabled class="form-control" value="<?php echo $lokasi; ?>" id="inputUserName" placeholder="Lokasi Aduan" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Isi Aduan</label>
                <div class="col-sm-7">
                  <textarea class="form-control" rows="3" disabled name="xisilaporan" required><?php echo $isi_laporan; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Nama Pelapor</label>
                <div class="col-sm-7">
                  <input type="text" name="xselesai" disabled value="<?php echo $nama; ?>" class="form-control pull-right datepicker4" required>
                </div>
              </div>

              <hr>
              <h4 class="modal-title" align="center">
                <p style="color:forestgreen; font-size:21px;"><b>Tindak Lanjut</b></p>
              </h4>
              <hr>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Tgl. Tindaklanjut</label>
                <div class="col-sm-7">
                  <input type="text" name="xwaktutl" disabled class="form-control" value="<?php echo $tanggal_tindaklanjut; ?>" id="inputUserName" required>
                </div>
              </div>

              <!-- <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Keterangan TL</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="2" disabled name="xketerangantl" required>< ?php echo $keterangan_tindaklanjut;?></textarea>
                  </div>
                </div> -->

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Uraian Tindaklanjut</label>
                <div class="col-sm-7">
                  <textarea class="form-control" rows="3" disabled name="xtindaklanjut" required><?php echo $tindaklanjut; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Durasi TL</label>
                <div class="col-sm-7">
                  <td>
                    <?php
                    $awal  = date_create($tanggal_laporan);
                    $akhir = date_create($tanggal_tindaklanjut);
                    $diff  = date_diff($awal, $akhir);
                    echo $diff->format('<p style="color:red; font-size:15px; margin-top: 6px;"><b>%Y</b> tahun <b>%m</b> bulan <b>%d</b> hari <b>%h</b> jam <b>%i</b> menit <b>%s</b> detik</p>');
                    ?>
                  </td>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Status TL</label>
                <div class="col-sm-7">
                  <td>
                    <?php if ($i['laporan_status'] == "1") { ?>
                      <span class="label label-danger">Verifikasi</span>
                    <?php } else if ($i['laporan_status'] == "2") { ?>
                      <span class="label label-warning">Sedang Proses</span>
                    <?php } else if ($i['laporan_status'] == "3") { ?>
                      <span class="label label-success">Selesai</span>
                    <?php } else if ($i['laporan_status'] == "99") { ?>
                      <span class="label label-info">Ditolak</span>
                    <?php } ?>
                  </td>
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
  <?php endforeach; ?>
  <!-- Akhir modal view Laporan -->


  <!---- awal modal hapus laporan --->

  <?php foreach ($data->result_array() as $i) :
    $id = $i['id'];
    $judul_laporan = $i['judul_laporan'];
    $foto = $i['foto'];
  ?>
    <!--Modal Hapus Laporan masyon-->
    <div class="modal fade" id="ModalHapus<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Hapus Laporan</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'admin/laporan/hapus_laporan' ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="hidden" name="kode" value="<?php echo $id; ?>" />
              <input type="hidden" value="<?php echo $foto; ?>" name="gambar">
              <p>Apakah Anda yakin mau menghapus Laporan <b><?php echo $judul_laporan; ?></b> ?</p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>


  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
  <!-- page script -->
  <script>
    $(function() {
      $('#datatable_selesai').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "scrollX": true
      });
    });
  </script>
  <?php if ($this->session->flashdata('msg') == 'error') : ?>
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

  <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
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
  <?php elseif ($this->session->flashdata('msg') == 'info') : ?>
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
  <?php elseif ($this->session->flashdata('msg') == 'success-hapus') : ?>
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
  <?php else : ?>
  <?php endif; ?>
</body>

</html>