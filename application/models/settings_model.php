<?php

class Settings_model extends CI_Model {

    public $group_name;
    public $owner;
    public $start_status;
    public $end_status;
    public $css;
    public $register_open;

    public function get_settings()
    {
        $this->db->limit(1);
        $query = $this->db->get('settings');
        return $query->first_row();
    }

    public function set_settings($form)
    {
        $this->group_name = $form['group_name'];
        $this->owner = $form['owner'];
        $this->start_status = $form['start_status'];
        $this->end_status = $form['end_status'];
        $this->css = $form['css'];
        $this->register_open = $form['register_open'];

        $this->db->where('id', 1);
        $this->db->update('settings', $this);
    }
}