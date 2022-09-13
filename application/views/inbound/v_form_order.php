 <style>
 	.help-text {
 		display: block;
 	}
 </style>
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
 						<li class="breadcrumb-item active">Form Data</li>
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
 							Data Inbound
 						</div>
 						<form id="form_order" method="POST">
 							<div class="card-body">
 								<div class="row">
 									<!-- ROW -->
 									<div class="col-md-12">
 										<div class="row">
 											<div class="col-md-3">
 												<label>Inbound Date</label>
 												<input type="hidden" name="id" id="id">
 												<input type="date" name="inbound_date" id="inbound_date" class="form-control" min="<?= date('Y-m-1') ?>" autofocus required>
 											</div>
 											<div class="col-md-3">
 												<label>MTA Number</label>
 												<input type="text" name="po_no" id="po_no" class="form-control" title="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
 											</div>
 											<div class="col-md-3">
 												<label>Fabricator</label>
 												<select name="id_supplier" id="id_supplier" class="form-control" required></select>
 											</div>
 											<div class="col-md-3">
 												<label>Warehouse Destination</label>
 												<select name="id_warehouse" id="id_warehouse" class="form-control" required></select>
 											</div>
 											<!-- <div class="col-md-3">
                                                 <label>Shipment Number</label>
                                                 <input type="text" name="shipment_no" id="shipment_no" class="form-control">
                                             </div> -->
 										</div>
 									</div>
 									<!-- END ROW -->

 									<!-- ROW  -->
 									<div class="col-md-12 mt-3">
 										<div class="row">
 											<div class="col-md-3">
 												<label>Project</label>
 												<select name="id_project" id="id_project" class="form-control" required></select>
 											</div>
 											<div class="col-md-3">
 												<label>Vendor</label>
 												<select name="id_vendor" id="id_vendor" class="form-control" required></select>
 											</div>
 											<div class="col-md-3">
 												<label>No Container</label>
 												<input type="text" name="no_container" id="no_container" class="form-control" title="Only alphanumeric characters, - , . ,_ and @." pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150">
 											</div>
 											<div class="col-md-3">
 												<label>User</label>
 												<input type="hidden" id="id_user" name="id_user">
 												<input type="text" id="name_creator" name="name_creator" class="form-control-plaintext" readonly>
 											</div>
 										</div>
 									</div>


 									<div class="col-md-12 mt-3">
 										<div class="row">
 											<div class="col-md-3">
 												<label>MOT</label>
 												<select name="id_mot" id="id_mot" class="form-control" required></select>
 											</div>
 											<div class="col-md-3">
 												<label>Truck No</label>
 												<input type="text" name="truck_no" id="truck_no" class="form-control" title="Only alphanumeric characters." pattern="^[a-zA-Z0-9\s]+$" maxlength="20" minlength="4" required>
 											</div>
 											<div class="col-md-3">
 												<label>Driver Name</label>
 												<input type="text" name="driver_name" id="driver_name" class="form-control" title="Only characters." pattern="^[a-zA-Z\s]+$" minlength="2" maxlength="50" required>
 											</div>
 											<div class="col-md-3">
 												<label>Driver Contact</label>
 												<input type="text" name="driver_contact" id="driver_contact" class="form-control" title="Only alphanumeric." pattern="^[0-9]+$" minlength="9" maxlength="14" required>
 											</div>
 										</div>
 									</div>

 									<div class="col-md-12 mt-3">
 										<div class="table-responsive mt-1">
 											<table class="table" id="table_product">
 												<thead>
 													<tr>
 														<th style="width:30%">Product Name</th>
 														<th style="width:10%">Serial Number</th>
 														<th style="width:10%">Box Id</th>
 														<th style="width:10%">Shipment Number</th>
 														<th style="width:10%">Site Id</th>
 														<th style="width:10%">Qty</th>
 														<th style="width:5%">UoM</th>
 														<th style="width:5%">Locator</th>
 														<th style="width:10%">Status</th>
 														<th style="width:10%">note</th>
 														<!-- <th style="width:10%">Attachment</th> -->
 														<th></th>
 													</tr>
 												</thead>
 												<tbody></tbody>
 											</table>
 										</div>
 									</div>

 									<div class="col-md-12 mt-3">
 										<div class="row">
 											<div class="col-md-3">
 												<div class="form-group">
 													<label>Shipment Document</label>
 													<span class="help-text">Biarkan kosong, jika tidak ingin mengganti</span>
 													<input type="file" name="photo_sj" id="photo_sj" class="form-control">
 												</div>
 											</div>
 											<div class="col-md-3">
 												<div class="form-group">
 													<label>Truck Photo</label>
 													<span class="help-text">Biarkan kosong, jika tidak ingin mengganti</span>
 													<input type="file" name="photo_truck" id="photo_truck" class="form-control">
 												</div>
 											</div>
 											<div class="col-md-3">
 												<div class="form-group">
 													<label>Link Document</label>
 													<input type="text" name="link_attach" id="link_attach" class="form-control">
 												</div>
 											</div>
 										</div>
 									</div>

 									<!-- END ROW -->
 								</div>
 							</div>
 							<div class="card-footer">
 								<div class="row">
 									<div class="col-md-1">
 										<div class="form-group">
 											<input type="number" name="num_row" id="num_row" min="1" max="20" value="1" class="form-control">
 										</div>
 									</div>
 									<div class="col-md-4">
 										<div class="form-group">
 											<button type="button" class="btn btn-primary btn-add-product">
 												<i class="fa fa-plus"> </i> Add
 											</button>
 											<button type="button" class="btn btn-primary btn-import-product">
 												<i class="fa fa-file-excel"> </i> Import
 											</button>
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
 			</div>
 		</div>
 	</section>
 </div>

 <!-- Modal -->
 <form id="form_upload" method="POST" enctype="multipart/form-data">
 	<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog">
 		<div class="modal-dialog" role="document">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h5 class="modal-title">Upload Template</h5>
 					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 						<span aria-hidden="true">&times;</span>
 					</button>
 				</div>
 				<div class="modal-body">
 					<div class="row">
 						<div class="col-md-12">
 							<div class="form-group">
 								<label>Download Template</label>
 								<a href="#" class="btn btn-success d-block d-excel">
 									<i class="fa fa-download"></i> Download Excel
 								</a>
 							</div>
 						</div>
 						<div class="col-md-12">
 							<div class="form-group">
 								<label>Template File</label>
 								<div class="input-group">
 									<div class="custom-file">
 										<input type="file" class="custom-file-input" id="file_template" name="file_template" required>
 										<label class="custom-file-label" for="file_template">Choose file</label>
 									</div>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 					<button type="submit" class="btn btn-primary">Save</button>
 				</div>
 			</div>
 		</div>
 	</div>
 </form>
 <!-- End Modal -->

 <script>
 	$(document).ready(function() {
 		var id_karyawan = "<?= $id_user ?>";
 		var nama_karyawan = "<?= $name_user ?>";
 		var id = "<?= $id ?>";
 		var mode = "<?= $mode ?>";
 		var id_trash = [];

 		if (id == '') {
 			$('[name=id_user_created]').val(id_karyawan);
 			$('[name=name_creator]').val(nama_karyawan);
 			$('.help-text').hide();
 		} else {

 		}

 		function get_info(id = '') {
 			$.ajax({
 				url: "<?= site_url('inbound/info_order') ?>",
 				data: {
 					id: id
 				},
 				type: 'GET',
 				beforeSend: function() {},
 				success: function(result) {
 					if (result) {
 						try {
 							result = JSON.parse(result);

 							if (result.code == 200) {
 								//header
 								var header = result.header;

 								$('[name=id]').val(header['id']).change();
 								$('[name=inbound_no]').val(header['inbound_no']).change();
 								$('[name=inbound_date]').val(header['inbound_date']).change();
 								$('[name=po_no]').val(header['po_no']).change();
 								//  $('[name=shipment_no]').val(header['shipment_no']).change();
 								$('[name=truck_no]').val(header['truck_no']).change();
 								$('[name=driver_name]').val(header['driver_name']).change();
 								$('[name=driver_contact]').val(header['driver_contact']).change();
 								$('[name=id_user]').val(header['id_user']).change();
 								$('[name=name_creator]').val(header['name_creator']).change();

 								//   var option = new Option(header['origin'], header['id_origin'], true, true);
 								//   $('#id_origin').append(option).trigger('change');
 								var option = new Option(header['warehouse'], header['id_warehouse'], true, true);
 								$('#id_warehouse').append(option).trigger('change');
 								if (header['id_supplier'] != null) {
 									var option = new Option(header['supplier'], header['id_supplier'], true, true);
 									$('#id_supplier').append(option).trigger('change');
 								}
 								if (header['id_mot'] != null) {
 									var option = new Option(header['mot'], header['id_mot'], true, true);
 									$('#id_mot').append(option).trigger('change');
 								}
 								if (header['id_project'] != null) {
 									var option = new Option(header['project_name'], header['id_project'], true, true);
 									$('#id_project').append(option).trigger('change');
 								}

 								$('[name=inbound_date]').prop('min', header['inbound_date']).change();

 								var body = result.body;

 								$.each(body, function(i, d) {
 									add_row();
 									$('[name="id_detail[]"').eq(i).val(d.id);
 									$('[name="lot_number[]"').eq(i).val(d.lot_number);
 									var option = new Option(d.code + ' ' + d.product, d.id_product, true, true);
 									$('[name="id_product[]"').eq(i).append(option).trigger('change');
 									$('[name="shipment_no[]"').eq(i).val(d.shipment_no);

 									var data = $('[name="id_product[]"').eq(i).select2('data')[0];
 									data['uom'] = d.uom;
 									$('[name="qty[]"').eq(i).val(d.qty_product);
 									$('[name="uom_product[]"').eq(i).val(d.uom);

 									//locator
 									if (d.id_locator != null) {
 										var option = new Option(d.locator, d.id_locator, true, true);
 										$('[name="id_locator[]"').eq(i).append(option).trigger('change');
 									}

 									//locator
 									if (d.id_product_status != null) {
 										var option = new Option(d.product_status, d.id_product_status, true, true);
 										$('[name="id_product_status[]"').eq(i).append(option).trigger('change');
 									}

 									$('[name="photo[]"]').eq(i).prop('required', false);
 								})

 								$('[name=photo_sj]').prop('required', false);
 								$('[name=photo_truck]').prop('required', false);
 								$('.help-text').show();
 								init_select_product();
 								init_select_product_status();
 							} else {

 							}
 						} catch (e) {
 							console.log(e);
 							Swal.fire(result, '', 'error')
 						}
 					}
 				},
 				error: function(xhr, ajaxOptions, thrownError) {
 					alert(xhr.status + " : " + thrownError);
 				}
 			})
 		}

 		function init_select_product() {
 			$("[name='id_product[]'").select2({
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
 			$("[name='id_product_status[]'").select2({
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
 			$("[name='id_locator[]'").select2({
 				ajax: {
 					url: "<?= site_url('warehouse/get_ajax_data_select_locator') ?>",
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
 				placeholder: 'Select Locator',
 			});
 		}

 		function add_row() {
 			var _tr = '<tr>';
 			_tr += '<td><select style="width:300px" name="id_product[]" class="form-control select2" required></select></td>';
 			_tr += '<td><input style="width:150px" type="text" name="lot_number[]" class="form-control" required></td>';
 			_tr += '<td><input style="width:150px" type="text" name="box_id[]" class="form-control" required></td>';
 			_tr += '<td><input style="width:300px" type="text" name="shipment_no[]" class="form-control" required></td>';
 			_tr += '<td><input style="width:300px" type="text" name="site_id[]" class="form-control" required></td>';
 			_tr += '<td><input style="width:80px" type="number" step="0.01" name="qty[]" class="form-control" required></td>';
 			_tr += '<td><input style="width:50px" name="uom_product[]" class="form-control-plaintext" readonly></td>';
 			_tr += '<td><select style="width:60px" name="id_locator[]" class="form-control" required></select></td>';
 			_tr += '<td><select style="width:80px" name="id_product_status[]" class="form-control select2" required></select></td>';
 			_tr += '<td><input style="width:300px" type="text" name="note[]" class="form-control"></td>';
 			//_tr += '<td><input type="file" name="photo[]" class="form-control" required></td>';
 			_tr += `<td style="width:20px">
              <input type="hidden" name="id_detail[]" value="0">
              <button type="button" class="btn btn-danger btn-trash"><i class="fa fa-trash"></i></button>
              </td>`;
 			_tr += '</tr>';

 			$('#table_product tbody').append(_tr);
 			init_select_product();
 			init_select_product_status();
 			init_select_locator();
 		}

 		function lock_warehouse() {
 			$('[name=id_warehouse]').prop('disabled', true);
 		}

 		function unlock_warehouse() {
 			$('[name=id_warehouse]').prop('disabled', false);
 		}

 		function save_form(formData) {
 			$.ajax({
 				url: "<?= site_url('inbound/save_order') ?>",
 				data: formData,
 				processData: false,
 				contentType: false,
 				async: false,
 				cache: false,
 				enctype: 'multipart/form-data',
 				type: 'POST',
 				beforeSend: function() {
 					$('button[type=submit]').prop('disabled', true);
 					$('#loader').removeClass('hidden');
 				},
 				success: function(result) {
 					if (result) {
 						try {
 							result = JSON.parse(result);
 							if (result.code == 200) {

 								if (mode == 'add') {
 									Swal.fire({
 										title: 'Inbound Number : ' + result.data.inbound_no,
 										confirmButtonText: `OK`,
 										allowOutsideClick: false,
 										allowEscapeKey: false,
 										icon: 'success'
 									}).then((result) => {
 										/* Read more about isConfirmed, isDenied below */
 										if (result.isConfirmed) {
 											location.reload();
 										}
 									})
 								} else {
 									Swal.fire({
 										title: result.message,
 										icon: 'succes',
 										timer: 500,
 									}).then(function() {
 										window.location.href = "<?= site_url('inbound') ?>"
 									})
 								}
 							} else {
 								Swal.fire(result.message, '', 'info')
 							}
 						} catch (e) {
 							console.log(e);
 							Swal.fire(result, '', 'error');
 						}
 					}
 				},
 				complete: function() {
 					$('#loader').addClass('hidden');
 					$('button[type=submit]').prop('disabled', false);
 				},
 				error: function(xhr, ajaxOptions, thrownError) {
 					console.log(xhr.status + ' : ' + thrownError);
 					Swal.fire(xhr.status + ' : ' + thrownError, '', 'error');
 					$('button[type=submit]').prop('disabled', false);
 				}
 			})
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

 		$('.btn-add-product').on('click', function() {
 			var origin = $('#id_origin').val();
 			var warehouse = $('#id_warehouse').val();
 			//origin = origin == null ? '' : origin;
 			warehouse = warehouse == null ? '' : warehouse;
 			var num_row = $('[name=num_row]').val();

 			if (warehouse == '') {
 				toastr.error('Select Warehouse First!');
 			} else if (num_row == 0) {
 				toastr.error('Minimum 1 row!');
 				$('[name=num_row]').focus();
 			} else {
 				for (let index = 0; index < num_row; index++) {
 					add_row();
 				}
 				lock_warehouse();
 				//init_select_locator();
 			}
 		})

 		$('#table_product').on('click', '.btn-trash', function() {
 			var index = $(this).parent().parent().index();
 			var id_detail = $('[name="id_detail[]"]').eq(index).val();
 			id_trash.push(id_detail);

 			$(this).parent().parent().remove();
 			var row = $('#table_product tbody tr').length;
 			if (row == 0) {
 				unlock_warehouse();
 			}
 		})

 		$(document).on('change', "[name='id_product[]']", function() {
 			var index = $(this).parent().parent().index();
 			var data = $(this).select2('data')[0];
 			$("[name='uom_product[]']").eq(index).val(data['uom']).change();
 		})

 		$(document).on('change', 'input[type=file]', function() {
 			var filePath = $(this).val();
 			var allowedExtensions = /(\.pdf|\.doc|\.jpg|\.png|\.docx|\.jpeg|\.msg|\.xls|\.xlsx|\.htm|\.html)$/i;
 			if (!allowedExtensions.exec(filePath)) {
 				alert('Please upload file having extensions .jpeg/.jpg/.png/.pdf/.doc/.msg/.xls/.html only.');
 				$(this).val('');
 				return false;
 			}
 		});

 		$('#form_order').on('submit', function(e) {
 			e.preventDefault();

 			var row = $('#table_product tbody tr').length;
 			if (row == 0) {
 				Swal.fire({
 					'title': 'Mohon mengisi tabel.'
 				});
 				return false;
 			}

 			Swal.fire({
 				title: 'Do you want to save the changes?',
 				showCancelButton: true,
 				confirmButtonText: `Save`,
 				allowOutsideClick: false,
 			}).then((result) => {
 				/* Read more about isConfirmed, isDenied below */
 				if (result.isConfirmed) {
 					//check table length
 					var row = $('#table_product tbody tr').length;
 					if (row == 0) {
 						Swal.fire('Please fill product table', '', 'info');
 					} else {
 						//save form
 						unlock_warehouse();
 						var formdata = new FormData($(this)[0]);
 						formdata.append('id_trash', id_trash);
 						save_form(formdata);
 					}
 				}
 			})
 		})

 		$('.btn-import-product').on('click', function() {
 			var id_warehouse = $('#id_warehouse').val();
 			if (id_warehouse != '' && id_warehouse != null) {
 				$('#modal_upload').modal();
 			} else {
 				alert('Pilih warehouse terlebih dahulu')
 			}
 		})

 		$('.d-excel').on('click', function() {
 			var id_warehouse = $('#id_warehouse').val();
 			window.open("<?= site_url('inbound/export_template_import_product_inbound') ?>" + "?id_warehouse=" + id_warehouse);
 		})

 		if (mode == 'edit') {
 			get_info(id);
 		}

 		$('#form_upload').on('submit', function(e) {
 			e.preventDefault();

 			var formData = new FormData($(this)[0]);
 			formData.append('id_warehouse', $('#id_warehouse').val())
 			$.ajax({
 				url: "<?= site_url('inbound/save_upload_data_product_inbound') ?>",
 				data: formData,
 				processData: false,
 				contentType: false,
 				async: false,
 				cache: false,
 				enctype: 'multipart/form-data',
 				type: 'POST',
 				beforeSend: function() {
 					$('#loader').removeClass('hidden');
 					$("button[type=submit]").prop("disabled", true);
 				},
 				success: function(result) {
 					if (result) {
 						try {
 							result = JSON.parse(result);
 							if (result.message != '') {
 								$('#modal_notif .modal-body').html(result.message);
 								$('#modal_notif').modal();
 							}
 							console.log(result.data_i);
 							$.each(result.data_i, function(i, d) {
 								add_row();
 								var option = new Option(d.code_product + ' ' + d.product, d.id_product, true, true);
 								$('[name="id_product[]"').eq(i).append(option).trigger('change');

 								var data = $('[name="id_product[]"').eq(i).select2('data')[0];
 								data['uom'] = d.uom;
 								$('[name="qty[]"').eq(i).val(d.qty);
 								$('[name="uom_product[]"').eq(i).val(d.uom);
 								$('[name="lot_number[]"').eq(i).val(d.lot_number);
 								$('[name="shipment_no[]"').eq(i).val(d.shipment_no);
 								$('[name="site_id[]"').eq(i).val(d.site_id);
 								$('[name="note[]"').eq(i).val(d.note);
 								$('[name="box_id[]"').eq(i).val(d.box_id);


 								//locator
 								if (d.id_locator != null) {
 									var option = new Option(d.locator, d.id_locator, true, true);
 									$('[name="id_locator[]"').eq(i).append(option).trigger('change');
 								}

 								//locator
 								if (d.id_product_status != null) {
 									var option = new Option(d.product_status, d.id_product_status, true, true);
 									$('[name="id_product_status[]"').eq(i).append(option).trigger('change');
 								}

 							})
 							$('#modal_upload').modal('hide');

 							lock_warehouse();
 						} catch (e) {
 							console.log(e);
 						}
 					}
 					$("button[type=submit]").prop("disabled", false);
 				},
 				complete: function() {
 					$('#loader').addClass('hidden');
 					$('button[type=submit]').prop('disabled', false);
 				},
 				error: function(e, s, x) {
 					//$("#result").text(e.responseText);
 					console.log(e.status);
 					alert("ERROR : " + e.responseText + " " + x);
 					$("button[type=submit]").prop("disabled", false);
 				}
 			})
 		})
 	})
 	var url = "<?= base_url() ?>";
 	var url1 = "<?= $this->uri->segment(1, ''); ?>";
 	var url2 = "<?= $this->uri->segment(2, ''); ?>";
 	var url3 = "<?= $this->uri->segment(3, ''); ?>";
 	if (url1 != '') {
 		url += url1;
 	}
 	if (url2 != '') {
 		url += '/' + url2;
 	}
 	if (url3 != '') {
 		url += '/' + url3;
 	}
 </script>
