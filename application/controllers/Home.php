<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->model('users_model');
        $this->load->model('tickets_model');
        $this->load->helper('date');

        if(empty($this->users_model->get_users()))
        {
            redirect('user/create');
        }
        $summary = $this->tickets_model->group_by_status();
        $recent = $this->tickets_model->get_recently_updated();
        $this->load->view('home', compact('summary', 'recent'));
    }
}
