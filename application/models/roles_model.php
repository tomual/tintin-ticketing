<?php

class Roles_model extends CI_Model {

    public $label;
    public $permission_ticket;
    public $permission_user;
    public $permission_category;
    public $permission_status;
    public $permission_role;

    public function add_role($form)
    {
        $this->label = $form['label'];
        $this->permission_ticket = $form['permission_ticket'];
        $this->permission_user = $form['permission_user'];
        $this->permission_category = $form['permission_category'];
        $this->permission_status = $form['permission_status'];
        $this->permission_role = $form['permission_role'];

        $this->db->insert('roles', $this);
    }

    public function get_roles()
    {
        $this->db->order_by('label', 'asc');
        $query = $this->db->get('roles');
        return $query->result();
    }

    public function get_role($rid)
    {
        $this->db->where('rid', $rid);
        $query = $this->db->get('roles', 1);
        return $query->row();
    }

    public function set_role($form)
    {
        $this->label = $form['label'];
        $this->permission_ticket = $form['permission_ticket'];
        $this->permission_user = $form['permission_user'];
        $this->permission_category = $form['permission_category'];
        $this->permission_status = $form['permission_status'];
        $this->permission_role = $form['permission_role'];

        $this->db->update('roles', $this, array('rid' => $_POST['rid']));
    }

    public function delete_role($rid)
    {
        $this->db->where('rid', $rid);
        $this->db->delete('roles'); 
    }

}