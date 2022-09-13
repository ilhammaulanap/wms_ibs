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
                  <div class="col-12">
                      <!-- <div class="callout callout-info">
                          <h5><i class="fas fa-info"></i> Note:</h5>
                          This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                      </div> -->

  
                      <!-- Main content -->
                      <div class="invoice p-3 mb-3">
                          <!-- title row -->
                          <div class="row">
                              <div class="col-12">
                                  <h4>
                                  <img height="50" src="<?= base_url('assets/img/warehouse/logo-ibs.png') ?>" alt=""> Picking List
                                      <small class="float-right">Date: <?= $header->row()->outbound_date ?></small>
                                  </h4>
                              </div>
                              <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info mt-2">
                              <div class="col-6">
                                  <dl>
                                      <dt>Outbound No</dt>
                                      <dd><?= $header->row()->outbound_no ?></dd>
                                      <dt>Material Request No</dt>
                                      <dd><?= $header->row()->mr_no ?></dd>
                                  </dl>
                              </div>
                              <div class="col-6">
                                  <dl>

                                      <dt>Destination</dt>
                                      <dd><?= $header->row()->destination ?></dd>
                                      <dt>Site Name</dt>
                                      <dd><?= $header->row()->site_name ?></dd>
                                  </dl>
                              </div>
                          </div>
                          <!-- /.row -->

                          <!-- Table row -->
                          <div class="row">
                              <div class="col-12 table-responsive">
                                  <table class="table table-striped">
                                      <thead>
                                          <tr>
                                              <th>Product Code</th>
                                              <th>Material Name</th>
                                              <th>Serial Number</th>
                                              <th>Qty</th>
                                              <th>UoM</th>
                                              <th>Location</th>
                                              <th>Remark</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                            foreach ($body->result() as $row) :
                                            ?>
                                              <tr>
                                                  <td><?= $row->product_code ?></td>
                                                  <td><?= $row->product_name ?></td>
                                                  <td><?= $row->lot_number ?></td>
                                                  <td><?= $row->qty ?></td>
                                                  <td><?= $row->uom ?></td>
                                                  <td><?= $row->locator ?></td>
                                                  <td></td>
                                              </tr>
                                          <?php
                                            endforeach;
                                            ?>
                                      </tbody>
                                  </table>

                                  <table class="table table-bordered">
                                      <tr>
                                          <td style="width:200px">Picker</td>
                                          <td style="width:200px">Admin</td>
                                          <td style="width:200px">Pic Gudang</td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <br><br><br>
                                          </td>
                                          <td></td>
                                          <td></td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp</td>
                                          <td>&nbsp</td>
                                          <td>&nbsp</td>
                                      </tr>
                                  </table>
                              </div>
                              <!-- /.col -->
                          </div>

                          <!-- /.row -->

                          <!-- this row will not appear when printing -->
                          <div class="row no-print">
                              <div class="col-12">
                                  <button type="button" class="btn btn-default" onclick="window.print();"><i class="fas fa-print"></i> Print</button>
                                  <button type="button" class="btn btn-primary btn-pdf float-right" style="margin-right: 5px;">
                                      <i class="fas fa-download"></i> Generate PDF
                                  </button>
                              </div>
                          </div>
                      </div>
                      <!-- /.invoice -->
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div>
      </section>
  </div>

  <script>
      $(document).ready(function() {
          $('.btn-pdf').on('click', function() {
              window.open('<?= site_url("outbound/order/pdf/" . $id) ?>')
          })
      });
  </script>