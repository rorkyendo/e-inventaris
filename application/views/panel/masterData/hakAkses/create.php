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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterData/createHakAkses/doCreate/')); ?>">
            <div class="form-group">
              <label class="col-md-2 control-label">Nama Level Pengguna</label>
              <div class="col-md-10">
                <input type="text" class="form-control" placeholder="Masukkan Nama Level Pengguna" name="nama_hak_akses" required />
              </div>
            </div>
            <?php foreach ($parentModul as $key) : ?>
              <div class="col-md-12">
                <div class="panel panel-inverse overflow-hidden">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                      <?php echo $key->nama_parent_modul; ?>
                      <input type="checkbox" name="class_parent_modul[]" value="<?php echo $key->class; ?>" onchange="cek('<?php echo $key->class; ?>')" class="pull-right" id="parent<?php echo $key->class; ?>">
                    </h3>
                  </div>
                  <?php if ($key->child_module == 'Y') : ?>
                    <div id="<?php echo $key->class; ?>" class="panel-collapse collapse out">
                      <div class="panel-body">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <td>#</td>
                              <td>Nama Modul</td>
                              <td>Tipe Modul</td>
                              <td>Tampil Sidebar</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $modul = $this->GeneralModel->get_by_id_general('e_modul', 'class_parent_modul', $key->class);
                            foreach ($modul as $row) : ?>
                              <tr>
                                <?php if ($row->type_modul == 'R') : ?>
                                  <td style="background-color:green;color:white;"><input type="checkbox" name="controller_modul[]" value="<?php echo $row->controller_modul; ?>"></td>
                                  <td style="background-color:green;color:white;"><?php echo $row->nama_modul; ?></td>
                                  <td style="background-color:green;color:white;"><?php echo mb_strtoupper($row->type_modul); ?></td>
                                  <td style="background-color:green;color:white;"><?php echo $row->tampil_sidebar; ?></td>
                                <?php else : ?>
                                  <td><input type="checkbox" name="controller_modul[]" value="<?php echo $row->controller_modul; ?>"></td>
                                  <td><?php echo $row->nama_modul; ?></td>
                                  <td><?php echo mb_strtoupper($row->type_modul); ?></td>
                                  <td><?php echo $row->tampil_sidebar; ?></td>
                                <?php endif; ?>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
            <div class="col-md-12">
              <a href="<?php echo base_url(changeLink('panel/masterData/hakAkses')); ?>" class="btn btn-sm btn-danger">Batal</a>
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
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
  function cek(className) {
    if ($('#parent' + className).is(':checked')) {
      $('#' + className).removeClass('out')
      $('#' + className).addClass('in')
    } else {
      $('#' + className).removeClass('in')
      $('#' + className).addClass('out')
    }
  }
</script>