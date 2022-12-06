<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrasi User</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.3/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.3/');?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.3/');?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.3/');?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.3/');?>plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="../../index2.html"><b>Pendaftaran User</b></a>
      </div>
      <div class="register-box-body">
        <p class="login-box-msg">Pendaftaran User Baru</p>
        <?php
        if(validation_errors()){
        ?>
        <div class="alert alert-info text-center">
          <?php echo validation_errors(); ?>
        </div>
        <?php
        }
        if($this->session->flashdata('message')){
        ?>
        <div class="alert alert-info text-center">
          <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        }
        ?>
        <form method="POST" action="<?php echo base_url().'registrasi/register'; ?>">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Nama" >
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="hp" name="hp" value="<?php echo set_value('hp'); ?>" placeholder="Nomor HP ">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo set_value('alamat'); ?>" placeholder="alamat rumah Rt Rw Kelurahan ">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>" placeholder="Ulangi password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.3/');?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.3/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.3/');?>plugins/iCheck/icheck.min.js"></script>
    <script>
    $(function () {
    $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%'
    });
    });
    </script>
  </body>
</html>