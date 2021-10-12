<!-- begin #content -->
<div id="content" class="content">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li><a href="javascript:;"><?php echo $title; ?></a></li>
    <li class="active"><?php echo $subtitle; ?></li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header"><?php echo $title; ?></h1>
  <!-- end page-header -->

  <!-- begin row -->
  <div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="<?php echo base_url('panel/inventori/laporanInventori');?>" class="btn btn-xs btn-success"><i class="fa fa-download"></i> Masuk</a>
            <a href="<?php echo base_url('panel/inventori/laporanInventori/out');?>" class="btn btn-xs btn-danger"><i class="fa fa-upload"></i> Keluar</a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <form action="<?php echo base_url('panel/inventori/laporanInventori/out');?>" method="GET">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Dari tgl</label>
                <input type="date" class="form-control" name="start_date" value="<?php echo $start_date;?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Sampai tgl</label>
                <input type="date" class="form-control" name="end_date" value="<?php echo $end_date;?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Status Keluar</label>
                <select name="status_keluar" class="form-control" id="status_keluar">
                  <option value="">.:Pilih Status Keluar:.</option>
                  <option value="pinjam">Dipinjam</option>
                  <option value="rusak">Rusak</option>
                </select>
              </div>
            </div>
            <script>
              $('#status_keluar').val('<?php echo $status_keluar;?>');
            </script>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Status Pengembalian</label>
                <select name="status_pengembalian" class="form-control" id="status_pengembalian">
                  <option value="">.:Pilih Status Pengembalian:.</option>
                  <option value="sudah">Sudah dikembalikan</option>
                  <option value="belum">Belum dikembalikan</option>
                </select>
              </div>
            </div>
            <script>
              $('#status_pengembalian').val('<?php echo $status_pengembalian;?>');
            </script>
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Status Approval</label>
                <select name="status_approval" class="form-control" id="status_approval">
                  <option value="">.:Pilih Status Approval:.</option>
                  <option value="pending">Pending</option>
                  <option value="accept">Diterima</option>
                  <option value="reject">Ditolak</option>
                </select>
              </div>
            </div>
            <script>
              $('#status_approval').val('<?php echo $status_approval;?>');
            </script>
            <div class="col-md-12">
              <button class="btn btn-xs btn-primary btn-block" type="submit"> Cari</button>
              <br/>
              <br/>
            </div>
          </form>
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>ID Faktur</th>
                <th>Kode Inventori</th>
                <th>Nama Barang</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Status Approval</th>
                <th>Tgl Pembuatan</th>
                <th>Status Keluar</th>
                <th>Status Pengembalian</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <?php echo $this->session->flashdata('notif'); ?>
        </div>
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-12 -->
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
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
      "order": [], //Initial no order.
      "lengthChange": true,
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": '<?php echo site_url(changeLink('panel/inventori/laporanInventori/cari')); ?>',
        "type": "POST",
        "data": {
          'kategori_faktur' : '<?php echo $kategori_faktur;?>',
          'status_keluar' : '<?php echo $status_keluar;?>',
          'status_pengembalian' : '<?php echo $status_pengembalian;?>',
          'status_approval' : '<?php echo $status_approval;?>',
          'start_date' : '<?php echo $start_date;?>',
          'end_date' : '<?php echo $end_date;?>'
        }
      },
      //Set column definition initialisation properties.
      "columns": [{
          "data": "id_faktur",
          width: 100,
          render: function(data, type, row) {
            return '<a href="<?php echo base_url('panel/inventori/detailInventoriKeluar/');?>'+row.id_faktur+'" class="btn btn-xs btn-primary">'+row.id_faktur+'</a>';
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
          "data": "jumlah_inventori_faktur",
          width: 100,
          render: function(data, type, row, meta) {
            return new Intl.NumberFormat().format(row.jumlah_inventori_faktur) + ' ' + row.singkatan_satuan
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
            }else if(row.kategori_faktur == 'out'){
              return '<b class="text-danger">Rusak</b>';
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