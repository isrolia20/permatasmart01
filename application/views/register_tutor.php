<!DOCTYPE html>
<html>

<head>
	<title>Daftar Tutor</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/register/css/register.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/register/font-aw/css/font-awesome.min.css') ?>">
	<script type="text/javascript" src="<?= base_url('assets/register/js/jquery-3.3.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/register/js/scripts.js') ?>"></script>
</head>

<body>
	<form class="registration-form" id="container" method="POST" action="<?= base_url('welcome/save-tutor') ?>" enctype="multipart/form-data">
		<ul id="progress-bar">
			<li class="active"><i class="fa fa-key fa-2x"></i></li>
			<li><i class="fa fa-user-circle fa-2x"></i></li>
		</ul>
		<fieldset id="satu">
			<div class="title">
				<h2>Input Biodata Anda</h2>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<div class="text-label" id="foto-custom">
						Foto Profile
					</div>
					<label id="custom-upload" for="pic" class="custom-file">Upload</label>
					<input id="pic" type="file" name="foto_profil">
				</div>
				<div class="input-cont">
					<input type="text" name="nama" required>
					<label class="label-custom">Nama Lengkap</label>
				</div>
				<div class="input-cont">
					<input type="text" name="tempat" required>
					<label class="label-custom">Tempat lahir</label>
				</div>
				<div class="input-cont">
					<input type="date" name="tgl_lahir" required>
					<label class="label-custom">Tanggal lahir</label>
				</div>
				<div class="input-cont">
					<div class="text-label">
						Pendidikan Terakhir
					</div>
					<select name="pendidikan">
						<option value="D3">D3</option>
						<option value="D4">D4</option>
						<option value="S1">S1</option>
						<option value="S2">S2</option>
					</select>
					<div class="input-cont">
						<div class="text-label">
							Pendidikan Terakhir
						</div>
						<select name="pendidikan_sekarang">
							<option value="D3">D3</option>
							<option value="D4">D4</option>
							<option value="S1">S1</option>
							<option value="S2">S2</option>
						</select>
						<div class="input-cont">
							<input type="text" name="ipk" required>
							<label class="label-custom">IPK terakhir</label>
						</div>
						<div class="input-cont">
							<input type="email" name="email" required>
							<label class="label-custom">Email</label>
						</div>
						<div class="input-cont">
							<input type="password" name="pass" required>
							<label class="label-custom">Password</label>
						</div>
					</div>
					<div class="button-direct">
						<input type="button" name="" class="btn-next" value="NEXT">
					</div>
		</fieldset>

		<fieldset id="dua">
			<div class="title">
				<h2>Input Biodata Anda</h2>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<input type="text" name="no" required>
					<label class="label-custom">No Telepon</label>
				</div>
				<div class="input-cont">
					<input type="text" name="prov" required>
					<label class="label-custom">Provinsi</label>
				</div>
				<div class="input-cont">
					<input type="text" name="kab" required>
					<label class="label-custom">Kabupaten</label>
				</div>
				<div class="input-cont">
					<input type="text" name="alamat" required>
					<label class="label-custom">Alamat</label>
				</div>
				<div class="input-cont">
					<input type="date" name="tgl_tes" required>
					<label class="label-custom">Tanggal tes</label>
				</div>
				<div class="input-cont">
					<input type="time" name="jam_tes" required>
					<label class="label-custom">Jam tes</label>
				</div>
				<div class="button-direct">
					<input type="button" name="" class="previous" value="PREVIOUS">
					<input type="submit" name="" class="btn-submit" value="SUBMIT">
				</div>
		</fieldset>
	</form>
</body>

</html>