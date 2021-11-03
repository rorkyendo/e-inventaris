<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterDataModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  public function getUnit()
  {
    $this->datatables->select('*,v_unit.id_unit as id_unit');
    $this->datatables->from('v_unit');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateUnit/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteUnit/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus unit?')")),
      'id_unit'
    );
    return print_r($this->datatables->generate('json'));
  }

  public function getSumberDana()
  {
    $this->datatables->select('*,e_sumber_dana.id_sumber_dana as id_sumber_dana');
    $this->datatables->from('e_sumber_dana');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateSumberDana/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteSumberDana/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus sumber dana?')")),
      'id_sumber_dana'
    );
    return print_r($this->datatables->generate('json'));
  }

  public function getSubUnit($unit='')
  {
    $this->datatables->select('*,v_sub_unit.id_sub_unit as id_sub_unit');
    $this->datatables->from('v_sub_unit');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateSubUnit/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteSubUnit/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus sub unit?')")),
      'id_sub_unit'
    );
    if (!empty($unit)) {
      $this->datatables->where('unit',$unit);
    }
    return print_r($this->datatables->generate('json'));
  }

    public function getGolongan()
  {
    $this->datatables->select('*,e_golongan.id_gol as id_gol');
    $this->datatables->from('e_golongan');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateGolongan/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteGolongan/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus golongan?')")),
      'id_gol'
    );
    return print_r($this->datatables->generate('json'));
  }

    public function getBidang($kd_gol)
  {
    $this->datatables->select('*,v_bidang.id_bid as id_bid');
    $this->datatables->from('v_bidang');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateBidang/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteBidang/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus bidang?')")),
      'id_bid'
    );
    if (!empty($kd_gol)) {
      $this->datatables->where('gol',$kd_gol);
    }
    return print_r($this->datatables->generate('json'));
  }

    public function getKelompok($kd_gol,$kd_bid)
  {
    $this->datatables->select('*,e_kelompok.id_kel as id_kel');
    $this->datatables->from('e_kelompok');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateKelompok/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteKelompok/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus kelompok?')")),
      'id_kel'
    );
    if (!empty($kd_gol)) {
      $this->datatables->where('gol',$kd_gol);
    }
    if (!empty($kd_bid)) {
      $this->datatables->where('bid',$kd_bid);
    }
    return print_r($this->datatables->generate('json'));
  }

    public function getSubKelompok($kd_gol,$kd_bid,$kd_kel)
  {
    $this->datatables->select('*,e_sub_kelompok.id_skel as id_skel');
    $this->datatables->from('e_sub_kelompok');
    $this->datatables->add_column(
      'action',
       anchor(changeLink('panel/masterData/updateSubKelompok/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
      . anchor(changeLink('panel/masterData/deleteSubKelompok/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus sub kelompok?')")),
      'id_skel'
    );
    if (!empty($kd_gol)) {
      $this->datatables->where('gol',$kd_gol);
    }
    if (!empty($kd_bid)) {
      $this->datatables->where('bid',$kd_bid);
    }
    if (!empty($kd_kel)) {
      $this->datatables->where('kel',$kd_bid);
    }
    return print_r($this->datatables->generate('json'));
  }

}
