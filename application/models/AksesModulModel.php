<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AksesModulModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  public function getHakAkses(){
    return $this->db->query("SELECT ha.* FROM disdik_hak_akses ha")->result();
  }

}
