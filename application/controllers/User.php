<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $users = $this->users_model->get_users();
        $this->load->view('user/all', compact('users'));
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
                    'uid'       => $login->uid,
                    'username'  => $login->username,
                    'email'     => $login->email,
                    'role'     => $login->role,
                    'authenticated' => TRUE
                );

                $this->session->set_userdata($data);
                redirect($_SERVER['HTTP_REFERRER']);
            }
        }
        $this->load->view('user/login');
    }

    public function logout()
    {
        session_destroy();
        redirect($_SERVER['HTTP_REFERRER']);
    }

    public function edit($uid)
    {
        $this->roles_model->check_permission('user', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->users_model->set_user($form);
            redirect(site_url('user/all'));
        }
        $user = $this->users_model->get_user($uid);
        $roles = $this->roles_model->get_roles();
        $this->load->view('user/edit', compact('user', 'roles'));
    }
}
