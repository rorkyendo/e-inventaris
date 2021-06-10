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
		$this->load->view('panel/content', $data);
	}

}
