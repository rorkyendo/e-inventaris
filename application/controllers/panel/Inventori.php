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
	public function getSubUnit(){
		$getKodeUnit = $this->GeneralModel->get_by_id_general('e_unit','kode_unit',$this->input->get('kode_unit'));
		if ($getKodeUnit) {
			$getUnit = $this->GeneralModel->get_by_id_general('e_sub_unit','unit',$getKodeUnit[0]->id_unit);
			if ($getUnit) {
				echo json_encode($getUnit,JSON_PRETTY_PRINT);
			}else{
				echo 'false';
			}
		}else{
				echo 'false';
		}
	}

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
				'kode_unit' => $this->input->post('kode_unit'),
				'kode_sub_unit' => $this->input->post('kode_sub_unit'),
				'kode_sumber_dana' => $this->input->post('kode_sumber_dana'),
				'kode_inventori' => $this->input->post('kode_inventori'),
				'nama_inventori' => $this->input->post('nama_inventori'),
				'satuan_inventori' => $this->input->post('id_satuan'),
				'jumlah_inventori' => $this->input->post('jumlah_inventori'),
				'harga_barang' => $this->input->post('harga_barang'),
				'kategori_inventori' => $this->input->post('id_kategori'),
				'created_by' => $this->session->userdata('id_pengguna')
			);

			$tempdir = "assets/img/qrbarang/";
			if (!file_exists($tempdir))
				mkdir($tempdir);

			$logopath = 'assets/img/Fasilkom-TI.png';

			if ($this->GeneralModel->create_general('e_inventori', $dataInventori) == true) {
				$id_inventori = $this->db->insert_id();
				
				//isi qrcode jika di scan
				$codeContents = $dataInventori['kode_unit'].'/'.$dataInventori['kode_sub_unit'].'/'.$dataInventori['kode_inventori'];
				$dataQrFile = $dataInventori['kode_unit'].$dataInventori['kode_sub_unit'].$dataInventori['kode_inventori'].'.png';				
				//------------------ Pembuatan Barcode ----------------------------//
				$this->zend->load('Zend/Barcode.php'); 
				$barcode = $dataQrFile;
				$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$codeContents), array())->draw($codeContents,'image', array('text'=>$codeContents), array());
				$imageName = $barcode;
				$imagePath = 'assets/img/barcodebarang/';
				imagejpeg($imageResource, $imagePath.$imageName); 
				$pathBarcode = $imagePath.$imageName; 				
				$dataInventori2 = array(
					'barcode' => $pathBarcode
				);
				//------------------ Pembuatan QR Code ----------------------------//
				$dataQrFile = $dataInventori['kode_unit'].$dataInventori['kode_sub_unit'].$dataInventori['kode_inventori'].'.png';				
				//simpan file qrcode
				QRcode::png($codeContents, $tempdir . $dataQrFile, QR_ECLEVEL_H, 10, 4);

				// ambil file qrcode
				$QR = imagecreatefrompng($tempdir .$dataQrFile);

				$dataInventori2 += array(
					'qrcode' => 'assets/img/qrbarang/'.$dataQrFile
				);

				$this->GeneralModel->update_general('e_inventori', 'id_inventori', $id_inventori, $dataInventori2);

				// memulai menggambar logo dalam file qrcode
				$logo = imagecreatefrompng($logopath);

				imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
				imagealphablending($logo, false);
				imagesavealpha($logo, true);

				$QR_width = imagesx($QR);
				$QR_height = imagesy($QR);

				$logo_width = imagesx($logo);
				$logo_height = imagesy($logo);

				// Scale logo to fit in the QR Code
				$logo_qr_width = $QR_width / 5;
				$scale = $logo_width / $logo_qr_width;
				$logo_qr_height = $logo_height / $scale;

				imagecopyresampled($QR, $logo, $QR_width / 2.5, $QR_height / 2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

				// Simpan kode QR lagi, dengan logo di atasnya
				imagepng($QR, $tempdir . $dataQrFile);
				//------------------ End Of Pembuatan QR Code ----------------------------//

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
			$data['sumberDana'] = $this->GeneralModel->get_general('e_sumber_dana');
			$data['satuan'] = $this->GeneralModel->get_general('e_satuan_inventori');
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateInventori($param1 = '', $param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataInventori = array(
				'kode_unit' => $this->input->post('kode_unit'),
				'kode_sub_unit' => $this->input->post('kode_sub_unit'),
				'kode_sumber_dana' => $this->input->post('kode_sumber_dana'),
				'kode_inventori' => $this->input->post('kode_inventori'),
				'nama_inventori' => $this->input->post('nama_inventori'),
				'satuan_inventori' => $this->input->post('id_satuan'),
				'jumlah_inventori' => $this->input->post('jumlah_inventori'),
				'harga_barang' => $this->input->post('harga_barang'),
				'kategori_inventori' => $this->input->post('id_kategori'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'updated_time' => DATE('Y-m-d H:i:s')
			);

			$getQr = $this->GeneralModel->get_by_id_general('e_inventori','id_inventori',$param2);
			if (!empty($getQr[0]->qrcode)) {
				try {
					unlink($getQr[0]->qrcode);
				} catch (\Throwable $th) {
				}
			}

			if ($this->GeneralModel->update_general('e_inventori', 'id_inventori', $param2, $dataInventori) == true) {
				//isi qrcode jika di scan
				$codeContents = $dataInventori['kode_unit'].'/'.$dataInventori['kode_sub_unit'].'/'.$dataInventori['kode_inventori'];
				$dataQrFile = $dataInventori['kode_unit'].$dataInventori['kode_sub_unit'].$dataInventori['kode_inventori'].'.png';				

				//------------------ Pembuatan Barcode ----------------------------//
				$this->zend->load('Zend/Barcode.php'); 
				$barcode = $dataQrFile;
				$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$codeContents), array())->draw($codeContents,'image', array('text'=>$codeContents), array());
				$imageName = $barcode;
				$imagePath = 'assets/img/barcodebarang/';
				imagejpeg($imageResource, $imagePath.$imageName); 
				$pathBarcode = $imagePath.$imageName; 				
				$dataInventori2 = array(
					'barcode' => $pathBarcode
				);
				//------------------ Pembuatan QR Code ----------------------------//
				$tempdir = "assets/img/qrbarang/";
				if (!file_exists($tempdir))
					mkdir($tempdir);

				$logopath = 'assets/img/Fasilkom-TI.png';

				//simpan file qrcode
				QRcode::png($codeContents, $tempdir . $dataQrFile, QR_ECLEVEL_H, 10, 4);

				// ambil file qrcode
				$QR = imagecreatefrompng($tempdir .$dataQrFile);

				$dataInventori2 += array(
					'qrcode' => 'assets/img/qrbarang/'.$dataQrFile
				);

				$this->GeneralModel->update_general('e_inventori', 'id_inventori', $param2, $dataInventori2);

				// memulai menggambar logo dalam file qrcode
				$logo = imagecreatefrompng($logopath);

				imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
				imagealphablending($logo, false);
				imagesavealpha($logo, true);

				$QR_width = imagesx($QR);
				$QR_height = imagesy($QR);

				$logo_width = imagesx($logo);
				$logo_height = imagesy($logo);

				// Scale logo to fit in the QR Code
				$logo_qr_width = $QR_width / 5;
				$scale = $logo_width / $logo_qr_width;
				$logo_qr_height = $logo_height / $scale;

				imagecopyresampled($QR, $logo, $QR_width / 2.5, $QR_height / 2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

				// Simpan kode QR lagi, dengan logo di atasnya
				imagepng($QR, $tempdir . $dataQrFile);
				//------------------ End Of Pembuatan QR Code ----------------------------//

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
			$data['sumberDana'] = $this->GeneralModel->get_general('e_sumber_dana');
			$data['satuan'] = $this->GeneralModel->get_general('e_satuan_inventori');
			$data['kategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
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
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Detail Inventori';
		$data['content'] = 'panel/inventori/detail';
		$data['inventori'] = $this->GeneralModel->get_by_id_general('v_inventori', 'id_inventori', $param1);
		$this->load->view('panel/content', $data);
	}

	//------------------------ LOGISTIK MASUK BEGIN ------------------------//
	public function inventoriMasuk($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'cari') {
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$status_approval = $this->input->post('status_approval');
			return $this->InventoriModel->getFaktur('in',$status_approval,$start_date,$end_date);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Inventori Masuk';
			$data['content'] = 'panel/inventori/inventoriMasuk/index';
			$data['start_date'] = $this->input->get('start_date');
			$data['end_date'] = $this->input->get('end_date');
			$data['status_approval'] = $this->input->get('status_approval');
			$this->load->view('panel/content', $data);
		}
	}

	public function createInventoriMasuk($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='doCreate') {
			$dataFaktur = array(
				'kode_faktur' => $this->input->post('kode_faktur'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
				'created_by' => $this->session->userdata('id_pengguna'),
			);
			$tempdir = "assets/img/qrfaktur/";
			if (!file_exists($tempdir))
				mkdir($tempdir);

			$logopath = 'assets/img/Fasilkom-TI.png';
			if ($this->GeneralModel->create_general('e_faktur',$dataFaktur) == TRUE) {
				$id_faktur = $this->db->insert_id();
				//------------------ Pembuatan Barcode ----------------------------//
				$this->zend->load('Zend/Barcode.php'); 
				$barcode = $id_faktur.'.png';
				$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$barcode), array())->draw($barcode,'image', array('text'=>$barcode), array());
				$imageName = $barcode;
				$imagePath = 'assets/img/barcodefaktur/';
				imagejpeg($imageResource, $imagePath.$imageName); 
				$pathBarcode = $imagePath.$imageName; 				
				$dataFaktur2 = array(
					'barcode_faktur' => $pathBarcode
				);
				$namaQrcode = 'Faktur-'.$id_faktur.'.png';
				//isi qrcode jika di scan
				$codeContents = $id_faktur;
				//simpan file qrcode
				QRcode::png($codeContents, $tempdir . $namaQrcode, QR_ECLEVEL_H, 10, 4);

				// ambil file qrcode
				$QR = imagecreatefrompng($tempdir . $namaQrcode);

				$dataFaktur2 += array(
					'qrcode_faktur' => 'assets/img/qrfaktur/' . $namaQrcode
				);

				$this->GeneralModel->update_general('e_faktur', 'id_faktur', $id_faktur, $dataFaktur2);

				// memulai menggambar logo dalam file qrcode
				$logo = imagecreatefrompng($logopath);

				imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
				imagealphablending($logo, false);
				imagesavealpha($logo, true);

				$QR_width = imagesx($QR);
				$QR_height = imagesy($QR);

				$logo_width = imagesx($logo);
				$logo_height = imagesy($logo);

				// Scale logo to fit in the QR Code
				$logo_qr_width = $QR_width / 5;
				$scale = $logo_width / $logo_qr_width;
				$logo_qr_height = $logo_height / $scale;

				imagecopyresampled($QR, $logo, $QR_width / 2.5, $QR_height / 2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

				// Simpan kode QR lagi, dengan logo di atasnya
				imagepng($QR, $tempdir . $namaQrcode);

				$id_inventori[] = $this->input->post('id_inventori');
				$jumlah[] = $this->input->post('jumlah');
				$harga_barang[] = $this->input->post('harga_barang');

				for ($i = 0; $i < count($id_inventori[0]); $i++) {
					$dataInventori = array(
						'id_faktur' => $id_faktur,
						'id_inventori' => $id_inventori[0][$i],
						'jumlah_inventori' => $jumlah[0][$i],
						'harga_barang' => $harga_barang[0][$i],
					);
					$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
				}

				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori masuk berhasil ditambahkan</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data inventori masuk gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));	
			}
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Inventori Masuk';
			$data['content'] = 'panel/inventori/inventoriMasuk/create';
			$data['inventori'] = $this->GeneralModel->get_general('v_inventori');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateInventoriMasuk($param1 = '',$param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataFaktur = array(
				'kode_faktur' => $this->input->post('kode_faktur'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'updated_time' => DATE('Y-m-d H:i:s'),
			);

			if ($this->GeneralModel->update_general('e_faktur','id_faktur',$param2,$dataFaktur) == TRUE) {
				$id_inventori[] = $this->input->post('id_inventori');
				$jumlah[] = $this->input->post('jumlah');
				$harga_barang[] = $this->input->post('harga_barang');

				$this->GeneralModel->delete_general('e_detail_faktur','id_faktur',$param2);

				for ($i = 0; $i < count($id_inventori[0]); $i++) {
					$dataInventori = array(
						'id_faktur' => $param2,
						'id_inventori' => $id_inventori[0][$i],
						'jumlah_inventori' => $jumlah[0][$i],
						'harga_barang' => $harga_barang[0][$i],
					);
					$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
				}

				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori masuk berhasil diupdate</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data inventori masuk gagal diupdate</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Inventori Masuk';
			$data['content'] = 'panel/inventori/inventoriMasuk/update';
			$data['inventori'] = $this->GeneralModel->get_general('v_inventori');
			$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur','id_faktur',$param1);
			$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori', 'id_faktur', $param1);
			if ($data['faktur'][0]->status_approval != 'pending') {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf data faktur yang sudah dikonfirmasi tidak bisa kamu ubah!</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			}
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteInventoriMasuk($param1=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$faktur = $this->GeneralModel->get_by_id_general('e_faktur', 'id_faktur', $param1);
		if ($faktur[0]->status_approval == 'pending') {
			if (!empty($faktur[0]->qrcode_faktur)) {
				try {
					unlink($faktur[0]->qrcode_faktur);
				} catch (\Exception $e) {
				}
			}
			if ($this->GeneralModel->delete_general('e_faktur', 'id_faktur', $param1) == TRUE) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data faktur berhasil dihapus</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data faktur gagal dihapus</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			}
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur yang sudah dikonfirmasi tidak dapat dihapus atau diubah</div>');
			redirect(changeLink('panel/inventori/inventoriMasuk'));
		}
	}
		
	public function detailInventoriMasuk($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Detail Inventori Masuk';
		$data['content'] = 'panel/inventori/inventoriMasuk/detail';
		$data['inventori'] = $this->GeneralModel->get_general('v_inventori');
		$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur', 'id_faktur', $param1);
		$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori', 'id_faktur', $param1);
		if ($data['faktur'][0]->kategori_faktur != 'in') {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur tidak tersedia</div>');
			redirect(changeLink('panel/inventori/inventoriMasuk'));
		}
		$this->load->view('panel/content', $data);
	}

	public function approveInventoriMasuk($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$detailFaktur = $this->GeneralModel->get_by_id_general('e_detail_faktur', 'id_faktur', $param1);
		$faktur = $this->GeneralModel->get_by_id_general('e_faktur','id_faktur',$param1);
		if ($faktur[0]->status_approval == 'pending') {
			$dataFaktur = array(
					'status_approval' => 'accept',
					'approval_by' => $this->session->userdata('id_pengguna'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'approval_time' => DATE('Y-m-d H:i:s'),
					'updated_time' => DATE('Y-m-d H:i:s'),
			);
			 if ($this->GeneralModel->update_general('e_faktur','id_faktur', $param1, $dataFaktur) == TRUE) {
				foreach ($detailFaktur as $key) {
					$oldStock = $this->GeneralModel->get_by_id_general('e_inventori','id_inventori',$key->id_inventori);
					$dataInventori = array(
						'jumlah_inventori' => $oldStock[0]->jumlah_inventori+$key->jumlah_inventori,
						'harga_barang' => $key->harga_barang,
					);
					$this->GeneralModel->update_general('e_inventori', 'id_inventori', $key->id_inventori, $dataInventori);
				}
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data faktur berhasil diapprove</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data faktur gagal diapprove</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			}
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur yang sudah dikonfirmasi tidak dapat dihapus atau diubah</div>');
			redirect(changeLink('panel/inventori/inventoriMasuk'));			
		}
	}

	public function rejectInventoriMasuk($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$faktur = $this->GeneralModel->get_by_id_general('e_faktur','id_faktur',$param1);
		if ($faktur[0]->status_approval == 'pending') {
			$dataFaktur = array(
				'status_approval' => 'reject',
				'approval_by' => $this->session->userdata('id_pengguna'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'approval_time' => DATE('Y-m-d H:i:s'),
				'updated_time' => DATE('Y-m-d H:i:s'),
			);
			if ($this->GeneralModel->update_general('e_faktur', 'id_faktur', $param1, $dataFaktur) == TRUE) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data faktur berhasil direject</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data faktur gagal direject</div>');
				redirect(changeLink('panel/inventori/inventoriMasuk'));
			}
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur yang sudah dikonfirmasi tidak dapat dihapus atau diubah</div>');
			redirect(changeLink('panel/inventori/inventoriMasuk'));
		}
	}

	//------------------------ LOGISTIK KELUAR BEGIN ------------------------//
	public function inventoriKeluar($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'cari') {
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$status_approval = $this->input->post('status_approval');
			return $this->InventoriModel->getFaktur('out', $status_approval, $start_date, $end_date);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Inventori Keluar';
			$data['content'] = 'panel/inventori/inventoriKeluar/index';
			$data['start_date'] = $this->input->get('start_date');
			$data['end_date'] = $this->input->get('end_date');
			$data['status_approval'] = $this->input->get('status_approval');
			$this->load->view('panel/content', $data);
		}
	}

	public function createInventoriKeluar($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doCreate') {
			$dataFaktur = array(
				'kategori_faktur' => 'out',
				'kode_faktur' => $this->input->post('kode_faktur'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
				'status_keluar' => $this->input->post('status_keluar'),
				'created_by' => $this->session->userdata('id_pengguna'),
			);
			$tempdir = "assets/img/qrfaktur/";
			if (!file_exists($tempdir))
				mkdir($tempdir);

			$logopath = 'assets/img/Fasilkom-TI.png';

			if ($this->GeneralModel->create_general('e_faktur', $dataFaktur) == TRUE) {
				$id_faktur = $this->db->insert_id();
				//------------------ Pembuatan Barcode ----------------------------//
				$this->zend->load('Zend/Barcode.php'); 
				$barcode = $id_faktur.'.png';
				$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$barcode), array())->draw($barcode,'image', array('text'=>$barcode), array());
				$imageName = $barcode;
				$imagePath = 'assets/img/barcodefaktur/';
				imagejpeg($imageResource, $imagePath.$imageName); 
				$pathBarcode = $imagePath.$imageName; 				
				$dataFaktur2 = array(
					'barcode_faktur' => $pathBarcode
				);
				$namaQrcode = 'Faktur-' . $id_faktur . '.png';
				//isi qrcode jika di scan
				$codeContents = $id_faktur;
				//simpan file qrcode
				QRcode::png($codeContents, $tempdir . $namaQrcode, QR_ECLEVEL_H, 10, 4);

				// ambil file qrcode
				$QR = imagecreatefrompng($tempdir . $namaQrcode);

				$dataFaktur2 += array(
					'qrcode_faktur' => 'assets/img/qrfaktur/' . $namaQrcode
				);

				$this->GeneralModel->update_general('e_faktur', 'id_faktur', $id_faktur, $dataFaktur2);

				// memulai menggambar logo dalam file qrcode
				$logo = imagecreatefrompng($logopath);

				imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
				imagealphablending($logo, false);
				imagesavealpha($logo, true);

				$QR_width = imagesx($QR);
				$QR_height = imagesy($QR);

				$logo_width = imagesx($logo);
				$logo_height = imagesy($logo);

				// Scale logo to fit in the QR Code
				$logo_qr_width = $QR_width / 5;
				$scale = $logo_width / $logo_qr_width;
				$logo_qr_height = $logo_height / $scale;

				imagecopyresampled($QR, $logo, $QR_width / 2.5, $QR_height / 2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

				// Simpan kode QR lagi, dengan logo di atasnya
				imagepng($QR, $tempdir . $namaQrcode);

				$id_inventori[] = $this->input->post('id_inventori');
				$jumlah[] = $this->input->post('jumlah');
				$harga_barang[] = $this->input->post('harga_barang');

				
				for ($i = 0; $i < count($id_inventori[0]); $i++) {
					$cekInventori = $this->GeneralModel->get_by_id_general('e_inventori','id_inventori', $id_inventori[0][$i]);
					if ($cekInventori[0]->jumlah_inventori <= 0) {
						$dataInventoriKosong[$i] = array(
							"nama_inventori" => $cekInventori[0]->nama_inventori
						);
					}else{
						$dataInventori = array(
							'id_faktur' => $id_faktur,
							'id_inventori' => $id_inventori[0][$i],
							'jumlah_inventori' => $jumlah[0][$i],
							'harga_barang' => $harga_barang[0][$i],
						);
						$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
					}
				}

				if (count($dataInventoriKosong) > 0) {
					$text = "Data inventori keluar berhasil ditambahkan tetapi untuk beberapa stock berikut tidak tersedia ";
					for ($i=0; $i < count($dataInventoriKosong); $i++) { 
						$text .= $dataInventoriKosong[$i]['nama_inventori'].", ";
 					}
					$this->session->set_flashdata('notif', '<div class="alert alert-success">'.$text.'</div>');
				}else{
					$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori keluar berhasil ditambahkan</div>');
				}
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data inventori keluar gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Inventori Keluar';
			$data['content'] = 'panel/inventori/inventoriKeluar/create';
			$data['inventori'] = $this->GeneralModel->get_general('v_inventori');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateInventoriKeluar($param1 = '', $param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataFaktur = array(
				'kode_faktur' => $this->input->post('kode_faktur'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
				'status_keluar' => $this->input->post('status_keluar'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'updated_time' => DATE('Y-m-d H:i:s'),
			);

			if ($this->GeneralModel->update_general('e_faktur', 'id_faktur', $param2, $dataFaktur) == TRUE) {
				$id_inventori[] = $this->input->post('id_inventori');
				$jumlah[] = $this->input->post('jumlah');
				$harga_barang[] = $this->input->post('harga_barang');

				$this->GeneralModel->delete_general('e_detail_faktur', 'id_faktur', $param2);

				for ($i = 0; $i < count($id_inventori[0]); $i++) {
					$cekInventori = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $id_inventori[0][$i]);
					if ($cekInventori[0]->jumlah_inventori <= 0) {
						$dataInventoriKosong[$i] = array(
							"nama_inventori" => $cekInventori[0]->nama_inventori
						);
					} else {
						$dataInventori = array(
							'id_faktur' => $param2,
							'id_inventori' => $id_inventori[0][$i],
							'jumlah_inventori' => $jumlah[0][$i],
							'harga_barang' => $harga_barang[0][$i],
						);
						$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
					}
				}

				if (count($dataInventoriKosong) > 0) {
					$text = "Data inventori keluar berhasil ditambahkan tetapi untuk beberapa stock berikut tidak tersedia ";
					for ($i = 0; $i < count($dataInventoriKosong); $i++) {
						$text .= $dataInventoriKosong[$i]['nama_inventori'] . ", ";
					}
					$this->session->set_flashdata('notif', '<div class="alert alert-success">' . $text . '</div>');
				} else {
					$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori keluar berhasil ditambahkan</div>');
				}
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data inventori masuk gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Inventori Keluar';
			$data['content'] = 'panel/inventori/inventoriKeluar/update';
			$data['inventori'] = $this->GeneralModel->get_general('v_inventori');
			$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur', 'id_faktur', $param1);
			$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('e_detail_faktur', 'id_faktur', $param1);
			if ($data['faktur'][0]->status_approval != 'pending') {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf data faktur yang sudah dikonfirmasi tidak bisa kamu ubah!</div>');
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			}
			$this->load->view('panel/content', $data);
		}
	}

	public function deleteInventoriKeluar($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$faktur = $this->GeneralModel->get_by_id_general('e_faktur', 'id_faktur', $param1);
		if ($faktur[0]->status_approval == 'pending') {
			if (!empty($faktur[0]->qrcode_faktur)) {
				try {
					unlink($faktur[0]->qrcode_faktur);
				} catch (\Exception $e) {
				}
			}
			if ($this->GeneralModel->delete_general('e_faktur', 'id_faktur', $param1) == TRUE) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data faktur berhasil dihapus</div>');
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data faktur gagal dihapus</div>');
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			}
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur yang sudah dikonfirmasi tidak dapat dihapus atau diubah</div>');
			redirect(changeLink('panel/inventori/inventoriKeluar'));
		}
	}

	public function detailInventoriKeluar($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Detail Inventori Keluar';
		$data['content'] = 'panel/inventori/inventoriKeluar/detail';
		$data['inventori'] = $this->GeneralModel->get_general('v_inventori');
		$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur', 'id_faktur', $param1);
		$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori', 'id_faktur', $param1);
		if ($data['faktur'][0]->kategori_faktur!='out') {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur tidak tersedia</div>');
			redirect(changeLink('panel/inventori/inventoriKeluar'));
		}
		$this->load->view('panel/content', $data);
	}

	public function approveInventoriKeluar($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$detailFaktur = $this->GeneralModel->get_by_id_general('e_detail_faktur', 'id_faktur', $param1);
		$faktur = $this->GeneralModel->get_by_id_general('e_faktur','id_faktur',$param1);
		if ($faktur[0]->status_approval == 'pending') {
			foreach ($detailFaktur as $key) {
				$oldStock = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $key->id_inventori);
				if ($oldStock[0]->jumlah_inventori - $key->jumlah_inventori <= 0) {
					$this->session->set_flashdata('notif', '<div class="alert alert-success">Mohon maaf stock tidak bisa dikeluarkan karena ada beberapa stock yang tidak mencukupi</div>');
					redirect(changeLink('panel/inventori/inventoriKeluar'));
				}
			}
			$dataFaktur = array(
				'status_approval' => 'accept',
				'approval_by' => $this->session->userdata('id_pengguna'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'approval_time' => DATE('Y-m-d H:i:s'),
				'updated_time' => DATE('Y-m-d H:i:s'),
			);
			if ($this->GeneralModel->update_general('e_faktur', 'id_faktur', $param1, $dataFaktur) == TRUE) {
				foreach ($detailFaktur as $key) {
				$oldStock = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $key->id_inventori);
						$dataInventori = array(
							'jumlah_inventori' => $oldStock[0]->jumlah_inventori - $key->jumlah_inventori,
							'harga_barang' => $key->harga_barang,
						);
						$this->GeneralModel->update_general('e_inventori', 'id_inventori', $key->id_inventori, $dataInventori);
				}
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data faktur berhasil diapprove</div>');
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data faktur gagal diapprove</div>');
					redirect(changeLink('panel/inventori/inventoriKeluar'));
			}
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur yang sudah dikonfirmasi tidak dapat dihapus atau diubah</div>');
			redirect(changeLink('panel/inventori/inventoriKeluar'));
		}
	}

	public function rejectInventoriKeluar($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$faktur = $this->GeneralModel->get_by_id_general('e_faktur','id_faktur',$param1);
		if ($faktur[0]->status_approval == 'pending') {
			$dataFaktur = array(
				'status_approval' => 'reject',
				'approval_by' => $this->session->userdata('id_pengguna'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'approval_time' => DATE('Y-m-d H:i:s'),
				'updated_time' => DATE('Y-m-d H:i:s'),
			);
			if ($this->GeneralModel->update_general('e_faktur', 'id_faktur', $param1, $dataFaktur) == TRUE) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data faktur berhasil direject</div>');
					redirect(changeLink('panel/inventori/inventoriKeluar'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data faktur gagal direject</div>');
					redirect(changeLink('panel/inventori/inventoriKeluar'));
			}
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur yang sudah dikonfirmasi tidak dapat dihapus atau diubah</div>');
			redirect(changeLink('panel/inventori/inventoriKeluar'));
		}
	}

	public function cariInventori(){
		$kode_inventori = $this->input->get('kode_inventori');
		if (!empty($kode_inventori)) {
			$kode_inventori = explode('/',$kode_inventori);
			$kode_unit = $kode_inventori[0];
			$kode_sub_unit = $kode_inventori[1];
			$kode_inventori = $kode_inventori[2];
			$getDataInventori = $this->GeneralModel->get_by_triple_id_general('v_inventori','kode_unit',$kode_unit,'kode_sub_unit',$kode_sub_unit,'kode_inventori',$kode_inventori);
			if ($getDataInventori == TRUE) {
				echo json_encode($getDataInventori,JSON_PRETTY_PRINT);
			}else{
				echo 'false';
			}
		}else{
			echo 'false';
		}
	}
}
