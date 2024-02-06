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
        <a href="<?php echo base_url() . 'admin/dashboard/opd' ?>">
          <i class="fa fa-home"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <?php
      $id_kepada = $this->session->userdata('pengguna_idskpd');
      $hsl = $this->db->query("SELECT * FROM tbl_laporan where laporan_status='2' AND id_kepada = '$id_kepada'");
      $jml_notifikasi = $hsl->num_rows();
      ?>

      <li>
        <a href="<?php echo base_url() . 'admin/laporan/notifopd' ?>">
          <i class="fa fa-envelope"></i> <span>Notifikasi Baru</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red"><?php echo $jml_notifikasi; ?></small>
          </span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-commenting"></i>
          <span>Aduan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <?php
          $id_kepada = $this->session->userdata('pengguna_idskpd');
          $level = $this->session->userdata('pengguna_level');
          // echo $level;
          $id_admin = $this->session->userdata('pengguna_id');
          $q = $this->db->query("SELECT * FROM tbl_admin WHERE pengguna_id='$id_kepada'");
          $c = $q->row_array();
          ?>

          <?php if ($level === '1') : ?>
            <!-- <li><a href="< ?php echo base_url().'admin/laporan'?>"><i class="fa fa-list"></i> Data Aduan < ?php echo $c['pengguna_nama'];?></a></li> -->
            <li><a href="<?php echo base_url() . 'admin/laporan' ?>"><i class="fa fa-list"></i> Data Aduan <?php echo isset($c['pengguna_nama']); ?></a></li>
          <?php endif; ?>

          <?php if ($level === '2') : ?>
            <!-- <li><a href="< ?php echo base_url().'admin/laporan/opd'?>"><i class="fa fa-list"></i> Data Aduan < ?php echo $c['pengguna_nama'];?></a></li> -->
            <li><a href="<?php echo base_url() . 'admin/laporan/opd' ?>"><i class="fa fa-list"></i> Data Aduan <?php echo isset($c['pengguna_nama']); ?></a></li>
          <?php endif; ?>

          <!-- <li><a href="< ?php echo base_url().'admin/laporan/semua'?>"><i class="fa fa-list"></i> Data Semua Aduan</a></li> -->
        </ul>
      </li>

      <!-- Report OPD -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bars"></i>
          <span>Report Aduan</span>
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
          <li><a href="#" data-toggle="modal" data-target="#ModalCetak"><i class="fa fa-list"></i> Cetak Rekap Aduan</a></li>
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
        </ul>
      </li>

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
      <form id="form_cetak_antara" class="form-horizontal" action="<?php echo base_url() . 'admin/cetak/antara_opd' ?>" method="post" enctype="multipart/form-data">
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