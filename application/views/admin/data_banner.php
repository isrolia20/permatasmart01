<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="col-md-7 col-md-offset-5 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Selamat Datang <?= $user['name']; ?></h5>
                    <?= $this->session->flashdata('message') ?>
                </div>
                <div class="card-body">
                    <table id="data-users" class="table table-responsive" style="width:100%" cellspacing="2">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Urutan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_banner as $datbnr) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td>
                                        <?= $datbnr['name']; ?>
                                    </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-9">
                                                <img src="<?= base_url('assets/admin/img/banner/') . $datbnr['image']; ?>" class="img-thumbnail img-fluid" alt="banner-pict">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $datbnr['descript']; ?>
                                    </td>
                                    <td>
                                        <?= date('d M Y', strtotime($datbnr['banner_date'])); ?>
                                    </td>
                                    <td>
                                        <?= $datbnr['urutan']; ?>
                                    </td>
                                    <td>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-xxl-6 pr-1">
                                                <a href="#edit<?= $datbnr['id'] ?>" class="badge badge-warning" role="badge" data-id="<?= $datbnr['id']; ?>" data-toggle="modal">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </div>
                                            <div class="col-xxl-6 pr-1">
                                                <a href="#delete<?= $datbnr['id'] ?>" class="badge badge-danger" role="badge" data-toggle="modal">
                                                    <i class="fa fa-trash"></i> Delete
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
                    <button class="btn bg-primary" data-toggle="modal" data-target="#tambah">
                        <i class="fa fa-plus-circle"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah">
        <div class=" modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Admin/kelola_banner'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="Gambar">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Urutan">Urutan</label>
                            <input type="number" class="form-control" name="urutan" id="urutan" placeholder="Urutan">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn bg-primary btn-outline-light">Simpan</button>
                        <button type="button" class="btn bg-primary btn-outline-light" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal Edit -->
    <?php foreach ($data_banner as $datbnr) : ?>
        <div class="modal fade" id="edit<?= $datbnr['id']; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Edit <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Admin/update_data_banner'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input type="hidden" class="form-control" name="id" id="id" value="<?= $datbnr['id']; ?>" placeholder="Id">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $datbnr['name']; ?>" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <label for="Gambar">Gambar</label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?= base_url('assets/admin/img/banner/') . $datbnr['image']; ?>" class="img-circle elevation-2 img-thumbnail" alt="banner-pict">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image">
                                                    <label class="custom-file-label" for="image"><?= $datbnr['image']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10"><?= $datbnr['descript']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Urutan">Urutan</label>
                                <input type="number" class="form-control" name="urutan" id="urutan" value="<?= $datbnr['urutan']; ?>" placeholder="Urutan">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn bg-primary btn-outline-light">Update</button>
                            <button type="button" class="btn bg-primary btn-outline-light" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php endforeach; ?>
    <!-- /.modal -->



    <!-- Modal Delete -->
    <?php foreach ($data_banner as $datbnr) : ?>
        <div class="modal fade" id="delete<?= $datbnr['id']; ?>">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Delete <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Admin/delete_data_banner'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="<?= $datbnr['id']; ?>">
                            <p class="text-center">Apakah anda yakin data ini dihapus?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn bg-primary btn-outline-light">Ya</button>
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
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->