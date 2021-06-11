<?php

use function PHPSTORM_META\map;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'third_party/phpqrcode/qrlib.php';

class Inventori extends CI_Controller
{

	public $parent_modul = 'Inventori';
	public $title = 'Inventori';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
		$this->akses_controller = $this->uri->segment(3);
	}


	//------------------------ KATEGORI BEGIN ------------------------//
	public function kategori(){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Kategori Inventori';
			$data['content'] = 'panel/inventori/kategori/index';
			$data['getKategoriInventori'] = $this->GeneralModel->get_general('e_kategori_inventori');
			$this->load->view('panel/content', $data);
	}

	public function createKategori($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$dataKategori = array(
				'nama_kategori' => $this->input->post('nama_kategori'),
				'created_by' => $this->session->userdata('id_pengguna')
			);
			if ($this->GeneralModel->create_general('e_kategori_inventori', $dataKategori) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data kategori inventori berhasil ditambahkan</div>');
				redirect(changeLink('panel/inventori/kategori'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data kategori inventori gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/kategori'));
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Kategori Inventori';
			$data['content'] = 'panel/inventori/kategori/create';
			$this->load->view('panel/content', $data);
		}
	}

	public function updateKategori($param1 = '', $param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataKategori = array(
				'nama_kategori' => $this->input->post('nama_kategori'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'updated_time' => DATE('Y-m-d H:i:s')
			);
			if ($this->GeneralModel->update_general('e_kategori_inventori','id_kategori',$param2,$dataKategori) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data kategori inventori berhasil diupdate</div>');
				redirect(changeLink('panel/inventori/kategori'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data kategori inventori gagal diupdate</div>');
				redirect(changeLink('panel/inventori/kategori'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Kategori Inventori';
			$data['content'] = 'panel/inventori/kategori/update';
			$data['kategori'] = $this->GeneralModel->get_by_id_general('e_kategori_inventori','id_kategori',$param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteKategori($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_kategori_inventori', 'id_kategori', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data kategori inventori berhasil dihapus</div>');
			redirect(changeLink('panel/inventori/kategori'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data kategori inventori gagal dihapus</div>');
			redirect(changeLink('panel/inventori/kategori'));
		}
	}

	//------------------------ SATUAN BEGIN ------------------------//
	public function satuan()
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Daftar Satuan Inventori';
		$data['content'] = 'panel/inventori/satuan/index';
		$data['getSatuanInventori'] = $this->GeneralModel->get_general('e_satuan_inventori');
		$this->load->view('panel/content', $data);
	}

	public function createSatuan($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doCreate') {
			$dataSatuan = array(
				'nama_satuan' => $this->input->post('nama_satuan'),
				'singkatan_satuan' => $this->input->post('singkatan_satuan'),
				'created_by' => $this->session->userdata('id_pengguna')
			);
			if ($this->GeneralModel->create_general('e_satuan_inventori', $dataSatuan) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data satuan inventori berhasil ditambahkan</div>');
				redirect(changeLink('panel/inventori/satuan'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data satuan inventori gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/satuan'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Satuan Inventori';
			$data['content'] = 'panel/inventori/satuan/create';
			$this->load->view('panel/content', $data);
		}
	}

	public function updateSatuan($param1 = '', $param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataSatuan = array(
				'nama_satuan' => $this->input->post('nama_satuan'),
				'singkatan_satuan' => $this->input->post('singkatan_satuan'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'updated_time' => DATE('Y-m-d H:i:s')
			);
			if ($this->GeneralModel->update_general('e_satuan_inventori', 'id_satuan', $param2, $dataSatuan) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data satuan inventori berhasil diupdate</div>');
				redirect(changeLink('panel/inventori/satuan'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data satuan inventori gagal diupdate</div>');
				redirect(changeLink('panel/inventori/satuan'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Satuan Inventori';
			$data['content'] = 'panel/inventori/satuan/update';
			$data['satuan'] = $this->GeneralModel->get_by_id_general('e_satuan_inventori', 'id_satuan', $param1);
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteSatuan($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($this->GeneralModel->delete_general('e_satuan_inventori', 'id_satuan', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data satuan inventori berhasil dihapus</div>');
			redirect(changeLink('panel/inventori/satuan'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data satuan inventori gagal dihapus</div>');
			redirect(changeLink('panel/inventori/satuan'));
		}
	}

	//------------------------ INVENTORI BEGIN ------------------------//
	public function listInventori($param1='')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$id_kategori = $this->input->post('id_kategori');
			return $this->InventoriModel->getDataInventori($id_kategori);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Inventori';
			$data['content'] = 'panel/inventori/index';
			$data['getKategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
			$data['id_kategori'] = $this->input->get('id_kategori');
			$this->load->view('panel/content', $data);
		}
	}

	public function createInventori($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doCreate') {
			$dataInventori = array(
				'nama_inventori' => $this->input->post('nama_inventori'),
				'satuan_inventori' => $this->input->post('id_satuan'),
				'harga_jual' => $this->input->post('harga_jual'),
				'kategori_inventori' => $this->input->post('id_kategori'),
				'created_by' => $this->session->userdata('id_pengguna')
			);

			$tempdir = "assets/img/qrbarang/";
			if (!file_exists($tempdir))
				mkdir($tempdir);

			$identitasAplikasi = $this->GeneralModel->get_by_id_general('e_identitas','id_profile',1);

			$logopath = $identitasAplikasi[0]->logo;

			if ($this->GeneralModel->create_general('e_inventori', $dataInventori) == true) {
				$id_inventori = $this->db->insert_id();
				
				//isi qrcode jika di scan
				$codeContents = base_url('panel/inventori/detailInvetori/'). $id_inventori;
				//simpan file qrcode
				QRcode::png($codeContents, $tempdir . $dataInventori['nama_inventori'].'.png', QR_ECLEVEL_H, 10, 4);

				// ambil file qrcode
				$QR = imagecreatefrompng($tempdir .$dataInventori['nama_inventori'] . '.png');

				$dataInventori2 = array(
					'qrcode' => 'assets/img/qrbarang/'.$dataInventori['nama_inventori'].'.png'
				);

				$this->GeneralModel->update_general('e_inventori', 'id_inventori', $id_inventori, $dataInventori2);

				// memulai menggambar logo dalam file qrcode
				$logo = imagecreatefromstring(file_get_contents($logopath));

				imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
				imagealphablending($logo, false);
				imagesavealpha($logo, true);

				$QR_width = imagesx($QR);
				$QR_height = imagesy($QR);

				$logo_width = imagesx($logo);
				$logo_height = imagesy($logo);

				// Scale logo to fit in the QR Code
				$logo_qr_width = $QR_width / 8;
				$scale = $logo_width / $logo_qr_width;
				$logo_qr_height = $logo_height / $scale;

				imagecopyresampled($QR, $logo, $QR_width / 2.3, $QR_height / 2.3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

				// Simpan kode QR lagi, dengan logo di atasnya
				imagepng($QR, $tempdir . $dataInventori['nama_inventori'] . '.png');

				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori berhasil ditambahkan</div>');
				redirect(changeLink('panel/inventori/listInventori'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data inventori gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/listInventori'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Inventori';
			$data['content'] = 'panel/inventori/create';
			$data['kategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
			$data['satuan'] = $this->GeneralModel->get_general('e_satuan_inventori');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateInventori($param1 = '', $param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataInventori = array(
				'nama_inventori' => $this->input->post('nama_inventori'),
				'satuan_inventori' => $this->input->post('id_satuan'),
				'harga_jual' => $this->input->post('harga_jual'),
				'kategori_inventori' => $this->input->post('id_kategori'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'updated_time' => DATE('Y-m-d H:i:s')
			);
			if ($this->GeneralModel->update_general('e_inventori', 'id_inventori', $param2, $dataInventori) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori berhasil diupdate</div>');
				redirect(changeLink('panel/inventori/listInventori'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data inventori gagal diupdate</div>');
				redirect(changeLink('panel/inventori/listInventori'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Inventori';
			$data['content'] = 'panel/inventori/update';
			$data['inventori'] = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $param1);
			$data['satuan'] = $this->GeneralModel->get_general('e_satuan_inventori');
			$data['kategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteInventori($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$inventori = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $param1);
		if (!empty($inventori[0]->qrcode)) {
			try {
				unlink($inventori[0]->qrcode);
			} catch (\Exception $e) {
			}
		}
		if ($this->GeneralModel->delete_general('e_inventori', 'id_inventori', $param1) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori berhasil dihapus</div>');
			redirect(changeLink('panel/inventori/listInventori'));
		} else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data inventori gagal dihapus</div>');
			redirect(changeLink('panel/inventori/listInventori'));
		}
	}

	public function detailInventori($param1=''){
		$data['title'] = $this->title;
		$data['subtitle'] = 'Detail Inventori';
		$data['content'] = 'panel/inventori/detail';
		$data['inventori'] = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $param1);
		$data['satuan'] = $this->GeneralModel->get_general('e_satuan_inventori');
		$data['kategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
		$this->load->view('panel/content', $data);
	}
}
