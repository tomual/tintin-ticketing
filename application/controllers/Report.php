<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets_model');
        $this->load->model('statuses_model');
        $this->load->model('categories_model');
        $this->load->model('versions_model');
    }

    public function all()
    {
        $tickets = $this->tickets_model->get_tickets();
        $this->load->view('report/all', compact('tickets'));
    }

    public function status()
    {
        $statuses = $this->statuses_model->get_statuses();
        if($this->input->get('status'))
        {
            $status = $this->input->get('status');
            $tickets = $this->tickets_model->get_by_status($status);
        }
        else
        {
            $tickets = $this->tickets_model->get_by_status();
        }

        $this->load->view('report/status', compact('tickets', 'statuses'));
    }

    public function user()
    {
        $users = $this->users_model->get_users();

        if($this->input->get('user'))
        {
            $user = $this->input->get('user');
            $tickets = $this->tickets_model->get_by_user($user);
        }
        else
        {
            $tickets = $this->tickets_model->get_by_user();
        }
        $this->load->view('report/user', compact('tickets', 'users'));
    }

    public function category()
    {
        $categories = $this->categories_model->get_categories();
    	if($this->input->get('category'))
    	{
    		$category = $this->input->get('category');
            $tickets = $this->tickets_model->get_by_category($category);
    	}
        else
        {
            $tickets = $this->tickets_model->get_by_category();
        }
        $this->load->view('report/category', compact('tickets', 'categories'));
    }
}
