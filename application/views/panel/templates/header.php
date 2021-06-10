<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title><?php echo $apps_name; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() . $icon; ?>">
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url('assets/'); ?>plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media='all' />
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/sweetalert/sweetalert2.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>css/style.min.css" rel="stylesheet" media='all' />
	<link href="<?php echo base_url('assets/'); ?>css/style-responsive.min.css" rel="stylesheet" media='all' />
	<link href="<?php echo base_url('assets/'); ?>css/theme/default.css" rel="stylesheet" id="theme" media='all' />
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?php echo base_url('assets/'); ?>plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/summernote/summernote.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/css/highcharts.css">
	<link href="<?php echo base_url('assets/'); ?>plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url('assets/'); ?>plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/sweetalert/sweetalert2.all.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo base_url('assets/'); ?>plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>js/table-manage-default.demo.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/summernote/summernote.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/printThis/printThis.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

	<style media="screen">
		.input-container input {
			border: none;
			box-sizing: border-box;
			outline: 0;
			padding: .75rem;
			position: relative;
			width: 100%;
		}

		input[type="date"]::-webkit-calendar-picker-indicator {
			background: transparent;
			bottom: 0;
			color: transparent;
			cursor: pointer;
			height: auto;
			left: 0;
			position: absolute;
			right: 0;
			top: 0;
			width: auto;
		}

		body {
			font-weight: bold;
		}

		@media print {
			.hidden-print {
				display: none !important;
			}
		}

		@media screen {
			.hidden-screen {
				display: none !important;
			}
		}
	</style>
</head>

<body>