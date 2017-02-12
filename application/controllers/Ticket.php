<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

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
        $this->load->view('ticket/all', compact('tickets'));
    }

    public function view($tid)
    {
        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();
        $ticket = $this->tickets_model->get_ticket($tid);
        $versions = $this->versions_model->get_versions($tid);

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            echo "<pre>";
            print_r($form);
            echo "</pre>";
            $before = $ticket;
            $this->tickets_model->set_ticket($form);
            $after = $this->tickets_model->get_ticket($tid);
            $this->versions_model->add_version($tid, $form['comment'], $before, $after);
            $ticket = $after;

            redirect("/ticket/view/$tid");
        }
        $this->load->view('ticket/view', compact('ticket', 'versions', 'statuses', 'categories'));
    }

    public function edit($tid)
    {
        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();
        $ticket = $this->tickets_model->get_ticket($tid);
        $versions = $this->versions_model->get_versions($tid);

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $before = $ticket;
            $this->tickets_model->set_ticket($form);
            $after = $this->tickets_model->get_ticket($tid);
            $this->versions_model->add_version($tid, $form['comment'], $before, $after);
            $ticket = $after;
        }
        $this->load->view('ticket/edit', compact('ticket', 'versions', 'statuses', 'categories'));
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
