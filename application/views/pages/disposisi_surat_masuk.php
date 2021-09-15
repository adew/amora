<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

  
  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <li>
            <a href="<?php echo site_url('admin'); ?>">
              <i class="fa fa-home"></i>
              <span>Dashboard</span>
          </a>
        </li>
        <li class="header">DAFTAR DATA</li>
        <li>
            <a href="<?php echo site_url('admin/page/surat_masuk'); ?>">
              <i class="fa fa-inbox"></i>
              <span>Surat Masuk</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('admin/page/surat_keluar'); ?>">
              <i class="fa fa-mail-forward"></i>
              <span>Surat Keluar</span>
          </a>
        </li>
        
        <li class="active">
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
        </li>
        
        <li>
          <a href="<?php echo site_url('admin/page/data_petugas'); ?>">
              <i class="fa fa-users"></i>
              <span>Petugas TU</span>
          </a>
        </li>
        
        
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
        </li>
        
      </ul>
      
    </section>
    
  </aside>


  <div class="content-wrapper">
    <section class="content-header">
        <h1>
        Disposisi Surat Masuk
         <small>Aplikasi Pengarsipan Surat</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <a href="<?php echo site_url('admin/page/surat_masuk') ?>" class="btn btn-primary">
            <i class="fa fa-file"></i> Buat Disposisi
        </a>
        <button id="deleteList" class="btn btn-danger" onclick="deleteList()" disabled><i class="fa fa-trash"></i> Hapus</button>
        <div class="box box-primary" style="margin-top: 10px;">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" id="disposisi">
                       <thead>
                           <tr>
                               <th><input type="checkbox" id="check-all"></th>
                               <th>No. Surat</th>
                               <th>Tanggal Surat</th>
                               <th>Tanggal Disposisi</th>
                               <th>Dari</th>
                               <th>Kepada</th>
                               <th>Keterangan</th>
                               <th>Petugas</th>
                               <th>Waktu</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>

                       </tbody>
                       <tfoot>
                           <tr>
                               <th></th>
                               <th>No. Surat</th>
                               <th>Tanggal Surat</th>
                               <th>Tanggal Disposisi</th>
                               <th>Dari</th>
                               <th>Kepada</th>
                               <th>Keterangan</th>
                               <th>Petugas</th>
                               <th>Waktu</th>
                               <th>Action</th>
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
<script src="<?php echo base_url('assets/adminlte/js/adminlte.min.js'); ?>"></script>

<script>
    var save_method;
    var table;
    
    
    $(document).ready(function() {
 
        table = $('#disposisi').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/get_disposisi'); ?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [0], 
                "orderable": false, 
            },
            { 
                "targets": [-1], 
                "orderable": false, 
            }
            ],
 
        });
    
        $("#check-all").click(function () {
            $(".data-check").prop('checked', $(this).prop('checked'));
            enableDeleteBtn();
        });
 
    });
    
    function enableDeleteBtn()
    {
      var total = 0;

      $('.data-check').each(function()
      {
         total+= $(this).prop('checked');
      });

      if (total > 0)
          $('#deleteList').prop('disabled', false);
      else
          $('#deleteList').prop('disabled', true);
    }
    
    function deleteList()
    {
        var list_id = [];
        $(".data-check:checked").each(function() {
                list_id.push(this.value);
        });
        if(list_id.length > 0)
        {
            if(confirm('Hapus '+list_id.length+' data?'))
            {
                $.ajax({
                    type: "POST",
                    data: {id:list_id},
                    url: "<?php echo site_url('admin/hapus_disposisi') ?>",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status)
                        {
                            table.ajax.reload(null,false);
                            $('#deleteList').prop('disabled', true);
                        }
                        else
                        {
                            alert('Gagal.');
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Terjadi kesalahan saat melakukan hapus data');
                    }
                });
            }
        }
        else
        {
            alert('tidak ada data yang terpilih');
        }
    }
</script>


</body>
</html>

