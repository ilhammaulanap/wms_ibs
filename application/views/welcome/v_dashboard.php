  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard v1</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <!-- Info boxes -->
              <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box">
                          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-pallet"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Total Received</span>
                              <!-- <span class="info-box-number" id="inbound_total"> -->
                              <span class="info-box-number" id="qty_in">0
                              </span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dolly"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Total On Hand</span>
                              <span class="info-box-number" id="on_hand">0</span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                  <!-- /.col -->

                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>
                    
                  <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck-loading"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Total Shipped</span>
                              <!-- <span class="info-box-number" id="outbound_os">760</span> -->
                              <span class="info-box-number" id="qty_out">0</span>
                          </div>
                          <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                  </div>
                    
                    
                  <!-- /.col -->
                  <!-- <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-truck-moving"></i></span>

                          <div class="info-box-content">
                              <span class="info-box-text">Oubound Delivered</span>
                              <span class="info-box-number" id="outbound_d">2</span>
                          </div> -->
                          <!-- /.info-box-content -->
                      <!-- </div> -->
                      <!-- /.info-box -->
                  <!-- </div> -->
                  <!-- /.col -->
              </div>
                <div class="row">
                        <div class="col-md-3 p-2">
                            <select name="id_warehouse" id="id_warehouse" class="form-control select2"></select>
                        </div>
                </div>
               <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Chart</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 400px; max-height: 500px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
              <!-- /.row -->
          </div>
      </section>
  </div>
  <script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
  <script>
      $(document).ready(function() {
        //   document.getElementById('qty_in').innerHTML = '5';
          var total_qty_in = 0;
          var data;
          $.ajax({
              url: "<?= site_url('welcome/ajax_summary') ?>",
              data: {},
              type: "POST",
              dataType: 'JSON',
            //   beforeSend: function() {},
              success: function(result) {
                // alert("success");
                //   console.log(result);
                //   total_qty_in = result.total_qty_in;
                //   console.log('muncul');
                  
                // //   document.getElementById('qty_in').innerHTML = 'hometown';
                  $('#qty_in').html(result.total_qty_in);
                  $('#qty_out').html(result.total_qty_out);
                  $('#on_hand').html(result.total_qty_on_hand);
                  data = result.data_by_date;
                //   console.log('chart'+data);
                  chart(data);
              },
              error: function(xhr, ajaxOptions, thrownError) {
                //   console.log('error')
              }
          })
        

          function chart(index){
            // console.log(index)
            // index.sort();      
            var ctx = document.getElementById("barChart").getContext("2d");
            var day = [];
            var dataQtyIn = [];
            var dataQtyOut = [];
            var dataQtyOnHand= [];
            if (index.length === 0) { 
                console.log('ada')
                var mybarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: [{
                        label: 'Total Received',
                        fontSize: 20,
                        backgroundColor: "#17a2b8",
                        data: []
                        }, {
                        label: 'Total On Hands',
                        backgroundColor: "#dc3545",                
                        data: []
                        }, {
                        label: 'Total Shipped',
                        backgroundColor: "#28a745",
                        data: []
                        }]
                    },
                    options:  {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false
                    }
                    });
            }else{
                for(var i in index) {
                day.push(index[i]['date']);
                dataQtyIn.push(index[i]['qty_in']);
                dataQtyOut.push(index[i]['qty_out']);
                dataQtyOnHand.push(index[i]['qty_on_hand']);
                }
                var mybarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: day,
                        datasets: [{
                        label: 'Total Received',
                        fontSize: 20,
                        backgroundColor: "#17a2b8",
                        data: dataQtyIn
                        }, {
                        label: 'Total On Hands',
                        backgroundColor: "#dc3545",                
                        data: dataQtyOnHand
                        }, {
                        label: 'Total Shipped',
                        backgroundColor: "#28a745",
                        data: dataQtyOut
                        }]
                    },
                    options:  {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false
                    }
                    });
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
              allowClear: true,
              placeholder: 'All Warehouse',
          });
        $('[name=id_warehouse]').on('change', function() {
            
            var total_qty_in = 0;
            var data = $('[name=id_warehouse]').val();
            console.log(data);
          $.ajax({
              url: "<?= site_url('welcome/ajax_summary') ?>",
              data: {"id_warehouse" : data},
              type: "POST",
              dataType: 'JSON',
            //   beforeSend: function() {},
              success: function(result) {
                // alert("success");
                //   console.log(result);
                //   total_qty_in = result.total_qty_in;
                //   console.log('muncul');
                  
                // //   document.getElementById('qty_in').innerHTML = 'hometown';
                  $('#qty_in').html(result.total_qty_in);
                  $('#qty_out').html(result.total_qty_out);
                  $('#on_hand').html(result.total_qty_on_hand);
                  data = result.data_by_date;
                  console.log(data);
                  chart(data);
              },
              error: function(xhr, ajaxOptions, thrownError) {
                //   console.log('error')
              }
          })
        })
      })
  </script>