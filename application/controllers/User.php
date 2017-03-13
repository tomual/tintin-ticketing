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

    public function forgot_password()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = array(
                'uid' => $this->users_model->get_uid_by_email($this->input->post('email')),
                'reset_token' => uniqid(),
                'reset_token_expire' => date('y-m-d h:i:a', strtotime('+6 hours'))
            );
            $this->users_model->set_user($data);
            $this->load->view('user/forgot_sent');
            return;
        }
        $this->load->view('user/forgot');
    }

    public function reset_password($token)
    {
        $user = $this->users_model->get_user_by_token($token);
        if(!empty($user) && (strtotime('now') < strtotime($user->reset_token_expire)))
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $data = array(
                    'uid' => $user->uid,
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                );
                $this->users_model->set_user($data);
                redirect('/login');
            }
            $this->load->view('user/forgot_reset', array('email' => $user->email));
            return;
        }
        $this->load->view('user/forgot_expired');
    }
}
