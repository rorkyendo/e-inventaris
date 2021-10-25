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
	<script src="<?php echo base_url('assets/'); ?>js/qrscanner.js"></script>
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
	const html5QrCode = new Html5Qrcode("reader");
	function scan(){
		Html5Qrcode.getCameras().then(devices => {
		if (devices && devices.length) {
		var cameraId = devices[0].id;
		html5QrCode.start(
		{ facingMode: "environment" },
		errorMessage => {
		})
		.catch(err => {
			console.log(`Unable to start scanning, error: ${err}`);
		});
		}
		}).catch(err => {
		});
	}
	$(document).ready(function(){
		scan();
	})
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
							<div class="col-lg-12 form-login" align="center">
									<img src="<?php echo base_url().$appsProfile->logo;?>" class="logo"><br />
									<h2 align="center" class="text-grey text-light">Menu Laporan Aplikasi</h2><br />
									<form method="post" action="<?php echo base_url('ticketing/lapor/doCreate');?>" enctype="multipart/form-data">
										<?php echo $this->session->flashdata('notif');?>
											<center>
												<h3 class="text-center">Foto Laporan</h3>
												<img src="<?php echo base_url('assets/img/no-image.png');?>" class="img-responsive" style="width:300px" id="preview" alt="Preview">
												<br>
												<div class="form-group">
														<input type="file" name="foto_laporan" id="foto_laporan" class="form-control" placeholder="Masukkan Foto Laporan" accept="image/*" required capture/>
												</div>
												<script type="text/javascript">
												function readURL(input) {
													if (input.files && input.files[0]) {
													var reader = new FileReader();
													reader.onload = function(e) {
														$('#preview').attr('src', e.target.result);
													}
													reader.readAsDataURL(input.files[0]);
													}
												}
												$("#foto_laporan").change(function() {
													readURL(this);
												});
												</script>
											</center>
											<div class="form-group">
													<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required/>
											</div>
											<div class="form-group">
													<select name="id_unit" class="form-control select2" id="id_unit" onchange="cariSubUnit(this.value)">
														<option value="">.:Pilih Unit:.</option>
														<?php foreach($unit as $key):?>
															<option value="<?php echo $key->id_unit;?>"><?php echo $key->nama_unit;?></option>
														<?php endforeach;?>
													</select>
											</div>
											<div class="form-group">
													<select name="id_sub_unit" class="form-control select2" id="id_sub_unit">
														<option value="">.:Pilih Sub Unit:.</option>
													</select>
											</div>
											<script>
												function cariSubUnit(val){
												$('#id_sub_unit').html('<option value="">.:Pilih Sub Unit:.</option>');
												$.ajax({
													url:"<?php echo base_url('ticketing/getSubUnit');?>",
													type:"GET",
													data:{
													"id_unit":val
													},success:function(resp){
													if (resp!='false') {
														var data = JSON.parse(resp)
														$.each(data,function(key,val){
															$('#id_sub_unit').append('<option value="'+val.id_sub_unit+'">'+val.nama_sub_unit+'</option>');
														})
													}else{
														Swal.fire({
														type: 'error',
														title: 'Gagal',
														text: 'Sub unit tidak ditemukan',
														})
													}
													},error:function(){
													Swal.fire({
														type: 'error',
														title: 'Oopps..',
														text: 'Terjadi kesalahan',
													})
													}
												})
												}
											</script>
											<div class="form-group">
													<input type="text" name="detail_lokasi" id="detail_lokasi" class="form-control" placeholder="Masukkan Detail Lokasi" required/>
											</div>
											<div class="form-group">
													<input type="text" name="keterangan_laporan" id="keterangan_laporan" class="form-control" placeholder="Masukkan Keterangan Laporan" required/>
											</div>
											<br />
											<div class="form-group" align="center">
													<button type="submit" class="btn btn-flat btn-success"><i class="fa fa-envelope"></i> Kirim Laporan</button>
													<hr/>
													<a href="<?php echo base_url();?>" class="btn btn-flat btn-danger"><i class="fa fa-backward"></i> Laman login</a>
													<a href="<?php echo base_url('ticketing/cekLaporan');?>" class="btn btn-flat btn-info"><i class="fa fa-info-circle"></i> Cek Laporan</a>
													<br>
													<small><?php echo $appsProfile->footer;?></small>
											</div>
									</form>
							</div>
					</div>
			</div>
	</div>
	<div hidden id="reader" class="img-fluid" style="width:280px"></div>

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
