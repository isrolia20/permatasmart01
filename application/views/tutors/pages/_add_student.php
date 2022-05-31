<section class="section">
	<div class="section-header"><a href="/">
			<h1>Siswa</h1>
		</a></div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Tambah Siswa</h4>
					</div>
					<form method="POST" id="form" action="<?= base_url('StudentController/save_student'); ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">
						<div class="card-body">
							<!--v-if-->
							<div class="form-group">
								<label for="email">Email</label>
								<input id="email" type="email" class="form-control" name="email">
								<div class="invalid-feedback">
								</div>
							</div>

							<div class="row">
								<div class="form-group col-6">
									<label for="password" class="d-block">Password</label>
									<input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
									<div id="pwindicator" class="pwindicator">
										<div class="bar"></div>
										<div class="label"></div>
									</div>
								</div>
								<div class="form-group col-6">
									<label for="password2" class="d-block">Password Confirmation</label>
									<input id="password2" type="password" class="form-control" name="password-confirm">
								</div>
							</div>

							<div class="form-divider">
								Data Diri
							</div>

							<div class="form-group">
								<label for="name">Nama Lengkap</label>
								<input id="name" type="text" class="form-control" name="name" autofocus>
							</div>


							<div class="form-group">
								<label for="address">Alamat</label>
								<input id="address" type="text" class="form-control" name="address" autofocus>
							</div>

							<div class="row">

								<div class="form-group col-6">
									<label>Jenis Kelamin</label>
									<select class="form-control selectric" name="sex">
										<option value="laki-laki">Laki-Laki</option>
										<option value="perempuan">Perempuan</option>
									</select>
								</div>


								<div class="form-group col-6">
									<label for="phone_number">Nomor Telepon</label>
									<input id="phone_number" type="text" class="form-control" name="phone_number" autofocus>
								</div>
							</div>


							<div class="row">
								<div class="form-group col-6">
									<label for="parent">Nama Orangtua</label>
									<input id="parent" type="text" class="form-control" name="parent" autofocus>
								</div>

								<div class="form-group col-6">
									<label for="phone_number_parent">Nomor Orangtua</label>
									<input id="phone_number_parent" type="text" class="form-control" name="phone_number_parent" autofocus>
								</div>
							</div>



							<div class="form-group">
								<label for="bio">Bio</label>
								<input id="bio" type="text" class="form-control" name="bio" autofocus>
							</div>


							<div class="form-group">
								<label for="school">Nama Sekolah</label>
								<input id="school" type="text" class="form-control" name="school" autofocus>
							</div>

							<div class="row">
								<div class="form-group col-6">
									<label>Tingkatan</label>
									<select class="form-control selectric" name="level">
										<option value="sd">SD</option>
										<option value="smp">SMP</option>
										<option value="sma">SMA</option>
									</select>
								</div>


								<div class="form-group col-6">
									<label for="class">Kelas</label>
									<input id="class" type="text" class="form-control" name="class" autofocus>
								</div>
							</div>

							<div class="form-group" id="avatar-preview">
								<label for="">Avatar</label>
								<div></div>
								<input name="avatar" type="file" class="hiddenfile" />
								<button type="button" onclick="uploadImage()" id="label-avatar" class="btn btn-outline-primary">Upload Avatars</button>
								<span class="help-block text-danger text-capitalize"></span>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Susbmit</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function() {
		$('input[type="file"]').change(function(e) {
			let reader = new FileReader();
			reader.readAsDataURL(e.target.files[0]);
			reader.onload = (e) => {
				imageSrc = e.target.result;
				$('#label-avatar').text('Change Avatar'); // label avatar upload
				$('#avatar-preview div').html('<img src="' + imageSrc + '" class="img-responsive mb-3" style="width: 200px">'); // show photo					

			};
		});

	});

	function uploadImage() {
		$('input[type="file"]').trigger('click');
	}
</script>
