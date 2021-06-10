<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/highcharts.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/modules/data.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/modules/exporting.js"></script>
<!-- begin #content -->
<div id="content" class="content">
	<!-- begin row -->
	<div class="col-md-12">
		<div class="row">
			<?php echo $this->session->flashdata('notif'); ?>
			<h3>Selamat <?php echo waktu(date('H')); ?> : <b><?php echo $this->session->userdata('nama_lengkap'); ?></b></h3>
		</div>
	</div>
	<div class="row">
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-users"></i></div>
				<div class="stats-title">Jumlah Pengguna</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlPengguna->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->

	</div>
	<?php echo $this->session->flashdata('notif'); ?>
	<!-- end row -->
</div>
<!-- end #content -->