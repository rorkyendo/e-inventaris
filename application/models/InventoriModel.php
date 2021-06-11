<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoriModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  public function getDataInventori($id_kategori = '')
  {
    $this->datatables->select('*,v_inventori.id_inventori as id_inventori');
    $this->datatables->from('v_inventori');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/inventori/updateInventori/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/inventori/deleteInventori/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus inventori?')")),
      'id_inventori'
    );
    if (!empty($id_kategori)) {
      $this->datatables->where("kategori_inventori = '$id_kategori'");
    }
    return print_r($this->datatables->generate('json'));
  }

}
