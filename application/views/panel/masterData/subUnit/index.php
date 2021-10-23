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
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <div class="col-md-4">
            <select class="form-control select2" id="unit" onchange="cariSubUnit(this.value)">
              <option value="">.:Pilih Unit:.</option>
              <?php foreach ($unit as $key) : ?>
                <option value="<?php echo $key->id_unit; ?>"><?php echo $key->kode_unit;?> | <?php echo $key->nama_unit; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <script type="text/javascript">
            $('#unit').val('<?php echo $id_unit; ?>')

            function cariSubUnit(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubUnit?unit=')); ?>' + val)
            }
          </script>
          <?php if(cekModul('tambahSubUnit') == TRUE): ?>
            <a href="<?php echo base_url(changeLink('panel/masterData/tambahSubUnit/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Sub Unit</a>
          <?php endif; ?>
          <br />
          <br />
          <br />
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>Nama Unit</th>
                <th>Kode Sub Unit</th>
                <th>Nama Sub Unit</th>
                <th>Keterangan Sub Unit</th>
                <th>Jumlah Inventori</th>
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
        "url": '<?php echo site_url(changeLink('panel/masterData/daftarSubUnit/cari')); ?>',
        "type": "POST",
        "data":{
          "unit":"<?php echo $id_unit;?>"
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
          "data": "nama_unit",
          width: 100,
        },
        {
          "data": "kode_sub_unit",
          width: 100
        },
        {
          "data": "nama_sub_unit",
          width: 100,
        },
        {
          "data": "keterangan_sub_unit",
          width: 100,
        },
        {
          "data": "jmlInventori",
          width: 100,
          render: function(data, type, row) {
            return '<a href="<?php echo base_url('panel/inventori/listInventori?kode_unit=');?>'+row.kode_unit+'&kode_sub_unit='+row.kode_sub_unit+'" class="btn btn-xs btn-primary">'+row.jmlInventori+'</a>';
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