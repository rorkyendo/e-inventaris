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
            <select class="form-control select2" id="id_kategori" onchange="carikategori(this.value)">
              <option value="">.:Pilih Kategori Inventori:.</option>
              <?php foreach ($getKategori as $key) : ?>
                <option value="<?php echo $key->id_kategori; ?>"><?php echo $key->nama_kategori; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <script type="text/javascript">
            $('#id_kategori').val('<?php echo $id_kategori; ?>')

            function cariKategori(val) {
              location.replace('<?php echo base_url(changeLink('panel/inventori/listInventori?id_kategori=')); ?>' + val)
            }
          </script>
          <a href="<?php echo base_url(changeLink('panel/inventori/createInventori/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Inventori</a>
          <br />
          <br />
          <br />
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>Kode Inventori</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga Barang</th>
                <th>QR CODE</th>
                <th>Barcode</th>
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
        "url": '<?php echo site_url(changeLink('panel/inventori/listInventori/cari')); ?>',
        "type": "POST",
        "data": {
          "id_kategori": "<?php echo $id_kategori; ?>"
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
          "data": "nama_inventori",
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
          "data": "nama_kategori",
          width: 100
        },
        {
          "data": "jumlah_inventori",
          width: 100,
          render: function(data, type, row, meta) {
            return new Intl.NumberFormat().format(row.jumlah_inventori) + ' ' + row.singkatan_satuan
          }
        },
        {
          "data": "harga_barang",
          width: 100,
          render: function(data, type, row, meta) {
            return "Rp" + new Intl.NumberFormat().format(row.harga_barang)
          }
        },
        {
          "data": "qrcode",
          width: 100,
          render: function(data, type, row, meta) {
            return "<img src='<?php echo base_url(); ?>" + row.qrcode + "' class='img-responsive' style='width:250px'>"
          }
        },
        {
          "data": "barcode",
          width: 100,
          render: function(data, type, row, meta) {
            return "<img src='<?php echo base_url(); ?>" + row.barcode + "' class='img-responsive' style='width:100%'>"
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