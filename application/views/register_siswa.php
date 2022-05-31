<!DOCTYPE html>
<html>

<head>
	<title>Daftar Siswa</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/register/css/register.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/register/font-aw/css/font-awesome.min.css') ?>">
	<script type="text/javascript" src="<?= base_url('assets/register/js/jquery-3.3.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/register/js/scripts.js') ?>"></script>
</head>

<body>
	<form class="registration-form" id="container" method="POST" action="<?= base_url('welcome/save-siswa') ?>">
		<ul id="progress-bar">
			<li class="active"><i class="fa fa-key fa-2x"></i></li>
			<li><i class="fa fa-user-circle fa-2x"></i></li>
		</ul>
		<fieldset id="satu">
			<div class="title">
				<h2>Siswa</h2>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<input type="text" name="nama" required>
					<label class="label-custom">Nama lengkap</label>
				</div>
				<div class="input-cont">
					<div class="text-label">
						Jenis Kelamin
					</div>
					<select name="jk">
						<option value="laki-laki">Laki Laki</option>
						<option value="perempuan">Perempuan</option>
					</select>
				</div>
				<div class="input-cont">
					<input type="text" name="tempat" required>
					<label class="label-custom">Tempat Lahir</label>
				</div>
				<div class="input-cont">
					<input type="date" name="tgl" required>
					<label class="label-custom">Tanggal Lahir</label>
				</div>
				<div class="input-cont">
					<input type="email" name="email" required>
					<label class="label-custom">E-mail</label>
				</div>
				<div class="input-cont">
					<input type="password" name="pass" required>
					<label class="label-custom">Kata Sandi</label>
				</div>
				<div class="input-cont">
					<div class="text-label">
						Jenjang Sekolah
					</div>
					<select name="jk">
						<option value="sd">SD</option>
						<option value="smp">SMP</option>
					</select>
					<div class="input-cont">
						<input type="text" name="kls" required>
						<label class="label-custom">Kelas</label>
					</div>
					<div class="input-cont">
						<input type="text" name="sekolah" required>
						<label class="label-custom">Sekolah</label>
					</div>
					<div class="input-cont">
						<input type="text" name="no" required>
						<label class="label-custom">Nomor Telepon</label>
					</div>
				</div>
				<div class="button-direct">
					<input type="button" name="" class="btn-next" value="NEXT">
				</div>
		</fieldset>

		<fieldset id="dua">
			<div class="title">
				<h2>Orang tua</h2>
			</div>
			<div class="input-cont">
				<div class="text-label">
					Hubungan Keluarga
				</div>
				<select name="jk">
					<option value="anak">Anak Kandung</option>
					<option value="keluarga">Keluarga</option>
				</select>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<input type="text" name="ayah" required>
					<label class="label-custom">Nama Ayah</label>
				</div>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<input type="text" name="ibu" required>
					<label class="label-custom">Nama Ibu</label>
				</div>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<input type="text" name="telpon_ortu" required>
					<label class="label-custom">No telepon</label>
				</div>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<input type="text" name="kerja" required>
					<label class="label-custom">Pekerjaan</label>
				</div>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<input type="text" name="alamat" required>
					<label class="label-custom">Alamat lengkap</label>
				</div>
			</div>
			<div class="button-direct">
				<input type="button" name="" class="previous" value="PREVIOUS">
				<input type="submit" name="" class="submit" value="SUBMIT">
			</div>
		</fieldset>
	</form>
</body>

</html>