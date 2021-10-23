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
            <a href="<?php echo base_url(changeLink('panel/inventori/createInventori/')); ?>" class="btn btn-xs btn-primary pull-right">Tambah Inventori</a>
            <a target="_blank" href="<?php echo base_url(changeLink('panel/inventori/listInventori/print?id_kategori='.$id_kategori.'&kode_unit='.$kode_unit.'&kode_sub_unit='.$kode_sub_unit)); ?>" class="btn btn-xs btn-success pull-right">Print</a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <form action="<?php echo base_url('panel/inventori/listInventori');?>" method="GET">
          <div class="col-md-4">
            <select class="form-control select2" id="id_kategori" name="id_kategori">
              <option value="">.:Pilih Kategori Inventori:.</option>
              <?php foreach ($getKategori as $key) : ?>
                <option value="<?php echo $key->id_kategori; ?>"><?php echo $key->nama_kategori; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <select name="kode_unit" id="kode_unit" class="form-control select2"  onchange="cariSubUnit(this.value)">
                  <option value="">.:Pilih Kode Unit:.</option>
                  <?php foreach($unit as $key):?>
                    <option value="<?php echo $key->kode_unit;?>"><?php echo $key->kode_unit;?> | <?php echo $key->nama_unit;?></option>
                  <?php endforeach;?>
                </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <select name="kode_sub_unit" id="kode_sub_unit" class="form-control select2">
                  <option value="">.:Pilih Kode Sub Unit:.</option>
                </select>
            </div>
          </div>
          <script>
            $('#id_kategori').val('<?php echo $id_kategori;?>');
            $('#kode_unit').val('<?php echo $kode_unit;?>');
            $('#kode_sub_unit').val('<?php echo $kode_sub_unit;?>');
          </script>
          <div class="col-md-12">
            <button class="btn btn-primary btn-xs btn-block" type="submit">Cari Inventori</button>
            <br />
            <br />
          </div>
          </form>
          <table id="table" class="table table-striped table-bordered" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>Unit</th>
                <th>Sub Unit</th>
                <th>Keterangan Sumber Dana</th>
                <th>Foto Inventori</th>
                <th>Kode Inventori</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
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
          "id_kategori": "<?php echo $id_kategori; ?>",
          "kode_unit":"<?php echo $kode_unit;?>",
          "kode_sub_unit":"<?php echo $kode_sub_unit;?>"
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
          "data": "nama_sub_unit",
          width: 100,
        },
        {
          "data": "keterangan_sumber_dana",
          width: 100,
        },
        {
          "data": "foto_inventori",
          width: 100,
          render: function(data, type, row, meta) {
            if (row.foto_inventori == '') {
              return "<b class='text-danger'>Tidak ada foto</b>";              
            }else{
              return "<img src='<?php echo base_url(); ?>" + row.foto_inventori + "' class='img-responsive' style='width:250px'>"
            }
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
          "data": "nama_kategori",
          width: 100
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
          width: 100,
          render: function(data, type, row, meta) {
            var onclick = "cetak('<?php echo base_url(); ?>" + row.qrcode + "','<?php echo base_url(); ?>" + row.barcode + "','"+row.keterangan_sumber_dana+"')"
            return row.action+'<button type="button" class="btn btn-xs btn-success" onclick="'+onclick+'"><i class="fa fa-print"></i> Print</button>'
          }
        },
      ],
    });
  });
</script>

<script>
  function cetak(qrcode,barcode,sumberDana){
    $('#sumberDana').text(sumberDana);
    $('#print_qr').attr("src",qrcode);
    $('#print_barcode').attr("src",barcode);
    printCode($('<div/>').append($('#pre_print').clone()).html())
  }

  function printCode(data) {
    var printWindow = window.open('', '', 'height=400,width=800');
    printWindow.document.write('<html><head><title>CETAK INVENTORI</title>');
    printWindow.document.write('<style>@media print{@page{size: 80mm auto} #pre_print {width: 80mm;font-size: 15px;}}</style></head><body>');
    printWindow.document.write(data);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    setTimeout(() => { printWindow.print(); }, 1000);
  }
</script>

<div id="pre_print" class="hidden">
  <center>
    <table border="1px" style="border-collapse: collapse;">
      <tr>
        <td colspan="2" align="center"><b id="sumberDana"></b></td>
      </tr>
      <tr>
        <td><img src="" id="print_qr" style="width:80px;" alt="qrcode"></td>
        <td><img src="" id="print_barcode" alt="barcode"></td>
      </tr>
    </table>
  </center>
</div>

<script>
  $(document).ready(function(){
    <?php if(!empty($kode_unit)): ?>
      cariSubUnit('<?php echo $kode_unit; ?>')
    <?php endif; ?>
  })

  function cariSubUnit(val){
    $('#kode_sub_unit').html('<option value="">.:Pilih Kode Sub Unit:.</option>');
    $.ajax({
      url:"<?php echo base_url('panel/inventori/getSubUnit');?>",
      type:"GET",
      data:{
        "kode_unit":val
      },success:function(resp){
        if (resp!='false') {
          var data = JSON.parse(resp)
          $.each(data,function(key,val){
            $('#kode_sub_unit').append('<option value="'+val.kode_sub_unit+'">'+val.kode_sub_unit+' | '+val.nama_sub_unit+'</option>');
          })
        $('#kode_sub_unit').val('<?php echo $kode_sub_unit; ?>')
        }else{
          Swal.fire({
            type: 'error',
            title: 'Gagal',
            text: 'Sub unit tidak ditemukan',
          })
        }
      },error:function(){
        Swal.fire({
          type: 'error',
          title: 'Oopps..',
          text: 'Terjadi kesalahan',
        })
      }
    })
  }
</script>