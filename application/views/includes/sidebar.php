<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<aside class="main-sidebar">

  <section class="sidebar">

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU UTAMA</li>
      <li class="active">
        <a href="<?php echo site_url('admin'); ?>">
          <i class="fa fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="header">SURAT</li>
      <li>
        <a href="<?php echo site_url('admin/page/surat_masuk'); ?>">
          <i class="fa fa-envelope"></i>
          <span>Surat Masuk</span>
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('admin/page/surat_keluar'); ?>">
          <i class="fa fa-mail-forward"></i>
          <span>Surat Keluar</span>
        </a>
      </li>
      <li class="header">PERKARA</li>
      <li>
        <a href="<?php echo site_url('admin/page/konsep_putusan'); ?>">
          <i class="fa fa-copy"></i>
          <span>Konsep Putusan</span>
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('admin/page/data_nominatif'); ?>">
          <i class="fa fa-copy"></i>
          <span>Data Nominatif</span>
        </a>
      </li>

      <!--<li>
        <a href="<?php echo site_url('admin/page/disposisi_surat_masuk'); ?>">
          <i class="fa fa-file"></i>
          <span>Disposisi Surat Masuk</span>
        </a>
      </li>

      <li>
        <a href="<?php echo site_url('admin/page/form_jenis_surat'); ?>">
          <i class="fa fa-tag"></i>
          <span>Jenis Surat</span>
        </a>
      </li>-->

      <li>
        <a href="<?php echo site_url('admin/page/data_petugas'); ?>">
          <i class="fa fa-user"></i>
          <span>Petugas</span>
        </a>
      </li>

      <!--
      <li class="header">LAPORAN DATA</li>
      <li>
        <a href="<?php echo site_url('laporan/view/surat_masuk'); ?>">
          <i class="fa fa-print"></i>
          <span>Surat Masuk</span>
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('laporan/view/surat_keluar'); ?>">
          <i class="fa fa-print"></i>
          <span>Surat Keluar</span>
        </a>
      </li>
  
      <li>
        <a href="<?php echo site_url('laporan/view/disposisi_surat_masuk'); ?>">
          <i class="fa fa-print"></i>
          <span>Disposisi Surat Masuk</span>
        </a>
      </li>
      <li class="header">PENGATURAN</li>
      <li>
        <a href="<?php echo site_url('admin/db_backup'); ?>">
          <i class="fa fa-database"></i>
          <span>Database Backup</span>
        </a>
      </li> -->

    </ul>

  </section>

</aside>