<?php
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
$uri4 = $this->uri->segment(4);
?>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <center>
        <li class="header"><img src="<?php echo base_url() . 'theme/images/mylogomini.png' ?>"></li>
      </center>
      <li>
        <a href="<?php echo base_url() . 'admin/dashboard' ?>">
          <i class="fa fa-home"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <?php
      $hsl = $this->db->query("SELECT * FROM tbl_laporan where laporan_status='1'");
      $jml_notifikasi = $hsl->num_rows();
      ?>
      <li>
        <a href="<?php echo base_url() . 'admin/laporan/notifadmin/' ?>">
          <i class="fa fa-envelope"></i> <span>Notifikasi Baru</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red"><?php echo $jml_notifikasi; ?></small>
          </span>
        </a>
      </li>

      <?php
      $hsl = $this->db->query("SELECT * FROM tbl_laporan_disabilitas where status='1'");
      $jml_notifikasi = $hsl->num_rows();
      ?>
      <li>
        <a href="<?php echo base_url() . 'admin/laporan/notifadmin_disabilitas/' ?>">
          <i class="fa fa-wheelchair"></i> <span>Notifikasi Disabilitas</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red"><?php echo $jml_notifikasi; ?></small>
          </span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-commenting"></i>
          <span>Semua Aduan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <?php
          $level = $this->session->userdata('pengguna_level');
          // echo $level;
          $id_admin = $this->session->userdata('idadmin');
          $q = $this->db->query("SELECT * FROM tbl_admin WHERE pengguna_id='$id_admin'");
          $c = $q->row_array();
          ?>

          <?php if ($level === '1') : ?>
            <!-- <li><a href="< ?php echo base_url().'admin/laporan'?>"><i class="fa fa-list"></i> Data Aduan < ?php echo $c['pengguna_nama'];?></a></li> Asli mas Yon-->
            <li><a href="<?php echo base_url() . 'admin/laporan' ?>"><i class="fa fa-list"></i> Data Aduan <?php echo isset($c['pengguna_nama']); ?></a></li>

          <?php endif; ?>

          <?php if ($level === '2') : ?>
            <!-- <li><a href="< ?php echo base_url().'admin/laporan/opd'?>"><i class="fa fa-list"></i> Data Aduan < ?php echo $c['pengguna_nama'];?></a></li> Asli mas Yon -->
            <li><a href="<?php echo base_url() . 'admin/laporan/opd' ?>"><i class="fa fa-list"></i> Data Aduan <?php echo isset($c['pengguna_nama']); ?></a></li>
          <?php endif; ?>

          <!-- <li><a href="< ?php echo base_url().'admin/laporan/semua'?>"><i class="fa fa-list"></i> Data Semua Aduan</a></li> -->
          <li><a href="<?php echo base_url() . 'admin/laporan/disabilitas' ?>"><i class="fa fa-list"></i> Data Aduan Disabilitas</a></li> <!-- Update Dudunk -->
        </ul>
      </li>

      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-code"></i>
          <span>Tindak Lanjut</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="< ?php echo base_url() . 'admin/selesai2' ?>"><i class="fa fa-list"></i> Daftar TL Aduan</a></li>
        </ul>
      </li> -->

      <li class="treeview">
        <a href="#">
          <i class="fa fa-bars"></i>
          <span>Laporan Cetak</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <?php
          $id_admin = $this->session->userdata('idadmin');
          $q = $this->db->query("SELECT * FROM tbl_admin WHERE pengguna_id='$id_admin'");
          $c = $q->row_array();
          ?>

          <li><a href="<?php echo base_url() . 'admin/cetak' ?>" target="_blank"><i class="fa fa-list"></i> Cetak Semua Aduan</a></li>
          <li><a href="<?php echo base_url() . 'admin/cetak/cetak_excel' ?>" target="_blank"><i class="fa fa-list"></i> Cetak Semua Aduan (Excel)</a></li>
          <li><a href="#" data-toggle="modal" data-target="#ModalCetak"><i class="fa fa-list"></i> Cetak Aduan Costum</a></li>
          <li><a href="#" data-toggle="modal" data-target="#ModalCetaksurvei"><i class="fa fa-list"></i> Cetak Laporan Survei</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-gears"></i>
          <span>Setting Kategori</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . 'admin/kategori_laporan' ?>"><i class="fa fa-wrench"></i> Kategori</a></li>
          <li><a href="<?php echo base_url() . 'admin/kategori_laporan/subkategori' ?>"><i class="fa fa-gear"></i> Sub-Kategori</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Manajemen User</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . 'admin/useradmin' ?>"><i class="fa fa-thumb-tack"></i>Admin</a></li>
          <!-- <li><a href="< ?php echo base_url().'admin/user'?>"><i class="fa fa-list"></i>Semua User</a></li> -->
        </ul>
      </li>

      <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-camera"></i>
                <span>Gallery</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="< ?php echo base_url().'admin/album'?>"><i class="fa fa-clone"></i> Album</a></li>
                <li><a href="< ?php echo base_url().'admin/galeri'?>"><i class="fa fa-picture-o"></i> Photos</a></li>
              </ul>
            </li> -->
      <!-- <li>
              <a href="< ?php echo base_url().'admin/komentar'?>">
                <i class="fa fa-comment"></i> <span>Komentar</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">5</small>
                </span>
              </a>
            </li> -->

      <li>
        <a href="<?php echo base_url() . 'admin/administrator/logout' ?>">
          <i class="fa fa-sign-out"></i> <span>Sign Out</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Awal Modal Cetak Laporan Aduan Custom -->
