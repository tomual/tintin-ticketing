<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->model('users_model');

        if(empty($this->users_model->get_users()))
        {
            redirect('user/create');
        }
        $this->load->view('home');
    }
}
