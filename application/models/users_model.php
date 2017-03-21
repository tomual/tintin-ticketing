<?php

class Users_model extends CI_Model {

    public $username;
    public $password;
    public $email;
    public $role;
    public $reset_token;
    public $reset_token_expire;

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

    public function get_user($uid)
    {
        $this->db->where('uid', $uid);
        $query = $this->db->get('users', 1);
        $row = $query->row();

        $this->username = $row->username;
        $this->password = $row->password;
        $this->email = $row->email;
        $this->role = $row->role;

        return $row;
    }

    public function set_user($form)
    {
        $this->get_user($form['uid']);
        foreach ($form as $key => $value) {
            if(property_exists($this, $key))
            {
                if($key == 'password')
                {
                    $value = password_hash($value, PASSWORD_DEFAULT);
                }
                $this->{$key} = $value;
            }
        }

        $this->db->update('users', $this, array('uid' => $form['uid']));
    }

    public function get_uid_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users', 1);
        $row = $query->row();
        return $row->uid;
    }

    public function get_user_by_token($token)
    {
        $this->db->where('reset_token', $token);
        $query = $this->db->get('users', 1);
        $row = $query->row();
        return $row;
    }
}