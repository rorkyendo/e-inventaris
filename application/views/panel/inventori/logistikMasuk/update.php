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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/inventori/updateLogistikMasuk/doUpdate/' . $faktur[0]->id_faktur)); ?>" enctype="multipart/form-data">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Catatan Faktur</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Catatan Faktur (Misal : Inventori Masuk dari Supplier A)" name="catatan_faktur" value="<?php echo $faktur[0]->catatan_faktur; ?>" required />
                </div>
              </div>
              <hr />
              <?php foreach ($detailFaktur as $row) : ?>
                <div class="panel panel-inverse" id="groupInvent">
                  <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <button type="button" id="add" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Tambah</button>
                      <button type="button" id="delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Hapus</button>
                    </div>
                    <h4 class="panel-title">Pilih Inventori</h4>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-3">
                      <select name="id_inventori[]" id="id_inventori<?php echo $row->id_detail_faktur; ?>" class="form-control" required>
                        <option value="">.:Pilih Inventori:.</option>
                        <?php foreach ($inventori as $key) : ?>
                          <option value="<?php echo $key->id_inventori; ?>"><?php echo $key->nama_inventori; ?> (<?php echo $key->singkatan_satuan; ?>)</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <script>
                      $('#id_inventori<?php echo $row->id_detail_faktur; ?>').val('<?php echo $row->id_inventori;?>')
                    </script>
                    <div class="col-md-3">
                      <input type="text" onkeypress="return isNumberKey(event)" name="jumlah[]" value="<?php echo $row->jumlah_inventori;?>" id="jumlah" class="form-control" placeholder="Masukkan Jumlah" required>
                    </div>
                    <div class="col-md-3">
                      <input type="text" onkeypress="return isNumberKey(event)" name="harga_pokok[]" value="<?php echo $row->harga_pokok;?>" id="harga_pokok" class="form-control" placeholder="Masukkan Harga Pokok Per Satuan" required>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/inventori/logistikMasuk/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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