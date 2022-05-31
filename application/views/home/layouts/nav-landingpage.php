<nav class="navbar navbar-expand-lg">
	<div class="container">
		<a class="navbar-brand text-primary" href="<?= base_url(''); ?>">
			<img height="50" src="<?= base_url('assets/icon/liya3.png'); ?>" alt="" srcset="">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<!-- <span class="navbar-toggler-icon"></span> -->
			<i class="fa fa-bars text-white" aria-hidden="true"></i>
		</button>
		<div class="collapse navbar-collapse justify-content-lg-end" id="navbarNavDropdown">
			<ul class="navbar-nav ">
				<li class="nav-item">
					<a class="nav-link text-primary active" aria-current="page" href="<?= base_url('/beranda/'); ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-primary" href="<?= site_url('/beranda/'); ?>">Tentang Kami</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-primary" href="<?= site_url("/beranda/"); ?>">Harga</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-primary" href="<?= site_url('/beranda/'); ?>">FAQ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-primary" href="<?= site_url('/beranda/'); ?>">Testimonial</a>
				</li>
				<!-- <li class="nav-item">
					<a href="<?= base_url('login'); ?>" type="button" class="btn btn-primary ms-lg-5 px-4 rounded-pill">Login</a>
				</li> -->
				<?php
				if ($this->session->userdata('name') == null) {
				?>
					<li class="nav-item">
						<a href="<?= base_url('login'); ?>" type="button" class="btn btn-primary ms-lg-5 px-4 rounded-pill">Login</a>
					</li>
				<?php
				} else {
				?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Hi, <?= $this->session->userdata('name') ? $this->session->userdata('name') : 'Not login Yet'; ?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown" data-bs-popper="none">
							<li><a class="dropdown-item" href="<?= base_url('/lesson'); ?>">Paket Bimbel</a></li>
							<li><a class="dropdown-item" href="<?= base_url('/payment'); ?>">Pembayaran</a></li>
							<li class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="<?= base_url('/logout'); ?>">Logout</a></li>
						</ul>
					</li>
				<?php } ?>

				<!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false"><li></li>
              Dropdown link
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> -->
			</ul>
		</div>
	</div>
</nav>