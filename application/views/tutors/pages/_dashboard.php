<section class="section">
	<div class="section-header"><a href="http://simrsapp.id/gallery">
			<h1>Dashboard</h1>
		</a></div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="<?= base_url('assets/img/tutor/') . $user['avatar']; ?>" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Selamat datang</h5>
						<p class="card-text"><?= $this->session->userdata('name') ?></p>
						<!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>