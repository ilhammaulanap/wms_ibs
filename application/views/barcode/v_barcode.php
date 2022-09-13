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
                                  <?php
                                      $data  = json_encode($code);
                                      // print_r($data);
                                  foreach ($code as $value) {
                                      ?>
                                      
                                      <img src="<?php echo site_url();?>barcode/generate/<?php echo $value;?>" id="<?php echo $value?>">
                                      <?php
                                  // echo "$value <br>";
                                }
                                ?>
                                  
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
$(document).ready(function(){
  // console.log('ada');
  var data = <?php echo json_encode($code); ?>;
  var x = document.getElementById(data[0]).src;
  
  for (let i = 0; i < data.length; i++) {
  // console.log(data[i]);
    x = document.getElementById(data[0]).src;
    // console.log(x);
    download(x);
  }
  // console.log(x);
  // download(x);
});
function download(url) {
  var a = $("<a>").attr("href", url).attr("download", "img.png").appendTo("body");

    a[0].click();

    a.remove();
    // console.log(url)
        // const a = document.createElement("a");
        // a.href = toDataURL(url);
        // a.download = "myImage.png";
        // document.body.appendChild(a);
        // a.click();
        // document.body.removeChild(a);
}
</script>

