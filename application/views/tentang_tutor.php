<!DOCTYPE html>
<html>
<head>
	<title>Daftar Tutor</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/register/css/register.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/register/font-aw/css/font-awesome.min.css')?>">
	<script type="text/javascript" src="<?=base_url('assets/register/js/jquery-3.3.1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/register/js/scripts.js')?>"></script>
</head>
<body>
	<form class="registration-form" id="container" method="POST" action="<?=base_url('welcome/save-tentang-tutor')?>" enctype="multipart/form-data">
		<fieldset id="tiga">
			<div class="title">
				<h2>Tentang anda</h2>
			</div>
			<div class="form-input">
				<div class="input-cont">
					<label style="display:block !important; margin-bottom: 10px;">Perkenalkan diri anda</label>
					<textarea name="diri" rows="10" style="width:100%"></textarea>
				</div>
				<div class="input-cont">
					<label style="display:block !important; margin-bottom: 10px;">Latar belakang anda</label>
					<textarea name="latar" rows="10" style="width:100%"></textarea>
				</div>
				<div class="input-cont">
					<label style="display:block !important; margin-bottom: 10px;">Bagaimana metode mengajar anda dalam 1 sesi sharing</label>
					<textarea name="metode" rows="10" style="width:100%"></textarea>
				</div>
				<div class="input-cont">
					<input type="text" name="minat" required>
					<label class="label-custom">Minat mengajar anda</label>
				</div>
				<div class="input-cont">
					<div class="text-label" id="foto-custom">
						Sertifikat
					</div>
					<label id="custom-upload" for="sertif" class="custom-file">Upload</label>
					<input id="sertif" type="file" name="sertif[]" accept="image/*" multiple="true">
				</div>
			</div>
			<div class="button-direct">
				<input type="submit" name=""  class="btn-submit" value="SUBMIT">
			</div>
		</fieldset>
	</form>
</body>
</html>