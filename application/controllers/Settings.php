<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
    }

    public function index()
    {
        $settings = $this->settings_model->get_settings();
        $this->load->view('settings', compact('settings'));
    }

    public function edit()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->settings_model->set_settings($form);
        }
        redirect(site_url('settings'));
    }
}
