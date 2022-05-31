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
                    <table id="data-users" class="table table-responsive" style="width:100%" cellspacing="2">
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
                                <th>Status</th>
                                <!-- <th>Opsi</th> -->
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
                                            <img src="<?= base_url('assets/user/img/bayar/') . $rpj['image']; ?>" alt="plant-pict">
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($rpj['status']) : ?>
                                            Lunas
                                        <?php else : ?>
                                            Belum Lunas
                                        <?php endif; ?>
                                    </td>
                                    <!-- <td>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <a href="#edit-barang" class="badge badge-warning" role="badge" data-id="<?= $rpj['id']; ?>" data-kode="<?= $rpj['kode']; ?>" data-name="<?= $rpj['name']; ?>" data-image="<?= $rpj['image']; ?>" data-stok="<?= $rpj['stok']; ?>" data-harga="<?= $rpj['harga']; ?>" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>Edit
                                                </a>
                                            </div>
                                            <div class="col-lg-6">
                                                <a href="#delete<?= $rpj['id'] ?>" class="badge badge-danger" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td> -->
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
</div>