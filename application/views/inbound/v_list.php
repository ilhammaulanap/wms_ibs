  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <!-- <h1 class="m-0 text-dark">Inbound</h1> -->
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Inbound</a></li>
                          <li class="breadcrumb-item active">List Inbound</li>
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
                                      <table class="table" style="width: 100%;" id="table_inbound">
                                          <thead>
                                              <tr>
                                                  <th>ACT</th>
                                                  <th>INBOUND NUMBER</th>
                                                  <th>INBOUND DATE</th>
                                                  <th>MTA NUMBER</th>
                                                  <th>SHIPMENT NUMBER</th>
                                                  <th>FABRICATOR</th>
                                                  <th>DRIVER NAME</th>
                                                  <th>DRIVER CONTACT</th>
                                                  <th>MOT TYPE</th>
                                                  <th>MOT NUMBER</th>
                                                  <th>CONTAINER NUMBER</th>
                                                  <!-- <th>SCAN DN</th>
                                                  <th>MOT PHOTO</th> -->
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
          var level = "<?= $level ?>";
          var table = $('#table_inbound').DataTable({
              ajax: {
                  url: "<?= site_url('inbound/get_inbound') ?>",
                  type: 'POST',
                  data: {},
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
                      data: 'id',
                      render: function(data, type, row) {
                          var btn_view = '<button type="button" class="btn btn-sm btn-confirm btn-primary mr-1 mb-1 text-white"><i class="fa fa-eye"></i> View</button>'
                          var btn_edit = '<button type="button" class="btn btn-sm btn-edit btn-warning mr-1 mb-1 text-white"><i class="fa fa-edit"></i> Edit</button>';
                          var btn_delete = '<button type="button" class="btn btn-sm btn-delete btn-danger mr-1 mb-1 text-white"><i class="fa fa-trash"></i> Delete</button>';
                          btn = [btn_edit, btn_delete];
                          if (level == 1) {
                              return btn;
                          } else {
                              return '';
                          }
                      },
                      //   width: '100px'
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
                      data: 'shipment_no'
                  },
                  {
                      data: 'supplier'
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
                      data: 'no_container'
                  },
                  //   {
                  //       data: 'photo_sj',
                  //       render: function(data, type, row) {
                  //           return '<a target="_blank" href="<?= base_url('files/suratjalan/') ?>' + data + '">' + data + '</a>';
                  //       }
                  //   },
                  //   {
                  //       data: 'photo_truck',
                  //       render: function(data, type, row) {
                  //           return '<a target="_blank" href="<?= base_url('files/truck/') ?>' + data + '">' + data + '</a>';
                  //       }
                  //   },
              ]
          })


          $('#table_inbound').on('click', '.btn-edit', function() {
              var data = table.row($(this).parent().parent()).data();

              window.location.href = "<?= site_url('inbound/edit/') ?>" + data['md5_id']
          })

          $('#table_inbound').on('click', '.btn-delete', function() {
              var data = table.row($(this).parent().parent()).data();
              // console.log(data['md5_id']);
              // window.location.href = "<?= site_url('inbound/order/delete/') ?>" + data['md5_id']
              Swal.fire({
                  title: 'Are you sure you want to permanently delete the data?',
                  confirmButtonText: `OK`,
                  allowOutsideClick: true,
                  allowEscapeKey: true,
                  icon: 'info'
              }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                      $.ajax({
                          type: "POST",
                          url: "<?php echo site_url('inbound/delete_order/') ?>",
                          dataType: "JSON",
                          data: {
                              id: data['md5_id']
                          },
                          success: function(data) {
                              //                             $('#ModalHapus').modal('hide');
                              //                             tampil_data_barang();
                              if (data.code == 200) {
                                  // location.reload();
                                  Swal.fire({
                                      title: data.message,
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
                                      title: data.message,
                                      confirmButtonText: `OK`,
                                      allowOutsideClick: false,
                                      allowEscapeKey: false,
                                      icon: 'warning'
                                  }).then((result) => {
                                      /* Read more about isConfirmed, isDenied below */
                                      if (result.isConfirmed) {
                                          location.reload();
                                      }
                                  })
                              }
                          }
                      })
                      return false;
                  }
              })

              //             })
          })
      })
  </script>