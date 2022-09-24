<?php foreach($faktur as $row):?>
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
          <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/inventori/updateInventoriKeluar/doUpdate/'.$row->id_faktur)); ?>" enctype="multipart/form-data">
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
                  <input type="text" class="form-control" placeholder="Masukkan Kode Faktur" name="kode_faktur" value="<?php echo $row->kode_faktur;?>" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Catatan Faktur</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php echo $row->catatan_faktur;?>" placeholder="Masukkan Nama Catatan Faktur (Misal : Inventori Masuk dari Supplier A)" name="catatan_faktur" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Peminjam</label>
                <div class="col-md-10">
                  <select name="peminjam" id="peminjam" class="form-control" onchange="pilihPeminjam(this.value)" required>
                    <option value="">.:Pilih Peminjam:.</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="pegawai">Pegawai</option>
                  </select>
                </div>
              </div>
              <script>
                $(document).ready(function(){
                  $('#peminjam').val('<?php echo $row->peminjam;?>')
                  pilihPeminjam('<?php echo $row->peminjam;?>')
                })
                function pilihPeminjam(val){
                  $('#mahasiswa').val('<?php echo $row->nim_mahasiswa;?>')
                  $('#pegawai').val('<?php echo $row->nip_pegawai;?>')
                  if(val=='mahasiswa'){
                    $('#formPegawai').attr('hidden',true)
                    $('#formMahasiswa').removeAttr('hidden')
                    $('#mahasiswa').val('')
                  }else if(val=='pegawai'){
                    $('#formMahasiswa').attr('hidden',true)
                    $('#formPegawai').removeAttr('hidden')
                    $('#pegawai').val('')
                  }else{
                    alert('Anda tidak memilih peminjam');
                    $('#formMahasiswa').attr('hidden',true)
                    $('#formPegawai').attr('hidden',true)
                    $('#mahasiswa').val('')
                    $('#pegawai').val('')
                  }
                }
              </script>
              <div class="form-group" hidden id="formMahasiswa">
                <label class="col-md-2 control-label">NIM Mahasiswa</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" id="mahasiswa" placeholder="Masukkan NIM Mahasiswa apabila peminjaman dilakukan oleh mahasiswa" name="nim_mahasiswa"/>
                </div>
              </div>
              <div class="form-group" hidden id="formPegawai">
              	<label class="col-md-2 control-label">NIP Pegawai</label>
              	<div class="col-md-10">
              		<input type="text" class="form-control" id="pegawai" placeholder="Masukkan NIP Pegawai apabila peminjaman dilakukan oleh pagawai" name="nip_pegawai" />
              	</div>
              </div>
              <div class="form-group">
              	<label class="col-md-2 control-label">Nama Peminjam</label>
              	<div class="col-md-10">
              		<input type="text" class="form-control" id="peminjam" placeholder="Masukkan Nama Peminjam" name="nama_peminjam" value="<?php echo $row->nama_peminjam;?>" />
              	</div>
              </div>
              <div class="form-group">
              	<label class="col-md-2 control-label">WA Peminjam</label>
              	<div class="col-md-10">
              		<input type="text" class="form-control" id="wa_peminjam" placeholder="Masukkan WA Peminjam" onkeypress="onlyNumberKey(event)" value="<?php echo $row->wa_peminjam;?>" name="wa_peminjam" />
              	</div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Durasi Peminjaman (Hari)</label>
                <div class="col-md-10">
                  <input type="number" class="form-control" value="<?php echo $row->durasi;?>" placeholder="Masukkan durasi peminjaman" name="durasi"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Status Keluar Faktur</label>
                <div class="col-md-10">
                  <select name="status_keluar" id="status_keluar" class="form-control" required>
                    <option value="">.:Pilih Status Keluar:.</option>
                    <option value="rusak">Rusak</option>
                    <option value="pinjam">Dipinjam</option>
                  </select>
                </div>
              </div>
              <script>
                $("#status_keluar").val('<?php echo $row->status_keluar;?>')
              </script>
              <hr />
              <div class="panel panel-inverse">
                <div class="panel-heading">
                  <h4 class="panel-title">List Inventori</h4>
                </div>
                <br />
                <label class="col-md-2 control-label">Pilih Inventori</label>
                <div class="col-md-10">
                	<select class="form-control select2" onchange="cariInventori(this.value)">
                		<option value="">.:Pilih Inventori:.</option>
                		<?php foreach($inventori as $key):?>
                		<option value="<?php echo $key->kode_inventori;?>"><?php echo $key->kode_inventori;?> | <?php echo $key->nama_inventori;?></option>
                		<?php endforeach;?>
                	</select>
                </div>
                <br />
                <br />
                <hr />
                <div class="panel-body" id="groupInvent">
                  <?php foreach($detailFaktur as $key):?>
                    <?php $kode_inventori = $key->kode_inventori;?>
                    <div class="col-md-12" id="inventori<?php echo $key->id_inventori;?>">
                      <div class="col-md-12">
                        <button class="btn btn-xs btn-danger" type="button" onclick="hapus('<?php echo $key->id_inventori;?>')"><i class="fa fa-times"></i> Hapus</button>
                      </div>
                      <div class="col-md-3">
                        <label for="">Nama Unit</label>
                        <input type="text" class="form-control" value="<?php echo $key->nama_unit;?>" readonly>
                      </div>
                      <div class="col-md-3">
                        <label for="">Nama Sub Unit</label>
                        <input type="text" class="form-control" value="<?php echo $key->nama_sub_unit;?>" readonly>
                      </div>
                      <div class="col-md-3">
                        <label for="">Kode inventori</label>
                        <input type="text" class="form-control" value="<?php echo $kode_inventori;?>" readonly>
                      </div>
                      <div class="col-md-3">
                        <label for="">Nama inventori</label>
                        <input type="text" class="form-control" value="<?php echo $key->nama_inventori;?> (<?php echo $key->singkatan_satuan;?>)" readonly>
                        <input type="hidden" name="id_inventori[]" class="form-control" value="<?php echo $key->id_inventori;?>" required>
                      </div>
                    </div>
                  <?php endforeach;?>
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-success  pull-right" style="margin-left:10px">Simpan</button>
                <a href="<?php echo base_url(changeLink('panel/inventori/inventoriKeluar/')); ?>" class="btn btn-sm btn-danger pull-right">Batal</a>
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
            if (val.status_inventori == 'Tersedia') {
            hapus(val.id_inventori);
            var kode = val.kode_inventori;
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
                '<label>Nama Unit</label>'+
                '<input type="text" value="'+val.nama_unit+'" class="form-control" readonly>'+
              '</div>'+
              '<div class="col-md-3">'+
                '<label>Nama Sub Unit</label>'+
                '<input type="text" value="'+val.nama_sub_unit+'" class="form-control" readonly>'+
              '</div>'+
              '<div class="col-md-3">'+
                '<label>Kode Inventori</label>'+
                '<input type="text" value="'+kode+'" class="form-control" readonly>'+
              '</div>'+
              '<div class="col-md-3">'+
                '<label>Nama Inventori</label>'+
                  '<input type="hidden" name="id_inventori[]" value="'+val.id_inventori+'">'+
                  '<input type="text" value="'+val.nama_inventori+'" class="form-control" readonly>'+
                '</div></div>');       
                Swal.fire({
                  type: 'success',
                  title: val.nama_inventori+' (kode:'+kode+')',
                  text: 'berhasil di tambahkan',
                })
            }else{
              Swal.fire({
                type: 'error',
                title: 'Oopps..',
                text: 'Inventori tidak tersedia untuk dikeluarkan',
              })              
            }
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
<?php endforeach;?>
