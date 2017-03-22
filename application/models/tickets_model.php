<?php

class Tickets_model extends CI_Model {

    public $title;
    public $description;
    public $status;
    public $category;
    public $author;

    public function add_ticket($form)
    {
        $this->title = $form['title'];
        $this->description = $form['description'];
        $this->status = 4;
        $this->category = $form['category'];
        $this->author = 'Anonymous';

        $this->db->insert('tickets', $this);
    }

    public function get_ticket($tid)
    {
        $this->db->select('tid, title, tickets.created, username as author, tickets.description, label as status, categories.name as category, sid, cid');
        $this->db->where('tid', $tid);
        $this->db->join('users', 'author=uid', 'left');
        $this->db->join('statuses', 'status=sid', 'left');
        $this->db->join('categories', 'category=cid', 'left');
        $query = $this->db->get('tickets', 1);
        return $query->row();
    }

    public function get_tickets()
    {
        $this->db->join('users', 'author=uid', 'left');
        $this->db->join('statuses', 'status=sid', 'left');
        $this->db->order_by('tid', 'desc');
        $query = $this->db->get('tickets');
        return $query->result();
    }

    public function set_ticket($form)
    {
        $data = array();
        foreach($form as $key=>$value)
        {
            if(property_exists('Tickets_model', $key))
            {
                $data[$key] = $value;
            }
        }
        $this->db->where('tid', $form['tid']);
        $this->db->update('tickets', $data);
    }

    public function get_by_status($sid = NULL)
    {
        if($sid)
        {
            $this->db->where('sid', $sid);
        }
        $this->db->order_by('sid', 'asc');
        return $this->get_tickets();
    }

    public function get_by_user($uid = NULL)
    {
        if($uid)
        {
            $this->db->where('author', $uid);
        }
        $this->db->order_by('author', 'asc');
        return $this->get_tickets();
    }

    public function get_by_category($cid = NULL)
    {
        if($cid)
        {
            $this->db->where('category', $cid);
        }
        $this->db->order_by('category', 'asc');
        return $this->get_tickets();
    }
}