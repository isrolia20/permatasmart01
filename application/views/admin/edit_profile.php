<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="col-md-7 col-md-offset-5 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Selamat Datang <?= $user['name']; ?></h5>
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-md-offset-5">
            <div class="card">
                <div class="card-header bg-primary ml-5 mr-5 d-flex justify-content-center">
                    <h5 class="card-title text-center pb-4 text-white"><?= $title; ?></h5>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('Admin/edit_profile') ?>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="name">Fullname</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $user['name']; ?>">
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="telp">No Telpon</label>
                            <input type="tel" class="form-control" name="no_telp" id="no_telp" value="<?= $user['no_telp']; ?>">
                            <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">Picture</div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?= base_url('assets/admin/img/profile/') . $user['image']; ?>" class="img-circle elevation-2 img-thumbnail rounded-circle" alt="Profile User Image">
                                </div>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                    <?= form_close(); ?>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->