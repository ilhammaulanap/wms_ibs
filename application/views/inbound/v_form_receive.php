<style>
    .help-text {
        display: block;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Form Order</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('inbound') ?>">Inbound</a></li>
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
                            Data Inbound
                        </div>
                        <form id="form_order" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <!-- ROW -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>PO Number</label>
                                                <input type="hidden" name="id" id="id">
                                                <input type="hidden" name="id_stock_transfer" id="id_stock_transfer">
                                                <input type="text" name="po_no" id="po_no" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Warehouse Destination</label>
                                                <input type="text" name="wh_destination" id="wh_destination" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>User</label>
                                                <input type="hidden" id="id_user" name="id_user">
                                                <input type="text" id="name_creator" name="name_creator" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END ROW -->

                                    <!-- ROW  -->
                                    <div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Inbound Date</label>
                                                <input type="hidden" name="id_warehouse" id="id_warehouse">
                                                <input type="date" name="inbound_date" id="inbound_date" class="form-control" min="<?= date('Y-m-1') ?>" autofocus required>
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <label>Shipment Number</label>
                                                <input type="text" name="shipment_no" id="shipment_no" class="form-control" readonly>
                                            </div> -->
                                            <div class="col-md-3">
                                                <label>Supplier</label>
                                                <!-- <select name="id_supplier" id="id_supplier" class="form-control" required></select> -->
                                                <input type="hidden" name="id_supplier" id="id_supplier" class="form-control">
                                                <input type="text" name="name_supplier" id="name_supplier" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>MOT</label>
                                                <!-- <select name="id_mot" id="id_mot" class="form-control" required></select> -->
                                                <input type="hidden" name="id_mot" id="id_mot" class="form-control" >
                                                <input type="text" name="mot" id="mot" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Truck No</label>
                                                <input type="text" name="truck_no" id="truck_no" class="form-control" maxlength="20" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Driver Name</label>
                                                <input type="text" name="driver_name" id="driver_name" class="form-control" maxlength="50" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Driver Contact</label>
                                                <input type="text" name="driver_contact" id="driver_contact" class="form-control" maxlength="13" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <table class="table" id="table_product">
                                            <thead>
                                                <tr>
                                                    <th style="width:30%">Description</th>
                                                    <th style="width:10%">Serial Number</th>
                                                    <th style="width:10%">Shipment Number</th>
                                                    <th style="width:10%">Qty</th>
                                                    <th style="width:5%">UoM</th>
                                                    <th style="width:5%">Locator</th>
                                                    <th style="width:10%">Status</th>
                                                    <!-- <th style="width:10%">Attachment</th> -->
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Shipment Document</label>
                                                    <span class="help-text">Biarkan kosong, jika tidak ingin mengganti</span>
                                                    <input type="file" name="photo_sj" id="photo_sj" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Truck Photo</label>
                                                    <span class="help-text">Biarkan kosong, jika tidak ingin mengganti</span>
                                                    <input type="file" name="photo_truck" id="photo_truck" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- END ROW -->
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-save">
                                                <i class="fa fa-save"> </i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    url = "<?= site_url('inbound/receive_stock_transfer') ?>";
    $(document).ready(function() {

        var id_karyawan = "<?= $id_user ?>";
        var nama_karyawan = "<?= $name_user ?>";
        var id = "<?= $id ?>";
        var id_st = "<?= $id_st ?>";
        var mode = "<?= $mode ?>";
        var id_trash = [];

        function get_info_st(id = '') {
            $.ajax({
                url: "<?= site_url('stocktransfer/info_order') ?>",
                data: {
                    id: id
                },
                type: 'GET',
                beforeSend: function() {
                    $('#loader').removeClass('hidden');
                },
                success: function(result) {
                    if (result) {
                        try {
                            result = JSON.parse(result);

                            if (result.code == 200) {
                                //header
                                var header = result.header;
                                console.log(header);
                                $('[name=id_stock_transfer]').val(header['id']).change();
                                $('[name=inbound_no]').val(header['inbound_no']).change();
                                $('[name=inbound_date]').prop('min', header['stock_transfer_date']).change();
                                $('[name=id_warehouse]').val(header['id_wh_destination']).change();
                                $('[name=wh_destination]').val(header['warehouse_destination']).change();
                                $('[name=po_no]').val(header['stock_transfer_no']).change();
                                $('[name=id_user]').val(header['id_user']).change();
                                $('[name=name_creator]').val(header['name_creator']).change();
                                // $('[name=shipment_no]').val(header['shipment_no']).change();
                                $('[name=id_supplier]').val(header['id_supplier']).change();
                                $('[name=name_supplier]').val(header['supplier']).change();
                                $('[name=id_mot]').val(header['id_mot']).change();
                                $('[name=mot]').val(header['mot']).change();
                                $('[name=driver_name]').val(header['driver_name']).change();
                                $('[name=truck_no]').val(header['truck_no']).change();
                                $('[name=driver_contact]').val(header['driver_contact']).change();

                                var body = result.body;

                                $.each(body, function(i, d) {
                                    add_row();
                                    // $('[name="id_detail[]"').eq(i).val(d.id);
                                    $('[name="lot_number[]"').eq(i).val(d.lot_number);
                                    $('[name="shipment_no[]"').eq(i).val(d.shipment_no);
                                    
                                    var option = new Option(d.product_code + ' ' + d.product_name, d.id_product, true, true);
                                    $('[name="id_product[]"').eq(i).append(option).trigger('change');

                                    var data = $('[name="id_product[]"').eq(i).select2('data')[0];
                                    data['uom'] = d.uom;
                                    $('[name="qty[]"').eq(i).val(d.qty);
                                    $('[name="qty[]"').eq(i).prop('min', d.qty);
                                    $('[name="qty[]"').eq(i).prop('max', d.qty);
                                    $('[name="qty[]"').eq(i).prop('readonly', true);
                                    $('[name="uom_product[]"').eq(i).val(d.uom);

                                    //status
                                    if (d.id_product_status != null) {
                                        var option = new Option(d.product_status, d.id_product_status, true, true);
                                        $('[name="id_product_status[]"').eq(i).append(option).trigger('change');
                                    }

                                    $('[name="photo[]"]').eq(i).prop('required', false);
                                })

                                $('[name=photo_sj]').prop('required', true);
                                $('[name=photo_truck]').prop('required', true);
                                $('.help-text').hide();
                                init_select_product();
                                init_select_product_status();
                            }
                        } catch (e) {
                            console.log(e);
                            Swal.fire(result, '', 'error')
                        }
                    }
                },
                complete: function() {
                    $('#loader').addClass('hidden');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " : " + thrownError);
                }
            })
        }

        function get_info(id = '') {
            $.ajax({
                url: "<?= site_url('inbound/info_order') ?>",
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

                                $('[name=id]').val(header['id']).change();
                                $('[name=inbound_date]').val(header['inbound_date']).change();
                                $('[name=po_no]').val(header['stock_transfer_no']).change();
                                $('[name=id_warehouse]').val(header['id_wh_destination']).change();
                                $('[name=id_user]').val(header['id_user']).change();
                                $('[name=name_creator]').val(header['name_creator']).change();

                                $('[name=truck_no]').val(header['truck_no']).change();
                                $('[name=driver_name]').val(header['driver_name']).change();
                                $('[name=driver_contact]').val(header['driver_contact']).change();
                                
                                // if (header['id_supplier'] != null) {
                                //     // var option = new Option(header['supplier'], header['id_supplier'], true, true);
                                //     // $('#id_supplier').append(option).trigger('change');
                                // }
                                // if (header['id_mot'] != null) {
                                //     var option = new Option(header['mot'], header['id_mot'], true, true);
                                //     $('#id_mot').append(option).trigger('change');
                                // }

                                $('[name=inbound_date]').prop('min', header['inbound_date']).change();

                                var body = result.body;

                                $.each(body, function(i, d) {
                                    add_row();
                                    $('[name="id_detail[]"').eq(i).val(d.id);
                                    $('[name="lot_number[]"').eq(i).val(d.lot_number);
                                    $('[name="shipment_no[]"').eq(i).val(d.shipment_no);
                                    var option = new Option(d.code + ' ' + d.product, d.id_product, true, true);
                                    $('[name="id_product[]"').eq(i).append(option).trigger('change');

                                    var data = $('[name="id_product[]"').eq(i).select2('data')[0];
                                    data['uom'] = d.uom;
                                    $('[name="qty[]"').eq(i).val(d.qty_product);
                                    $('[name="uom_product[]"').eq(i).val(d.uom);
                                   

                                    //locator
                                    if (d.id_locator != null) {
                                        var option = new Option(d.locator, d.id_locator, true, true);
                                        $('[name="id_locator[]"').eq(i).append(option).trigger('change');
                                    }

                                    //locator
                                    if (d.id_product_status != null) {
                                        var option = new Option(d.product_status, d.id_product_status, true, true);
                                        $('[name="id_product_status[]"').eq(i).append(option).trigger('change');
                                    }

                                    $('[name="photo[]"]').eq(i).prop('required', false);
                                })

                                $('[name=photo_sj]').prop('required', false);
                                $('[name=photo_truck]').prop('required', false);
                                $('.help-text').show();
                                init_select_product();
                                init_select_product_status();
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

        function init_select_product() {
            $("[name='id_product[]'").select2({
                ajax: {
                    url: "<?= site_url('product/get_ajax_data_select') ?>",
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
                placeholder: 'Select Product',
            });
        }

        function init_select_product_status() {
            $("[name='id_product_status[]'").select2({
                ajax: {
                    url: "<?= site_url('product/get_ajax_data_select_product_status') ?>",
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
                placeholder: 'Select Product Status',
            });
        }

        function init_select_locator() {
            $("[name='id_locator[]'").select2({
                ajax: {
                    url: "<?= site_url('warehouse/get_ajax_data_select_locator') ?>",
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
                placeholder: 'Select Locator',
            });
        }

        function add_row() {
            var _tr = '<tr>';
            _tr += '<td><select style="width:300px" name="id_product[]" class="form-control select2" required></select></td>';
            _tr += '<td><input style="width:150px" type="text" name="lot_number[]" class="form-control" required></td>';
            _tr += '<td><input style="width:300px" type="text" name="shipment_no[]" class="form-control" required></td>';
            _tr += '<td><input style="width:80px" type="number" step="1" name="qty[]" class="form-control" required></td>';
            _tr += '<td><input style="width:50px" name="uom_product[]" class="form-control-plaintext" readonly></td>';
            _tr += '<td><select style="width:60px" name="id_locator[]" class="form-control" required></select></td>';
            _tr += '<td><select style="width:80px" name="id_product_status[]" class="form-control select2" required></select></td>';
            //_tr += '<td><input type="file" name="photo[]" class="form-control" required></td>';
            _tr += `<td style="width:20px">
              <input type="hidden" name="id_detail[]" value="0">
              <!--<button type="button" class="btn btn-danger btn-trash"><i class="fa fa-trash"></i></button>-->
              </td>`;
            _tr += '</tr>';

            $('#table_product tbody').append(_tr);
            init_select_product();
            init_select_product_status();
            init_select_locator();
        }

        function save_form(formData) {
            $.ajax({
                url: "<?= site_url('inbound/save_order') ?>",
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
                                        title: 'Inbound Number : ' + result.data.inbound_no,
                                        confirmButtonText: `OK`,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        icon: 'success'
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                            window.location.href = "<?= site_url('inbound') ?>"
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        title: result.message,
                                        icon: 'succes',
                                        timer: 500,
                                    }).then(function() {
                                        window.location.href = "<?= site_url('inbound') ?>"
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

        // $("[name='id_supplier']").select2({
        //     ajax: {
        //         url: "<?= site_url('supplier/get_ajax_data') ?>",
        //         type: "POST",
        //         dataType: 'JSON',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 searchTerm: params.term, // search term
        //             };
        //         },
        //         processResults: function(response) {
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     },
        //     placeholder: 'Select Supplier',
        // });

        // $("[name='id_mot']").select2({
        //     ajax: {
        //         url: "<?= site_url('mot/get_ajax_data') ?>",
        //         type: "POST",
        //         dataType: 'JSON',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 searchTerm: params.term, // search term
        //             };
        //         },
        //         processResults: function(response) {
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     },
        //     placeholder: 'Select Mot',
        // });

        $(document).on('change', 'input[type=file]', function() {
            var filePath = $(this).val();
            var allowedExtensions = /(\.pdf|\.doc|\.jpg|\.png|\.docx|\.jpeg|\.msg|\.xls|\.xlsx|\.htm|\.html)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png/.pdf/.doc/.msg/.xls/.html only.');
                $(this).val('');
                return false;
            }
        });

        if (mode == 'edit') {
            get_info(id);
        } else {
            get_info_st(id_st);
        }

        $('#form_order').on('submit', function(e) {
            e.preventDefault();

            var row = $('#table_product tbody tr').length;
            if (row == 0) {
                Swal.fire({
                    'title': 'Mohon mengisi tabel.'
                });
            }

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
                        // unlock_warehouse();
                        var formdata = new FormData($(this)[0]);
                        formdata.append('id_trash', id_trash);
                        save_form(formdata);
                    }
                }
            })
        })
    })
</script>