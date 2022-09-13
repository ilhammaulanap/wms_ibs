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
                    <!-- <h1 class="m-0 text-dark">Stock Transfer</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Stock Transfer</a></li>
                        <li class="breadcrumb-item active">List Stock Transfer</li>
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
                                        <label>Warehouse</label>
                                        <select name="id_warehouse" id="id_warehouse" class="form-control" required></select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="text-white d-block">Button</label>
                                        <button class="btn btn-secondary btn-search">
                                            <i class="fa fa-bullseye"></i> Update Stock Transfer
                                        </button>
                                        <!-- <button class="btn btn-secondary btn-search">
                                             <i class="fa fa-search"></i> Search Stock Transfer
                                         </button> -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered" style="width: 100%;" id="table_stocktransfer">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Act</th>
                                                <th>Stock Transfer No</th>
                                                <th>Stock Transfer Date</th>
                                                <th>Origin WH</th>
                                                <th>Destination WH</th>
                                                <th>Project</th>
                                                <th>Material</th>
                                                <th>No Mrf</th>
                                                <th>DN</th>
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
        <div class="modal fade" id="modal_stock_transfer" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status Stock Transfer</h5>
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
                                        <input type="hidden" name="id_stock_transfer">
                                        <input name="term" id="term" type="text" class="form-control">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status Stock Transfer</label>
                                    <select name="stock_transfer_status" id="stock_transfer_status" class="form-control select2" required>
                                        <option value="">Select Status</option>
                                        <option value="ordered">Ordered</option>
                                        <option value="in_transit">In Transit</option>
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
                                    <label>Stock Transfer No</label>
                                    <input type="text" class="form-control" name="stock_transfer_no" readonly>
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
    <!-- Modal End -->

</div>

<script>
    $(document).ready(function() {
        var level = "<?= $level ?>";
        var id_stock_transfer = '';
        var table = $('#table_stocktransfer').DataTable({
            ajax: {
                url: "<?= site_url('stocktransfer/ajax_stocktransfer') ?>",
                type: "POST",
                data: function(d) {
                    d.id_warehouse = $('select[name=id_warehouse]').val();
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
                        var status = row['stock_transfer_status'];
                        if (status == 'ordered' || level == 1) {
                            return btn_edit;
                        } else {
                            return '';
                        }
                    },
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
                    data: 'project_name',
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary btn-sm btn-material">' + row['c_material'] + '</button>';
                    }
                },
                {
                    data: 'no_mrf',
                },
                {
                    data: 'stock_transfer_status',
                     render: function(data, type, row) {
                         var btn_view = '<button type="button" class="btn btn-sm btn-dn btn-primary mr-1 mb-1"><i class="fa fa-print"></i>   DN</button>'
                        //  if (data === 'ordered') {
                         if (data === '' || data != null) {
                             return btn_view;
                         } else {
                             return '';
                         }
                     }
                },
                {
                    data: 'stock_transfer_status',
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
                        table.ajax.reload(null, false);
                    }
                }
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

        $('select[name=id_warehouse]').on('change', function() {
            table.ajax.reload();
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
            //table.columns.adjust();
            table_detail.columns.adjust();
            table_product.columns.adjust();
        });

        $('.btn-search').on('click', function() {
            $('#modal_stock_transfer').modal();
            // table_detail.columns.adjust();
            $('#term').focus();
        })

        $("#term").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= site_url('stocktransfer/ajax_list_stocktransfer') ?>",
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
                $('#term').val(ui.item.stock_transfer_no);
                $('[name=stock_transfer_no]').val(ui.item.stock_transfer_no);
                $('[name=id_stock_transfer]').val(ui.item.id);
                var stock_transfer_status = parseInt(ui.item.stock_transfer_status) + 1;
                $('[name=stock_transfer_status]').val(stock_transfer_status).change();
                $('[name=stock_transfer_status]').select2('open');
                table_detail.ajax.reload();
            }
        });

        $('#form_update').on('submit', function(e) {
            e.preventDefault();

            var count = table_detail.rows().count();

            if (count == 0) {
                alert('Failed Save : table product blank.');
                return;
            }

            if (confirm('Are you sure want to submit ?')) {
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "<?= site_url('stocktransfer/save_order_status') ?>",
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
                                            $('#modal_stock_transfer').modal('hide');
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
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status + ' : ' + thrownError);
                        Swal.fire(xhr.status + ' : ' + thrownError, '', 'error');
                        $('button[type=submit]').prop('disabled', false);
                    }
                })
            }
        })

        $('#table_stocktransfer').on('click', '.btn-edit', function() {
            var data = table.row($(this).parent().parent()).data();

            //  window.location.href = "<?= site_url('stocktransfer/edit/') ?>" + data['md5_id']
            window.open("<?= site_url('stocktransfer/edit/') ?>" + data['md5_id']);
        })

        //Date range picker
        $('#status_date').datetimepicker({
            format: 'L',
            locale: 'id',
            minDate: moment(),
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

        $('#table_stocktransfer').on('click', '.btn-dn', function() {
             var data = table.row($(this).parent().parent()).data();
                // console.log('ada')
             window.open("<?= site_url('stocktransfer/pdfdn/') ?>" + data['md5_id']);
         })
    })
</script>