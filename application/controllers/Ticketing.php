<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketing extends CI_Controller {

	public function __construct()
  {
			parent::__construct();
  }

	public function index()
	{
		$this->lapor();
	}

  public function lapor($param1=''){
	  if ($param1=='doCreate') {
		$dataTicekting = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'id_unit' => $this->input->post('id_unit'),
			'id_sub_unit' => $this->input->post('id_sub_unit'),
			'detail_lokasi' => $this->input->post('detail_lokasi'),
			'keterangan_laporan' => $this->input->post('keterangan_laporan'),
		);

		//---------------- UPLOAD FOTO LAPORAN ---------------//
		$config['upload_path']          = 'assets/img/fotoLaporan/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 10000;

		$this->upload->initialize($config);

		if (! $this->upload->do_upload('foto_laporan')) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger">Mohon maaf kamu harus menyertakan foto untuk bukti laporan</div>');
			redirect('ticketing/lapor');
		} else {
				$dataTicekting += array('foto_laporan' => $config['upload_path'].$this->upload->data('file_name'));
		}

		$this->GeneralModel->create_general('e_ticketing',$dataTicekting);
		$this->session->set_flashdata('notif','<div class="alert alert-success">Data laporan berhasil di input, silahkan menungggu konfirmasi laporan, simpan id tiket untuk info lebih lanjut</div>');
		redirect('ticketing/cekLaporan?id_ticketing='.$this->db->insert_id());
	  }else{
		  $data['appsProfile'] = $this->SettingsModel->get_profile();
		  $data['unit'] = $this->GeneralModel->get_general('e_unit');
		  $this->load->view('lapor',$data);
	  }
  }

  public function cekLaporan(){
	$data['detailLaporan'] = $this->GeneralModel->get_by_id_general('v_ticketing','id_ticket',$this->input->get('id_ticketing'));
	$data['appsProfile'] = $this->SettingsModel->get_profile();
	$this->load->view('cekLaporan',$data);
  }

  public function getSubUnit(){
	  $getSubUnit = $this->GeneralModel->get_by_id_general('e_sub_unit','unit',$this->input->get('id_unit'));
	  if ($getSubUnit) {
		  echo json_encode($getSubUnit,JSON_PRETTY_PRINT);
	  }else{
		  echo 'false';
	  }
  }

}