<?php $this->load->view('home/layouts/head-landingpage'); ?>
<div class="loader-bg">
	<div class="loader-p">
		Permata Smart
	</div>
</div>
<main id="main" class="">
	<section id="hero">
		<div class="container pt-3">
			<div class="row align-items-center text-center">
				<div class="col-lg-12 pt-5" data-aos="zoom-in" data-aos-delay="100">
					<h1 class="display-6 fw-bold"> </h1>
					<p class="lead">Solusi menjadi siswa berprestasi bersama permata smart tutoring</p>
					<?php
					if ($this->session->userdata('name') == null) {
					?>
						<div class="d-md-flex justify-content-center mb-4 mb-lg-5">
							<a href="<?= base_url('register/siswa'); ?>" type="button" class="btn btn-primary px-5 rounded-pill me-md-2 fw-bold">Daftar Siswa</a>
							<a href="<?= base_url('register/tutor'); ?>" type="button" class="btn btn-primary px-5 rounded-pill me-md-2 fw-bold">Daftar Tutor</a>
							<!-- <a href="<?= base_url('register/tutor'); ?>" type="button" style="outline: 3px solid #f8f9fa;" class="btn btn-outline-light fw-bold px-5 rounded-pill">Daftar Tutor</a> -->
						</div>
					<?php } ?>
				</div>
				<!-- <div class="cola-lg-12 d-flex justify-content-center">
            <img class="rounded-lg-3 img-hero" src="charisse-kenion-ts-E3IVKv8o-unsplash.jpg" alt="">
          </div>                    -->
			</div>
		</div>
	</section>
	<section id="section-2">
		<div class="container p-5  text-white" data-aos="fade-up">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-6">
					<p class="fs-6 fw-bold text-primary">Kenapa Harus Permata Smart?</p>
					<h1 class="display-6 lh-base fw-bold">
						Belajar seru dan menyenangkan bersama kami, kami menyediakan pilihan paket bimbel yang lengkap <span class="text-primary">Permata Smart</span> memberikan fasilitas belajar terbaik.
					</h1>
				</div>
				<div class="col-lg-6 fs-6 fw-light">
					<p>
						Belajar lebih menyenangkan bareng tutor mahasiswa berprestasi
					</p>
					<p>
						Materi yang didapatkan lengkap dengan latihan soal, pemecahan soal, dan mudah dipahami
					</p>
					<p></p>
				</div>
			</div>
		</div>
	</section>
	<section id="section-3">
		<div class="container p-5" data-aos="fade-up">
			<div class="row justify-content-center align-items center">
				<h1 class="section-title-1">Paket Belajar</h1>
				<div class="col-md-12 d-flex justify-content-center">
				</div>
				<div class="col-lg-4 d-flex justify-content-center my-3   ">
					<div class="card shadow text-center shadow-md rounded rounded-3" style="width:18rem;">
						<img src="<?= base_url('assets/landingpage/img/illustration1.svg'); ?>" class="card-img-top p-3" alt="...">
						<div class="card-body">
							<h6 class="card-subtitle mb-2 fw-bold text-primary">Jenjang SD</h6>
							<h5 class="card-title fs-3 fw-bold">149K<span class="fw-light fs-6">/Bulan</span></h5>
							<p class="card-text">
							<ul class="price-feature mt-4 p-0">
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Materi belajar lengkap</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutor ahli dibidangnya</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutor datang kerumah</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Pertemuan tutoring 4x</p>
									</lnavbari>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutoring selama 2 jam</p>
								</li>
							</ul>
							</p>
							<button type="button" class="btn btn-primary w-100 px-4 rounded-pill">Beli Paket</button>
						</div>
					</div>
				</div>
				<div class="col-lg-4 d-flex justify-content-center my-3   ">
					<div class="card shadow text-center shadow-md rounded rounded-3" style="width:18rem;">
						<img src="<?= base_url('assets/landingpage/img/illustration3.svg'); ?>" class="card-img-top p-3" alt="...">
						<div class="card-body">
							<h6 class="card-subtitle mb-2 fw-bold text-primary">Persiapan UNBK</h6>
							<h5 class="card-title fs-3 fw-bold">399K<span class="fw-light fs-6">/Bulan</span></h5>
							<p class="card-text">
							<ul class="price-feature mt-4 p-0">
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Latihan soal UNBK</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Materi belajar UNBK</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Waktu tutoring 2,5 jam</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutoring 4x pertemuan</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutor datang kerumah</p>
								</li>
							</ul>
							</p>
							<button type="button" class="btn btn-primary w-100 px-4 rounded-pill">Beli Paket</button>
						</div>
					</div>
				</div>
				<div class="col-lg-4 d-flex justify-content-center my-3   ">
					<div class="card shadow text-center shadow-md rounded rounded-3" style="width:18rem;">
						<img src="<?= base_url('assets/landingpage/img/illustration2.svg'); ?>" class="card-img-top p-3" alt="...">
						<div class="card-body">
							<h6 class="card-subtitle mb-2 fw-bold text-primary">Janjang SMP</h6>
							<h5 class="card-title fs-3 fw-bold">239K<span class="fw-light fs-6">/Bulan</span></h5>
							<p class="card-text">
							<ul class="price-feature mt-4 p-0">
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Materi belajar lengkap</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutor ahli dibidangnya</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutor datang kerumah</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutoring 4x pertemuan</p>
								</li>
								<li class="list-feature"><i class="fa fa-check-circle" aria-hidden="true"></i>
									<p class="ms-2 mb-0">Tutoring selama 2 jam</p>
								</li>
							</ul>
							</p>
							<button type="button" class="btn btn-primary w-100 px-4 rounded-pill">Beli Paket</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="section-4">
		<div class="container" data-aos="fade-up">
			<div class="row">
				<h1 class="section-title-1 py-5">Frequently Answered Question</h1>
				<div class="col-lg-12">
					<div class="accordion accordion-flush" id="accordionFlushExample">
						<?php foreach ($faqs as $i => $row) { ?>
							<div class="accordion-item">
								<h2 class="accordion-header" id="flush-heading<?= $i; ?>">
									<button class="accordion-button collapsed shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
										<?= $row->question ?>
									</button>
								</h2>
								<div id="flush-collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
									<div class="accordion-body"><?= $row->answer; ?></div>
								</div>
							</div>
						<?php }; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div id="section-5">
		<div class="testimonial-section">
			<h1 class="section-title-1">Apa Kata Mereka ?</h1>
			<div class="testi-user-img">
				<div class="swiper-container gallery-thumbs" data-aos="fade-up">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img class="u3" src="<?= base_url('assets/landingpage/img/nadia.jpg'); ?>" alt="">
						</div>
						<div class="swiper-slide">
							<img class="u1" src="<?= base_url('assets/landingpage/img/tiwi.jpg'); ?>" alt="">
						</div>
						<div class="swiper-slide">
							<img class="u2" src="<?= base_url('assets/landingpage/img/paril.jpeg'); ?>" alt="">
						</div>

						<div class="swiper-slide">
							<img class="u4" src="<?= base_url('assets/landingpage/img/nina.jpg'); ?>" alt="">
						</div>

					</div>
				</div>
			</div>
			<div class="user-saying">
				<div class="swiper-container testimonial" data-aos="fade-up" data-aos-delay="100">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper ">
						<!-- Slides -->
						<div class="swiper-slide">
							<div class="quote">
								<img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">
								<p>
									“Tutor Permata Smart ngajar udah kayak kakak atau sahabatmu sendiri. Pakai bahasa sehari-hari, jadinya belajar terasa santai banget tapi masih serius materi yang disampaikan“
								</p>
								<div class="name">-Fatimah Anggraini-</div>
								<div class="designation">Kelas 6 SD</div>

							</div>
						</div>
						<div class="swiper-slide">
							<div class="quote">
								<img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">

								<p>
									“Belajar di permata smart ngajarnya mudah dipahami, tutornya menyenangkan serius tapi santai“
								</p>
								<div class="name">-Nadia Yulia-</div>
								<div class="designation">Kelas 2 SD</div>

							</div>
						</div>
						<div class="swiper-slide">
							<div class="quote">
								<img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">

								<p>
									“Belajar bareng tutor di permata smart selalu bikin semangat karna cara ngajarnya yg mudah dipahami“
								</p>
								<div class="name">-Farimatul-</div>
								<div class="designation">Kelas VII SMP</div>

							</div>
						</div>
						<div class="swiper-slide">
							<div class="quote">
								<img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">

								<p>
									“Persiapan UNBK bikin semangat, banyak latihan soal dan pemahaman materi yang gampang dipahami“
								</p>
								<div class="name">-Nina-</div>
								<div class="designation">Kelas IX SMP</div>

							</div>
						</div>

					</div>
					<!-- If we need pagination -->
					<div class="swiper-pagination swiper-pagination-white"></div>

				</div>
			</div>
		</div>
	</div>
	<section id="section-6" class="my-5">
		<div class="container my-5">
			<div class="row" data-aos="fade-up">
				<h1 class="section-title-1">Tutor Permata Smart</h1>
				<div class="col-12">
					<div class="mySwiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide swiper-slide2">
								<img class="" src="siswa\assets\img\trainers\trainer-1.jpg" alt="">
								<h3>Nama Tutor</h3>
								<p class="text-italic">Tutor Matematika</p>
							</div>
							<div class="swiper-slide swiper-slide2">
								<img class="" src="siswa\assets\img\trainers\trainer-1.jpg" alt="">
								<h3>Syafika Wulandari</h3>
								<p class="text-italic">Tutor Bahasa Indonesia</p>
							</div>
							<div class="swiper-slide swiper-slide2 slide-center swiper-slide-active">
								<img class="" src="siswa\assets\img\trainers\trainer-1.jpg" alt="">
								<h3>Ghifari</h3>
								<p class="text-italic">Tutor Bahasa Inggris</p>
							</div>
							<div class="swiper-slide swiper-slide2">
								<img class="" src="siswa\assets\img\trainers\trainer-1.jpg" alt="">
								<h3>Adi Setya</h3>
								<p class="text-italic">Tutor IPA</p>
							</div>
							<div class="swiper-slide swiper-slide2">
								<<img class="" src="siswa\assets\img\trainers\trainer-2.jpg" alt="">
									<h3>Luna Syafillah</h3>
									<p class="text-italic">Tutor IPS</p>
							</div>
						</div>
						<div class="swiper-pagination swiper-pagination-white"></div>
					</div>
				</div>
			</div>
		</div>

	</section>
</main>
<?php $this->load->view('home/layouts/footer-landingpage'); ?>