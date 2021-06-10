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
			$username_pengguna = $this->input->post('username_pengguna');
			$cekUser = $this->GeneralModel->get_by_id_general('v_pengguna','username_pengguna',$username_pengguna);
			if ($cekUser) {
				$salt = $cekUser[0]->salt_pengguna;
				$password_pengguna = sha1($this->input->post('password_pengguna').$salt);
				$getUser = $this->AuthModel->getAccountLogin($username_pengguna,$password_pengguna);
				if ($getUser) {
					foreach ($getUser as $key) {
						$dataAkun = array(
							'uuid_pengguna' => $key->uuid_pengguna,
							'nama_lengkap_pengguna' => $key->nama_lengkap_pengguna,
							'jenkel_pengguna' => $key->jenkel_pengguna,
							'username_pengguna' => $key->username_pengguna,
							'email_pengguna' => $key->email_pengguna,
							'foto_pengguna' => $key->foto_pengguna,
							'hak_akses_pengguna' => $key->hak_akses_pengguna,
							'id_pegawai' => $key->id_pegawai,
							'LoggedIN' => TRUE
						);
					}
					$this->session->set_userdata($dataAkun);
					$updateLogin = array(
						'last_login' => date('Y-m-d H:i:s'),
					);
					$this->GeneralModel->update_general('disdik_pengguna','uuid_pengguna',$dataAkun['uuid_pengguna'],$updateLogin);
					$this->session->set_flashdata('notif','<div class="alert alert-success">Login Berhasil</div>');
					if ($this->session->userdata('hak_akses_pengguna' != 'pegawai')) {
						redirect('administrator/dashboard');
					}else {
						redirect('panel/dashboard');
					}
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
			$data['bgLogin'] = $this->GeneralModel->get_by_id_general('disdik_bg_login','status','on');
			$this->load->view('login',$data);
		}
  }

	public function logout()
	{
		$updateLogin = array(
			'last_logout' => date('Y-m-d H:i:s'),
		);
		$this->GeneralModel->update_general('disdik_pengguna','uuid_pengguna',$this->session->userdata('uuid_pengguna'),$updateLogin);
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
