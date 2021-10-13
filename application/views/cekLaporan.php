<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php echo $appsProfile->apps_name;?> | LAPOR </title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().$appsProfile->icon;?>">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link rel="manifest" href="<?php echo base_url('/manifest.json'); ?>">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url('assets/');?>plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/sweetalert/sweetalert2.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/login.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/jquery-ui.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/uniform.default.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/loginv2.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/');?>css/login.anim.css" rel="stylesheet" />
	<link href="<?php echo base_url('assets/'); ?>plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url('assets/');?>plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url('assets/');?>plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo base_url('assets/');?>plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo base_url('assets/');?>plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/');?>js/main.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/sweetalert/sweetalert2.all.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script>
	if ('serviceWorker' in navigator) {
		console.log('SERVICE WORKER -> REGISTER -> Try to register the service worker');
		navigator.serviceWorker.register('<?php echo base_url(); ?>service-worker.js')
		.then(function(reg) {
			console.log('SERVICE WORKER -> REGISTER -> Successfully registered!');
		}).catch(function(err) {
			console.log("'SERVICE WORKER -> REGISTER -> Registration failed! This happened: ", err)
		});
	}
	</script>
	<style type="text/css">
		.login-page .form-box .univ-identity-box {
				background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('<?php echo base_url(). $appsProfile->sidebar_login;?>') bottom;
				background-size: cover;
		}
	</style>
	<style type="text/css">
		.password {
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
							<div class="col-lg-12 form-login">
									<?php if(empty($detailLaporan)): ?>
										<img src="<?php echo base_url().$appsProfile->logo;?>" class="logo"><br />
									<?php else:?>
										<img src="<?php echo base_url().$appsProfile->logo;?>" style="margin-top: 320px;" class="logo"><br />
									<?php endif; ?>
									<h2 align="center" class="text-grey text-light">Detail Laporan Aplikasi</h2><br />
									<form method="GET" action="<?php echo base_url('ticketing/cekLaporan');?>">
										<?php echo $this->session->flashdata('notif');?>
											<?php if(empty($detailLaporan)): ?>
												<div class="form-group">
													<input type="text" name="id_ticketing" id="id_ticketing" class="form-control" placeholder="Masukkan ID Tiket" required/>
												</div>
											<?php endif; ?>
											<?php foreach($detailLaporan as $key):?>
											<div class="table-responsive">
												<table class="table table-striped table-bordered">
													<tr>
														<td colspan="2" align="center">
															<img src="<?php echo base_url().$key->foto_laporan;?>" style="width:300px" alt="Foto laporan" class="img-responsive">
														</td>
														<tr align="left">
															<td>ID Tiket</td>
															<td> <?php echo $key->id_ticket;?></td>
														</tr>
														<tr align="left">
															<td>Nama Pelapor</td>
															<td> <?php echo $key->nama_lengkap;?></td>
														</tr>
														<tr align="left">
															<td>Unit</td>
															<td> <?php echo $key->nama_unit;?></td>
														</tr>
														<tr align="left">
															<td>Sub Unit</td>
															<td> <?php echo $key->nama_sub_unit;?></td>
														</tr>
														<tr align="left">
															<td>Detail Lokasi</td>
															<td> <?php echo $key->detail_lokasi;?></td>
														</tr>
														<tr align="left">
															<td>Keterangan Laporan</td>
															<td> <?php echo $key->keterangan_laporan;?></td>
														</tr>
														<tr align="left">
															<td>Tgl Laporan</td>
															<td> <?php echo $key->dibuat_pada;?></td>
														</tr>
														<tr align="left">
															<td>Status Laporan</td>
															<?php if($key->status_laporan == 'N'): ?>
																<td><b class="text-danger">Belum ditanggapi</b></td>
															<?php else: ?>
																<td><b class="text-success">Sudah ditanggapi</b></td>
															<?php endif; ?>
														</tr>
														<tr align="left">
															<td>Ditanggapi Oleh</td>
															<td> <?php echo $key->nama_penanggap;?></td>
														</tr>
														<tr align="left">
															<td>Tanggapan Laporan</td>
															<td> <?php echo $key->tanggapan_laporan;?></td>
														</tr>
														<tr align="left">
															<td>Ditanggapi pada</td>
															<td> <?php echo $key->ditanggapi_pada;?></td>
														</tr>
													</tr>
												</table>
											</div>
											<?php endforeach;?>
											<br />
											<div class="form-group" align="center">
													<?php if(empty($detailLaporan)): ?>
														<button type="submit" class="btn btn-flat btn-success"><i class="fa fa-search"></i> Cari Laporan</button>
													<?php endif; ?>
													<hr/>
													<a href="<?php echo base_url();?>" class="btn btn-flat btn-danger"><i class="fa fa-backward"></i> Laman login</a>
													<a href="<?php echo base_url('ticketing/lapor');?>" class="btn btn-flat btn-primary"><i class="fa fa-pencil"></i> Buat Laporan</a>
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
	<script src="<?php echo base_url('assets/'); ?>plugins/select2/dist/js/select2.min.js"></script>
		<script type="text/javascript">
		$('.select2').select2();
	</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');
</script>
<script type="text/javascript">
		function showPass() {
				if (document.getElementById("password").type == 'password') {
						document.getElementById("password").type = 'text';
						document.getElementById("iconshow").classList.remove('fa-eye-slash');
						document.getElementById("iconshow").classList.add('fa-eye');
				} else {
						document.getElementById("password").type = 'password';
						document.getElementById("iconshow").classList.remove('fa-eye');
						document.getElementById("iconshow").classList.add('fa-eye-slash');
				}
		}
</script>
</body>
</html>
