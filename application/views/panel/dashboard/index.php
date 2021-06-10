<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/highcharts.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/modules/data.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/highcharts-7.1.2/code/modules/exporting.js"></script>
<!-- begin #content -->
<div id="content" class="content">
	<!-- begin row -->
	<div class="col-md-12">
		<div class="row">
			<?php echo $this->session->flashdata('notif'); ?>
			<h3>Selamat <?php echo waktu(date('H')); ?> : <b><?php echo $this->session->userdata('nama_lengkap_pengguna'); ?></b></h3>
		</div>
	</div>
	<div class="row">
		<?php foreach ($kataMutiara as $key) : ?>
			<div class="col-md-12">
				<br />
				<div class="alert alert-info">
					<h3><b><?php echo $key->kata_mutiara; ?><b></h3>
					<h5>"<?php echo $key->sumber_kata; ?>"</h5>
				</div>
			</div>
		<?php endforeach; ?>
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-users"></i></div>
				<div class="stats-title">Jumlah Pengguna</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlPengguna->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-orange">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-building"></i></div>
				<div class="stats-title">Jumlah Sekolah</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlSekolah->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-building"></i></div>
				<div class="stats-title">Jumlah Sekolah Negeri</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlSekolahNegeri->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-green">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-building"></i></div>
				<div class="stats-title">Jumlah Sekolah Swasta</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlSekolahSwasta->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->

		<?php if ($this->session->userdata('hak_akses_pengguna') == 'superuser') : ?>
			<?php //if ($ticketing->jumlah > 0) : 
			?>
			<div class="col-md-12 col-sm-12">
				<h4 class="text-center">LAYANAN BANTUAN / TIKET</h4>
				<table id="tableBantuan" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul Ticket</th>
							<th>Prioritas</th>
							<th>Dibuat Oleh</th>
							<th>Dibuat Pada</th>
							<th>Status Balasan</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<script type="text/javascript">
				var table;

				$(document).ready(function() {
					table = $('#tableBantuan').DataTable({
						responsive: {
							breakpoints: [{
								name: 'not-desktop',
								width: Infinity
							}]
						},
						"filter": true,
						"processing": true, //Feature control the processing indicator.
						"serverSide": true, //Feature control DataTables' server-side processing mode.
						"order": [
							// '3','DESC'
						], //Initial no order.
						"lengthChange": true,
						// Load data for the table's content from an Ajax source
						"ajax": {
							"url": '<?php echo site_url(changeLink('panel/layanan/listBantuan/cari')); ?>',
							"type": "POST",
						},
						//Set column definition initialisation properties.
						"columns": [{
								"data": null,
								width: 10,
								"sortable": false,
								render: function(data, type, row, meta) {
									return meta.row + meta.settings._iDisplayStart + 1;
								}
							},
							{
								"data": "judul_ticketing",
								width: 100
							},
							{
								"data": "prioritas_ticketing",
								width: 100,
								render: function(data, type, row, meta) {
									if (row.prioritas_ticketing == 'Tinggi') {
										return '<span class="badge badge-danger"><b style="font-size:12px">Tinggi</b></span>';
									} else if (row.prioritas_ticketing == 'Menengah') {
										return '<span class="badge badge-warning"><b style="font-size:12px">Menengah</b></span>';
									} else {
										return '<span class="badge badge-info"><b style="font-size:12px">Rendah</b></span>';
									}
								}
							},
							{
								"data": "nama_lengkap_pengguna",
								width: 100
							},
							{
								"data": "created_time",
								width: 100
							},
							{
								"data": "jmlPesan",
								width: 100,
								render: function(data, type, row, meta) {
									if (row.status_ticketing == 'Open') {
										if (row.jmlBalasan > 0 && row.created_by == '<?php echo $this->session->userdata('uuid_pengguna'); ?>') {
											return '<span class="badge badge-warning"><b style="font-size:12px">' + row.jmlBalasan + ' Balasan</b></span>';
										} else if (row.jmlBalasanAlumni > 0 && row.created_by != '<?php echo $this->session->userdata('uuid_pengguna'); ?>') {
											return '<span class="badge badge-warning"><b style="font-size:12px">' + row.jmlBalasanAlumni + ' Belum dibaca</b></span>';
										} else if (row.jmlBalasan < 1 && row.created_by == '<?php echo $this->session->userdata('uuid_pengguna'); ?>') {
											return '<span class="badge badge-warning"><b style="font-size:12px">Menunggu Balasan</b></span>';
										} else if (row.jmlBalasanAlumni < 1 && row.created_by != '<?php echo $this->session->userdata('uuid_pengguna'); ?>') {
											return '<span class="badge badge-warning"><b style="font-size:12px">Menunggu Untuk di Balas</b></span>';
										}
									} else {
										return '<span class="badge badge-success"><b style="font-size:12px">Selesai</b></span>';
									}
								}
							},
							{
								"data": "status_ticketing",
								width: 100,
								render: function(data, type, row, meta) {
									if (row.status_ticketing == 'Open') {
										return '<span class="badge badge-danger"><b style="font-size:12px">Open</b></span>';
									} else {
										return '<span class="badge badge-success"><b style="font-size:12px">Closed</b></span>';
									}
								}
							},
							{
								"data": "action",
								width: 100
							},
						],
					});
				});
			</script>
			<?php //endif;
			?>

			<div class="col-md-12 col-sm-12">
				<h4 class="text-center">SISTEM PELAYANAN</h4>
				<table class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>Layanan</th>
							<th>Status</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($pengaduanBelumBaca->jmlPengaduan > 0) : ?>
							<tr>
								<td>Layanan Pengaduan</td>
								<td>Belum di baca</td>
								<td>
									<a class="btn btn-xs btn-primary" href="<?php echo changeLink(base_url('panel/layanan/pengaduan?status_pengaduan=open&status_baca=N')); ?>">
										<?php echo number_format($pengaduanBelumBaca->jmlPengaduan, 0, '.', '.'); ?>
									</a>
								</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

	</div>
	<?php echo $this->session->flashdata('notif'); ?>
	<!-- end row -->
</div>
<!-- end #content -->
<div id="modal"></div>