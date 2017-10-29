<?php

class Attachments_model extends CI_Model {

    public $tid;
    public $filename;
    public $title;
    public $description;
    public $upload_by;

    public function add_attachment($form)
    {
        $this->tid = $form['tid'];
        $this->filename = $form['filename'];
        $this->title = $form['original'];
        $this->title = $form['title'];
        $this->description = $form['description'];
        $this->upload_by = $form['upload_by'];

        $supported_image = array('gif', 'jpg', 'jpeg', 'png');
        $ext = strtolower(pathinfo($this->filename, PATHINFO_EXTENSION));
        if (in_array($ext, $supported_image))
        {
            $this->is_image = 'Y';
        }

        $this->db->insert('attachments', $this);
    }

    public function set_attachment($aid, $form)
    {
        $this->db->update('attachments', $form, compact('aid'));
    }

    public function get_attachments($tid)
    {
        $this->db->order_by('date', 'asc');
        $this->db->where('tid', $tid);
        $query = $this->db->get('attachments');
        return $query->result();
    }

    public function get_attachment($aid)
    {
        $this->db->where('aid', $aid);
        $query = $this->db->get('attachments', 1);
        return $query->row();
    }

    public function remove_attachment($aid)
    {
        $this->db->where('aid', $aid);
        $this->db->delete('attachments'); 
    }

}