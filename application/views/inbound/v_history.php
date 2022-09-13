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
  						<li class="breadcrumb-item"><a href="#">Inbound</a></li>
  						<li class="breadcrumb-item active">History Inbound</li>
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
  							Manage Data Inbound
  						</div>
  						<div class="card-body">
  							<div class="row">
  								<div class="col-md-3">
  									<div class="form-group">
  										<label>Inbound Date:</label>

  										<div class="input-group">
  											<div class="input-group-prepend">
  												<span class="input-group-text">
  													<i class="far fa-calendar-alt"></i>
  												</span>
  											</div>
  											<input type="text" class="form-control float-right" id="reservation">
  										</div>
  										<!-- /.input group -->
  									</div>
  								</div>
  								<div class="col-md-3">
  									<label>Warehouse</label>
  									<select name="id_warehouse" id="id_warehouse" class="form-control select2"></select>
  								</div>
  								<div class="col-md-3">
  									<label>Project</label>
  									<select name="id_project" id="id_project" class="form-control select2"></select>
  								</div>
  								<div class="col-md-3">
  									<label>Product</label>
  									<select name="id_product" id="id_product" class="form-control select2"></select>
  								</div>
  								<div class="col-md-3">
  									<label>Locator</label>
  									<select name="id_locator" id="id_locator" class="form-control select2"></select>
  								</div>
  								<div class="col-md-12 mt-2">
  									<table class="table" style="width: 100%;" id="table_inbound">
  										<thead>
  											<tr>
  												<th>INBOUND NUMBER</th>
  												<th>INBOUND DATE</th>
  												<th>PROJECT</th>
  												<th>MTO NUMBER</th>
  												<th>SHIPMENT NUMBER</th>
  												<!-- <th>PRODUCT CODE</th>
                                                  <th>DESCRIPTION</th> -->
  												<!-- <th>SERIAL NUMBER</th> -->
  												<th>QTY</th>
  												<!-- <th>UOM</th> -->
  												<th>INBOUND STATUS</th>
  												<th>LOCATOR</th>
  												<th>FABRICATOR</th>
  												<th>VENDOR</th>
  												<th>DRIVER NAME</th>
  												<th>DRIVER CONTACT</th>
  												<th>MOT TYPE</th>
  												<th>TRUCK NUMBER</th>
  												<th>CONTAINER NUMBER</th>
  												<th>SCAN DN</th>
  												<th>LINK DOCUMENT</th>
  												<th>MOT PHOTO</th>
  											</tr>
  										</thead>
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

  <!-- Modal  -->
  <div class="modal fade" id="modal_history_outbound" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-lg" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title" id="exampleModalLabel">Product details</h5>
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>
  			<div class="modal-body">
  				<div class="row">
  					<div class="col-md-12">
  						<div class="table-responsive mt-1">
  							<table class="table" id="tb_out">
  								<thead>
  									<tr>
  										<th>Inbound No</th>
  										<th>Inbound Date</th>
  										<th>Product Code</th>
  										<th>Product Group Code</th>
  										<th>Product Name</th>
  										<th>Serial Number</th>
  										<th>Box ID</th>
  										<th>Shipment No</th>
  										<th>Site Id</th>
  										<th>Qty</th>
  										<th>Note</th>

  										<!-- <th>Outbound Status</th> -->
  									</tr>
  								</thead>
  								<tbody></tbody>
  							</table>
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  			</div>
  		</div>
  	</div>
  </div>
  <!-- End Modal -->

  <script>
  	$(document).ready(function() {

  		var startDate = moment().subtract('days', 180);
  		var endDate = moment();
  		var status_outbound = ['On Preparation', 'Ready to Pick Up', 'Delivered', 'Back to Stock'];
  		var table = $('#table_inbound').DataTable({
  			ajax: {
  				url: "<?= site_url('inbound/get_inbound_history') ?>",
  				type: 'POST',
  				data: function(d) {
  					d.date1 = startDate.format('YYYY-MM-DD');
  					d.date2 = endDate.format('YYYY-MM-DD');
  					d.id_warehouse = $('#id_warehouse').val();
  					d.id_product = $('#id_product').val();
  					d.id_locator = $('#id_locator').val();
  					d.id_project = $('#id_project').val();
  				},
  			},
  			order: [],
  			responsive: true,
  			//   autoWidth: false,
  			//   scrollX: true,
  			scollCollapse: true,
  			dom: 'Bfrtip',
  			lengthMenu: [
  				[10, 25, 50, -1],
  				['10 rows', '25 rows', '50 rows', 'Show all']
  			],
  			buttons: [
  				'pageLength',
  				'excel',
  				{
  					text: 'Refresh',
  					action: function(e, dt, node, config) {
  						table.ajax.reload();
  					}
  				}
  			],
  			columns: [{
  					data: 'inbound_no'
  				},
  				{
  					data: 'inbound_date'
  				},
  				{
  					data: 'project_name'
  				},
  				{
  					data: 'po_no',
  					width: '80px'
  				},
  				{
  					data: 'shipment_no',
  					width: '80px'
  				},
  				//   {
  				//       data: 'code'
  				//   },
  				//   {
  				//       data: 'product'
  				//   },
  				//   {
  				//       data: 'lot_number'
  				//   },
  				{
  					data: 'total_qty_product',
  					render: function(data, type, row) {
  						var btn = '<button type="button" class="btn btn-primary btn-sm btn-qty">' + row['total_qty_product'] + '</button>';
  						return btn;
  					}
  				},
  				//   {
  				//       data: 'uom'
  				//   },
  				{
  					data: 'product_status'
  				},
  				{
  					data: 'locator'
  				},
  				{
  					data: 'supplier'
  				},
  				{
  					data: 'vendor'
  				},
  				{
  					data: 'driver_name'
  				},
  				{
  					data: 'driver_contact'
  				},
  				{
  					data: 'mot'
  				},
  				{
  					data: 'truck_no'
  				},
  				{
  					data: 'no_container'
  				},
  				{
  					data: 'photo_sj',
  					render: function(data, type, row) {
  						return '<a target="_blank" href="<?= base_url('files/suratjalan/') ?>' + data + '">' + data + '</a>';
  					}
  				},
  				{
  					data: 'link_attach',
  					render: function(data, type, row) {
  						url_doc = decodeURIComponent(data);
  						// return '<p>' + url_doc + '</p>'
  						if (url_doc == null || url_doc === '' || url_doc === 'null') {
  							return '<p>No Data</p>'
  						} else {
  							return '<a target="_blank" href="' + url_doc + '"> Link</a>';
  						}

  					}
  				},
  				{
  					data: 'photo_truck',
  					render: function(data, type, row) {
  						return '<a target="_blank" href="<?= base_url('files/truck/') ?>' + data + '">' + data + '</a>';
  					}
  				},

  			]
  		})

  		function add_rows(inbound_no = '', inbound_date = '', code = '', name = '', shipment_no = '', qty_product = '', site_id = '', category = '', note = '', lot_number = '', box_id = '') {
  			var tr = "<tr>";
  			tr += '<td>' + inbound_no + '</td>';
  			tr += '<td>' + inbound_date + '</td>';
  			tr += '<td>' + code + '</td>';
  			tr += '<td>' + category + '</td>';
  			tr += '<td>' + name + '</td>';
  			tr += '<td>' + lot_number + '</td>';
  			if (box_id == null || box_id === '' || box_id === 'null') {
  				tr += '<td></td>';
  			} else {
  				tr += '<td>' + box_id + '</td>';
  			}

  			tr += '<td>' + shipment_no + '</td>';
  			tr += '<td>' + site_id + '</td>';
  			tr += '<td>' + qty_product + '</td>';
  			tr += '<td>' + note + '</td>';

  			tr += "</tr>";
  			$('#tb_out tbody').append(tr);
  		}

  		//Date range picker
  		$('#reservation').daterangepicker({
  				startDate: startDate,
  				endDate: endDate,
  				minDate: '01/01/2021',
  				maxDate: moment(),
  				//   dateLimit: {
  				//       days: 60
  				//   },
  				showDropdowns: true,
  				showWeekNumbers: true,
  			},
  			function(start, end) {
  				console.log("Callback has been called!");
  				//$('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
  				startDate = start;
  				endDate = end;
  				table.ajax.reload();
  			}
  		);

  		$("[name='id_warehouse']").select2({
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

  		$("[name='id_project']").select2({
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
  			allowClear: true,
  			placeholder: 'All Project',
  		});

  		$('[name=id_warehouse], [name=id_locator], [name=id_product], [name=id_project]').on('change', function() {
  			table.ajax.reload();
  			table.columns.adjust();
  		})

  		$("[name='id_product']").select2({
  			ajax: {
  				url: "<?= site_url('inbound/get_ajax_data_select_product') ?>",
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
  			allowClear: true,
  			placeholder: 'Search Product',
  		});

  		$("[name='id_locator']").select2({
  			ajax: {
  				url: "<?= site_url('inbound/get_ajax_data_select_locator') ?>",
  				type: "POST",
  				dataType: 'JSON',
  				delay: 250,
  				data: function(params) {
  					return {
  						searchTerm: params.term, // search term
  						id_product: $('[name=id_product]').val(),
  					};
  				},
  				processResults: function(response) {
  					return {
  						results: response
  					};
  				},
  				cache: true
  			},
  			allowClear: true,
  			placeholder: 'Search Locator',
  		});
  		//   var datatable =  $('#tb_out').DataTable({
  		//                         dom: 'Bfrtip',
  		//                         buttons: [
  		//                             'excel'
  		//                         ],
  		//                       });
  		$('#table_inbound').on('click', '.btn-qty', function() {
  			var data = table.row($(this).parent().parent()).data();
  			//   console.log(data);
  			$.ajax({
  				url: "<?= site_url('inbound/get_inbound_history_single') ?>",
  				data: {
  					id: data['id']
  				},
  				type: "POST",
  				beforeSend: function() {
  					// var datatable = $('#tb_out');
  					// //   console.log(datatable); 
  					// datatable.destroy();
  					//     $('#tb_out').empty();
  					// $('#tb_out tbody').destroy();
  					//   datatable.clear().draw();
  					$('#tb_out').dataTable().fnClearTable();
  					$('#tb_out').dataTable().fnDestroy();
  					$('#tb_out tbody').html('');
  				},
  				success: function(result) {
  					if (result) {
  						try {
  							result = JSON.parse(result);
  							//   var datatable = $('#tb_out');
  							//   datatable.destroy();
  							//   $('#tb_out').empty();
  							// var datatable = $('#tb_out');
  							$.each(result, function(i, d) {
  								add_rows(d.inbound_no, d.inbound_date, d.code, d.name, d.shipment_no, d.qty_product, d.site_id, d.category, d.note, d.lot_number, d.box_id)
  							})

  							$('#modal_history_outbound').modal();
  							var datatable = $('#tb_out').DataTable({
  								dom: 'Bfrtip',
  								buttons: [
  									'excel'
  								],
  							});
  						} catch (e) {
  							console.log(e);
  						}
  					}
  				},
  			})

  		})


  		$('#modal_history_outbound').on('hidden.bs.modal', function() {
  			var datatable = $('#tb_out');
  			// //   console.log(datatable); 
  			//   datatable.destroy();
  			//     $('#myTable').empty();
  			// do something here
  		})


  	})
  </script>
