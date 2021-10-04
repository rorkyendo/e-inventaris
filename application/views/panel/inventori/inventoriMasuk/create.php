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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/inventori/createInventoriMasuk/doCreate/')); ?>" enctype="multipart/form-data">
          <div class="col-md-12">
          <center>
            <h3>Scan QR disini</h3>
            <br>
              <div hidden id="reader" class="img-fluid" style="width:280px"></div>
              <br>
              <br>
              <button class="btn btn-xs btn-info" type="button" onclick="scan()"><i class="fa fa-camera"></i> Scan</button>
              <br>
              <br>
            </center>
          </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-2 control-label">Kode Faktur</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Kode Faktur" name="kode_faktur" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Catatan Faktur</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Catatan Faktur (Misal : Inventori Masuk dari Supplier A)" name="catatan_faktur" required />
                </div>
              </div>
              <hr />
              <div class="panel panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title">List Inventori</h4>
                </div>
                <div class="panel-body" id="groupInvent">
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/inventori/inventoriMasuk/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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
<script>
  const html5QrCode = new Html5Qrcode("reader");
  var sound = new Audio("<?php echo base_url('assets/audio/');?>beep.mp3");

  function scan(){
    $("#reader").removeAttr('hidden')
    // This method will trigger user permissions
    Html5Qrcode.getCameras().then(devices => {
    /**
     * devices would be an array of objects of type:
     * { id: "id", label: "label" }
     */
    if (devices && devices.length) {
      var cameraId = devices[0].id;
      html5QrCode.start(
      { facingMode: "environment" },
      {
        fps: 10,    // sets the framerate to 10 frame per second 
        qrbox: 180  // sets only 250 X 250 region of viewfinder to
              // scannable, rest shaded.
      },
      qrCodeMessage => {
        // do something when code is read. For example:
        sound.play();	
        cariInventori(qrCodeMessage)
      },
      errorMessage => {
        // parse error, ideally ignore it. For example:
        // console.log(`QR Code no longer in front of camera.`);
      })
      .catch(err => {
        // Start failed, handle it. For example, 
        console.log(`Unable to start scanning, error: ${err}`);
      });
    }
    }).catch(err => {
    // handle err
    });
  }
</script>
<script>
  function cariInventori(kode_inventori){
    $.ajax({
      url:'<?php echo base_url('panel/inventori/cariInventori');?>',
      type:'GET',
      data:{
        kode_inventori:kode_inventori
      },
      success:function(resp){
        if (resp!='false') {          
          var data = JSON.parse(resp)
          console.log(data)
          $.each(data,function(key,val){
            hapus(val.id_inventori);
            var kode = val.kode_unit+'/'+val.kode_sub_unit+'/'+val.kode_inventori;
            var onclick = "hapus('"+val.id_inventori+"')";
            html5QrCode.stop().then((ignore) => {
              // QR Code scanning is stopped.
              $('#reader').attr('hidden',true);
            }).catch((err) => {
              // Stop failed, handle it.
            });
            $('#groupInvent').appendPolyfill('<div class="col-md-12" id="inventori'+val.id_inventori+'"><div class="col-md-12">'+
            '<button class="btn btn-xs btn-danger" type="button" onclick="'+onclick+'"><i class="fa fa-times"></i> Hapus</button>'+
            '</div><div class="col-md-3">'+
                '<label>Kode Inventori</label>'+
                '<input type="text" value="'+kode+'" class="form-control" readonly>'+
              '</div>'+
              '<div class="col-md-3">'+
                '<label>Nama Inventori</label>'+
                  '<input type="text" value="'+val.nama_inventori+' ('+val.singkatan_satuan+')" class="form-control" readonly>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<input type="hidden" name="id_inventori[]" value="'+val.id_inventori+'">'+
                  '<label>Jumlah Inventori</label>'+
                  '<input type="number" name="jumlah[]" id="jumlah" class="form-control" placeholder="Masukkan Jumlah" required>'+
                '</div>'+
                '<div class="col-md-3">'+
                  '<label>Harga Inventori</label>'+
                  '<input type="number" name="harga_barang[]" id="harga_barang" class="form-control" placeholder="Masukkan Harga Barang Per Satuan" required>'+
                '</div></div>');          
                Swal.fire({
                  type: 'success',
                  title: val.nama_inventori+' (kode:'+kode+')',
                  text: 'berhasil di tambahkan',
                })
          })
        }else{
          Swal.fire({
            type: 'error',
            title: 'Oopps..',
            text: 'Inventori tidak ditemukan',
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
<script>
  function hapus(id_inventori){
    $('#inventori'+id_inventori).remove();
  }
</script>