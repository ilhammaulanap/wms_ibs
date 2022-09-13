  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- test -->
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <!-- <h1 class="m-0 text-dark">MOT</h1> -->
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Vendor</a></li>
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
                              Manage Data Vendor
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-5">
                                      <button class="btn btn-primary" id="btn_add_mot">
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
                                      <table class="table" id="table_mot">
                                          <thead>
                                              <tr>
                                                  <th>Name</th>
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
      <form id="form_mot" method="POST">
          <div class="modal fade" id="modal_mot" tabindex="-1" role="dialog">
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
                              <label>Name</label>
                              <input type="hidden" name="id" id="id">
                              <input type="text" name="name" id="name" title="Only alphanumeric characters." pattern="^[a-zA-Z0-9\s]+$" maxlength="100" minlength="1" class="form-control" placeholder="MOT Name" required>
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
      <!-- End Modal -->
  </div>
  <script>
      $(function() {
          bsCustomFileInput.init();
      });
  </script>
  <script>
      $(document).ready(function() {
          var mode = 'add';
          var level = '<?= $this->session->userdata('wh_level') ?>';

          var table = $('#table_mot').DataTable({
              ajax: {
                  url: "<?= site_url('vendors/get_ajax_data_vendor') ?>",
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
                      data: 'name',
                      width: '350px'
                  },
                  {
                      data: 'id',
                      width: '150px',
                      render: function(data, type, row) {
                          var btn_edit = '<button type="button" class="btn btn-primary btn-edit mr-1 mb-1"><i class="fa fa-edit"></i></button>';
                          var btn_delete = '<button type="button" class="btn btn-danger btn-delete mr-1 mb-1"><i class="fa fa-trash"></i></button>';
                          return btn_edit + btn_delete;
                      },
                      visible: level == '1' ? true : false,
                  }
              ]
          })

          $('#btn_add_mot').on('click', function() {
              $('#modal_mot .modal-title').html('Add New MOT');
              if (mode == 'edit') {
                  $('#id').val('').change();
                  $('#name').val('').change();
              }
              mode = 'add';
              $('#modal_mot').modal();
          })

          $('#table_mot').on('click', '.btn-edit', function() {
              mode = 'edit';

              var row = table.row($(this).parent().parent()).data();
              $.each(row, function(i, d) {
                  $('#' + i).val(d).change();
              })

              $('#modal_mot .modal-title').html('Edit Data MOT');
              $('#modal_mot').modal();
          })

          $('#table_mot').on('click', '.btn-delete', function() {
              var row = table.row($(this).parent().parent()).data();
              if (confirm('Are you sure want to delete this data ?')) {
                  $.ajax({
                      url: "<?= site_url('vendors/delete_data') ?>",
                      data: {
                          id: row['id']
                      },
                      type: 'POST',
                      beforeSend: function() {
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
                      },
                      complete: function() {
                          $('#loader').addClass('hidden');
                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          console.log(xhr.status + " : " + thrownError);
                          swal('Delete Data Gagal', 'error');
                      }
                  })
              }
          })

          $('#form_mot').on('submit', function(e) {
              e.preventDefault();
              if (confirm('Are you sure want to submit this data ?')) {
                  var formData = new FormData($(this)[0]);
                  $.ajax({
                      url: "<?= site_url('vendors/save_data') ?>",
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
                          $('#loader').addClass('hidden');
                          $('button[type=submit]').prop('disabled', false);
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
              window.open("<?= site_url('vendors/export_sample_data') ?>");
          })

          $('#btn_upload').on('click', function() {
              $('#modal_upload').modal();
          })

          $('#form_upload').on('submit', function(e) {
              e.preventDefault();

              var formData = new FormData($(this)[0]);

              $.ajax({
                  url: "<?= site_url('vendors/save_upload_data') ?>",
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
                              $('#modal_notif .modal-body').html(result.message);
                              $('#modal_notif').modal();
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
      var level = '<?= $this->session->userdata('wh_level') ?>';
      if (level == '3') {
          url = window.location.href;
      }
  </script>