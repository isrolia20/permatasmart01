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
<form class="bg0 p-t-75 p-b-85" action="<?= base_url('Pembeli/bayar/') ?>" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <?= $this->session->flashdata('message') ?>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-5 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        <?php if ($detail) : ?>
                            <input class="form-control" type="hidden" name="id" id="id" value="<?= $detail['id'] ?>" placeholder="Id">
                            <input class="form-control" type="hidden" name="id_detail" id="id_detail" value="<?= $detail['id_detail'] ?>" placeholder="Id">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Detail Barang
                            </h4>
                            <h6 class="m-text22 w-size20 w-full-sm m-b-30">
                                <?= 'Kode&nbsp;: &nbsp;' . $detail['kode'] ?>
                            </h6>
                            <h6 class="m-text21 w-size20 w-full-sm m-b-30">
                                <?= 'Barang&nbsp;: &nbsp;' . $detail['name'] ?>
                            </h6>
                            <h6 class="m-text21 w-size20 w-full-sm m-b-30">
                                <?= 'Jumlah&nbsp;: &nbsp;' . $detail['stok'] ?>
                            </h6>
                            <h6 class="m-text21 w-size20 w-full-sm m-b-30">
                                <?= 'Rp' . number_format($detail['harga'], 2, ',', '.') ?>
                            </h6>
                            <h6 class="m-text21 w-size20 w-full-sm m-b-40">
                                <?php $ref = $detail['stok'] * $detail['harga']; ?>
                                <h4><?= 'Total&nbsp;: &nbsp;' .  number_format($ref, 2, ',', '.') ?></h4>
                            </h6>
                            <div class="card m-t-30" style="width: 18rem;">
                                <img src="<?= base_url('assets/admin/img/barang/') . $detail['image']; ?>" alt="IMG">
                            </div>
                            <input class="form-control" type="hidden" name="barang_id" id="barang_id" value="<?= $detail['barang_id'] ?>" placeholder="Id">
                        <?php else : ?>
                        <?php endif; ?>
                    </h4>
                    <hr>
                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">


                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">

                            <div class="">
                                <input class="form-control" type="hidden" name="penjual_id" id="penjual_id" value="<?= $penjual['id'] ?>" placeholder="Id">
                                <input class="form-control" type="hidden" name="pembeli_id" id="pembeli_id" value="<?= $user['id']; ?>" placeholder="id">

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Nama Penjual &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="penjual_name" id="penjual_name" value="<?= $penjual['name']; ?>" placeholder="Name" readonly>
                                </div>
                                <?= form_error('penjual_name', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Bank &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="penjual_bank" id="penjual_bank" value="<?= $penjual['nama_bank']; ?>" placeholder="Bank">
                                </div>
                                <?= form_error('penjual_bank', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Rekening &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="penjual_rekening" id="penjual_rekening" value="<?= $penjual['no_rekening']; ?>" placeholder="Rekening">
                                </div>
                                <?= form_error('penjual_rekening', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Telpon &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-t-10">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="penjual_telp" id="penjual_telp" value="<?= $penjual['no_telp']; ?>" placeholder="No Telpon">
                                </div>
                                <?= form_error('penjual_telp', '<small class="text-danger">', '</small>'); ?>


                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Nama Pembeli &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-t-10">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="pembeli_name" id="pembeli_name" value="<?= $user['name'] ?>" placeholder="Nama">
                                </div>
                                <?= form_error('pembeli_name', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Email Pembeli &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-t-10">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="pembeli_email" id="pembeli_email" value="<?= $user['email'] ?>" placeholder="Email">
                                </div>
                                <?= form_error('pembeli_email', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Bank Pembeli &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-t-10">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="pembeli_bank" id="pembeli_bank" value="<?= $user['nama_bank'] ?>" placeholder="Bank">
                                </div>
                                <?= form_error('pembeli_bank', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Rekening Pembeli &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-t-10">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="pembeli_rekening" id="pembeli_rekening" value="<?= $user['no_rekening'] ?>" placeholder="Rekening">
                                </div>
                                <?= form_error('pembeli_rekening', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Telpon Pembeli &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-t-10">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="pembeli_telp" id="pembeli_telp" value="<?= $user['no_telp'] ?>" placeholder="No Telpon">
                                </div>
                                <?= form_error('pembeli_telp', '<small class="text-danger">', '</small>'); ?>
                                <h6 class="m-text21 w-size19 w-full-sm m-t-10">
                                    Upload Bukti:
                                </h6>
                                <div class="bor8 bg0 m-b-0">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="file" name="image" id="image" required>
                                </div>
                                <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                <input class="mtext-110 cl2" type="text" name="total" id="total" value="Rp. <?php
                                                                                                            $currently = $detail['stok'] * $detail['harga'];
                                                                                                            echo number_format($currently, 2, ',', '.');
                                                                                                            ?>" readonly>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>