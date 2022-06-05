<section class="section">
	<div class="section-header"><a href="/">
			<h1>Jadwal</h1>
		</a></div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Table Jadwal</h4>
						<div class="card-header-action">
							<button class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Data</button>
						</div>
						<?= $this->session->flashdata('message') ?>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Paket</th>
										<th scope="col">Hari</th>
										<th scope="col">Waktu</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody class="table-content">
									<?php
									$no = 1;
									foreach ($data_jadwal as $dtj) : ?>
										<tr>
											<td>
												<?= $no++; ?>
											</td>
											<td>
												<?= $dtj['package_id'] ?>
											</td>
											<td>
												<?= $dtj['name'] ?>
											</td>
											<td>
												<?= $dtj['pukul'] ?>
											</td>
											<td>
												<a href="#edit<?= str_replace(" ", "_", strtolower($dtj['id'])); ?>" class="btn btn-primary btn-class" data-toggle="modal">
													<i class="fas fa-edit"></i>
												</a>
												<a href="#delete<?= str_replace(" ", "_", strtolower($dtj['id'])); ?>" class="btn btn-danger btn-class" data-toggle="modal">
													<i class="fa fa-trash"></i>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>





<!-- Tambah Paket -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Modal Jadwal</h3>
			</div>
			<form method="POST" action="<?= base_url('LeasonController/add'); ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Hari</label>
						<input type="text" class="form-control" id="name" name="name">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Pukul Mulai</label>
						<input type="time" class="form-control" id="pukul_mulai" name="pukul_mulai">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Pukul Selesai</label>
						<input type="time" class="form-control" id="pukul_selesai" name="pukul_selesai">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Paket</label>
						<select name="package_id" id="package_id" class="form-control">
							<?php foreach ($data_leasonpaket as $dlp) : ?>
								<option value="<?= $dlp['id'] ?>"><?= $dlp['name'] ?></option>
							<?php endforeach; ?>
						</select>
						<span class="help-block text-danger text-capitalize"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Tambah Paket -->




<!-- Edit Paket -->
<?php
foreach ($data_jadwal as $dtj) : ?>
	<div class="modal fade" id="edit<?= str_replace(" ", "_", strtolower($dtj['id'])); ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit Jadwal</h3>
				</div>
				<form method="POST" action="<?= base_url('LeasonController/update'); ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Hari</label>
							<input type="text" class="form-control" value="<?= $dtj['name']; ?>" name="name">
							<input type="hidden" value="<?= $dtj['id']; ?>" name="id" id="id">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Pukul Mulai</label>
							<input type="time" class="form-control" value="<?php
																			$pukul = explode(" - ", $dtj['pukul']);
																			echo $pukul[0];
																			?>" name="pukul_mulai">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Pukul Selesai</label>
							<input type="time" class="form-control" value="<?php
																			$pukul = explode(" - ", $dtj['pukul']);
																			echo $pukul[1];
																			?>" name="pukul_selesai">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Paket</label>
							<select name="package_id" id="package_id" class="form-control">
								<option value="<?= $dtj['package_id'] ?>"><?= $dtj['package_id'] ?></option>
								<?php foreach ($data_leasonpaket as $dlp) : ?>
									<option value="<?= $dlp['id'] ?>"><?= $dlp['name'] ?></option>
								<?php endforeach; ?>
							</select>
							<span class="help-block text-danger text-capitalize"></span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- End Edit Paket -->





<!-- Delete Paket -->
<?php
foreach ($data_jadwal as $dtj) : ?>
	<div class="modal fade" id="delete<?= str_replace(" ", "_", strtolower($dtj['id'])); ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Delete <?= $title; ?></h3>
				</div>
				<form method="POST" action="<?= base_url('LeasonController/delete'); ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<h4 class="text-center text-primary">
								Apakah anda yakin ingin menghapus data ini ?
							</h4>
							<input type="hidden" class="form-control" value="<?= $dtj['id'] ?>" name="id">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Ya</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- End Delete Paket -->





<!-- <div class="modal fade" id="modalForm" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Modal title</h3>
			</div>
			<div class="modal-body">
				<form action="#" id="form">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control" id="name" name="name">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Paket</label>
						<select name="package_id" id="package_id" class="form-control">

						</select>
						<span class="help-block text-danger text-capitalize"></span>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_save" onclick="save()" class="btn btn-primary">Submit</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div> -->


