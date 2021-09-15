<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

  
  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">DAFTAR DATA</li>
        <li>
            <a href="<?php echo site_url('petugas/surat_masuk'); ?>">
              <i class="fa fa-inbox"></i>
              <span>Surat Masuk</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('petugas/surat_keluar'); ?>">
              <i class="fa fa-mail-forward"></i>
              <span>Surat Keluar</span>
          </a>
        </li>
        
        <li>
          <a href="<?php echo site_url('petugas/disposisi_surat_masuk'); ?>">
              <i class="fa fa-file"></i>
              <span>Disposisi Surat Masuk</span>
          </a>
        </li>
        
        <li>
            <a href="<?php echo site_url('petugas/jenis_surat'); ?>">
              <i class="fa fa-tag"></i>
              <span>Jenis Surat</span>
          </a>
        </li>
        
        <li>
          <a href="<?php echo site_url('petugas/petugastu'); ?>">
              <i class="fa fa-users"></i>
              <span>Petugas TU</span>
          </a>
        </li>
        
        
        <li class="header">LAPORAN DATA</li>
        <li class="active">
          <a href="<?php echo site_url('petugas/surat_masuk/laporan'); ?>">
              <i class="fa fa-print"></i>
              <span>Surat Masuk</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('petugas/surat_keluar/laporan'); ?>">
              <i class="fa fa-print"></i>
              <span>Surat Keluar</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('petugas/disposisi_surat_masuk/laporan'); ?>">
              <i class="fa fa-print"></i>
              <span>Disposisi Surat Masuk</span>
          </a>
        </li>
        
      </ul>
      
    </section>
    
  </aside>


  <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Laporan Surat Masuk
        <small>Aplikasi Pengarsipan Surat</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-primary" style="display: inline-block;">
            <div class="box-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseOne">
                                    Buat Laporan
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse">
                            <div class="panel-body">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default" onclick="laporan1('bulan_ini')">Bulan ini</button>
                                    <button type="button" class="btn btn-default" onclick="laporan1('minggu_ini')">Minggu ini</button>
                                    <button type="button" class="btn btn-default" onclick="laporan1('hari_ini')">Hari ini</button>
                                    <button type="button" class="btn btn-default" onclick="laporan1('bulan_kemarin')">Bulan Kemarin</button>
                                    <button type="button" class="btn btn-default" onclick="laporan1('kemarin')">Kemarin</button>
                                </div>

                                <hr>
                                <form class="form-inline" action="<?php echo site_url('laporan/print_pdf/1') ?>" target="_blank" method="get">
                                    <p>Berdasarkan status disposisi</p>
                                    <select name="status_disposisi" class="form-control">
                                        <option value="3" selected="selected">Semua</option>
                                        <option value="1">Sudah Disposisi</option>
                                        <option value="2">Belum Disposisi</option>
                                    </select><p></p>
                                    <p>Berdasarkan rentang tanggal surat</p>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="start" class="form-control" required="required" placeholder="yyyy-mm-dd"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="end" class="form-control" required="required" placeholder="yyyy-mm-dd"/>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="" value="Submit" class="btn btn-success"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                
                
                <div class="table-responsive">
                    <table id="laporanSuratMasuk" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Perihal</th>
                                <th>Jenis Surat</th>
                                <th>Kepada</th>
                                <th>Deskripsi</th>
                                <th>Username</th>
                                <th>Berkas</th>
                                <th>Sifat</th>
                                <th>Status Disposisi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Perihal</th>
                                <th>Jenis Surat</th>
                                <th>Kepada</th>
                                <th>Deskripsi</th>
                                <th>Username</th>
                                <th>Berkas</th>
                                <th>Sifat</th>
                                <th>Status Disposisi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
            </div>
        </div>
        
    </section>
    
  </div>

</div>


<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets//js/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/js/adminlte.min.js'); ?>"></script>
<script>
    
    var table;
    $(document).ready(function() {

        table = $('#laporanSuratMasuk').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('petugas/surat_masuk/tabel_surat_masuk'); ?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [0], 
                "orderable": false, 
            }
            ]
 
        });
        
    $('[name="start"], [name="end"] ').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "bottom"
    });

    });
    
    function laporan1(waktu)
    {
        var start, end;
        switch(waktu)
        {
            case 'bulan_ini':
                start = moment().startOf('month');
                end = moment().endOf('month');
                $('[name="start"]').val(start.format('YYYY-MM-DD'));
                $('[name="end"]').val(end.format('YYYY-MM-DD'));
                break;
            case 'minggu_ini':
                start = moment().subtract(6, 'days');
                end = moment();
                $('[name="start"]').val(start.format('YYYY-MM-DD'));
                $('[name="end"]').val(end.format('YYYY-MM-DD'));
                break;
            case 'hari_ini':
                start = moment();
                end = moment();
                $('[name="start"]').val(start.format('YYYY-MM-DD'));
                $('[name="end"]').val(end.format('YYYY-MM-DD'));
                break;
            case 'bulan_kemarin':
                start = moment().subtract(1, 'month').startOf('month');
                end = moment().subtract(1, 'month').endOf('month');
                $('[name="start"]').val(start.format('YYYY-MM-DD'));
                $('[name="end"]').val(end.format('YYYY-MM-DD'));
                break;
            case 'kemarin':
                start = moment().subtract(1, 'days');
                end = moment().subtract(1, 'days');
                $('[name="start"]').val(start.format('YYYY-MM-DD'));
                $('[name="end"]').val(end.format('YYYY-MM-DD'));
                break;
        }
    }
</script>


</body>
</html>

