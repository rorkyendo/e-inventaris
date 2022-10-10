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
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <form action="<?php echo base_url('panel/tiket/daftarTiket');?>" method="GET">
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
                <label for="">Status Laporan</label>
                <select name="status_laporan" class="form-control" id="status_laporan">
                  <option value="">.:Pilih Status Laporan:.</option>
                  <option value="pending">Belum ditanggapi</option>
                  <option value="accept">Sudah ditanggapi tapi belum diproses</option>
                  <option value="process">Sudah diproses</option>
                  <option value="finish">Sudah selesai diproses</option>
                </select>
              </div>
            </div>
            <script>
              $('#status_laporan').val('<?php echo $status_laporan;?>');
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
                <th>ID Tiket</th>
                <th>Nama Lengkap</th>
                <th>Nama Unit</th>
                <th>Nama Sub Unit</th>
                <th>Detail Lokasi</th>
                <th>Status Laporan</th>
                <th>Tgl Laporan</th>
                <th>Aksi</th>
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
      dom: 'Blfrtip',
      buttons: [{
          extend: 'excel',
          exportOptions: {
            columns: ':visible'
          }
        },
        {
          extend: 'csv',
          exportOptions: {
            columns: ':visible'
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: ':visible'
          }
        }
      ],
      "filter": true,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "lengthChange": true,
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": '<?php echo site_url(changeLink('panel/tiket/daftarTiket/cari')); ?>',
        "type": "POST",
        "data": {
          'status_laporan' : '<?php echo $status_laporan;?>',
          'start_date' : '<?php echo $start_date;?>',
          'end_date' : '<?php echo $end_date;?>'
        }
      },
      //Set column definition initialisation properties.
      "columns": [{
          "data": "id_ticket",
          width: 40,
        },
        {
          "data": "nama_lengkap",
          width: 100,
        },
        {
          "data": "nama_unit",
          width: 100,
        },
        {
          "data": "nama_sub_unit",
          width: 100,
        },
        {
          "data": "detail_lokasi",
          width: 100,
        },
        {
          "data": "status_laporan",
          width: 100,
          render: function(data, type, row) {
            if (row.status_laporan == 'pending') {
              return '<b class="text-danger">Belum ditanggapi</b>';
            }else if(row.status_laporan == 'accept'){
              return '<b class="text-primary">Sudah ditanggapi tapi belum diproses</b>';
            }else if(row.status_laporan == 'process'){
              return '<b class="text-warning">Sedang diproses</b>';
            }else if(row.status_laporan == 'finish'){
              return '<b class="text-success">Sudah selesai diproses</b>';
            }
          }
        },
        {
          "data": "dibuat_pada",
          width: 100,
        },
        {
          "data": "action",
          width: 100,
        },
      ],
    });
  });
</script>