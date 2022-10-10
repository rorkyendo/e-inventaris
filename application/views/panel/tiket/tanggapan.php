<?php foreach($tiket as $key):?>
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
    <div class="col-md-12">
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="<?php echo base_url('panel/tiket/daftarTiket');?>" class="btn btn-xs btn-danger"><i class="fa fa-backward"></i> Kembali</a>
          </div>
          <h4 class="panel-title"><?php echo $subtitle; ?></h4>
        </div>
        <div class="panel-body">
          <center>
            <img src="<?php echo base_url().$key->foto_laporan;?>" style="width:300px" alt="Foto laporan" class="img-responsive">
          </center>
        </div>
      </div>
    </div>
    <!-- begin col-12 -->
    <div class="col-md-6">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
          <h4 class="panel-title">Tanggapan</h4>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <tr>
                <tr align="left">
                  <td>ID Tiket</td>
                  <td> <?php echo $key->id_ticket;?></td>
                  <td>Nama Pelapor</td>
                  <td> <?php echo $key->nama_lengkap;?></td>
                </tr>
                <tr align="left">
                  <td>Ditanggapi Oleh</td>
                  <td> <?php echo $key->nama_penanggap;?></td>
                  <td>Tanggapan Laporan</td>
                  <td> 
                    <form action="<?php echo base_url('panel/tiket/tanggapanTiket/doUpdate/'.$key->id_ticket);?>" method="POST">
                      <textarea name="tanggapan_laporan" class="form-control" id="tanggapan_laporan" cols="30" rows="10"><?php echo $key->tanggapan_laporan;?></textarea>
                      <br>
                      <button class="btn btn-md btn-success pull-right" type="submit"><i class="fa fa-envelope"></i> Kirim tanggapan</button>
                    </form>
                  </td>
                </tr>
                <tr align="left">
                  <td colspan="2">Ditanggapi pada</td>
                  <td colspan="2"> <?php echo $key->ditanggapi_pada;?></td>
                </tr>
              </tr>
            </table>
        </div>
      </div>
      </div>
      <!-- end panel -->
    </div>
    <div class="col-md-6">
      <div class="panel panel-inverse">
      	<div class="panel-heading">
      		<h4 class="panel-title">Update Tiket</h4>
      	</div>
      	<div class="panel-body">
      		<form class="form-horizontal" method="post"
      			action="<?php echo base_url(changeLink('panel/tiket/updateTiket/doUpdate/'.$key->id_ticket)); ?>">
      			<div class="col-md-12">
              <table class="table table-stripped table-bordered">
                <tr align="left">
                	<td>Unit</td>
                	<td> <?php echo $key->nama_unit;?></td>
                	<td>Sub Unit</td>
                	<td> <?php echo $key->nama_sub_unit;?></td>
                </tr>
                <tr align="left">
                	<td>Detail Lokasi</td>
                	<td> <?php echo $key->detail_lokasi;?></td>
                	<td>Keterangan Laporan</td>
                	<td> <?php echo $key->keterangan_laporan;?></td>
                </tr>
                <tr align="left">
                	<td>Tgl Laporan</td>
                	<td> <?php echo $key->dibuat_pada;?></td>
                	<td>Status Laporan</td>
                	<?php if($key->status_laporan == 'N'): ?>
                	<td><b class="text-danger">Belum ditanggapi</b></td>
                	<?php else: ?>
                	<td><b class="text-success">Sudah ditanggapi</b></td>
                	<?php endif; ?>
                </tr>
              </table>
      				<div class="form-group">
      					<label class="col-md-2 control-label">Status laporan</label>
      					<div class="col-md-10">
      						<select name="status_laporan" class="form-control" id="status_laporan">
      							<option value="pending">Belum ditanggapi</option>
      							<option value="accept">Sudah ditanggapi</option>
      							<option value="process">Sedang diperbaiki</option>
      							<option value="finish">Selesai</option>
      						</select>
      					</div>
      				</div>
      				<div class="form-group">
      					<label class="col-md-2 control-label">Diperbaiki Oleh</label>
      					<div class="col-md-10">
      						<select name="diperbaiki_oleh" class="form-control select2" id="diperbaiki_oleh">
      							<option value="">.:Pilih Staff:.</option>
      							<?php foreach($staff as $row):?>
      							<option value="<?php echo $row->id_pengguna;?>"><?php echo $row->nama_lengkap;?></option>
      							<?php endforeach;?>
      						</select>
      					</div>
      				</div>
              <script>
                $('#diperbaiki_oleh').val('<?php echo $key->id_perbaiki;?>')
                $('#status_laporan').val('<?php echo $key->status_laporan;?>')
              </script>
      				<div class="form-group">
      					<label class="col-md-2 control-label">Estimasi Selesai</label>
      					<div class="col-md-10">
      						<input type="datetime-local" name="estimasi_selesai" value="<?php echo $key->estimasi_selesai;?>" class="form-control">
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
<?php endforeach;?>
