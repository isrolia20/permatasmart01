<section class="section">
	<div class="section-header">
		<h1>Profile Admin</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
			<div class="breadcrumb-item">Profile</div>
		</div>
	</div>
	<div class="section-body">
		<h2 class="section-title">Hi, <?= $this->session->userdata('nama') ? $this->session->userdata('nama') : 'Default'; ?></h2>
		<p class="section-lead">
			Change information about yourself on this page.
		</p>

		<div class="row mt-sm-4">
			<div class="col-12 col-md-12 col-lg-5">
				<div class="card profile-widget">
					<div class="profile-widget-header">
						<img alt="image" src="<?= base_url() . '/upload/img/admin/' . $data->avatar; ?>" class="profile-widget-picture">
					</div>
					<div class="profile-widget-description">
						<div class="profile-widget-name"><?= $this->session->userdata('nama') ? $this->session->userdata('nama') : 'Default'; ?> <div class="text-muted d-inline font-weight-normal">
								<div class="slash"></div> <?= $this->session->userdata('nama') ? $this->session->userdata('role') : 'Default'; ?>
							</div>
						</div>
						Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
					</div>
					<div class="card-footer text-center">
						<div class="font-weight-bold mb-2">Follow Ujang On</div>
						<a href="#" class="btn btn-social-icon btn-facebook mr-1">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="btn btn-social-icon btn-twitter mr-1">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="btn btn-social-icon btn-github mr-1">
							<i class="fab fa-github"></i>
						</a>
						<a href="#" class="btn btn-social-icon btn-instagram">
							<i class="fab fa-instagram"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-12 col-lg-7">
				<div class="card">
					<form method="post" class="needs-validation" novalidate="">
						<div class="card-header">
							<h4>Edit Profile</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="form-group" class="col-md-12 col-12" id="avatar-preview">
									<label for="">Avatar</label>
									<div>
										<img src="<?= $data->email ? base_url() . '/upload/img/admin/' . $data->avatar : ''; ?> " class="img-responsive mb-3 img-preview" style="width: 100px">
									</div>
									<input name="avatar" type="file" class="hiddenfile" />
									<button type="button" onclick="uploadImage()" id="label-avatar" class="btn btn-primary">Upload Avatars</but>
										<span class="help-block text-danger text-capitalize"></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12 col-12">
									<label>First Name</label>
									<input type="text" class="form-control" name="name" value="<?= $data->name ? $data->name : 'Default'; ?>" required="">
									<div class="invalid-feedback">
										Please fill in the first name
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-7 col-12">
									<label>Email</label>
									<input type="email" class="form-control" name="email" value="<?= $data->email ? $data->email : 'Default'; ?>" required="">
									<div class="invalid-feedback">
										Please fill in the email
									</div>
								</div>
								<div class="form-group col-md-5 col-12">
									<label>Phone</label>
									<input type="tel" class="form-control" value="<?= $data->phone_number ? $data->phone_number : '+621111111111111'; ?>">
								</div>
							</div>
						</div>
						<div class="card-footer text-right">
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function() {


	})
	$('input[type="file"]').change(function(e) {
		let reader = new FileReader();
		reader.readAsDataURL(e.target.files[0]);
		reader.onload = (e) => {
			imageSrc = e.target.result;
			$('#label-avatar').text('Change Avatar'); // label avatar upload
			$('#avatar-preview div').html('<img src="' + imageSrc + '" class="img-responsive mb-3" style="width: 100px">'); // show photo					

		};
	});

	function uploadImage() {
		$('input[type="file"]').trigger('click');
	}
</script>
