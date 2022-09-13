  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <!-- <h1 class="m-0 text-dark">Product</h1> -->
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Product</a></li>
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
                              Manage Data Product
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-5">
                                      <button class="btn btn-primary" id="btn_add_product">
                                          <i class="fa fa-plus"></i> Add New
                                      </button>
                                      <button class="btn btn-success" id="btn_sample">
                                          <i class="fa fa-file-excel"></i> Sample Excel
                                      </button>
                                      <button class="btn btn-secondary" id="btn_upload">
                                          <i class="fa fa-upload"></i> Import Data
                                      </button>
                                      <button class="btn btn-secondary" id="btn_barcode">
                                          <i class="fa fa-print"></i> Generate Barcode
                                      </button>
                                  </div>
                                  <div class="col-md-12 mt-3">
                                      <table class="table" id="table_product">
                                          <thead>
                                              <tr>
                                                  <th></th>
                                                  <th>No</th>
                                                  <th>Material Code</th>
                                                  <th>Product Group Code</th>
                                                  <th>Material Name</th>
                                                  <th>Length (m)</th>
                                                  <th>Width (m)</th>
                                                  <th>Height (m)</th>
                                                  <th>Cubication (m3)</th>
                                                  <th>Weight (kg)</th>
                                                  <th>UoM</th>
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
      <form id="form_product" method="POST">
          <div class="modal fade" id="modal_product" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="id" id="id">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Material Code</label>
                                      <input type="text" name="code" id="code" class="form-control" placeholder="Product Code"title="Only alphanumeric characters, - , . ,_ and @."  pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="50">
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Product Group Code</label>
                                      <select name="id_category" id="id_category" class="form-control select2" required></select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Material Name</label>
                                      <input type="text" name="name" id="name" class="form-control" placeholder="Product Description" requiredtitle="Only alphanumeric characters, - , . ,_ and @."  pattern="^[a-zA-Z0-9.()-_-@\s]+$" minlength="1">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Length (m)</label>
                                      <input type="number" name="length" id="length" class="form-control" step="0.1" required>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Width (m)</label>
                                      <input type="number" name="width" id="width" class="form-control" step="0.1" required>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Height (m)</label>
                                      <input type="number" name="height" id="height" class="form-control" step="0.1" required>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label>Cubication (m<sup>3</sup>)</label>
                                      <input type="number" name="cubication" id="cubication" class="form-control" step="0.1" readonly>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Weight</label>
                                      <input type="number" name="weight" id="weight" class="form-control" step="0.1" required>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Unit of Measure</label>
                                      <select name="id_uom" id="id_uom" class="form-control select2" required></select>
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
      $(function() {
          bsCustomFileInput.init();
      });
  </script>
  <script>
      $(document).ready(function() {
          var mode = 'add';
          var level = '<?= $this->session->userdata('wh_level') ?>';

          var table = $('#table_product').DataTable({
              ajax: {
                  url: "<?= site_url('product/get_ajax_data') ?>",
                  data: function(d) {
                      //d.id_warehouse = id_warehouse;
                  }
              },
              order: [],
              columns: [
                  {
                    data: 'code',
                      render: function(data, type, row) {

                          var checkBox = '<input type="checkbox" id="checkBarcode" name="checkBarcode" value='+data+' data-key1='+data+'>';
                          return checkBox;
                      },
                      visible: level == '1' ? true : false,
                  },
                  {
                      data: 'id',
                      orderable: false,
                  },
                  {
                      data: 'code',
                  },
                  {
                      data: 'category'
                  },
                  {
                      data: 'name'
                  },
                  
                  {
                      data: 'length'
                  },
                  {
                      data: 'width'
                  },
                  {
                      data: 'height'
                  },
                  {
                      data: 'length',
                      render: function(data, type, row) {
                          var length = parseFloat(row['length']);
                          var width = parseFloat(row['width']);
                          var height = parseFloat(row['height']);
                          return length * width * height;
                      }
                  },
                  {
                      data: 'weight'
                  },
                  {
                      data: 'symbol_uom'
                  },
                  {
                      data: 'id',
                      render: function(data, type, row) {
                          var btn_edit = '<button class="btn btn-primary btn-edit mr-1 mb-1"><i class="fa fa-edit"></i></button>';
                          var btn_delete = '<button class="btn btn-danger btn-delete mr-1 mb-1"><i class="fa fa-trash"></i></button>';
                          return btn_edit + btn_delete;
                      },
                      visible: level == '1' ? true : false,
                  },
              ],
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
            stateSave: true
          })
          
          table.on('order.dt search.dt', function() {
              table.column(1, {
                  search: 'applied',
                  order: 'applied'
              }).nodes().each(function(cell, i) {
                  cell.innerHTML = i + 1;
              });
          }).draw();

          $('#btn_barcode').on('click', function() {
            var oTable = $("#table_product").dataTable();
            var allPages = oTable.fnGetNodes();
            var code = $('input:checkbox[name=checkBarcode]:checked', allPages).map(function () {
                return $(this).data('key1');
            }).get();
            
            url = '<?= site_url('barcode/generate/') ?>';
            url2 = '<?= site_url('barcode/getBarcode/') ?>';
            var data = code.toString();
            console.log(data);
            if(data === ""){
                alert("choose the product first");
            }else{
                const result = data.replaceAll(',','-');
                window.open(url2+result);
            }
            
            
          })

          function init_select_uom() {
              $("[name='id_uom'").select2({
                  ajax: {
                      url: "<?= site_url('product/get_ajax_data_select_uom') ?>",
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
                  placeholder: 'Select Unit Type',
              });
          }

          function init_select_category() {
              $("[name='id_category'").select2({
                  ajax: {
                      url: "<?= site_url('product/get_ajax_data_select_category') ?>",
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
                  placeholder: 'Select Category',
              });
          }

          function cubication() {
              var length = parseFloat($('[name=length]').val());
              var width = parseFloat($('[name=width]').val());
              var height = parseFloat($('[name=height]').val());
              var cubication = length * width * height;
              $('[name=cubication]').val(cubication);
          }
          
          $('#btn_add_product').on('click', function() {
              init_select_uom();
              init_select_category();
              $('#modal_product .modal-title').html('Add New Product');
              if (mode == 'edit') {
                  $('[name=id]').val('');
                  $('[name=name]').val('');
                  $('[name=id_uom]').val('').change();
              }
              mode = 'add';
              $('#modal_product').modal();
          })

          $('#btn_import_product').on('click', function() {
              $('#modal_import').modal();
          })

          $('#table_product').on('click', '.btn-edit', function() {
              mode = 'edit';

              var row = table.row($(this).parent().parent()).data();
              $.each(row, function(i, d) {
                  $('#' + i).val(d).change();
              })
              init_select_category();
              var option = new Option(row['uom'], row['id_uom'], true, true);
              console.log(option);
              var option2 = new Option(row['category'], row['id_category'], true, true);
              $('#id_uom').append(option).trigger('change');
              $('#id_category').append(option2).trigger('change');

              cubication();

              $('#modal_product .modal-title').html('Edit Data Product');
              $('#modal_product').modal();
          })

          $('#table_product').on('click', '.btn-delete', function() {
              var row = table.row($(this).parent().parent()).data();
              if (confirm('Are you sure want to delete this data ?')) {
                  $.ajax({
                      url: "<?= site_url('product/delete_data') ?>",
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

          $('#form_product').on('submit', function(e) {
              e.preventDefault();
              if (confirm('Are you sure want to submit this data ?')) {
                  var formData = new FormData($(this)[0]);
                  //formData.append('id_warehouse', id_warehouse);
                  $.ajax({
                      url: "<?= site_url('product/save_data') ?>",
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

          $('[name=length], [name=width], [name=height]').on('keyup, input, change, keydown', function() {
              cubication();
              console.log('cubication');
          })

          $('#btn_sample').on('click', function() {
              window.open("<?= site_url('product/export_sample_data') ?>");
          })

          $('#btn_upload').on('click', function() {
              $('#modal_upload').modal();
          })

          $('#form_upload').on('submit', function(e) {
              e.preventDefault();

              var formData = new FormData($(this)[0]);

              $.ajax({
                  url: "<?= site_url('product/save_upload_data') ?>",
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
                              $('#modal_upload').modal('hide');
                              table.ajax.reload();
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
    //   function GetBarcode() {
    //     var oTable = $('#table_product').dataTable({
    //         stateSave: true
    //     });

    //     var allPages = oTable.fnGetNodes();
    //     console.log('generate Barcode');
    //     var code = $('input:checkbox[name=checkBarcode]:checked', allPages).map(function () {
    //         return $(this).data('key1');
    //     }).get();
    //     // console.log(code);
    //     // // id_table.push(id_outlet);
    //     // // data = {'id_table' : id_table };
    //     // // console.log(id_table);
    //     url = '<?= site_url('barcode/generate/') ?>';
    //     url2 = '<?= site_url('barcode/getBarcode/') ?>';
    //     var data = code.toString();
        

    //     const result = data.replaceAll(',','-');
        
    //     console.log(result);
    //             // window.open(url2+result);
    //     }
  </script>