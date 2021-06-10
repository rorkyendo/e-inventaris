<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
  {
			parent::__construct();
  }

	public function index()
	{
		$this->login();
	}

  public function login($param1='',$param2=''){
		if ($param1=='do_login') {
			$username = $this->input->post('username');
			$cekUser = $this->GeneralModel->get_by_id_general('e_pengguna','username',$username);
			if ($cekUser) {
				$password = sha1($this->input->post('password'));
				$getUser = $this->AuthModel->getAccountLogin($username,$password);
				if ($getUser) {
					foreach ($getUser as $key) {
						$dataAkun = array(
							'id_pengguna' => $key->id_pengguna,
							'nama_lengkap' => $key->nama_lengkap_pengguna,
							'username' => $key->username,
							'email_pengguna' => $key->email_pengguna,
							'foto_pengguna' => $key->foto_pengguna,
							'hak_akses' => $key->hak_akses,
							'LoggedIN' => TRUE
						);
					}
					$this->session->set_userdata($dataAkun);
					$updateLogin = array(
						'last_login' => date('Y-m-d H:i:s'),
					);
					$this->GeneralModel->update_general('e_pengguna','id_pengguna',$dataAkun['id_pengguna'],$updateLogin);
					$this->session->set_flashdata('notif','<div class="alert alert-success">Login Berhasil</div>');
					redirect('panel/dashboard');
				}else {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Username atau password pengguna salah</div>');
					redirect('/auth/login');
				}
			}else {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Akun tidak ditemukan</div>');
					redirect('/auth/login');
			}
		}else {
			$data['appsProfile'] = $this->SettingsModel->get_profile();
			$this->load->view('login',$data);
		}
  }

	public function logout()
	{
		$updateLogin = array(
			'last_logout' => date('Y-m-d H:i:s'),
		);
		$this->GeneralModel->update_general('e_pengguna','id_pengguna',$this->session->userdata('id_pengguna'),$updateLogin);
		$this->session->sess_destroy();
		redirect(base_url('auth/login'),'refresh');
	}

	public function access_denied(){
		$data['appsProfile'] = $this->SettingsModel->get_profile();
		$data['title'] = '401';
		$this->load->view('errors/panel/unauthorized_access',$data);
	}

	public function forgetPassword($param1=''){
		if ($param1=='doReset') {
			// code...
		}else {
			$data['appsProfile'] = $this->SettingsModel->get_profile();
			$data['title'] = '401';
			$this->load->view('errors/panel/unauthorized_access',$data);
		}
	}

}
