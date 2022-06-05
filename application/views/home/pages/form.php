<?php $this->load->view('home/layouts/head-landingpage-2'); ?>
<div class="loader-bg">
	<div class="loader-p">
		Permata Smart
	</div>
</div>
<main id="main" data-aos="fade-in">

	<!-- ======= Breadcrumbs ======= -->
	<div class="breadcrumbs">
		<div class="container">
			<h2>Pembayaran</h2>
			<p>Silahkan lakkan pembayaran disini agar dapat bertemu tutor Kesayangan Kamu disini. </p>
		</div>
	</div><!-- End Breadcrumbs -->


	<!-- ======= Contact Section ======= -->
	<section id="contact" style="color: black;">
		<div class="container" data-aos="fade-up">

			<div class="row mt-5 justify-content-center">

				<div class="col-lg-8 mt-5 mt-lg-0">

					<form id="my-form" action="<?= base_url('TransactionController/add_transaction'); ?>" method="POST">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="">Nama Lengkap</label>
								<input type="text" name="name" class="form-control" id="name" value="<?= $this->session->userdata("name"); ?>">
							</div>
							<div class="col-md-6 form-group mt-3 mt-md-0">
								<label for="">Alamat Lengkap</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="" required>
							</div>
						</div>
						<div class="form-group mt-3">
							<label for="">Kelas</label>
							<select name="package_id" id="package_id" class="form-control" style="font-size: 1.3rem;">
								<option value="" selected>Pilih Kelas</option>
								<?php foreach ($class as $row) :
								?>
									<?php if ($row->level == $this->session->userdata('level')) : ?>
										<option data-price="<?= $row->price; ?>" value="<?= $row->id; ?>"><?= $row->name; ?> ----- <?= $row->price; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="mt-5 text-end">
							<p>Harga Kelas: <span id="price"></span></p>
						</div>
						<!-- <div class="my-3">
							<div class="loading">Loading</div>
							<div class="error-message"></div>
							<div class="sent-message">Your message has been sent. Thank you!</div>
						</div> -->

						<div class="text-center"><button type="button" class="btn btn-primary" onclick="submitForm()">Daftar Kelas</button></div>
					</form>

				</div>

			</div>

		</div>
	</section><!-- End Contact Section -->

</main>
<?php $this->load->view('home/layouts/footer-landingpage'); ?>
<script>
	$(document).ready(function() {})


	$('#package_id').change(function() {
		let price = $(this).find(':selected').attr('data-price');
		$('#price').html(price);
	});

	function submitForm() {
		let classVal = $('#package_id').val();
		if (classVal == '') {
			swal({
				title: 'Konfirmasi',
				text: 'Harap memilih kelas terlebih dahulu',
			});
			return;
		}
		swal({
			title: 'Konfirmasi',
			text: 'Apakah anda yakin akan mengambil kelas ini?',
			icon: 'warning',
			buttons: ['Batal', "OK"],
			dangerMode: true,
		}).then((result) => {
			if (result) {
				// $.ajax({
				// 	url: "<?= base_url('TransactionController/add_transaction'); ?>",
				// 	type: "POST",
				// 	data: $('#my-form').serialize(),
				// 	dataType: "JSON",
				// 	success: function(data) {
				// 	}
				// });
				$('#my-form').submit();

			} else {
				swal({
					title: 'Dibatalkan',
					icon: 'success',
					type: 'success'
				})
			}
		});


	}
</script>