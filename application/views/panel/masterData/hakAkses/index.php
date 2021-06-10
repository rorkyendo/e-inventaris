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
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php echo $this->session->flashdata('notif'); ?>
          <a href="<?php echo base_url(changeLink('panel/masterData/createHakAkses')); ?>" class="btn btn-xs btn-primary pull-right" style="margin-left:10px">Tambah Hak Akses</a>
          <br />
          <br />
          <table id="data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Level</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($hak_akses as $key) : ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $key->nama_hak_akses; ?></td>
                  <td>
                    <a href="<?php echo base_url(changeLink('panel/masterData/deletHakAkses/') . $key->id_hak_akses); ?>" onclick="return confirm('Apakah kamu yakin akan menghapus hak akses <?php echo $key->nama_hak_akses; ?> ?')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    <a href="<?php echo base_url(changeLink('panel/masterData/updateHakAkses/') . $key->id_hak_akses); ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
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
  TableManageDefault.init();
</script>