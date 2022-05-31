<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('landing_page/head-login'); ?>
</head>

<body class="bg-gradient-primary">

	<div class="container" style="margin-top: 120px;">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">

				<div class="px-5">
					<?php if ($this->session->flashdata('message')) $this->load->view('partials/toast') ?>
				</div>
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4 text-white">Permata Smart!</h1>
									</div>
									<form class="user" method="POST" action="welcome/login">
										<div class="form-group">
											<input type="email" class="form-control form-control-user" name="email" placeholder="Enter Email Address...">
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" name="password" placeholder="Password">
										</div>
										<div class="form-group">
											<select class="form-control" name="role">
												<option value="tutor">Tutor</option>
												<option value="siswa">Siswa</option>
											</select>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">
											Login
										</button>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="<?= base_url('register/tutor') ?>">Daftar siswa</a>
									</div>
									<div class="text-center">
										<a class="small" href="<?= base_url('register/siswa') ?>">Daftar tutor</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

</body>

</html>
