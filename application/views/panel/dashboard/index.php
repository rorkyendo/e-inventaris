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
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-green">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-archive"></i></div>
				<div class="stats-title">Jumlah Inventori</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlInventori->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-orange">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-download"></i></div>
				<div class="stats-title">Jumlah Faktur Masuk (Pending)</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlFakturMasukPending->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-md-3 col-sm-6">
			<div class="widget widget-stats bg-orange">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-upload"></i></div>
				<div class="stats-title">Jumlah Faktur Keluar (Pending)</div>
				<div class="stats-number"><a style="cursor:pointer;color:white;"><?php echo number_format($jmlFakturKeluarPending->jumlah, 0, '.', '.'); ?></a></div>
			</div>
		</div>
		<!-- end col-3 -->
	</div>

	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<h4 class="panel-title">Arus Inventori</h4>
			</div>
			<div class="panel-body">
			<table id="table" class="table table-striped table-bordered" width="100%">
				<thead>
				<tr>
					<th>ID Faktur</th>
					<th>Kode Inventori</th>
					<th>Nama Barang</th>
					<th>Status</th>
					<th>Status Approval</th>
					<th>Tgl Pembuatan</th>
					<th>Status Keluar</th>
					<th>Status Pengembalian</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			</div>
		</div>
		<!-- end panel -->
		</div>
		<!-- end col-12 -->
	</div>
	<!-- end row -->
	<script type="text/javascript">
	var table;

	$(document).ready(function() {
		table = $('#table').DataTable({
		responsive: {
			breakpoints: [{
			name: 'not-desktop',
			width: Infinity
			}]
		},
		"filter": true,
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"order": [[0,'DESC']], //Initial no order.
		"lengthChange": true,
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url": '<?php echo site_url(changeLink('panel/dashboard/laporanInventori')); ?>',
			"type": "POST",
			"data": {
				'kategori_faktur' : '',
				'status_keluar' : '',
				'status_pengembalian' : '',
				'status_approval' : '',
				'start_date' : '',
				'end_date' : ''
			}
		},
		//Set column definition initialisation properties.
		"columns": [{
			"data": "id_faktur",
			width: 100,
			render: function(data, type, row) {
				if (row.kategori_faktur=='in') {
					return '<a href="<?php echo base_url('panel/inventori/detailInventoriMasuk/');?>'+row.id_faktur+'" class="btn btn-xs btn-primary">'+row.id_faktur+'</a>';
				}else if(row.kategori_faktur=='out'){
					return '<a href="<?php echo base_url('panel/inventori/detailInventoriKeluar/');?>'+row.id_faktur+'" class="btn btn-xs btn-primary">'+row.id_faktur+'</a>';
				}
			}
			},
			{
			"data": "kode_inventori",
			width: 100,
			render: function(data, type, row) {
				return row.kode_unit+'/'+row.kode_sub_unit+'/'+row.kode_inventori
			}
			},
			{
			"data": "nama_inventori",
			width: 100,
			},
			{
			"data": "kategori_faktur",
			width: 100,
				render: function(data, type, row) {
					if (row.kategori_faktur == 'in') {
						return '<b class="text-success">Masuk</b>';
					}else if(row.kategori_faktur == 'out'){
						return '<b class="text-danger">Keluar</b>';
					}
				}
			},
			{
			"data": "status_approval",
			width: 100,
			render: function(data, type, row) {
				if (row.status_approval == 'accept') {
					return '<b class="text-success">Diterima</b>';
				}else if(row.status_approval == 'pending'){
					return '<b class="text-warning">Pending</b>';
				}else if(row.status_approval == 'reject'){
					return '<b class="text-danger">Ditolak</b>';
				}
			}
			},
			{
			"data": "created_time",
			width: 100,
			},
			{
			"data": "status_keluar",
			width: 100,
			render: function(data, type, row) {
				if (row.status_keluar == 'pinjam') {
					return '<b class="text-warning">Dipinjam</b>';
				}else if(row.status_keluar == 'rusak'){
					return '<b class="text-danger">Rusak</b>';
				}else{
					return '-';
				}
			}
			},
			{
			"data": "status_pengembalian",
			width: 100,
			render: function(data, type, row) {
				if (row.status_pengembalian == 'sudah') {
					return '<b class="text-success">Sudah dikembalikan</b>';
				}else if(row.kategori_faktur == 'belum'){
					return '<b class="text-danger">Belum dikembalikan</b>';
				}else{
					return '-';
				}
			}
			},
		],
		});
	});
	</script>
	<?php echo $this->session->flashdata('notif'); ?>
	<!-- end row -->
</div>
<!-- end #content -->