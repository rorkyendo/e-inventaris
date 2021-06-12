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

  public function getFaktur($kategori_faktur = '', $status_approval = '', $start_date = '', $end_date = '')
  {
    $this->datatables->select('*,v_faktur.id_faktur as id_faktur');
    $this->datatables->from('v_faktur');
    if ($kategori_faktur == 'in') {
      $this->datatables->add_column(
        'action',
        anchor(changeLink('panel/inventori/updateLogistikMasuk/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
        . anchor(changeLink('panel/inventori/deleteLogistikMasuk/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus inventori?')")),
        'id_faktur'
      );
    }else{
      $this->datatables->add_column(
        'action',
          anchor(changeLink('panel/inventori/updateLogistikKeluar/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
          . anchor(changeLink('panel/inventori/deleteLogistikKeluar/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus inventori?')")),
        'id_faktur'
      );
    }
    if (!empty($kategori_faktur)) {
      $this->datatables->where("kategori_faktur = '$kategori_faktur'");
    }
    if (!empty($status_approval)) {
      $this->datatables->where("status_approval = '$status_approval'");
    }
    if (!empty($start_date) && !empty($end_date)) {
      $this->db->where("DATE_FORMAT(created_time,'%Y-%m-%d') >= '$start_date' && DATE_FORMAT(created_time,'%Y-%m-%d') <= '$end_date'");
    }
    return print_r($this->datatables->generate('json'));
  }

}
