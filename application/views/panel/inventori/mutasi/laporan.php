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
            <a href="<?php echo base_url('panel/inventori/laporanMutasi/');?>" class="btn btn-xs btn-danger"><i class="fa fa-recycle"></i> Mutasi</a>
            <a href="<?php echo base_url('panel/inventori/laporanInventori/out');?>" class="btn btn-xs btn-danger"><i class="fa fa-upload"></i> Keluar</a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <form action="<?php echo base_url('panel/inventori/laporanInventori/mutasi');?>" method="GET">
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
                <th>Status Approval</th>
                <th>Tgl Pembuatan</th>
                <th>Unit Awal</th>
                <th>Sub Unit Awal</th>
                <th>Unit Pindah</th>
                <th>Sub Unit Pindah</th>
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
        "url": '<?php echo site_url(changeLink('panel/inventori/laporanMutasi/cari')); ?>',
        "type": "POST",
        "data": {
          'kategori_faktur' : '<?php echo $kategori_faktur;?>',
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
            return '<a href="<?php echo base_url('panel/inventori/detailMutasi/');?>'+row.id_faktur+'" class="btn btn-xs btn-primary">'+row.id_faktur+'</a>';
          }
        },
        {
          "data": "kode_inventori",
          width: 100,
          render: function(data, type, row) {
            return row.kode_inventori
          }
        },
        {
          "data": "nama_inventori",
          width: 100,
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
          "data": "nama_unit_awal",
          width: 100,
        },
        {
          "data": "nama_sub_unit_awal",
          width: 100,
        },
        {
          "data": "nama_unit_pindah",
          width: 100,
        },
        {
          "data": "nama_sub_unit_pindah",
          width: 100,
        },
      ],
    });
  });
</script>