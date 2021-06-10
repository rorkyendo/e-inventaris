<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggunaModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  public function getHakAkses(){
    return $this->db->query("SELECT ha.* FROM e_hak_akses ha")->result();
  }

  public function getPengguna($hak_akses)
  {
    $this->datatables->select('*,e_pengguna.id_pengguna as id_pengguna');
    $this->datatables->from('e_pengguna');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updatePengguna/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deletePengguna/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus pengguna?')")),
      'id_pengguna'
    );
    if (!empty($hak_akses)) {
      $this->datatables->where("hak_akses = '$hak_akses'");
    }
    return print_r($this->datatables->generate('json'));
  }

}
