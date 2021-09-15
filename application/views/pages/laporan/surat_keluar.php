<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


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

            <li>
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
            <li class="active">
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
            Laporan Surat Keluar
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
                            <i class="fa fa-file-pdf-o"></i>&nbsp;
                            <a data-toggle="collapse" href="#collapseOne">
                                Buat Laporan
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="collapse">
                        <div class="panel-body">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('bulan_ini')">Bulan ini</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('minggu_ini')">Minggu ini</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('hari_ini')">Hari ini</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('bulan_kemarin')">Bulan Kemarin</button>
                                <button type="button" class="btn btn-default" onclick="laporanSuratKeluar('kemarin')">Kemarin</button>
                            </div>

                            <hr>
                            <p>Berdasarkan rentang tanggal</p>
                            <form class="form-inline" action="<?php echo site_url('laporan/print_pdf/2') ?>" target="_blank" method="post">
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
                    <table id="laporanSuratKeluar" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Perihal</th>
                                <th>Pengirim</th>
                                <th>Kepada</th>
                                <th>Jenis Surat</th>
                                <th>Sifat Surat</th>
                                <th>Petugas</th>
                                <th>Deskripsi</th>
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
                                <th>Pengirim</th>
                                <th>Kepada</th>
                                <th>Jenis Surat</th>
                                <th>Sifat Surat</th>
                                <th>Petugas</th>
                                <th>Deskripsi</th>
                            </tr>
                        </tfoot>
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

        table = $('#laporanSuratKeluar').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('laporan/surat_keluar'); ?>",
                "type": "POST"
            },


            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }]

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
</script>

</body>

</html>