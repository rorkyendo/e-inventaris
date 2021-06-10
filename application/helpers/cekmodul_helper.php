<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cekModul'))
{

  function cekModul($modul)
  {
    $CI =& get_instance();
    $hak_akses_pengguna = $CI->session->userdata('hak_akses_pengguna');
    $child_modul = $CI->AuthModel->getUserModul($hak_akses_pengguna);
    $data = json_decode($child_modul->modul_akses);
    for ($i=0; $i < count($data->modul); $i++) {
      if ($data->modul[$i] == $modul) {
        return true;
      }
    }
  }

  function changeLink($link)
  {
    $CI =& get_instance();
    $hak_akses_pengguna = $CI->session->userdata('hak_akses_pengguna');
    if ($hak_akses_pengguna=='pegawai') {
      return $link;
    }else {
      return str_replace('panel/','administrator/',$link);
    }
  }

}
