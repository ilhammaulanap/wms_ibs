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
                            Data Stock Transfer
                        </div>
                        <form id="form_order" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <!-- ROW -->
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Stock Transfer Sent Date</label>
                                                    <input type="hidden" name="id" id="id">
                                                    <input type="date" name="stock_transfer_date" id="stock_transfer_date" class="form-control" min="<?= date('Y-m-d') ?>" autofocus required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>User</label>
                                                    <input type="hidden" id="id_user_created" name="id_user_created">
                                                    <input type="text" id="name_creator" name="name_creator" class="form-control-plaintext" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>No MRF</label>
                                                    <input type="text" id="no_mrf" name="no_mrf" class="form-control" placeholder="No MRF" required title="Only alphanumeric characters, - , . , _ and @."  pattern="^[a-zA-Z0-9.-_@\s]+$" minlength="1" maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Project Name</label>
                                                    <!-- <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Project Name" title="Only alphanumeric characters, - , . , _ and @."  pattern="^[a-zA-Z0-9.-_@\s]+$" minlength="1" maxlength="150" required> -->
                                                    <select name="id_project" id="id_project" class="form-control select2"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>From</label>
                                                    <select name="id_wh_origin" id="id_wh_origin" class="form-control" required></select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>To</label>
                                                    <select name="id_wh_destination" id="id_wh_destination" class="form-control" required></select>
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
                                                    <th>PO Number</th>
                                                    <th>Item Code</th>
                                                    <th>Item Description</th>
                                                    <th>Available</th>
                                                    <th>Qty</th>
                                                    <th>Unit</th>
                                                    <th>Locator</th>
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
                                            <i class="fa fa-plus"> </i> Add Rows
                                        </button>
                                        <button type="button" class="btn btn-primary btn-import-product">
                                            <i class="fa fa-file-excel"> </i> Import
                                        </button>
                                        <button type="submit" class="btn btn-success btn-save">
                                            <i class="fa fa-save"> </i> Save
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
                <h5 class="modal-title">Search PO Stock Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Product</label>
                            <select name="id_product" id="id_product" class="form-control select2" aria-placeholder="Search Product"></select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" name="search_stock_transfer" id="search_stock_transfer" class="form-control" placeholder="PO Number/Shipment Number, etc...">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-sm" style="width: 100%;" id="table_inbound">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>PO Number</th>
                                    <th>Shipment Number</th>
                                    <th>Stock Transfer Date</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Available</th>
                                    <th>Locator</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-choose">Choose</button>
            </div>
        </div>
    </div>
</div>
<script>
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

        $("[name='id_wh_origin']").select2({
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

        $("[name='id_wh_destination']").select2({
            ajax: {
                url: "<?= site_url('warehouse/get_ajax_data_select_all') ?>",
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
                        id_warehouse: $('[name=id_wh_origin]').val(),
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            placeholder: 'Search Product',
        });

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
            _tr += '<td style="width:100px"><input type="number" step="0.01" name="qty_available[]" class="form-control" readonly></td>';
            _tr += '<td style="width:100px"><input type="number" step="0.01" name="qty[]" class="form-control" required></td>';
            _tr += '<td style="width:50px"><input name="uom_product[]" type="text" class="form-control-plaintext" readonly></td>';
            _tr += '<td style="width:50px"><input type="text" name="locator[]" class="form-control" readonly></td>';
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

        function save_form(formData) {
            $.ajax({
                url: "<?= site_url('stocktransfer/save_order') ?>",
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
                                        title: 'Outbound Number : ' + result.data.stock_transfer_no,
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

        function get_info(id = '') {
            $.ajax({
                url: "<?= site_url('stocktransfer/info_order') ?>",
                data: {
                    id: id
                },
                type: 'GET',
                beforeSend: function() {},
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

                                var option = new Option(header['warehouse_origin'], header['id_wh_origin'], true, true);
                                $('#id_wh_origin').append(option).trigger('change');

                                var option = new Option(header['warehouse_destination'], header['id_wh_destination'], true, true);
                                $('#id_wh_destination').append(option).trigger('change');

                                $('[name=stock_transfer_date]').prop('min', header['stock_transfer_date']).change();

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
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " : " + thrownError);
                }
            })
        }

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

        $('.btn-add-product').on('click', function() {
            var origin = $('#id_wh_origin').val();
            var warehouse = $('#id_wh_destination').val();
            origin = origin == null ? '' : origin;
            warehouse = warehouse == null ? '' : warehouse;

            if (origin == '' && warehouse == '') {
                toastr.error('Please Select Warehouse!')
            } else {
                mode_click = 'add';
                table_inbound.ajax.reload();
                $('[name=id_product]').select2('open');
                $('#modal_po').modal();
            }
        })

        var table_inbound = $('#table_inbound').DataTable({
            ajax: {
                url: "<?= site_url('inbound/get_inbound_product') ?>",
                type: "POST",
                data: function(d) {
                    d.id_warehouse = $('[name=id_wh_origin]').val();
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
                        'Product sudah ada pada list!',
                        'Silahkan pilih product lain!',
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

        $('#form_order').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Do you want to save the changes?',
                showCancelButton: true,
                confirmButtonText: `Save`,
                allowOutsideClick: false,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    //check table length
                    var row = $('#table_product tbody tr').length;
                    if (row == 0) {
                        Swal.fire('Please fill product table', '', 'info');
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

        $("[name='id_project']").select2({
              ajax: {
                  url: "<?= site_url('project/get_ajax_project') ?>",
                  type: "POST",
                  dataType: 'JSON',
                  delay: 250,
                  data: function(params) {
                      return {
                          searchTerm: params.term, // search term
                          id_warehouse: $('[name=id_wh_origin]').val(),
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
    });
</script>