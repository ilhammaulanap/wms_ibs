<!DOCTYPE html>
<html>
<?php
$info = get_info();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= (isset($title) ? $title . ' | ' : '') . $info['title'] . ' ' . $info['code'] ?></title>
    <link rel="icon" type="image" href="<?= base_url('assets/') ?>img/warehouse/logo-able-mini.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/bootstrap.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-select/css/select.bootstrap4.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/toastr/toastr.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    
    <script>
        /** add active class and stay opened when selected */
        var url = "<?= base_url() ?>";
        var url1 = "<?= $this->uri->segment(1, ''); ?>";
        var url2 = "<?= $this->uri->segment(2, ''); ?>";
        if (url1 != '') {
            url += url1;
        }
        if (url2 != '') {
            url += '/' + url2;
        }
    </script>