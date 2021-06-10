<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cekParentModul'))
{

  function cekParentModul($parentModul)
  {
    $CI =& get_instance();
    $hak_akses_pengguna = $CI->session->userdata('hak_akses_pengguna');
    $parent_modul = $CI->AuthModel->getUserParentModul($hak_akses_pengguna);
    $data = json_decode($parent_modul->parent_modul_akses);
    for ($i=0; $i < count($data->parent_modul); $i++) {
      if ($data->parent_modul[$i] == $parentModul) {
        return true;
      }
    }
  }

}
