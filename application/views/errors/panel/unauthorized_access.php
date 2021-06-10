<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo $appsProfile->apps_name.' | '.$title;?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().$appsProfile->icon;?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/vendors/css/weather-icons/climacons.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/fonts/meteocons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/css/pages/users.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/backend/app-assets/vendors/css/forms/selects/select2.min.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 1-column   blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">

<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body"><section class="flexbox-container">
<div class="col-12 d-flex align-items-center justify-content-center">
    <div class="col-lg-4 col-md-8 col-10 p-0">
        <div class="card-header bg-transparent border-0">
                <h2 class="error-code text-center mb-2">401</h2>
                <h3 class="text-uppercase text-center">Error 401 - Unauthorized Access.</h3>
        </div>
        <div class="card-content">
            <div class="row py-2">
                <div class="col-12 col-sm-12 col-md-12 mb-1">
                    <a href="<?php echo base_url('panel/dashboard');?>" class="btn btn-primary btn-block"><i class="feather icon-home"></i> Home</a>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent">
            <div class="row">
                <p class="text-muted text-center col-12 py-1">&copy; 2019 <?php echo $appsProfile->footer;?> <?php echo $appsProfile->apps_name.' '.$appsProfile->apps_version;?></p>
            </div>
        </div>
    </div>
</div>
</section>

    </div>
  </div>
</div>
<!-- END: Content-->
<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/extensions/jquery.knob.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/charts/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/charts/morris.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/extensions/unslider-min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/tables/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/vendors/js/forms/select/form-select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.5.0/echarts.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo base_url();?>assets/backend/app-assets/js/core/app-menu.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/js/core/app.min.js"></script>
<script src="<?php echo base_url();?>assets/backend/app-assets/js/scripts/customizer.min.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="<?php echo base_url();?>assets/backend/app-assets/js/scripts/pages/dashboard-fitness.min.js"></script>
<!-- END: Page JS-->
</body>
<!-- END: Body-->
</html>
