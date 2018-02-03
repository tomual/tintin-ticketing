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

        $title = 'Users';
        $this->load->view('user/all', compact('users', 'title'));
    }

    public function create()
    {
        $this->load->library('form_validation');

        $first_user = empty($this->users_model->get_users());
        if(!$first_user)
        {
            $this->roles_model->check_permission('user', 2);
        }

        $roles = $this->roles_model->get_roles();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|min_length[6]|matches[password]');
            $this->form_validation->set_rules('role', 'Role', 'required|numeric');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $this->users_model->add_user($form);

                if($first_user)
                {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $login = $this->users_model->login($username, $password);
                    $data = array(
                        'uid'       => $login->uid,
                        'username'  => $login->username,
                        'email'     => $login->email,
                        'role'     => $login->role,
                        'authenticated' => TRUE
                    );

                    $this->session->set_userdata($data);
                    redirect('/');
                }
                else
                {
                    $this->all();
                    return;
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the user.');
            }
        }

        $title = 'New User';
        $this->load->view('user/create', compact('roles', 'title'));
    }

    public function login()
    {
        $this->load->library('form_validation');

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if($this->form_validation->run() != FALSE)
            {
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
                else
                {
                    $this->session->set_flashdata('error', 'Invalid login.');
                }
            }
        }

        $title = 'Log In';
        $this->load->view('user/login', compact('roles', 'title'));
    }

    public function logout()
    {
        session_destroy();
        redirect($_SERVER['HTTP_REFERRER']);
    }

    public function edit($uid = NULL)
    {
        if(empty($uid) && $this->session->userdata('uid'))
        {
            $uid = $this->session->userdata('uid');
        }
        elseif(empty($uid))
        {
            show_404();
        }
        else
        {
            $this->roles_model->check_permission('user', 2);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->users_model->set_user($form);
            redirect(site_url('user/all'));
        }
        $user = $this->users_model->get_user($uid);
        $roles = $this->roles_model->get_roles();

        $title = 'Edit User';
        $this->load->view('user/edit', compact('user', 'roles', 'title'));
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

        $title = 'Forgot Password';
        $this->load->view('user/forgot', compact('title'));
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

            $title = 'Reset Password';
            $this->load->view('user/forgot_reset', array('email' => $user->email, 'title' => $title));
            return;
        }

        $title = 'Token Expired';
        $this->load->view('user/forgot_expired', compact('title'));
    }
}
