<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cekModulPengguna'))
{

  function cekModulPengguna($modul,$id)
  {
    $CI =& get_instance();
    $pengguna = $CI->GeneralModel->get_by_id_general('e_hak_akses','id_hak_akses',$id);
    foreach ($pengguna as $key) {
      $hak_akses = $key->nama_hak_akses;
    }
    $child_modul = $CI->AuthModel->getUserModul($hak_akses);
    $data = json_decode($child_modul->modul_akses);
    if (!empty($data->modul)) {
    for ($i=0; $i < count($data->modul); $i++) {
      if ($data->modul[$i] == $modul) {
        return true;
        }
      }
    }
  }

}
