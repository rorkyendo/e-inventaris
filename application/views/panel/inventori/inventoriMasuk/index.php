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
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <div class="col-md-3">
            <select class="form-control select2" id="status_approval" onchange="cariStatusApproval(this.value)">
              <option value="">.:Pilih Status Approval:.</option>
              <option value="pending">Pending</option>
              <option value="accept">Accept</option>
              <option value="reject">Reject</option>
            </select>
          </div>
          <script type="text/javascript">
            $('#status_approval').val('<?php echo $status_approval; ?>')

            function cariStatusApproval(val) {
              location.replace('<?php echo base_url(changeLink('panel/inventori/inventoriMasuk?start_date=' . $start_date . '&end_date=' . $end_date . '&status_approval=')); ?>' + val)
            }
          </script>
          <form action="<?php echo base_url('panel/inventori/inventoriMasuk?status_approval=' . $status_approval); ?>" class="form-horizontal" method="GET">
            <div class="col-md-3">
              <input type="date" class="form-control" name="start_date" value="<?php echo $start_date; ?>">
            </div>
            <div class="col-md-3">
              <input type="date" class="form-control" name="end_date" value="<?php echo $end_date; ?>">
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary btn-md">Cari</button>
            </div>
          </form>
          <br />
          <br />
          <a href="<?php echo base_url(changeLink('panel/inventori/createInventoriMasuk/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Inventori Masuk</a>
          <br />
          <br />
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>ID Faktur</th>
                <th>Kode Faktur</th>
                <th>Catatan Faktur</th>
                <th>Status Approval</th>
                <th>Total Belanja</th>
                <th>Tgl Dibuat</th>
                <th>Tgl Approval</th>
                <th>QR CODE</th>
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
            "filter": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthChange": true,
            // Load data for the table's content from an Ajax source
            "ajax": {
              "url": '<?php echo site_url(changeLink('panel/inventori/inventoriMasuk/cari')); ?>',
              "type": "POST",
              "data": {
                "status_approval": "<?php echo $status_approval; ?>",
                "start_date": "<?php echo $start_date; ?>",
                "end_date": "<?php echo $end_date; ?>"
              }
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
                "data": "id_faktur",
                width: 100,
              },
              {
                "data": "kode_faktur",
                width: 100
              },
              {
                "data": "catatan_faktur",
                width: 100
              },
              {
                "data": "status_approval",
                width: 100,
                render: function(data, type, row, meta) {
                  if (row.status_approval == 'pending') {
                    return "<b class='text-warning'>Pending</b>"
                  } else if (row.status_approval == 'reject') {
                    return "<b class='text-danger'>Rejected</b>"
                  } else if (row.status_approval == 'accept') {
                    return "<b class='text-success'>Accepted</b>"
                  }
                }
              },
              {
                "data": "total_belanja",
                width: 100,
                render: function(data, type, row, meta) {
                  return "Rp" + new Intl.NumberFormat().format(row.total_belanja)
                }
              },
              {
                "data": "created_time",
                width: 100
              },
              {
                "data": "approval_time",
                width: 100
              },
              {
                "data": "qrcode",
                width: 100,
                render: function(data, type, row, meta) {
                  return "<img src='<?php echo base_url(); ?>" + row.qrcode_faktur + "' class='img-responsive' style='width:250px'>"
                }
              },
              {
                "data": "action",
                width: 100,
                render: function(data, type, row, meta) {
                    if (row.status_approval == 'pending') {
                      return row.action;
                    }else{
                      return "<b class='text-danger'>Data tidak bisa diupdate</b>";
                    }
                  }
                },
              ],
            });
        });
</script>