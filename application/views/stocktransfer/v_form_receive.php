 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <!-- <h1 class="m-0 text-dark">Outbound</h1> -->
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Outbound</a></li>
                         <li class="breadcrumb-item active">List Outbound</li>
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
                             Manage Data Stock Transfer
                         </div>
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <label>Status Transfer</label>
                                         <select name="status_transfer" id="status_transfer" class="form-control select2">
                                             <option value="1">Not Received</option>
                                             <option value="2">Received</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <label>Warehouse</label>
                                     <select name="id_warehouse" id="id_warehouse" class="form-control" required></select>
                                 </div>
                                 <div class="col-md-12">
                                     <table class="table table-striped table-bordered" style="width: 100%;" id="table_stocktransfer">
                                         <thead>
                                             <tr>
                                                 <th></th>
                                                 <th>Act</th>
                                                 <th>Stock Transfer No</th>
                                                 <th>Stock Transfer Date</th>
                                                 <th>Origin WH</th>
                                                 <th>Destination WH</th>
                                                 <th>Material</th>
                                                 <th>Status</th>
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

     <!-- Modal  -->
     <form id="form_update" method="POST" enctype="multipart/form-data">
         <div class="modal fade" id="modal_outbound" tabindex="-1" role="dialog">
             <div class="modal-dialog modal-lg" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Update Status Outbound</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label>Keyword</label>
                                     <div class="input-group input-group-sm">
                                         <input type="hidden" name="id_outbound">
                                         <input name="term" id="term" type="text" class="form-control">
                                         <span class="input-group-append">
                                             <button type="button" class="btn btn-info btn-flat">Search</button>
                                         </span>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Status Outbound</label>
                                     <select name="status_outbound" id="status_outbound" class="form-control select2" required>
                                         <option value="">Select Status</option>
                                         <option value="1">On Preparation</option>
                                         <option value="2">Ready to Pick Up</option>
                                         <option value="3">Delivered</option>
                                         <option value="4">Back to Stock</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Date (mm/dd/yyyy)</label>
                                     <div class="input-group date" id="status_date" data-target-input="nearest">
                                         <input type="text" name="status_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#status_date" required>
                                         <div class="input-group-append" data-target="#status_date" data-toggle="datetimepicker">
                                             <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Time</label>

                                     <div class="input-group date" id="status_time" data-target-input="nearest">
                                         <input type="text" name="status_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#status_time" required>
                                         <div class="input-group-append" data-target="#status_time" data-toggle="datetimepicker">
                                             <div class="input-group-text"><i class="far fa-clock"></i></div>
                                         </div>
                                     </div>
                                     <!-- /.input group -->
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Truck No</label>
                                     <input type="text" name="truck_no" id="truck_no" placeholder="Nomor Mobil" class="form-control" readonly>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Driver Name</label>
                                     <input type="text" name="driver_name" id="driver_name" placeholder="Nama Driver" class="form-control" readonly>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Driver Contact</label>
                                     <input type="text" name="driver_contact" id="driver_contact" placeholder="Nomor Kontak Driver" class="form-control" readonly>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>MOT</label>
                                     <select name="id_mot" id="id_mot" class="form-control" disabled></select>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Scan DN</label>
                                     <input type="file" name="file_dn" id="file_dn" class="form-control" readonly>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <table class="table dataTableLayout" style="width: 100%;" id="table_detail">
                                     <thead>
                                         <tr>
                                             <th>No</th>
                                             <th>Product Code</th>
                                             <th>Product Desc</th>
                                             <th>Product Status</th>
                                             <th>Qty</th>
                                             <th>Locator</th>
                                         </tr>
                                     </thead>
                                 </table>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Update</button>
                     </div>
                 </div>
             </div>
         </div>
     </form>
     <!-- Modal End -->
     <div class="modal fade" id="modal_product" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Detail Product</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-md-12">
                             <table class="table dataTableLayout" style="width: 100%;" id="tb_product">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Product Code</th>
                                         <th>Product Name</th>
                                         <th>PO Number</th>
                                         <th>Serial Number</th>
                                         <th>Locator</th>
                                         <th>Qty</th>
                                     </tr>
                                 </thead>
                             </table>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script>
     $(document).ready(function() {
         var level = "<?= $level ?>";
         var id_stock_transfer = '';
         var table = $('#table_stocktransfer').DataTable({
             "ajax": {
                 url: "<?= site_url('stocktransfer/ajax_stocktransfer_receive') ?>",
                 type: "POST",
                 data: function(d) {
                     d.id_warehouse = $('select[name=id_warehouse]').val();
                     d.status_transfer = $('select[name=status_transfer]').val();
                 }
             },
             "order": [],
             "responsive": true,
             "autoWidth": false,
             "scrollX": true,
             "scollCollapse": true,
             "dom": 'Bfrtip',
             "lengthMenu": [
                 [10, 25, 50, -1],
                 ['10 rows', '25 rows', '50 rows', 'Show all']
             ],
             "buttons": [
                 'pageLength',
                 'excel',
                 {
                     text: 'Refresh',
                     action: function(e, dt, node, config) {
                         table.ajax.reload();
                     }
                 }
             ],
             "columns": [{
                     data: 'id',
                     render: function(data, type, row) {
                         return '';
                     },
                     width: '5%'
                 },
                 {
                     data: "id",
                     render: function(data, type, row) {
                         var btn_edit = '<button type="button" class="btn btn-sm btn-receipt btn-success mr-1 mb-1"><i class="fas fa-receipt"></i> Receive</button>'
                         var status = row['stock_transfer_status'];
                         if (status == 'in_transit' || level == 1) {
                             return btn_edit;
                         } else {
                             return '';
                         }
                     },
                     width: '5%'
                 },
                 {
                     data: 'stock_transfer_no'
                 },
                 {
                     data: 'stock_transfer_date'
                 },
                 {
                     data: 'warehouse_origin'
                 },
                 {
                     data: 'warehouse_destination',
                 },
                 {
                     data: 'id',
                     render: function(data, type, row) {
                         return '<button class="btn btn-primary btn-sm btn-material">' + row['c_material'] + '</button>';
                     }
                 },
                 {
                     data: 'stock_transfer_status',
                 },
             ],
         })

         table.on('order.dt search.dt', function() {
             table.column(0, {
                 search: 'applied',
                 order: 'applied'
             }).nodes().each(function(cell, i) {
                 cell.innerHTML = i + 1;
             });
         }).draw();

         $('select[name=id_warehouse], select[name=status_transfer]').on('change', function() {
             table.ajax.reload();
         })

         $("[name='id_warehouse']").select2({
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

         $('#table_stocktransfer tbody').on('click', '.btn-receipt', function() {
             var data = table.row($(this).parent().parent()).data();
             window.open("<?= site_url('stocktransfer/receipt/') ?>" + data['id']);
         })

         $('#table_stocktransfer tbody').on('click', '.btn-material', function() {
             var data = table.row($(this).parent().parent()).data();
             id_stock_transfer = data['id'];
             table_product.ajax.reload();
             $('#modal_product').modal();
         })

         var table_detail = $('#table_detail').DataTable({
             ajax: {
                 url: "<?= site_url('stocktransfer/get_stocktransfer_product') ?>",
                 type: "POST",
                 data: function(d) {
                     d.id_stock_transfer = $('[name=id_stock_transfer]').val();
                 }
             },
             order: [],
             columns: [{
                     data: 'id',
                 },
                 {
                     data: 'product_code'
                 },
                 {
                     data: 'product_name'
                 },
                 {
                     data: 'product_status'
                 },
                 {
                     data: 'qty',
                     render: function(data, type, row) {
                         var input_id = `<input type="hidden" name="id_detail[]" value="` + row['id'] + `">`;
                         var input_qty = `<input type="number" class="form-control" name="qty_outbound[]" max="` + row['available'] + `" value="` + row['qty'] + `" required>`;
                         return input_id + input_qty;
                     },
                     width: '80px'
                 },
                 {
                     data: 'locator'
                 }
             ],
             responsive: true,
             scrollX: true,
             scollCollapse: true,
             dom: 'Bfrtip',
             lengthMenu: [
                 [-1],
                 ['Show all']
             ],
             buttons: [
                 'pageLength',
                 {
                     text: 'Refresh',
                     action: function(e, dt, node, config) {
                         table_detail.ajax.reload();
                     }
                 }
             ],
         })

         table_detail.on('order.dt search.dt', function() {
             table_detail.column(0, {
                 search: 'applied',
                 order: 'applied'
             }).nodes().each(function(cell, i) {
                 cell.innerHTML = i + 1;
             });
         }).draw();

         $(document).on('shown.bs.modal', function(e) {
             table_detail.columns.adjust();
             table_product.columns.adjust();
         });

         var table_product = $('#tb_product').DataTable({
             ajax: {
                 url: "<?= site_url('stocktransfer/get_stocktransfer_product') ?>",
                 type: "POST",
                 data: function(d) {
                     d.id_stock_transfer = id_stock_transfer;
                 }
             },
             order: [],
             columns: [{
                     data: 'id',
                 },
                 {
                     data: 'product_code'
                 },
                 {
                     data: 'product_name'
                 },
                 {
                     data: 'po_no'
                 },
                 {
                     data: 'lot_number'
                 },
                 {
                     data: 'locator'
                 },
                 {
                     data: 'qty',
                 },
             ],
             responsive: true,
             scrollX: true,
             scollCollapse: true,
             dom: 'Bfrtip',
             lengthMenu: [
                 [-1],
                 ['Show all']
             ],
             buttons: [
                 'pageLength',
                 {
                     text: 'Refresh',
                     action: function(e, dt, node, config) {
                         table_product.ajax.reload();
                     }
                 }
             ],
         })

         table_product.on('order.dt search.dt', function() {
             table_product.column(0, {
                 search: 'applied',
                 order: 'applied'
             }).nodes().each(function(cell, i) {
                 cell.innerHTML = i + 1;
             });
         }).draw();
     })
 </script>