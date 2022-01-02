<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Nominatif
            <!-- <small>Aplikasi Pengarsipan Surat</small> -->
        </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">

        <a href="#InputDataNominatif" id="tab2" class="btn btn-info">
            <i class="fa fa-plus"></i> Input Data
        </a>
        <a href="#SuratMasuk" id="tab1" class="btn btn-info sr-only">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <button id="deleteList" disabled="disabled" class="btn btn-danger" onclick="deleteList()"><i class="fa fa-trash"></i> Hapus</button>
        <!-- <a data-toggle="collapse" class="btn btn-success" href="#collapseOne" style="color: white;">
            <i class="fa fa-file-pdf-o"></i> Buat Laporan
        </a> -->
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
                            <table id="data_nominatif" class="display table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Jenis</th>
                                        <th>Pelaku</th>
                                        <th>Jumlah Perkara Masuk</th>
                                        <th>Jumlah Perkara Putus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="InputDataNominatif">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body" style="padding: 10px 20px;">
                        <form id="dataNominatif">
                            <input type="hidden" name="id_data_nominatif" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <input type="text" name="tahun" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select name="bulan" class="form-control">
                                            <option value="" selected="selected">-- Pilih Bulan --</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select name="jenis" class="form-control">
                                            <option value="" selected="selected">-- Pilih Jenis --</option>
                                            <option value="kejahatan">Kejahatan</option>
                                            <option value="pelanggaran">Pelanggaran</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pelaku</label>
                                        <select name="pelaku" class="form-control">
                                            <option value="" selected="selected">-- Pilih Pelaku --</option>
                                            <option value="1">TNI AD</option>
                                            <option value="2">TNI AL</option>
                                            <option value="3">TNI AU</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Perkara Masuk</label>
                                        <input type="text" name="jml_perkara_masuk" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Perkara Putus</label>
                                        <input type="text" name="jml_perkara_putus" class="form-control" />
                                    </div>

                                </div>

                                <div class="col-md-6">

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
            $(this).tab('show');
            $(this).addClass('sr-only');
        });

        $('a#tab2').click(function(e) {
            e.preventDefault();
            save_method = 'add';
            $('#dataNominatif')[0].reset();
            $(this).tab('show');
            $('#deleteList').hide();
            $('a#tab1').removeClass('sr-only');
        });


        $('#data_nominatif thead tr')
            .addClass('filters')
            .appendTo('#data_nominatif thead');

        // table = $('#data_nominatif').DataTable({

        //     "processing": true,
        //     "serverSide": true,
        //     "order": [],

        //     "ajax": {
        //         "url": "<?php echo site_url('admin/get_data_nominatif'); ?>",
        //         "type": "POST"
        //     },


        //     "columnDefs": [{
        //             "targets": [0],
        //             "orderable": false,
        //         },
        //         {
        //             "targets": [1],
        //             "orderable": false,
        //         },
        //         {
        //             "targets": [-1],
        //             "orderable": false,
        //         },
        //     ],

        // });

        table = $('#data_nominatif').DataTable({
            orderCellsTop: false,
            fixedHeader: false,
            "ajax": {
                "url": "<?php echo site_url('admin/get_data_nominatif'); ?>",
                "type": "POST"
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            }],
            initComplete: function() {
                var api = this.api();

                // For each column
                api
                    .columns([2, 3, 4])
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('keyup change', function(e) {
                                e.stopPropagation();

                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();

                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
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



    function editDataNominatif(id) {
        save_method = 'update';
        $('#dataNominatif')[0].reset();
        $('a#tab2').tab('show');

        $.ajax({
            url: "<?php echo site_url('admin/edit_data_nominatif/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('a#tab1').removeClass('sr-only');
                $('#deleteList').hide();
                $('[name="id_data_nominatif"]').val(data.id);
                $('[name="tahun"]').val(data.tahun);
                $('[name="bulan"]').val(data.bulan);
                $('[name="jenis"]').val(data.jenis);
                $('[name="pelaku"]').val(data.pelaku);
                $('[name="jml_perkara_masuk"]').val(data.jml_perkara_masuk);
                $('[name="jml_perkara_putus"]').val(data.jml_perkara_putus);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data from ajax');
            }
        });
    }

    function save() {
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('admin/input_data_nominatif') ?>";
        } else {
            url = "<?php echo site_url('admin/update_data_nominatif') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#dataNominatif').serialize(),
            dataType: "JSON",
            success: function(data) {
                $('#dataNominatif')[0].reset();
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
                    url: "<?php echo site_url('admin/hapus_data_nominatif') ?>",
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