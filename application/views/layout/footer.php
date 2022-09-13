<script>
    $(function() {
        bsCustomFileInput.init();
    });

    function set_menu(url) {
        console.log(url);
        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    }

    set_menu(url);

    //select2 active
    $('.select2').select2();

    $('.btn-sign-out').on('click', function() {
        $.ajax({
            url: "<?= site_url('auth/submit_logout') ?>",
            type: 'POST',
            dataType: 'JSON',
            success: function(result) {
                if (result.code == 200) {
                    window.location.href = "<?= site_url('auth') ?>"
                }
            }
        })
    })
</script>
<!-- /.content-wrapper -->
<footer class="main-footer">
<div class="center" style="
  text-align: center;">
   <img src="<?php echo base_url(
        'assets/img/warehouse/logo-temans.png'
    ); ?>" alt="fiberhome" style="width: 100px;height: 50px; margin:10px">
    <img src="<?php echo base_url(
        'assets/img/warehouse/logo-ibs.png'
    ); ?>" alt="fiberhome" style="width: 70px;height: 50px; margin:10px">
    <img src="<?php echo base_url(
        'assets/img/warehouse/logo-bhakti.svg'
    ); ?>" alt="Bakti" style="width: 100px;height: 50px; margin:10px">
    <img src="<?php echo base_url(
        'assets/img/warehouse/logo-kominfo.png'
    ); ?>" alt="Bakti" style="width: 70px;height: 50px; margin:10px">
</div>
<div>
<strong>Copyright &copy; <?= date(
        'Y'
    ) ?> <a href="#">Warehouse Management System</a>.</strong>
    All rights reserved.
    
    
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.2
    </div>
</div>
   
</footer>

<div class="modal fade" id="modal_general">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_notif" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="loader" class="lds-dual-ring hidden overlay"></div>
</div>
</div>
<!-- ./wrapper -->
</body>

</html>