<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public $title = 'Profile';

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
	}

	public function index(){
		$this->edit();
	}

	public function edit($param1=''){
		if ($param1=='doEdit') {
				$dataPengguna = array(
					'email' => $this->input->post('email'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'jenkel' => $this->input->post('jenkel'),
					'alamat' => $this->input->post('alamat'),
				);

				//---------------- UPDATE ICON ---------------//
				$config['upload_path']          = 'assets/img/pengguna/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 10000;


				$this->upload->initialize($config);

				if (! $this->upload->do_upload('foto_pengguna')) {
				} else {
						$dataPengguna += array('foto_pengguna' => $config['upload_path'].$this->upload->data('file_name'));
						$pengguna = $this->GeneralModel->get_by_id_general('e_pengguna', 'id_pengguna', $this->session->userdata('id_pengguna'));
						if (!empty($pengguna[0]->foto_pengguna)) {
							try {
								unlink($pengguna[0]->foto_pengguna);
							} catch (\Exception $e) {
							}
						}
				}

				if (!empty($this->input->post('password'))) {
					if ($this->input->post('password') == $this->input->post('re_password')) {
						$dataPengguna += array(
							'password' => sha1($this->input->post('password')),
						);
						$this->session->set_flashdata('notifpass','<div class="alert alert-success">Password berhasil diubah</div>');
					}else {
						$this->session->set_flashdata('notifpass','<div class="alert alert-danger">Password gagal diubah karena tidak sama dengan ulangi password</div>');
					}
				}

				if ($this->GeneralModel->update_general('e_pengguna','id_pengguna',$this->session->userdata('id_pengguna'),$dataPengguna)==true) {
							$this->session->set_userdata($dataPengguna);
							$this->session->set_flashdata('notif', '<div class="alert alert-success">Data pengguna berhasil diupdate</div>');
							redirect(changeLink('panel/profile/edit'));
				}else{
					$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data pengguna gagal diupdate</div>');
					redirect(changeLink('panel/profile/edit'));
				}
		}else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Edit Profile';
			$data['content'] = 'panel/profile/updatePengguna';
			$data['pengguna'] = $this->GeneralModel->get_by_id_general('e_pengguna','id_pengguna',$this->session->userdata('id_pengguna'));
			$this->load->view('panel/content',$data);
		}
	}

}
