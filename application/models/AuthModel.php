<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  function getAccountLogin($username_pengguna,$password_pengguna){
    return $this->db->query("SELECT p.* FROM v_pengguna p WHERE
                             p.username_pengguna = '$username_pengguna' and p.password_pengguna = '$password_pengguna' and p.status_pengguna = 'Y'")->result();
  }

  function getUserParentModul($hak_akses_pengguna){
    return $this->db->query("SELECT ha.parent_modul_akses FROM e_hak_akses ha where ha.nama_hak_akses = '$hak_akses_pengguna'")->row();
  }

  function getUserModul($hak_akses_pengguna){
    return $this->db->query("SELECT ha.modul_akses FROM e_hak_akses ha where ha.nama_hak_akses = '$hak_akses_pengguna'")->row();
  }

  function cekToken($user_id,$token){
    return $this->db->query("SELECT * FROM e_pengguna p where p.uuid_pengguna = '$user_id' and p.login_token = '$token'")->row();
  }

}
