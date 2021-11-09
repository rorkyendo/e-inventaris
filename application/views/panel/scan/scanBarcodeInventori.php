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
            <h3>Scan Barcode disini</h3>
            <br>
              <div hidden id="reader" class="img-fluid" style="width:280px"></div>
              <br>
              <br>
              <button class="btn btn-xs btn-info" type="button" id="btn"><i class="fa fa-camera"></i> Scan</button>
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
                  <td id="barcode" colspan="4" align="center"></td>
                </tr>
                <tr>
                  <td>Nama Unit</td>
                  <td id='unit'></td>
                  <td>Nama Sub Unit</td>
                  <td id='subUnit'></td>
                </tr>
                <tr>
                  <td>Kode Satker</td>
                  <td id='kodeSatker'></td>
                  <td>Kode Inventori</td>
                  <td id='kodeInventori'></td>
                </tr>
                <tr>
                  <td>Nama Inventori</td>
                  <td id='namaInventori'></td>
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
    var _scannerIsRunning = false;
    var sound = new Audio("<?php echo base_url('assets/audio/');?>beep.mp3");

    function startScanner() {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#reader'),
                constraints: {
                    width: 480,
                    height: 240,
                    facingMode: "environment"
                },
            },
            decoder: {
                readers: [
                    "code_128_reader"
                ],
                debug: {
                    showCanvas: true,
                    showPatches: true,
                    showFoundPatches: true,
                    showSkeleton: true,
                    showLabels: true,
                    showPatchLabels: true,
                    showRemainingPatchLabels: true,
                    boxFromPatches: {
                        showTransformed: true,
                        showTransformedBox: true,
                        showBB: true
                    }
                }
            },

        }, function (err) {
            if (err) {
                console.log(err);
                return
            }

            console.log("Initialization finished. Ready to start");
            Quagga.start();

            // Set flag to is running
            _scannerIsRunning = true;
        });

        Quagga.onProcessed(function (result) {
            var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;

            if (result) {
                if (result.boxes) {
                    drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                    result.boxes.filter(function (box) {
                        return box !== result.box;
                    }).forEach(function (box) {
                        Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                    });
                }

                if (result.box) {
                    Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                }

                if (result.codeResult && result.codeResult.code) {
                    Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
                }
            }
            $('.drawingBuffer').attr('hidden',true);
        });

        Quagga.onDetected(function (result) {
            sound.play();	
            cariInventori(result.codeResult.code);
            Quagga.offDetected();
            Quagga.stop();
            startScanner();
        });

    }

    // Start/stop scanner
    $('#btn').on("click",function(){
        if (_scannerIsRunning) {
            Quagga.stop();
            _scannerIsRunning = false;
            $("#reader").attr('hidden',true);
        } else {
            $("#reader").removeAttr('hidden');
            startScanner();
        }
    })
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

          Quagga.stop();
          _scannerIsRunning = false;
          $('#reader').attr('hidden',true);
          
          $.each(data,function(key,val){
            $('#barcode').html('<img src="<?php echo base_url();?>'+val.barcode+'" class="img-responsive" style="width:220px;height:220px">')     
            $('#unit').text(val.nama_unit)     
            $('#subUnit').text(val.nama_sub_unit)     
            $('#kodeSatker').text(val.kode_satker)     
            $('#kodeInventori').text(val.kode_inventori)     
            $('#namaInventori').text(val.nama_inventori)     
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