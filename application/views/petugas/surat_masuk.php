<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

  
  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">DAFTAR DATA</li>
        <li class="active">
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
        Surat Masuk
        <small>Aplikasi Pengarsipan Surat</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        
        <a href="#InputSuratMasuk" id="tab2" class="btn btn-info">
            <i class="fa fa-plus"></i> Input Data
        </a>
        <a href="#SuratMasuk" id="tab1" class="btn btn-info sr-only">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <button id="deleteList" class="btn btn-danger" disabled="disabled" onclick="deleteList()"><i class="fa fa-trash"></i> Hapus</button>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="SuratMasuk">
                    <div class="box box-primary" style="margin-top: 10px;">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="surat_masuk" class="display table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="check-all"></th>
                                            <th>No</th>
                                            <th>No. Surat</th>
                                            <th>Tgl Surat</th>
                                            <th>Perihal</th>
                                            <th>Jenis Surat</th>
                                            <th>Ditujukan</th>
                                            <th>Deskripsi</th>
                                            <th>Username</th>
                                            <th>Berkas</th>
                                            <th>Sifat</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th>No. Surat</th>
                                            <th>Tgl Surat</th>
                                            <th>Perihal</th>
                                            <th>Jenis Surat</th>
                                            <th>Ditujukan</th>
                                            <th>Deskripsi</th>
                                            <th>Username</th>
                                            <th>Berkas</th>
                                            <th>Sifat</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>    
                            </div>
                        </div>
                    </div>

                </div> 
                <div class="tab-pane fade" id="InputSuratMasuk">
                    <div class="box box-primary" style="margin-top: 10px;">
                        <div class="box-body" style="padding: 10px 20px;">
                            <form id="suratMasuk">
                                <input type="hidden" name="id_surat_masuk"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Surat</label>
                                            <input type="text" name="no_surat" class="form-control"/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Perihal</label>
                                            <input type="text" name="perihal" class="form-control"/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Tanggal Surat</label>
                                            <div class="input-group">
                                                <input type="text" name="tgl_surat" id="inputTglSurat" class="form-control"/>
                                                <div class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Surat</label>
                                            <select name="jenis_surat" class="form-control"> 
                                                <option value="" selected="selected">-- Jenis Surat --</option>
                                                <?php
                                                foreach ($jenis_surat as $list){
                                                    echo '<option value="'.$list->id_jenis_surat.'">'.$list->jenis_surat.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pengirim</label>
                                            <input type="text" name="pengirim" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Ditujukan</label>
                                            <input type="text" name="ditujukan" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Petugas</label>
                                            <input value="<?php echo $nama_lengkap ?>" class="form-control" disabled="disabled"/>
                                        </div>
                                        <div class="form-group">
                                            <label id="label-photo">Berkas</label>
                                            <div>
                                                <input name="berkas_surat" type="file">
                                                <span class="help-block"></span>
                                            </div>
                                        <div class="form-group">
                                            <label>Sifat Surat</label>
                                            <select name="sifat_surat" class="form-control">
                                                <option value="" selected="selected">-- Sifat Surat --</option>
                                                <option value="Rahasia">Rahasia</option>
                                                <option value="Penting">Penting</option>
                                                <option value="Segera">Segera</option>
                                                <option value="Biasa">Biasa</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Disposisi</label>
                                            <select name="status_disposisi" class="form-control">
                                                <option value="" selected="selected">-- Status Disposisi --</option>
                                                <option value="Sudah Disposisi">Sudah Disposisi</option>
                                                <option value="Belum Disposisi">Belum Disposisi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="box-footer text-right">
                            <button type="button" id="submitBtn" class="btn btn-primary btn-flat" onclick="save()">Simpan</button>
                            <button type="button" id="resetBtn" class="btn btn-danger btn-flat">Reset</button>
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
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/js/adminlte.min.js'); ?>"></script>

<script>
    
    var table;
    $(document).ready(function() {
        
        $('a#tab1').click(function(e){
            e.preventDefault();
            $(this).tab('show');
            $(this).addClass('sr-only');
        });
        
        $('a#tab2').click(function(e){
            e.preventDefault();
            save_method = 'add';
            $('#suratMasuk')[0].reset();
            $(this).tab('show');
            $('#deleteList').hide();
            $('a#tab1').removeClass('sr-only');
            
        });
 
        table = $('#surat_masuk').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('petugas/surat_masuk/select'); ?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [0], 
                "orderable": false, 
            },
            { 
                "targets": [1], 
                "orderable": false, 
            },
            { 
                "targets": [-1], 
                "orderable": false, 
            },
            ],
 
        });
    
    
        $("#check-all").click(function () {
            $(".data-check").prop('checked', $(this).prop('checked'));
            enableDeleteBtn();
        });
        
        $('#inputTglSurat').datepicker({
            autoclose : true,
            format: 'yyyy-mm-dd',
            todayHighlight: true
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
    
    
    
    function editSuratMasuk(id)
    {
        save_method = 'update';
        $('#suratMasuk')[0].reset();
        $('a#tab1').removeClass('sr-only');
        $('a#tab2').tab('show');
        $('a#tab1').removeClass('sr-only');
        $('#resetBtn').hide();

        $.ajax({
            url : "<?php echo site_url('petugas/surat_masuk/select_by_id/') ?>"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_surat_masuk"]').val(data.id_surat_masuk);
                $('[name="no_surat"]').val(data.no_surat);
                $('[name="tgl_surat"]').val(data.tgl_surat);
                $('[name="perihal"]').val(data.perihal);
                $('[name="jenis_surat"]').val(data.id_jenis_surat);
                $('[name="pengirim"]').val(data.pengirim);
                $('[name="ditujukan"]').val(data.ditujukan);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="file"]').val(data.file);
                $('[name="sifat_surat"]').val(data.sifat_surat);
                $('[name="status_disposisi"]').val(data.status_disposisi);
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error getting data from ajax');
            }
        });
    }
    
    function showModal(id)
    {
        $('#disposisiSuratMasuk')[0].reset();
        $('#modal1').modal('show');

        $.ajax({
            url : "<?php echo site_url('admin/disposisi_surat_masuk/') ?>"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="idSurat1"]').val(id);
                $('#noSurat').text(data.no_surat);
                $('#tglSurat1').text(data.tgl_surat);
                $('#tglDisposisi').text('<?php echo mdate('%Y-%m-%d', time()); ?>');
                $('#dari').text(data.pengirim);
                $('#kepada1').text(data.ditujukan);
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error getting data from ajax');
            }
        });
    }
    
    function save()
    {
        
        var url;
        
        if(save_method == 'add') {
            url = "<?php echo site_url('petugas/surat_masuk/create') ?>";
        } else {
            url = "<?php echo site_url('petugas/surat_masuk/update') ?>";
        }

        var formData = new FormData($('#suratMasuk')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status)
                {
                    $('#suratMasuk')[0].reset();
                    table.ajax.reload(null,false);
                    $('a#tab1').tab('show');
                    $('.content-header').append('<div style="margin: 15px 0 0 0;" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data telah disimpan.</div>');
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                 alert('Input Data gagal!');

            }
        });
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
                    url: "<?php echo site_url('petugas/surat_masuk/delete') ?>",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status)
                        {
                            $('#deleteList').prop('disabled', true);
                            table.ajax.reload(null,false);
                        }
                        else
                        {
                            alert('Failed.');
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            }
        }
        else
        {
            alert('no data selected');
        }
    }
    
    function showModal(id)
    {
        $('#disposisiSuratMasuk')[0].reset();
        $('#modal1').modal('show');

        $.ajax({
            url : "<?php echo site_url('petugas/surat_masuk/disposisi_surat_masuk/') ?>"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                
                $('[name="idSurat1"]').val(id);
                $('#noSurat').text(data.no_surat);
                $('#tglSurat1').text(data.tgl_surat);
                $('#tglDisposisi').text('<?php echo mdate('%Y-%m-%d', time()); ?>');
                $('#dari').text(data.pengirim);
                $('#kepada1').text(data.ditujukan);
                
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error getting data from ajax');
            }
        });
    }
