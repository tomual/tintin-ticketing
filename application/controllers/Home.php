<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->model('users_model');
        $this->load->model('tickets_model');
        $this->load->model('versions_model');
        $this->load->helper('date');

        if(empty($this->users_model->get_users()))
        {
            redirect('user/create');
        }

        $summary = $this->tickets_model->group_by_status();

        $versions = $this->versions_model->get_latest_versions(5);
        $recent = array();
        foreach ($versions as $key => $version) {
            $recent[$key] = $this->tickets_model->get_ticket($version->tid);
            $recent[$key]->date = $version->created;
        }

        $next_up = array();
        $next_up_statuses = array_filter(explode(',', $this->settings_model->get_setting('next_up_statuses')));
        if ($next_up_statuses) {
            $next_up = $this->tickets_model->search(array('status' => $next_up_statuses));
            shuffle($next_up);
            $next_up = array_slice($next_up, 0, 5);
        }
        
        $this->load->view('home', compact('summary', 'recent', 'next_up'));
    }
}
