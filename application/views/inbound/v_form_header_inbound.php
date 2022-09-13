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
					Data Inbound
				</div>
				<form id="form_order" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id">
					<input type="hidden" name="est_inbound_date">
					<input type="hidden" name="id_user" value="<?= $id_user ?>">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Warehouse Destination *</label>
									<select name="id_warehouse" id="id_warehouse" class="form-control form-control-sm" required></select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ASN Number</label>
									<select class="form-control form-control-sm" name="asn_no" id="asn_no">

									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Project *</label>
									<select name="id_project" id="id_project" class="form-control" required></select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Inbound Date *</label>
									<input type="date" name="inbound_date" id="inbound_date" class="form-control" min="<?= date('Y-m-1') ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>MTA Number *</label>
									<input type="text" name="po_no" id="po_no" class="form-control form-control-sm" title="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Fabricator *</label>
									<select name="id_supplier" id="id_supplier" class="form-control form-control-sm" required></select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Vendor *</label>
									<select name="id_vendor" id="id_vendor" class="form-control" required></select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>No Container *</label>
									<input type="text" name="no_container" id="no_container" class="form-control" title="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>MOT *</label>
									<select name="id_mot" id="id_mot" class="form-control form-control-sm" required></select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>MOT No *</label>
									<input type="text" name="truck_no" id="truck_no" class="form-control form-control-sm" title="Only alphanumeric characters." pattern="^[a-zA-Z0-9\s]+$" maxlength="20" minlength="4" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Driver Name *</label>
									<input type="text" name="driver_name" id="driver_name" class="form-control form-control-sm" title="Only characters." pattern="^[a-zA-Z\s]+$" minlength="2" maxlength="50" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Driver Contact *</label>
									<input type="text" name="driver_contact" id="driver_contact" class="form-control form-control-sm" title="Only alphanumeric." pattern="^[0-9]+$" minlength="9" maxlength="14" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Shipment Document *</label>
									<span class="help-text">Biarkan kosong, jika tidak ingin mengganti</span>
									<input type="file" name="photo_sj" id="photo_sj" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Truck Photo *</label>
									<span class="help-text">Biarkan kosong, jika tidak ingin mengganti</span>
									<input type="file" name="photo_truck" id="photo_truck" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Link Document *</label>
									<input type="text" name="link_attach" id="link_attach" class="form-control">
								</div>
							</div>
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

		$("select[name='asn_no']").select2({
			ajax: {
				url: "<?= site_url('inbound/get_ajax_data_select_asn') ?>",
				type: "POST",
				dataType: 'JSON',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term, // search term
						id_warehouse: $('select[name=id_warehouse]').val() ?? 9999,
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			},
			placeholder: 'Select ASN',
			allowClear: true,
		});

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

		$("select[name='asn_no']").on('change', function() {
			const val = $(this).val();
			$.ajax({
				url: "<?= site_url('inbound/get_asn_detail') ?>",
				type: "GET",
				data: {
					asn_no: val,
				},
				dataType: 'json',
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
				success: function(response) {
					Swal.close();
					if (response.code == 200) {
						const data_asn = response.data;
						$('input[name=id]').val(data_asn.id);
						$('input[name=est_inbound_date]').val(data_asn.est_inbound_date);
						$('input[name=po_no]').val(data_asn.po_no);
						$('input[name=no_container]').val(data_asn.no_container);
						$('input[name=truck_no]').val(data_asn.truck_no);
						$('input[name=driver_name]').val(data_asn.driver_name);
						$('input[name=driver_contact]').val(data_asn.driver_contact);
						$('input[name=id_user_tc]').val(data_asn.id_user_tc);

						var option = new Option(data_asn.supplier, data_asn.id_supplier);
						$('select[name=id_supplier]').append(option).trigger('change');

						var option = new Option(data_asn.warehouse_name, data_asn.id_warehouse);
						$('select[name=id_warehouse]').append(option).trigger('change');

						var option = new Option(data_asn.project, data_asn.id_project);
						$('select[name=id_project]').append(option).trigger('change');

						var option = new Option(data_asn.vendor, data_asn.id_vendor);
						$('select[name=id_vendor]').append(option).trigger('change');

						var option = new Option(data_asn.mot, data_asn.id_mot);
						$('select[name=id_mot]').append(option).trigger('change');
					} else {
						Swal.fire({
							title: 'Error',
							html: response.message,
							icon: 'error',
						});
					}
				},
				error: function(response) {
					Swal.close();
					let message = "";
					if (response.responseJSON == undefined) {
						message = "Error save data";
					} else {
						message = response.responseJSON.message;
					}
					Swal.fire({
						title: 'Error',
						html: message,
						icon: 'error',
					});
				}
			})
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
				if (result.isConfirmed) {
					//save form
					var formdata = new FormData($(this)[0]);
					$.ajax({
						url: "<?= site_url('inbound/save_inbound_header') ?>",
						type: "POST",
						dataType: 'JSON',
						data: formdata,
						cache: false,
						contentType: false,
						processData: false,
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
						success: function(response) {
							Swal.close();
							if (response.code == 200) {
								Swal.fire(
									'Success!',
									response.message ?? 'Your data has been saved.',
									'success'
								).then((result) => {
									if (result.value) {
										window.location.href = "<?= site_url('inbound/edit/') ?>" + response.data.id;
									}
								});
							} else {
								Swal.fire(
									'Failed!',
									response.message ?? 'Your data has been failed.',
									'error'
								)
							}
						},
						error: function(response) {
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
	})
</script>