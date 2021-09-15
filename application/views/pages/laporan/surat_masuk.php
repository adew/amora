<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Laporan Surat Masuk
            <!-- <small>Aplikasi Pengarsipan Surat</small> -->
        </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-primary" style="display: inline-block;">
            <div class="box-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-file-pdf-o"></i>&nbsp;
                            <a data-toggle="collapse" href="#collapseOne" style="color: white;">
                                Buat Laporan
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="collapse">
                        <div class="panel-body">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" onclick="laporanSuratMasuk('bulan_ini')">Bulan ini</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratMasuk('minggu_ini')">Minggu ini</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratMasuk('hari_ini')">Hari ini</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratMasuk('bulan_kemarin')">Bulan Kemarin</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratMasuk('kemarin')">Kemarin</button>
                            </div>

                            <hr>

                            <form class="form-inline" action="<?php echo site_url('laporan/print_pdf/1') ?>" target="_blank" method="get">
                                <!-- <p>Berdasarkan status disposisi</p>
                                <select name="status_disposisi" class="form-control">
                                    <option value="3" selected="selected">Semua</option>
                                    <option value="1">Sudah Disposisi</option>
                                    <option value="2">Belum Disposisi</option>
                                </select> -->
                                <input type="hidden" name="status_disposisi" value="3" />
                                <p></p>
                                <p>Berdasarkan rentang tanggal surat</p>
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
                </div>



                <div class="table-responsive">
                    <table id="laporanSuratMasuk" class="table">
                        <thead>
                            <tr>
                                <!-- <th>No</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Perihal</th>
                                <th>Jenis Surat</th>
                                <th>Kepada</th>
                                <th>Deskripsi</th>
                                <th>Username</th>
                                <th>Berkas</th>
                                <th>Sifat</th>
                                <th>Status Disposisi</th> -->

                                <th>No</th>
                                <th>No. Surat</th>
                                <th>Tgl Surat</th>
                                <th>Perihal</th>
                                <th>Asal Surat</th>
                                <th>Jenis Surat</th>
                                <th>Keterangan</th>
                                <th>Petugas</th>
                                <th>Berkas</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</div>
</section>

</div>

</div>


<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/moment.js'); ?>"></script>
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
                "url": "<?php echo site_url('laporan/surat_masuk'); ?>",
                "type": "POST"
            },


            "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                },
                {
                    "targets": [1],
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

    function laporanSuratMasuk(waktu) {
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
</script>


</body>

</html>