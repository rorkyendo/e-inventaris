<?php

use function PHPSTORM_META\map;

defined('BASEPATH') or exit('No direct script access allowed');

class MasterData extends CI_Controller
{

	public $parent_modul = 'Master Data';
	public $title = 'Master Data';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
		$this->akses_controller = $this->uri->segment(3);
	}


	//--------------- PENGGUNA BEGIN------------------//
	public function pengguna($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if($param1=='cari'){
			$hak_akses_pengguna = $this->input->post('hak_akses_pengguna');
			return $this->PenggunaModel->getPengguna($hak_akses_pengguna);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Pengguna';
			$data['content'] = 'panel/masterData/pengguna/index';
			$data['getHakAkses'] = $this->GeneralModel->get_general('e_hak_akses');
			$data['hak_akses'] = $this->input->get('hak_akses');
			$this->load->view('panel/content', $data);
		}
	}

	public function cekUsernamePengguna()
	{
		$username = $this->input->get('username');
		if ($this->GeneralModel->get_by_id_general('e_pengguna', 'username', $username) == true) {
			echo "FALSE";
		} else {
			echo "TRUE";
		}
	}

	public function createPengguna($param1='')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$dataPengguna = array(
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'email' => $this->input->post('email'),
				'hak_akses' => $this->input->post('hak_akses'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'jenkel' => $this->input->post('jenkel'),
				'alamat' => $this->input->post('alamat'),	
			);

			//---------------- UPDATE FOTO PENGGUNA ---------------//
			$config['upload_path']          = 'assets/img/pengguna/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);

			if (!$this->upload->do_upload('foto_pengguna')) {
			} else {
				$dataPengguna += array('foto_pengguna' => $config['upload_path'] . $this->upload->data('file_name'));
			}
			if ($this->GeneralModel->get_by_id_general('e_pengguna','username',$dataPengguna['username']) == false) {
				if ($this->GeneralModel->create_general('e_pengguna', $dataPengguna) == true) {
					$this->session->set_flashdata('notif', '<div class="alert alert-success">Data pengguna berhasil ditambahkan</div>');
					redirect(changeLink('panel/masterData/pengguna'));
				} else {
					$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data pengguna gagal ditambahkan</div>');
					redirect(changeLink('panel/masterData/createPengguna'));
				}
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data pengguna gagal ditambahkan, username_pengguna telah digunakan</div>');
				redirect(changeLink('panel/settings/createPengguna'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Pengguna';
			$data['content'] = 'panel/masterData/pengguna/create';
			$data['hakAkses'] = $this->GeneralModel->get_general('e_hak_akses');
			$this->load->view('panel/content', $data);
		}
	}

	public function updatePengguna($param1 = '',$param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataPengguna = array(
				'email' => $this->input->post('email'),
				'hak_akses' => $this->input->post('hak_akses'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'jenkel' => $this->input->post('jenkel'),
				'alamat' => $this->input->post('alamat'),
			);
			//---------------- UPDATE FOTO PENGGUNA ---------------//
			$config['upload_path']          = 'assets/img/pengguna/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);

            $pengguna = $this->GeneralModel->get_by_id_general('e_pengguna', 'id_pengguna', $param2);
			if (!$this->upload->do_upload('foto_pengguna')) {
			} else {
				$dataPengguna += array('foto_pengguna' => $config['upload_path'] . $this->upload->data('file_name'));
				if (!empty($pengguna[0]->foto_pengguna)) {
					try {
						unlink($pengguna[0]->foto_pengguna);
					} catch (\Exception $e) {
					}
				}
			}
			if ($this->session->userdata('id_pengguna') == $param2) {
				$this->session->set_userdata($dataPengguna);
			}
			if (!empty($this->input->post('password'))) {
				if ($this->input->post('password') == $this->input->post('re_password')) {
					$dataPengguna += array(
						'password' => sha1($this->input->post('password')),
					);
					$this->session->set_flashdata('notifpass', '<div class="alert alert-success">Password berhasil diubah</div>');
				} else {
					$this->session->set_flashdata('notifpass', '<div class="alert alert-danger">Password gagal diubah karena tidak sama dengan ulangi password_pengguna</div>');
				}
			}

			if ($this->GeneralModel->update_general('e_pengguna', 'id_pengguna', $param2, $dataPengguna) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data pengguna berhasil diupdate</div>');
				redirect(changeLink('panel/masterData/pengguna'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data pengguna gagal diupdate</div>');
				redirect(changeLink('panel/masterData/updatePengguna' . $pengguna[0]->id_pengguna));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Pengguna';
			$data['content'] = 'panel/masterData/pengguna/update';
			$data['hakAkses'] = $this->GeneralModel->get_general('e_hak_akses');
			$data['pengguna'] = $this->GeneralModel->get_by_id_general('e_pengguna','id_pengguna',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deletePengguna($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$pengguna = $this->GeneralModel->get_by_id_general('e_pengguna', 'id_pengguna', $param1);
		if (!empty($pengguna[0]->foto_pengguna)) {
			try {
				unlink($pengguna[0]->foto_pengguna);
			} catch (\Exception $e) {
			}
		}
		if ($this->GeneralModel->delete_general('e_pengguna', 'id_pengguna', $pengguna[0]->id_pengguna) == true) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data pengguna berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/pengguna'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data pengguna gagal dihapus</div>');
			redirect(changeLink('panel/masterData/pengguna'));
		}
	}

	//--------------- HAK AKSES BEGIN------------------//
	public function hakAkses($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Hak Akses';
			$data['content'] = 'panel/masterData/hakAkses/index';
			$data['hak_akses'] = $this->AksesModulModel->getHakAkses();
			$this->load->view('panel/content', $data);
	}

	public function createHakAkses($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
			
		if ($param1 == 'doCreate') {
			$nama_hak_akses = $this->input->post('nama_hak_akses');
			$parent_modul = $this->input->post('class_parent_modul');
			$parent_modul = array_unique($parent_modul);
			$parent_modul = array_values(array_unique($parent_modul));

			$parent_modul = array(
				"parent_modul" => $parent_modul,
			);
			$parent_modul = json_encode($parent_modul, JSON_PRETTY_PRINT);

			$modul = $this->input->post('controller_modul');
			$modul = array(
				"modul" => $modul,
			);

			$modul = json_encode($modul, JSON_PRETTY_PRINT);

			$data = array(
				'nama_hak_akses' => $nama_hak_akses,
				'modul_akses' => $modul,
				'parent_modul_akses' => $parent_modul,
			);

			if ($this->GeneralModel->create_general('e_hak_akses', $data) == TRUE) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Hak Akses berhasil ditambahkan</div>');
				redirect(changeLink('panel/masterData/hakAkses/'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Hak Akses gagal ditambahkan</div>');
				redirect(changeLink('panel/masterData/hakAkses/'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Hak Akses';
			$data['content'] = 'panel/masterData/hakAkses/create';
			$data['parentModul'] = $this->GeneralModel->get_general_order_by('e_parent_modul', 'urutan', 'ASC');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateHakAkses($param1 = '', $param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$nama_hak_akses = $this->input->post('nama_hak_akses');
			$parent_modul = $this->input->post('class_parent_modul');
			$parent_modul = array_unique($parent_modul);
			$parent_modul = array_values(array_unique($parent_modul));

			$parent_modul = array(
				"parent_modul" => $parent_modul,
			);
			$parent_modul = json_encode($parent_modul, JSON_PRETTY_PRINT);

			$modul = $this->input->post('controller_modul');
			$modul = array(
				"modul" => $modul,
			);

			$modul = json_encode($modul, JSON_PRETTY_PRINT);

			$data = array(
				'nama_hak_akses' => $nama_hak_akses,
				'modul_akses' => $modul,
				'parent_modul_akses' => $parent_modul,
			);

			if ($this->GeneralModel->update_general('e_hak_akses', 'id_hak_akses', $param2, $data) == TRUE) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Hak Akses berhasil diupdate</div>');
				redirect(changeLink('panel/masterData/hakAkses/'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Hak Akses gagal diupdate</div>');
				redirect(changeLink('panel/masterData/hakAkses/'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Hak Akses';
			$data['content'] = 'panel/masterData/hakAkses/update';
			$data['id'] = $param1;
			$data['hak_akses'] = $this->GeneralModel->get_by_id_general('e_hak_akses', 'id_hak_akses', $param1);
			$data['parentModul'] = $this->GeneralModel->get_general_order_by('e_parent_modul', 'urutan', 'ASC');
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteAkses($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_hak_akses', 'id_hak_akses', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Hak Akses berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/hakAkses/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Hak Akses gagal dihapus</div>');
			redirect(changeLink('panel/masterData/hakAkses/'));
		}
	}
}
