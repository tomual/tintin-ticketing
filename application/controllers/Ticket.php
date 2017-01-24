<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function index()
    {
        $this->load->view('ticket/home');
    }

    public function create()
    {
    	if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$form = $_POST;
    		$data = array(
    			'title'			=> $form['title'],
    			'description'	=> $form['description'],
    			'author'		=> 'Anonymous',
    			'category'		=> 1
    		);
    		$this->db->insert('tickets', $data);
    	}
        $this->load->view('ticket/create');
    }
}
