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
                    <form class="form-horizontal" method="post" action="<?php echo base_url(changeLink('panel/pengaturan/identitasAplikasi/doUpdate/')); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nama Aplikasi</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Aplikasi" name="apps_name" value="<?php echo $identitas[0]->apps_name; ?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Versi Aplikasi</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan Versi Aplikasi Aplikasi" name="apps_version" value="<?php echo $identitas[0]->apps_version; ?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Kode Aplikasi</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Aplikasi" name="apps_code" value="<?php echo $identitas[0]->apps_code; ?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Agensi</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Agensi" name="agency" value="<?php echo $identitas[0]->agency; ?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Alamat</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan Alamat Agensi" name="address" value="<?php echo $identitas[0]->address; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Kota</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan Kota Agensi" name="city" value="<?php echo $identitas[0]->city; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">No.Telp</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan No.Telp Agensi" name="telephon" value="<?php echo $identitas[0]->telephon; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">FAX</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan FAX Agensi" name="fax" value="<?php echo $identitas[0]->fax; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Website</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Masukkan Website Agensi" name="website" value="<?php echo $identitas[0]->website; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Header</label>
                            <div class="col-md-10">
                                <textarea name="header" class="form-control" rows="8" cols="80"><?php echo $identitas[0]->header; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Footer</label>
                            <div class="col-md-10">
                                <textarea name="footer" class="form-control" rows="8" cols="80"><?php echo $identitas[0]->footer; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Keyword</label>
                            <div class="col-md-10">
                                <textarea name="keyword" class="form-control" rows="8" cols="80"><?php echo $identitas[0]->keyword; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">About Us</label>
                            <div class="col-md-10">
                                <textarea name="about_us" class="form-control" rows="8" cols="80"><?php echo $identitas[0]->about_us; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="text-center">Preview</h4>
                            <center>
                                <?php if (!empty($identitas[0]->logo)) : ?>
                                    <img src="<?php echo base_url() . $identitas[0]->logo; ?>" class="img-responsive" alt="preview" id="preview_logo" style="height:150px">
                                <?php else : ?>
                                    <img src="<?php echo base_url('assets/img/avatar.jpg'); ?>" class="img-responsive" alt="preview" id="preview_logo" style="height:150px">
                                <?php endif; ?>
                            </center>
                            <label class="col-md-2 control-label">Logo</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" accept="image/*" id="logo" name="logo">
                                <font color="red">[Ukuran tinggi 50px dengan besar maks 2MB]</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="text-center">Preview</h4>
                            <center>
                                <?php if (!empty($identitas[0]->icon)) : ?>
                                    <img src="<?php echo base_url() . $identitas[0]->icon; ?>" class="img-responsive" alt="preview" id="preview_icon" style="height:150px">
                                <?php else : ?>
                                    <img src="<?php echo base_url('assets/img/avatar.jpg'); ?>" class="img-responsive" alt="preview" id="preview_icon" style="height:150px">
                                <?php endif; ?>
                            </center>
                            <label class="col-md-2 control-label">Icon</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" accept="image/*" name="icon" id="icon">
                                <font color="red">[Ukuran 50x50px dengan besar maks 2MB]</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="text-center">Preview</h4>
                            <center>
                                <?php if (!empty($identitas[0]->sidebar_login)) : ?>
                                    <img src="<?php echo base_url() . $identitas[0]->sidebar_login; ?>" class="img-responsive" alt="preview" id="preview_sidebar" style="height:150px">
                                <?php else : ?>
                                    <img src="<?php echo base_url('assets/img/avatar.jpg'); ?>" class="img-responsive" alt="preview" id="preview_sidebar" style="height:150px">
                                <?php endif; ?>
                            </center>
                            <label class="col-md-2 control-label">Sidebar Login</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" accept="image/*" name="sidebar_login" id="sidebar_login">
                                <font color="red">[Ukuran 750x500px dengan besar maks 2MB]</font>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#preview_icon').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            $("#icon").change(function() {
                                readURL(this);
                            });

                            function readURL2(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#preview_logo').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            $("#logo").change(function() {
                                readURL2(this);
                            });

                            function readURL3(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#preview_sidebar').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            $("#sidebar_login").change(function() {
                                readURL3(this);
                            });
                        </script>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
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