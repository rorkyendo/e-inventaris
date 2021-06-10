<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php echo $appsProfile->apps_name;?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().$appsProfile->icon;?>">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url('assets/');?>plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/login.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/jquery-ui.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/uniform.default.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/loginv2.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/login.anim.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url('assets/');?>plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url('assets/');?>plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo base_url('assets/');?>plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo base_url('assets/');?>plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/');?>js/main.js"></script>
	<!-- ================== END BASE JS ================== -->
	<style type="text/css">
		.login-page .form-box .univ-identity-box {
				background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('<?php echo base_url(). $appsProfile->sidebar_login;?>') bottom;
				background-size: cover;
		}
	</style>
	<style type="text/css">
		.password_pengguna {
			position: relative;
		}

		.showbtn {
			cursor: pointer;
			overflow: hidden;
			right: 15px;
			position: absolute;
			top: 10px;
			cursor: pointer;
		}
	</style>
</head>
<body class="login-page" style="background:url('<?php echo base_url('assets/img/pat_04.png');?>') repeat;">
	<div class="container">
			<div class="row">
					<div class="form-box col-md-8 col-sm-10 col-xs-12">
							<div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 univ-identity-box">
									<div class="univ-text">
											<h4 class="welcome text-light">Selamat Datang</h4>
											<div class="clearfix"></div>
											<h2 class="no-margin text-light"><?php echo $appsProfile->apps_name;?></h2>
									</div>
							</div>
							<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 form-login" align="center">
									<img src="<?php echo base_url().$appsProfile->icon;?>" class="logo"><br />
									<h2 align="center" class="text-grey text-light">Silakan Login</h2><br />
									<form method="post" action="<?php echo base_url('auth/login/do_login');?>">
										<?php echo $this->session->flashdata('notif');?>
											<div class="form-group">
													<i class="fa fa-user icon-input"></i> <input type="text" name="username_pengguna" id="userid" class="form-control input-line" placeholder="Masukkan Akun Pengguna" required="true"/>
											</div>
											<div class="form-group">
													<div class="password_pengguna">
															<i style="margin-left:-20px;" class="fa fa-key icon-input"></i>
															<input type="password" id="password_pengguna" name="password_pengguna" class="form-control input-line" placeholder="Masukkan Kata Sandi" required="true"/>
															<span id="iconshow" name="iconshow" onClick="showPass()" class=" showbtn fa fa-eye-slash"></span>
													</div>
											</div>
											<br />
											<div class="form-group" align="center">
													<button type="submit" class="btn btn-flat btn-primary ">Masuk Aplikasi <i class="fa fa-angle-right"></i></button>
													<br>
													<small><?php echo $appsProfile->footer;?></small>
											</div>
									</form>
							</div>
					</div>
			</div>
	</div>
	<!-- ================== BEGIN BASE JS ================== -->
	<!--[if lt IE 9]>
		<script src="<?php echo base_url('assets/');?>crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo base_url('assets/');?>crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo base_url('assets/');?>crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo base_url('assets/');?>plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url('assets/');?>plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo base_url('assets/');?>js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');

	// $("#right-nav2").click(function(){
	// 		$("#middle-card").addClass("active-dx");
	// 		$("#left-card").addClass("inactive-sx");
	// 		$("#left-card").removeClass("active-sx");
	// 		$("#middle-card").removeClass("inactive-dx");
	// });
	//
	// $("#left-nav2").click(function(){
	// 		$("#left-card").addClass("active-sx");
	// 		$("#middle-card").addClass("inactive-dx");
	// 		$("#middle-card").removeClass("active-dx");
	// 		$("#left-card").removeClass("inactive-sx");
	// });
	// $("#right-nav").click(function(){
	// 		$("#right-card").addClass("active-dx");
	// 		$("#middle-card").addClass("inactive-sx");
	// 		$("#middle-card").removeClass("active-sx");
	// 		$("#right-card").removeClass("inactive-dx");
	// });
	//
	// $("#left-nav").click(function(){
	// 		$("#middle-card").addClass("active-sx");
	// 		$("#right-card").addClass("inactive-dx");
	// 		$("#right-card").removeClass("active-dx");
	// 		$("#middle-card").removeClass("inactive-sx");
	// });
</script>
<script type="text/javascript">
		function showPass() {
				if (document.getElementById("password_pengguna").type == 'password_pengguna') {
						document.getElementById("password_pengguna").type = 'text';
						document.getElementById("iconshow").classList.remove('fa-eye-slash');
						document.getElementById("iconshow").classList.add('fa-eye');
				} else {
						document.getElementById("password_pengguna").type = 'password_pengguna';
						document.getElementById("iconshow").classList.remove('fa-eye');
						document.getElementById("iconshow").classList.add('fa-eye-slash');
				}
		}
</script>
</body>
</html>
