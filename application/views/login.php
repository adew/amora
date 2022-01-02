<?php
defined('BASEPATH') or exit('No direct script access allowed');
echo doctype('html5') . '<html><head>';
echo '<meta charset="utf-8">';
echo meta('viewport', 'width=device-width, initial-scale=1');
echo '<title>' . $title . '</title>';
echo link_tag('assets/bootstrap/css/bootstrap.min.css');
echo link_tag('assets/font-awesome/css/font-awesome.min.css');
echo link_tag('assets/iCheck/square/blue.css');

?>
<link rel="shortcut icon" href=<?= base_url('favicon.ico') ?> type="image/x-icon">
<style>
  html {
    position: relative;
    min-height: 100%;
  }

  body {
    margin-bottom: 60px;
    /* padding-top: 40px; */
    padding-bottom: 40px;
    background-color: #eee;
  }

  .text-red {
    color: #007bff;
  }

  .btn {
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }

  .btn-primary {
    background: #007bff;
    border-color: #007bff;
  }

  .btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
  }

  #login-box {
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
  }

  #login-box-logo {
    margin: 0 0 15px 0;
  }

  .form-signin .form-signin-heading,
  .form-signin .checkbox {
    margin-bottom: 10px;
  }

  .form-signin .checkbox {
    font-weight: 400;
  }

  .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
  }

  .form-signin .form-control:focus {
    z-index: 2;
  }

  .form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .form-signin div.checkbox label {
    padding-left: 0;
    margin-bottom: 10px;
  }

  .form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    -webkit-box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
    box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
  }

  footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    line-height: 60px;
  }

  .text-red {
    color: #dd4b39;
  }

  .bg-red {
    color: #fff;
    background-color: #dd4b39;
    /* height: 50px; */
  }
</style>

</head>

<body>
  <div class="row bg-red">
    <div class="col-md-12 text-center text-white">
      <h2 id="header-text"><b>APLIKASI PENGARSIPAN DAN MONITORING KEPANITERAAN</b></h2>
      <h2 style="font-family: 'Courier New', Courier, monospace;"><b>PENGADILAN MILITER III-18 AMBON </b></h2>

    </div>
  </div>
  <div class="container">
    <div id="login-box">
      <div class="text-center">
        <!-- C:\xampp\htdocs\amora\assets\adminlte\img -->
        <img src="<?= base_url('assets\adminlte\img\logo.png') ?>" class="logo" style="width: 200px; height: 200px;">
        <!-- <h2 class="form-signin-heading"><b><span class="text-red">AMORA</span></b></h2>
        <h1 id="login-box-logo" class="text-red">
        </h1> -->
        <div id="infoMsg" class="text-danger"><?php echo $message ?></div>
      </div>

      <?php echo form_open('auth/login', array('class' => 'form-signin')) ?>


      <?php echo form_input($username); ?>
      <br>
      <?php echo form_password($password); ?>
      <div class="checkbox">
        <label>
          <?php echo form_checkbox('remember', 'FALSE', true); ?>&nbsp;&nbsp;<?php echo lang('login_remember_label') ?>
        </label>
      </div>
      <?php echo form_submit('submit', 'Masuk', array('class' => 'btn btn-danger btn-lg btn-block')); ?>
      <?php echo form_close(); ?>
    </div>
  </div>

  <footer class="text-center">
    <div class="container">
      <span class="text-muted">
        Copyright &copy; 2021 | Developed By <a href="https://www.instagram.com/adew77_/" target="_blank"><b>Ade Widianto</b></a>

      </span>
    </div>
  </footer>

  <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>

  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

  <script src="<?php echo base_url('assets/iCheck/icheck.min.js'); ?>"></script>
  <script>
    $(function() {

      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        increaseArea: '20%'
      });

    });
  </script>
</body>

</html>