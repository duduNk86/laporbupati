<!--Counter Inbox-->
<!-- Hitung Notifikasi Aduan Umum -->
<?php 
    $level=$this->session->userdata('pengguna_level');
    $id_kepada=$this->session->userdata('pengguna_idskpd');
    $foto=$this->session->userdata('pengguna_photo');

    $query=$this->db->query("SELECT * FROM tbl_laporan WHERE laporan_status='1'");
    $jum_pesan=$query->num_rows();
?>

<!-- Hitung Notifikasi Aduan Disabilitas -->
<?php 
    $query=$this->db->query("SELECT * FROM tbl_laporan_disabilitas WHERE status='1'");
    $jum_pesan_disabilitas=$query->num_rows();
?>

<?php 
    $query=$this->db->query("SELECT * FROM tbl_laporan WHERE laporan_status='2' AND id_kepada ='$id_kepada'");
    $jum_pesan_opd=$query->num_rows();
?>

<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">L</span>
      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">LAPORBUP</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Aduan Umum -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              
              <span class="label label-success">
              <?php if($level==='1'):?>
                   <?php echo $jum_pesan;?>
               <?php endif;?>
  
               <?php if($level==='2'):?>
                   <?php echo $jum_pesan_opd;?>
               <?php endif;?>
                        
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki 
              <?php if($level==='1'):?>
                   <?php echo $jum_pesan;?>
               <?php endif;?>
  
               <?php if($level==='2'):?>
                   <?php echo $jum_pesan_opd;?>
               <?php endif;?>  

              laporan belum diproses</li>
              <li>
                
                <ul class="menu">
                    <?php if($level==='1'):?>
                        <?php 
                          $laporan=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d %M %Y') AS tanggal_laporan FROM tbl_laporan WHERE laporan_status='1' ORDER BY nomor DESC LIMIT 5");
                          $laporan_jum=$laporan->num_rows();
                          
                          foreach ($laporan->result_array() as $lap) :
                          $id=$lap['id'];
                          $judul_laporan=$lap['judul_laporan'];
                          $tanggal_laporan=$lap['tanggal_laporan'];
                          $isi_laporan=$lap['isi_laporan'];
                          $foto=$lap['foto'];
                       ?>
                      
                      <?php if ($laporan_jum>0):?>
                        <li>
                          <a href="<?php echo base_url().'admin/laporan/notifadmin'?>">
                            <div class="pull-left">
                              <img src="<?php echo base_url('assets/images/').$foto?>" class="img-circle" alt="User Image">
                            </div>
                            <p>
                              <small><i class="fa fa-clock-o"></i> <?php echo $tanggal_laporan;?></small></p>
                            <h4>
                              <?php echo $judul_laporan;?>
                            </h4>
                            <!-- <p>< ?php echo $isi_laporan;?></p> -->
                          </a>
                        </li>
                      <?php endif;?>
                      <?php endforeach;?>
                    <?php endif;?>
       
                    <?php if($level==='2'):?>
                        <?php 
                          $laporan_opd=$this->db->query("SELECT tbl_laporan.*,DATE_FORMAT(tanggal_laporan,'%d %M %Y') AS tanggal_laporan FROM tbl_laporan WHERE laporan_status='2' AND id_kepada = '$id_kepada' ORDER BY nomor DESC LIMIT 5");
                          $laporan_opd_jum=$laporan_opd->num_rows();

                          foreach ($laporan_opd->result_array() as $lap_opd) :
                          $id_opd=$lap_opd['id'];
                          $judul_laporan_opd=$lap_opd['judul_laporan'];
                          $tanggal_laporan_opd=$lap_opd['tanggal_laporan'];
                          $isi_laporan_opd=$lap_opd['isi_laporan'];
                          $foto=$lap_opd['foto'];
                       ?>
                      <?php if ($laporan_opd_jum>0):?>
                        <li><!-- start message -->
                          <a href="<?php echo base_url().'admin/laporan/notifopd'?>">
                            <div class="pull-left">
                              <img src="<?php echo base_url('assets/images/').$foto?>" class="img-circle" alt="User Image">
                            </div>
                            <p>
                              <small><i class="fa fa-clock-o"></i> <?php echo $tanggal_laporan_opd;?></small>
                            </p>
                            <h4>
                              <?php echo $judul_laporan_opd;?>
                            </h4>
                            <!-- <p>< ?php echo $isi_laporan_opd;?></p> -->
                          </a>
                        </li>
                      <?php endif;?>
                      <?php endforeach;?>
                      
                    <?php endif;?>
                  <!-- end notifikasi -->
                  
                </ul>
              </li>
              <?php if($level==='1'):?>
                <li class="footer"><a href="<?php echo base_url().'admin/laporan/notifadmin'?>">Lihat Semua Notifikasi Pesan</a></li>
               <?php endif;?>
              <?php if($level==='2'):?>
                <li class="footer"><a href="<?php echo base_url().'admin/laporan/notifopd'?>">Lihat Semua Notifikasi Pesan</a></li>
               <?php endif;?>
              
            </ul>
          </li>
          
          <!-- Aduan Disabilitas -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-wheelchair"></i>
              
              <span class="label label-success">
              <?php if($level==='1'):?>
                   <?php echo $jum_pesan_disabilitas;?>
               <?php endif;?>
  
               <?php if($level==='2'):?>
                   <?php echo '0';?>
               <?php endif;?>
                        
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki 
              <?php if($level==='1'):?>
                   <?php echo $jum_pesan_disabilitas;?>
               <?php endif;?>
  
               <?php if($level==='2'):?>
                   <?php echo '0';?>
               <?php endif;?>  

              laporan belum diproses</li>
              <li>
                
                <ul class="menu">
                    <?php if($level==='1'):?>
                        <?php 
                          $laporan=$this->db->query("SELECT tbl_laporan_disabilitas.*,DATE_FORMAT(created_at,'%d %M %Y') AS created_at FROM tbl_laporan_disabilitas WHERE status='1' ORDER BY id DESC LIMIT 5");
                          $laporan_jum=$laporan->num_rows();
                          
                          foreach ($laporan->result_array() as $lap) :
                          $id=$lap['id'];
                          $judul_laporan=$lap['nama_file'];
                          $tanggal_laporan=$lap['created_at'];
                          $isi_laporan=$lap['keterangan'];
                       ?>
                      
                      <?php if ($laporan_jum>0):?>
                        <li>
                          <a href="<?php echo base_url().'admin/laporan/notifadmin_disabilitas'?>">
                            <div class="pull-left">
                              <img src="<?php echo base_url('assets/images/').$foto?>" class="img-circle" alt="User Image">
                            </div>
                            <p>
                              <small><i class="fa fa-clock-o"></i> <?php echo $tanggal_laporan;?></small>
                            </p>
                            <h4>
                              <?php echo $judul_laporan;?>
                            </h4>
                            <p><?php echo $isi_laporan;?></p>
                          </a>
                        </li>
                      <?php endif;?>
                      <?php endforeach;?>
                    <?php endif;?>
       
                    <?php if($level==='2'):?>
                        
                      <h4 align="center">
                          <small><b>- LAPORAN DISABILITAS NIHIL -</b></small>
                        </h4>

                    <?php endif;?>
                  <!-- end notifikasi -->
                  
                </ul>
              </li>
              <?php if($level==='1'):?>
                <li class="footer"><a href="<?php echo base_url().'admin/laporan/notifadmin_disabilitas'?>">Lihat Semua Notifikasi Pesan</a></li>
               <?php endif;?>
              <?php if($level==='2'):?>
                <!-- <li class="footer"><a href="< ?php echo base_url().'admin/laporan/opd'?>">Lihat Semua Notifikasi Pesan</a></li> -->
                <li class="footer"><a href="#">Lihat Semua Notifikasi Pesan</a></li>
               <?php endif;?>
              
            </ul>
          </li>
          
          <?php
              $pengguna_id=$this->session->userdata('pengguna_id');
              $q=$this->db->query("SELECT * FROM tbl_admin WHERE pengguna_id='$pengguna_id'");
              $c=$q->row_array();
          ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().'assets/images/'.$c['pengguna_photo'];?>" class="user-image" alt="">
              <span class="hidden-xs"><?php echo $c['pengguna_nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'assets/images/'.$c['pengguna_photo'];?>" class="img-circle" alt="">

                <p>
                  <?php echo $c['pengguna_nama'];?>
                  <?php if($c['pengguna_level']=='1'):?>
                    <small>Administrator</small>
                  <?php else:?>
                    <small>Perangkat Daerah</small>
                  <?php endif;?>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url().'admin/administrator/logout'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>

    </nav>
  </header>