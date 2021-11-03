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
          <div class="col-md-3">
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
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubKelompok?kode_golongan=')); ?>' + val)
            }
          </script>
          <div class="col-md-3">
            <select class="form-control select2" id="kode_bidang" onchange="cariBidang(this.value)">
              <option value="">.:Pilih Bidang:.</option>
              <?php foreach($bidang as $key):?>
                <option value="<?php echo $key->kd_bid;?>"><?php echo $key->kd_bid;?> | <?php echo $key->ur_bid;?></option>
              <?php endforeach;?>
            </select>
            <br/>
            <br/>
          </div>
          <script type="text/javascript">
            $('#kode_bidang').val('<?php echo $kode_bidang; ?>')

            function cariBidang(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubKelompok?kode_golongan='.$kode_golongan.'&kode_bidang=')); ?>' + val)
            }
          </script>
          <div class="col-md-3">
            <select class="form-control select2" id="kode_kelompok" onchange="cariKelompok(this.value)">
              <option value="">.:Pilih Kelompok:.</option>
              <?php foreach($kelompok as $key):?>
                <option value="<?php echo $key->kd_kel;?>"><?php echo $key->kd_kel;?> | <?php echo $key->ur_kel;?></option>
              <?php endforeach;?>
            </select>
            <br/>
            <br/>
          </div>
          <script type="text/javascript">
            $('#kode_kelompok').val('<?php echo $kode_kelompok; ?>')

            function cariKelompok(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubKelompok?kode_golongan='.$kode_golongan.'&kode_bidang='.$kode_bidang.'&kode_kelompok=')); ?>' + val)
            }
          </script>
          <?php if(cekModul('createSubKelompok') == TRUE): ?>
            <a href="<?php echo base_url(changeLink('panel/masterData/createSubKelompok/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Sub Kelompok</a>
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
                <th>Kode Sub Kelompok</th>
                <th>Uraian Sub Kelompok</th>
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
        "url": '<?php echo site_url(changeLink('panel/masterData/daftarSubKelompok/cari')); ?>',
        "type": "POST",
        "data":{
          "kode_golongan":"<?php echo $kode_golongan;?>",
          "kode_bidang":"<?php echo $kode_bidang;?>",
          "kode_kelompok":"<?php echo $kode_kelompok;?>",
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
          "data": "kel",
          width: 100
        },
        {
          "data": "kd_skel",
          width: 100
        },
        {
          "data": "ur_skel",
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