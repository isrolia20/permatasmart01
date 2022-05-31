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

	<section class="section text-dark">
		<div class="container" data-aos="fade-up">
			<div class="row">
				<div class="col-12">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Kelas</th>
								<th>Jadwal</th>
								<th>Durasi</th>
								<th>Status</th>
								<!-- <th>Bayaran</th> -->
								<th>Harga</th>
								<th>Bukti Pembayaran</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($data as $row) { ?>
								<tr>
									<td scope="row"><?= $no++ ?></td>
									<td><?= $row->package_name; ?></td>
									<td><?= $row->schedule; ?></td>
									<td><?= $row->duration; ?></td>
									<td><?= $row->status; ?></td>
									<!-- <td><?= $row->total; ?></td> -->
									<td><?= $row->total; ?></td>
									<td>
										<?php
										if ($row->receipt) {
											echo '<a target="_blank"><img width="100" height="100" src="' . base_url('/upload/img/receipt/') . $row->receipt . '" alt="" srcset=""></a>';
										} else {
											echo "Belum Upload Bukti Pembayaran";
										}
										?>
									</td>
									<td>
										<button onclick="uploadReceipt(<?= $row->transaction_id; ?>)" class="btn btn-primary">Upload Bukti Pembayaran</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	</div>
	<?php $this->load->view('home/layouts/footer-landingpage'); ?>
	<div class="modal fade text-dark" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Upload Bukti Pembayaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="LandingController/uploadReceipt" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label for="upload">Bukti Pembayaran</label>
							<input type="file" class="receipt" name="receipt" class="form-control">
							<input type="hidden" name="transaction_id" id="transaction_id">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<script>
		function uploadReceipt(id) {
			$('#transaction_id').val(id);
			$('#modalUpload').modal('show');
		}
	</script>