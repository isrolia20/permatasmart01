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
			<li class="<?= $url2 == "dashboard" ? 'active' : '' ?>"><a class="nav-link" href="#"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
			<li class="menu-header">Master</li>
			<li class="<?= $url2 == "package" || $url2 == "feature" || $url2 == "leason" ? 'active' : '' ?> nav-item dropdown">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i> <span>Data Master</span></a>
				<ul class="dropdown-menu">
					<li class="<?= $url2 == "package" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/package'); ?>">Paket Kelas</a></li>
					<li class="<?= $url2 == "feature" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/feature'); ?>">Daftar Kelas</a></li>
					<li class="<?= $url2 == "leason" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/leason'); ?>">Jadwal Kelas</a></li>
				</ul>
			</li>
			<!-- <li class="<?= $url2 == "review" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/review'); ?>"><i class="far fa-file-alt"></i> <span>Review Kelas</span></a></li> -->
			<li class="<?= $url2 == "transaction" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/transaction'); ?>"><i class="fas fa-shopping-cart"></i> <span>Transaksi</span></a></li>
			<li class="<?= $url2 == "faq" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/faq'); ?>"><i class="fas fa-question-circle"></i> <span>FAQ</span></a></li>
			<li class="menu-header">User</li>
			<li class="nav-item dropdown <?= $url2 == "user" || $url2 == "admin" || $url2 == "tutor" || $url2 == "student" ? 'active' : '' ?>">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data User</span></a>
				<ul class="dropdown-menu">
					<li class="<?= $url2 == "user" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/user'); ?>">User</a></li>
					<li class="<?= $url2 == "admin" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/admin'); ?>">Admin</a></li>
					<li class="<?= $url2 == "tutor" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/tutor'); ?>">Tutor</a></li>
					<li class="<?= $url2 == "student" ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/student'); ?>">Siswa</a></li>
				</ul>
			</li>
			<li class="menu-header">Setting</li>
			<li class="<?= $url2 == "profile" ? 'active' : '' ?>"><a class="nav-link active" href="<?= base_url('admin/profile'); ?>"><i class="fas fa-user-tag"></i> <span>Profile</span></a></li>
			<li class="<?= $url2 == "change-password" ? 'active' : '' ?>"><a class="nav-link active" href="<?= base_url('admin/change-password'); ?>"><i class="fas fa-cog"></i> <span>Ubah Password</span></a></li>
	</aside>
</div>