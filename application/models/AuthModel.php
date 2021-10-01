<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  function getAccountLogin($username,$password){
    return $this->db->query("SELECT p.* FROM v_pengguna p WHERE
                             p.username = '$username' and p.password = '$password'")->result();
  }

  function getUserParentModul($hak_akses){
    return $this->db->query("SELECT ha.parent_modul_akses FROM e_hak_akses ha where ha.nama_hak_akses = '$hak_akses'")->row();
  }

  function getUserModul($hak_akses){
    return $this->db->query("SELECT ha.modul_akses FROM e_hak_akses ha where ha.nama_hak_akses = '$hak_akses'")->row();
  }
}
