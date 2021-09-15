<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Petugas
            <!-- <small>Aplikasi Pengarsipan Surat</small> -->
        </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <a href="#InputDataPetugas" id="tab2" class="btn btn-info">
            <i class="fa fa-user-plus"></i> Input Data
        </a>
        <a href="#DataPetugas" id="tab1" class="btn btn-info sr-only">
            <i class="fa fa-chevron-left"></i> Kembali
        </a>
        <button id="deleteList" class="btn btn-danger" disabled="disabled" onclick="deleteList()"><i class="fa fa-trash"></i> Hapus</button>


        <div class="tab-content">
            <div class="tab-pane fade in active" id="DataPetugas">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="data_petugas" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>email</th>
                                        <th>Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="InputDataPetugas">
                <div class="box box-primary" style="margin-top: 10px;">
                    <div class="box-body" style="padding: 10px 20px;">
                        <form id="petugas">
                            <input type="hidden" name="user_id""/>
                            <div class=" row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Petugas</label>
                                    <input type="text" name="nama" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="input1" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <input type="password" name="input2" id="pw1" class="form-control" />
                                </div>
                                <!-- <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="" selected="selected">-- Jenis Kelamin --</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" name="tgl_lahir" id="inputTglLahir" class="form-control" />
                                </div> -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="input3" class="form-control" />
                                </div>
                                <!-- checkbox -->
                                <div class="form-group">
                                    <label class="col-md-4">
                                        <input name="group" type="radio" class="minimal-red" value="2" checked>
                                        <label>User Biasa</label>
                                    </label>
                                    <label>
                                        <input name="group" type="radio" class="minimal-red" value="1">
                                        <label> Admin</label>
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="input3" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Telp/No. HP</label>
                                    <input type="text" name="telp" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" rows="4" class="form-control"></textarea>
                                </div>

                            </div> -->
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
<script src="<?php echo base_url('assets/iCheck/icheck.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminlte/js/adminlte.min.js'); ?>"></script>

<script>
    var save_method;
    var table;
    $(document).ready(function() {


        $('a#tab1').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
            $('#deleteList').show();
            $(this).addClass('sr-only');
        });

        $('a#tab2').click(function(e) {
            e.preventDefault();
            save_method = 'add';
            $(this).tab('show');
            $('#deleteList').hide();
            $('a#tab1').removeClass('sr-only');
            $('#petugas')[0].reset();
        });

        table = $('#data_petugas').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('admin/data_petugas'); ?>",
                "type": "POST"
            },


            "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                },
                {
                    "targets": [-1],
                    "orderable": false,
                },
            ],

        });

        $('#inputTglLahir').datepicker({
            autoclose: true
        });

        $("#check-all").click(function() {
            $(".data-check").prop('checked', $(this).prop('checked'));
            enableDeleteBtn();
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

    function save() {

        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('admin/tambah_petugas') ?>";
        } else {
            url = "<?php echo site_url('admin/update_petugas') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#petugas').serialize(),
            dataType: "JSON",
            success: function(data) {
                $('#petugas')[0].reset();
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

    function editPetugas(id) {
        save_method = 'update';
        $('#petugas')[0].reset();
        $('a#tab2').tab('show');

        $.ajax({
            url: "<?php echo site_url('admin/edit_petugas/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('a#tab1').removeClass('sr-only');
                $('#deleteList').hide();
                $('[name="user_id"]').val(data.id);
                $('[name="nama"]').val(data.nama_petugas);
                $('[name="input1"]').val(data.username);
                $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                $('[name="tgl_lahir"]').val(data.tgl_lahir);
                $('[name="input3"]').val(data.email);
                $('[name="telp"]').val(data.telp);
                $('[name="alamat"]').val(data.alamat);
                if (data.group_id == 2) {
                    $("input[name=group][value='2']").prop("checked", true);
                } else {
                    $("input[name=group][value='1']").prop("checked", true);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data from ajax');
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
                    url: "<?php echo site_url('admin/hapus_petugas') ?>",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
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