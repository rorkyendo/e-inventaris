<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{

	public $parent_modul = 'Pengaturan';
	public $title = 'Pengaturan';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('LoggedIN') == FALSE) redirect('auth/logout');
		$this->akses_controller = $this->uri->segment(3);
	}

	public function identitasAplikasi($param1 = '')
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		if ($param1 == 'doUpdate') {
			$identitasAplikasi = array(
				'apps_name' => $this->input->post('apps_name'),
				'apps_version' => $this->input->post('apps_version'),
				'apps_code' => $this->input->post('apps_code'),
				'agency' => $this->input->post('agency'),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'telephon' => $this->input->post('telephon'),
				'fax' => $this->input->post('fax'),
				'website' => $this->input->post('website'),
				'header' => $this->input->post('header'),
				'footer' => $this->input->post('footer'),
				'keyword' => $this->input->post('keyword'),
				'about_us' => $this->input->post('about_us'),
				'email' => $this->input->post('email')
			);
			//---------------- UPDATE LOGO ---------------//
			$config['upload_path']          = 'assets/img/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);
			$getIdentitas = $this->GeneralModel->get_general('e_identitas');
			if (!$this->upload->do_upload('logo')) {
			} else {
				if (!empty($getIdentitas[0]->logo)) {
					unlink($getIdentitas[0]->logo);
				}
				$identitasAplikasi += array('logo' => $config['upload_path'] . $this->upload->data('file_name'));
			}

			//---------------- UPDATE ICON ---------------//
			$config['upload_path']          = 'assets/img/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|ico';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);

			if (!$this->upload->do_upload('icon')) {
			} else {
				if (!empty($getIdentitas[0]->icon)) {
					unlink($getIdentitas[0]->icon);
				}
				$identitasAplikasi += array('icon' => $config['upload_path'] . $this->upload->data('file_name'));
			}

			//---------------- UPDATE SIDEBAR LOGIN ---------------//
			$config['upload_path']          = 'assets/img/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|ico';
			$config['max_size']             = 10000;


			$this->upload->initialize($config);

			if (!$this->upload->do_upload('sidebar_login')) {
			} else {
				if (!empty($getIdentitas[0]->sidebar_login)) {
					unlink($getIdentitas[0]->sidebar_login);
				}
				$identitasAplikasi += array('sidebar_login' => $config['upload_path'] . $this->upload->data('file_name'));
			}

			if ($this->GeneralModel->update_general('e_identitas', 'id_profile', 1, $identitasAplikasi) == true) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Data identitas aplikasi berhasil diupdate</div>');
				redirect(changeLink('panel/pengaturan/identitasAplikasi'));
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Data identitas aplikasi berhasil diupdate</div>');
				redirect(changeLink('panel/pengaturan/identitasAplikasi'));
			}
		} else {
			$data['title'] = $this->title;
			$data['subtitle'] = 'Identitas Aplikasi';
			$data['content'] = 'panel/pengaturan/identitas/update';
			$data['identitas'] = $this->GeneralModel->get_by_id_general('e_identitas','id_profile',1);
			$this->load->view('panel/content', $data);
		}
	}

	public function daftarModul()
	{
		if (cekModul($this->akses_controller) == FALSE) redirect('auth/access_denied');
		$data['title'] = $this->title;
		$data['subtitle'] = 'Daftar Modul';
		$data['content'] = 'panel/pengaturan/modulMenu/index';
		$data['parentModul'] = $this->GeneralModel->get_general_order_by('e_parent_modul', 'urutan', 'ASC');
		$this->load->view('panel/content', $data);
	}
}
