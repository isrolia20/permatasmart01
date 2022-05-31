<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 border-bottom-warning shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <p class=""><?= $this->session->flashdata('message') ?></p>
                        </div>
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                                </div>
                                <form action="<?= base_url('auth'); ?>" method="POST" class="user">
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Email</div>
                                            </div>
                                            <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Masukkan Email">
                                        </div>
                                        <?= form_error('email', '<small class="text-danger pb-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Password</div>
                                            </div>
                                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Masukkan Password">
                                        </div>
                                        <?= form_error('password', '<small class="text-danger pb-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/forgot_password') ?>">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registration') ?>">Buat Akun disini!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>