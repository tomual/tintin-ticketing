<?php

class Tickets_model extends CI_Model {

    public $title;
    public $description;
    public $status;
    public $category;
    public $author;
    public $worker;

    public function add_ticket($form)
    {
        $this->load->model('settings_model');
        $this->title = $form['title'];
        $this->description = $form['description'];
        $this->status = $this->settings_model->get_setting('start_status');
        $this->category = $form['category'];
        $this->author = $form['author'];

        $this->db->insert('tickets', $this);
        return $this->db->insert_id();
    }

    public function get_ticket($tid)
    {
        $this->db->select('tid, title, tickets.created, a.username as author, w.username as worker, w.uid as uid, tickets.description, label as status, categories.name as category, sid, cid');
        $this->db->where('tid', $tid);
        $this->db->join('users as a', 'author=a.uid', 'left');
        $this->db->join('users as w', 'worker=w.uid', 'left');
        $this->db->join('statuses', 'status=sid', 'left');
        $this->db->join('categories', 'category=cid', 'left');

        $query = $this->db->get('tickets', 1);
        return $query->row();
    }

    public function get_tickets()
    {
        $this->db->select('tickets.tid, tickets.title, tickets.status, tickets.category, statuses.label, worker, username, tickets.created, sid, versions.modified');
        $this->db->where('status != 0');
        $this->db->join('users', 'author=uid', 'left');
        $this->db->join('statuses', 'status=sid', 'left');
        $this->db->join('(select tid, created as modified from versions order by created desc limit 1) versions', 'tickets.tid=versions.tid', 'left');
        $this->db->order_by('tickets.created', 'desc');

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

    public function group_by_status()
    {
        $this->db->select('status, label, COUNT(*) as count');
        $this->db->group_by('status');
        $this->db->join('statuses', 'status=sid');
        $query = $this->db->get('tickets');
        return $query->result();
    }
}