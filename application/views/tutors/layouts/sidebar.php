<?php
$url1 = $this->uri->segment(1);
$url2 = $this->uri->segment(2);
?>
<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html">Permata Smart</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.html">PS</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Dashboard</li>
			<li class="<?= $url2 == "dashboard" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor') ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
			<li class="menu-header">Master</li>
			<li class="<?= $url2 == "package" || $url2 == "feature" || $url2 == "leason" ? 'active' : '' ?> nav-item dropdown">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i> <span>Data Master</span></a>
				<ul class="dropdown-menu">
					<li class="<?= $url2 == "package" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/package'); ?>">Paket Kelas</a></li>
					<li class="<?= $url2 == "feature" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/feature'); ?>">Fitur Kelas</a></li>
					<li class="<?= $url2 == "leason" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/leason'); ?>">Daftar Kelas</a></li>
				</ul>
			</li>
			<!-- <li class="<?= $url2 == "review" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/review'); ?>"><i class="far fa-file-alt"></i> <span>Review Kelas</span></a></li> -->
			<li class="<?= $url2 == "transaction" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/transaction'); ?>"><i class="fas fa-shopping-cart"></i> <span>Transaksi</span></a></li>
			<li class="<?= $url2 == "faq" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/faq'); ?>"><i class="fas fa-question-circle"></i> <span>FAQ</span></a></li>
			<!-- <li class="menu-header">User</li>
			<li class="nav-item dropdown <?= $url2 == "user" || $url2 == "admin" || $url2 == "tutor" || $url2 == "student" ? 'active' : '' ?>">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data User</span></a>
				<ul class="dropdown-menu"> -->
			<!-- <li class="<?= $url2 == "user" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/user'); ?>">User</a></li> -->
			<!-- <li class="<?= $url2 == "admin" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/admin'); ?>">Admin</a></li>
					<li class="<?= $url2 == "tutor" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/tutor'); ?>">Tutor</a></li> -->
			<!-- <li class="<?= $url2 == "student" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('tutor/student'); ?>">Siswa</a></li> -->
			<!-- </ul>
			</li> -->
			<li class="menu-header">Setting</li>
			<li class="<?= $url2 == "profile" ? 'active' : '' ?>"><a class="nav-link active" href="<?= base_url('tutor/profile'); ?>"><i class="fas fa-user-tag"></i> <span>Profile</span></a></li>
			<li class="<?= $url2 == "change-password" ? 'active' : '' ?>"><a class="nav-link active" href="<?= base_url('tutor/change-password'); ?>"><i class="fas fa-cog"></i> <span>Ubah Password</span></a></li>
	</aside>
</div>