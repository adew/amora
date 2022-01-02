<?php
defined('BASEPATH') or exit('No direct script access allowed');
echo doctype('html5') . '<html><head>';
echo '<meta charset="utf-8"/>';
echo meta('vewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no');
echo '<title>' . $title . '</title>';
echo link_tag('assets/bootstrap/css/bootstrap.min.css');
echo link_tag('assets/iCheck/all.css');
echo link_tag('assets/font-awesome/css/font-awesome.min.css');
echo link_tag('assets/Ionicons/css/ionicons.min.css');
echo link_tag('assets/datatables/css/dataTables.bootstrap.min.css');
echo link_tag('assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
echo link_tag('assets/adminlte/css/AdminLTE.min.css');
echo link_tag('assets/adminlte/css/skins/skin-green-light.min.css');
echo link_tag('assets/adminlte/css/skins/_all-skins.min.css');

?>
<link rel="shortcut icon" href=<?= base_url('favicon.ico') ?> type="image/x-icon">
<script src="<?= base_url() ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/adminlte/js/adminlte.min.js" type="text/javascript"></script>

</head>
<!-- <body class="hold-transition skin-blue-light sidebar-collapse sidebar-mini"> -->

<body class="hold-transition skin-red-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="<?php echo site_url('admin') ?>" class="logo">
        <span>
          <img src="<?= base_url('assets\adminlte\img\logo.png') ?>" class="logo" style="width: 75px; height: 50px;"><b>AMORA</b>
        </span>
        <!-- <span class="logo-lg"><b>AMORA</b></span> -->
      </a>

      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?php echo $nama_lengkap; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="<?php echo base_url('auth/logout') ?>">
                    <i class="fa fa-sign-out"></i>Keluar
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </div>
      </nav>
    </header>