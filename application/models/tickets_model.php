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

    public function set_ticket($tid, $form)
    {
        $this->load->model('statuses_model');
        $data = array();
        $before = $this->tickets_model->get_ticket($tid);
        
        // Check if need to go through multiple statuses
        if($form['status'] != -1)
        {
            $statuses = $this->statuses_model->get_statuses();
            $before_status_place = -1;
            $after_status_place = -1;
            $prerequisite_statuses = array();

            foreach ($statuses as $key => $status) {
                if($form['status'] == $status->sid)
                {
                    $after_status_place = $status->place;
                    break;
                }
                if($before_status_place != -1)
                {
                    $prerequisite_statuses[] = $status->sid;
                }
                if($before->sid == $status->sid)
                {
                    $before_status_place = $status->place;
                }
            }
            
            
            if($after_status_place - $before_status_place > 1)
            {
                foreach ($prerequisite_statuses as $sid)
                {
                    $this->db->where('tid', $tid);
                    $this->db->update('tickets', array('status' => $sid));
                    $after = $this->tickets_model->get_ticket($tid);
                    $this->versions_model->add_version($tid, $form['comment'], $before, $after);
                    $before = $after;
                }
            }
        }

        // Check if status change is invalid
        if($before->sid != $form['status'])
        {
            $from_status = $this->statuses_model->get_status($before->sid);
            $to_status = $this->statuses_model->get_status($form['status']);
            // Can't change status if cancelled
            if($from_status->sid == -1)
            {
                $form['status'] = -1;
            }
            // Can't go backwards in status
            if(!$to_status || $to_status->place < $from_status->place)
            {
                $form['status'] = $from_status->sid;
            }

        }
        
        foreach($form as $key=>$value)
        {
            if(property_exists('Tickets_model', $key))
            {
                $data[$key] = $value;
            }
        }
        $this->db->where('tid', $form['tid']);
        $this->db->update('tickets', $data);
        $after = $this->tickets_model->get_ticket($tid);
        $this->versions_model->add_version($tid, $form['comment'], $before, $after);
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

    public function get_recently_updated()
    {
        $this->db->limit(5);
        $this->db->order_by('modified', 'desc');
        return $this->get_tickets();
    }
}