<?php $this->load->view('auth/layouts/head-login'); ?>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <!-- <img src="<?= base_url('assets/assets/img/stisla-fill.svg'); ?>" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                        <h3>Permata Smart</h3>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Lupa Password</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Kami akan mengirimkan link Reset Password ke E-Mail anda</p>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; Permata Smart <?= date('Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('auth/layouts/footer-login'); ?>