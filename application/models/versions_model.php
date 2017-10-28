<?php

class Versions_model extends CI_Model {

    public $tid;
    public $user;
    public $comment;
    public $difference;

    public function add_version( $tid, $comment, $before, $after )
    {
        $this->tid = $tid;
        $this->user = $_SESSION['uid'];
        $this->comment = $comment;

        $difference = new stdClass();
        foreach ($before as $key => $value) {
            if($before->{$key} != $after->{$key})
            {
                if($key != 'sid' && $key != 'cid')
                {
                    $difference->{$key} = array(
                        'before' => $before->{$key},
                        'after' => $after->{$key}
                    );                    
                }
            }
        }

        $this->difference = json_encode($difference);
        if($this->difference != '{}')
        {
            $this->db->insert('versions', $this);
        }
    }

    public function get_version( $tid )
    {
        $this->db->select('tid, title, versions.created, username as author, versions.description, label as status, categories.name as category, sid, cid');
        $this->db->where('tid', $tid);
        $this->db->join('users', 'author=uid', 'left');
        $this->db->join('statuses', 'status=sid', 'left');
        $this->db->join('categories', 'category=cid', 'left');
        $query = $this->db->get('versions', 1);
        return $query->row();
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