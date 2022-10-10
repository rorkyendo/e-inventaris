<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('activityLog'))
{

  function activityLog($class='',$controller='')
  {
    // $CI =& get_instance();
    // if (!empty($controller)) {
    //   $dataAktivitas = array(
    //     'id_pengguna' => $CI->session->userdata('id_pengguna'),
    //     'class_parent_modul' => $class,
    //     'controller_modul' => $controller,
    //     'ip_address' => $CI->input->ip_address(),
    //     'user_agents' => $CI->agent->agent_string(),
    //   );
    // }else {
    //   $dataAktivitas = array(
    //     'id_pengguna' => $CI->session->userdata('id_pengguna'),
    //     'class_parent_modul' => $class,
    //     'ip_address' => $CI->input->ip_address(),
    //     'user_agents' => $CI->agent->agent_string(),
    //   );
    // }
    // $CI->GeneralModel->create_general('sim_aktivitas_pengguna',$dataAktivitas);
  }
  
}

function sendNotifWA($nomer,$pesan){
      $token = 'eAy1vLOYj3NY3vuCN5qALU8oUJcc7HjbLSpkAnc8Dzi8NcDk3yRV2v1iimNf'; //masukan token disii

      $nomer = str_replace(substr($nomer,0,1),'62',substr($nomer,0,1)).substr($nomer,1);
      $curl = curl_init();
      $pesan    = $pesan;
      $jadwal_kirim = date('Y-m-d H:i:s',strtotime('-2 days'));
      $forms    = 'no_wa='.$nomer."&pesan=".$pesan."&jadwal_kirim=".$jadwal_kirim;

      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $forms );
      curl_setopt($curl, CURLOPT_URL, "https://mediodev.site/public/api/kirim_wa");
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Bearer ".$token
        )
      );
      $result = curl_exec($curl);
      curl_close($curl);
      
      $res = json_decode($result);
      if($res->status == 'berhasil'){
        return true;
      }else{
        return false;
      }
}
