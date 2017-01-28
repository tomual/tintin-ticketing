<?php

class Users_model extends CI_Model {

    public $username;
    public $password;
    public $email;
    public $group;

    public function login($username, $password)
    {
        $this->db->select('uid, username, password, group, email');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->limit(1);

        $user = $this->db->get()->first_row();

        if($user && password_verify($password, $user->password))
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

    public function add_user($form)
    {
        $this->username = $form['username'];
        $this->password = password_hash($form['password'], PASSWORD_DEFAULT);
        $this->email = $form['email'];
        $this->group = 1;

        $this->db->insert('users', $this);
    }
}