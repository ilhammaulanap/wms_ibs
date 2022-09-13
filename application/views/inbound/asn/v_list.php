  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<div class="content-header">
  		<div class="container-fluid">
  			<div class="row mb-2">
  				<div class="col-sm-6">
  					<!-- <h1 class="m-0 text-dark">Inbound</h1> -->
  				</div><!-- /.col -->
  				<div class="col-sm-6">
  					<ol class="breadcrumb float-sm-right">
  						<li class="breadcrumb-item"><a href="#">ASN</a></li>
  						<li class="breadcrumb-item active">List ASN</li>
  					</ol>
  				</div>
  			</div><!-- /.row -->
  		</div><!-- /.container-fluid -->
  	</div>
  	<!-- /.content-header -->

  	<!-- Main content -->
  	<section class="content">
  		<div class="container-fluid">
  			<div class="row">
  				<div class="col-md-12">
  					<div class="card card-primary">
  						<div class="card-header">
  							Manage Data ASN
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-2">
  									<div class="form-group">
  										<label>Start Date</label>
  										<input type="date" name="est_inbound_date1" class="form-control form-control-sm" value="<?= date('Y-m-01') ?>">
  									</div>
  								</div>
  								<div class="col-md-2">
  									<div class="form-group">
  										<label>End Date</label>
  										<input type="date" name="est_inbound_date2" class="form-control form-control-sm" value="<?= date('Y-m-t') ?>">
  									</div>
  								</div>
  								<div class="col-md-3">
  									<div class="form-group">
  										<label>Warehouse</label>
  										<select name="select_warehouse" class="form-control form-control-sm"></select>
  									</div>
  								</div>
  								<div class="col-md-12 table-responsive">
  									<table class="table table-sm table-striped" style="width: 100%;" id="tb_asn">
  										<thead>
  											<tr>
  												<th>ACTION</th>
  												<th>ASN NUMBER</th>
  												<th>EST INBOUND DATE</th>
  												<th>MTA NUMBER</th>
  												<th>FABRICATOR</th>
  												<th>DRIVER NAME</th>
  												<th>DRIVER CONTACT</th>
  												<th>MOT TYPE</th>
  												<th>MOT NUMBER</th>
  												<th>CONTAINER NUMBER</th>
  												<th>PRODUCT</th>
  											</tr>
  										</thead>
  										<tbody></tbody>
  									</table>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</section>
  </div>

  <div class="modal fade" id="modal_product" tabindex="-1" role="dialog" aria-labelledby="modal_product_label" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title" id="modal_product_label">Modal title</h5>
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>
  			<div class="modal-body">
  				<div class="col-md-12 table-responsive">
  					<table class="table table-striped table-sm text-center" id="tb_detail" style="width: 100%">
  						<thead>
  							<tr>
  								<th style="width: 25%">Product Name</th>
  								<th style="width: 10%">Serial Number</th>
  								<th style="width: 10%">Box Id</th>
  								<th style="width: 10%">Shipment Number</th>
  								<th style="width: 10%">Qty</th>
  								<th style="width: 5%">UoM</th>
  							</tr>
  						</thead>
  						<tbody></tbody>
  					</table>
  				</div>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  			</div>
  		</div>
  	</div>
  </div>

  <script>
  	$(document).ready(function() {
  		let id_user = "<?= $this->session->userdata('wh_id') ?>";
  		let level_user = "<?= $this->session->userdata('wh_level') ?>";

  		let table = $('#tb_asn').DataTable({
  			ajax: {
  				url: "<?= site_url('inbound/get_asn') ?>",
  				type: "GET",
  				data: function(d) {
  					d.est_inbound_date1 = $('input[name=est_inbound_date1]').val();
  					d.est_inbound_date2 = $('input[name=est_inbound_date2]').val();
  					d.id_warehouse = $('select[name=select_warehouse]').val();
  					d.id_user_tc = level_user == '1' ? '' : id_user;
  					d.status = 1;
  				}
  			},
  			order: [],
  			// scrollX: true,
  			// scrollCollapse: true,
  			columns: [{
  					data: 'id',
  					render: function(data, type, row) {
  						return `
						<div class="btn-group">
							<button type="button" class="btn btn-primary btn-sm">Action</button>
							<button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<button class="dropdown-item btn-sm btn-edit"><i class="fa fa-edit"></i> Edit</button>
								<button class="dropdown-item btn-sm btn-delete"><i class="fa fa-trash"></i> Delete</button>
								<button class="dropdown-item btn-sm btn-create-inbound"><i class="fa fa-file"></i> Create Inbound</button>
							</div>
						</div>
						`;
  					}
  				},
  				{
  					data: 'asn_no',
  				},
  				{
  					data: 'est_inbound_date',
  				},
  				{
  					data: 'po_no',
  				},
  				{
  					data: 'supplier',
  				},
  				{
  					data: 'driver_name',
  				},
  				{
  					data: 'driver_contact',
  				},
  				{
  					data: 'mot',
  				},
  				{
  					data: 'truck_no',
  				},
  				{
  					data: 'no_container',
  				},
  				{
  					data: 'total_product',
  					render: function(data, type, row) {
  						return '<button type="button" class="btn btn-sm btn-primary btn-total">' + data + '</button>';
  					}
  				},
  			],
  			dom: 'Bfrtip',
  			buttons: [
  				'pageLength',
  				// 'excel',
  				{
  					text: 'Refresh',
  					action: function(e, dt, node, config) {
  						table.ajax.reload();
  					}
  				}
  			],
  		});

  		function row_detail(name_product = '0', serial_number = '', box_id = '', shipment_no = '', qty = '', uom = '') {
  			let html = '';
  			html += '<tr>';
  			html += '<td>' + name_product + '</td>';
  			html += '<td>' + serial_number + '</td>';
  			html += '<td>' + box_id + '</td>';
  			html += '<td>' + shipment_no + '</td>';
  			html += '<td>' + qty + '</td>';
  			html += '<td>' + uom + '</td>';
  			html += '</tr>';
  			return html;
  		}

  		$("select[name='select_warehouse']").select2({
  			ajax: {
  				url: "<?= site_url('inbound/get_ajax_data_select_wh') ?>",
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

  		$('#tb_asn').on('click', 'button.btn-edit', function() {
  			const data = table.row($(this).parents('tr')).data();
  			if (data.inbound_no == '' || data.inbound_no == null) {
  				window.open("<?= site_url('inbound/update_asn/') ?>" + data.id);
  			} else {
  				Swal.fire({
  					title: 'Error',
  					text: 'ASN already have inbound, cannot edit.',
  					icon: 'error',
  				})
  			}
  		});

  		$('#tb_asn').on('click', 'button.btn-delete', function() {
  			const data = table.row($(this).parents('tr')).data();
  			if (data.inbound_no == '' || data.inbound_no == null) {
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
  							url: "<?= site_url('inbound/delete_asn') ?>",
  							type: "POST",
  							data: {
  								id: data.id,
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
  											table.ajax.reload();
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
  			} else {
  				Swal.fire({
  					title: 'Error',
  					text: 'ASN already have inbound, cannot delete.',
  					icon: 'error',
  				})
  			}
  		});

  		$('#tb_asn').on('click', 'button.btn-total', function() {
  			const data = table.row($(this).parents('tr')).data();
  			$.ajax({
  				url: "<?= site_url('inbound/get_asn_detail') ?>",
  				type: "GET",
  				data: {
  					id: data.id,
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
  						let data_asn = result.data;
  						$('#tb_detail tbody').html('');
  						data_asn.inbound_product.map((item, index) => {
  							const row = row_detail(item.product_name, item.lot_number, item.box_id, item.shipment_no, item.est_qty_product, item.uom_name);
  							$('#tb_detail tbody').append(row);
  						})
  						$('#modal_product .modal-title').html('Detail Product');
  						$('#modal_product').modal('show');
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
  			});
  		});

  		$('#tb_asn').on('click', 'button.btn-create-inbound', function() {
  			const data = table.row($(this).parents('tr')).data();
  			if (data.inbound_no == '' || data.inbound_no == null) {
  				window.open("<?= site_url('inbound/create_inbound_asn/') ?>" + data.id);
  			} else {
  				window.open("<?= site_url('inbound/edit/') ?>" + data.id);
  				// Swal.fire({
  				// 	title: 'Error',
  				// 	text: 'ASN already have inbound.',
  				// 	icon: 'error',
  				// })
  			}
  		});
  	});
  </script>