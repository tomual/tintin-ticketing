<?php

class Projects_model extends CI_Model {

    public $name;

    public function add_project($form)
    {
        $this->name = $form['name'];

        $this->db->insert('projects', $this);
    }

    public function get_projects()
    {
        $this->db->order_by('name', 'asc');
        $this->db->where('removed', 'N');
        $query = $this->db->get('projects');
        return $query->result();
    }

    public function get_project($pid)
    {
        $this->db->where('pid', $pid);
        $query = $this->db->get('projects', 1);
        return $query->row();
    }

    public function set_project($form)
    {
        $this->name = $_POST['name'];
        $this->db->update('projects', $this, array('pid' => $_POST['pid']));
    }

    public function remove_project($pid)
    {
        $this->db->where('pid', $pid);
        $this->db->set('removed', 'Y');
        $this->db->update('projects'); 
    }

}