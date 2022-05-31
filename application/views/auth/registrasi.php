<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 border-bottom-danger shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="col-lg-12 text-center">
                        <p class=""><?= $this->session->flashdata('message') ?></p>
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs ml-5 mr-5 justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#penjual" role="tab" aria-controls="penjual" aria-selected="true">Registrasi Tutor</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#pembeli" role="tab" aria-controls="pembeli" aria-selected="false">Registrasi Siswa</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="penjual" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="p-4">
                                        <form action="<?= base_url('auth/registration'); ?>" method="POST" class="user">
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Nama</div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-user" name="name" id="name" value="<?= set_value('name') ?>">
                                                </div>
                                                <?= form_error('name', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Email</div>
                                                    </div>
                                                    <input type="email" class="form-control form-control-user" name="email" id="email" value="<?= set_value('email') ?>">
                                                </div>
                                                <?= form_error('email', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Password</div>
                                                    </div>
                                                    <input type="password" class="form-control form-control-user" name="password1" id="password1">
                                                </div>
                                                <?= form_error('password1', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Ulangi Password</div>
                                                    </div>
                                                    <input type="password" class="form-control form-control-user" name="password2" id="password2">
                                                </div>
                                                <?= form_error('password2', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Nomer Telpon</div>
                                                    </div>
                                                    <input type="tel" class="form-control form-control-user" name="no_telp" id="no_telp" value="<?= set_value('no_telp') ?>">
                                                </div>
                                                <?= form_error('no_telp', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"><?= set_value('alamat') ?></textarea>
                                                <?= form_error('alamat', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Bagian</div>
                                                    </div>
                                                    <select name="role_id" class="form-control" id="role_id">
                                                        <option value="2">Tutor</option>
                                                    </select>
                                                </div>
                                                <?= form_error('role_id', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">No Rekening</div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-user" name="no_rekening" id="no_rekening" value="<?= set_value('no_rekening') ?>">
                                                </div>
                                                <?= form_error('no_rekening', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Nama Bank</div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-user" name="nama_bank" id="nama_bank" value="<?= set_value('nama_bank') ?>">
                                                </div>
                                                <?= form_error('nama_bank', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-user btn-block">
                                                Daftar
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center pb-4">
                                            <a class="small" href="<?= base_url('auth') ?>">Loginnya Disini!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pembeli" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="p-4">
                                        <form action="<?= base_url('auth/registration'); ?>" method="POST" class="user">
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Nama</div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-user" name="name" id="name" value="<?= set_value('name') ?>">
                                                </div>
                                                <?= form_error('name', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Email</div>
                                                    </div>
                                                    <input type="email" class="form-control form-control-user" name="email" id="email" value="<?= set_value('email') ?>">
                                                </div>
                                                <?= form_error('email', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Password</div>
                                                    </div>
                                                    <input type="password" class="form-control form-control-user" name="password1" id="password1">
                                                </div>
                                                <?= form_error('password1', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Ulangi Password</div>
                                                    </div>
                                                    <input type="password" class="form-control form-control-user" name="password2" id="password2">
                                                </div>
                                                <?= form_error('password2', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Nomer Telpon</div>
                                                    </div>
                                                    <input type="tel" class="form-control form-control-user" name="no_telp" id="no_telp" value="<?= set_value('no_telp') ?>">
                                                </div>
                                                <?= form_error('no_telp', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"><?= set_value('alamat') ?></textarea>
                                                <?= form_error('alamat', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Bagian</div>
                                                    </div>
                                                    <select name="role_id" class="form-control" id="role_id">
                                                        <option value="3">Siswa</option>
                                                    </select>
                                                </div>
                                                <?= form_error('role_id', '<small class="text-danger pb-3">', '</small>'); ?>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-user btn-block">
                                                Daftar
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center pb-4">
                                            <a class="small" href="<?= base_url('auth') ?>">Loginnya Disini!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>