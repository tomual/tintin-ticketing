<?php

class Statuses_model extends CI_Model {

    public $label;
    public $description;
    public $creator;

    public function add_status( $form )
    {
        $this->label = $form['label'];
        $this->description = $form['description'];
        $this->creator = 'Anonymous';

        $this->db->insert('statuses', $this);
    }

    public function get_statuses()
    {
        $this->db->order_by('place', 'asc');
        $query = $this->db->get('statuses');
        return $query->result();
    }

    public function set_status( $form )
    {
        $this->label    = $_POST['label'];
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->update('statuses', $this, array('id' => $_POST['id']));
    }

}