<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="col-md-7 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Selamat Datang <?= $user['name']; ?></h5>
                    <?= $this->session->flashdata('message') ?>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form action="<?= base_url('Penjual/change_password'); ?>" method="POST">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="current">Current Password</label>
                                    <input type="password" class="form-control mt-3" name="current_password" id="current_password">
                                    <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="new_password1">New Password</label>
                                    <input type="password" class="form-control mt-3" name="new_password1" id="new_password1">
                                    <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="new_password2">Repeat Password</label>
                                    <input type="password" class="form-control mt-3" name="new_password2" id="new_password2">
                                    <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-primary text-white">Simpan</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>