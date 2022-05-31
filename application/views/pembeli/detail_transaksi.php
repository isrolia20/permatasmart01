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
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <?= $this->session->flashdata('message') ?>
                            <tr class="table_head">
                                <th class="column-1">Nama</th>
                                <th class="column-1"></th>
                                <th class="column-1">Product</th>
                                <th class="column-1"></th>
                                <th class="column-2">Quantity</th>
                                <th class="column-1"></th>
                                <th class="column-3">Harga</th>
                                <th class="column-2"></th>
                                <th class="column-1"></th>
                                <th class="column-3">Total Harga</th>
                                <td class="column-1"></td>
                                <th class="column-4 text-center">Aksi</th>
                                <td class="column-1"></td>
                                <th class="column-4 text-center">Status</th>
                                <td class="column-1"></td>

                            </tr>
                            <?php foreach ($data_detail as $row) : ?>
                                <tr class="table_row">
                                    <td class="column-1">
                                        <?= $row['name']; ?>
                                    </td>
                                    <td class="column-1"></td>
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="<?= base_url('assets/admin/img/barang/') . $row['image']; ?>" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-1"></td>
                                    <td class="column-2 p-l-30"> <?= $row['stok']; ?></td>
                                    <th class="column-1"></th>
                                    <td class="column-3"><?= 'Rp' . number_format($row['harga'], 2, ',', '.'); ?></td>
                                    <td class="column-2"></td>
                                    <td class="column-1"></td>
                                    <td class="column-3">
                                        <?php
                                        $sum = $row['stok'] * $row['harga'];
                                        ?>
                                        <?=
                                        'Rp' . number_format($sum, 2, ',', '.');
                                        ?>
                                    </td>
                                    <td class="column-1"></td>
                                    <td class="column-4">
                                        <?php if ($row['status'] == 2 && $row['image_bayar'] != NULL) : ?>
                                            <div class="badge badge-primary m-r-30">
                                                <i class="fa fa-circle"></i> Confirmed
                                            </div>
                                        <?php elseif ($row['status'] == 1 && $row['image_bayar'] != NULL) : ?>
                                            <div class="badge badge-primary m-r-30">
                                                <i class="fa fa-circle"></i> Dicek Penjual, Mohon Tunggu
                                            </div>
                                        <?php elseif ($row['status'] == 1 && $row['image_bayar'] == NULL) : ?>
                                            <div class="badge badge-warning m-r-30">
                                                <i class="fa fa-info-circle"></i> Bukti Bayar belum diupload, Sedang dicek penjual
                                            </div>
                                        <?php else : ?>
                                            <form action="<?= base_url('Pembeli/bayar/') ?>" method="post">
                                                <input type="hidden" name="penjual_id" id="penjual_id" value="<?= $row['penjual_id']; ?>">
                                                <input type="hidden" name="id" id="id" value="<?= $row['id_detail']; ?>">
                                                <input type="hidden" name="pembeli_name" id="pembeli_name" value="<?= $user['name'] ?>">
                                                <input type="hidden" name="pembeli_email" id="pembeli_email" value="<?= $user['email'] ?>">
                                                <input type="hidden" name="pembeli_bank" id="pembeli_bank" value="<?= $user['nama_bank'] ?>">
                                                <input type="hidden" name="pembeli_rekening" id="pembeli_rekening" value="<?= $user['no_rekening'] ?>">

                                                <input type="hidden" name="pembeli_telp" id="pembeli_telp" value="<?= $user['no_telp'] ?>">
                                                <button type="submit" class="badge badge-primary m-r-30">
                                                    <i class="fa fa-upload"></i> Bayar
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                    <td class="column-1"></td>
                                    <td class="column-4 text-center">
                                        <?php if ($row['status'] == 2 && $row['image_bayar'] != NULL) : ?>
                                            <div class="badge badge-primary m-r-30">
                                                <i class="fa fa-circle"></i> Confirmed
                                            </div>
                                        <?php elseif ($row['status'] == 1 && $row['image_bayar'] != NULL) : ?>
                                            <div class="badge badge-primary m-r-30">
                                                <i class="fa fa-circle"></i> Dicek Penjual, Mohon Tunggu
                                            </div>
                                        <?php elseif ($row['status'] == 1 && $row['image_bayar'] == NULL) : ?>
                                            <div class="btn btn-warning m-r-30">
                                                <i class="fa fa-info-circle text-danger"></i> Bukti Bayar belum diupload dan pesanan dicek penjual
                                            </div>
                                        <?php elseif ($row['status'] == 3) : ?>
                                            <div class="btn btn-danger m-r-30">
                                                <i class="fa fa-info-circle text-light"></i> Pesanan anda ditolak penjual, Bukti Bayar belum diupload
                                            </div>
                                        <?php else : ?>
                                            <div class="btn btn-primary m-r-30 text-dark">
                                                <i class="fa fa-info-circle text-danger"></i> Belum dibayar
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="column-1"></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>