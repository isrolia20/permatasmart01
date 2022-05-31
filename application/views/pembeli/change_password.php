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
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-center pb-4 text-white">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('Pembeli/change_password'); ?>" method="POST">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="current">Current Password</label>
                                    <input type="password" class="form-control s-text7 bg6 w-full p-b-5" name="current_password" id="current_password">
                                    <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="new_password1">New Password</label>
                                    <input type="password" class="form-control s-text7 bg6 w-full p-b-5" name="new_password1" id="new_password1">
                                    <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="new_password2">Repeat Password</label>
                                    <input type="password" class="form-control s-text7 bg6 w-full p-b-5" name="new_password2" id="new_password2">
                                    <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="fa fa-refresh"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>