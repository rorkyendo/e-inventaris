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
		$data['title'] = $this->title;
		$data['subtitle'] = 'Dashboard';
		$data['content'] = 'panel/dashboard/index';
		$data['jmlPengguna'] = $this->GeneralModel->count_general('e_pengguna');
		$data['jmlInventori'] = $this->GeneralModel->count_general('e_inventori');
		$data['jmlFakturMasukPending'] = $this->GeneralModel->count_general('e_faktur','kategori_faktur','in','status_approval','pending');
		$data['jmlFakturKeluarPending'] = $this->GeneralModel->count_general('e_faktur','kategori_faktur','out','status_approval','pending');
		$this->load->view('panel/content', $data);
	}

	public function laporanInventori(){
		return $this->InventoriModel->getLaporanInventori($kategori_faktur='',$status_keluar='',$status_pengembalian='',$status_approval='',$start_date='',$end_date='');
	}

}
