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
            <a href="#" class="btn btn-warning btn-xs" onclick="cetak('<?php echo base_url().$faktur[0]->qrcode_faktur;?>','<?php echo base_url().$faktur[0]->barcode_faktur;?>','<?php echo $faktur[0]->id_faktur;?>')"><i class="fa fa-print"></i> Print Tiket Faktur</a>
            <a target="_blank" href="<?php echo base_url('panel/inventori/detailInventoriMasuk/print/'.$faktur[0]->id_faktur);?>" class="btn btn-success btn-xs"><i class="fa fa-print"></i> Print Faktur</a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <div class="row">
            <div class="col-md-6">
              <table>
                <tr>
                  <td>Kode Faktur</td>
                  <td> :
                    <?php echo $faktur[0]->kode_faktur; ?>
                  </td>
                </tr>
                <tr>
                  <td>Dibuat Oleh</td>
                  <td> :
                    <?php echo $faktur[0]->pembuat_faktur; ?>
                  </td>
                </tr>
                <tr>
                  <td>Dibuat Pada</td>
                  <td> :
                    <?php echo $faktur[0]->created_time; ?>
                  </td>
                </tr>
                <tr>
                  <td>Catatan Faktur</td>
                  <td> :
                    <?php echo $faktur[0]->catatan_faktur; ?>
                  </td>
                </tr>
                <tr>
                  <td>Status Approval</td>
                  <td> :
                    <?php if ($faktur[0]->status_approval == 'pending') : ?>
                      <b class="text-warning">Pending</b>
                    <?php elseif ($faktur[0]->status_approval == 'rejected') : ?>
                      <b class="text-danger">Rejected</b>
                    <?php else : ?>
                      <b class="text-success">Success</b>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td>Tgl Approval</td>
                  <td>:
                    <?php echo $faktur[0]->approval_time; ?>
                  </td>
                </tr>
                <tr>
                  <td>Di approve/reject Oleh</td>
                  <td> :
                    <?php echo $faktur[0]->pengaprove_faktur; ?>
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-bordered" class="pull-right" style="width: 100%;">
                <tr>
                  <td align="center" colspan="2">ID FAKTUR : <?php echo $faktur[0]->id_faktur;?></td>
                </tr>
                <tr>
                  <td align="center">
                    <img src="<?php echo base_url() . $faktur[0]->qrcode_faktur; ?>" class="img-responsive" alt="" style="width:80px">
                  </td>
                  <td align="center">
                    <img src="<?php echo base_url() . $faktur[0]->barcode_faktur; ?>" class="img-responsive" alt="" style="width:80px">
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-md-12">
            <hr />
            <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Inventori</th>
                  <th>Jumlah</th>
                  <th>Harga Barang</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($detailFaktur as $row) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->nama_inventori; ?></td>
                    <td><?php echo number_format($row->jumlah_inventori_faktur, 0, '.', '.'); ?> <?php echo $row->singkatan_satuan; ?></td>
                    <td>Rp <?php echo number_format($row->harga_barang_faktur, 0, '.', '.'); ?></td>
                  </tr>
              </tbody>
            <?php endforeach; ?>
            </table>
            Total Belanja <b class="pull-right">Rp <?php echo number_format($faktur[0]->total_belanja, 0, '.', '.'); ?></b>
            <hr />
            <div class="col-md-12">
              <a href="<?php echo base_url(changeLink('panel/inventori/inventoriMasuk/')); ?>" class="btn btn-sm btn-danger pull-right" style="margin-left:10px;">Batal</a>
              <?php if ($faktur[0]->status_approval == 'pending') : ?>
                <a href="<?php echo base_url(changeLink('panel/inventori/approveInventoriMasuk/' . $faktur[0]->id_faktur)); ?>" class="btn btn-sm btn-success pull-right" onclick="return confirm('apakah kamu yakin akan mengapprove faktur ini?')" style="margin-left:10px;">Approve</a>
                <a href="<?php echo base_url(changeLink('panel/inventori/rejectInventoriMasuk/' . $faktur[0]->id_faktur)); ?>" class="btn btn-sm btn-warning pull-right" onclick="return confirm('apakah kamu yakin akan mereject faktur ini?')" style="margin-left:10px;">Reject</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end col-12 -->
</div>
<!-- end row -->
</div>
<!-- end #content -->

<script>
  function cetak(qrcode,barcode,faktur){
    $('#idFaktur').text(faktur);
    $('#print_qr').attr("src",qrcode);
    $('#print_barcode').attr("src",barcode);
    printCode($('<div/>').append($('#pre_print').clone()).html())
  }

  function printCode(data) {
    var printWindow = window.open('', '', 'height=400,width=800');
    printWindow.document.write('<html><head><title>CETAK FAKTUR</title>');
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
        <td colspan="2" align="center"><b id="idFaktur"></b></td>
      </tr>
      <tr>
        <td><img src="" id="print_qr" style="width:80px;" alt="qrcode"></td>
        <td><img src="" id="print_barcode" alt="barcode"></td>
      </tr>
    </table>
  </center>
</div>