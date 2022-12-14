  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Confirm Inbound</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Inbound</a></li>
                          <li class="breadcrumb-item active">List Confirm Inbound</li>
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
                                  <div class="col-md-12">
                                      <table class="table" id="table_inbound">
                                          <thead>
                                              <tr>
                                                  <th>Action</th>
                                                  <th>Inbound No</th>
                                                  <th>Inbound Date</th>
                                                  <th>PO Number</th>
                                                  <th>Truck No</th>
                                                  <th>Driver Name</th>
                                                  <th>Origin</th>
                                                  <th>Warehouse</th>
                                                  <th>Supplier</th>
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
          var table = $('#table_inbound').DataTable({
              ajax: {
                  url: "<?= site_url('inbound/get_inbound_confirm') ?>",
                  type: 'POST',
                  data: {},
              },
              order: [],
              "responsive": true,
              "autoWidth": false,
              scrollX: true,
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
                      data: 'id',
                      render: function(data, type, row) {
                          var btn_confirm = '<button type="button" class="btn btn-primary btn-confirm mr-1 mb-1">Confirm</button>'
                          var btn_edit = '<button type="button" class="btn btn-warning btn-edit mr-1 mb-1">Edit</button>'
                          if (row['confirm_date'] == null || row['confirm_date'] == '') {
                              return btn_confirm;
                          } else {
                              return btn_edit;
                          }
                      },
                      width: '60px'
                  },
                  {
                      data: 'inbound_no'
                  },
                  {
                      data: 'inbound_date'
                  },
                  {
                      data: 'po_no'
                  },
                  {
                      data: 'truck_no'
                  },
                  {
                      data: 'driver_name'
                  },
                  {
                      data: 'origin'
                  },
                  {
                      data: 'warehouse'
                  },
                  {
                      data: 'supplier'
                  }
              ]
          })

          $('#table_inbound').on('click', '.btn-confirm', function() {
              var data = table.row($(this).parent().parent()).data();

              window.location.href = "<?= site_url('inbound/order/confirm/') ?>" + data['md5_id']
          })

          $('#table_inbound').on('click', '.btn-edit', function() {
              var data = table.row($(this).parent().parent()).data();

              window.location.href = "<?= site_url('inbound/order/confirm/') ?>" + data['md5_id']
          })
      })
  </script>