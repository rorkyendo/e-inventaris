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
          <form class="form-horizontal">
            <div class="col-md-12">
              <h4 class="text-center">QR CODE</h4>
              <center>
                  <img src="<?php echo base_url() . $inventori[0]->qrcode; ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
              </center>
              <br />
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Inventori" name="nama_inventori" value="<?php echo $inventori[0]->nama_inventori; ?>" disabled />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kategori Inventori</label>
                <div class="col-md-10">
                  <select name="id_kategori" id="id_kategori" class="form-control" disabled>
                    <option value="">.:Pilih Kategori:.</option>
                    <?php foreach ($kategori as $key) : ?>
                      <option value="<?php echo $key->id_kategori; ?>"><?php echo $key->nama_kategori; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <script>
                $('#id_kategori').val('<?php echo $inventori[0]->kategori_inventori; ?>');
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Satuan Inventori</label>
                <div class="col-md-10">
                  <select name="id_satuan" id="id_satuan" class="form-control" disabled>
                    <option value="">.:Pilih Satuan:.</option>
                    <?php foreach ($satuan as $key) : ?>
                      <option value="<?php echo $key->id_satuan; ?>"><?php echo $key->nama_satuan; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <script>
                $('#id_satuan').val('<?php echo $inventori[0]->satuan_inventori; ?>')
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Jumlah</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" placeholder="Masukkan Jumlah Inventori" name="jumlah_inventori" value="<?php echo $inventori[0]->jumlah_inventori; ?>" disabled />
                  <font color="red">Jumlah inventori akan terupdate secara otomatis saat stock masuk</font>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Harga Pokok (Satuan)</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" placeholder="Masukkan Harga Pokok" name="harga_barang" value="<?php echo $inventori[0]->harga_barang; ?>" disabled />
                  <font color="red">Harga pokok akan terupdate secara otomatis saat stock masuk</font>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Harga Jual</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" placeholder="Masukkan Harga Jual" name="harga_jual" value="<?php echo $inventori[0]->harga_jual; ?>" disabled />
                </div>
              </div>
            </div>
            <hr />
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/inventori/listInventori/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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