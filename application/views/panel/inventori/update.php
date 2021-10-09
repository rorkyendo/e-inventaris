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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/inventori/updateInventori/doUpdate/'. $inventori[0]->id_inventori)); ?>">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Unit</label>
                <div class="col-md-10">
                  <select name="kode_unit" id="kode_unit" class="form-control select2"  onchange="cariSubUnit(this.value)">
                    <option value="">.:Pilih Kode Unit:.</option>
                    <?php foreach($unit as $key):?>
                      <option value="<?php echo $key->kode_unit;?>"><?php echo $key->kode_unit;?> | <?php echo $key->nama_unit;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <script>
                $('#kode_unit').val('<?php echo $inventori[0]->kode_unit;?>')
                $(document).ready(function(){
                  cariSubUnit('<?php echo $inventori[0]->kode_unit;?>')
                })

                function cariSubUnit(val){
                  $('#kode_sub_unit').html('<option value="">.:Pilih Kode Sub Unit:.</option>');
                  $.ajax({
                    url:"<?php echo base_url('panel/inventori/getSubUnit');?>",
                    type:"GET",
                    data:{
                      "kode_unit":val
                    },success:function(resp){
                      if (resp!='false') {
                        var data = JSON.parse(resp)
                        $.each(data,function(key,val){
                          $('#kode_sub_unit').append('<option value="'+val.kode_sub_unit+'">'+val.kode_sub_unit+' | '+val.nama_sub_unit+'</option>');
                        })
                        <?php if(!empty($inventori[0]->kode_sub_unit)): ?>
                          $('#kode_sub_unit').val('<?php echo $inventori[0]->kode_sub_unit;?>')
                        <?php endif; ?>
                      }else{
                        Swal.fire({
                          type: 'error',
                          title: 'Gagal',
                          text: 'Sub unit tidak ditemukan',
                        })
                      }
                    },error:function(){
                      Swal.fire({
                        type: 'error',
                        title: 'Oopps..',
                        text: 'Terjadi kesalahan',
                      })
                    }
                  })
                }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Sub Unit</label>
                <div class="col-md-10">
                  <select name="kode_sub_unit" id="kode_sub_unit" class="form-control select2">
                    <option value="">.:Pilih Kode Sub Unit:.</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Sumber Dana</label>
                <div class="col-md-10">
                  <select name="kode_sumber_dana" id="kode_sumber_dana" class="form-control select2">
                    <option value="">.:Pilih Kode Sumber Dana:.</option>
                    <?php foreach($sumberDana as $key):?>
                      <option value="<?php echo $key->kode_sumber_dana;?>"><?php echo $key->kode_sumber_dana;?> | <?php echo $key->keterangan_sumber_dana;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <script>
                $('#kode_sumber_dana').val('<?php echo $inventori[0]->kode_sumber_dana;?>')
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Kode Inventori" name="kode_inventori" value="<?php echo $inventori[0]->kode_inventori;?>" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Inventori" name="nama_inventori" value="<?php echo $inventori[0]->nama_inventori;?>" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kategori Inventori</label>
                <div class="col-md-10">
                  <select name="id_kategori" id="id_kategori" class="form-control" required>
                    <option value="">.:Pilih Kategori:.</option>
                    <?php foreach ($kategori as $key) : ?>
                      <option value="<?php echo $key->id_kategori; ?>"><?php echo $key->nama_kategori; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <script>
                $('#id_kategori').val('<?php echo $inventori[0]->kategori_inventori;?>');
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Satuan Inventori</label>
                <div class="col-md-10">
                  <select name="id_satuan" id="id_satuan" class="form-control" required>
                    <option value="">.:Pilih Satuan:.</option>
                    <?php foreach ($satuan as $key) : ?>
                      <option value="<?php echo $key->id_satuan; ?>"><?php echo $key->nama_satuan; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <script>
                $('#id_satuan').val('<?php echo $inventori[0]->satuan_inventori;?>')
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Jumlah</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" placeholder="Masukkan Jumlah Inventori" name="jumlah_inventori" value="<?php echo $inventori[0]->jumlah_inventori;?>"/>
                  <font color="red">Jumlah inventori akan terupdate secara otomatis saat stock masuk</font>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Harga Barang (Satuan)</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" placeholder="Masukkan Harga Barang" name="harga_barang" value="<?php echo $inventori[0]->harga_barang;?>" required />
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