<?php $this->load->view('home/layouts/head-landingpage-2'); ?>
<div class="loader-bg">
	<div class="loader-p">
		Permata Smart
	</div>
</div>
<main id="main" data-aos="fade-in">

	<!-- ======= Breadcrumbs ======= -->
	<div class="breadcrumbs">
		<div class="container">
			<h2>Paket Bimbel</h2>
			<p>Paket Belajar di Permata Smart. Langganan Kelas Kamu Sekarang! </p>
		</div>
	</div><!-- End Breadcrumbs -->
	<!-- ======= Courses Section ======= -->
	<section id="courses" class="courses text-dark">
		<div class="container" data-aos="fade-up">
			<div class="row align-items-end" data-aos="zoom-in" data-aos-delay="100">
				<?php foreach ($data as $row) : ?>
					<?php if ($row->level == $this->session->userdata('level')) : ?>
						<div class="col-lg-4 col-md-6 my-4 d-flex align-items-stretch">
							<div class="course-item" style="min-width: 356px;">
								<img src="assets/img/course-1.jpg" class="img-fluid" alt="">
								<div class="course-content">
									<div class="d-flex justify-content-between align-items-center mb-3">
										<h4 class="text-uppercase"><?= $row->level; ?></h4>
										<p class="price"><?= $row->price; ?></p>
									</div>

									<h3><?= $row->package; ?></h3>
									<p><?= $row->description; ?></p>
									<p>Hari&nbsp;:&nbsp;<?= $row->lsname; ?></p>
									<p>Pukul&nbsp;:&nbsp;<?= $row->lspukul; ?></p>
									<p>Kelas&nbsp;:&nbsp;<?= $row->fskelas; ?></p>
									<!-- <span><?= $row->schedule; ?></span> -->
									<div class="trainer d-flex justify-content-between align-items-center">
										<div class="trainer-profile d-flex align-items-center">
											<img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
											<!-- <span>Antonio</span> -->
										</div>
										<div class="trainer-rank d-flex align-items-center">
											<?php
											if ($this->session->userdata('name') == null) {
											?>
												<a href="login" class="btn btn-outline-primary">Ambil Kelas</a>
											<?php } else { ?>
												<a href="form" class="btn btn-outline-primary">Ambil Kelas</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- End Course Item-->
					<?php endif; ?>
				<?php endforeach; ?>


			</div>

		</div>
	</section><!-- End Courses Section -->

</main>
<?php $this->load->view('home/layouts/footer-landingpage'); ?>