<div class="modal fade" id="ModalCetak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Cetak Aduan</h4>
      </div>
      <form id="form_cetak_antara" class="form-horizontal" action="<?php echo base_url() . 'admin/cetak/antara' ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Dari</label>
            <div class="col-sm-7">
              <input type="date" name="x_dari" class="form-control" id="x_dari">
            </div>
          </div>
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Sampai</label>
            <div class="col-sm-7">
              <input type="date" name="x_sampai" class="form-control" id="x_sampai">
            </div>
          </div>
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Format</label>
            <div class="col-sm-7">
              <select class="form-control select2" name="x_format" style="width: 100%;" required>
                <option value="excel">excel</option>
                <option value="web">web</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-circle" id="cetak" target="_blank">Cetak</button>
          <button type="reset" class="btn btn-danger btn-circle">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Akhir Modal Cetak Laporan Aduan Custom -->

<!-- Awal Modal Cetak Laporan Hasil Survei Custom -->
<div class="modal fade" id="ModalCetaksurvei" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Cetak Laporan Survei</h4>
      </div>
      <form id="form_cetak_antara" class="form-horizontal" action="<?php echo base_url() . 'admin/cetak/antara_survei' ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Dari</label>
            <div class="col-sm-7">
              <input type="date" name="x_dari" class="form-control" id="x_dari">
            </div>
          </div>
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Sampai</label>
            <div class="col-sm-7">
              <input type="date" name="x_sampai" class="form-control" id="x_sampai">
            </div>
          </div>
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Format</label>
            <div class="col-sm-7">
              <select class="form-control select2" name="x_format" style="width: 100%;" required>
                <option value="excel">excel</option>
                <option value="web">web</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-circle" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-circle" id="cetak" target="_blank">Cetak</button>
          <button type="reset" class="btn btn-danger btn-circle">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Akhir Modal Cetak Laporan Hasil Survei Custom -->

<!-- jQuery 3.3.1 -->
<script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-3.3.1.js' ?>"></script>

<script>
  $('#tbl_laporan').on('click', '.item_hapus', function() {
    var id = $(this).attr('data');
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('admin/laporan/get_modaledit') ?>",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function(data) {
        $.each(data, function(i, field) {
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
</script>