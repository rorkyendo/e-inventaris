<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModulModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

    function get_modul($class)
  {
    $query = $this->db->query("SELECT * FROM e_modul m WHERE m.class_parent_modul = '$class'");
    return $query->result();
  }

  function get_modul_sidebar($class){
    $query = $this->db->query("SELECT * FROM e_modul m WHERE m.class_parent_modul = '$class' and tampil_sidebar='Y' and child_module='N'");
    return $query->result();
  }

  function get_child_modul_sidebar($controllerModul)
  {
    $query = $this->db->query("SELECT * FROM e_modul m WHERE m.induk_child_modul = '$controllerModul' and tampil_sidebar='Y' and child_module='Y'");
    return $query->result();
  }

    function get_modul_by_controller($controller)
  {
    $query = $this->db->query("SELECT * FROM e_modul m WHERE m.controller_modul = '$controller'");
    return $query->row();
  }

    function get_modul_with_parent(){
      return $this->db->query("SELECT * FROM e_modul m, e_parent_modul pm WHERE m.class_parent_modul = pm.class")->result();
    }

    function get_modul_with_parent_by_controller($controller){
      return $this->db->query("SELECT * FROM e_modul m, e_parent_modul pm WHERE m.controller_modul = '$controller' and m.class_parent_modul = pm.class")->row();
    }

}
