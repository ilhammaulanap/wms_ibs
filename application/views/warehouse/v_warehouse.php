  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <!-- <h1 class="m-0 text-dark">Warehouse</h1> -->
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Warehouse</a></li>
                          <li class="breadcrumb-item active">Master Data</li>
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
                              Manage Data Warehouse
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-5">
                                      <button class="btn btn-primary" id="btn_add_warehouse">
                                          <i class="fa fa-plus"></i> Add New
                                      </button>
                                      <button class="btn btn-success" id="btn_sample">
                                          <i class="fa fa-file-excel"></i> Sample Excel
                                      </button>
                                      <button class="btn btn-secondary" id="btn_upload">
                                          <i class="fa fa-upload"></i> Import Data
                                      </button>
                                  </div>
                                  <div class="col-md-12 mt-3">
                                      <table class="table" id="table_warehouse">
                                          <thead>
                                              <tr>
                                                  <th>No</th>
                                                  <th>Code</th>
                                                  <th>Name</th>
                                                  <th>Address</th>
                                                  <th>Latitude</th>
                                                  <th>Longiutde</th>
                                                  <th>Action</th>
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

      <!-- Modal -->
      <form id="form_warehouse" method="POST">
          <div class="modal fade" id="modal_warehouse" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label>Code</label>
                              <input type="hidden" name="id" id="id">
                              <input type="text" name="code" id="code" class="form-control" title="Only alphanumeric characters, - , . ,_ and @."  pattern="^[a-zA-Z0-9.-_@\s]+$" minlength="1" maxlength="15" placeholder="Warehouse Code" required>
                          </div>
                          <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" id="name" class="form-control" title="Only characters." pattern="^[a-zA-Z\s]+$" minlength="5" maxlength="50" placeholder="Warehouse Name" required>
                          </div>
                          <div class="form-group">
                              <label>Address</label>
                              <textarea name="address" id="address" class="form-control" placeholder="Address" rows="5" required></textarea>
                          </div>
                          <div class="form-group">
                              <label>Latitude</label>
                              <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude" required>
                          </div>
                          <div class="form-group">
                              <label>Longitude</label>
                              <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude" required>
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

      <div class="modal fade" id="modal_notif" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Notification</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Modal -->
  </div>
  <script>
      $(document).ready(function() {
          var mode = 'add';

          var table = $('#table_warehouse').DataTable({
              ajax: {
                  url: "<?= site_url('warehouse/get_ajax_data_warehouse') ?>",
                  type: 'POST'
              },
              order: [],
              "responsive": true,
              "autoWidth": false,
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
                                return '';
                            }
                  },
                  {
                      data: 'code',
                  },
                  {
                      data: 'name',
                  },
                  {
                      data: 'address',
                      width: '350px'
                  },
                  {
                      data: 'latitude'
                  },
                  {
                      data: 'longitude'
                  },
                  {
                      data: 'id',
                      width: '150px',
                      render: function(data, type, row) {
                          var btn_edit = '<button type="button" class="btn btn-primary btn-edit mr-1 mb-1"><i class="fa fa-edit"></i></button>';
                          var btn_delete = '<button type="button" class="btn btn-danger btn-delete mr-1 mb-1"><i class="fa fa-trash"></i></button>';
                          var btn_maps = '<button type="button" class="btn btn-success btn-maps mr-1 mb-1"><i class="fa fa-map-marker"></i></button>';
                          return btn_edit + btn_delete + btn_maps;
                      }
                  }
              ]
          })
          table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
          $('#btn_add_warehouse').on('click', function() {
              $('#modal_warehouse .modal-title').html('Add New Warehouse');
              if (mode == 'edit') {
                  $('#id').val('').change();
                  $('#name').val('').change();
                  $('#address').val('').change();
                  $('#latitude').val('').change();
                  $('#longitude').val('').change();
              }
              mode = 'add';
              $('#modal_warehouse').modal();
          })

          $('#table_warehouse').on('click', '.btn-edit', function() {
              mode = 'edit';

              var row = table.row($(this).parent().parent()).data();
              $.each(row, function(i, d) {
                  $('#' + i).val(d).change();
              })

              $('#modal_warehouse .modal-title').html('Edit Data Warehouse');
              $('#modal_warehouse').modal();
          })

          $('#table_warehouse').on('click', '.btn-delete', function() {
              var row = table.row($(this).parent().parent()).data();
              if (confirm('Are you sure want to delete this data ?')) {
                  $.ajax({
                      url: "<?= site_url('warehouse/delete_data') ?>",
                      data: {
                          id: row['id']
                      },
                      type: 'POST',
                      beforeSend: function() {},
                      success: function(result) {
                          if (result) {
                              try {
                                  result = JSON.parse(result);
                                  $('#modal_general .modal-body').html(result.message);
                                  if (result.code == 200) {
                                      table.ajax.reload();
                                      hide_modal();
                                  }
                                  $('#modal_general').modal('show');
                              } catch (e) {
                                  console.log(e);
                                  alert(result);
                              }
                          }
                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          console.log(xhr.status + " : " + thrownError);
                          swal('Delete Data Gagal', 'error');
                      }
                  })
              }
          })

          $('#table_warehouse').on('click', '.btn-maps', function() {
              var data = table.row($(this).parent().parent()).data();
              var lat = data['latitude'];
              var lot = data['longitude'];
              var url = "https://maps.google.com?q=" + lat + "," + lot + "";
              window.open(url);
          })

          $('#form_warehouse').on('submit', function(e) {
              e.preventDefault();
              if (confirm('Are you sure want to submit this data ?')) {
                  var formData = new FormData($(this)[0]);
                  $.ajax({
                      url: "<?= site_url('warehouse/save_data') ?>",
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

                                  $('#modal_general .modal-body').html(result.message);
                                  if (result.code == 200) {
                                      table.ajax.reload();
                                      hide_modal();
                                  }
                                  $('#modal_general').modal('show');
                              } catch (e) {
                                  console.log(e);
                                  alert(result);
                              }
                          }
                          $('button[type=submit]').prop('disabled', false);
                      },
                      complete: function() {
                          $('button[type=submit]').prop('disabled', false);
                          $('#loader').addClass('hidden');
                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          console.log(xhr.status + ' : ' + thrownError);
                          alert('Ada kesalahan : ' + xhr.status + ' : ' + thrownError);
                          $('button[type=submit]').prop('disabled', false);
                      }
                  })
              }
          })

          $('#btn_sample').on('click', function() {
              window.open("<?= site_url('warehouse/export_sample_data') ?>");
          })

          $('#btn_upload').on('click', function() {
              $('#modal_upload').modal();
          })

          $('#form_upload').on('submit', function(e) {
              e.preventDefault();

              var formData = new FormData($(this)[0]);

              $.ajax({
                  url: "<?= site_url('warehouse/save_upload_data') ?>",
                  data: formData,
                  processData: false,
                  contentType: false,
                  async: false,
                  cache: false,
                  enctype: 'multipart/form-data',
                  type: 'POST',
                  beforeSend: function() {
                      $('#loader').removeClass('hidden');
                      $('button[type=submit]').prop('disabled', true);
                  },
                  success: function(result) {
                      if (result) {
                          try {
                              result = JSON.parse(result);
                              if (result.message != '') {
                                  $('#modal_notif .modal-body').html(result.message);
                                  $('#modal_notif').modal();
                              }
                          } catch (e) {
                              console.log(e);
                          }
                      }
                      $("button[type=submit]").prop("disabled", false);
                  },
                  complete: function() {
                      $('button[type=submit]').prop('disabled', false);
                      $('#loader').addClass('hidden');
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
  </script>