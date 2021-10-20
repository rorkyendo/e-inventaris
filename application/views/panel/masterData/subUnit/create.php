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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterData/tambahSubUnit/doCreate/')); ?>">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Unit</label>
                <div class="col-md-10">
                  <select name="unit" id="unit" class="form-control select2" required>
                    <option value="">.:Pilih Unit:.</option>
                    <?php foreach($unit as $key):?>
                      <option value="<?php echo $key->id_unit;?>"><?php echo $key->kode_unit;?> | <?php echo $key->nama_unit;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Sub Unit</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Kode Sub Unit" name="kode_sub_unit" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Sub Unit</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Sub Unit" name="nama_sub_unit" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Keterangan Sub Unit</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Keterangan Sub Unit" name="keterangan_sub_unit"/>
                </div>
              </div>
            <hr />
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/masterData/daftarSubUnit/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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