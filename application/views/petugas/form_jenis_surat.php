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
        
        <li  class="active">
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
        Form Jenis Surat
        <small>Aplikasi Pengarsipan Surat</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body">
                        <form id="JenisSurat">
                            <div class="form-group">
                                <label style="font-weight: normal;">ID</label>
                                <?php echo form_input($id_jenis_surat)?>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: normal;">Jenis Surat</label>
                                <?php echo form_input($jenis_surat)?>
                            </div>
                        </form>
                        <?php echo form_button('ajaxSaveBtn', 'Input Data', 'class="btn btn-primary btn-flat btn-block" onclick="save()"')?>
                        <div class="col-md-6" style="margin-top: 10px; padding: 0 5px 0 0;">
                            <?php echo form_button('ResetBtn', 'Reset', ' class="btn btn-default btn-flat btn-block" onclick="resetBtn2()"')?>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px; padding: 0 0 0 5px;">
                            <?php echo form_button('ajaxDelBtn', 'Hapus Data', 'id="deleteList" class="btn btn-danger btn-flat btn-block" disabled="disabled" onclick="hapusData()"')?>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="jenis_surat" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>No. </th>
                                        <th>ID Jenis Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Action</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>No.</th>
                                        <th>ID Jenis Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>    
                        </div>

                    </div>
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
 
        table = $('#jenis_surat').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('petugas/jenis_surat/select'); ?>",
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
    function editJenisSurat(id)
    {
        save_method = 'update';
        $('#JenisSurat')[0].reset();

        $.ajax({
            url : "<?php echo site_url('petugas/jenis_surat/select_by_id/') ?>"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="ajaxSaveBtn"]').text('Update Data');
                $('[name="input1"]').val(data.id_jenis_surat);
                $('[name="input2"]').val(data.jenis_surat);


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error getting data from ajax');
            }
        });
    }

    
    function save()
    {
        $('#JenisSurat').prepend('<p></p>');
        var url;
        
        if(save_method == 'update') {
            url = "<?php echo site_url('admin/update_jenis_surat') ?>";
        } else {
            url = "<?php echo site_url('admin/input_jenis_surat') ?>";
        }

        $.ajax({
            url : url,
            type: "POST",
            data: $('#JenisSurat').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $('#JenisSurat')[0].reset();
                table.ajax.reload(null,false);
                $('#JenisSurat').prepend('<p class="text-success"></p>');
                $('#JenisSurat').prepend('<p class="text-success">Input data berhasil!</p>');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                 $('#JenisSurat').prepend('<p class="text-danger">Input data gagal!</p>');

            }
        });
    }
    

    
    function hapusData()
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
                    url: "<?php echo site_url('admin/hapus_jenis_surat') ?>",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status)
                        {
                            table.ajax.reload(null,false);
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
    
    function resetBtn2()
    {
        location.reload();
    }
</script>

</body>
</html>

