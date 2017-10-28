<?php

class Reports_model extends CI_Model {

    public $title;
    public $query;
    public $report_by;

    public function get_reports()
    {
        $query = $this->db->get('reports');
        return $query->result();
    }

    public function get_report($rid)
    {
        $this->db->where('rid', $rid);
        $query = $this->db->get('reports');
        return $query->first_row();
    }

    public function add_report($title, $description, $query, $report_by)
    {
        $this->db->insert('reports', compact('title', 'description', 'query', 'report_by'));
        return $this->db->insert_id();
    }

    public function set_report($rid, $data)
    {
        $this->db->where('rid', $rid);
        $this->db->update('reports', $data);
    }

    public function remove_report($rid)
    {
        $this->db->where('rid', $rid);
        $this->db->delete('reports'); 
    }
}