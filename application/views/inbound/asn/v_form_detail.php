<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1 class="m-0 text-dark">Form Order</h1> -->
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="<?= site_url('inbound/asn') ?>">ASN</a>
						</li>
						<li class="breadcrumb-item active">Form ASN</li>
					</ol>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-primary">
				<div class="card-header">Data ASN</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-6 table-responsive">
									<table class="table table-striped table-sm">
										<tr>
											<th>ASN Number</th>
											<td>:</td>
											<td id="asn_no"></td>
										</tr>
										<tr>
											<th>Estimate Inbound Date</th>
											<td>:</td>
											<td id="est_inbound_date"></td>
										</tr>
										<tr>
											<th>MTA Number</th>
											<td>:</td>
											<td id="po_no"></td>
										</tr>
										<tr>
											<th>Fabricator</th>
											<td>:</td>
											<td id="supplier"></td>
										</tr>
										<tr>
											<th>Warehouse Destination</th>
											<td>:</td>
											<td id="name_warehouse"></td>
										</tr>
										<tr>
											<th>Project Name</th>
											<td>:</td>
											<td id="name_project"></td>
										</tr>
										<tr>
											<th>Vendor Name</th>
											<td>:</td>
											<td id="name_vendor"></td>
										</tr>
									</table>
								</div>
								<div class="col-md-6 table-responsive">
									<table class="table table-striped table-sm">
										<tr>
											<th>No Container</th>
											<td>:</td>
											<td id="no_container"></td>
										</tr>
										<tr>
											<th>User Submit</th>
											<td>:</td>
											<td id="name_user_tc"></td>
										</tr>
										<tr>
											<th>Mode of Transportation</th>
											<td>:</td>
											<td id="name_mot"></td>
										</tr>
										<tr>
											<th>Truck No</th>
											<td>:</td>
											<td id="truck_no"></td>
										</tr>
										<tr>
											<th>Driver Name</th>
											<td>:</td>
											<td id="name_driver"></td>
										</tr>
										<tr>
											<th>Driver Contact</th>
											<td>:</td>
											<td id="driver_contact"></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-info btn-edit btn-block text-left">
								<i class="fa fa-edit"></i> Edit
							</button>
							<button type="button" class="btn btn-primary btn-attachment btn-block text-left mt-1">
								<i class="fa fa-paperclip"></i> Attachment
							</button>
							<!-- <button type="button" class="btn btn-info btn-history btn-block text-left mt-1">
								<i class="fa fa-history"></i> History
							</button> -->
						</div>
					</div>
				</div>
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">Data Inbound Detail</div>
						<div class="col-md-6">
							<div class="pull-right">
								<button type="button" class="btn btn-secondary btn-sm btn-add-detail text-left">
									<i class="fa fa-plus"></i> Add Detail
								</button>
								<button type="button" class="btn btn-success btn-sm btn-import-detail text-left">
									<i class="fa fa-file-excel"></i> Import Detail
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-striped table-sm text-center" id="tb_detail" style="width: 100%">
								<thead>
									<tr>
										<th style="width: 25%">Product Name</th>
										<th style="width: 10%">Serial Number</th>
										<th style="width: 10%">Box Id</th>
										<th style="width: 10%">Shipment Number</th>
										<th style="width: 10%">Site Id</th>
										<th style="width: 10%">Qty</th>
										<th style="width: 5%">UoM</th>
										<th style="width: 5%">Action</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit_label" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form method="POST" id="form_edit">
			<input type="hidden" class="form-control" name="id">
			<input type="hidden" class="form-control" name="id_user_tc">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_edit_label">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Estimate Inbound Date</label>
								<input type="date" name="est_inbound_date" id="est_inbound_date" class="form-control form-control-sm" min="<?= date('Y-m-01') ?>" autofocus required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>MTA Number</label>
								<input type="text" name="po_no" id="po_no" class="form-control form-control-sm" placeholder="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Fabricator</label>
								<select name="id_supplier" id="id_supplier" class="form-control form-control-sm" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Warehouse Destination</label>
								<select name="id_warehouse" id="id_warehouse" class="form-control form-control-sm" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Project</label>
								<select name="id_project" id="id_project" class="form-control form-control-sm" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Vendor</label>
								<select name="id_vendor" id="id_vendor" class="form-control form-control-sm" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>No Container</label>
								<input type="text" name="no_container" id="no_container" class="form-control form-control-sm" title="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>MOT</label>
								<select name="id_mot" id="id_mot" class="form-control form-control-sm" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Truck No</label>
								<input type="text" name="truck_no" id="truck_no" class="form-control form-control-sm" title="Only alphanumeric characters." pattern="^[a-zA-Z0-9\s]+$" maxlength="20" minlength="4" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Driver Name</label>
								<input type="text" name="driver_name" id="driver_name" class="form-control form-control-sm" title="Only characters." pattern="^[a-zA-Z\s]+$" minlength="2" maxlength="50" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Driver Contact</label>
								<input type="text" name="driver_contact" id="driver_contact" class="form-control form-control-sm" title="Only alphanumeric." pattern="^[0-9]+$" minlength="9" maxlength="14" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="modal_detail_label" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="form_detail" method="POST">
			<input type="hidden" name="id" id="id">
			<input type="hidden" name="id_inbound" id="id_inbound">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_detail_label">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="id_product">Product</label>
								<select class="form-control form-control-sm" name="id_product" id="id_product" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="lot_number">LOT Number</label>
								<input type="text" name="lot_number" id="lot_number" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="box_id">Box Id</label>
								<input type="text" name="box_id" id="box_id" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="shipment_no">Shipment No</label>
								<input type="text" name="shipment_no" id="shipment_no" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="site_id">Site Id</label>
								<input type="text" name="site_id" id="site_id" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="est_qty_product">Estimate Qty Inbound</label>
								<input type="number" min="0.001" step="0.001" name="est_qty_product" id="est_qty_product" class="form-control form-control-sm" required>
							</div>
						</div>
					</div>
				</div>
				<div class=" modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modal_import" tabindex="-1" role="dialog" aria-labelledby="modal_impor_label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="form_import_inbound_detail" enctype="multipart/form-data">
			<input type="hidden" name="id">
			<input type="hidden" name="id_warehouse">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_impor_label">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="file_excel">Download Template</label>
								<button type="button" class="btn btn-primary btn-excel btn-sm btn-block"><i class="fa fa-download"></i> Download</button>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="file_template">File Template</label>
								<input type="file" class="form-control form-control-sm" name="file_template" id="file_template" placeholder="File Template" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		let id = "<?= $id ?>";
		let data_asn;

		function row_detail(name_product = '0', serial_number = '', box_id = '', shipment_no = '', site_id = '', qty = '', uom = '') {
			let html = '';
			html += '<tr>';
			html += '<td>' + name_product + '</td>';
			html += '<td>' + serial_number + '</td>';
			html += '<td>' + box_id + '</td>';
			html += '<td>' + shipment_no + '</td>';
			html += '<td>' + site_id + '</td>';
			html += '<td>' + qty + '</td>';
			html += '<td>' + uom + '</td>';
			html += `<td>
                <button class="btn btn-info btn-sm btn-edit-detail"><i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm btn-delete-detail"><i class="fa fa-trash"></i></button>
                </td>`;
			html += '</tr>';
			return html;
		}

		function load_data(id = '') {
			$.ajax({
				url: "<?= site_url('inbound/get_asn_detail') ?>",
				type: "GET",
				data: {
					id: id,
				},
				dataType: 'JSON',
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
				success: function(result) {
					Swal.close();
					if (result.code == 200) {
						data_asn = result.data;

						$('#asn_no').html(data_asn.asn_no);
						$('#est_inbound_date').html(data_asn.est_inbound_date);
						$('#po_no').html(data_asn.po_no);
						$('#supplier').html(data_asn.supplier);
						$('#name_warehouse').html(data_asn.warehouse_name);
						$('#name_project').html(data_asn.project);
						$('#name_vendor').html(data_asn.vendor);
						$('#no_container').html(data_asn.no_container);
						$('#name_user_tc').html(data_asn.name_user_tc);
						$('#name_mot').html(data_asn.mot);
						$('#truck_no').html(data_asn.truck_no);
						$('#name_driver').html(data_asn.driver_name);
						$('#driver_contact').html(data_asn.driver_contact);

						$('#tb_detail tbody').html('');
						data_asn.inbound_product.map((item, index) => {
							const row = row_detail(item.product_name, item.lot_number, item.box_id, item.shipment_no, item.site_id, item.est_qty_product, item.uom_name);
							$('#tb_detail tbody').append(row);
						})
					} else {

					}
				},
				error: function(result) {
					Swal.close();
					result = result.responseJSON;
					let message;
					if (result == undefined) {
						message = result.message;
					} else {
						message = 'Your data failed to saved';
					}

					Swal.fire({
						title: 'Error',
						message: message,
						icon: 'error',
					});
				}
			})
		}

		function init_select_product() {
			$("#modal_detail select[name=id_product]").select2({
				ajax: {
					url: "<?= site_url('product/get_ajax_data_select') ?>",
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
				placeholder: 'Select Product',
			});
		}

		function clear_form_detail() {
			$('#modal_detail select[name=id_product]').val(null).change();
			$('#modal_detail input[name=box_id]').val('');
			$('#modal_detail input[name=lot_number]').val('');
			$('#modal_detail input[name=shipment_no]').val('');
			$('#modal_detail input[name=est_qty_product]').val('');
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

		$('button.btn-edit').on('click', function() {
			$('#modal_edit input[name=id]').val(data_asn.id);
			$('#modal_edit input[name=est_inbound_date]').val(data_asn.est_inbound_date);
			$('#modal_edit input[name=po_no]').val(data_asn.po_no);
			$('#modal_edit input[name=no_container]').val(data_asn.no_container);
			$('#modal_edit input[name=truck_no]').val(data_asn.truck_no);
			$('#modal_edit input[name=driver_name]').val(data_asn.driver_name);
			$('#modal_edit input[name=driver_contact]').val(data_asn.driver_contact);
			$('#modal_edit input[name=id_user_tc]').val(data_asn.id_user_tc);

			var option = new Option(data_asn.supplier, data_asn.id_supplier);
			$('#modal_edit select[name=id_supplier]').append(option).trigger('change');

			var option = new Option(data_asn.warehouse_name, data_asn.id_warehouse);
			$('#modal_edit select[name=id_warehouse]').append(option).trigger('change');

			var option = new Option(data_asn.project, data_asn.id_project);
			$('#modal_edit select[name=id_project]').append(option).trigger('change');

			var option = new Option(data_asn.vendor, data_asn.id_vendor);
			$('#modal_edit select[name=id_vendor]').append(option).trigger('change');

			var option = new Option(data_asn.mot, data_asn.id_mot);
			$('#modal_edit select[name=id_mot]').append(option).trigger('change');

			$('#modal_edit .modal-title').html('Edit ASN');
			$('#modal_edit').modal();
		});

		$('button.btn-import-detail').on('click', function() {
			$('#modal_import input[name=id]').val(data_asn.id);
			$('#modal_import input[name=id_warehouse]').val(data_asn.id_warehouse);

			$('#modal_import .modal-title').html('Import Product');
			$('#modal_import').modal('show');
		});

		$('button.btn-excel').on('click', function() {
			var url = "<?= site_url('inbound/export_template_import_product_asn') ?>";
			url += '?id_warehouse' + data_asn.id_warehouse;
			window.open(url);
		});

		$('#form_edit').on('submit', function(e) {
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
					$.ajax({
						url: "<?= site_url('inbound/save_asn') ?>",
						type: "POST",
						dataType: 'JSON',
						data: $('#form_edit').serialize(),
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
								Swal.fire({
									title: 'Success!',
									message: data.message ?? 'Your data has been saved.',
									icon: 'success',
									willClose: () => {
										load_data(id);
										$('#modal_edit').modal('hide');
									},
								}).then((result) => {
									if (result.value) {
										load_data(id);
										$('#modal_edit').modal('hide');
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

		$('#form_import_inbound_detail').on('submit', function(e) {
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
					var formdata = new FormData($(this)[0]);
					$.ajax({
						url: "<?= site_url('inbound/save_upload_data_product_asn') ?>",
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
						success: function(data) {
							Swal.close();
							if (data.code == 200) {
								Swal.fire({
									title: 'Success!',
									message: data.message ?? 'Your data has been saved.',
									icon: 'success',
									willClose: () => {
										load_data(id);
										$('#modal_import').modal('hide');
									},
								}).then((result) => {
									if (result.value) {
										load_data(id);
										$('#modal_import').modal('hide');
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

		$('#form_detail').on('submit', function(e) {
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
				// console.log(result);
				/* Read more about isConfirmed, isDenied below */
				if (result.value) {
					//save form
					$.ajax({
						url: "<?= site_url('inbound/save_asn_product') ?>",
						type: "POST",
						dataType: 'JSON',
						data: $('#form_detail').serialize(),
						beforeSend: function() {
							Swal.fire({
								title: 'Loading',
								text: 'Please wait...',
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
								Swal.fire({
									title: 'Success!',
									text: data.message ?? 'Your data has been saved.',
									icon: 'success',
									willClose: () => {
										load_data(id);
										$('#modal_detail').modal('hide');
									},
								}).then((result) => {
									if (result.value) {
										load_data(id);
										$('#modal_detail').modal('hide');
									}
								});
								clear_form_detail();
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

		$('button.btn-add-detail').on('click', function() {
			init_select_product();

			$('#modal_detail input[name=id]').val('');
			$('#modal_detail input[name=id_inbound]').val(data_asn.id);

			$('#modal_detail .modal-title').html('Add Product');
			$('#modal_detail').modal('show');
		});

		$('#tb_detail tbody').on('click', 'button.btn-edit-detail', function() {
			init_select_product();

			const index = $(this).parents('tr').index();
			const data_detail = data_asn.inbound_product[index];

			$('#modal_detail input[name=id]').val(data_detail.id);
			$('#modal_detail input[name=id_inbound]').val(data_asn.id);
			$('#modal_detail input[name=box_id]').val(data_detail.box_id);
			$('#modal_detail input[name=lot_number]').val(data_detail.lot_number);
			$('#modal_detail input[name=shipment_no]').val(data_detail.shipment_no);
			$('#modal_detail input[name=est_qty_product]').val(data_detail.est_qty_product);
			$('#modal_detail input[name=site_id]').val(data_detail.site_id);

			var option = new Option(data_detail.product_name, data_detail.id_product);
			$('#modal_detail select[name=id_product]').append(option).change();

			$('#modal_detail .modal-title').html('Edit Product');
			$('#modal_detail').modal('show');
		});

		$('#tb_detail tbody').on('click', 'button.btn-delete-detail', function() {
			const index = $(this).parents('tr').index();
			const data_detail = data_asn.inbound_product[index];

			Swal.fire({
				title: 'Do you want to save the changes?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				allowOutsideClick: false,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: "<?= site_url('inbound/delete_asn_product') ?>",
						type: "POST",
						data: {
							id: data_detail.id,
						},
						dataType: 'JSON',
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
						success: function(result) {
							Swal.close();
							console.log(result);
							if (result.code == 200) {
								Swal.fire({
									title: 'Success!',
									text: result.message ?? 'Your data has been deleted.',
									icon: 'success'
								}).then((res) => {
									if (res.value) {
										load_data(id);
									}
								});
							} else {
								Swal.fire({
									title: 'Failed!',
									text: result.message ?? 'Your data has been failed to delete.',
									icon: 'error'
								});
							}
						},
						error: function(result) {
							Swal.close();
							result = result.responseJSON;
							let message = "";
							if (result == undefined) {
								message = "Data delete failed";
							} else {
								message = result.message;
							}
							Swal.fire({
								title: 'Error',
								icon: 'error',
								text: message,
							});
						}
					})
				}
			});
		});

		load_data(id);
	});
</script>