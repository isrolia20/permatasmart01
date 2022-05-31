<?php $this->load->view('auth/layouts/head-login'); ?>
<div id="app">
	<section class="section">
		<div class="d-flex flex-wrap align-items-stretch">
			<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
				<div class="p-4 m-3">
					<img height="70" class="mb-5" src="<?= base_url('assets/icon/liya3.png'); ?>" alt="" srcset="">
					<h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold">Pertama Smart</span></h4>
					<!-- <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p> -->
					<?php
					$message = $this->session->flashdata('message');
					if (isset($message)) {
						echo '<div class="alert alert-danger">' . $message . '</div>';
						$this->session->unset_userdata('message');
					}

					?>
					<form method="POST" action="<?= base_url('AuthController/auth_user'); ?>" class="needs-validation" novalidate="">
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
							<div class="invalid-feedback">
								Please fill in your email
							</div>
						</div>

						<div class="form-group">
							<div class="d-block">
								<label for="password" class="control-label">Password</label>
								<div class="float-right">
									<a href="auth-forgot-password.html" class="text-small">
										Forgot Password?
									</a>
								</div>
							</div>
							<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
							<div class="invalid-feedback">
								please fill in your password
							</div>
						</div>
						<div class="form-group">
							<label for="email">Masuk Sebagai: </label>
							<select class="form-control" name="role">
								<option selected value="siswa">Siswa</option>
								<option value="tutor">Tutor</option>
							</select>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
								Login
							</button>
						</div>
					</form>
					<div class="text-center mt-5 text-small text-primary">
						Belum punya akun?, <span><a href="<?= base_url(''); ?>" class="fw-bold">Daftar Sekarang</a></span>
					</div>
					<div class="text-center mt-5 text-small">
						Copyright &copy; Your Company. Made with 💙 by Stisla
						<div class="mt-2">
							<a href="#">Privacy Policy</a>
							<div class="bullet"></div>
							<a href="#">Terms of Service</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?= base_url('assets/img/bg-login.jpeg'); ?>" style="background: url('<?= base_url('assets/img/bg-login.jpeg'); ?>');">
				<div class="absolute-bottom-left index-2">
					<div class="text-light p-5 pb-2">
						<div class="mb-5 pb-3">
							<h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
							<h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
						</div>
						Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('auth/layouts/footer-login'); ?>