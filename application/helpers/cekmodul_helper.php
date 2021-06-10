<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cekModul'))
{

  function cekModul($modul)
  {
    $CI =& get_instance();
    $hak_akses = $CI->session->userdata('hak_akses');
    $child_modul = $CI->AuthModel->getUserModul($hak_akses);
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
    $hak_akses = $CI->session->userdata('hak_akses');
    if ($hak_akses=='pegawai') {
      return $link;
    }else {
      return str_replace('panel/','administrator/',$link);
    }
  }

}
