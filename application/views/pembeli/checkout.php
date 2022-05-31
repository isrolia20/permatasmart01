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
                                <th class="column-1">Kode Transaksi</th>
                                <th class="column-1"></th>
                                <th class="column-2">Email</th>
                                <th class="column-1"></th>
                                <th class="column-3">Nama</th>
                                <th class="column-1"></th>
                                <th class="column-4 text-center">Total</th>
                                <th class="column-1"></th>
                                <th class="column-2">Tanggal</th>
                                <th class="column-1"></th>
                                <th class="column-6">Batal</th>
                                <th class="column-1"></th>
                                <th class="column-2">Detail</th>
                                <th class="column-1"></th>
                                <th class="column-4">Status</th>
                            </tr>
                            <?php foreach ($data_checkout as $row) : ?>
                                <?php if ($row['pembeli_id'] == $this->session->userdata('id')) : ?>
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <?= $row['kode']; ?>
                                        </td>
                                        <td class="column-1"></td>
                                        <td class="column-2"> <?= $row['pembeli_email']; ?> </td>
                                        <td class="column-1"></td>
                                        <td class="column-3"><?= $row['pembeli_name']; ?></td>
                                        <td class="column-1"></td>
                                        <td class="column-4">
                                            <?= 'Rp' . number_format($row['total_transaksi'], 2, ',', '.'); ?>
                                        </td>
                                        <td class="column-1"></td>
                                        <td class="column-2">
                                            <?php if ($row['tanggal_transaksi'] != NULL) : ?>
                                                <?= date('D, M Y', strtotime($row['tanggal_transaksi'])); ?>
                                            <?php else : ?>
                                                <span class="m-text22 w-size10 w-full-sm">
                                                    Lakukan Pembayaran
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="column-1"></td>
                                        <td class="column-6">
                                            <?php if ($row['status'] == 2) : ?>
                                                <span class="m-text21 w-size10 w-full-sm">
                                                    Pembayaran diproses
                                                </span>
                                            <?php elseif ($row['status'] == 1) : ?>
                                                <span class="m-text21 w-size10 w-full-sm">
                                                    Pembayaran dicek penjual
                                                </span>
                                            <?php else : ?>
                                                <form action="<?= base_url('Pembeli/batal_transaksi/') ?>" method="post">
                                                    <input type="hidden" name="id" id="id" value="<?= $row['transaksi_id']; ?>">
                                                    <button type="submit" class="badge badge-danger m-r-30">
                                                        <i class="fa fa-trash"></i> Batal
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                        <td class="column-1"></td>
                                        <td class="column-2">
                                            <a href="<?= base_url('Pembeli/detail_transaksi/') . $row['transaksi_id']; ?>" class="badge badge-success m-r-30">
                                                <i class="fa fa-info-circle"></i> Detail
                                            </a>
                                        </td>
                                        <td class="column-1"></td>
                                        <td class="column-4">
                                            <?php if ($row['status'] == 2) : ?>
                                                <span class="m-text22 w-size19 w-full-sm">
                                                    Product anda sedang di proses dan segera dikirim
                                                </span>
                                            <?php else : ?>
                                                Pending Product
                                            <?php endif; ?>
                                        </td>
                                        <td class="column-1"></td>
                                    </tr>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>