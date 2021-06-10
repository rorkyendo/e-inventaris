<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cekParentModulPengguna'))
{

  function cekParentModulPengguna($parentModul,$id)
  {
    $CI =& get_instance();
    $pengguna = $CI->GeneralModel->get_by_id_general('e_hak_akses','uuid_hak_akses',$id);
    foreach ($pengguna as $key) {
      $hak_akses = $key->nama_hak_akses;
    }
    $parent_modul = $CI->AuthModel->getUserParentModul($hak_akses);
    $data = json_decode($parent_modul->parent_modul_akses);
    for ($i=0; $i < count($data->parent_modul); $i++) {
      if ($data->parent_modul[$i] == $parentModul) {
        return true;
      }
    }
  }

}
