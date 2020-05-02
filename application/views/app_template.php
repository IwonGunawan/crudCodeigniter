<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$page." - CRUD.Admin" ;?></title>
    <meta name="description" content="Admin Page - Iwon.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?=base_url('assets/img/icon.png');?>">
    <link rel="shortcut icon" href="<?=base_url('assets/img/icon.png');?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendor/plugins/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/plugins/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/plugins/themify-icons/css/themify-icons.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/plugins/flag-icon-css/css/flag-icon.min.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/assets/css/style.css'); ?>">

    <link rel='stylesheet' href='<?= base_url('assets/css/font-google.css');?>'>
    <script src="<?= base_url('assets/vendor/plugins/jquery/dist/jquery.min.js'); ?> "></script>
    <script src="<?=base_url('assets/vendor/plugins/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/plugins/datatables.net-buttons/js/dataTables.buttons.min.js');?>"></script>
    <script src="<?=base_url('assets/vendor/assets/js/init-scripts/data-table/datatables-init.js');?>"></script>


<body>


    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <?=$this->load->view("app_sidebar");?>
    </aside>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">            
            <?=$this->load->view("app_topbar"); ?>
        </header>

        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <?=$this->load->view("app_breadcrumbs"); ?>
        </div>

        <!-- Content -->
            <?php
            $this->load->view($content); 
            ?>
        <!-- END Content -->

    </div>
    <!-- Right Panel -->

    <script src="<?= base_url('assets/vendor/plugins/jquery/dist/jquery.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/plugins/popper.js/dist/umd/popper.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/plugins/bootstrap/dist/js/bootstrap.min.js'); ?> "></script>
    <script src="<?= base_url('assets/vendor/assets/js/main.js'); ?> "></script>

    


</body>

</html>