<section class="section">
	<div class="section-header"><a href="/">
			<h1>Admin</h1>
		</a></div>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Table Admin</h4>
						<div class="card-header-action"><button class="btn btn-primary" onclick="add()">Tambah Data</button></div>
					</div>
					<div class="card-body">
						<!--v-if-->
						<div class="table-responsive">
							<table id="myTable" class="table" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Email</th>
										<th scope="col">Name</th>
										<th scope="col">Address</th>
										<th scope="col">Phone Number</th>
										<th scope="col">Photo</th>
										<th scope="col">Privilege</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody class="table-content">
								</tbody>
							</table>
							<!--v-if-->
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
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" class="form-control" id="email" name="email">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Name</label>
						<input type="name" class="form-control" id="name" name="name">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Address</label>
						<input type="address" class="form-control" id="address" name="address">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Phone Number</label>
						<input type="phone_number" class="form-control" id="phone_number" name="phone_number">
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group">
						<label for="">Privilege</label>
						<select class="form-control" name="privilege" id="privilege">
							<option value="super">Super</option>
							<option value="administrator">Administrator</option>
							<option value="staff">Staff</option>
						</select>
						<span class="help-block text-danger text-capitalize"></span>
					</div>
					<div class="form-group" id="avatar-preview">
						<label for="">Avatar</label>
						<div></div>
						<input name="avatar" type="file" class="hiddenfile" />
						<button type="button" onclick="uploadImage()" id="label-avatar" class="btn btn-primary">Upload Avatars</but>
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
</div>

<script type="text/javascript">
	var save_method;
	var table;
	var url_id;
	var imageSrc = null;
	$(document).ready(function() {

		//datatables
		table = $('#myTable').DataTable({

			"pageLength": 20,
			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?php echo site_url('AdminController/get_data_user') ?>",
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

	function reload_table() {
		table.ajax.reload(null, false); //reload datatable ajax
	};

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

	function updateList(id) {
		save_method = 'update';
		url_id = id;
		base_url = "<?= base_url(); ?>";
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$.ajax({
			url: "<?= base_url('AdminController/get_id/'); ?>" + id,
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				$('[name="email"]').val(data.email);
				$('[name="name"]').val(data.name);
				$('[name="address"]').val(data.address);
				$('[name="phone_number"]').val(data.phone_number);
				$('[name="privilege"]').val(data.privilege);

				$('#avatar-preview').show();
				if (data.avatar) {
					$('#label-avatar').text('Change Avatar'); // label avatar upload
					$('#avatar-preview div').html('<img src="' + base_url + 'upload/img/admin/' + data.avatar + '" class="img-responsive mb-3 img-preview" style="width: 100px">'); // show photo					
				} else {
					$('#label-avatar').text('Upload Avatar'); // label avatar upload
					$('#avatar-preview div').text('(No avatar)');
				}

				$('#modalForm').modal('show');
				$('.modal-title').text('Update Data');
				reload_table();
			}
		});

	}



	function add() {
		save_method = 'add';
		$('.img-preview').attr('src', null);
		$('#label-avatar').text('Upload Avatar');
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modalForm').modal('show');
		$('.modal-title').text('Tambah Data');
	}


	function save() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true);
		var url;

		if (save_method == 'add') {
			url = "<?php echo site_url('AdminController/add'); ?>";
		} else {
			url = "<?php echo site_url('AdminController/update/'); ?>" + url_id;
		}
		var formData = new FormData($('#form')[0]);
		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data) {
				console.log(data);
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
				console.log(jqXHR)
				console.log(textStatus)
				console.log(errorThrown)
				alert('Error adding / update data' + jqXHR);
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable

			}
		});
		imageSrc = null;
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
					url: "<?= base_url('AdminController/delete/'); ?>" + id,
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
