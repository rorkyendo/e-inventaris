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
          <?php echo $this->session->flashdata('notifpass'); ?>
          <?php echo $this->session->flashdata('notif'); ?>
          <div class="col-md-4">
            <select class="form-control select2" id="hak_akses" onchange="cariHakAses(this.value)">
              <option value="">.:Pilih Hak Akses:.</option>
              <?php foreach ($getHakAkses as $key) : ?>
                <option value="<?php echo $key->nama_hak_akses; ?>"><?php echo $key->nama_hak_akses; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <script type="text/javascript">
            $('#hak_akses').val('<?php echo $hak_akses; ?>')

            function cariHakAses(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterData/pengguna?hak_akses=')); ?>' + val)
            }
          </script>
          <a href="<?php echo base_url(changeLink('panel/masterData/createPengguna/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Pengguna</a>
          <br />
          <br />
          <br />
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <?php echo $this->session->flashdata('notif'); ?>
          <?php echo $this->session->flashdata('notifpass'); ?>
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
        "url": '<?php echo site_url(changeLink('panel/masterData/pengguna/cari')); ?>',
        "type": "POST",
        "data": {
          "hak_akses": "<?php echo $hak_akses; ?>"
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
          "data": "nama_lengkap",
          width: 100,
        },
        {
          "data": "username",
          width: 100
        },
        {
          "data": "hak_akses",
          width: 100
        },
        {
          "data": "action",
          width: 100
        },
      ],
    });
  });
</script>
<div id="modal"></div>
<script>
  function detailData(val) {
    $.ajax({
      url: "<?php echo changeLink(base_url('panel/masterData/pengguna/history')); ?>",
      type: "GET",
      data: "id=" + val,
      success: function(data) {
        $('#modal').html(data)
        $('#modalAjax').modal('show')
      }
    })
  }
</script>