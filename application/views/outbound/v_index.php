 <style>
     .ui-autocomplete {
         z-index: 2147483647;
     }
 </style>
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
                             Manage Data Outbound
                         </div>
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <?php if( $level !=2){
                                             ?>
                                            <button class="btn btn-secondary btn-search">
                                             <i class="fa fa-bullseye"></i> Update Outbound
                                            </button>
                                        <?php
                                         }
                                         ?>
                                         
                                         <!-- <button class="btn btn-secondary btn-search">
                                             <i class="fa fa-search"></i> Search Outbound
                                         </button> -->
                                     </div>
                                 </div>
                                 <div class="col-md-12">
                                     <div class="mb-2">
                                        <div class="col-md-3">
                                            <label>Warehouse</label>
                                            <select name="id_warehouse" id="id_warehouse" class="form-control select2"></select>
                                        </div>
                                     </div>
                                     <table class="table table-striped table-bordered" style="width: 100%;" id="table_outbound">
                                         <thead>
                                             <tr>
                                                 <th></th>
                                                 <th>ACT</th>
                                                 <th>OUTBOUND NUMBER</th>
                                                 <th>WAREHOUSE</th>
                                                 <th>OUTBOUND DATE</th>
                                                 <th>ORDER NUMBER</th>
                                                 <th>DESTINATION OUTBOUND</th>
                                                 <th>SITE ID </th>
                                                 <TH>SITE NAME</TH>
                                                 <TH>SITE WBS</TH>
                                                 <th>PRODUCT</th>
                                                 <th>STATUS</th>
                                                 <th>PICK LIST</th>
                                                 <th>DELIVERY NOTE</th>
                                                 <th>VENDOR</th>
                                                 <th>DRIVER NAME</th>
                                                 <th>DRIVER CONTACT</th>
                                                 <th>MOT TYPE</th>
                                                 <th>MOT NUMBER</th>
                                                 <th>PO NUMBER</th>
                                                 <th>WU NUMBER</th>
                                                 <th>LINK DOCUMENT</th>
                                                 <th>FILE SCANNED DN</th>
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
                         <h5 class="modal-title">UPDATE STATUS</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label>SEARCH</label>
                                     <div class="input-group input-group-sm">
                                         <input type="hidden" name="id_outbound">
                                         <input name="term" id="term" type="text" class="form-control" placeholder="OUTBOUND NUMBER, ORDER NUMBER">
                                         <span class="input-group-append">
                                             <button type="button" class="btn btn-info btn-flat">Search</button>
                                         </span>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>OUTBOUND STATUS</label>
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
                                     <label>DATE (mm/dd/yyyy)</label>
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
                                     <label>TIME</label>

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
                                     <label>TRUCK NUMBER</label>
                                     <input type="text" name="truck_no" id="truck_no" placeholder="Nomor Mobil" class="form-control" readonly>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>DRIVER NAME</label>
                                     <input type="text" name="driver_name" id="driver_name" placeholder="Nama Driver" class="form-control" readonly>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>DRIVER CONTACT</label>
                                     <input type="text" name="driver_contact" id="driver_contact" placeholder="Nomor Kontak Driver" class="form-control" readonly>
                                 </div>
                             </div>
                             <!-- <div class="col-md-4">
                                 <div class="form-group">
                                     <label>Vendor</label>
                                     <input type="text" name="vendor" id="vendor" placeholder="Vendor" class="form-control" readonly>
                                 </div>
                             </div> -->
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>MOT TYPE</label>
                                     <select name="id_mot" id="id_mot" class="form-control" disabled></select>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label>SCANNED DN</label>
                                     <input type="file" name="file_dn" id="file_dn" class="form-control" readonly>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <table class="table dataTableLayout" style="width: 100%;" id="table_detail">
                                     <thead>
                                         <tr>
                                             <th>NO</th>
                                             <th>PRODUCT CODE</th>
                                             <th>DESCRIPTION</th>
                                             <th>STATUS</th>
                                             <th>QTY</th>
                                             <th>LOCATOR</th>
                                         </tr>
                                     </thead>
                                 </table>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                         <button type="submit" class="btn btn-primary">UPDATE</button>
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
                     <h5 class="modal-title">PRODUCT DETAIL</h5>
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
                                         <th>NO</th>
                                         <th>PRODUCT CODE</th>
                                         <th>PRODUCT GROUP</th>
                                         <th>DESCRIPTION</th>
                                         <th>PO NUMBER</th>
                                         <th>SERIAL NUMBER</th>
                                         <th>BOX ID</th>
                                         <th>LOCATOR</th>
                                         <th>QTY</th>
                                         <th>NOTE</th>
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
        $("[name='id_warehouse']").select2({
              ajax: {
                  url: "<?= site_url('outbound/get_ajax_data_select_wh') ?>",
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
          
         var level = "<?= $level ?>";
         var id_outbound = '';
         var table = $('#table_outbound').DataTable({
             ajax: {
                 url: "<?= site_url('outbound/ajax_outbound') ?>",
                 type: "POST",
                 data: function(d) {
                    d.id_warehouse = $('#id_warehouse').val();
                 },
             },
             order: [],
             columns: [{
                     data: 'id',
                     render: function(data, type, row) {
                         return '';
                     }
                 },
                 {
                     data: "id",
                     render: function(data, type, row) {
                         var btn_edit = '<button type="button" class="btn btn-sm btn-edit btn-warning mr-1 mb-1 text-white"><i class="fa fa-edit"></i> Edit</button>'
                         var status = row['status_outbound'];
                         if (level == 1) {
                             return btn_edit;
                         } else {
                             return '';
                         }
                     },
                     width: '70px'
                 },
                 {
                     data: 'outbound_no'
                 },
                 {
                     data: 'warehouse'
                 },
                 {
                     data: 'outbound_date'
                 },
                 {
                     data: 'mr_no'
                 },
                 {
                     data: 'destination',
                     width: '450px'
                 },
                 {
                     data: 'site_id'
                 },
                 {
                     data: 'site_name'
                 },
                 {
                     data: 'site_wbs'
                 },
                 {
                     data: 'id',
                     render: function(data, type, row) {
                         return '<button class="btn btn-primary btn-sm btn-material">' + row['c_material'] + '</button>';
                     }
                 },
                 {
                     data: 'status_outbound',
                     render: function(data, type, row) {
                         var status = ['On Preparation', 'Ready to Pick Up', 'Delivered', 'Back to Stock'];
                         return status[data - 1];
                     }
                 },
                 {
                     data: 'status_outbound',
                     render: function(data, type, row) {
                         var btn_view = '<button type="button" class="btn btn-sm btn-pl btn-primary mr-1 mb-1"><i class="fa fa-print"></i>   PL</button>'
                         if (data >= 1) {
                             return btn_view
                         } else {
                             return '';
                         }
                     }
                 },
                 {
                     data: 'status_outbound',
                     render: function(data, type, row) {
                         var btn_view = '<button type="button" class="btn btn-sm btn-dn btn-primary mr-1 mb-1"><i class="fa fa-print"></i>   DN</button>'
                         if (data > 1 && data < 4) {
                             return btn_view;
                         } else {
                             return '';
                         }
                     }
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
                     data: 'po_no'
                 },
                 {
                     data: 'wu_no'
                 },
                {
                    data: 'link_attach',
                    render: function(data, type, row) {
                    url_doc = decodeURIComponent(data);
                    // return '<p>' + url_doc + '</p>'
                    if(url_doc == null || url_doc === '' || url_doc === 'null'){
                        return '<p>No Data</p>'                            
                    }else{
                        return '<a target="_blank" href="' + url_doc + '"> Link</a>';
                    }
                        
                    }
                },
                
                {
                    data: 'file_dn',
                    render: function(data, type, row) {
                    url_doc = "<?= site_url('files/dn/') ?>"+data;

                    // return '<p>' + url_doc + '</p>'
                    if(url_doc == null || url_doc === '' || url_doc === 'null'){
                        return '<p>No Data</p>'                            
                    }else{
                        return '<a target="_blank" href="' + url_doc + '"> Link</a>';
                    }
                        
                    }
                },
             ],
             responsive: true,
             scrollX: true,
             scollCollapse: true,
             stateSave: true,
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
         })

         $('[name=id_warehouse]').on('change', function() {
              table.ajax.reload();
          })
         var table_detail = $('#table_detail').DataTable({
             ajax: {
                 url: "<?= site_url('outbound/get_outbound_product') ?>",
                 type: "POST",
                 data: function(d) {
                     d.id_outbound = $('[name=id_outbound]').val();
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
             //table.columns.adjust();
             table_detail.columns.adjust();
             table_product.columns.adjust();
         });

         //Date range picker
         $('#status_date').datetimepicker({
             format: 'L',
             locale: 'id'
         });

         //Timepicker
         $('#status_time').datetimepicker({
             format: 'LT',
             locale: 'id'
         })

         $('[name=status_outbound]').on('change', function() {
             var val = $(this).val();

             if (val == '3') {
                 $('[name=file_dn]').show();
                 $('[name=truck_no]').prop('readonly', true);
                 $('[name=driver_name]').prop('readonly', true);
                 $('[name=vendor]').prop('readonly', true);
                 $('[name=driver_contact]').prop('readonly', true);
                 $('[name=id_mot]').prop('disabled', true);
                 $('[name=file_dn]').prop('required', true);
                 $('[name=file_dn]').prop('readonly', false);
             } else if (val == '2') {
                 $('[name=file_dn]').hide();
                 $('[name=truck_no]').prop('required', true);
                 $('[name=driver_name]').prop('required', true);
                 $('[name=driver_contact]').prop('required', true);
                 $('[name=vendor]').prop('required', true);
                 $('[name=id_mot]').prop('required', true);

                 $('[name=truck_no]').prop('readonly', false);
                 $('[name=driver_name]').prop('readonly', false);
                 $('[name=driver_contact]').prop('readonly', false);
                 $('[name=vendor]').prop('readonly', false);
                 $('[name=id_mot]').prop('disabled', false);
             } else {
                 $('[name=truck_no]').prop('required', false);
                 $('[name=driver_name]').prop('required', false);
                 $('[name=driver_contact]').prop('required', false);
                 $('[name=vendor]').prop('required', false);
                 $('[name=id_mot]').prop('required', false);
                 $('[name=file_dn]').hide();

                 $('[name=truck_no]').prop('readonly', true);
                 $('[name=driver_name]').prop('readonly', true);
                 $('[name=driver_contact]').prop('readonly', true);
                 $('[name=vendor]').prop('readonly', true);
                 $('[name=id_mot]').prop('disabled', true);
                 $('[name=file_dn]').prop('readonly', true);
             }
         })

         $('.btn-search').on('click', function() {
             $('#modal_outbound').modal();
             table_detail.columns.adjust();
             $('#term').focus();
         })

         $("#term").autocomplete({
             source: function(request, response) {
                 $.ajax({
                     url: "<?= site_url('outbound/ajax_list_outbound') ?>",
                     type: 'POST',
                     dataType: 'JSON',
                     data: {
                         term: request.term
                     },
                     success: function(data) {
                         response(data);
                     }
                 });
             },
             minLength: 1,
             select: function(event, ui) {
                 event.preventDefault();
                 $('#term').val(ui.item.outbound_no);
                 $('[name=id_outbound]').val(ui.item.id);
                 $('[name=status_date]').val(ui.item.date_status);
                 $('[name=status_time]').val(ui.item.time_status);
                 var status_outbound = parseInt(ui.item.status_outbound) + 1;
                 $('[name=status_outbound]').val(status_outbound).change();
                 $('[name=status_outbound]').select2('open');
                 table_detail.ajax.reload();
             }
         });

         $('#form_update').on('submit', function(e) {
             e.preventDefault();

             var count = table_detail.rows().count();

             if (count == 0) {
                 alert('Table cannot blank');
                 return;
             }

             if (confirm('Are you sure want to submit ?')) {
                 var formData = new FormData($(this)[0]);
                 $.ajax({
                     url: "<?= site_url('outbound/save_order_status') ?>",
                     data: formData,
                     processData: false,
                     contentType: false,
                     async: false,
                     cache: false,
                     enctype: 'multipart/form-data',
                     type: 'POST',
                     beforeSend: function() {
                         $("button[type=submit]").prop("disabled", true);
                         $('#loader').removeClass('hidden');
                     },
                     success: function(result) {
                         if (result) {
                             try {
                                 result = JSON.parse(result);
                                 console.log(result);
                                 if (result.code == 200) {
                                     Swal.fire({
                                         title: 'Save Status Success',
                                         confirmButtonText: `OK`,
                                         allowOutsideClick: false,
                                         allowEscapeKey: false,
                                         icon: 'success'
                                     }).then((result) => {
                                         /* Read more about isConfirmed, isDenied below */
                                         if (result.isConfirmed) {
                                             $('#modal_outbound').modal('hide');
                                             table.ajax.reload();
                                             //location.reload();
                                         }
                                     })
                                 } else {
                                     Swal.fire(result.message, '', 'error')
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
         })

         $('#table_outbound').on('click', '.btn-edit', function() {
             var data = table.row($(this).parent().parent()).data();

             //  window.location.href = "<?= site_url('outbound/order/edit/') ?>" + data['md5_id']
             window.open("<?= site_url('outbound/order/edit/') ?>" + data['md5_id']);
         })

         $('#table_outbound').on('click', '.btn-pl', function() {
             var data = table.row($(this).parent().parent()).data();

             window.open("<?= site_url('outbound/order/print_pl/') ?>" + data['md5_id']);
         })

         $('#table_outbound').on('click', '.btn-dn', function() {
             var data = table.row($(this).parent().parent()).data();

             window.open("<?= site_url('outbound/order/pdfdn/') ?>" + data['md5_id']);
         })

         $("[name='id_mot']").select2({
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

         var table_product = $('#tb_product').DataTable({
             ajax: {
                 url: "<?= site_url('outbound/get_outbound_product') ?>",
                 type: "POST",
                 data: function(d) {
                     d.id_outbound = id_outbound;
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
                     data: 'name_category'
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
                     data: 'box_id'
                 },
                 {
                     data: 'locator'
                 },
                 {
                     data: 'qty',
                 },
                 {
                     data: 'note',
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

         $('#table_outbound tbody').on('click', '.btn-material', function() {
             var data = table.row($(this).parent().parent()).data();
             id_outbound = data['id'];
             table_product.ajax.reload();
             $('#modal_product').modal();
         })

     })
 </script>