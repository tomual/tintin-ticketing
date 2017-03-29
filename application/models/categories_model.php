<?php

class Categories_model extends CI_Model {

    public $name;

    public function add_category($form)
    {
        $this->name = $form['name'];

        $this->db->insert('categories', $this);
    }

    public function get_categories()
    {
        $this->db->order_by('name', 'asc');
        $this->db->where('removed', 'N');
        $query = $this->db->get('categories');
        return $query->result();
    }

    public function get_category($cid)
    {
        $this->db->where('cid', $cid);
        $query = $this->db->get('categories', 1);
        return $query->row();
    }

    public function set_category($form)
    {
        $this->name = $_POST['name'];
        $this->db->update('categories', $this, array('cid' => $_POST['cid']));
    }

    public function remove_category($cid)
    {
        $this->db->where('cid', $cid);
        $this->db->set('removed', 'Y');
        $this->db->update('categories'); 
    }

}