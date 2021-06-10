<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
  <!-- begin sidebar scrollbar -->
  <div data-scrollbar="true" data-height="100%">
    <!-- begin sidebar user -->
    <ul class="nav">
      <li class="nav-profile">
        <div class="navbar-user">
          <a href="javascript:;">
            <?php if (!empty($this->session->userdata('foto_pengguna'))) : ?>
              <img src="<?php echo base_url() . $this->session->userdata('foto_pengguna'); ?>" alt="" />
            <?php else : ?>
              <img src="<?php echo base_url() . $icon; ?>" alt="" />
            <?php endif; ?>
          </a>
        </div>
        <div class="info">
          <?php echo $this->session->userdata('nama_lengkap'); ?>
          <?php if (!empty($this->session->userdata('nama_instansi'))) : ?>
            <small>Instansi - <?php echo $this->session->userdata('nama_instansi'); ?></small>
          <?php endif; ?>
        </div>
      </li>
    </ul>
    <!-- end sidebar user -->
    <!-- begin sidebar nav -->
    <ul class="nav">
      <li class="nav-header">Navigation</li>
      <?php $parentModul = $this->ParentModulModel->get_parent_modul();
      foreach ($parentModul as $key) : ?>
        <?php if (cekParentModul($key->class) == TRUE) : ?>
          <?php if ($key->tampil_sidebar_parent == 'Y') : ?>
            <?php if ($key->child_module == 'Y') : ?>
              <?php $childModul = $this->ModulModel->get_modul_sidebar($key->class); ?>
              <?php if (count($childModul) > 1) : ?>
                <!-- <li class="has-sub active"> -->
                <li class="has-sub <?php if ($key->nama_parent_modul == $title) {echo " active";} ?>" id="parentModul<?php echo $key->id_parent_modul; ?>">
                  <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="<?php echo $key->icon; ?>"></i>
                    <span><?php echo $key->nama_parent_modul; ?></span>
                  </a>
                  <ul class="sub-menu" id="childModul<?php echo $key->id_parent_modul; ?>">
                    <?php $i = 0;
                    foreach ($childModul as $row) { ?>
                      <?php if (cekModul($row->controller_modul) == true) : ?>
                        <?php $getChildModule = $this->ModulModel->get_child_modul_sidebar($row->controller_modul);?>
                          <?php if($getChildModule): ?>
                          <?php if (empty($menu)) {
                            $menu = '';
                          } ?>
                          <li class="has-sub <?php if ($row->nama_modul == $menu) {echo " active";} ?>">
                            <a href="javascript:;">
                              <b class="caret pull-right"></b>
                              <span><?php echo $row->nama_modul; ?></span>
                            </a>
                            <ul class="sub-menu">
                            <?php foreach($getChildModule as $CM):?>
                              <?php if (cekModul($CM->controller_modul) == true) : ?>
                                <li class="<?php if ($CM->nama_modul == $subtitle) {echo " active";} ?>"><a href="<?php echo base_url() . changeLink($CM->link_modul); ?>"><?php echo $CM->nama_modul; ?></a></li>                          
                              <?php endif;?>
                            <?php endforeach;?>
                            </ul>
                          </li>
                          <?php else: ?>
                          <li class="<?php if ($row->nama_modul == $subtitle) {echo " active";} ?>"><a href="<?php echo base_url() . changeLink($row->link_modul); ?>"><?php echo $row->nama_modul; ?></a></li>
                          <script type="text/javascript">
                            $(document).ready(function() {
                              try {
                                changeLink<?php echo $key->class; ?>('<?php echo base_url() . changeLink($row->link_modul); ?>', '<?php echo $row->nama_modul; ?>')
                              } catch (e) {}
                            })
                          </script>
                          <?php endif; ?>
                          <?php $i++; ?>
                      <?php endif; ?>
                    <?php } ?>
                  </ul>
                </li>
                <?php if ($i <= 1) : ?>
                  <script type="text/javascript">
                    $('#childModul<?php echo $key->id_parent_modul; ?>').remove();
                    $('#parentModul<?php echo $key->id_parent_modul; ?>').prop('has-sub', '');

                    function changeLink<?php echo $key->class; ?>(link_modul, nama_modul) {
                      $('#parentModul<?php echo $key->id_parent_modul; ?>').html('<a href="' + link_modul + '"><i class="<?php echo $key->icon; ?>"></i> <span><?php echo $key->nama_parent_modul; ?></span></a>');
                    }
                  </script>
                <?php endif; ?>
              <?php else : ?>
                <?php if($childModul): ?>
                  <li class="<?php if ($childModul[0]->nama_modul == $subtitle) {echo " active";} ?>"><a href="<?php echo base_url() . changeLink($childModul[0]->link_modul); ?>"><i class="<?php echo $key->icon; ?>"></i> <span><?php echo $key->nama_parent_modul; ?></span></a></li>
                <?php endif; ?>
              <?php endif; ?>
            <?php else : ?>
              <li class="<?php if ($key->nama_parent_modul == $title) {echo " active";} ?>"><a href="<?php echo base_url() . changeLink($key->link); ?>"><i class="<?php echo $key->icon; ?>"></i> <span><?php echo $key->nama_parent_modul; ?></span></a></li>
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; ?>
      <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
      <!-- begin sidebar minify button -->
      <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
      <!-- end sidebar minify button -->
    </ul>
    <!-- end sidebar nav -->
  </div>
  <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->