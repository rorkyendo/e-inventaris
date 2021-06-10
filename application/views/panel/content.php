<?php
        $appsProfile = $this->SettingsModel->get_profile();

        $this->load->view('panel/templates/header',$appsProfile);
        $this->load->view('panel/templates/navbar');
		    $this->load->view('panel/templates/sidebar');
        $this->load->view($content);
        $this->load->view('panel/templates/footer');
?>
