<?php

class Scan extends CI_Controller
{

	public $parent_modul = 'Scan';
	public $title = 'Scan';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
		$this->akses_controller = $this->uri->segment(3);
	}

	public function scanInventori(){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
			$data['title'] = $this->title;
			$data['subtitle'] = 'Scan Inventori';
			$data['content'] = 'panel/scan/scanInventori';
			$this->load->view('panel/content', $data);
	}

	public function scanFaktur(){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
			$data['title'] = $this->title;
			$data['subtitle'] = 'Scan Faktur';
			$data['content'] = 'panel/scan/scanFaktur';
			$this->load->view('panel/content', $data);
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

	public function scanBarcodeInventori(){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
			$data['title'] = $this->title;
			$data['subtitle'] = 'Scan Barcode Inventori';
			$data['content'] = 'panel/scan/scanBarcodeInventori';
			$this->load->view('panel/content', $data);
	}

	public function scanBarcodeFaktur(){
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
			$data['title'] = $this->title;
			$data['subtitle'] = 'Scan Barcode Faktur';
			$data['content'] = 'panel/scan/scanBarcodeFaktur';
			$this->load->view('panel/content', $data);
	}

	public function cariFaktur(){
		$faktur = $this->input->get('faktur');
		if (!empty($faktur)) {
			$getFaktur = $this->GeneralModel->get_by_id_general('v_faktur','id_faktur',$faktur);
			if ($getFaktur == TRUE) {
				echo json_encode($getFaktur,JSON_PRETTY_PRINT);
			}else{
				echo 'false';
			}
		}else{
			echo 'false';
		}
	}

}
