<?php

class Versions_model extends CI_Model {

    public $tid;
    public $user;
    public $comment;
    public $difference;

    public function add_version($tid, $comment, $before, $after, $notify = TRUE)
    {
        $this->tid = $tid;
        $this->user = $_SESSION['uid'];
        $this->comment = $comment;

        $difference = new stdClass();
        foreach ($before as $key => $value) {
            if($before->{$key} != $after->{$key})
            {
                $difference->{$key} = array(
                    'before' => $before->{$key},
                    'after' => $after->{$key}
                );
            }
        }

        $this->difference = json_encode($difference);
        if($this->difference != '{}' || $comment)
        {
            $this->db->insert('versions', $this);
        }

        if($notify)
        {
            $this->load->model('notifications_model');
            $status = $before->sid != $after->sid ? $after->status : null;
            $this->notifications_model->notify($tid, $status, $comment);
        }
    }

    public function get_latest_version($tid)
    {
        $this->db->select('versions.*, username');
        $this->db->join('users', 'user=uid', 'left');
        $this->db->where('tid', $tid);
        $this->db->order_by('vid', 'desc');
        $query = $this->db->get('versions', 1);
        return $query->first_row();
    }

    public function get_latest_versions($limit)
    {
        $this->db->select('tid, created');
        $this->db->order_by('created', 'desc');
        $query = $this->db->get('versions', $limit);
        return $query->result();
    }

    public function get_versions($tid)
    {
        $this->db->select('versions.*, username');
        $this->db->join('users', 'user=uid', 'left');
        $this->db->where('tid', $tid);
        $this->db->order_by('vid', 'desc');
        $query = $this->db->get('versions');
        return $query->result();
    }

    public function get_last_status($tid)
    {
        $this->load->model('statuses_model');

        $this->db->where('tid', $tid);
        $this->db->like('difference', '"status":');
        $query = $this->db->get('versions', 1);
        if($query)
        {
            $version = json_decode($query->row()->difference);
            $status = $this->statuses_model->get_status_by_label($version->status->before);

            return $status;
        }
        return false;
    }
}