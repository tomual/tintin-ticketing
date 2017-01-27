<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets_model');
        $this->load->model('statuses_model');
        $this->load->model('categories_model');
    }

    public function all()
    {
        $tickets = $this->tickets_model->get_tickets();
        $this->load->view('ticket/all', compact('tickets'));
    }

    public function view($tid)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->tickets_model->set_ticket($form);
        }
        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();
        $ticket = $this->tickets_model->get_ticket($tid);
        $this->load->view('ticket/view', compact('ticket', 'statuses', 'categories'));
    }

    public function edit($tid)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->tickets_model->set_ticket($form);
        }
        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();
        $ticket = $this->tickets_model->get_ticket($tid);
        $this->load->view('ticket/edit', compact('ticket', 'statuses', 'categories'));
    }

    public function create()
    {
    	if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$form = $_POST;
            $this->tickets_model->add_ticket($form);
    	}
        $this->load->view('ticket/create');
    }
}
