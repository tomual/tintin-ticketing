<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets_model');
    }

    public function index()
    {
        $tickets = $this->tickets_model->get_tickets();
        $this->load->view('ticket/all', compact('tickets'));
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
