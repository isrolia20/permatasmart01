<section class="section">
	<div class="section-header"><a href="/">
			<h1>Transaksi</h1>
		</a></div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Table Transaksi</h4>
						<div class="card-header-action"><button class="btn btn-primary" onclick="add()">Tambah Data</button></div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table text-capitalize" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nama Siswa</th>
										<th scope="col">Paket</th>
										<th scope="col">Status</th>
										<th scope="col">Total</th>
										<!-- <th scope="col">Jadwal</th> -->
										<th scope="col">Tutor</th>
										<!-- <th scope="col">Is Active</th> -->
										<th scope="col">Bukti Pembayaran</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody class="table-content">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Modal title</h3>
			</div>
			<div class="modal-body">
				<form action="#" id="form" enctype="multipart/form-data">
					<!-- <div class="form-group">
						<label for="">Paket</label>
						<select name="package_id" id="package_id" class="form-control">
						</select>
						<span class="help-block text-danger text-capitalize"></span>
					</div> -->
					<div class="form-group">
						<label for="">Tutor</label>
						<select name="tutor" id="tutor" class="form-control">
						</select>
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Status</label>
						<select type="text" class="form-control" id="status" name="status">
							<option value="pending" selected>Pending</option>
							<option value="verified">Verified</option>
							<option value="not_verified">Not Verified</option>
							<option value="block">Block</option>
						</select>
						<span class="help-block text-danger text-capitalize"></span>

					</div>
					<!-- <div class="form-group">
						<label for="">Is Active</label>
						<select type="text" class="form-control" id="is_active" name="is_active">
							<option value="active" selected>Active</option>
							<option value="inactive">Inactive</option>
						</select>
						<span class="help-block text-danger text-capitalize"></span>
					</div> -->
					<!-- 
					<div class="form-group">
						<label for="">discount</label>
						<input type="text" class="form-control" id="discount" name="discount">
						<span class="help-block text-danger text-capitalize"></span>
					</div> -->
					<!-- <div class="form-group">
						<label for="">total</label>
						<input type="text" class="form-control" id="total" name="total">
						<span class="help-block text-danger text-capitalize"></span>
					</div> -->
					<!-- <div class="form-group">
						<label for="">schedule</label>
						<input type="text" class="form-control" id="schedule" name="schedule">
						<span class="help-block text-danger text-capitalize"></span>
					</div> -->
					<!-- <div class="form-group" id="receipt-preview">
						<label for="">Bukti Transfer</label>
						<div></div>						
						<span class="help-block text-danger text-capitalize"></span>
					</div> -->
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_save" onclick="save()" class="btn btn-primary">Submit</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var save_method;
	var table;
	var url_id;
	var base_url = "<?php echo base_url(); ?>"
	$(document).ready(function() {
		packageDropdown();
		tutorDropdown()
		//datatables
		table = $('#myTable').DataTable({

			"pageLength": 20,
			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?php echo site_url('TransactionController/get_data_user') ?>",
				"type": "POST",
			},


			"columnDefs": [{
				"targets": [0],
				"orderable": false,
			}, ],


		});
		$("input").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("textarea").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

	});


	$('#package_id').change(function() {
		let discount = $('#discount').val();
		let price = $(this).find(':selected').attr('data-price');
		$('[name="total"]').val(price - discount);
	});

	$('input[type="file"]').change(function(e) {
		let reader = new FileReader();
		reader.readAsDataURL(e.target.files[0]);
		reader.onload = (e) => {
			imageSrc = e.target.result;
			$('#label-receipt').text('Ubah Bukti Transfer'); // label receipt upload
			$('#receipt-preview div').html('<img src="' + imageSrc + '" class="img-responsive mb-3" style="width: 100px">'); // show photo					

		};
	});

	function uploadImage() {
		$('input[type="file"]').trigger('click');
	}

	function reload_table() {
		table.ajax.reload(null, false); //reload datatable ajax
	};


	function updateList(id) {
		save_method = 'update';
		url_id = id;
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$.ajax({
			url: "<?= base_url('TransactionController/get_id/'); ?>" + id,
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				$('[name="id"]').val(data.id);
				$('[name="id"]').prop("disabled", true);
				// $('[name="student_id"]').val(data.student_id);
				// $('[name="package_id"]').val(data.package_id);
				$('[name="status"]').val(data.status);
				// $('[name="is_active"]').val(data.is_active);
				// $('[name="discount"]').val(data.discount);
				// $('[name="total"]').val(data.total);
				// $('[name="schedule"]').val(data.schedule);

				$('#receipt-preview').show();
				if (data.receipt) {
					$('#label-receipt').text('Change Avatar'); // label receipt upload
					$('#receipt-preview div').html('<img src="' + base_url + 'upload/' + data.receipt + '" class="img-responsive mb-3 img-preview" style="width: 100px">'); // show photo					
				} else {
					$('#label-receipt').text('Upload Avatar'); // label receipt upload
					$('#receipt-preview div').text('(No receipt)');
				}


				$('#modalForm').modal('show');
				$('.modal-title').text('Update Data');
				reload_table();
			}
		});
	}

	function packageDropdown() {
		$.ajax({
			url: "<?= base_url('LeasonController/get_data_package'); ?>",
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				let htmlDefault = `<option selected>Pilih Paket</option>`
				let html = '';
				data.forEach(function(item) {
					html += `
					
				<option value="${item.id}" data-price="${item.price}">${item.name} (${item.price})</option>
				`

				});
				$('#package_id').html(htmlDefault + html);
			}
		});
	}

	function tutorDropdown() {
		$.ajax({
			url: "<?= base_url('TransactionController/get_data_tutor'); ?>",
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				let htmlDefault = `<option selected>Pilih Tutor</option>`
				let html = '';
				data.forEach(function(item) {
					html += `
					
				<option value="${item.id}" data-price="${item.name}">${item.name}</option>
				`

				});
				$('#tutor').html(htmlDefault + html);
			}
		});
	}


	function add() {
		save_method = 'add';
		$('[name="id"]').prop("disabled", false);
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modalForm').modal('show');
		$('.modal-title').text('Tambah Data');
	}

	function update() {
		save_method = 'update';
		$('[name="id"]').prop("disabled", true);
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modalForm').modal('show');
		$('.modal-title').text('Update Data');
	}

	$('#discount').keyup(function() {
		let discountVal = $(this).val();
		let price = $('#package_id').find(':selected').attr('data-price');
		let total = $('[name="total"]');
		let totalVal = $('[name="total"]').val();
		if (discountVal == '') {
			total.val(price);
		} else {
			total.val(price - discountVal);
		}

	})


	function save() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true);
		var url;

		if (save_method == 'add') {
			url = "<?php echo site_url('TransactionController/add'); ?>";
		} else {
			url = "<?php echo site_url('TransactionController/updateStatus/'); ?>" + url_id;
		}
		// ajax adding data to database
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data) {
				if (data.status) //if success close modal and reload ajax table
				{
					$('#modalForm').modal('hide');
					reload_table();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}

				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable


			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable

			}
		});
	}

	function deleteList(id) {
		swal({
			title: 'Konfirmasi',
			text: 'Apakah anda yakin akan menghapus data ini?',
			icon: 'warning',
			buttons: ['Batal', "OK"],
			dangerMode: true,
		}).then((result) => {
			if (result) {
				$.ajax({
					url: "<?= base_url('TransactionController/delete/'); ?>" + id,
					type: "POST",
					dataType: "JSON",
					success: function(data) {
						reload_table();
					}

				});
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