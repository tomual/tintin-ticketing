<?php

class Users_model extends CI_Model {

    public $username;
    public $password;
    public $email;
    public $role;

    public function login($username, $password)
    {
        $this->db->select('uid, username, password, role, email');
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

    public function get_users()
    {        
        $this->db->order_by('created', 'asc');
        $this->db->join('roles', 'roles.rid=users.role');
        $query = $this->db->get('users');
        return $query->result();
    }
}