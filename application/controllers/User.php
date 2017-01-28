<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->users_model->add_user($form);
            redirect(base_url());
        }
        $this->load->view('user/create');
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $username = $form['username'];
            $password = $form['password'];
            if($login = $this->users_model->login($username, $password))
            {
                $data = array(
                    'username'  => $login->username,
                    'email'     => $login->email,
                    'group'     => $login->group,
                    'authenticated' => TRUE
                );

                $this->session->set_userdata($data);
            }
        }
        $this->load->view('user/login');
    }

    public function logout($username, $password)
    {
        session_destroy();
    }
}
