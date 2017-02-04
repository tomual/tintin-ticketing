<?php

class Statuses_model extends CI_Model {

    public $label;
    public $description;

    public function add_status($form)
    {
        $this->label = $form['label'];
        $this->description = $form['description'];
        $this->place = $form['place'];

        $this->db->insert('statuses', $this);
    }

    public function get_statuses()
    {
        $this->db->order_by('place', 'asc');
        $query = $this->db->get('statuses');
        return $query->result();
    }

    public function get_status($sid)
    {
        $this->db->where('sid', $sid);
        $query = $this->db->get('statuses', 1);
        return $query->row();
    }

    public function set_status($form)
    {
        $this->label = $form['label'];
        $this->description = $form['description'];
        $this->place = $form['place'];
        $this->db->update('statuses', $this, array('sid' => $_POST['sid']));
    }

    public function delete_status($sid)
    {
        $this->db->where('sid', $sid);
        $this->db->delete('statuses'); 
    }

}