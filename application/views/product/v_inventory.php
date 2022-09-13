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
                          <li class="breadcrumb-item"><a href="#">Inventory</a></li>
                          <!-- <li class="breadcrumb-item active">History Inbound</li> -->
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
                              Manage Data Inventory
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label>Warehouse</label>
                                      <select name="id_warehouse" id="id_warehouse" class="form-control select2"></select>
                                  </div>
                                  <?php
                                    if($level == 1){
                                  ?>
                                  <div class="col-md-3">
                                      <label>Project</label>
                                      <select name="id_project" id="id_project" class="form-control select2"></select>
                                  </div>
                                  <?php
                                    }
                                  ?>
                                  <div class="col-md-3">
                                      <label>Product</label>
                                      <select name="id_product" id="id_product" class="form-control select2"></select>
                                  </div>
                                  <?php
                                    if($level == 1){
                                  ?>
                                  <div class="col-md-3">
                                      <label>Locator</label>
                                      <select name="id_locator" id="id_locator" class="form-control select2"></select>
                                  </div>
                                  <?php
                                    }
                                  ?>
                                  <div class="col-md-12 mt-3">
                                      <table class="table" style="width: 100%;" id="table_inventory">
                                          <thead>
                                              <tr>
                                                  <th>Inbound No</th>
                                                  <th>Inbound Date</th>
                                                  <th>WO Number</th>
                                                  <th>Shipment Number</th>
                                                  <th>Supplier</th>
                                                  <th>Warehouse</th>
                                                  <th>Project</th>
                                                  <th>MOT</th>
                                                  <th>Product Code</th>
                                                  <th>Product Group Code</th>
                                                  <th>Material Name</th>
                                                  <th>Serial Number</th>
                                                  <th>BOX ID</th>
                                                  <th>UOM</th>
                                                  <th>Status</th>
                                                  <th>Locator</th>
                                                  <th>Qty In</th>
                                                  <th>Qty Pick</th>
                                                  <th>Qty Out</th>
                                                  <th>Qty Available</th>
                                                  <th>Aging</th>
                                                  <th>TRUCK NO</th>
                                                  <th>CONTAINER NO</th>
                                                  <th>DRIVER NAME</th>
                                                  <th>DRIVER CONTACT</th>
                                                  <th>NOTE</th>
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
  <script>
      $(document).ready(function() {

          var table = $('#table_inventory').DataTable({
              ajax: {
                  url: "<?= site_url('product/ajax_dt_inventory') ?>",
                  data: function(d) {
                      d.id_locator = $('[name=id_locator]').val();
                      d.id_product = $('[name=id_product]').val();
                      d.id_warehouse = $('[name=id_warehouse]').val();
                      d.id_project = $('[name=id_project]').val();
                  },
                  type: "POST",
              },
            //   scrollX: true,
              order: [],
              responsive: true,
              autoWidth: false,
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
                      data: 'po_no'
                  },
                  {
                      data: 'shipment_no'
                  },
                  {
                      data: 'suppier_name'
                  },
                  {
                      data: 'warehouse_name'
                  },
                  {
                      data: 'project_name'
                  },
                  {
                      data: 'mot'
                  },
                  {
                      data: 'product_code'
                  },
                  {
                      data: 'name_category'
                  },
                  {
                      data: 'product_name'
                  },
                  {
                      data: 'lot_number'
                  },
                  {
                      data: 'box_id'
                  },
                  {
                      data: 'product_uom'
                  },
                  {
                      data: 'product_status'
                  },
                  {
                      data: 'locator'
                  },
                  {
                      data: 'qty_in'
                  },
                  {
                      data: 'qty_pick'
                  },
                  {
                      data: 'qty_out'
                  },
                  {
                      data: 'available'
                  },
                  {
                      data: 'date_diff' 
                  },
                  {
                      data: 'truck_no' 
                  },
                  {
                      data: 'no_container' 
                  },
                  {
                      data: 'driver_name' 
                  },
                  {
                      data: 'driver_contact' 
                  },
                  {
                      data: 'note' 
                  }
              ]
          })

          $("[name='id_warehouse']").select2({
              ajax: {
                  url: "<?= site_url('warehouse/get_ajax_data_select_project') ?>",
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
              allowClear: true,
              placeholder: 'All Warehouse',
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

          $("[name='id_product']").select2({
              ajax: {
                  url: "<?= site_url('product/get_ajax_data_select_product_inventory') ?>",
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
              placeholder: 'All Product',
          });

          $("[name='id_locator']").select2({
              ajax: {
                  url: "<?= site_url('product/get_ajax_data_select_locator_inventory') ?>",
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
              placeholder: 'All Locator',
          });

          $('[name=id_product]').on('change', function() {
              $('[name=id_locator]').val('').change();
          })

          $('[name=id_warehouse], [name=id_locator], [name=id_product], [name=id_project]').on('change', function() {
              table.ajax.reload();
              table.columns.adjust();
          })
      })
  </script>