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
                            <!-- <div class="row justify-content-center">
                                <div class="col-lg-6 col-lg-offset-6">
                                    <div class="card mt-5">
                                        <div class="card-header bg-primary">
                                            <h4>Account User</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    Admin
                                                    Email : admin@gmail.com <br>
                                                    Pwd : 123456
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    Penjual
                                                    Email : muhfirmanagebimantara@gmail.com <br>
                                                    Pwd : 220500
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    Pembeli
                                                    Email : firmanagebimantara@gmail.com <br>
                                                    Pwd : 220500
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
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
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Produk Bimbel
            </h3>
        </div>
        <?= $this->session->flashdata('message') ?>
        <form action="<?= base_url('pembeli'); ?>" method="post">
            <div class="form-row avoid-this">
                <div class="form-group col-md-5">
                    <label for="cari">Cari :</label>
                    <input type="text" name="cari" class="form-control" value="<?= set_value('cari') ?>">
                    <?= form_error('cari', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group" style="margin-top: 30px;">
                    <button type="submit" name="filter" class="btn btn-info btn-round" data-toggle="tooltip" data-placement="top" title="Cari">
                        Cari
                    </button>
                </div>
            </div>
        </form>
        <div class="row isotope-grid">
            <?php foreach ($data_produk as $datprk) : ?>
                <?php $no = 1; ?>
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="<?= base_url('assets/admin/img/barang/') . $datprk['image']; ?>" alt="IMG-PRODUCT">

                            <form action="<?= base_url('Pembeli/add_cart/' . $datprk['id']); ?>" method="post">
                                <div class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    <div class="wrap-num-product flex-w">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="stok" id="stok" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                    <button type="submit" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 mb-5">
                                        Keranjang
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    <?= $datprk['name']; ?>
                                </a>
                                <span class="stext-105 cl3">
                                    <?= 'Harga&nbsp;:&nbsp;' . number_format($datprk['harga'], '2', ',', '.'); ?>
                                </span>
                                <span class="stext-105 cl3">
                                    <?= 'Stok&nbsp;:&nbsp;' . $datprk['stok'] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $no++; ?>
            <?php endforeach; ?>
        </div>
        <?= $this->pagination->create_links(); ?>
    </div>
</section>