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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/iCheck/square/blue.css' ?>">

</head>
<!-- <body class="hold-transition login-page"> -->

<body class="hold-transition login-page" style="background-image: url(<?php echo base_url() . 'theme/images/imageslapor.jpg' ?>);">
  <div class="login-box">
    <div>
      <p><?php echo $this->session->flashdata('msg'); ?></p>
      <p><?php echo $this->session->flashdata('message'); ?></p>
    </div>
    <!-- /.login-logo -->
    <?= $script_captcha; ?>
    <div class="login-box-body">
      <p class="login-box-msg">
        <center><img src="<?php echo base_url() . 'theme/images/mylogo.png' ?>" style="width:300px; height: 200px;"></center>
      </p>
      <hr />

      <form action="<?php echo base_url() . 'admin/administrator/auth' ?>" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12" align="center">
            <?= $captcha; ?>
          </div>
        </div>
        <!-- /.col -->
        <div class="row">
          <center>
            <div class="col-xs-12" style="margin-top:13px;">
              <button type="submit" class="btn btn-primary btn-block btn-circle">Login</button>
            </div>
          </center>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->
      <hr />
      <p>
        <center>Lapor Bupati</center>
      </p>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() . 'assets/plugins/iCheck/icheck.min.js' ?>"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>