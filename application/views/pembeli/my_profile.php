<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php foreach ($data_banner as $dtbnr) : ?>
                <?php $no = 1; ?>
                <div class="item-slick<?= $no; ?>" style="background-image: url(<?= base_url('assets/admin/img/banner/') . $dtbnr['image'] ?>);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    <?= $dtbnr['name']; ?>
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    <?= $dtbnr['descript']; ?>
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="<?= base_url('Pembeli') ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Beli Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $no++; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
        </div>
    </div>
</div>


<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Selamat Datang <?= $user['name']; ?></h5>
                        <?= $this->session->flashdata('message') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary mt-2 ml-2 mr-2 d-flex justify-content-center">
                        <h5 class="card-title text-center pb-3 pt-4 text-white">My Profil</h5>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <h5 class="mb-3">Data <?= $user['name']; ?></h5>
                            <div class="col-md-12 d-flex justify-content-center gbr">
                                <img src="<?= base_url('assets/user/img/profile/') . $user['image']; ?>" class="img-circle elevation-2 img-thumbnail rounded-circle" alt="Profile User Image">
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
                    <div class="card-footer">
                        <div class="stats">
                            <a href="<?= base_url('Pembeli/edit_profile') ?>" class="btn btn-warning">
                                <i class="fa fa-edit"></i> Edit Profile
                            </a>
                            <a href="<?= base_url('Pembeli/change_password') ?>" class="btn btn-warning">
                                <i class="fa fa-key"></i> Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>