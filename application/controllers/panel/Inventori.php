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

	public function getSubUnitId(){
			$getUnit = $this->GeneralModel->get_by_id_general('e_sub_unit','unit',$this->input->get('unit'));
			if ($getUnit) {
				echo json_encode($getUnit,JSON_PRETTY_PRINT);
			}else{
				echo 'false';
			}
	}

	public function listInventori($param1='')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$id_kategori = $this->input->post('id_kategori');
			$kode_unit = $this->input->post('kode_unit');
			$kode_sub_unit = $this->input->post('kode_sub_unit');
			return $this->InventoriModel->getDataInventori($id_kategori,$kode_unit,$kode_sub_unit);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Inventori';
			$data['content'] = 'panel/inventori/index';
			$data['getKategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
			$data['id_kategori'] = $this->input->get('id_kategori');
			$data['kode_unit'] = $this->input->get('kode_unit');				
			$data['kode_sub_unit'] = $this->input->get('kode_sub_unit');				
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
			$this->load->view('panel/content', $data);
		}
	}

	public function createInventori($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doCreate') {
			//--- VALIDATION ---//
			$this->form_validation->set_rules(
					'kode_unit', 'Kode Unit',
					'required',
					array(
							'required'      => 'Kode Unit tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'kode_sub_unit', 'Kode Sub Unit',
					'required',
					array(
							'required'      => 'Kode Sub Unit tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'kode_sumber_dana', 'Kode Sumber Dana',
					'required',
					array(
							'required'      => 'Kode Sumber Dana tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'kode_inventori', 'Kode Inventori',
					'required|is_unique[e_inventori.kode_inventori]',
					array(
							'required'      => 'Kode Inventori tidak boleh kosong',
							'unique'		=> 'Kode Inventori Sudah ada dan tidak dapat digunakan'
					)
			);
			$this->form_validation->set_rules(
					'nama_inventori', 'Nama Inventori',
					'required',
					array(
							'required'      => 'Nama Inventori tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'id_kategori', 'Kategori Inventori',
					'required',
					array(
							'required'      => 'Kategori Inventori tidak boleh kosong'
					)
			);
			//---------- END OF VALIDATION -------------//
			if ($this->form_validation->run() == FALSE) {
				$data['title'] = $this->title;
				$data['subtitle'] = 'Tambah Inventori';
				$data['content'] = 'panel/inventori/create';
				$data['kategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
				$data['sumberDana'] = $this->GeneralModel->get_general('e_sumber_dana');
				$data['unit'] = $this->GeneralModel->get_general('e_unit');
				$this->load->view('panel/content', $data);
			}else{
				$dataInventori = array(
					'kode_unit' => $this->input->post('kode_unit'),
					'kode_sub_unit' => $this->input->post('kode_sub_unit'),
					'kode_sumber_dana' => $this->input->post('kode_sumber_dana'),
					'kode_inventori' => $this->input->post('kode_inventori'),
					'nama_inventori' => $this->input->post('nama_inventori'),
					'harga_barang' => $this->input->post('harga_barang'),
					'kategori_inventori' => $this->input->post('id_kategori'),
					'created_by' => $this->session->userdata('id_pengguna')
				);
				//---------------- UPLOAD INVENTORI ---------------//
				$config['upload_path']          = 'assets/img/fotoInventori/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 10000;


				$this->upload->initialize($config);

				if (! $this->upload->do_upload('foto_inventori')) {
				} else {
						$dataInventori += array('foto_inventori' => $config['upload_path'].$this->upload->data('file_name'));
				}

				$tempdir = "assets/img/qrbarang/";
				if (!file_exists($tempdir))
					mkdir($tempdir);

				$logopath = 'assets/img/Fasilkom-TI.png';

				if ($this->GeneralModel->create_general('e_inventori', $dataInventori) == true) {
					$id_inventori = $this->db->insert_id();
					
					//isi qrcode jika di scan
					$codeContents = $dataInventori['kode_inventori'];
					$dataQrFile = $dataInventori['kode_inventori'].'.png';				
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
					$dataQrFile = $dataInventori['kode_inventori'].'.png';				
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
			$cekKodeInventori = $this->GeneralModel->get_by_id_general('e_inventori','kode_inventori',$this->input->post('kode_inventori'));


			//--- VALIDATION ---//
			$this->form_validation->set_rules(
					'kode_unit', 'Kode Unit',
					'required',
					array(
							'required'      => 'Kode Unit tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'kode_sub_unit', 'Kode Sub Unit',
					'required',
					array(
							'required'      => 'Kode Sub Unit tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'kode_sumber_dana', 'Kode Sumber Dana',
					'required',
					array(
							'required'      => 'Kode Sumber Dana tidak boleh kosong'
					)
			);
			if (empty($cekKodeInventori)) {
				$this->form_validation->set_rules(
						'kode_inventori', 'Kode Inventori',
						'required|is_unique[e_inventori.kode_inventori]',
						array(
								'required'      => 'Kode Inventori tidak boleh kosong',
								'unique'		=> 'Kode Inventori Sudah ada dan tidak dapat digunakan'
						)
				);
			}
			$this->form_validation->set_rules(
					'nama_inventori', 'Nama Inventori',
					'required',
					array(
							'required'      => 'Nama Inventori tidak boleh kosong'
					)
			);
			$this->form_validation->set_rules(
					'id_kategori', 'Kategori Inventori',
					'required',
					array(
							'required'      => 'Kategori Inventori tidak boleh kosong'
					)
			);
			//---------- END OF VALIDATION -------------//
			if ($this->form_validation->run() == FALSE) {
				$data['title'] = $this->title;
				$data['subtitle'] = 'Update Inventori';
				$data['content'] = 'panel/inventori/update';
				$data['inventori'] = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $param2);
				$data['sumberDana'] = $this->GeneralModel->get_general('e_sumber_dana');
				$data['kategori'] = $this->GeneralModel->get_general('e_kategori_inventori');
				$data['unit'] = $this->GeneralModel->get_general('e_unit');
				$this->load->view('panel/content', $data);
			}else{
				$dataInventori = array(
					'kode_unit' => $this->input->post('kode_unit'),
					'kode_sub_unit' => $this->input->post('kode_sub_unit'),
					'kode_sumber_dana' => $this->input->post('kode_sumber_dana'),
					'kode_inventori' => $this->input->post('kode_inventori'),
					'nama_inventori' => $this->input->post('nama_inventori'),
					'harga_barang' => $this->input->post('harga_barang'),
					'kategori_inventori' => $this->input->post('id_kategori'),
					'updated_by' => $this->session->userdata('id_pengguna'),
					'updated_time' => DATE('Y-m-d H:i:s')
				);

				$getQr = $this->GeneralModel->get_by_id_general('e_inventori','id_inventori',$param2);

				//---------------- UPLOAD INVENTORI ---------------//
				$config['upload_path']          = 'assets/img/fotoInventori/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 10000;


				$this->upload->initialize($config);

				if (! $this->upload->do_upload('foto_inventori')) {
				} else {
						try {
							if (!empty($getQr[0]->foto_inventori)) {
								unlink($getQr[0]->foto_inventori);
							}
						} catch (\Throwable $th) {
						}
						$dataInventori += array('foto_inventori' => $config['upload_path'].$this->upload->data('file_name'));
				}

				if (!empty($getQr[0]->qrcode)) {
					try {
						unlink($getQr[0]->qrcode);
					} catch (\Throwable $th) {
					}
				}

				if ($this->GeneralModel->update_general('e_inventori', 'id_inventori', $param2, $dataInventori) == true) {
					//isi qrcode jika di scan
					$codeContents = $dataInventori['kode_inventori'];
					$dataQrFile = $dataInventori['kode_inventori'].'.png';				

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
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Inventori';
			$data['content'] = 'panel/inventori/update';
			$data['inventori'] = $this->GeneralModel->get_by_id_general('e_inventori', 'id_inventori', $param1);
			$data['sumberDana'] = $this->GeneralModel->get_general('e_sumber_dana');
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

	public function detailInventori($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='print') {
			$data['inventori'] = $this->GeneralModel->get_by_id_general('v_inventori', 'id_inventori', $param2);
			$this->load->view('panel/inventori/print', $data);
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Detail Inventori';
			$data['content'] = 'panel/inventori/detail';
			$data['inventori'] = $this->GeneralModel->get_by_id_general('v_inventori', 'id_inventori', $param1);
			$this->load->view('panel/content', $data);
		}
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
				'nim_mahasiswa' => $this->input->post('nim_mahasiswa'),
				'kode_faktur' => $this->input->post('kode_faktur'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
				'durasi' => $this->input->post('durasi'),
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
				$barcode = $id_faktur;
				$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$barcode), array())->draw($barcode,'image', array('text'=>$barcode), array());
				$imageName = $barcode.'.png';
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
				
				for ($i = 0; $i < count($id_inventori[0]); $i++) {
						$dataInventori = array(
							'id_faktur' => $id_faktur,
							'id_inventori' => $id_inventori[0][$i],
						);
						$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
				}

				$getStaff = $this->GeneralModel->get_by_id_general('e_pengguna','hak_akses','staff');
				foreach ($getStaff as $key) {
					$message = "Halo *".$key->nama_lengkap."* ada faktur untuk barang keluar dengan *ID ".$id_faktur."* harap segera melakukan konfirmasi pada aplikasi, Terimakasih.";
					try {
						sendNotifWA($key->no_wa,$message);
					} catch (\Throwable $th) {
					}
				}
				
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori keluar berhasil ditambahkan</div>');
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
				'nim_mahasiswa' => $this->input->post('nim_mahasiswa'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
				'durasi' => $this->input->post('durasi'),
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
						$dataInventori = array(
							'id_faktur' => $param2,
							'id_inventori' => $id_inventori[0][$i],
							'jumlah_inventori' => $jumlah[0][$i],
							'harga_barang' => $harga_barang[0][$i],
						);
						$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
				}

				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data inventori keluar berhasil ditambahkan</div>');
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
			$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori', 'id_faktur', $param1);
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

	public function detailInventoriKeluar($param1 = '',$param2='')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='print') {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Detail Inventori Keluar';
			$data['inventori'] = $this->GeneralModel->get_general('v_inventori');
			$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur', 'id_faktur', $param2);
			$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori', 'id_faktur', $param2);
			if ($data['faktur'][0]->kategori_faktur!='out') {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur tidak tersedia</div>');
				redirect(changeLink('panel/inventori/inventoriKeluar'));
			}			
			$this->load->view('panel/inventori/inventoriKeluar/print',$data);
		}else{
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
	}

	public function approveInventoriKeluar($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$faktur = $this->GeneralModel->get_by_id_general('e_faktur','id_faktur',$param1);
		if ($faktur[0]->status_approval == 'pending') {
			$dataFaktur = array(
				'status_approval' => 'accept',
				'approval_by' => $this->session->userdata('id_pengguna'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'approval_time' => DATE('Y-m-d H:i:s'),
				'updated_time' => DATE('Y-m-d H:i:s'),
			);
			if ($this->GeneralModel->update_general('e_faktur', 'id_faktur', $param1, $dataFaktur) == TRUE) {
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
			$getDataInventori = $this->GeneralModel->get_by_triple_id_general('v_inventori','kode_inventori',$kode_inventori);
			if ($getDataInventori == TRUE) {
				echo json_encode($getDataInventori,JSON_PRETTY_PRINT);
			}else{
				echo 'false';
			}
		}else{
			echo 'false';
		}
	}

	public function pengembalianInventoriKeluar($id_faktur){
		$getFaktur = $this->GeneralModel->get_by_id_general('e_faktur','id_faktur',$id_faktur);
		if ($getFaktur[0]->status_approval == 'accept' && $getFaktur[0]->status_keluar == 'pinjam' && $getFaktur[0]->status_pengembalian == 'belum') {
			$getDetailFaktur = $this->GeneralModel->get_by_id_general('e_detail_faktur','id_faktur',$id_faktur);
			foreach ($getDetailFaktur as $key) {
				$getInventori = $this->GeneralModel->get_by_id_general('e_inventori','id_inventori',$key->id_inventori);
				$dataInventori = array(
					'jumlah_inventori' => $getInventori[0]->jumlah_inventori + $key->jumlah_inventori
				);
				$this->GeneralModel->update_general('e_inventori','id_inventori',$key->id_inventori,$dataInventori);
			}

			$dataFaktur = array(
				'status_pengembalian' => 'sudah',
				'dikembalikan_oleh' => $this->session->userdata('id_pengguna'),
				'tgl_pengembalian' => DATE('Y-m-d H:i:s')
			);

			$this->GeneralModel->update_general('e_faktur','id_faktur',$id_faktur,$dataFaktur);

			$this->session->set_flashdata('notif', '<div class="alert alert-success">Pengembalian berhasil dilakukan</div>');
			redirect(changeLink('panel/inventori/detailInventoriKeluar/'.$id_faktur));
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger">Mohon maaf faktur ini tidak dapat di lakukan pengembalian</div>');
			redirect(changeLink('panel/inventori/detailInventoriKeluar/'.$id_faktur));
		}
	}

		public function laporanInventori($param1='')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='cari') {
			$kategori_faktur = $this->input->post('kategori_faktur');
			$status_keluar = $this->input->post('status_keluar');
			$status_pengembalian = $this->input->post('status_pengembalian');
			$status_approval = $this->input->post('status_approval');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			return $this->InventoriModel->getLaporanInventori($kategori_faktur,$status_keluar,$status_pengembalian,$status_approval,$start_date,$end_date);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Laporan Inventori';
			$data['content'] = 'panel/inventori/laporanKeluar';
			$data['kategori_faktur'] = 'out';
			if (!empty($this->input->get('start_date'))) {
				$data['start_date']  = $this->input->get('start_date');
			}else{
				$data['start_date'] = DATE('Y-m-01');
			}

			if (!empty($this->input->get('end_date'))) {
				$data['end_date']  = $this->input->get('end_date');
			}else{
				$data['end_date'] = DATE('Y-m-t');
			}
			$data['status_keluar'] = $this->input->get('status_keluar');
			$data['status_pengembalian'] = $this->input->get('status_pengembalian');
			$data['status_approval'] = $this->input->get('status_approval');
			$this->load->view('panel/content', $data);
		}
	}

	//------------------------ MUTASI BEGIN ------------------------//
	public function daftarMutasi($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'cari') {
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$status_approval = $this->input->post('status_approval');
			return $this->InventoriModel->getFaktur('mutasi', $status_approval, $start_date, $end_date);
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Daftar Mutasi Barang';
			$data['content'] = 'panel/inventori/mutasi/index';
			$data['start_date'] = $this->input->get('start_date');
			$data['end_date'] = $this->input->get('end_date');
			$data['status_approval'] = $this->input->get('status_approval');
			$this->load->view('panel/content', $data);
		}
	}

	public function tambahMutasi($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doCreate') {
			$dataFaktur = array(
				'kategori_faktur' => 'mutasi',
				'kode_faktur' => $this->input->post('kode_faktur'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
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
				$barcode = $id_faktur;
				$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$barcode), array())->draw($barcode,'image', array('text'=>$barcode), array());
				$imageName = $barcode.'.png';
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
				$unit_awal[] = $this->input->post('unit_awal');
				$sub_unit_awal[] = $this->input->post('sub_unit_awal');
				$unit_pindah[] = $this->input->post('unit_pindah');
				$sub_unit_pindah[] = $this->input->post('sub_unit_pindah');
				
				for ($i = 0; $i < count($id_inventori[0]); $i++) {
						$dataInventori = array(
							'id_faktur' => $id_faktur,
							'id_inventori' => $id_inventori[0][$i],
							'unit_awal' => $unit_awal[0][$i],
							'sub_unit_awal' => $sub_unit_awal[0][$i],
							'unit_pindah' => $unit_pindah[0][$i],
							'sub_unit_pindah' => $sub_unit_pindah[0][$i],
						);
						$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
				}

				$getStaff = $this->GeneralModel->get_by_id_general('e_pengguna','hak_akses','staff');
				foreach ($getStaff as $key) {
					$message = "Halo ".$key->nama_lengkap." ada faktur untuk mutasi barang dengan *ID ".$id_faktur."* harap segera melakukan konfirmasi pada aplikasi, Terimakasih.";
					try {
						sendNotifWA($key->no_wa,$message);
					} catch (\Throwable $th) {
					}
				}
				
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data mutasi barang berhasil ditambahkan</div>');
				redirect(changeLink('panel/inventori/daftarMutasi'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data mutasi barang gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/daftarMutasi'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Tambah Mutasi';
			$data['content'] = 'panel/inventori/mutasi/create';
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
			$this->load->view('panel/content', $data);
		}
	}

	public function updateMutasi($param1 = '',$param2 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$dataFaktur = array(
				'kategori_faktur' => 'mutasi',
				'kode_faktur' => $this->input->post('kode_faktur'),
				'catatan_faktur' => $this->input->post('catatan_faktur'),
				'updated_by' => $this->session->userdata('id_pengguna'),
				'updated_time' => DATE('Y-m-d H:i:s'),
			);

			if ($this->GeneralModel->update_general('e_faktur','id_faktur',$param2,$dataFaktur) == TRUE) {
				$id_faktur = $param2;
				
				$id_inventori[] = $this->input->post('id_inventori');
				$unit_awal[] = $this->input->post('unit_awal');
				$sub_unit_awal[] = $this->input->post('sub_unit_awal');
				$unit_pindah[] = $this->input->post('unit_pindah');
				$sub_unit_pindah[] = $this->input->post('sub_unit_pindah');
				
				//Delete Old Detail Faktur
				$this->GeneralModel->delete_general('e_detail_faktur','id_faktur',$param2);

				for ($i = 0; $i < count($id_inventori[0]); $i++) {
						$dataInventori = array(
							'id_faktur' => $id_faktur,
							'id_inventori' => $id_inventori[0][$i],
							'unit_awal' => $unit_awal[0][$i],
							'sub_unit_awal' => $sub_unit_awal[0][$i],
							'unit_pindah' => $unit_pindah[0][$i],
							'sub_unit_pindah' => $sub_unit_pindah[0][$i],
						);
						$this->GeneralModel->create_general('e_detail_faktur', $dataInventori);
				}

				$getStaff = $this->GeneralModel->get_by_id_general('e_pengguna','hak_akses','staff');
				foreach ($getStaff as $key) {
					$message = "Halo *".$key->nama_lengkap."* ada faktur untuk mutasi barang dengan *ID ".$id_faktur."* harap segera melakukan konfirmasi pada aplikasi, Terimakasih.";
					try {
						sendNotifWA($key->no_wa,$message);
					} catch (\Throwable $th) {
					}
				}
				
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data mutasi barang berhasil ditambahkan</div>');
				redirect(changeLink('panel/inventori/daftarMutasi'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data mutasi barang gagal ditambahkan</div>');
				redirect(changeLink('panel/inventori/daftarMutasi'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Update Mutasi';
			$data['content'] = 'panel/inventori/mutasi/update';
			$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur','id_faktur',$param1);
			$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori','id_faktur',$param1);
			$data['unit'] = $this->GeneralModel->get_general('e_unit');
			$this->load->view('panel/content', $data);
		}
	}

	public function detailMutasi($param1='',$param2=''){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1=='print') {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Detail Mutasi';
			$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur','id_faktur',$param2);
			$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori','id_faktur',$param2);
			$this->load->view('panel/inventori/mutasi/print', $data);
		}else{
			$data['title'] = $this->title;
			$data['subtitle'] = 'Detail Mutasi';
			$data['content'] = 'panel/inventori/mutasi/detail';
			$data['faktur'] = $this->GeneralModel->get_by_id_general('v_faktur','id_faktur',$param1);
			$data['detailFaktur'] = $this->GeneralModel->get_by_id_general('v_detail_inventori','id_faktur',$param1);
			$this->load->view('panel/content', $data);
		}
	}

}
