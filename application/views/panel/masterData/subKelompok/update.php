<?php foreach($sKelompok as $key):?>
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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/masterData/updateSubKelompok/doUpdate/'.$key->id_skel)); ?>">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Golongan</label>
                <div class="col-md-10">
                  <select name="gol" id="gol" class="form-control select2" onchange="cariBidang(this.value)" required>
                    <option value="">.:Pilih Kode Golongan:.</option>
                    <?php foreach($golongan as $row):?>
                      <option value="<?php echo $row->kd_gol;?>"><?php echo $row->kd_gol;?>|<?php echo $row->ur_gol;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <script>
                $('#gol').val('<?php echo $key->gol;?>')
                cariBidang('<?php echo $key->gol;?>')
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
                        $('#bid').val('<?php echo $key->bid;?>')
                        cariKelompok('<?php echo $key->bid;?>')
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
                        $('#kel').val('<?php echo $key->kel;?>')
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
                  <select name="kel" id="kel" class="form-control select2">
                    <option value="">.:Pilih Kode Kelompok:.</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Sub Kelompok</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Kode Kelompok" name="kd_skel" value="<?php echo $key->kd_skel;?>" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Uraian Sub Kelompok</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Urain Kelompok" name="ur_skel" value="<?php echo $key->ur_skel?>" required />
                </div>
              </div>        
            <hr />
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/masterData/daftarSubKelompok/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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