<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable').DataTable({
			dom: 'lfrtip',
			autoWidth: true,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			buttons: [{
					className: 'btn-danger btn-round btn-sm mr-2',
					extend: 'pdfHtml5',
					text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
					exportOptions: {
						columns: [0, 1, 2, 4, 5, 6, 7, 8, 9],
					},
					title: 'Data User'
				},
				{
					className: 'btn-success btn-round btn-sm mr-2',
					extend: 'excelHtml5',
					text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
					},
					title: 'Data User'
				}
			],
			select: {
				style: "multi"
			}
		});
	});

	// var save_method;
	// var table;
	// var url_id;
	// $(document).ready(function() {

	// 	//datatables
	// 	table = $('#myTable').DataTable({

	// 		"pageLength": 20,
	// 		"processing": true,
	// 		"serverSide": true,
	// 		"order": [],

	// 		"ajax": {
	// 			"url": "<?php echo site_url('LeasonController/get_data_user') ?>",
	// 			"type": "POST",
	// 		},


	// 		"columnDefs": [{
	// 			"targets": [0],
	// 			"orderable": false,
	// 		}, ],


	// 	});

	// 	packageDropdown();


	// 	$("input").change(function() {
	// 		$(this).parent().parent().removeClass('has-error');
	// 		$(this).next().empty();
	// 	});
	// 	$("textarea").change(function() {
	// 		$(this).parent().parent().removeClass('has-error');
	// 		$(this).next().empty();
	// 	});
	// 	$("select").change(function() {
	// 		$(this).parent().parent().removeClass('has-error');
	// 		$(this).next().empty();
	// 	});

	// });




	// function packageDropdown() {
	// 	$.ajax({
	// 		url: "<?= base_url('LeasonController/get_data_package'); ?>",
	// 		type: 'GET',
	// 		dataType: 'JSON',
	// 		success: function(data) {
	// 			let html = '';
	// 			data.forEach(function(item) {
	// 				html += `
	// 			<option value="${item.id}">${item.name}</option>
	// 			`

	// 			});
	// 			$('#package_id').html(html);
	// 		}
	// 	});
	// }

	// function reload_table() {
	// 	table.ajax.reload(null, false); //reload datatable ajax
	// };


	// function updateList(id) {
	// 	save_method = 'update';
	// 	url_id = id;
	// 	$('.form-group').removeClass('has-error'); // clear error class
	// 	$('.help-block').empty(); // clear error string
	// 	$.ajax({
	// 		url: "<?= base_url('LeasonController/get_id/'); ?>" + id,
	// 		type: 'GET',
	// 		dataType: 'JSON',
	// 		success: function(data) {
	// 			$('[name="name"]').val(data.name);
	// 			$('[name="price"]').val(data.price);
	// 			$('[name="description"]').val(data.description);
	// 			$('[name="duration"]').val(data.duration);
	// 			$('[name="level"]').val(data.level);
	// 			$('#modalForm').modal('show');
	// 			$('.modal-title').text('Update Data');
	// 			reload_table();
	// 		}
	// 	});
	// }


	// function add() {
	// 	save_method = 'add';
	// 	$('[name="id"]').prop("disabled", false);
	// 	$('#form')[0].reset();
	// 	$('.form-group').removeClass('has-error');
	// 	$('.help-block').empty();
	// 	$('#modalForm').modal('show');
	// 	$('.modal-title').text('Tambah Data');
	// }


	// function save() {
	// 	$('#btnSave').text('saving...'); //change button text
	// 	$('#btnSave').attr('disabled', true);
	// 	var url;

	// 	if (save_method == 'add') {
	// 		url = "<?php echo site_url('LeasonController/add'); ?>";
	// 	} else {
	// 		url = "<?php echo site_url('LeasonController/update/'); ?>" + url_id;
	// 	}
	// 	// ajax adding data to database
	// 	$.ajax({
	// 		url: url,
	// 		type: "POST",
	// 		data: $('#form').serialize(),
	// 		dataType: "JSON",
	// 		success: function(data) {
	// 			if (data.status) //if success close modal and reload ajax table
	// 			{
	// 				$('#modalForm').modal('hide');
	// 				reload_table();
	// 			} else {
	// 				for (var i = 0; i < data.inputerror.length; i++) {
	// 					$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	// 					$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
	// 				}
	// 			}

	// 			$('#btnSave').text('save'); //change button text
	// 			$('#btnSave').attr('disabled', false); //set button enable


	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown) {
	// 			alert('Error adding / update data');
	// 			$('#btnSave').text('save'); //change button text
	// 			$('#btnSave').attr('disabled', false); //set button enable

	// 		}
	// 	});
	// }

	// function deleteList(id) {
	// 	swal({
	// 		title: 'Konfirmasi',
	// 		text: 'Apakah anda yakin akan menghapus data ini?',
	// 		icon: 'warning',
	// 		buttons: ['Batal', "OK"],
	// 		dangerMode: true,
	// 	}).then((result) => {
	// 		if (result) {
	// 			$.ajax({
	// 				url: "<?= base_url('LeasonController/delete/'); ?>" + id,
	// 				type: "POST",
	// 				dataType: "JSON",
	// 				success: function(data) {
	// 					reload_table();
	// 				}

	// 			});
	// 		} else {
	// 			swal({
	// 				title: 'Dibatalkan',
	// 				icon: 'success',
	// 				type: 'success'
	// 			})
	// 		}
	// 	});


	// }
</script>