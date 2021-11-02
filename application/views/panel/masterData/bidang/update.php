<?php foreach($bidang as $key):?>
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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterData/updateBidang/doUpdate/'.$key->id_bid)); ?>">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Bidang</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Kode Bidang" value="<?php echo $key->kd_bid;?>" name="kd_bid" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Uraian Bidang</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Urain Bidang" value="<?php echo $key->ur_bid;?>" name="ur_bid" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Golongan</label>
                <div class="col-md-10">
                  <select name="gol" id="gol" class="form-control select2">
                    <option value="">.:Pilih Kode Golongan:.</option>
                    <?php foreach($golongan as $row):?>
                      <option value="<?php echo $row->kd_gol;?>"><?php echo $row->kd_gol;?>|<?php echo $row->ur_gol;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <script>
                $('#gol').val('<?php echo $key->gol;?>')
              </script>
            <hr />
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/masterData/daftarBidang/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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
<?php endforeach;?>