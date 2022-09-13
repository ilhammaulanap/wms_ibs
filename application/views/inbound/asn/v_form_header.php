<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1 class="m-0 text-dark">Form Order</h1> -->
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('inbound') ?>">Inbound</a></li>
						<li class="breadcrumb-item active">Form ASN</li>
					</ol>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-primary">
				<div class="card-header">
					Data ASN
				</div>
				<form id="form_order" method="POST">
					<div class="card-body">
						<div class="row">
							<!-- ROW -->
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<label>Estimate Inbound Date</label>
										<input type="hidden" name="id" id="id">
										<input type="date" name="est_inbound_date" id="est_inbound_date" class="form-control form-control-sm" min="<?= date('Y-m-01') ?>" autofocus required>
									</div>
									<div class="col-md-3">
										<label>MTA Number</label>
										<input type="text" name="po_no" id="po_no" class="form-control form-control-sm" title="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
									</div>
									<div class="col-md-3">
										<label>Fabricator</label>
										<select name="id_supplier" id="id_supplier" class="form-control form-control-sm" required></select>
									</div>
									<div class="col-md-3">
										<label>Warehouse Destination</label>
										<select name="id_warehouse" id="id_warehouse" class="form-control form-control-sm" required></select>
									</div>
								</div>
							</div>
							<!-- END ROW -->

							<!-- ROW  -->
							<div class="col-md-12 mt-3">
								<div class="row">
									<div class="col-md-3">
										<label>Project</label>
										<select name="id_project" id="id_project" class="form-control form-control-sm" required></select>
									</div>
									<div class="col-md-3">
										<label>Vendor</label>
										<select name="id_vendor" id="id_vendor" class="form-control form-control-sm" required></select>
									</div>
									<div class="col-md-3">
										<label>No Container</label>
										<input type="text" name="no_container" id="no_container" class="form-control form-control-sm" title="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
									</div>
									<div class="col-md-3">
										<label>User</label>
										<input type="hidden" id="id_user_tc" name="id_user_tc">
										<input type="text" id="name_creator" name="name_creator" class=" form-control-sm form-control-plaintext" readonly>
									</div>
								</div>
							</div>


							<div class="col-md-12 mt-3">
								<div class="row">
									<div class="col-md-3">
										<label>MOT</label>
										<select name="id_mot" id="id_mot" class="form-control form-control-sm" required></select>
									</div>
									<div class="col-md-3">
										<label>MOT No</label>
										<input type="text" name="truck_no" id="truck_no" class="form-control form-control-sm" title="Only alphanumeric characters." pattern="^[a-zA-Z0-9\s]+$" maxlength="20" minlength="4" required>
									</div>
									<div class="col-md-3">
										<label>Driver Name</label>
										<input type="text" name="driver_name" id="driver_name" class="form-control form-control-sm" title="Only characters." pattern="^[a-zA-Z\s]+$" minlength="2" maxlength="50" required>
									</div>
									<div class="col-md-3">
										<label>Driver Contact</label>
										<input type="text" name="driver_contact" id="driver_contact" class="form-control form-control-sm" title="Only alphanumeric." pattern="^[0-9]+$" minlength="9" maxlength="14" required>
									</div>
								</div>
							</div>
							<!-- END ROW -->
						</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<button type="submit" class="btn btn-success btn-save">
										<i class="fa fa-save"> </i> Save
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>

<script>
	$(document).ready(function() {
		var id_karyawan = "<?= $id_user ?>";
		var nama_karyawan = "<?= $name_user ?>";
		var id = "<?= $id ?>";
		var id_trash = [];
		//fill name user
		$('[name=id_user_tc]').val(id_karyawan);
		$('[name=name_creator]').val(nama_karyawan);

		function lock_warehouse() {
			$('[name=id_warehouse]').prop('disabled', true);
		}

		function unlock_warehouse() {
			$('[name=id_warehouse]').prop('disabled', false);
		}

		$("select[name='id_supplier']").select2({
			ajax: {
				url: "<?= site_url('supplier/get_ajax_data') ?>",
				type: "POST",
				dataType: 'JSON',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term, // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			},
			placeholder: 'Select Fabricator',
		});

		$("select[name='id_mot']").select2({
			ajax: {
				url: "<?= site_url('mot/get_ajax_data') ?>",
				type: "POST",
				dataType: 'JSON',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term, // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			},
			placeholder: 'Select Mot',
		});

		$("select[name='id_warehouse']").select2({
			ajax: {
				url: "<?= site_url('warehouse/get_ajax_data_select') ?>",
				type: "POST",
				dataType: 'JSON',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term, // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			},
			placeholder: 'Select Warehouse',
		});

		$("select[name='id_project']").select2({
			ajax: {
				url: "<?= site_url('project/get_ajax_project') ?>",
				type: "POST",
				dataType: 'JSON',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term, // search term
						id_warehouse: $('[name=id_warehouse]').val(),
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			},
			placeholder: 'Select project',
		});

		$("select[name='id_vendor']").select2({
			ajax: {
				url: "<?= site_url('vendors/get_ajax_data') ?>",
				type: "POST",
				dataType: 'JSON',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term, // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			},
			placeholder: 'Select Vendor',
		});

		$('#form_order').on('submit', function(e) {
			e.preventDefault();

			Swal.fire({
				title: 'Do you want to save the changes?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, save it!',
				allowOutsideClick: false,
			}).then((result) => {
				console.log(result);
				/* Read more about isConfirmed, isDenied below */
				if (result.value) {
					//save form
					unlock_warehouse();
					var formdata = new FormData($(this)[0]);
					$.ajax({
						url: "<?= site_url('inbound/save_asn') ?>",
						type: "POST",
						dataType: 'JSON',
						data: $('#form_order').serialize(),
						beforeSend: function() {
							Swal.fire({
								title: 'Loading',
								html: 'Please wait...',
								willOpen: () => {
									Swal.showLoading()
								},
								showConfirmButton: false,
								allowOutsideClick: false,
								allowEscapeKey: false,
							});
						},
						success: function(data) {
							Swal.close();
							if (data.code == 200) {
								Swal.fire(
									'Success!',
									data.message ?? 'Your data has been saved.',
									'success'
								).then((result) => {
									if (result.value) {
										window.location.href = "<?= site_url('inbound/update_asn/') ?>" + data.data.id;
									}
								});
							} else {
								Swal.fire(
									'Failed!',
									data.message ?? 'Your data has been failed.',
									'error'
								)
							}
						},
						error: function(data) {
							Swal.close();
							Swal.fire(
								'Failed!',
								'Your data has been failed.',
								'error'
							)
						}
					})
				}
			})
		});
	});
</script>