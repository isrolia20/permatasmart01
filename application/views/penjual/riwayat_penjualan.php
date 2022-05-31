<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center mx-auto">

        <div class="col-md-7 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Selamat Datang <?= $user['name']; ?></h5>
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <?= $this->session->flashdata('message') ?>
                </div>
                <div class="card-body">
                    <table id="barang" class="table table-responsive" style="width:100%" cellspacing="2">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Pembeli</th>
                                <th>Total</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>No Telp Pembeli</th>
                                <th>Barang</th>
                                <th>Bukti TF</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($riwayat_penjualan as $rpj) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $rpj['kode']; ?>
                                    </td>
                                    <td>
                                        <?= $rpj['pembeli_name']; ?>
                                    </td>
                                    <td>
                                        <?= 'Rp' . number_format($rpj['harga'], 2, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?= $rpj['stok']; ?>
                                    </td>
                                    <td>
                                        <?= date('d M Y', strtotime($rpj['tanggal_transaksi'])); ?>
                                    </td>
                                    <td>
                                        <?= date('H:i:s', strtotime($rpj['tanggal_transaksi'])); ?>
                                    </td>
                                    <td>
                                        <?= $rpj['pembeli_telp'] ?>
                                    </td>
                                    <td><?= $rpj['name'] ?></td>
                                    <td>
                                        <div class="card" style="width: 18rem;">
                                            <img src="<?= base_url('assets/user/img/bayar/') . $rpj['image_bayar']; ?>" alt="plant-pict">
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $result = $rpj['harga'] * $rpj['stok'];
                                        ?>
                                        <?= 'Rp ' . number_format($result, 2, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?php if ($rpj['status'] == 2) : ?>
                                            Lunas
                                        <?php elseif ($rpj['status'] == 1) : ?>
                                            Sudah dibayar, Silahkan dicek
                                        <?php else : ?>
                                            Belum Lunas, Tunggu 1 x 24 jam untuk batal
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <?php if ($rpj['status'] == 2) : ?>
                                                    <a href="#" class="badge badge-success" data-toggle="modal">
                                                        <i class="fa fa-info-circle"></i> Lunas
                                                    </a>
                                                <?php else : ?>
                                                    <a href="#konfirm<?= $rpj['id_detail'] ?>" class="badge badge-warning" data-toggle="modal">
                                                        <i class="fa fa-edit"></i> Konfirmasi
                                                    </a>
                                                    <a href="#batal<?= $rpj['id_detail'] ?>" class="badge badge-danger" data-toggle="modal">
                                                        <i class="fa fa-times"></i> Batal
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach; ?>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus-circle"></i> Tambah
                        </button> -->
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Modal Konfrim -->
    <?php foreach ($riwayat_penjualan as $rpj) : ?>
        <div class="modal fade" id="konfirm<?= $rpj['id_detail']; ?>">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Konfirmasi <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Penjual/riwayat_penjualan'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="<?= $rpj['id_detail']; ?>">
                            <p class="text-center">Apakah anda yakin mengonfirmasi pesanan ini?</p>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="submit" class="btn btn-info btn-outline-light">Ya</button>
                            <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php endforeach; ?>
    <!-- /.modal -->

    <!-- Modal Batal -->
    <?php foreach ($riwayat_penjualan as $rpj) : ?>
        <div class="modal fade" id="batal<?= $rpj['id_detail']; ?>">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Batal <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Penjual/cancel_trans'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="<?= $rpj['id_detail']; ?>">
                            <p class="text-center">Apakah anda yakin membatalkan pesanan ini?</p>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="submit" class="btn btn-info btn-outline-light">Ya</button>
                            <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php endforeach; ?>
    <!-- /.modal -->
</div>