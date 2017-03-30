<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
        $this->load->model('statuses_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $statuses = $this->statuses_model->get_statuses();
        $settings = $this->settings_model->get_settings();
        $this->load->view('settings', compact('settings', 'statuses'));
    }

    public function edit()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('start_status', 'Start Status', 'required');
            $this->form_validation->set_rules('closed_status', 'Closed Status', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $this->settings_model->set_settings($form);
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the role.');
            }
        }
        redirect(site_url('settings'));
    }
}
