<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Konsep Putusan
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
        <!-- <button id="deleteList" disabled="disabled" class="btn btn-danger" onclick="deleteList()"><i class="fa fa-trash"></i> Hapus</button> -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="SuratMasuk">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body">
                        <div id="grid_konsep" class="row">
                            <!-- <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h4>01-K/PM III-18/AD/VII/2021</h4>

                                        <p>BAMBANG PAMUNGKAS</p>
                                    </div>
                                    <div class="icon">
                                        <i>01</i>
                                    </div>
                                    <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="InputSuratMasuk">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body" style="padding: 10px 20px;">
                        <form id="konsepMasuk">
                            <!-- <input type="hidden" name="id_surat_masuk" /> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No. Register</label>
                                        <input type="text" name="no_reg" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Terdakwa</label>
                                        <input type="text" name="nama" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Pangkat/NRP</label>
                                        <input type="text" name="pangkat" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Register</label>
                                        <div class="input-group">
                                            <input type="text" name="tgl_register" id="inputTglSurat" class="form-control" />
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kesatuan</label>
                                        <select name="jenis_kesatuan" class="form-control">
                                            <option value="ad" selected="selected"> Angkatan Darat </option>
                                            <option value="al"> Angkatan Laut </option>
                                            <option value="au"> Angkatan Udara </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Petugas</label>
                                        <input value="<?php echo $nama_lengkap ?>" class="form-control" disabled="disabled" />
                                    </div>
                                    <div class="form-group">
                                        <label id="label-photo">Berkas</label>
                                        <div>
                                            <input name="berkas_konsep" type="file">
                                            <span class="help-block"></span>
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
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<!-- <script src="<?php echo base_url('assets/adminlte/js/adminlte.min.js'); ?>"></script> -->

<script>
    var table;
    var file_berkas_konsep;
    $(document).ready(function() {

        $('a#tab1').click(function(e) {
            e.preventDefault();
            // $('#deleteList').show();
            $(this).tab('show');
            $(this).addClass('sr-only');
        });

        $('a#tab2').click(function(e) {
            e.preventDefault();
            save_method = 'add';
            $(this).tab('show');
            // $('#deleteList').hide();
            $('a#tab1').removeClass('sr-only');
        });

        $('#resetBtn').click(function(e) {
            e.preventDefault();
            $('#konsepMasuk')[0].reset();
        });


        $('#inputTglSurat').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true
        });

        get_data_konsep();
    });

    function get_data_konsep() {
        $.ajax({
            url: "<?php echo site_url('admin/get_konsep') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                $('#grid_konsep').html('');
                if (response.data.length > 0) {
                    for (let i = 0; i < response.data.length; i++) {
                        $('#grid_konsep').append(response.data[i]);
                    }
                } else {
                    $('#grid_konsep').append('<div style="margin: 15px;" class="alert alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-empty"></i>Data masih kosong</h4></div>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data from ajax');
            }
        });
    }

    function editSuratMasuk(id) {
        save_method = 'update';
        $('#konsepMasuk')[0].reset();
        $('a#tab2').tab('show');

        $.ajax({
            url: "<?php echo site_url('admin/edit_surat_masuk/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('a#tab1').removeClass('sr-only');
                $('#deleteList').hide();
                $('[name="id_surat_masuk"]').val(data.id_surat_masuk);
                $('[name="no_reg"]').val(data.no_reg);
                $('[name="tgl_register"]').val(data.tgl_register);
                $('[name="nama"]').val(data.nama);
                $('[name="jenis_surat"]').val(data.id_jenis_surat);
                $('[name="pengirim"]').val(data.pengirim);
                $('[name="ditujukan"]').val(data.ditujukan);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="file"]').val(data.file);
                $('[name="sifat_surat"]').val(data.sifat_surat);
                $('[name="status_disposisi"]').val(data.status_disposisi);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data from ajax');
            }
        });
    }

    function showModal(id) {
        $('#modalKonsep')[0].reset();
        $('#modal1').modal('show');
        $.ajax({
            url: "<?php echo site_url('admin/get_konsep_detail/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                $("a#lampiran").attr("href", "<?php echo base_url('uploads/f_konsep/') ?>" + response.data.berkas_konsep);
                $('[name="idKonsep"]').val(id);
                $('#noreg').text(response.data.no_reg);
                $('#nama_tdw').text(response.data.nama);
                $('#pangkat').text(response.data.pangkat);
                $('#lampiran').text(response.data.berkas_konsep);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data from ajax');
            }
        });
    }

    function save() {
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('admin/input_konsep') ?>";
        } else {
            url = "<?php echo site_url('admin/update_konsep') ?>";
        }

        var formData = new FormData($('#konsepMasuk')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#konsepMasuk')[0].reset();
                    get_data_konsep();
                    $('a#tab1').tab('show');
                    $('.content-header').append('<div style="margin: 15px 0 0 0;" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data telah disimpan.</div>');
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Input Data gagal!');

            }
        });
    }

    function deleteList() {
        var id_konsep = $('[name="idKonsep"]').val();

        if (confirm('Yakin akan menghapus data?')) {
            $.ajax({
                type: "POST",
                data: {
                    id: id_konsep
                },
                url: "<?php echo site_url('admin/hapus_konsep') ?>",
                dataType: "JSON",
                success: function(data) {
                    get_data_konsep();
                    $('.content-header').append('<div style="margin: 15px 0 0 0;" class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4>Data telah dihapus.</div>');
                    $('#modal1').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }
</script>

<style>
    .form-horizontal .control-label {
        text-align: left !important;
    }
</style>

<div class="modal fade in" id="modal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Details</h4>
            </div>
            <form id="modalKonsep" class="form-horizontal" target="_blank" action="<?php echo site_url('admin/buat_disposisi'); ?>" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="idKonsep" />
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">No. REG.</label>
                                <div class="col-sm-8 control-label">
                                    <p id="noreg"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nama Terdakwa</label>
                                <div class="col-sm-8 control-label">
                                    <p id="nama_tdw"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Pangkat/NRP</label>
                                <div class="col-sm-8 control-label">
                                    <p id="pangkat"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Lampiran File</label>
                                <div class="col-sm-8 control-label">
                                    <a target="_blank" href="" id="lampiran"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if ($this->ion_auth->is_admin()) { ?>
                        <button type="button" id="printBtn" class="btn btn-danger btn-flat" onclick="deleteList()"><i class="fa fa-trash"></i>&nbspHapus</button>
                    <?php } ?>
                    <button type="button" class="btn btn-primary btn-warning btn-flat" data-dismiss="modal">Kembali</button>
                </div>
            </form>

        </div>
    </div>

</div>

</body>

</html>