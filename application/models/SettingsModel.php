<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_profile()
    {
        $query = $this->db->where('id_profile', '1')->get('e_identitas');
        return $query->row();
    }
}
