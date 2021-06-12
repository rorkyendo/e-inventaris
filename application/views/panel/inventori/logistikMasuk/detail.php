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
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <div class="row">
            <div class="col-md-6">
              <table>
                <tr>
                  <td>ID Faktur</td>
                  <td> :
                    <?php echo $faktur[0]->id_faktur; ?>
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
              <img src="<?php echo base_url() . $faktur[0]->qrcode_faktur; ?>" class="img-responsive pull-right" alt="" style="width:250px">
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
                  <th>Harga Pokok</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($detailFaktur as $row) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->nama_inventori; ?></td>
                    <td><?php echo number_format($row->jumlah_inventori_faktur, 0, '.', '.'); ?> <?php echo $row->singkatan_satuan; ?></td>
                    <td>Rp <?php echo number_format($row->harga_pokok_faktur, 0, '.', '.'); ?></td>
                  </tr>
              </tbody>
            <?php endforeach; ?>
            </table>
            <div class="col-md-12">
              <a href="<?php echo base_url(changeLink('panel/inventori/logistikMasuk/')); ?>" class="btn btn-sm btn-danger pull-right" style="margin-left:10px;">Batal</a>
              <a href="<?php echo base_url(changeLink('panel/inventori/approveLogistikMasuk/' . $faktur[0]->id_faktur)); ?>" class="btn btn-sm btn-success pull-right" onclick="return confirm('apakah kamu yakin akan mengapprove faktur ini?')" style="margin-left:10px;">Approve</a>
              <a href="<?php echo base_url(changeLink('panel/inventori/rejectLogistikMasuk/' . $faktur[0]->id_faktur)); ?>" class="btn btn-sm btn-warning pull-right" onclick="return confirm('apakah kamu yakin akan mereject faktur ini?')" style="margin-left:10px;">Reject</a>
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
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "#add", function() {
      $('#groupInvent:first').clone().insertAfter("#groupInvent:last");
    });
    $(document).on("click", "#delete", function() {
      $(this).closest("#groupInvent").remove();
    });
  });
</script>