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
        
        <li class="active">
          <a href="<?php echo site_url('petugas/petugastu'); ?>">
              <i class="fa fa-users"></i>
              <span>Petugas TU</span>
          </a>
        </li>
        
        
        <li class="header">LAPORAN DATA</li>
        <li>
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
        Data Petugas
        <small>Aplikasi Pengarsipan Surat</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="data_petugas" class="table table-hover" width="100%">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>JK</th>
                                        <th>Tanggal Lahir</th>
                                        <th>alamat</th>
                                        <th>email</th>
                                        <th>telp</th>

                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>

                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>JK</th>
                                        <th>Tanggal Lahir</th>
                                        <th>alamat</th>
                                        <th>email</th>
                                        <th>telp</th>

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
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/js/adminlte.min.js'); ?>"></script>

<script>
    var save_method;
    var table;
    $(document).ready(function() {
        
        table = $('#data_petugas').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('petugas/petugastu/select'); ?>",
                "type": "POST"
            },
 
             "columnDefs": [
            { 
                "targets": [0], 
                "orderable": false, 
            }
            ]
        });
 
    });
    
</script>


</body>
</html>

