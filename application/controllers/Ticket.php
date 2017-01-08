<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function index()
    {
        $this->load->view('ticket/home');
    }

    public function create()
    {
        $this->load->view('ticket/create');
    }
}
