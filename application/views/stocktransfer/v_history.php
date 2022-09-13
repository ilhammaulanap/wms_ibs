  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <!-- <h1 class="m-0 text-dark">Stock Transfer</h1> -->
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Stock Transfer</a></li>
                          <li class="breadcrumb-item active">History Stock Transfer</li>
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
                              <h3 class="card-title">Stock Transfer History</h3>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Stock Transfer Date:</label>

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
                                  <div class="col-md-12 mt-2">
                                      <table class="table" style="width: 100%;" id="table_outbound">
                                          <thead>
                                              <tr>
                                                  <th>ST No</th>
                                                  <th>ST Date</th>
                                                  <th>ST Destination</th>
                                                  <th>Item Code</th>
                                                  <th>Item Description</th>
                                                  <th>Item Qty</th>
                                                  <th>Item UOM</th>
                                                  <th>ST Status</th>
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

          var startDate = moment().subtract('days', 29);
          var endDate = moment();

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
                  //table.ajax.reload();
              }
          );


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

          var table = $('#table_outbound').DataTable({
              ajax: {
                  url: "<?= site_url('stocktransfer/get_stocktransfer_history') ?>",
                  type: 'POST',
                  data: function(d) {
                      d.date1 = startDate.format('YYYY-MM-DD');
                      d.date2 = endDate.format('YYYY-MM-DD');
                      d.id_warehouse = $('#id_warehouse').val();
                  },
              },
              order: [],
              responsive: true,
              //   autoWidth: false,
              //   scrollX: true,
              //   scollCollapse: true,
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
                      data: 'stock_transfer_no'
                  },
                  {
                      data: 'stock_transfer_date'
                  },
                  {
                      data: 'warehouse_destination'
                  },
                  {
                      data: 'product_code'
                  },
                  {
                      data: 'product_name'
                  },
                  {
                      data: 'qty'
                  },
                  {
                      data: 'uom'
                  },
                  {
                      data: 'stock_transfer_status'
                  },
              ]
          })

          $('[name=id_warehouse]').on('change', function() {
              table.ajax.reload();
          })
      })
  </script>