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
            <a href="<?php echo base_url('panel/tiket/daftarTiket');?>" class="btn btn-xs btn-danger"><i class="fa fa-backward"></i> Kembali</a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <?php foreach($tiket as $key):?>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <tr>
                <td colspan="2" align="center">
                  <img src="<?php echo base_url().$key->foto_laporan;?>" style="width:300px" alt="Foto laporan" class="img-responsive">
                </td>
                <tr align="left">
                  <td>ID Tiket</td>
                  <td> <?php echo $key->id_ticket;?></td>
                </tr>
                <tr align="left">
                  <td>Nama Pelapor</td>
                  <td> <?php echo $key->nama_lengkap;?></td>
                </tr>
                <tr align="left">
                  <td>Unit</td>
                  <td> <?php echo $key->nama_unit;?></td>
                </tr>
                <tr align="left">
                  <td>Sub Unit</td>
                  <td> <?php echo $key->nama_sub_unit;?></td>
                </tr>
                <tr align="left">
                  <td>Detail Lokasi</td>
                  <td> <?php echo $key->detail_lokasi;?></td>
                </tr>
                <tr align="left">
                  <td>Keterangan Laporan</td>
                  <td> <?php echo $key->keterangan_laporan;?></td>
                </tr>
                <tr align="left">
                  <td>Tgl Laporan</td>
                  <td> <?php echo $key->dibuat_pada;?></td>
                </tr>
                <tr align="left">
                  <td>Status Laporan</td>
                  <?php if($key->status_laporan == 'pending'): ?>
                    <td><b class="text-danger">Belum ditanggapi</b></td>
                  <?php elseif($key->status_laporan == 'accept'): ?>
                    <td><b class="text-primary">Sudah ditanggapi dan menunggu perbaikan</b></td>
                  <?php elseif($key->status_laporan == 'process'): ?>
                    <td><b class="text-warning">Diproses dalam perbaikan</b></td>
                  <?php elseif($key->status_laporan == 'finish'): ?>
                    <td><b class="text-success">Selesai diperbaiki</b></td>
                  <?php endif; ?>
                </tr>
                <tr align="left">
                  <td>Ditanggapi Oleh</td>
                  <td> <?php echo $key->nama_penanggap;?></td>
                </tr>
                <tr align="left">
                  <td>Tanggapan Laporan</td>
                  <td>
                      <?php echo $key->tanggapan_laporan;?>
                  </td>
                </tr>
                <tr align="left">
                  <td>Ditanggapi pada</td>
                  <td> <?php echo $key->ditanggapi_pada;?></td>
                </tr>
              </tr>
                <tr align="left">
                  <td>Di perbaiki oleh</td>
                  <td>
                      <?php echo $key->diperbaiki_oleh;?>
                  </td>
                </tr>
                <tr align="left">
                  <td>Estimasi Selesai</td>
                  <td> <?php echo $key->estimasi_selesai;?></td>
                </tr>
              </tr>
              </tr>
                <tr align="left">
                  <td>Di selesaikan pada</td>
                  <td>
                      <?php echo $key->diselesaikan_pada;?>
                  </td>
                </tr>
              </tr>
            </table>
          <?php endforeach;?>
        </div>
      </div>
      <!-- end panel -->
    </div>
    <!-- end col-12 -->
  </div>
  <!-- end row -->
</div>