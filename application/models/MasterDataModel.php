<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterDataModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  public function getUnit()
  {
    $this->datatables->select('*,e_unit.id_unit as id_unit');
    $this->datatables->from('e_unit');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateUnit/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteUnit/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus event?')")),
      'id_unit'
    );
    return print_r($this->datatables->generate('json'));
  }
}
