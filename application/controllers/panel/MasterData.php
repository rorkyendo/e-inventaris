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
				'unit' => $this->input->post('unit'),	
				'no_wa' => $this->input->post('no_wa'),	
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
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
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
				'unit' => $this->input->post('unit'),	
				'no_wa' => $this->input->post('no_wa'),	
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
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
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
	//--------------- END OF PENGGUNA------------------//

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
	//--------------- END OF HAK AKSES------------------//
	//--------------- UNIT BEGIN------------------//
	public function daftarUnit($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			return $this->MasterDataModel->getUnit();		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Unit';
			$data['content'] = 'panel/masterData/unit/index';
			$this->load->view('panel/content', $data);
		}
	}

	public function tambahUnit($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeUnit = $this->GeneralModel->get_by_id_general('e_unit','kode_unit',$this->input->post('kode_unit'));
			if ($cekKodeUnit) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode unit sudah ada</div>');
				redirect('panel/masterData/tambahUnit');
			}else{
				$dataUnit = array(
					'kode_unit' => $this->input->post('kode_unit'),
					'nama_unit' => $this->input->post('nama_unit'),
					'alamat_unit' => $this->input->post('alamat_unit'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_unit',$dataUnit) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Unit berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarUnit');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, unit gagal ditambahkan</div>');
					redirect('panel/masterData/daftarUnit');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Unit';
			$data['content'] = 'panel/masterData/unit/create';
			$this->load->view('panel/content', $data);
		}
	}

	public function updateUnit($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeUnit = $this->GeneralModel->get_by_multi_id_general('e_unit','id_unit',$param2,'kode_unit',$this->input->post('kode_unit'));
			if ($cekKodeUnit) {
				$dataUnit = array(
					'kode_unit' => $this->input->post('kode_unit'),
					'nama_unit' => $this->input->post('nama_unit'),
					'alamat_unit' => $this->input->post('alamat_unit'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_unit','id_unit',$param2,$dataUnit) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Unit berhasil diupdate</div>');
					redirect('panel/masterData/daftarUnit');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, unit gagal diupdate</div>');
					redirect('panel/masterData/daftarUnit');
				}
			}else{
				$cekKodeUnit = $this->GeneralModel->get_by_id_general('e_unit','kode_unit',$this->input->post('kode_unit'));
				if ($cekKodeUnit) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode unit yang sama sudah ada</div>');
					redirect('panel/masterData/daftarUnit');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, unit gagal diupdate</div>');
					redirect('panel/masterData/daftarUnit');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Unit';
			$data['content'] = 'panel/masterData/unit/update';
			$data['unit'] = $this->GeneralModel->get_by_id_general('e_unit','id_unit',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteUnit($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_unit', 'id_unit', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Unit berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarUnit/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Unit gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarUnit/'));
		}
	}
	//--------------- END OF UNIT------------------//
	//--------------- SUB UNIT BEGIN------------------//
	public function getSubUnit(){
		$getUnit = $this->GeneralModel->get_by_id_general('e_sub_unit','unit',$this->input->get('unit'));
		if ($getUnit) {
			echo json_encode($getUnit,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}

	public function daftarSubUnit($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$unit = $this->input->post('unit');
			return $this->MasterDataModel->getSubUnit($unit);		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Sub Unit';
			$data['content'] = 'panel/masterData/subUnit/index';
			$data['id_unit'] = $this->input->get('unit');
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
			$this->load->view('panel/content', $data);
		}
	}

	public function tambahSubUnit($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeSubUnit = $this->GeneralModel->get_by_multi_id_general('e_sub_unit','unit',$this->input->post('unit'),'kode_sub_unit',$this->input->post('kode_sub_unit'));
			if ($cekKodeSubUnit) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode sub unit sudah ada</div>');
				redirect('panel/masterData/tambahUnit');
			}else{
				$dataSubUnit = array(
					'unit' => $this->input->post('unit'),
					'nama_sub_unit' => $this->input->post('nama_sub_unit'),
					'kode_sub_unit' => $this->input->post('kode_sub_unit'),
					'keterangan_sub_unit' => $this->input->post('keterangan_sub_unit'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_sub_unit',$dataSubUnit) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Sub Unit berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarSubUnit');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, sub unit gagal ditambahkan</div>');
					redirect('panel/masterData/daftarSubUnit');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Sub Unit';
			$data['content'] = 'panel/masterData/subUnit/create';
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateSubUnit($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeSubUnit = $this->GeneralModel->get_by_triple_id_general('e_sub_unit','id_sub_unit',$param2,'unit',$this->input->post('unit'),'kode_sub_unit',$this->input->post('kode_sub_unit'));
			if ($cekKodeSubUnit) {
				$dataSubUnit = array(
					'unit' => $this->input->post('unit'),
					'nama_sub_unit' => $this->input->post('nama_sub_unit'),
					'kode_sub_unit' => $this->input->post('kode_sub_unit'),
					'keterangan_sub_unit' => $this->input->post('keterangan_sub_unit'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_sub_unit','id_sub_unit',$param2,$dataSubUnit) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Sub Unit berhasil diupdate</div>');
					redirect('panel/masterData/daftarSubUnit');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, sub unit gagal diupdate</div>');
					redirect('panel/masterData/daftarSubUnit');
				}
			}else{
				$cekKodeUnit = $this->GeneralModel->get_by_multi_id_general('e_sub_unit','unit',$this->input->post('unit'),'kode_sub_unit',$this->input->post('kode_sub_unit'));
				if ($cekKodeUnit) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode sub unit yang sama sudah ada</div>');
					redirect('panel/masterData/daftarSubUnit');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, sub unit gagal diupdate</div>');
					redirect('panel/masterData/daftarSubUnit');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Sub Unit';
			$data['content'] = 'panel/masterData/subUnit/update';
			$data['subUnit'] = $this->GeneralModel->get_by_id_general('e_sub_unit','id_sub_unit',$param1);
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteSubUnit($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_sub_unit', 'id_sub_unit', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Sub Unit berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSubUnit/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Sub Unit gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSubUnit/'));
		}
	}
	//--------------- END OF SUB UNIT------------------//
	//--------------- SUMBER DANA BEGIN------------------//
	public function daftarSumberDana($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			return $this->MasterDataModel->getSumberDana();		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Sumber Dana';
			$data['content'] = 'panel/masterData/sumberDana/index';
			$this->load->view('panel/content', $data);
		}
	}

	public function tambahSumberDana($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeSumberDana = $this->GeneralModel->get_by_id_general('e_sumber_dana','kode_sumber_dana',$this->input->post('kode_sumber_dana'));
			if ($cekKodeSumberDana) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode sumber dana sudah ada</div>');
				redirect('panel/masterData/tambahSumberDana');
			}else{
				$dataSumberDana = array(
					'kode_sumber_dana' => $this->input->post('kode_sumber_dana'),
					'keterangan_sumber_dana' => $this->input->post('keterangan_sumber_dana'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_sumber_dana',$dataSumberDana) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Sumber dana berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarSumberDana');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, sumber dana gagal ditambahkan</div>');
					redirect('panel/masterData/daftarSumberDana');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Sumber Dana';
			$data['content'] = 'panel/masterData/sumberDana/create';
			$this->load->view('panel/content', $data);
		}
	}

	public function updateSumberDana($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeSumberDana = $this->GeneralModel->get_by_multi_id_general('e_sumber_dana','id_sumber_dana',$param2,'kode_sumber_dana',$this->input->post('kode_sumber_dana'));
			if ($cekKodeSumberDana) {
				$dataSumberDana = array(
					'kode_sumber_dana' => $this->input->post('kode_sumber_dana'),
					'keterangan_sumber_dana' => $this->input->post('keterangan_sumber_dana'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_sumber_dana','id_sumber_dana',$param2,$dataSumberDana) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Sumber dana berhasil diupdate</div>');
					redirect('panel/masterData/daftarSumberDana');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, sumber dana gagal diupdate</div>');
					redirect('panel/masterData/daftarSumberDana');
				}
			}else{
				$cekKodeSumberDana = $this->GeneralModel->get_by_id_general('e_sumber_dana','kode_sumber_dana',$this->input->post('kode_sumber_dana'));
				if ($cekKodeSumberDana) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode sumebr dana yang sama sudah ada</div>');
					redirect('panel/masterData/daftarSumberDana');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, sumber dana gagal diupdate</div>');
					redirect('panel/masterData/daftarSumberDana');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Sumber Dana';
			$data['content'] = 'panel/masterData/sumberDana/update';
			$data['sumberDana'] = $this->GeneralModel->get_by_id_general('e_sumber_dana','id_sumber_dana',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteSumberDana($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_sumber_dana', 'id_sumber_dana', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Sumber dana berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSumberDana/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Sumber dana gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSumberDana/'));
		}
	}
	//--------------- END OF SUMBER DANA------------------//
	//--------------- GOLONGAN BEGIN------------------//
	public function daftarGolongan($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			return $this->MasterDataModel->getGolongan();		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Golongan';
			$data['content'] = 'panel/masterData/golongan/index';
			$this->load->view('panel/content', $data);
		}
	}

	public function createGolongan($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeGolongan = $this->GeneralModel->get_by_id_general('e_golongan','kd_gol',$this->input->post('kd_gol'));
			if ($cekKodeGolongan) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode golongan sudah ada</div>');
				redirect('panel/masterData/createGolongan');
			}else{
				$dataGolongan = array(
					'kd_gol' => $this->input->post('kd_gol'),
					'ur_gol' => $this->input->post('ur_gol'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_golongan',$dataGolongan) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data Golongan berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarGolongan');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data golongan gagal ditambahkan</div>');
					redirect('panel/masterData/daftarGolongan');
				}
			}
		}elseif($param1=='doImport'){
			$config['upload_path']          = 'assets/excel/';
			$config['allowed_types'] = 'xlsx';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dataGolongan')) {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data golongan gagal diupload ' . $this->upload->display_errors() . '</div>');
				redirect('panel/masterData/daftarGolongan/');
			} else {
				$filename = $this->upload->data('file_name');
				$data = $config['upload_path'] . $filename;
				$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($data);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
				$spreadsheet = $reader->load($data);
				$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				$numrow = 1;
				$dataGolongan = array();
				foreach ($sheet as $row) {
					if ($numrow > 1) {
						array_push($dataGolongan,array(
							'kd_gol' => $row['A'],
							'ur_gol' => $row['B'],
							'created_by' => $this->session->userdata('id_pengguna'),
						));
					}
					$numrow++;
				}
				$this->db->insert_batch('e_golongan',$dataGolongan);
				try {
					unlink($data);
				} catch (\Exception $e) {
				}
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data golongan berhasil diupload</div>');
				redirect('panel/masterData/daftarGolongan/');
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Golongan';
			$data['content'] = 'panel/masterData/golongan/create';
			$this->load->view('panel/content', $data);
		}
	}

	public function updateGolongan($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeGolongan = $this->GeneralModel->get_by_multi_id_general('e_golongan','id_gol',$param2,'kd_gol',$this->input->post('kd_gol'));
			if ($cekKodeGolongan) {
				$dataGolongan = array(
					'kd_gol' => $this->input->post('kd_gol'),
					'ur_gol' => $this->input->post('ur_gol'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_golongan','id_gol',$param2,$dataGolongan) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data golongan berhasil diupdate</div>');
					redirect('panel/masterData/daftarGolongan');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data golongan gagal diupdate</div>');
					redirect('panel/masterData/daftarGolongan');
				}
			}else{
				$cekKodeGolongan = $this->GeneralModel->get_by_id_general('e_golongan','kd_golongan',$this->input->post('kd_golongan'));
				if ($cekKodeGolongan) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode golongan yang sama sudah ada</div>');
					redirect('panel/masterData/daftarGolongan');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, kode golongan gagal diupdate</div>');
					redirect('panel/masterData/daftarGolongan');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Golongan';
			$data['content'] = 'panel/masterData/golongan/update';
			$data['golongan'] = $this->GeneralModel->get_by_id_general('e_golongan','id_gol',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteGolongan($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_golongan', 'id_gol', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Golongan berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarGolongan/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Golongan gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarGolongan/'));
		}
	}
	//--------------- END OF GOLONGAN------------------//
	//--------------- BIDANG BEGIN------------------//
	public function daftarBidang($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$kodeGolongan = $this->input->post('kode_golongan');
			return $this->MasterDataModel->getBidang($kodeGolongan);		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Bidang';
			$data['content'] = 'panel/masterData/bidang/index';
			$data['kode_golongan'] = $this->input->get('kode_golongan');
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function createBidang($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeBidang = $this->GeneralModel->get_by_id_general('e_bidang','kd_bid',$this->input->post('kd_bid'));
			if ($cekKodeBidang) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode bidang sudah ada</div>');
				redirect('panel/masterData/createBidang');
			}else{
				$dataBidang = array(
					'kd_bid' => $this->input->post('kd_bid'),
					'ur_bid' => $this->input->post('ur_bid'),
					'gol' => $this->input->post('gol'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_bidang',$dataBidang) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data Bidang berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarBidang');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data bidang gagal ditambahkan</div>');
					redirect('panel/masterData/daftarBidang');
				}
			}
		}elseif($param1=='doImport'){
			$config['upload_path']          = 'assets/excel/';
			$config['allowed_types'] = 'xlsx';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dataBidang')) {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data bidang gagal diupload ' . $this->upload->display_errors() . '</div>');
				redirect('panel/masterData/daftarBidang/');
			} else {
				$filename = $this->upload->data('file_name');
				$data = $config['upload_path'] . $filename;
				$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($data);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
				$spreadsheet = $reader->load($data);
				$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				$numrow = 1;
				$dataBidang = array();
				foreach ($sheet as $row) {
					if ($numrow > 1) {
						array_push($dataBidang,array(
							'gol' => substr($row['A'],0,1),
							'kd_bid' => substr($row['A'],1,2),
							'ur_bid' => $row['B'],
							'created_by' => $this->session->userdata('id_pengguna'),
						));
					}
					$numrow++;
				}
				$this->db->insert_batch('e_bidang',$dataBidang);
				try {
					unlink($data);
				} catch (\Exception $e) {
				}
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data bidang berhasil diupload</div>');
				redirect('panel/masterData/daftarBidang/');
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Bidang';
			$data['content'] = 'panel/masterData/bidang/create';
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateBidang($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeBidang = $this->GeneralModel->get_by_multi_id_general('e_bidang','id_bid',$param2,'kd_bid',$this->input->post('kd_bid'));
			if ($cekKodeBidang) {
				$dataBidang = array(
					'kd_bid' => $this->input->post('kd_bid'),
					'ur_bid' => $this->input->post('ur_bid'),
					'gol' => $this->input->post('gol'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_bidang','id_bid',$param2,$dataBidang) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data bidang berhasil diupdate</div>');
					redirect('panel/masterData/daftarBidang');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data bidang gagal diupdate</div>');
					redirect('panel/masterData/daftarBidang');
				}
			}else{
				$cekKodeBidang = $this->GeneralModel->get_by_id_general('e_bidang','kd_bidang',$this->input->post('kd_bidang'));
				if ($cekKodeBidang) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode bidang yang sama sudah ada</div>');
					redirect('panel/masterData/daftarBidang');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, kode bidang gagal diupdate</div>');
					redirect('panel/masterData/daftarBidang');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Bidang';
			$data['content'] = 'panel/masterData/bidang/update';
			$data['bidang'] = $this->GeneralModel->get_by_id_general('e_bidang','id_bid',$param1);
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteBidang($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_bidang', 'id_bid', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Bidang berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarBidang/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Bidang gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarBidang/'));
		}
	}

	public function getBidang(){
		$gol = $this->input->get('gol');
		$getBidang = $this->GeneralModel->get_by_id_general('v_bidang','gol',$gol);
		if ($getBidang) {
			echo json_encode($getBidang,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}
	//--------------- END OF BIDANG------------------//
	//--------------- KELOMPOK BEGIN------------------//
	public function daftarKelompok($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$kodeGolongan = $this->input->post('kode_golongan');
			$kodeBidang = $this->input->post('kode_bidang');
			return $this->MasterDataModel->getKelompok($kodeGolongan,$kodeBidang);		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Kelompok';
			$data['content'] = 'panel/masterData/kelompok/index';
			$data['kode_golongan'] = $this->input->get('kode_golongan');
			$data['kode_bidang'] = $this->input->get('kode_bidang');
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$data['bidang'] = $this->GeneralModel->get_by_id_general('e_bidang','gol',$data['kode_golongan']);
			$this->load->view('panel/content', $data);
		}
	}

	public function createKelompok($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeKelompok = $this->GeneralModel->get_by_triple_id_general('e_kelompok','gol',$this->input->post('gol'),'bid',$this->input->post('bid'),'kd_kel',$this->input->post('kd_kel'));
			if ($cekKodeKelompok) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode kelompok sudah ada</div>');
				redirect('panel/masterData/createKelompok');
			}else{
				$dataKelompok = array(
					'kd_kel' => $this->input->post('kd_kel'),
					'ur_kel' => $this->input->post('ur_kel'),
					'bid' => $this->input->post('bid'),
					'gol' => $this->input->post('gol'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_kelompok',$dataKelompok) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data Kelompok berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data kelompok gagal ditambahkan</div>');
					redirect('panel/masterData/daftarKelompok');
				}
			}
		}elseif($param1=='doImport'){
			$config['upload_path']          = 'assets/excel/';
			$config['allowed_types'] = 'xlsx';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dataKelompok')) {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data kelompok gagal diupload ' . $this->upload->display_errors() . '</div>');
				redirect('panel/masterData/daftarKelompok/');
			} else {
				$filename = $this->upload->data('file_name');
				$data = $config['upload_path'] . $filename;
				$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($data);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
				$spreadsheet = $reader->load($data);
				$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				$numrow = 1;
				$dataKelompok = array();
				foreach ($sheet as $row) {
					if ($numrow > 1) {
						array_push($dataKelompok,array(
							'gol' => substr($row['A'],0,1),
							'bid' => substr($row['A'],1,2),
							'kd_kel' => substr($row['A'],3,2),
							'ur_kel' => $row['B'],
							'created_by' => $this->session->userdata('id_pengguna'),
						));
					}
					$numrow++;
				}
				$this->db->insert_batch('e_kelompok',$dataKelompok);
				try {
					unlink($data);
				} catch (\Exception $e) {
				}
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data kelompok berhasil diupload</div>');
				redirect('panel/masterData/daftarKelompok/');
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Kelompok';
			$data['content'] = 'panel/masterData/kelompok/create';
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateKelompok($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeKelompok = $this->GeneralModel->get_by_fourth_id_general('e_kelompok','id_kel',$param2,'gol',$this->input->post('gol'),'bid',$this->input->post('bid'),'kd_kel',$this->input->post('kd_kel'));
			if ($cekKodeKelompok) {
				$dataKelompok = array(
					'kd_kel' => $this->input->post('kd_kel'),
					'ur_kel' => $this->input->post('ur_kel'),
					'bid' => $this->input->post('bid'),
					'gol' => $this->input->post('gol'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_kelompok','id_kel',$param2,$dataKelompok) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data kelompok berhasil diupdate</div>');
					redirect('panel/masterData/daftarKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data kelompok gagal diupdate</div>');
					redirect('panel/masterData/daftarKelompok');
				}
			}else{
				$cekKodeKelompok = $this->GeneralModel->get_by_id_general('e_kelompok','kd_kel',$this->input->post('kd_kel'));
				if ($cekKodeKelompok) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode kelompok yang sama sudah ada</div>');
					redirect('panel/masterData/daftarKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, kode kelompok gagal diupdate</div>');
					redirect('panel/masterData/daftarKelompok');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Kelompok';
			$data['content'] = 'panel/masterData/kelompok/update';
			$data['kelompok'] = $this->GeneralModel->get_by_id_general('e_kelompok','id_kel',$param1);
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteKelompok($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_kelompok', 'id_kel', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Kelompok berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarKelompok/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Kelompok gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarKelompok/'));
		}
	}

	public function getKelompok(){
		$bid = $this->input->get('kd_bid');
		$gol = $this->input->get('kd_gol');
		$getKelompok = $this->GeneralModel->get_by_multi_id_general('e_kelompok','gol',$gol,'bid',$bid);
		if ($getKelompok) {
			echo json_encode($getKelompok,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}
	//--------------- END OF KELOMPOK------------------//
	//--------------- SUB KELOMPOK BEGIN------------------//
	public function daftarSubKelompok($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$kodeGolongan = $this->input->post('kode_golongan');
			$kodeBidang = $this->input->post('kode_bidang');
			$kodeKelompok = $this->input->post('kode_kelompok');
			return $this->MasterDataModel->getSubKelompok($kodeGolongan,$kodeBidang,$kodeKelompok);		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Sub Kelompok';
			$data['content'] = 'panel/masterData/subKelompok/index';
			$data['kode_golongan'] = $this->input->get('kode_golongan');
			$data['kode_bidang'] = $this->input->get('kode_bidang');
			$data['kode_kelompok'] = $this->input->get('kode_kelompok');
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$data['bidang'] = $this->GeneralModel->get_by_id_general('e_bidang','gol',$data['kode_golongan']);
			$data['kelompok'] = $this->GeneralModel->get_by_multi_id_general('e_kelompok','gol',$data['kode_golongan'],'bid',$data['kode_bidang']);
			$this->load->view('panel/content', $data);
		}
	}

	public function createSubKelompok($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeSubKelompok = $this->GeneralModel->get_by_fourth_id_general('e_sub_kelompok','kd_skel',$this->input->post('kd_skel'),'gol',$this->input->post('gol'),'bid',$this->input->post('bid'),'kd_kel',$this->input->post('kd_kel'));
			if ($cekKodeSubKelompok) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode kelompok sudah ada</div>');
				redirect('panel/masterData/createSubKelompok');
			}else{
				$dataSubKelompok = array(
					'kd_skel' => $this->input->post('kd_skel'),
					'ur_skel' => $this->input->post('ur_skel'),
					'bid' => $this->input->post('bid'),
					'gol' => $this->input->post('gol'),
					'kel' => $this->input->post('kel'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_sub_kelompok',$dataSubKelompok) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data Sub Kelompok berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarSubKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data Sub kelompok gagal ditambahkan</div>');
					redirect('panel/masterData/daftarSubKelompok');
				}
			}
		}elseif($param1=='doImport'){
			$config['upload_path']          = 'assets/excel/';
			$config['allowed_types'] = 'xlsx';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dataSubKelompok')) {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Sub kelompok gagal diupload ' . $this->upload->display_errors() . '</div>');
				redirect('panel/masterData/daftarSubKelompok/');
			} else {
				$filename = $this->upload->data('file_name');
				$data = $config['upload_path'] . $filename;
				$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($data);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
				$spreadsheet = $reader->load($data);
				$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				$numrow = 1;
				$dataSubKelompok = array();
				foreach ($sheet as $row) {
					if ($numrow > 1) {
						array_push($dataSubKelompok,array(
							'gol' => substr($row['A'],0,1),
							'bid' => substr($row['A'],1,2),
							'kel' => substr($row['A'],3,2),
							'kd_skel' => substr($row['A'],5,2),
							'ur_skel' => $row['B'],
							'created_by' => $this->session->userdata('id_pengguna'),
						));
					}
					$numrow++;
				}
				$this->db->insert_batch('e_sub_kelompok',$dataSubKelompok);
				try {
					unlink($data);
				} catch (\Exception $e) {
				}
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Sub kelompok berhasil diupload</div>');
				redirect('panel/masterData/daftarSubKelompok/');
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Sub Kelompok';
			$data['content'] = 'panel/masterData/subKelompok/create';
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateSubKelompok($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeSubKelompok = $this->GeneralModel->get_by_fifth_id_general('e_sub_kelompok','id_skel',$param2,'kd_skel',$this->input->post('kd_skel'),'gol',$this->input->post('gol'),'bid',$this->input->post('bid'),'kd_kel',$this->input->post('kd_kel'));
			if ($cekKodeSubKelompok) {
				$dataSubKelompok = array(
					'kd_skel' => $this->input->post('kd_skel'),
					'ur_skel' => $this->input->post('ur_skel'),
					'bid' => $this->input->post('bid'),
					'gol' => $this->input->post('gol'),
					'kel' => $this->input->post('kel'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_sub_kelompok','id_skel',$param2,$dataSubKelompok) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data Sub kelompok berhasil diupdate</div>');
					redirect('panel/masterData/daftarSubKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data Sub kelompok gagal diupdate</div>');
					redirect('panel/masterData/daftarSubKelompok');
				}
			}else{
				$cekKodeSubKelompok = $this->GeneralModel->get_by_id_general('e_kelompok','kd_kel',$this->input->post('kd_kel'));
				if ($cekKodeSubKelompok) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode sub kelompok yang sama sudah ada</div>');
					redirect('panel/masterData/daftarSubKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, kode sub kelompok gagal diupdate</div>');
					redirect('panel/masterData/daftarSubKelompok');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update SubKelompok';
			$data['content'] = 'panel/masterData/subKelompok/update';
			$data['sKelompok'] = $this->GeneralModel->get_by_id_general('e_sub_kelompok','id_skel',$param1);
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteSubKelompok($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_sub_kelompok', 'id_skel', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Sub Kelompok berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSubKelompok/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Sub Kelompok gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSubKelompok/'));
		}
	}

	public function getSubKelompok(){
		$bid = $this->input->get('kd_bid');
		$gol = $this->input->get('kd_gol');
		$kel = $this->input->get('kd_kel');
		$getSubKelompok = $this->GeneralModel->get_by_triple_id_general('e_sub_kelompok','gol',$gol,'bid',$bid,'kel',$kel);
		if ($getSubKelompok) {
			echo json_encode($getSubKelompok,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}
	//--------------- END OF SUB KELOMPOK------------------//
	//--------------- SUB SUB KELOMPOK BEGIN------------------//

	public function daftarSubSubKelompok($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$kodeGolongan = $this->input->post('kode_golongan');
			$kodeBidang = $this->input->post('kode_bidang');
			$kodeKelompok = $this->input->post('kode_kelompok');
			$kodeSubKelompok = $this->input->post('kode_sub_kelompok');
			return $this->MasterDataModel->getSubSubKelompok($kodeGolongan,$kodeBidang,$kodeKelompok,$kodeSubKelompok);		
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Sub-sub Kelompok';
			$data['content'] = 'panel/masterData/subsubKelompok/index';
			$data['kode_sub_kelompok'] = $this->input->get('kode_sub_kelompok');
			$data['kode_golongan'] = $this->input->get('kode_golongan');
			$data['kode_bidang'] = $this->input->get('kode_bidang');
			$data['kode_kelompok'] = $this->input->get('kode_kelompok');
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$data['bidang'] = $this->GeneralModel->get_by_id_general('e_bidang','gol',$data['kode_golongan']);
			$data['kelompok'] = $this->GeneralModel->get_by_multi_id_general('e_kelompok','gol',$data['kode_golongan'],'bid',$data['kode_bidang']);
			$data['sub_kelompok'] = $this->GeneralModel->get_by_triple_id_general('e_sub_kelompok','gol',$data['kode_golongan'],'bid',$data['kode_bidang'],'kel',$data['kode_sub_kelompok']);
			$this->load->view('panel/content', $data);
		}
	}

	public function createSubSubKelompok($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$cekKodeSubSubKelompok = $this->GeneralModel->get_by_fifth_id_general('e_sub_sub_kelompok','kd_sskel',$this->input->post('kd_sskel'),'kd_skel',$this->input->post('kd_skel'),'gol',$this->input->post('gol'),'bid',$this->input->post('bid'),'kd_kel',$this->input->post('kd_kel'));
			if ($cekKodeSubSubKelompok) {
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode kelompok sudah ada</div>');
				redirect('panel/masterData/createSubKelompok');
			}else{
				$dataSubSubKelompok = array(
					'kd_sskel' => $this->input->post('kd_sskel'),
					'ur_sskel' => $this->input->post('ur_sskel'),
					'skel' => $this->input->post('subkel'),
					'bid' => $this->input->post('bid'),
					'gol' => $this->input->post('gol'),
					'kel' => $this->input->post('kel'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				if ($this->GeneralModel->create_general('e_sub_sub_kelompok',$dataSubSubKelompok) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data Sub-sub Kelompok berhasil ditambahkan</div>');
					redirect('panel/masterData/daftarSubSubKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data Sub-sub kelompok gagal ditambahkan</div>');
					redirect('panel/masterData/daftarSubSubKelompok');
				}
			}
		}elseif($param1=='doImport'){
			$config['upload_path']          = 'assets/excel/';
			$config['allowed_types'] = 'xlsx';
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dataSubSubKelompok')) {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Sub-sub kelompok gagal diupload ' . $this->upload->display_errors() . '</div>');
				redirect('panel/masterData/daftarSubSubKelompok/');
			} else {
				$filename = $this->upload->data('file_name');
				$data = $config['upload_path'] . $filename;
				$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($data);
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
				$spreadsheet = $reader->load($data);
				$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				$numrow = 1;
				$dataSubSubKelompok = array();
				foreach ($sheet as $row) {
					if ($numrow > 1) {
						array_push($dataSubSubKelompok,array(
							'gol' => substr($row['A'],0,1),
							'bid' => substr($row['A'],1,2),
							'kel' => substr($row['A'],3,2),
							'skel' => substr($row['A'],5,2),
							'kd_sskel' => substr($row['A'],7,3),
							'ur_sskel' => $row['B'],
							'created_by' => $this->session->userdata('id_pengguna'),
						));
					}
					$numrow++;
				}
				$this->db->insert_batch('e_sub_sub_kelompok',$dataSubSubKelompok);
				try {
					unlink($data);
				} catch (\Exception $e) {
				}
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Sub-sub kelompok berhasil diupload</div>');
				redirect('panel/masterData/daftarSubSubKelompok/');
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Sub-sub Kelompok';
			$data['content'] = 'panel/masterData/subsubKelompok/create';
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateSubSubKelompok($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doUpdate') {
			$cekKodeSubSubKelompok = $this->GeneralModel->get_by_sixth_id_general('e_sub_sub_kelompok','id_ssub_kel',$param2,'kd_sskel',$this->input->post('kd_sskel'),'kd_skel',$this->input->post('kd_skel'),'gol',$this->input->post('gol'),'bid',$this->input->post('bid'),'kd_kel',$this->input->post('kd_kel'));
			
			if ($cekKodeSubSubKelompok) {
				$dataSubSubKelompok = array(
					'kd_sskel' => $this->input->post('kd_sskel'),
					'ur_sskel' => $this->input->post('ur_sskel'),
					'bid' => $this->input->post('bid'),
					'gol' => $this->input->post('gol'),
					'kel' => $this->input->post('kel'),
					'skel' => $this->input->post('skel'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);
				if ($this->GeneralModel->update_general('e_sub_sub_kelompok','id_ssub_kel',$param2,$dataSubSubKelompok) == TRUE) {
					$this->session->set_flashdata('notif','<div class="alert alert-success">Data Sub-sub kelompok berhasil diupdate</div>');
					redirect('panel/masterData/daftarSubSubKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, data Sub-sub kelompok gagal diupdate</div>');
					redirect('panel/masterData/daftarSubSubKelompok');
				}
			}else{
				$cekKodeSubSubKelompok = $this->GeneralModel->get_by_id_general('e_sub_sub_kelompok','kd_sskel',$this->input->post('kd_sskel'));
				if ($cekKodeSubSubKelompok) {
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Kode sub-sub kelompok yang sama sudah ada</div>');
					redirect('panel/masterData/daftarSubSubKelompok');
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-danger">Terjadi kesalahan, kode sub kelompok gagal diupdate</div>');
					redirect('panel/masterData/daftarSubSubKelompok');
				}
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Sub-sub Kelompok';
			$data['content'] = 'panel/masterData/subsubKelompok/update';
			$data['ssKelompok'] = $this->GeneralModel->get_by_id_general('e_sub_sub_kelompok','id_ssub_kel',$param1);
			$data['golongan'] = $this->GeneralModel->get_general('e_golongan');
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteSubSubKelompok($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_sub_sub_kelompok', 'id_ssub_kel', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data Sub-Sub Kelompok berhasil dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSubSubKelompok/'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data Sub-Sub Kelompok gagal dihapus</div>');
			redirect(changeLink('panel/masterData/daftarSubSubKelompok/'));
		}
	}

	public function getSubSubKelompok(){
		$bid = $this->input->get('kd_bid');
		$gol = $this->input->get('kd_gol');
		$kel = $this->input->get('kd_kel');
		$skel = $this->input->get('kd_skel');
		$getSubSubKelompok = $this->GeneralModel->get_by_fourth_id_general('e_sub_sub_kelompok','gol',$gol,'bid',$bid,'kel',$kel,'skel',$skel);
		if ($getSubSubKelompok) {
			echo json_encode($getSubSubKelompok,JSON_PRETTY_PRINT);
		}else{
			echo 'false';
		}
	}

}
