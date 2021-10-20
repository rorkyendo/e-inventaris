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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/inventori/createInventori/doCreate/')); ?>" enctype="multipart/form-data">
            <div class="col-md-12">
              <h4 class="text-center">Preview</h4>
              <center>
                <img src="<?php echo base_url().$logo; ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
              </center>
              <br />
              <div class="form-group">
                <label class="col-md-2 control-label">Foto Inventori</label>
                <div class="col-md-10">
                  <input type="file" name="foto_inventori" class="form-control" id="foto_inventori" accept="image/*" />
                </div>
              </div>
            </div>
            <script type="text/javascript">
              function readURL(input) {
                if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
                }
              }
              $("#foto_inventori").change(function() {
                readURL(this);
              });
            </script>
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Unit</label>
                <div class="col-md-10">
                  <select name="kode_unit" id="kode_unit" class="form-control select2"  onchange="cariSubUnit(this.value)" required>
                    <option value="">.:Pilih Kode Unit:.</option>
                    <?php foreach($unit as $key):?>
                      <option value="<?php echo $key->kode_unit;?>"><?php echo $key->kode_unit;?> | <?php echo $key->nama_unit;?></option>
                    <?php endforeach;?>
                  </select>
  								<?php echo form_error('kode_unit'); ?>
                </div>
              </div>
              <script>
                $('#kode_unit').val('<?php echo set_value('kode_unit'); ?>')
                $(document).ready(function(){
                  <?php if(!empty(set_value('kode_unit'))): ?>
                  cariSubUnit('<?php echo set_value('kode_unit'); ?>')
                  <?php endif; ?>
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
                      $('#kode_sub_unit').val('<?php echo set_value('kode_sub_unit'); ?>')
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
                  <select name="kode_sub_unit" id="kode_sub_unit" class="form-control select2" required>
                    <option value="">.:Pilih Kode Sub Unit:.</option>
                  </select>
  								<?php echo form_error('kode_sub_unit'); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Sumber Dana</label>
                <div class="col-md-10">
                  <select name="kode_sumber_dana" id="kode_sumber_dana" class="form-control select2" required>
                    <option value="">.:Pilih Kode Sumber Dana:.</option>
                    <?php foreach($sumberDana as $key):?>
                      <option value="<?php echo $key->kode_sumber_dana;?>"><?php echo $key->kode_sumber_dana;?> | <?php echo $key->keterangan_sumber_dana;?></option>
                    <?php endforeach;?>
                  </select>
  								<?php echo form_error('kode_sumber_dana'); ?>
                  <script>
                    $('#kode_sumber_dana').val('<?php echo set_value('kode_sumber_dana'); ?>')
                  </script>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php echo set_value('kode_inventori'); ?>" id="kode_inventori" placeholder="Masukkan Kode Inventori" name="kode_inventori" required />
  								<?php echo form_error('kode_inventori'); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php echo set_value('nama_inventori'); ?>" placeholder="Masukkan Nama Inventori" name="nama_inventori" required />
  								<?php echo form_error('nama_inventori'); ?>
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
                  <script>
                    $('#id_kategori').val('<?php echo set_value('id_kategori'); ?>')
                  </script>
  								<?php echo form_error('id_kategori'); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Harga Barang (Satuan)</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" placeholder="Masukkan Harga Barang" value="<?php echo set_value('harga_barang'); ?>" name="harga_barang" />
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