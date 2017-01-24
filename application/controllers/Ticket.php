<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function index()
    {
        $this->load->view('ticket/home');
    }

    public function create()
    {
        $this->load->model('tickets_model');
    	if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$form = $_POST;
            $this->tickets_model->add_ticket($form);
    	}
        $this->load->view('ticket/create');
    }
}
