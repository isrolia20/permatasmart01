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
                        <div class="row d-flex justify-content-center">
                            <h5>Data <?= $user['name']; ?></h5>
                            <div class="col-md-12 d-flex justify-content-center gbr">
                                <img src="<?= base_url('assets/admin/img/profile/') . $user['image']; ?>" class="img-circle elevation-2" alt="Profile User Image">
                            </div>
                        </div>
                        <div class="row text-center mt-4">
                            <div class="col-md-12">
                                <div class="card-body pt-1 ml-2 mr-2 rounded">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 col-lg-12 mx-auto lab">
                                            <p class="labelku pb-1 pt-2"><?= $user['name']; ?></p>
                                            <p class="labelku pb-1"><?= $user['email']; ?></p>
                                            <p class="labelku" class="pb-1"><?= $user['no_telp']; ?></p>
                                            <label for="since">Member Since <?= date('d F Y', $user['date_created']); ?></label><br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>