</script>

        <div class="modal fade in" id="modal1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Buat Disposisi Surat Masuk</h4>
              </div>
                <form id="disposisiSuratMasuk" target="_blank" action="<?php echo site_url('petugas/surat_masuk/buat_disposisi'); ?>" method="POST">
              <div class="modal-body">
                  
                      <input type="hidden" name="idSurat1"/>
                      <div class="row">
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>No. Surat</label>
                                  <p id="noSurat"></p>
                              </div>
                              <div class="form-group">
                                  <label>Tanggal Surat</label>
                                  <p id="tglSurat1"></p>
                              </div>
                              <div class="form-group">
                                  <label>Tanggal Disposisi</label>
                                  <p id="tglDisposisi"></p>
                              </div>
                              <div class="form-group">
                                  <label>Dari</label>
                                  <p id="dari"></p>
                              </div>
                          </div>
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Kepada</label>
                                  <p id="kepada1"></p>
                              </div>
                              <div class="form-group">
                                  <label>Keterangan</label>
                                  <textarea name="ketDisposisi" class="form-control"></textarea>
                              </div>
                          </div>
                          
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" id="printBtn" class="btn btn-primary btn-flat" onclick="location.reload()">Ya</button>
                <button type="button" class="btn btn-primary btn-danger btn-flat" data-dismiss="modal">Tidak</button>
              </div>
        </form>
            </div>
          </div>
          
        </div>

</body>
</html>

