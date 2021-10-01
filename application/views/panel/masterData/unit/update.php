<?php foreach($getMapel as $key):?>
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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterData/updateMapel/doUpdate/'.$key->id_mapel)); ?>">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Mapel</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php echo $key->nama_mapel;?>" placeholder="Masukkan Nama Mapel" name="nama_mapel" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Deskripsi Mapel</label>
                <div class="col-md-10">
                  <textarea name="deskripsi_mapel" id="deskripsi_mapel" class="form-control" cols="30" rows="10"><?php echo $key->deskripsi_mapel;?></textarea>
                </div>
              </div>
              <script>
                  CKEDITOR.replace('deskripsi_mapel');
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Pilih Paket Soal</label>
                <div class="col-md-10">
                  <select name="paket_soal" id="paket_soal" class="form-control select2">
                    <option value="">.:Pilih Paket Soal:.</option>
                    <?php foreach($paketSoal as $row):?>
                      <option value="<?php echo $row->id_paket_soal;?>"><?php echo $row->judul_paket;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <script>
                $('#paket_soal').val('<?php echo $key->paket_soal;?>');
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Jenis Penilaian</label>
                <div class="col-md-10">
                  <select name="penilaian_mapel" class="form-control" id="penilaian_mapel" onchange="pilihPenilaian(this.value)" required>
                    <option value="">.:Pilih Jenis Penilaian:.</option>
                    <option value="bobot">Bobot Nilai</option>
                    <option value="soal">Nilai Persoal</option>
                  </select>
                </div>
              </div>
              <script>
                $('#document').ready(function(){
                  $('#penilaian_mapel').val('<?php echo $key->penilaian_mapel;?>');
                  pilihPenilaian('<?php echo $key->penilaian_mapel;?>')
                })

                function pilihPenilaian(val){
                  if (val == 'bobot') {
                    $('#skorPenilaian').removeAttr('hidden');
                    $('#nilai_benar').val('<?php echo $key->nilai_benar;?>')
                    $('#nilai_salah').val('<?php echo $key->nilai_salah;?>')
                    $('#nilai_kosong').val('<?php echo $key->nilai_kosong;?>')
                  }else{
                    $('#skorPenilaian').attr('hidden',true);
                    $('#nilai_benar').val('')
                    $('#nilai_salah').val('')
                    $('#nilai_kosong').val('')
                  }
                }
              </script>
              <div id="skorPenilaian" hidden>
                <div class="form-group">
                  <label class="col-md-2 control-label">Nilai Benar</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="Masukkan Nilai Benar" name="nilai_benar"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Nilai Salah</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="Masukkan Nilai Salah" name="nilai_salah"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Nilai Kosong</label>
                  <div class="col-md-10">
                    <input type="number" class="form-control" placeholder="Masukkan Nilai Kosong" name="nilai_kosong"/>
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/masterData/daftarMapel/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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
