<?php foreach($inventori as $key):?>
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
      <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <button type="button" onclick="cetak('<?php echo base_url() . $key->qrcode; ?>','<?php echo base_url() . $key->barcode; ?>','<?php echo $key->keterangan_sumber_dana;?>','<?php echo $key->kode_satker;?>')" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Print Barcode</button>
            <a target="_blank" href="<?php echo base_url('panel/inventori/detailInventori/print/'.$key->id_inventori);?>" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Print</a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <form class="form-horizontal">
            <div class="col-md-4">
              <h4 class="text-center">Foto Inventori</h4>
              <center>
                  <?php if(empty($key->foto_inventori)): ?>
                    <img src="<?php echo base_url() . $logo; ?>" class="img-responsive" alt="preview" id="preview" style="height:80px">
                  <?php else: ?>
                    <img src="<?php echo base_url() . $key->foto_inventori; ?>" class="img-responsive" alt="preview" id="preview" style="height:80px">
                  <?php endif; ?>
              </center>
              <br />
            </div>
            <div class="col-md-4">
              <h4 class="text-center">QR CODE</h4>
              <center>
                  <img src="<?php echo base_url() . $key->qrcode; ?>" class="img-responsive" alt="preview" id="preview" style="height:80px">
              </center>
              <br />
            </div>
            <div class="col-md-4">
              <h4 class="text-center">BARCODE</h4>
              <center>
                  <img src="<?php echo base_url() . $key->barcode; ?>" class="img-responsive" alt="preview" id="preview" style="height:80px">
              </center>
              <br />
            </div>
            <div class="col-md-12">
              <table class="table table-striped table-bordered" style="width:100%">
                <tbody>
                  <tr>
                    <td>Kode Sumber Dana</td>
                    <td><?php echo $key->kode_sumber_dana;?></td>
                    <td>Keterangan Sumber Dana</td>
                    <td><?php echo $key->keterangan_sumber_dana;?></td>
                  </tr>
                  <tr>
                    <td>Nama Unit</td>
                    <td><?php echo $key->nama_unit;?></td>
                    <td>Nama Sub Unit</td>
                    <td><?php echo $key->nama_sub_unit;?></td>
                  </tr>
                  <tr>
                    <td>Kode Satker</td>
                    <td><?php echo $key->kode_satker;?></td>
                    <td>Kode Inventori</td>
                    <td><?php echo $key->kode_inventori;?></td>
                  </tr>
                  <tr>
                    <td>Nama Inventori</td>
                    <td><?php echo $key->nama_inventori;?></td>
                    <td>Harga Inventori</td>
                    <td>Rp <?php echo number_format($key->harga_barang,0,'.','.');?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr />
            <div class="form-group">
              <div class="col-md-12">
                <a href="<?php echo base_url(changeLink('panel/inventori/listInventori/')); ?>" class="btn btn-sm btn-danger pull-right"><i class="fa fa-backward"></i> Kembali</a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end col-12 -->
</div>
<!-- end row -->
</div>
<!-- end #content -->
<script>
  function cetak(qrcode,barcode,sumberDana,kodeSatker){
    $('#sumberDana').text(sumberDana);
    $('#kodeSatker').text(kodeSatker);
    $('#print_qr').attr("src",qrcode);
    $('#print_barcode').attr("src",barcode);
    printCode($('<div/>').append($('#pre_print').clone()).html())
  }

  function printCode(data) {
    var printWindow = window.open('', '', 'height=400,width=800');
    printWindow.document.write('<html><head><title>CETAK TRANSAKSI</title>');
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
        <td colspan="2" align="center">
          <b id="sumberDana"></b><br/>
          <b id="kodeSatker"></b>
        </td>
      </tr>
      <tr>
        <td><img src="" id="print_qr" style="width:80px;" alt="qrcode"></td>
        <td><img src="" id="print_barcode" alt="barcode"></td>
      </tr>
    </table>
  </center>
</div>

<?php endforeach;?>