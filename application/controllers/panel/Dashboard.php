<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $parent_modul = 'Dashboard';
	public $title = 'Dashboard';

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('LoggedIN') == FALSE ) redirect('auth/logout');
	}

	public function index()
	{
		activityLog($this->parent_modul,'');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Dashboard';
		$data['content'] = 'panel/dashboard/index';
		$data['jmlPengguna'] = $this->GeneralModel->count_general('e_pengguna');
		$data['jmlSekolah'] = $this->GeneralModel->count_general('v_sekolah');
		$data['jmlSekolahNegeri'] = $this->GeneralModel->count_by_id_general('v_sekolah','status', 'Negeri');
		$data['jmlSekolahSwasta'] = $this->GeneralModel->count_by_id_general('v_sekolah','status', 'Swasta');
		$data['pengguna'] = $this->GeneralModel->get_by_id_general('e_pengguna','uuid_pengguna',$this->session->userdata('uuid_pengguna'));
		$data['kataMutiara'] = $this->GeneralModel->limit_general_order_by('e_kata_mutiara', 'RAND()', '' ,1);
		$data['ticketing'] = $this->GeneralModel->count_by_id_general('v_ticketing','status_ticketing','Open');
		$data['pengaduan'] = $this->GeneralModel->count_by_id_general('v_pengaduan', 'status_pengaduan', 'open');
		$data['pengaduanBelumBaca'] = $this->LayananModel->getJmlStatusPengaduan('open','N');
		$this->load->view('panel/content', $data);
	}

}
