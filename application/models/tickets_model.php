<?php

class Tickets_model extends CI_Model {

    public $title;
    public $description;
    public $status;
    public $category;
    public $author;

    public function add_ticket( $form )
    {
        $this->title = $form['title'];
        $this->description = $form['description'];
        $this->status = 4;
        $this->category = $form['category'];
        $this->author = 'Anonymous';

        $this->db->insert('tickets', $this);
    }

    public function get_ticket( $tid )
    {
        $this->db->where('tid', $tid);
        $query = $this->db->get('tickets', 1);
        return $query->result()->row();
    }

    public function get_tickets()
    {
        $this->db->join('users', 'author=uid', 'left');
        $this->db->join('statuses', 'status=sid', 'left');
        $this->db->order_by('tid', 'desc');
        $query = $this->db->get('tickets');
        return $query->result();
    }

    public function set_ticket( $form )
    {
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->update('tickets', $this, array('id' => $_POST['id']));
    }

}