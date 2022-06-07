<section class="section">
    <div class="section-header"><a href="/">
            <h1>Tutor</h1>
        </a></div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Table Tutor</h4>
                        <div class="card-header-action"><a class="btn btn-primary" href="<?= base_url('admin/tutor/add'); ?>">Tambah Data</a></div>
                    </div>
                    <div class="card-body">
                        <!--v-if-->
                        <div class="table-responsive">
                            <table id="myTable" class="table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">JK</th>
                                        <th scope="col">Profesi</th>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">is_active</th>
                                        <th scope="col">File PDF</th>
                                        <th scope="col">is_available</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-content">
                                </tbody>
                            </table>
                            <!--v-if-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Modal title</h3>
            </div>
            <div class="modal-body">
                <form method="POST" id="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="form-divider">
                        Data Diri
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control" name="name" autofocus>
                    </div>


                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input id="address" type="text" class="form-control" name="address" autofocus>
                    </div>

                    <div class="row">

                        <div class="form-group col-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control selectric" name="sex">
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>


                        <div class="form-group col-6">
                            <label for="phone_number">Nomor Telepon</label>
                            <input id="phone_number" type="text" class="form-control" name="phone_number" autofocus>
                        </div>
                    </div>


                    <!-- <div class="row">
                        <div class="form-group col-6">
                            <label for="parent">Nama Orangtua</label>
                            <input id="parent" type="text" class="form-control" name="parent" autofocus>
                        </div>

                        <div class="form-group col-6">
                            <label for="phone_number_parent">Nomor Orangtua</label>
                            <input id="phone_number_parent" type="text" class="form-control" name="phone_number_parent" autofocus>
                        </div>
                    </div> -->



                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <input id="bio" type="text" class="form-control" name="bio" autofocus>
                    </div>


                    <!-- <div class="form-group">
                        <label for="school">Nama Sekolah</label>
                        <input id="school" type="text" class="form-control" name="school" autofocus>
                    </div> -->

                    <div class="row">
                        <div class="form-group col-6">
                            <label>Tingkatan</label>
                            <select class="form-control selectric" name="level">
                                <option value="sd">SD</option>
                                <option value="smp">SMP</option>
                                <option value="sma">SMA</option>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label>Aktif</label>
                            <select class="form-control selectric" name="is_active">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspend">Suspend</option>
                            </select>
                        </div>


                        <!-- <div class="form-group col-6">
                            <label for="class">Kelas</label>
                            <input id="class" type="text" class="form-control" name="class" autofocus>
                        </div> -->
                    </div>

                    <div class="form-group" id="avatar-preview">
                        <label for="">Avatar</label>
                        <div class="mb-3"></div>
                        <input name="avatar" type="file" class="hiddenfile" />
                        <button type="button" onclick="uploadImage()" id="label-avatar" class="btn btn-primary">Upload Avatars</but>
                            <span class="help-block text-danger text-capitalize"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn_save" onclick="save()" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var save_method;
    var table;
    var url_id;
    var imageSrc = null;
    $(document).ready(function() {

        //datatables
        table = $('#myTable').DataTable({

            "pageLength": 20,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('TutorController/get_data_user') ?>",
                "type": "POST",
            },


            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],


        });
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    };

    $('input[type="file"]').change(function(e) {
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = (e) => {
            imageSrc = e.target.result;
            $('#label-avatar').text('Change Avatar'); // label avatar upload
            $('#avatar-preview div').html('<img src="' + imageSrc + '" class="img-responsive mb-3" style="width: 100px">'); // show photo					

        };
    });

    function uploadImage() {
        $('input[type="file"]').trigger('click');
    }

    function updateList(id) {
        save_method = 'update';
        url_id = id;
        base_url = "<?= base_url(); ?>";
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url: "<?= base_url('TutorController/get_id/'); ?>" + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="email"]').val(data.email);
                $('[name="name"]').val(data.name);
                $('[name="address"]').val(data.address);
                $('[name="sex"]').val(data.sex);
                $('[name="phone_number"]').val(data.phone_number);
                // $('[name="parent"]').val(data.parent);
                // $('[name="phone_number_parent"]').val(data.phone_number_parent);
                $('[name="bio"]').val(data.bio);
                // $('[name="school"]').val(data.school);
                $('[name="level"]').val(data.level);
                $('[name="is_active"]').val(data.tutor_act);
                // $('[name="class"]').val(data.class);
                // $('[name="is_active"]').val(data.is_active);


                $('#avatar-preview').show();
                if (data.avatar) {
                    $('#label-avatar').text('Change Avatar'); // label avatar upload
                    $('#avatar-preview div').html('<img src="' + base_url + 'upload/img/tutor/' + data.avatar + '" class="img-responsive mb-3 img-preview" style="width: 100px">'); // show photo					
                } else {
                    $('#label-avatar').text('Upload Avatar'); // label avatar upload
                    $('#avatar-preview div').text('(No avatar)');
                }

                $('#modalForm').modal('show');
                $('.modal-title').text('Update Data');
                reload_table();
            }
        });

    }



    function add() {
        save_method = 'add';
        $('.img-preview').attr('src', null);
        $('#label-avatar').text('Upload Avatar');
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modalForm').modal('show');
        $('.modal-title').text('Tambah Data');
    }


    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('TutorController/add'); ?>";
        } else {
            url = "<?php echo site_url('TutorController/update/'); ?>" + url_id;
        }
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modalForm').modal('hide');
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable


            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
                console.log(textStatus)
                console.log(errorThrown)
                document.location.href = "<?= base_url('admin/tutor') ?>"
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
        imageSrc = null;
    }

    function deleteList(id) {
        swal({
            title: 'Konfirmasi',
            text: 'Apakah anda yakin akan menghapus data ini?',
            icon: 'warning',
            buttons: ['Batal', "OK"],
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: "<?= base_url('TutorController/delete/'); ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        reload_table();
                    }

                });
            } else {
                swal({
                    title: 'Dibatalkan',
                    icon: 'success',
                    type: 'success'
                })
            }
        });


    }
</script>