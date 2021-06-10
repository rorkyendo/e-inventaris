<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
  <!-- begin #header -->
  <div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid">
      <!-- begin mobile sidebar expand / collapse button -->
      <div class="navbar-header">
        <a href="<?php echo base_url(changeLink('panel/dashboard/'));?>" class="navbar-brand"><?php echo $apps_name.' '.$agency;?></a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- end mobile sidebar expand / collapse button -->

      <!-- begin header navigation right -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown navbar-user">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <?php if (!empty($this->session->userdata('foto_pengguna'))): ?>
                <img src="<?php echo base_url().$this->session->userdata('foto_pengguna');?>" alt="" />
              <?php else: ?>
                <img src="<?php echo base_url().$icon;?>" alt="" />
            <?php endif; ?>
            <span class="hidden-xs"><?php echo $this->session->userdata('nama_lengkap');?></span> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInLeft">
            <li class="arrow"></li>
            <li><a href="<?php echo base_url(changeLink('panel/profile/detail'));?>">Edit Profile</a></li>
            <li><a href="<?php echo base_url(changeLink('panel/resetPassword'));?>">Reset Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('auth/logout');?>">Log Out</a></li>
          </ul>
        </li>
      </ul>
      <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
  </div>
  <!-- end #header -->
