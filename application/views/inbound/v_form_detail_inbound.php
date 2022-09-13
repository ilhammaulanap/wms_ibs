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
				<div class="card-header">Data Inbound</div>
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
											<th>No Container</th>
											<td>:</td>
											<td id="inbound_no"></td>
										</tr>
										<tr>
											<th>Estimate Inbound Date</th>
											<td>:</td>
											<td id="est_inbound_date"></td>
										</tr>

										<tr>
											<th>Actual Inbound Date</th>
											<td>:</td>
											<td id="inbound_date"></td>
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
										<tr>
											<th>Delivery Note</th>
											<td>:</td>
											<td id="photo_sj"></td>
										</tr>
										<tr>
											<th>Truck Photo</th>
											<td>:</td>
											<td id="photo_truck"></td>
										</tr>
										<tr>
											<th>Attachment Link</th>
											<td>:</td>
											<td id="link_attach"></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-info btn-edit btn-block text-left">
								<i class="fa fa-edit"></i> Edit
							</button>
							<!-- <button type="button" class="btn btn-primary btn-attachment btn-block text-left mt-1">
								<i class="fa fa-paperclip"></i> Attachment
							</button> -->
							<button type="button" class="btn btn-success btn-confirm btn-block text-left">
								<i class="fa fa-edit"></i> Confirm
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
										<th style="width: 20%">Product Name</th>
										<th style="width: 10%">Serial Number</th>
										<th style="width: 10%">Box Id</th>
										<th style="width: 15%">Shipment Number</th>
										<th style="width: 15%">Site Id</th>
										<th style="width: 10%">Estimate Qty</th>
										<th style="width: 10%">Actual Qty</th>
										<th style="width: 5%">UoM</th>
										<th style="width: 5%">Locator</th>
										<th style="width: 10%">Status</th>
										<th style="width: 5%">Note</th>
										<th style="width: 5%">Action</th>
									</tr>
								</thead>
								<tbody>
									<!-- <tr>
										<form class="form-detail" method="POST">
											<td style="width: 20%">Product Name</td>
											<td style="width: 10%">Serial Number</td>
											<td style="width: 10%">Box Id</td>
											<td style="width: 15%">
												<input type="text" name="shipment_no" class="form-control form-control-sm" required>
											</td>
											<td style="width: 10%">10</td>
											<td style="width: 10%">
												<input type="number" step="0.01" name="qty" class="form-control form-control-sm" required>
											</td>
											<td style=" width: 5%">UoM
											</td>
											<td style="width: 10%">
												<select name="id_locator" class="form-control form-control-sm" required></select>
											</td>
											<td style="width: 10%">
												<select name="id_product_status" class="form-control form-control-sm" required></select>
											</td>
											<td style="width: 5%">
												<button type="submit" class="btn btn-sm btn-primary btn-submit-detail">SAVE</button>
											</td>
										</form>
									</tr> -->
								</tbody>
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
		<form method="POST" id="form_edit" enctype="multipart/form-data">
			<input type="hidden" class="form-control" name="id">
			<input type="hidden" class="form-control" name="id_user_tc">
			<input type="hidden" class="form-control" name="id_user">
			<input type="hidden" class="form-control" name="id_warehouse">
			<input type="hidden" class="form-control" name="id_project">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_edit_label">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<!-- <div class="col-md-6">
							<div class="form-group">
								<label>Warehouse Destination *</label>
								<select name="id_warehouse" id="id_warehouse" class="form-control form-control-sm" required></select>
							</div>
						</div> -->
						<div class="col-md-6">
							<div class="form-group">
								<label>ASN Number</label>
								<input type="text" class="form-control" placeholder="ASN Number" name="asn_no" readonly>
							</div>
						</div>
						<!-- <div class="col-md-6">
							<div class="form-group">
								<label>Project *</label>
								<select name="id_project" id="id_project" class="form-control" required></select>
							</div>
						</div> -->
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
								<label for="qty_product">Qty Product</label>
								<input type="number" min="0.001" step="0.001" name="qty_product" id="qty_product" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="id_locator">Locator</label>
								<select name="id_locator" id="id_locator" class="form-control form-control-sm" required></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="id_product_status">Status Product</label>
								<select name="id_product_status" id="id_product_status" class="form-control form-control-sm" required></select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="note">Note</label>
								<input type="text" name="note" id="note" class="form-control form-control-sm" required>
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

		function load_data(id = '') {
			$.ajax({
				url: "<?= site_url('inbound/get_inbound_detail') ?>",
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
						$('#inbound_no').html(data_asn.inbound_no);
						$('#est_inbound_date').html(data_asn.est_inbound_date);
						$('#inbound_date').html(data_asn.inbound_date);
						$('#po_no').html(data_asn.po_no);
						$('#supplier').html(data_asn.supplier);
						$('#name_warehouse').html(data_asn.warehouse);
						$('#name_project').html(data_asn.project_name);
						$('#name_vendor').html(data_asn.vendor);
						$('#no_container').html(data_asn.no_container);
						$('#name_user_tc').html(data_asn.name_user_tc);
						$('#name_user_tc').html(data_asn.name_user_tc);
						$('#name_mot').html(data_asn.mot);
						$('#truck_no').html(data_asn.truck_no);
						$('#name_driver').html(data_asn.driver_name);
						$('#driver_contact').html(data_asn.driver_contact);
						if (data_asn.photo_sj !== null) {
							$('#photo_sj').html('<a href="<?= base_url('files/suratjalan/') ?>' + data_asn.photo_sj + '" title="Photo SJ" target="_blank">DN Photo</a>');
						}
						if (data_asn.photo_truck !== null) {
							$('#photo_truck').html('<a href="<?= base_url('files/truck/') ?>' + data_asn.photo_truck + '" title="Photo Truck" target="_blank">Photo Truck</a>');
						}
						if (data_asn.link_attach !== null) {
							$('#link_attach').html('<a href="' + data_asn.link_attach + '" title="Attachment" target="_blank">Attachment</a>');
						}

						$('#tb_detail tbody').html('');
						data_asn.inbound_product.map((item, index) => {
							const row = row_detail(item.product_name, item.lot_number, item.box_id, item.est_qty_product ?? 0, item.uom_name, item.locator, item.product_status);
							$('#tb_detail tbody').append(row);
							$('input[name=shipment_no]').eq(index).prop('value', item['shipment_no']);
							$('input[name=site_id]').eq(index).prop('value', item['site_id']);

							if (item['qty_product'] != 0 && item['qty_product'] != null) {
								$('input[name=qty_product]').eq(index).prop('value', item['qty_product']);
								$('button.btn-submit-detail').eq(index).hide();
								$('button.btn-edit-detail').eq(index).show();
								$('#tb_detail tbody tr').eq(index).find('input').prop('readonly', true);
							} else {
								$('input[name=qty_product]').eq(index).prop('value', item['est_qty_product']);
								$('button.btn-submit-detail').eq(index).show();
								$('button.btn-edit-detail').eq(index).hide();
								// $('#tb_detail tbody tr').eq(index).find('input').prop('readonly', false);
							}
						})

						init_select_product();
						init_select_product_status();
						init_select_locator();

						if (data_asn.status == '3') {
							// $('button.btn-edit').hide();
							// $('button.btn-add-detail').hide();
							// $('button.btn-edit-detail').hide();
							$('button.btn-confirm').hide();
						}
					} else {
						Swal.fire({
							title: 'Error',
							html: 'Data not found',
							icon: 'error',
							didClose: () => {
								window.location.href = "<?= site_url('inbound') ?>"
							},
						}).then((value) => {
							if (value.isConfirmed) {
								window.location.href = "<?= site_url('inbound') ?>"
							}
						})
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
			$("select[name=id_product]").select2({
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

		function init_select_product_status() {
			$("select[name=id_product_status]").select2({
				ajax: {
					url: "<?= site_url('product/get_ajax_data_select_product_status') ?>",
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
				placeholder: 'Select Product Status',
			});
		}

		function init_select_locator() {
			$("select[name=id_locator]").select2({
				ajax: {
					url: "<?= site_url('warehouse/get_ajax_data_select_locator') ?>",
					type: "POST",
					dataType: 'JSON',
					delay: 250,
					data: function(params) {
						return {
							searchTerm: params.term, // search term
							id_warehouse: data_asn == undefined ? 9999 : data_asn.id_warehouse,
						};
					},
					processResults: function(response) {
						return {
							results: response
						};
					},
					cache: true
				},
				placeholder: 'Select Locator',
			});
		}

		function row_detail(product_name = '', serial_number = '', box_id = '', est_inbound_qty = '', uom_name = '', locator = '', status = '') {
			return `
			<tr>
				<td style="width: 20%">` + product_name + `</td>
				<td style="width: 10%">` + serial_number + `</td>
				<td style="width: 10%">` + box_id + `</td>
				<td style="width: 15%">
					<input type="text" name="shipment_no" class="form-control form-control-sm" required>
				</td>
				<td style="width: 15%">
					<input type="text" name="site_id" class="form-control form-control-sm" required>
				</td>
				<td style="width: 10%">` + est_inbound_qty + `</td>
				<td style="width: 10%">
					<input type="number" step="0.01" name="qty_product" class="form-control form-control-sm" required>
				</td>
				<td style=" width: 5%">` + uom_name + `</td>
				<td style="width: 10%">
					` +
				(
					(locator == '' || locator == null) ? `<select name="id_locator" class="form-control form-control-sm" required></select>` : locator
				) +
				`
				</td>
				<td style="width: 10%">
				` +
				(
					(status == '' || status == null) ? `<select name="id_product_status" class="form-control form-control-sm" required></select>` : status
				) +
				`
				</td>
				<td style="width: 10%">
					<input name="note" class="form-control form-control-sm" style="width:100px" required>
				</td>
				<td style="width: 5%">
					<button type="button" class="btn btn-sm btn-primary btn-submit-detail mr-1 mb-1">SAVE</button>
					<button type="button" class="btn btn-sm btn-secondary btn-edit-detail mr-1 mb-1">EDIT</button>
				</td>
			</tr>
			`;
		}

		function submit_detail(data_post, index) {
			const data = $.ajax({
				url: "<?= site_url('inbound/save_inbound_detail') ?>",
				type: "POST",
				data: data_post,
				dataType: 'JSON',
				beforeSend: function(data) {
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
					// if (result.code == 200) {
					// 	Swal.fire({
					// 		title: 'Success',
					// 		html: result.message ?? 'Your data has been saved',
					// 		icon: 'success',
					// 	}).then((result) => {
					// 		$('button.btn-submit-detail').eq(index).hide();
					// 	});
					// } else {
					// 	Swal.fire({
					// 		title: 'Error',
					// 		html: result.message ?? 'Your data failed save.',
					// 		icon: 'error',
					// 	})
					// }
				},
				error: function() {
					Swal.close();
					// Swal.fire({
					// 	title: 'Error',
					// 	html: 'Save data failed',
					// 	icon: 'error',
					// });
				}
			});
			return data;

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
			$('#modal_edit input[name=id_warehouse]').val(data_asn.id_warehouse);
			$('#modal_edit input[name=id_project]').val(data_asn.id_project);
			$('#modal_edit input[name=asn_no]').val(data_asn.asn_no);
			$('#modal_edit input[name=inbound_date]').val(data_asn.inbound_date);
			$('#modal_edit input[name=est_inbound_date]').val(data_asn.est_inbound_date);
			$('#modal_edit input[name=po_no]').val(data_asn.po_no);
			$('#modal_edit input[name=no_container]').val(data_asn.no_container);
			$('#modal_edit input[name=truck_no]').val(data_asn.truck_no);
			$('#modal_edit input[name=driver_name]').val(data_asn.driver_name);
			$('#modal_edit input[name=driver_contact]').val(data_asn.driver_contact);
			$('#modal_edit input[name=id_user_tc]').val(data_asn.id_user_tc);
			$('#modal_edit input[name=id_user]').val(data_asn.id_user);
			$('#modal_edit input[name=attach_link]').val(data_asn.attach_link);

			var option = new Option(data_asn.supplier, data_asn.id_supplier);
			$('#modal_edit select[name=id_supplier]').append(option).trigger('change');

			var option = new Option(data_asn.vendor, data_asn.id_vendor);
			$('#modal_edit select[name=id_vendor]').append(option).trigger('change');

			var option = new Option(data_asn.mot, data_asn.id_mot);
			$('#modal_edit select[name=id_mot]').append(option).trigger('change');

			$('#modal_edit').modal('show');
		});

		$('button.btn-attachment').on('click', function() {
			$('#modal_attachment').modal('show');
		});

		$('button.btn-add-detail').on('click', function() {
			$('#modal_detail input[name=id]').val('');
			$('#modal_detail input[name=id_inbound]').val(data_asn.id);
			$('#modal_detail input[name=lot_number]').val('');
			$('#modal_detail input[name=box_id]').val('');
			$('#modal_detail input[name=shipment_no]').val('');
			$('#modal_detail input[name=site_id]').val('');
			$('#modal_detail input[name=qty_product]').val('');

			$('#modal_detail .modal-title').html('Edit Product');
			$('#modal_detail').modal('show');
		});

		$('button.btn-confirm').on('click', function() {
			const count_btn_submit = $('#tb_detail tbody tr button.btn-submit-detail:visible').length;

			if (count_btn_submit != 0) {
				Swal.fire({
					title: 'Error',
					html: 'Complete all products before confirm',
					icon: 'error',
				});
				return;
			}

			Swal.fire({
				title: 'Do you want to save the changes?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, confirm it!',
				allowOutsideClick: false,
			}).then((result) => {
				console.log(result);
				/* Read more about isConfirmed, isDenied below */
				if (result.value) {
					$.ajax({
						url: "<?= site_url('inbound/update_status_inbound') ?>",
						type: "POST",
						dataType: 'JSON',
						data: {
							id: data_asn.id,
							status: 3,
						},
						// cache: false,
						// contentType: false,
						// processData: false,
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

		$('button.btn-import-detail').on('click', function() {
			$('#modal_import input[name=id]').val(data_asn.id);
			$('#modal_import input[name=id_warehouse]').val(data_asn.id_warehouse);

			$('#modal_import .modal-title').html('Import Product');
			$('#modal_import').modal('show');
		});

		$('button.btn-excel').on('click', function() {
			var url = "<?= site_url('inbound/export_template_import_product_inbound') ?>";
			url += '?id_warehouse=' + data_asn.id_warehouse;
			window.open(url);
		});

		$(document).on('click', 'button.btn-submit-detail', function(e) {
			const row = $(this).parents("tr").first();
			const index = $(this).parents('tr').index();
			const data = row.find("input, select, select2").serializeArray();
			const data_detail = data_asn.inbound_product[index];
			const locator = $('select[name=id_locator]').val();
			const status = $('select[name=id_product_status]').val();

			let data_post = {};

			let validator = '';
			data.map(function(val) {
				if (val.value.length == 0 || val.value == '') {
					validator += val.name + ' is required<br>';
				} else {
					data_post[val.name] = val.value;
				}
			});

			if (status == undefined || status == null || status == "") {
				validator += 'status is required<br>';
			} else {
				data_post['id_product_status'] = status;
			}

			if (locator == undefined || locator == null || locator == "") {
				validator += 'locator is required<br>';
			} else {
				data_post['id_locator'] = status;
			}

			row.removeClass('bg-danger');

			if (validator !== '') {
				Swal.fire({
					title: 'Error',
					html: validator,
					icon: 'error',
				});
				row.addClass('bg-danger');
				return false;
			}

			data_post['id'] = data_detail.id;
			data_post['id_inbound'] = data_detail.id_inbound;
			data_post['id_product'] = data_detail.id_product;
			data_post['lot_number'] = data_detail.lot_number;
			data_post['box_id'] = data_detail.box_id;
			data_post['shipment_no'] = data_detail.shipment_no;

			Swal.fire({
				title: 'Do you want to save the changes?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, save it!',
				allowOutsideClick: false,
			}).then((result) => {
				if (result.isConfirmed) {
					$.when(submit_detail(data_post, index)).done((result) => {
						if (result.code == 200) {
							Swal.fire({
								title: 'Success',
								html: result.message ?? 'Your data has been saved',
								icon: 'success',
							}).then((result) => {
								$('button.btn-submit-detail').eq(index).hide();
							});
						} else {
							Swal.fire({
								title: 'Error',
								html: result.message ?? 'Your data failed save.',
								icon: 'error',
							})
						}
					});
				}
			});

			// submit_detail(data_post, index);
		});

		$(document).on('click', 'button.btn-edit-detail', function(e) {
			const row = $(this).parents("tr").first();
			const index = $(this).parents('tr').index();
			const data_detail = data_asn.inbound_product[index];

			let option = new Option(data_detail.product_name, data_detail.id_product);
			$('#modal_detail select[name=id_product]').append(option).change();

			option = new Option(data_detail.locator, data_detail.id_locator);
			$('#modal_detail select[name=id_locator]').append(option).change();

			option = new Option(data_detail.product_status, data_detail.id_product_status);
			$('#modal_detail select[name=id_product_status]').append(option).change();

			$('#modal_detail input[name=id]').val(data_detail.id);
			$('#modal_detail input[name=id_inbound]').val(data_asn.id);
			$('#modal_detail input[name=lot_number]').val(data_detail.lot_number);
			$('#modal_detail input[name=box_id]').val(data_detail.box_id);
			$('#modal_detail input[name=shipment_no]').val(data_detail.shipment_no);
			$('#modal_detail input[name=site_id]').val(data_detail.site_id);
			$('#modal_detail input[name=qty_product]').val(data_detail.qty_product);
			$('#modal_detail input[name=note]').val(data_detail.note);

			$('#modal_detail .modal-title').html('Edit Product');
			$('#modal_detail').modal('show');
		});

		$('#form_detail').on('submit', function(e) {
			e.preventDefault();
			const data = $('#form_detail').serializeArray();
			const id_detail = $('#form_detail input[name="id"]').val();
			let index = $('#tb_detail tbody tr').length;
			if (id_detail != '' && id_detail != undefined) {
				index = 0;
			}

			Swal.fire({
				title: 'Do you want to save the changes?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, save it!',
				allowOutsideClick: false,
			}).then((result) => {
				if (result.isConfirmed) {
					$.when(submit_detail(data, index)).done((result) => {
						if (result.code == 200) {
							$('#modal_detail').modal('hide');
							load_data(id);
						} else {
							Swal.fire({
								title: 'Error',
								html: result.message ?? 'Your data failed save.',
								icon: 'error',
							})
						}
					});
				}
			});
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
					var formData = new FormData($(this)[0]);
					//save form
					$.ajax({
						url: "<?= site_url('inbound/save_inbound_header') ?>",
						type: "POST",
						dataType: 'JSON',
						data: formData,
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
						url: "<?= site_url('inbound/save_upload_data_product_inbound') ?>",
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

		load_data(id);
	})
</script>