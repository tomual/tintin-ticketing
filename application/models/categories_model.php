<?php

class Categories_model extends CI_Model {

    public $name;

    public function add_category( $form )
    {
        $this->name = $form['name'];

        $this->db->insert('categories', $this);
    }

    public function get_categories()
    {
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('categories');
        return $query->result();
    }

    public function set_category( $form )
    {
        $this->label    = $_POST['label'];
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->update('categories', $this, array('id' => $_POST['id']));
    }

}