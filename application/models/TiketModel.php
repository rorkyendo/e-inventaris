<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TiketModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  public function getDataTiket($status_laporan = '', $start_date = '', $end_date = '')
  {
    $this->datatables->select('*,v_ticketing.id_ticket as id_ticket');
    $this->datatables->from('v_ticketing');
    $this->datatables->add_column(
      'action',
        anchor(changeLink('panel/tiket/detailTiket/$1'), '<i class="fa fa-info"></i> Detail', array('class' => 'btn btn-info btn-xs')) . ' '
        . anchor(changeLink('panel/tiket/tanggapanTiket/$1'), '<i class="fa fa-edit"></i>', array('class' => 'btn btn-warning btn-xs')) . ' '
        . anchor(changeLink('panel/tiket/hapusTiket/$1'), '<i class="fa fa-times"></i>', array('class' => 'btn btn-danger btn-xs', "onclick" => "return confirm('Apakah kamu yakin akan menghapus tiket?')")),
      'id_ticket'
    );
    if (!empty($status_laporan)) {
      $this->datatables->where("status_laporan = '$status_laporan'");
    }
    if (!empty($start_date) && !empty($end_date)) {
      $this->db->where("DATE_FORMAT(dibuat_pada,'%Y-%m-%d') >= '$start_date' && DATE_FORMAT(dibuat_pada,'%Y-%m-%d') <= '$end_date'");
    }
    return print_r($this->datatables->generate('json'));
  }

}
