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
