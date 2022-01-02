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
        <a data-toggle="collapse" id="buttonLaporan" class="btn btn-success" href="#collapseOne" style="color: white;">
            <i class="fa fa-file-pdf-o"></i> Buat Laporan
        </a>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="SuratMasuk">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body">

                        <div id="collapseOne" class="collapse">
                            <div class="panel">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('bulan_ini')">Bulan ini</button>
                                    <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('minggu_ini')">Minggu ini</button>
                                    <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('hari_ini')">Hari ini</button>
                                    <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('bulan_kemarin')">Bulan Kemarin</button>
                                    <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('kemarin')">Kemarin</button>
                                </div>

                                <hr>
                                <p>Berdasarkan rentang tanggal</p>
                                <form class="form-inline" action="<?php echo site_url('laporan/print_pdf/2') ?>" target="_blank" method="get">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="start" class="form-control" required="required" placeholder="yyyy-mm-dd" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="end" class="form-control" required="required" placeholder="yyyy-mm-dd" />
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="" value="Submit" class="btn btn-success" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="surat_keluar" class="display table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>No</th>
                                        <th>No. Surat</th>
                                        <th>Tgl Surat</th>
                                        <th>Perihal</th>
                                        <th>Tujuan Surat</th>
                                        <!-- <th>Jenis Surat</th> -->
                                        <!-- <th>Sifat Surat</th> -->
                                        <th>Tgl Pengiriman</th>
                                        <th>Keterangan</th>
                                        <th>Berkas</th>
                                        <!-- <th>Petugas</th> -->
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
                                        <label>Tanggal Surat</label>
                                        <div class="input-group">
                                            <input type="text" name="tgl_surat" id="inputTglSurat" class="form-control" />
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tujuan Surat</label>
                                        <input type="text" name="ditujukan" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Perihal</label>
                                        <input type="text" name="perihal" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Pengiriman</label>
                                        <div class="input-group">
                                            <input type="text" name="tgl_pengiriman" id="inputTglPengiriman" class="form-control" />
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Pengirim</label>
                                        <input type="text" name="pengirim" class="form-control" />
                                    </div> -->

                                </div>

                                <div class="col-md-6">
                                    <input type="hidden" name="jenis_surat" value="1" />
                                    <!-- <div class="form-group">
                                        <label>Jenis Surat</label>
                                        <select name="jenis_surat" class="form-control">
                                            <option value="" selected="selected">-- Jenis Surat --</option>
                                            <?php
                                            foreach ($jenis_surat as $list) {
                                                echo '<option value="' . $list->id_jenis_surat . '">' . $list->jenis_surat . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Petugas</label>
                                        <input value="<?php echo $nama_lengkap ?>" class="form-control" disabled="disabled" />
                                    </div> -->
                                    <div class="form-group">
                                        <label id="label-photo">Berkas</label>
                                        <div>
                                            <input name="berkas_surat" type="file">
                                            <span class="help-block"></span>
                                        </div>
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


<!-- <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/js/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<!-- <script src="<?php echo base_url('assets/adminlte/js/adminlte.min.js'); ?>"></script> -->

<script>
    var table;
    $(document).ready(function() {

        $('a#tab1').click(function(e) {
            e.preventDefault();
            $('#deleteList').show();
            $('#buttonLaporan').show();
            $(this).tab('show');
            $(this).addClass('sr-only');
        });

        $('a#tab2').click(function(e) {
            e.preventDefault();
            save_method = 'add';
            $(this).tab('show');
            $('#deleteList').hide();
            $('#buttonLaporan').hide();
            $('a#tab1').removeClass('sr-only');
        });

        $('#resetBtn').click(function(e) {
            e.preventDefault();
            $('#suratKeluar')[0].reset();
        });

        table = $('#surat_keluar').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('admin/get_surat_keluar'); ?>",
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
            todayHighlight: true,
            orientation: "bottom"
        });
        $('#inputTglPengiriman').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true
        });

        $('[name="start"], [name="end"] ').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "bottom"
        });

    });

    function laporanSuratKeluar(waktu) {
        var start, end;
        switch (waktu) {
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
        var formData = new FormData($('#suratKeluar')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                $('#suratKeluar')[0].reset();
                // $('a#tab1').addClass('sr-only');
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