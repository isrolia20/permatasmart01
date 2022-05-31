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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th>No Telpon</th>
                                <th>Alamat</th>
                                <th>Akses</th>
                                <th>Status Akun</th>
                                <th>Tanggal Register</th>
                                <th>No Rekening</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($data_users as $datusr) : ?>
                                <?php if ($datusr['role_id'] == 2 || $datusr['role_id'] == 3) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td>
                                            <?= $datusr['name']; ?>
                                        </td>
                                        <td>
                                            <?= $datusr['email']; ?>
                                        </td>
                                        <td>
                                            <?php if ($datusr['role_id'] == 2) : ?>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12">
                                                        <img src="<?= base_url('assets/admin/img/profile/') . $datusr['image']; ?>" class="img-thumbnail" alt="user-pict">
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12">
                                                        <img src="<?= base_url('assets/user/img/profile/') . $datusr['image']; ?>" class="img-thumbnail" alt="user-pict">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= $datusr['no_telp']; ?>
                                        </td>
                                        <td>
                                            <?= $datusr['alamat']; ?>
                                        </td>
                                        <td>
                                            <?php if ($datusr['role_id'] == 2) : ?>
                                                Seller
                                            <?php else : ?>
                                                Buyer
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($datusr['is_active'] == 1) : ?>
                                                Aktif
                                            <?php else : ?>
                                                Belum Aktif
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= date('d M Y', $datusr['date_created']); ?>
                                        </td>
                                        <td>
                                            <?= $datusr['no_rekening']; ?>
                                        </td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <?php if ($datusr['is_active'] == 1) : ?>
                                                    <div class="col-sm-7 pr-1">
                                                        <a href="#inactive<?= $datusr['id'] ?>" class="badge badge-warning" role="badge" data-id="<?= $datusr['id']; ?>" data-toggle="modal">
                                                            <i class="fa fa-user-alt-slash"></i> Inactive
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="col-sm-7 pr-1">
                                                        <a href="#active<?= $datusr['id'] ?>" class="badge badge-primary" role="badge" data-id="<?= $datusr['id']; ?>" data-toggle="modal">
                                                            <i class="fa fa-user-alt"></i> Active
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-sm-7">
                                                    <a href="#delete<?= $datusr['id'] ?>" class="badge badge-danger" data-toggle="modal">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php
                                $no++;
                            endforeach; ?>

                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <!-- <button class="btn bg-pink" data-toggle="modal" data-target="#tambah">
                                <i class="fa fa-plus-circle"></i> Tambah
                            </button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Inactive -->
    <?php foreach ($data_users as $datusr) : ?>
        <div class="modal fade" id="inactive<?= $datusr['id']; ?>">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-pink">
                        <h4 class="modal-title">Non Aktif <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Admin/inactive_data_user'); ?>" method="get">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="<?= $datusr['id']; ?>">
                            <p class="text-center">Apakah anda yakin data ini dinon-aktifkan?</p>
                        </div>
                        <div class="modal-footer justify-content-end">
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

    <!-- Modal Active -->
    <?php foreach ($data_users as $datusr) : ?>
        <div class="modal fade" id="active<?= $datusr['id']; ?>">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-pink">
                        <h4 class="modal-title">Aktifkan <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Admin/active_data_user'); ?>" method="get">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="<?= $datusr['id']; ?>">
                            <p class="text-center">Apakah anda yakin data ini diaktifkan?</p>
                        </div>
                        <div class="modal-footer justify-content-end">
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



    <!-- Modal Delete -->
    <?php foreach ($data_users as $datusr) : ?>
        <div class="modal fade" id="delete<?= $datusr['id']; ?>">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-pink">
                        <h4 class="modal-title">Delete <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Admin/delete_data_user'); ?>" method="get">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="<?= $datusr['id']; ?>">
                            <p class="text-center">Apakah anda yakin data ini dihapus?</p>
                        </div>
                        <div class="modal-footer justify-content-end">
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
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->