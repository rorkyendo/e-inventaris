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

    function sendNotifWA($number,$message){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wablast.medandigitalinnovation.com/api/send.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "nomor":"'.$number.'",
          "msg":"'.$message.'"
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Cookie: PHPSESSID=c69aea7b1ac8be4576a6bf68e29ab4d8'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
    }
}
