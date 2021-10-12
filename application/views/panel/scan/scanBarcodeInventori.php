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
            <h5 class="text-center">Detail inventori</h5>
            <hr>
            <table class="table table-striped table-bordered" style="width:100%">
              <tbody>
                <tr>
                  <td id="qrCode" colspan="4" align="center"></td>
                </tr>
                <tr>
                  <td>Nama Unit</td>
                  <td id='unit'></td>
                  <td>Nama Sub Unit</td>
                  <td id='subUnit'></td>
                </tr>
                <tr>
                  <td>Kode Inventori</td>
                  <td id='kodeInventori'></td>
                  <td>Nama Inventori</td>
                  <td id='namaInventori'></td>
                </tr>
                <tr>
                  <td>Jumlah Inventori</td>
                  <td id='jumlahInventori'></td>
                  <td>Harga Inventori</td>
                  <td id='hargaInventori'></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- end panel -->
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
      url:'<?php echo base_url('panel/scan/cariInventori');?>',
      type:'GET',
      data:{
        kode_inventori:kode_inventori
      },
      success:function(resp){
        if (resp!='false') {          
          var data = JSON.parse(resp)
          html5QrCode.stop().then((ignore) => {
            // QR Code scanning is stopped.
            $('#reader').attr('hidden',true);
          }).catch((err) => {
            // Stop failed, handle it.
          });
          
          $.each(data,function(key,val){
            var kode = val.kode_unit+'/'+val.kode_sub_unit+'/'+val.kode_inventori;
            $('#qrCode').html('<img src="<?php echo base_url();?>'+val.qrcode+'" class="img-responsive" style="width:220px;height:220px">')     
            $('#unit').text(val.nama_unit)     
            $('#subUnit').text(val.nama_sub_unit)     
            $('#kodeInventori').text(kode)     
            $('#namaInventori').text(val.nama_inventori)     
            $('#jumlahInventori').text(new Intl.NumberFormat(['bal','ID']).format(val.jumlah_inventori))     
            $('#hargaInventori').text('Rp ' + new Intl.NumberFormat(['bal','ID']).format(val.harga_barang))     
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