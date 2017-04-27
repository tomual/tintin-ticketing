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
        $this->db->where('active', 'Y');
        $query = $this->db->get('statuses');
        return $query->result();
    }

    public function get_status($sid)
    {
        $this->db->where('sid', $sid);
        $query = $this->db->get('statuses', 1);
        return $query->row();
    }

    public function get_status_by_label($label)
    {
        $this->db->where('label', $label);
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

    public function remove_status($sid)
    {
        $this->db->where('sid', $sid);
        $this->db->set('active', 'Y');
        $this->db->update('statuses'); 
    }

    public function get_next($sid)
    {
        $status = $this->get_status($sid);
        $current_place = $status->place;
        $this->db->where('active', 'Y');
        $this->db->where('place > ' . $current_place);
        $this->db->order_by('place', 'asc');
        $query = $this->db->get('statuses', 1);
        return $query->row();
    }

}