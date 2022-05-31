<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="col-lg-8 p-5">
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
                    <table id="barang-1" class="table table-responsive" style="width:100%" cellspacing="2">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Jenis</th>
                                <th>Ketersediaan</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barang as $brg) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $brg['kode']; ?>
                                    </td>
                                    <td>
                                        <?= $brg['name']; ?>
                                    </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-9">
                                                <img src="<?= base_url('assets/admin/img/barang/') . $brg['image']; ?>" class="img-thumbnail" alt="plant-pict">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $brg['jenis']; ?>
                                    </td>
                                    <td>
                                        <?= $brg['stok']; ?>
                                    </td>
                                    <td>
                                        <?= 'Rp' . number_format($brg['harga'], 2, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <?= date('d M Y', strtotime($brg['tanggal'])); ?>
                                    </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <a href="#edit-barang<?= $brg['id'] ?>" class="badge badge-warning" role="badge" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>Edit
                                                </a>
                                            </div>
                                            <div class="col-lg-6">
                                                <a href="#delete<?= $brg['id'] ?>" class="badge badge-danger" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>Delete
                                                </a>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                        <i class="fa fa-plus-circle"></i> Tambah
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="tambah">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Penjual/kelola_produk'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Kode">Kode</label>
                                <input type="text" class="form-control" name="kode" id="kode" value="<?= $kode ?>" placeholder="Kode">
                            </div>
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama') ?>" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="Gambar">Gambar</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="image" id="image" value="<?= set_value('image') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Jenis">Jenis</label>
                                <?php
                                if (!empty($getJenis)) : ?>
                                    <input list="jenis" name="jenis" class="form-control" Placeholder="Jenis">
                                    <datalist id="jenis">
                                        <?php foreach ($getJenis as $item) : ?>
                                            <option value="<?= $item["name"]; ?>">
                                            <?php endforeach; ?>
                                    </datalist>
                                <?php else : ?>
                                    <input list="jenis" name="jenis" class="form-control" Placeholder="Jenis">
                                    <datalist id="jenis">
                                        <?php foreach ($getJenis as $item) : ?>
                                            <option value="<?= $item["name"]; ?>">
                                            <?php endforeach; ?>
                                    </datalist>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="Stok">Ketersediaan</label>
                                <input type="text" class="form-control" name="stok" id="stok" value="<?= set_value('stok') ?>" placeholder="Ketersediaan">
                            </div>
                            <div class="form-group">
                                <label for="Harga">Harga</label>
                                <input type="text" class="form-control" name="harga" id="harga" value="<?= set_value('harga') ?>" placeholder="Harga">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="submit" class="btn btn-primary btn-outline-light">Simpan</button>
                            <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <!-- Modal Delete -->
        <?php foreach ($barang as $brg) : ?>
            <div class="modal fade" id="delete<?= $brg['id']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title">Delete <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Penjual/delete_produk'); ?>" method="get">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $brg['id']; ?>">
                                <p class="text-center">Apakah anda yakin data ini dihapus?</p>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn btn-danger btn-outline-light">Ya</button>
                                <button type="button" class="btn btn-secondary btn-outline-light" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- /.modal -->





        <!-- Modal Edit -->
        <?php foreach ($barang as $brg) : ?>
            <div class="modal fade" id="edit-barang<?= $brg['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title">Edit <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Penjual/update_produk'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="Kode">Kode</label>
                                    <input type="hidden" name="id" id="id" value="<?= $brg['id']; ?>">
                                    <input type="text" class="form-control" name="kode" id="kode" value="<?= $kode ?>" placeholder="Kode">
                                </div>
                                <div class="form-group">
                                    <label for="Nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $brg['name']; ?>" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="Gambar">Gambar</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="image" id="image" value="<?= set_value('image') ?>">
                                        <input type="text" class="form-control" name="" id="" value="<?= $brg['image']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Jenis">Jenis</label>
                                    <?php
                                    if (!empty($getJenis)) : ?>
                                        <input list="jenis" name="jenis" class="form-control" value="<?= $brg['jenis']; ?>" Placeholder="Jenis">
                                        <datalist id="jenis">
                                            <?php foreach ($getJenis as $item) : ?>
                                                <option value="<?= $item["name"]; ?>">
                                                <?php endforeach; ?>
                                        </datalist>
                                    <?php else : ?>
                                        <input list="jenis" name="jenis" class="form-control" Placeholder="Jenis">
                                        <datalist id="jenis">
                                            <?php foreach ($getJenis as $item) : ?>
                                                <option value="<?= $item["name"]; ?>">
                                                <?php endforeach; ?>
                                        </datalist>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="Stok">Stok</label>
                                    <input type="text" class="form-control" name="stok" id="stok" value="<?= $brg['stok']; ?>" placeholder="Stok">
                                </div>
                                <div class="form-group">
                                    <label for="Harga">Harga</label>
                                    <input type="text" class="form-control" name="harga" id="harga" value="<?= $brg['harga']; ?>" placeholder="Harga">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn btn-warning btn-outline-light">Update</button>
                                <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Tutup</button>
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
    <!-- /.container-fluid -->
</div>