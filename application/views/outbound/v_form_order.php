  <style>
      #table_inbound_filter {
          visibility: hidden;
      }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark"></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Outbound</a></li>
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
                              Data Outbound
                          </div>
                          <form id="form_order" method="POST">
                              <div class="card-body">
                                  <div class="row">
                                      <!-- ROW -->
                                      <div class="col-md-12">
                                          <div class="row">
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>PLAN DATE</label>
                                                      <input type="hidden" name="id" id="id">
                                                      <input type="date" name="outbound_date" id="outbound_date" class="form-control" min="<?= date('Y-m-d') ?>" autofocus required>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>REQUEST NUMBER</label>
                                                      <input type="text" name="mr_no" id="mr_no" class="form-control" title="Only alphanumeric characters, - , . , _ and @."  pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="30" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>WAREHOUSE</label>
                                                      <select name="id_warehouse" id="id_warehouse" class="form-control" required></select>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                 <label>Project</label>
                                                 <select name="id_project" id="id_project" class="form-control" required></select>
                                             </div>
                                              <div class="col-md-3">
                                                 <label>Vendor</label>
                                                 <select name="id_vendor" id="id_vendor" class="form-control" required></select>
                                             </div>
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>USER</label>
                                                      <input type="hidden" id="id_user_created" name="id_user_created">
                                                      <input type="text" id="name_creator" name="name_creator" class="form-control-plaintext" readonly>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="row mt-1">
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>PO NO</label>
                                                      <input type="text" name="po_outbound" id="po_outbound" class="form-control" title="Only alphanumeric characters, - , . , _ and @."  pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>WO NO</label>
                                                      <input type="text" name="wu_no" id="wu_no" class="form-control" title="Only alphanumeric characters, - , _ , . and @."  pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="150" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label>DESTINATION</label>
                                                      <input name="destination" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text" class="form-control">
                                                      <input type="hidden" name="latitude" id="latitude" class="form-control">
                                                      <input type="hidden" name="longitude" id="longitude" class="form-control">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="row mt-1">
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>SITE ID</label>
                                                      <input type="text" name="site_id" id="site_id" class="form-control" title="Only alphanumeric characters, - , _ and @."  pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="45" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>SITE Name</label>
                                                      <input type="text" name="site_name" id="site_name" class="form-control" title="Only alphanumeric characters, - , . , _ and @."  pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="50" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>SITE WBS</label>
                                                      <input type="text" name="site_wbs" id="site_wbs" title="Only alphanumeric characters, - , . ,_ and @."  pattern="^[a-zA-Z0-9.-_-@\s]+$" minlength="1" maxlength="25" class="form-control" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label>RECEIVER</label>
                                                      <input type="text" name="receiver_name" title="Only characters." pattern="^[a-zA-Z\s]+$" minlength="5" maxlength="50" id="receiver_name" class="form-control" required>
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
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <table class="table" style="width:100%;" id="table_product">
                                              <thead>
                                                  <tr>
                                                      <th></th>
                                                      <th>PO NUMBER</th>
                                                      <th>PRODUCT CODE</th>
                                                      <th>PRODUCT NAME</th>
                                                      <th>BOX ID</th>
                                                      <th>AVAILABLE</th>
                                                      <th>QTY</th>
                                                      <th>UOM</th>
                                                      <th>LOCATOR</th>
                                                      <th>REMAKS</th>
                                                      <th></th>
                                                  </tr>
                                              </thead>
                                              <tbody></tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                              <div class="card-footer">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <button type="button" class="btn btn-primary btn-add-product">
                                              <i class="fa fa-plus"> </i> ADD ROWS
                                          </button>
                                          <button type="button" class="btn btn-warning btn-import-product text-white">
                                              <i class="fa fa-file-excel"> </i> IMPORT
                                          </button>
                                          <button type="submit" class="btn btn-success btn-save">
                                              <i class="fa fa-save"> </i> SAVE
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!--/. Main content -->
  </div>
  <!-- End Content Wrapper -->
  <!-- Modal -->
  <div class="modal fade" id="modal_po">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">SEARCH INBOUND</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-5">
                          <div class="form-group">
                              <label>PRODUCT</label>
                              <select name="id_product" id="id_product" class="form-control select2" aria-placeholder="Search Product"></select>
                          </div>
                      </div>
                      <div class="col-md-5">
                          <div class="form-group">
                              <label>SEARCH</label>
                              <input type="text" name="search_inbound" id="search_inbound" class="form-control" placeholder="PO Number/Shipment Number, etc...">
                          </div>
                      </div>
                      <div class="col-md-12">
                          <table class="table table-sm" style="width: 100%;" id="table_inbound">
                              <thead>
                                  <tr>
                                      <th></th>
                                      <th>PO NUMBER</th>
                                      <th>SHIPMENT NUMBER</th>
                                      <th>INBOUND DATE</th>
                                      <th>PRODUCT CODE</th>
                                      <th>PRODUCT NAME</th>
                                      <th>BOX ID</th>
                                      <th>AVAILABLE</th>
                                      <th>LOCATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                  <button type="button" class="btn btn-primary btn-choose">CHOOSE</button>
              </div>
          </div>
      </div>
  </div>

  <form id="form_upload" method="POST" enctype="multipart/form-data">
      <div class="modal fade" id="modal_upload" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">UPLOAD FROM TEMPLATE</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label>DOWNLOAD TEMPLATE</label>
                                  <a href="#" class="btn btn-success d-block d-excel">
                                      <i class="fa fa-download"></i> DOWNLOAD EXCEL
                                  </a>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label>FILE TEMPLATE</label>
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="file_template" name="file_template" required>
                                          <label class="custom-file-label" for="file_template">CHOOSE FILE</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                      <button type="submit" class="btn btn-primary">SAVE</button>
                  </div>
              </div>
          </div>
      </div>
  </form>
  <!-- End Modal -->
  <!-- Script Area  -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYb4oHdhrA7re-exqhrMFy5rETGKMpToc&libraries=places&callback=initAutocomplete" async defer></script>
  <script>
      //google maps
      var placeSearch, autocomplete;
      var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
      };

      function initAutocomplete() {
          // Create the autocomplete object, restricting the search to geographical
          // location types.
          autocomplete = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */
              (document.getElementById('autocomplete')), {
                  types: ['geocode']
              });

          // When the user selects an address from the dropdown, populate the address
          // fields in the form.
          autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
          // Get the place details from the autocomplete object.
          var place = autocomplete.getPlace();
          //   console.log(place.geometry.location.lat());
          //   console.log(place.geometry.location.lng());
          $('[name=latitude]').val(place.geometry.location.lat());
          $('[name=longitude]').val(place.geometry.location.lng());
      }

      function geolocate() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                  var geolocation = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                  };
                  var circle = new google.maps.Circle({
                      center: geolocation,
                      radius: position.coords.accuracy
                  });
                  autocomplete.setBounds(circle.getBounds());
              });
          }
      }

      $(document).ready(function() {
          var id_karyawan = "<?= $id_user ?>"
          var nama_karyawan = "<?= $name_user ?>"
          var id = "<?= $id ?>"
          var mode = "<?= $mode ?>"
          var id_trash = [];
          var index = 0; //index row
          var mode_click = 'add';

          if (id == '') {
              $('[name=id_user_created]').val(id_karyawan);
              $('[name=name_creator]').val(nama_karyawan);
          }

          function get_info(id = '') {
              $.ajax({
                  url: "<?= site_url('outbound/info_order') ?>",
                  data: {
                      id: id
                  },
                  type: 'GET',
                  beforeSend: function() {
                      $('#loader').removeClass('hidden');
                      $("button[type=submit]").prop("disabled", true);
                  },
                  success: function(result) {
                      if (result) {
                          try {
                              result = JSON.parse(result);

                              if (result.code == 200) {
                                  //header
                                  var header = result.header;
                                  $.each(header, function(i, d) {
                                      $('[name=' + i + ']').val(d).change();
                                  })

                                  var option = new Option(header['warehouse'], header['id_warehouse'], true, true);
                                  $('#id_warehouse').append(option).trigger('change');

                                  var option2 = new Option(header['project'], header['id_project'], true, true);
                                  $('#id_project').append(option2).trigger('change');

                                  var option3 = new Option(header['vendor'], header['id_vendor'], true, true);
                                  $('#id_vendor').append(option3).trigger('change');

                                  $('[name=outbound_date]').prop('min', header['outbound_date']).change();

                                  $('[name=po_outbound]').val(header['po_no']);
                                  $('[name=link_attach]').val(header['link_attach']);


                                  var body = result.body;

                                  $.each(body, function(i, d) {
                                      add_row();
                                      $('[name="id_detail[]"]').eq(i).val(d.id);
                                      $('[name="id_detail_inbound[]"]').eq(i).val(d.id_inbound_product);
                                      $('[name="id_product[]"]').eq(i).val(d.id_product);
                                      $('[name="po_no[]"]').eq(i).val(d.po_no);
                                      $('[name="product_code[]"]').eq(i).val(d.product_code);
                                      $('[name="product_name[]"]').eq(i).val(d.product_name);
                                      $('[name="qty_available[]"]').eq(i).val(d.available);
                                      $('[name="qty[]"]').eq(i).val(d.qty);
                                      $('[name="qty[]"]').eq(i).prop('max', d.available);
                                      $('[name="uom_product[]"]').eq(i).val(d.uom_name);
                                      $('[name="locator[]"]').eq(i).val(d.locator);
                                  })
                              } else {

                              }
                          } catch (e) {
                              console.log(e);
                              Swal.fire(result, '', 'error')
                          }
                      }
                  },
                  complete: function() {
                      $('#loader').addClass('hidden');
                      $('button[type=submit]').prop('disabled', false);
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + " : " + thrownError);
                  }
              })
          }

          function add_row() {
              var _tr = '<tr>';
              _tr += '<td style="width:20px"><button type="button" class="btn btn-primary btn-add"><i class="fa fa-search"></i></button></td>';
              _tr += `<td style="width:150px">
              <input type="hidden" name="id_detail[]" class="form-control" value="0">
              <input type="hidden" name="id_detail_inbound[]" class="form-control">
              <input type="hidden" name="id_product[]" class="form-control">
              <input type="text" name="po_no[]" class="form-control" readonly>
              </td>`;
              _tr += '<td style="width:120px"><input type="text" name="product_code[]" class="form-control" readonly></td>';
              _tr += '<td style="width:170px"><input type="text" name="product_name[]" class="form-control" readonly></td>';
              _tr += '<td style="width:170px"><input type="text" name="box_id[]" class="form-control" readonly></td>';
              _tr += '<td style="width:100px"><input type="number" step="0.01" name="qty_available[]" class="form-control" readonly></td>';
              _tr += '<td style="width:100px"><input type="number" step="0.01" name="qty[]" class="form-control" required></td>';
              _tr += '<td style="width:50px"><input name="uom_product[]" type="text" class="form-control-plaintext" readonly></td>';
              _tr += '<td style="width:50px"><input type="text" name="locator[]" class="form-control" readonly></td>';
              _tr += '<td style="width:50px"><input type="text" name="note[]" class="form-control"></td>';
              _tr += `<td style="width:20px">
              <button type="button" class="btn btn-danger btn-trash"><i class="fa fa-trash"></i></button>
              </td>`;
              _tr += '</tr>';

              $('#table_product tbody').append(_tr);
          }

          function lock_warehouse() {
              $('[name=id_warehouse]').prop('disabled', true);
          }

          function unlock_warehouse() {
              $('[name=id_warehouse]').prop('disabled', false);
          }

          function save_form(formData) {
              $.ajax({
                  url: "<?= site_url('outbound/save_order') ?>",
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
                              if (result.code == 200) {

                                  if (mode == 'add') {
                                      Swal.fire({
                                          title: 'Outbound Number : ' + result.data.outbound_no,
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
                                          window.close();
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
                      $('button[type=submit]').prop('disabled', false);
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

          function search_id_detail(index = '', id_detail = '') {
              var result = 0;
              $("[name='id_detail_inbound[]']").each(function(i, d) {
                  const idp = $("[name='id_detail_inbound[]'").eq(i).val();
                  console.log(id_detail);
                  console.log(idp);
                  if (idp == id_detail && index != i) {
                      result++;
                  }
              })
              if (result > 0) {
                  return true;
              } else {
                  return false;
              }
          }

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
              placeholder: 'SEARCH PRODUCT',
          });

          $("[name='id_vendor']").select2({
            // var id_warehouse = $('[name=id_warehouse]').val()
            // console.log(id_warehouse);
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

          $("[name='id_project']").select2({
            // var id_warehouse = $('[name=id_warehouse]').val()
            // console.log(id_warehouse);
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

          $('.btn-add-product').on('click', function() {
              var origin = $('#id_origin').val();
              var warehouse = $('#id_warehouse').val();
              origin = origin == null ? '' : origin;
              warehouse = warehouse == null ? '' : warehouse;

              if (origin == '' && warehouse == '') {
                  toastr.error('WAREHOUSE FIELD IS REQUIRED.')
              } else {
                  mode_click = 'add';
                  table_inbound.ajax.reload();
                  $('[name=id_product]').select2('open');
                  $('#modal_po').modal();
                  return;
                  //   add_row();
                  //   lock_warehouse();
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

          $('#table_product').on('click', '.btn-add', function() {
              index = $(this).parent().parent().index();
              table_inbound.ajax.reload();
              $('[name=id_product]').select2('open');
              $('#modal_po').modal();
          })

          $('#form_order').on('submit', function(e) {
              e.preventDefault();

              Swal.fire({
                  title: 'ARE YOU WANT TO SAVE DATA?',
                  showCancelButton: true,
                  confirmButtonText: `Save`,
                  allowOutsideClick: false,
              }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                      //check table length
                      var row = $('#table_product tbody tr').length;
                      if (row == 0) {
                          Swal.fire('FIELD PRODUCT ON TABLE IS REQUIRED', '', 'info');
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

          if (mode == 'edit') {
              get_info(id);
          }

          var table_inbound = $('#table_inbound').DataTable({
              ajax: {
                  url: "<?= site_url('inbound/get_inbound_product') ?>",
                  type: "POST",
                  data: function(d) {
                      d.id_warehouse = $('[name=id_warehouse]').val();
                      d.id_product = $('[name=id_product]').val();
                  },
              },
              columns: [{
                      data: 'id',
                      render: function(data, type, row) {
                          return '';
                      }
                  },
                  {
                      data: 'po_no'
                  },
                  {
                      data: 'shipment_no'
                  },
                  {
                      data: 'inbound_date'
                  },
                  {
                      data: 'product_code'
                  },
                  {
                      data: 'product_name'
                  },
                  {
                      data: 'box_id'
                  },
                  {
                      data: 'available'
                  },
                  {
                      data: 'locator'
                  }
              ],
              order: [],
              //   scrollX: true,
              //   scollCollapse: true,
              dom: 'Bfrtip',
              lengthMenu: [
                  [10, 25, 50, -1],
                  ['10 rows', '25 rows', '50 rows', 'Show all']
              ],
              buttons: [
                  'pageLength',
                  {
                      text: 'Refresh',
                      action: function(e, dt, node, config) {
                          table_inbound.ajax.reload();
                      }
                  }
              ],
              columnDefs: [{
                  orderable: false,
                  className: 'select-checkbox',
                  targets: 0
              }],
              select: {
                  style: 'os',
                  //   selector: 'td:first-child'
              },
          })

          $('[name=id_warehouse], [name=id_product]').on('change', function() {
              table_inbound.ajax.reload();
          })

          $('[name=search_inbound]').on('keyup', function() {
              var val = $(this).val();
              table_inbound.search(val).draw();
          })

          $('.btn-choose').on('click', function() {
              var selected = table_inbound.rows('.selected').data();
              if (selected.length == 0) {
                  alert('No rows selected');
              } else {
                  var element = selected[0];
                  if (mode_click == 'add') {
                      add_row();
                      index = $('#table_product tbody tr').length - 1;
                  }
                  var id_detail = $('[name="id_detail_inbound[]"]').eq(index).val();
                  var id_product = $('[name="id_product[]"]').eq(index).val();
                  var search = search_id_detail(index, element['id']);
                  if (search == true) {
                      Swal.fire(
                          'PRODUCT DATA ALREADY IN TABLE OUTBOUND!',
                          'PLEASE CHOOSE ANOTHER PRODUCT!',
                          'error'
                      );
                      if (mode_click == 'add') {
                          $('#table_product tbody tr').eq(index).remove();
                      }
                      return;
                  }
                  if (id_detail == element['id'] && id_product == element['id_product']) {

                  } else {
                      $("[name='po_no[]']").eq(index).val(element['po_no']);
                      $("[name='id_detail_inbound[]']").eq(index).val(element['id']);
                      $("[name='id_product[]']").eq(index).val(element['id_product']);
                      $("[name='product_code[]']").eq(index).val(element['product_code']);
                      $("[name='product_name[]']").eq(index).val(element['product_name']);
                      $("[name='box_id[]']").eq(index).val(element['box_id']);
                      $("[name='qty_available[]']").eq(index).val(element['available']);
                      $("[name='qty[]']").eq(index).prop('max', element['available']);
                      $("[name='uom_product[]']").eq(index).val(element['uom_name']);
                      $("[name='locator[]']").eq(index).val(element['locator']);
                  }
                  if (mode_click != 'add') {
                      $('#modal_po').modal('hide');
                  }
              }
          })

          $('.btn-import-product').on('click', function() {
              var id_warehouse = $('#id_warehouse').val();
              if (id_warehouse != '' && id_warehouse != null) {
                  $('#modal_upload').modal();
              } else {
                  alert('WAREHOUSE FIELD IS REQUIRED')
              }
          })

          $('.d-excel').on('click', function() {
              var id_warehouse = $('#id_warehouse').val();
              window.open("<?= site_url('outbound/export_template_import_product_outbound') ?>" + "?id_warehouse=" + id_warehouse);
          })

          $('#form_upload').on('submit', function(e) {
              e.preventDefault();

              var formData = new FormData($(this)[0]);
              formData.append('id_warehouse', $('#id_warehouse').val())
              $.ajax({
                  url: "<?= site_url('outbound/save_upload_data_product_outbound') ?>",
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
                              $.each(result.data_i, function(i, d) {
                                  add_row();
                                  $("[name='po_no[]']").eq(i).val(d.po_no);
                                  $("[name='id_detail_inbound[]']").eq(i).val(d.id_detail);
                                  $("[name='id_product[]']").eq(i).val(d.id_product);
                                  $("[name='product_code[]']").eq(i).val(d.product_code);
                                  $("[name='product_name[]']").eq(i).val(d.product_name);
                                  $("[name='box_id[]']").eq(i).val(d.box_id);
                                  $("[name='qty_available[]']").eq(i).val(d.qty_available);
                                  $("[name='qty[]']").eq(i).prop('max', d.qty);
                                  $("[name='qty[]']").eq(i).val(d.qty);
                                  $("[name='uom_product[]']").eq(i).val(d.uom_product);
                                  $("[name='locator[]']").eq(i).val(d.locator);

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
  <!-- End Script Area -->