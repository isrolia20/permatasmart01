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
<form class="bg0 p-t-75 p-b-85" action="<?= base_url('Pembeli/checkout/') ?>" method="post">
    <div class="container">
        <div class="row">
            <?= $this->session->flashdata('message') ?>
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-1"></th>
                                <th class="column-5 text-center">Kode Barang</th>
                                <th class="column-1"></th>
                                <th class="column-2">Nama</th>
                                <th class="column-1"></th>
                                <th class="column-3">Price</th>
                                <th class="column-1"></th>
                                <th class="column-4">Quantity</th>
                                <th class="column-1"></th>
                                <th class="column-5">Total</th>
                            </tr>
                            <?php if ($this->cart->contents() == TRUE) : ?>
                                <?php foreach ($this->cart->contents() as $items) : ?>
                                    <?php if ($items['pembeli_id'] == $this->session->userdata('id')) : ?>
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="<?= base_url('assets/admin/img/barang/') . $items['image']; ?>" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-1"></td>
                                            <td class="column-5 text-center"><?= $items['kode'] ?></td>
                                            <th class="column-1"></th>
                                            <td class="column-2"><?= $items['name'] ?></td>
                                            <td class="column-1"></td>
                                            <td class="column-3"><?= 'Rp' . number_format($items['price'], 2, ',', '.'); ?></td>
                                            <th class="column-1"></th>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="p-4"></div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="<?= $items['qty']; ?>" disabled>

                                                    <div class="cl8 hov-btn3 trans-04 flex-c-m"></div>
                                                </div>
                                            </td>
                                            <td class="column-1"></td>
                                            <td class="column-5"><?= 'Rp' . number_format($items['qty'] * $items['price'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                Tidak list pesanan anda
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Total Keranjang
                    </h4>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">


                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">

                            <div class="">
                                <input class="form-control" type="hidden" name="pembeli_id" id="pembeli_id" value="<?= $user['id']; ?>" placeholder="id">

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Kode Transaksi &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="kode" id="kode" value="<?= $kode; ?>" placeholder="Kode" readonly>
                                </div>
                                <?= form_error('kode', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Nama &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="pembeli_name" id="pembeli_name" value="<?= $user['name']; ?>" placeholder="Name">
                                </div>
                                <?= form_error('pembeli_name', '<small class="text-danger">', '</small>'); ?>

                                <h4 class="m-t-9">
                                    <span class="stext-110 cl2 ">
                                        Email &nbsp;
                                    </span>
                                </h4>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="pembeli_email" id="pembeli_email" value="<?= $user['email']; ?>" placeholder="Email">
                                </div>
                                <?= form_error('pembeli_email', '<small class="text-danger">', '</small>'); ?>

                                <?php if ($this->cart->contents() == TRUE) : ?>
                                    <?php foreach ($this->cart->contents() as $items) : ?>
                                        <?php if ($items['pembeli_id'] == $this->session->userdata('id')) : ?>

                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="hidden" name="penjual_id[]" id="penjual_id" value="<?= $items['penjual_id']; ?>" placeholder="penjual_id">



                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="hidden" name="id[]" id="id" value="<?= $items['id']; ?>" placeholder="id">



                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="hidden" name="name[]" id="name" value="<?= $items['name']; ?>" placeholder="Name">



                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="hidden" name="price[]" id="price" value="<?= $items['price']; ?>" placeholder="Price">



                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="hidden" name="qty[]" id="qty" value="<?= $items['qty']; ?>" placeholder="Qty">

                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="hidden" name="image[]" id="image" value="<?= $items['image']; ?>" placeholder="Image">



                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    Tidak list pesanan anda
                                <?php endif; ?>
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
                                <input class="mtext-110 cl2" type="text" name="total" id="total" value="Rp. <?= number_format($this->cart->total(), 2, ',', '.') ?>" readonly>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>