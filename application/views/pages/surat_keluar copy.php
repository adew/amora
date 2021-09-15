<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Surat Keluar
            <!-- <small>Aplikasi Pengarsipan Surat</small> -->
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
        <button id="deleteList" disabled="disabled" class="btn btn-danger" onclick="deleteList()"><i class="fa fa-trash"></i> Hapus</button>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="SuratMasuk">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="surat_keluar" class="display table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>No</th>
                                        <th>No. Surat</th>
                                        <th>Tgl Surat</th>
                                        <th>Perihal</th>
                                        <th>Pengirim</th>
                                        <th>Kepada</th>
                                        <th>Jenis Surat</th>
                                        <!-- <th>Sifat Surat</th> -->
                                        <th>Keterangan</th>
                                        <th>Petugas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="InputSuratMasuk">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body" style="padding: 10px 20px;">
                        <form id="suratKeluar">
                            <input type="hidden" name="id_surat_keluar" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No. Surat</label>
                                        <input type="text" name="no_surat" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Perihal</label>
                                        <input type="text" name="perihal" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Surat</label>
                                        <div class="input-group">
                                            <input type="text" name="tgl_surat" id="inputTglSurat" class="form-control" />
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Pengirim</label>
                                        <input type="text" name="pengirim" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Kepada</label>
                                        <input type="text" name="ditujukan" class="form-control" />
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Surat</label>
                                        <select name="jenis_surat" class="form-control">
                                            <option value="" selected="selected">-- Jenis Surat --</option>
                                            <?php
                                            foreach ($jenis_surat as $list) {
                                                echo '<option value="' . $list->id_jenis_surat . '">' . $list->jenis_surat . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Petugas</label>
                                        <input value="<?php echo $nama_lengkap ?>" class="form-control" disabled="disabled" />
                                    </div>

                                    <!-- <div class="form-group">
                                        <label>Sifat Surat</label>
                                        <select name="sifat_surat" class="form-control">
                                            <option value="" selected="selected">-- Sifat Surat --</option>
                                            <option value="Rahasia">Rahasia</option>
                                            <option value="Penting">Penting</option>
                                            <option value="Segera">Segera</option>
                                            <option value="Biasa">Biasa</option>

                                        </select>
                                    </div> -->
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

        $('a#tab1').click(function(e) {
            e.preventDefault();
            $('#deleteList').show();
            $(this).tab('show');
            $(this).addClass('sr-only');
        });

        $('a#tab2').click(function(e) {
            e.preventDefault();
            save_method = 'add';
            $(this).tab('show');
            $('#deleteList').hide();
            $('a#tab1').removeClass('sr-only');
        });

        table = $('#surat_keluar').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Admin/get_surat_keluar'); ?>",
                "type": "POST"
            },


            "columnDefs": [{
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


        $("#check-all").click(function() {
            $(".data-check").prop('checked', $(this).prop('checked'));
            enableDeleteBtn();
        });

        $('#inputTglSurat').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true
        });


    });

    function enableDeleteBtn() {
        var total = 0;

        $('.data-check').each(function() {
            total += $(this).prop('checked');
        });

        if (total > 0)
            $('#deleteList').prop('disabled', false);
        else
            $('#deleteList').prop('disabled', true);
    }



    function editSuratKeluar(id) {
        save_method = 'update';
        $('#suratKeluar')[0].reset();
        $('a#tab2').tab('show');

        $.ajax({
            url: "<?php echo site_url('admin/edit_surat_keluar/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('a#tab1').removeClass('sr-only');
                $('#deleteList').hide();
                $('[name="id_surat_keluar"]').val(data.id_surat_keluar);
                $('[name="no_surat"]').val(data.no_surat);
                $('[name="tgl_surat"]').val(data.tgl_surat);
                $('[name="perihal"]').val(data.perihal);
                $('[name="jenis_surat"]').val(data.id_jenis_surat);
                $('[name="pengirim"]').val(data.pengirim);
                $('[name="ditujukan"]').val(data.kepada);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="petugas"]').val(data.id_petugas);
                $('[name="sifat_surat"]').val(data.sifat_surat);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data from ajax');
            }
        });
    }

    function save() {

        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('admin/input_surat_keluar') ?>";
        } else {
            url = "<?php echo site_url('admin/update_surat_keluar') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#suratKeluar').serialize(),
            dataType: "JSON",
            success: function(data) {
                $('#suratKeluar')[0].reset();
                $('a#tab1').addClass('sr-only');
                table.ajax.reload(null, false);
                $('a#tab1').tab('show');
                $('.content-header').append('<div style="margin: 15px 0 0 0;" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data telah disimpan.</div>');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Input Data gagal!');

            }
        });
    }

    function deleteList() {
        var list_id = [];
        $(".data-check:checked").each(function() {
            list_id.push(this.value);
        });
        if (list_id.length > 0) {
            if (confirm('Hapus ' + list_id.length + ' data?')) {
                $.ajax({
                    type: "POST",
                    data: {
                        id: list_id
                    },
                    url: "<?php echo site_url('admin/hapus_surat_keluar') ?>",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            $('#deleteList').attr('disabled', true);
                            table.ajax.reload(null, false);
                        } else {
                            alert('Failed.');
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        } else {
            alert('no data selected');
        }
    }
</script>

</body>

</html>