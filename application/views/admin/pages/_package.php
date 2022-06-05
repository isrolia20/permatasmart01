<section class="section">
	<div class="section-header"><a href="/">
			<h1>Paket</h1>
		</a></div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Table Paket</h4>
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
										<th scope="col">#</th>
										<th scope="col">Nama</th>
										<th scope="col">Harga</th>
										<th scope="col">Deskripsi</th>
										<th scope="col">Durasi</th>
										<th scope="col">Level</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody class="table-content">
									<?php
									$no = 1;
									foreach ($data_paket as $dpk) : ?>
										<tr>
											<td>
												<?= $no++; ?>
											</td>
											<td>
												<?= $dpk['name'] ?>
											</td>
											<td>
												<?= $dpk['price'] ?>
											</td>
											<td>
												<?= $dpk['description'] ?>
											</td>
											<td>
												<?= $dpk['duration'] ?>
											</td>
											<td>
												<?= $dpk['level'] ?>
											</td>
											<td>
												<a href="#edit<?= str_replace(" ", "_", strtolower($dpk['id'])); ?>" class="btn btn-primary btn-class" data-toggle="modal">
													<i class="fas fa-edit"></i>
												</a>
												<a href="#delete<?= str_replace(" ", "_", strtolower($dpk['id'])); ?>" class="btn btn-danger btn-class" data-toggle="modal">
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
				<h3 class="modal-title">Modal Paket</h3>
			</div>
			<form method="POST" action="<?= base_url('PackageController/add'); ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="">ID Paket</label>
						<input type="text" class="form-control" id="id" name="id">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control" id="name" name="name">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Harga</label>
						<input type="text" class="form-control" id="price" name="price">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Dekripsi</label>
						<input type="text" class="form-control" id="description" name="description">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Durasi</label>
						<input type="text" class="form-control" id="duration" name="duration">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Level</label>
						<select name="level" id="level" class="form-control">
							<option value="sd">SD</option>
							<option value="smp">SMP</option>
							<option value="sma">SMA</option>
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
foreach ($data_paket as $dpk) : ?>
	<div class="modal fade" id="edit<?= str_replace(" ", "_", strtolower($dpk['id'])); ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit Paket</h3>
				</div>
				<form method="POST" action="<?= base_url('PackageController/update'); ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label for="">ID Paket</label>
							<input type="hidden" class="form-control" value="<?= $dpk['id'] ?>" name="id">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Nama</label>
							<input type="text" class="form-control" value="<?= $dpk['name'] ?>" name="name">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Harga</label>
							<input type="text" class="form-control" value="<?= $dpk['price'] ?>" name="price">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Deskripsi</label>
							<input type="text" class="form-control" value="<?= $dpk['description']; ?>" name="description">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Durasi</label>
							<input type="text" class="form-control" value="<?= $dpk['duration'] ?>" name="duration">
							<span class="help-block text-danger text-capitalize"></span>
						</div>
						<div class="form-group">
							<label for="">Level</label>
							<select name="level" id="level" class="form-control">
								<option value="<?= $dpk['level'] ?>"><?= $dpk['level'] ?></option>
								<option value="sd">SD</option>
								<option value="smp">SMP</option>
								<option value="sma">SMA</option>
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
foreach ($data_paket as $dpk) : ?>
	<div class="modal fade" id="delete<?= str_replace(" ", "_", strtolower($dpk['id'])); ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Delete <?= $title; ?></h3>
				</div>
				<form method="POST" action="<?= base_url('PackageController/delete'); ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<h4 class="text-center text-primary">
								Apakah anda yakin ingin menghapus data ini ?
							</h4>
							<input type="hidden" class="form-control" value="<?= $dpk['id'] ?>" name="id">
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
	// 	$('#myTable').DataTable({

	// 		"pageLength": 20,
	// 		"processing": true,
	// 		"serverSide": true,
	// 		"order": [],

	// 		"ajax": {
	// 			"url": "<?php echo site_url('PackageController/get_data_user') ?>",
	// 			"type": "POST",
	// 		},


	// 		"columnDefs": [{
	// 			"targets": [0],
	// 			"orderable": false,
	// 		}, ],


	// 	});
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





	// function reload_table() {
	// 	table.ajax.reload(null, false); //reload datatable ajax
	// };


	// function updateList(id) {
	// 	save_method = 'update';
	// 	url_id = id;
	// 	$('.form-group').removeClass('has-error'); // clear error class
	// 	$('.help-block').empty(); // clear error string
	// 	$.ajax({
	// 		url: "<?= base_url('PackageController/get_id/'); ?>" + id,
	// 		type: 'GET',
	// 		dataType: 'JSON',
	// 		success: function(data) {
	// 			$('[name="id"]').val(data.id);
	// 			$('[name="id"]').prop("disabled", true);
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
	// 		url = "<?php echo site_url('PackageController/add'); ?>";
	// 	} else {
	// 		url = "<?php echo site_url('PackageController/update/'); ?>" + url_id;
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

	// $(document).on("click", function() {
	// 	let id = $('#id_form').val();
	// 	console.log(id);
	// 	swal({
	// 		title: 'Konfirmasi',
	// 		text: 'Apakah anda yakin akan menghapus data ini?',
	// 		icon: 'warning',
	// 		buttons: ['Batal', "OK"],
	// 		dangerMode: true,
	// 	}).then((result) => {
	// 		if (result) {
	// 			$.ajax({
	// 				url: "<?= base_url('PackageController/delete/'); ?>" + id,
	// 				type: "POST",
	// 				dataType: "JSON",
	// 				success: function(data) {
	// 					document.location.href = "<?= base_url('admin/package') ?>"
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
	// });
</script>