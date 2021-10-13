<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tiket extends CI_Controller
{

	public $parent_modul = 'Tiket';
	public $title = 'Tiket';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
		$this->akses_controller = $this->uri->segment(3);
	}

	public function daftarTiket($param1='')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$status_laporan = $this->input->post('status_laporan');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			return $this->TiketModel->getDataTiket($status_laporan,$start_date,$end_date);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Tiket';
			$data['content'] = 'panel/tiket/index';
			if (!empty($this->input->get('start_date'))) {
				$data['start_date']  = $this->input->get('start_date');
			}else{
				$data['start_date'] = DATE('Y-m-01');
			}

			if (!empty($this->input->get('end_date'))) {
				$data['end_date']  = $this->input->get('end_date');
			}else{
				$data['end_date'] = DATE('Y-m-t');
			}
			$data['status_laporan'] = $this->input->get('status_laporan');
			$this->load->view('panel/content', $data);
		}
	}

	public function detailTiket($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Detail Tiket';
		$data['content'] = 'panel/tiket/detail';
		$data['tiket'] = $this->GeneralModel->get_by_id_general('v_ticketing','id_ticket',$param1);
		$this->load->view('panel/content', $data);
	}

	public function tanggapanTiket($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$dataTanggapan = array(
				'ditanggapi_oleh' => $this->session->userdata('id_pengguna'),
				'tanggapan_laporan' => $this->input->post('tanggapan_laporan'),
				'status_laporan' => 'Y',
				'ditanggapi_pada' => DATE('Y-m-d H:i:s')
			);

			if ($this->GeneralModel->update_general('e_ticketing','id_ticket',$param2,$dataTanggapan) == TRUE) {
				$this->session->set_flashdata('notif','<div class="alert alett-success">Tanggapan tiket berhasil dikirimkan</div>');
				redirect('panel/tiket/detailTiket/'.$param2);
			}else{
				$this->session->set_flashdata('notif','<div class="alert alett-danger">Tanggapan tiket gagal dikirimkan</div>');
				redirect('panel/tiket/detailTiket/'.$param2);
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tanggapan Tiket';
			$data['content'] = 'panel/tiket/tanggapan';
			$data['tiket'] = $this->GeneralModel->get_by_id_general('v_ticketing','id_ticket',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function hapusTiket($param1){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_ticketing', 'id_ticket', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data tiket berhasil dihapus</div>');
			redirect(changeLink('panel/tiket/daftarTiket'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data tiket gagal dihapus</div>');
			redirect(changeLink('panel/tiket/daftarTiket'));
		}
	}

}
