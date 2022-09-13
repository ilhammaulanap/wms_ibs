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
                          <li class="breadcrumb-item active">History Outbound</li>
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
                              <h3 class="card-title">Outbound History</h3>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Outbound Date:</label>

                                          <div class="input-group">
                                              <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                      <i class="far fa-calendar-alt"></i>
                                                  </span>
                                              </div>
                                              <input type="text" class="form-control float-right" id="reservation">
                                          </div>
                                          <!-- /.input group -->
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Warehouse</label>
                                      <select name="id_warehouse" id="id_warehouse" class="form-control select2"></select>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Product</label>
                                      <select name="id_product" id="id_product" class="form-control select2"></select>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Locator</label>
                                      <select name="id_locator" id="id_locator" class="form-control select2"></select>
                                  </div>
                                  <div class="col-md-12 mt-2">
                                      <table class="table" style="width: 100%;" id="table_outbound">
                                          <thead>
                                              <tr>
                                                  <th>OUTBOUND NUMBER</th>
                                                  <th>OUTBOUND DATE</th>
                                                  <th>REQUEST NUMBER</th>
                                                  <th>PRODUCT CODE</th>
                                                  <th>PRODUCT GROUP CODE</th>
                                                  <th>DESCRIPTION</th>
                                                  <th>QTY</th>
                                                  <th>UOM</th>
                                                  <th>Status</th>
                                                  <th>Vendor</th>
                                                  <th>PICK LIST</th>
                                                  <th>DELIVERY NOTE</th>
                                                  <th>SITE ID</th>
                                                  <th>SITE NAME</th>
                                                  <th>SITE WBS</th>
                                                  <th>Driver Name</th>
                                                  <th>Driver Contact</th>
                                                  <th>MOT TYPE</th>
                                                  <th>Truck NUMBER</th>
                                                  <th>PO NUMBER</th>
                                                  <th>WO NUMBER</th>
                                                  <th>LINK DOCUMENT</th>
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

          var startDate = moment().subtract('days', 29);
          var endDate = moment();

          //Date range picker
          $('#reservation').daterangepicker({
                  startDate: startDate,
                  endDate: endDate,
                  minDate: '01/01/2021',
                  showDropdowns: true,
                  showWeekNumbers: true,
              },
              function(start, end) {
                  console.log("Callback has been called!");
                  //$('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
                  startDate = start;
                  endDate = end;
                  //table.ajax.reload();
              }
          );


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

          $("[name='id_product']").select2({
              ajax: {
                  url: "<?= site_url('outbound/get_ajax_data_select_product') ?>",
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
              placeholder: 'Select Product',
          });

          $("[name='id_locator']").select2({
              ajax: {
                  url: "<?= site_url('outbound/get_ajax_data_select_locator') ?>",
                  type: "POST",
                  dataType: 'JSON',
                  delay: 250,
                  data: function(params) {
                      return {
                          searchTerm: params.term, // search term
                          id_product: $('[name=id_product]').val(),
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


          var table = $('#table_outbound').DataTable({
              ajax: {
                  url: "<?= site_url('outbound/get_outbound_history') ?>",
                  type: 'POST',
                  data: function(d) {
                      d.date1 = startDate.format('YYYY-MM-DD');
                      d.date2 = endDate.format('YYYY-MM-DD');
                      d.id_warehouse = $('#id_warehouse').val();
                      d.id_product = $('#id_product').val();
                      d.id_locator = $('#id_locator').val();
                  },
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
                      data: 'outbound_no'
                  },
                  {
                      data: 'outbound_date'
                  },
                  {
                      data: 'mr_no',
                      width: '80px'
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
                      data: 'qty'
                  },
                  {
                      data: 'uom_name'
                  },
                  {
                      data: 'status_outbound',
                      render: function(data, type, row) {
                          var status = ['On Preparation', 'Ready to Pick Up', 'Delivered', 'Back to Stock'];
                          return status[data - 1];
                      }
                  },
                  {
                      data: 'vendor'
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
                     data: 'site_id'
                 },
                 {
                     data: 'site_name'
                 },
                 {
                     data: 'site_wbs'
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
              ]
          })

          $('[name=id_warehouse]').on('change', function() {
              table.ajax.reload();
          })
          $('[name=id_product]').on('change', function() {
              table.ajax.reload();
          })
          $('[name=id_locator]').on('change', function() {
              table.ajax.reload();
          })

          $('#table_outbound').on('click', '.btn-pl', function() {
             var data = table.row($(this).parent().parent()).data();
            //  console.log(data)
                var id = data['md5_id'];
                // console.log(data['id_outbound']);
             window.open("<?= site_url('outbound/order/print_pl/') ?>" + id);
         })

         $('#table_outbound').on('click', '.btn-dn', function() {
             var data = table.row($(this).parent().parent()).data();
             var id = data['md5_id'];
             window.open("<?= site_url('outbound/order/pdfdn/') ?>" + id);
         })
        //   var MD5 = function(d){var r = M(V(Y(X(d),8*d.length)));return r.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}
      })
  </script>