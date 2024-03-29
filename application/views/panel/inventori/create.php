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
                  <input type="file" name="foto_inventori" class="form-control" id="foto_inventori" accept="image/*" capture/>
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
                <label class="col-md-2 control-label">Kode Golongan</label>
                <div class="col-md-10">
                  <select name="gol" id="gol" class="form-control select2" onchange="cariBidang(this.value)" required>
                    <option value="">.:Pilih Kode Golongan:.</option>
                    <?php foreach($golongan as $key):?>
                      <option value="<?php echo $key->kd_gol;?>"><?php echo $key->kd_gol;?>|<?php echo $key->ur_gol;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <script>
                cariBidang('<?php echo set_value('gol');?>')
                function cariBidang(val){
                  $.ajax({
                    url:'<?php echo base_url('panel/masterData/getBidang');?>',
                    type:'GET',
                    data:{
                      'gol':val
                    },success:function(resp){
                      if (resp!='false') {
                        $('#bid').html('<option value="">.:Pilih Kode Bidang:.</option>');
                        var data = JSON.parse(resp);
                        $.each(data,function(key,val){
                          $('#bid').append('<option value="'+val.kd_bid+'">'+val.kd_bid+'|'+val.ur_bid+'</option>');
                        })
                        cariKelompok('<?php echo set_value('bid');?>')
                      }else{
                        $('#bid').html('<option value="">.:Pilih Kode Bidang:.</option>');
                      }
                    },error:function(){
                      alert('Terjadi kesalahan!')
                    }
                  })
                }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Bidang</label>
                <div class="col-md-10">
                  <select name="bid" id="bid" class="form-control select2" onchange="cariKelompok(this.value)">
                    <option value="">.:Pilih Kode Bidang:.</option>
                  </select>
                </div>
              </div>
              <script>
                function cariKelompok(val){
                  var kode_golongan = $('#gol').val();
                  $.ajax({
                    url:'<?php echo base_url('panel/masterData/getKelompok');?>',
                    type:'GET',
                    data:{
                      'kd_gol':kode_golongan,
                      'kd_bid':val
                    },success:function(resp){
                      if (resp!='false') {
                        $('#kel').html('<option value="">.:Pilih Kode Kelompok:.</option>');
                        var data = JSON.parse(resp);
                        $.each(data,function(key,val){
                          $('#kel').append('<option value="'+val.kd_kel+'">'+val.kd_kel+'|'+val.ur_kel+'</option>');
                        })
                        cariSubKelompok('<?php echo set_value('kel');?>')
                      }else{
                        $('#kel').html('<option value="">.:Pilih Kode Kelompok:.</option>');
                      }
                    },error:function(){
                      alert('Terjadi kesalahan!')
                    }
                  })
                }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Kelompok</label>
                <div class="col-md-10">
                  <select name="kel" id="kel" class="form-control select2" onchange="cariSubKelompok(this.value)">
                    <option value="">.:Pilih Kode Kelompok:.</option>
                  </select>
                </div>
              </div>
              <script>
                function cariSubKelompok(val){
                  var kode_golongan = $('#gol').val();
                  var kode_bidang = $('#bid').val();
                  $.ajax({
                    url:'<?php echo base_url('panel/masterData/getSubKelompok');?>',
                    type:'GET',
                    data:{
                      'kd_gol':kode_golongan,
                      'kd_bid':kode_bidang,
                      'kd_kel':val,
                    },success:function(resp){
                      if (resp!='false') {
                        $('#skel').html('<option value="">.:Pilih Kode Sub Kelompok:.</option>');
                        var data = JSON.parse(resp);
                        $.each(data,function(key,val){
                          $('#skel').append('<option value="'+val.kd_skel+'">'+val.kd_skel+'|'+val.ur_skel+'</option>');
                        })
                      }else{
                        $('#skel').html('<option value="">.:Pilih Kode Sub Kelompok:.</option>');
                      }
                    },error:function(){
                      alert('Terjadi kesalahan!')
                    }
                  })
                }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Sub Kelompok</label>
                <div class="col-md-10">
                  <select name="skel" id="skel" class="form-control select2" onchange="cariSubSubKelompok(this.value)">
                    <option value="">.:Pilih Kode Sub Kelompok:.</option>
                  </select>
                </div>
              </div>
              <script>
                function cariSubSubKelompok(val){
                  var kode_golongan = $('#gol').val();
                  var kode_bidang = $('#bid').val();
                  var kode_kelompok = $('#kel').val();
                  $.ajax({
                    url:'<?php echo base_url('panel/masterData/getSubSubKelompok');?>',
                    type:'GET',
                    data:{
                      'kd_gol':kode_golongan,
                      'kd_bid':kode_bidang,
                      'kd_kel':kode_kelompok,
                      'kd_skel':val,
                    },success:function(resp){
                      if (resp!='false') {
                        $('#sskel').html('<option value="">.:Pilih Kode Sub-sub Kelompok:.</option>');
                        var data = JSON.parse(resp);
                        $.each(data,function(key,val){
                          $('#sskel').append('<option value="'+val.kd_sskel+'">'+val.kd_sskel+'|'+val.ur_sskel+'</option>');
                        })
                      }else{
                        $('#sskel').html('<option value="">.:Pilih Kode Sub-sub Kelompok:.</option>');
                      }
                    },error:function(){
                      alert('Terjadi kesalahan!')
                    }
                  })
                }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Sub-sub Kelompok</label>
                <div class="col-md-10">
                  <select name="sskel" id="sskel" class="form-control select2" onchange="getLastRecord(this.value)">
                    <option value="">.:Pilih Kode Sub-sub Kelompok:.</option>
                  </select>
                </div>
              </div>
              <script>
                function getLastRecord(val){
                  var gol = $('#gol').val();
                  var bid = $('#bid').val();
                  var kel = $('#kel').val();
                  var skel = $('#skel').val();
                  var sskel = val
                  $.ajax({
                    url:'<?php echo base_url('panel/inventori/getLastRecord');?>',
                    type:'GET',
                    data:{
                      gol:gol,
                      bid:bid,
                      kel:kel,
                      skel:skel,
                      sskel:sskel
                    },success:function(resp){
                      if (resp!='false') {
                        var last = Number(resp)+Number(1)
                        $('#no_inventori').val(('0000' + last).slice(-4));
                        inputKodeInventori($('#no_inventori').val())
                      }
                    }
                  })
                }

                  function pad_with_zeroes(number, length) {

                      var my_string = '' + number;
                      while (my_string.length < length) {
                          my_string = '0' + my_string;
                      }

                      return my_string;

                  }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">No Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php echo set_value('no_inventori'); ?>" id="no_inventori" placeholder="Masukkan No Inventori" onchange="inputKodeInventori(this.value)" minlength="4" maxlength="4" name="no_inventori" required />
  								<?php echo form_error('no_inventori'); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Jumlah Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php echo set_value('jumlah_inventori'); ?>" id="jumlah_inventori" placeholder="Masukkan Jumlah Inventori" name="jumlah_inventori"/>
                  <font color="red">*Jumlah inventori berfungsi untuk melakukan penambahan no inventori secara otomatis pada saat disimpan <br/>(Kosongkan jika hanya ingin menyimpan 1 inventori)</font>
                </div>
              </div>
              <script>
                function inputKodeInventori(val){
                  var gol = $('#gol').val();
                  var bid = $('#bid').val();
                  var kel = $('#kel').val();
                  var skel = $('#skel').val();
                  var sskel = $('#sskel').val();
                  $('#kode_inventori').val(gol+'.'+bid+'.'+kel+'.'+skel+'.'+sskel+'.'+val)
                }
              </script>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Inventori</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php echo set_value('kode_inventori'); ?>" id="kode_inventori" placeholder="Masukkan Kode Inventori" name="kode_inventori" readonly required />
                  <font color="red">Kode Inventori dibuat otomatis berdasarkan gol.bid.kel.subkel.subsubkel.noinventori</font>
  								<?php echo form_error('kode_inventori'); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Satker</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" value="023.04.0700.415030.021.KD" readonly/>
                </div>
                <div class="col-md-2">
                  <?php if(!empty(set_value('kode_satker'))){
                    $kode_satker = set_value('kode_satker');
                  }else{
                    $kode_satker = DATE('Y');
                  } ?>
                  <input type="text" class="form-control" value="<?php echo $kode_satker; ?>" id="kode_satker" placeholder="Masukkan Kode Satker" name="kode_satker" required />
  								<?php echo form_error('kode_satker'); ?>
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