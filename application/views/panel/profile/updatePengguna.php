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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/profile/edit/doEdit/')); ?>" enctype="multipart/form-data">
            <div class="col-md-12 bg-red">
              <h3 style="color:white">Data Diri</h3>
              <hr>
            </div>
            <div class="col-md-12">
              <h4 class="text-center">Preview</h4>
              <center>
                <?php if (!empty($pengguna[0]->foto_pengguna)) : ?>
                  <img src="<?php echo base_url() . $pengguna[0]->foto_pengguna; ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
                <?php else : ?>
                  <img src="<?php echo base_url('assets/img/no-image.png'); ?>" class="img-responsive" alt="preview" id="preview" style="height:150px">
                <?php endif; ?>
              </center>
              <br />
              <div class="form-group">
                <label class="col-md-2 control-label">Foto Pengguna</label>
                <div class="col-md-10">
                  <input type="file" name="foto_pengguna" class="form-control" id="foto_pengguna" accept="image/*" />
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
              $("#foto_pengguna").change(function() {
                readURL(this);
              });
            </script>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-2 control-label">Username</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Username Pengguna" value="<?php echo $pengguna[0]->username; ?>" name="username" disabled />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Nama Lengkap</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap Pengguna" value="<?php echo $pengguna[0]->nama_lengkap; ?>" name="nama_lengkap" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-10">
                  <input type="email" class="form-control" placeholder="Masukkan email" value="<?php echo $pengguna[0]->email; ?>" name="email" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">No HP / WA</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan no hp/wa" name="no_wa" value="<?php echo $pengguna[0]->no_wa;?>" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Jenkel</label>
                <div class="col-md-10">
                  <select name="jenkel" id="jenkel" class="form-control">
                    <option value="">.:Pilih Jenkel:.</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <script>
                  $('#jenkel').val('<?php echo $pengguna[0]->jenkel;?>')
                </script>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-2 control-label">Buat Password</label>
                <div class="col-md-10">
                  <input type="password" class="form-control" placeholder="Masukkan Password Baru" id="password" onkeyup="cekPassword()" name="password" />
                  <!-- <font color="red" id="notifpass"></font> -->
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Ulangi Password</label>
                <div class="col-md-10">
                  <input type="password" class="form-control" placeholder="Ulangi Password Baru" onkeyup="cekPassword()" id="re_password" name="re_password" />
                  <font color="red" id="notifrepass"></font>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Hak Akses</label>
                <b style="font-size: 18px;" class="text-success"><?php echo $pengguna[0]->hak_akses;?></b>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Unit</label>
                <div class="col-md-10">
                  <select class="form-control select2" id="unit" onchange="cariSubUnit(this.value)" disabled>
                    <option value="">.:Pilih Unit:.</option>
                    <?php foreach ($unit as $key) : ?>
                      <option value="<?php echo $key->id_unit; ?>"><?php echo $key->nama_unit; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Sub Unit</label>
                <div class="col-md-10">
                  <select class="form-control select2" id="sub_unit" name="sub_unit" disabled>
                    <option value="">.:Pilih Sub Unit:.</option>
                  </select>
                </div>
              </div>
              <script type="text/javascript">
                function cekPassword() {
                  var repass = $('#re_password').val()
                  var pass = $('#password').val()
                  if (repass != pass || pass != repass) {
                    $('#notifrepass').prop('color', 'red');
                    $('#notifrepass').text('Ulangi password tidak sama dengan password');
                    $('#btnSimpan').attr('disabled', true);
                  } else {
                    $('#notifrepass').prop('color', 'green');
                    $('#notifrepass').text('Ulangi password sama dengan password');
                    $('#btnSimpan').removeAttr('disabled');
                  }
                }
              </script>
            </div>
            <div class="col-md-12">
              <hr />
              <div class="form-group">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-sm btn-success pull-right" id="btnSimpan" style="margin-left:10px">Simpan</button>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#unit').val('<?php echo $pengguna[0]->unit;?>');
    cariSubUnit('<?php echo $pengguna[0]->unit;?>')
  })
  function cariSubUnit(val){
    $('#sub_unit').html('<option value="">.:Pilih Sub Unit:.</option>');
    $.ajax({
      url:'<?php echo base_url('panel/masterData/getSubUnit');?>',
      type:'GET',
      data:{
        'unit':val
      },success:function(resp){
        if (resp!='false') {
          var data = JSON.parse(resp);
          $.each(data,function(key,val){
            $('#sub_unit').append('<option value="'+val.id_sub_unit+'">'+val.nama_sub_unit+'</option>');
          })
          <?php if(!empty($pengguna[0]->sub_unit)): ?>
            $('#sub_unit').val('<?php echo $pengguna[0]->sub_unit;?>');
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
          title: 'Oopss..',
          text: 'Terjadi kesalahan',
        })
      }
    })
  }
</script>