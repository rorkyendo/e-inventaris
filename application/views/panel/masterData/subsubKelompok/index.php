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
            <a href="javascript:;" class="btn btn-xs btn-success" data-toggle="modal" data-target="#import"><i class="fa fa-download"></i> Import</a>
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
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubSubKelompok?kode_golongan=')); ?>' + val)
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
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubSubKelompok?kode_golongan='.$kode_golongan.'&kode_bidang=')); ?>' + val)
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
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubSubKelompok?kode_golongan='.$kode_golongan.'&kode_bidang='.$kode_bidang.'&kode_kelompok=')); ?>' + val)
            }
          </script>
          <div class="col-md-3">
            <select class="form-control select2" id="kode_sub_kelompok" onchange="cariSubKelompok(this.value)">
              <option value="">.:Pilih Sub Kelompok:.</option>
              <?php foreach($sub_kelompok as $key):?>
                <option value="<?php echo $key->kd_skel;?>"><?php echo $key->kd_skel;?> | <?php echo $key->ur_skel;?></option>
              <?php endforeach;?>
            </select>
            <br/>
            <br/>
          </div>
          <script type="text/javascript">
            $('#kode_sub_kelompok').val('<?php echo $kode_sub_kelompok; ?>')

            function cariSubKelompok(val) {
              location.replace('<?php echo base_url(changeLink('panel/masterData/daftarSubSubKelompok?kode_golongan='.$kode_golongan.'&kode_bidang='.$kode_bidang.'&kode_kelompok='.$kode_kelompok.'&kode_sub_kelompok=')); ?>' + val)
            }
          </script>
          <br>
          <?php if(cekModul('createSubSubKelompok') == TRUE): ?>
            <a href="<?php echo base_url(changeLink('panel/masterData/createSubSubKelompok/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Sub-sub Kelompok</a>
          <?php endif; ?>
          <br />
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
                <th>Kode Sub-Sub Kelompok</th>
                <th>Uraian Sub-Sub Kelompok</th>
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
        "url": '<?php echo site_url(changeLink('panel/masterData/daftarSubSubKelompok/cari')); ?>',
        "type": "POST",
        "data":{
          "kode_sub_kelompok":"<?php echo $kode_sub_kelompok;?>",
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
          "data": "skel",
          width: 100
        },
        {
          "data": "kd_sskel",
          width: 100
        },
        {
          "data": "ur_sskel",
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
<div id="import" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import Data Sub-sub Kelompok</h4>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url('panel/masterData/createSubSubKelompok/doImport'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">Upload File Disini</label>
            <input type="file" accept="application/msexcel" name="dataSubSubKelompok" class="form-control">
            <font color="red">*Upload data dengan format xlsx</font><br />
            <b><a href="<?php echo base_url('assets/excel/Format_Data_Sub_Sub_Kelompok.xlsx'); ?>">Download format import data disini</a></b><br />
          </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-sm btn-success">Upload</a>
          </form>
      </div>
    </div>

  </div>
</div>