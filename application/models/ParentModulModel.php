<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentModulModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

    function get_parent_modul()
  {
    $query = $this->db->query('SELECT * FROM e_parent_modul pm ORDER BY pm.urutan ASC');
    return $query->result();
  }

    function get_parent_modul_class($class)
  {
    $query = $this->db->query("SELECT * FROM e_parent_modul pm WHERE pm.class = '$class' ORDER BY pm.urutan ASC");
    return $query->row();
  }

}
