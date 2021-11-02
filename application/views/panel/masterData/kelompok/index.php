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
            <select class="form-control select2" id="kode_golongan" onchange="cariGolongan(this.value)">
              <option value="">.:Pilih Golongan:.</option>
              <?php foreach ($golongan as $key) : ?>
                <option value="<?php echo $key->kd_gol; ?>"><?php echo $key->kd_gol;?> | <?php echo $key->ur_gol; ?></option>
              <?php endforeach; ?>
            </select>
            <br/>
            <br/>
          </div>
          <script type="text/javascript">
            $('#kode_golongan').val('<?php echo $kode_golongan; ?>')

            function cariGolongan(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarKelompok?kode_golongan=')); ?>' + val)
            }
          </script>
          <div class="col-md-4">
            <select class="form-control select2" id="kode_bidang" onchange="cariBidang(this.value)">
              <option value="">.:Pilih Bidang:.</option>
            </select>
            <br/>
            <br/>
          </div>
          <script type="text/javascript">
            $('#kode_bidang').val('<?php echo $kode_bidang; ?>')

            function cariBidang(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarKelompok?kode_golongan='.$kode_golongan.'&kode_bidang=')); ?>' + val)
            }
          </script>
          <?php if(cekModul('createKelompok') == TRUE): ?>
            <a href="<?php echo base_url(changeLink('panel/masterData/createKelompok/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Kelompok</a>
          <?php endif; ?>
          <br />
          <br />
          <br />
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>Kode Golongan</th>
                <th>Kode Bidang</th>
                <th>Kode Kelompok</th>
                <th>Uraian Kelompok</th>
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
        "url": '<?php echo site_url(changeLink('panel/masterData/daftarKelompok/cari')); ?>',
        "type": "POST",
        "data":{
          "kode_golongan":"<?php echo $kode_golongan;?>",
          "kode_bidang":"<?php echo $kode_bidang;?>"
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
          "data": "gol",
          width: 100,
        },
        {
          "data": "bid",
          width: 100
        },
        {
          "data": "kd_kel",
          width: 100
        },
        {
          "data": "ur_kel",
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