<?php

class Tickets_model extends CI_Model {

    public $title;
    public $description;
    public $status;
    public $category;
    public $project;
    public $author;
    public $started;
    public $completed;
    public $worker;

    public function add_ticket($form)
    {
        $this->load->model('settings_model');
        $this->load->model('attachments_model');
        $this->title = $form['title'];
        $this->description = $form['description'];
        $this->status = $this->settings_model->get_setting('start_status');
        $this->category = $form['category'];
        $this->project = $form['project'];
        $this->author = $form['author'];    


        $this->db->insert('tickets', $this);

        $tid = $this->db->insert_id();

        if(isset($form['attachments']))
        {
            foreach ($form['attachments'] as $attachment) {
                $data = array(
                    'tid' => $tid,
                    'filename' => $attachment['file_name'],
                    'title' => null,
                    'description' => null,
                    'upload_by' => $this->session->userdata('uid')
                );
                $this->attachments_model->add_attachment($data);
            }
        }

        return $tid;
    }

    public function get_ticket($tid)
    {
        $uid = $this->session->userdata('uid');
        $this->db->select('tickets.tid, tickets.title, tickets.created, tickets.description, tickets.description, tickets.started, tickets.completed');
        $this->db->select('a.username as author');
        $this->db->select('w.username as worker, w.uid as uid');
        $this->db->select('s.label as status, s.sid');
        $this->db->select('c.name as category, c.cid');
        $this->db->select('p.name as project, p.pid');
        $this->db->where('tickets.tid', $tid);
        $this->db->join('users as a', 'author=a.uid', 'left');
        $this->db->join('users as w', 'worker=w.uid', 'left');
        $this->db->join('statuses s', 'status=sid', 'left');
        $this->db->join('categories c', 'category=cid', 'left');
        $this->db->join('projects p', 'project=pid', 'left');
        if($uid)
        {
            $this->db->select('n.nid as subscribed');
            $this->db->join('notifications n', 'n.tid=tickets.tid AND n.uid=' . $uid, 'left');
        }

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

    public function get_kanban_tickets()
    {        
        $kanban_statuses = $this->settings_model->get_setting('kanban_statuses');

        if(!$kanban_statuses)
        {
            return null;
        }

        $kanban_statuses = explode(',', $kanban_statuses);

        $this->db->select('tickets.tid, tickets.title, tickets.status, tickets.category, statuses.label, worker, username, tickets.created, sid, versions.modified');
        $this->db->where_in('tickets.status', $kanban_statuses);
        $this->db->join('users', 'author=uid', 'left');
        $this->db->join('statuses', 'status=sid', 'left');
        $this->db->join('(select tid, created as modified from versions order by created desc limit 1) versions', 'tickets.tid=versions.tid', 'left');
        $this->db->order_by('tickets.created', 'desc');

        $query = $this->db->get('tickets');
        $result = $query->result();

        $kanban_tickets = array();
        foreach ($kanban_statuses as $sid) {
            $status = $this->statuses_model->get_status($sid);
            $kanban_tickets[$status->label] = array();
        }
        foreach ($result as $ticket) {
            $kanban_tickets[$ticket->label][] = $ticket;
        }

        return $kanban_tickets;
    }

    public function set_ticket($tid, $form)
    {
        $this->load->model('statuses_model');
        $data = array();
        $before = $this->tickets_model->get_ticket($tid);

        $form['comment'] = !empty($form['comment']) ? $form['comment'] : null;

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
                    $data = array('status' => $sid);

                    $start_status = $this->settings_model->get_setting('work_start_status');
                    if($sid == $start_status)
                    {
                        $data['started'] = date("Y-m-d H:i:s");
                    }

                    $this->db->where('tid', $tid);
                    $this->db->update('tickets', $data);
                    $after = $this->tickets_model->get_ticket($tid);
                    $this->versions_model->add_version($tid, $form['comment'], $before, $after, FALSE);
                    $before = $after;
                }
            }
        }

        $from_status = $this->statuses_model->get_status($before->sid);
        $to_status = $this->statuses_model->get_status($form['status']);

        // Check if status change is invalid
        if($before->sid != $form['status'])
        {
            // Can't change status if cancelled
            if($from_status->sid == -1)
            {
                $form['status'] = -1;
            }
        }

        // Check if start date or complete date need to be unset due to status going backwards
        // if($to_status || ( $to_status->sid != -1 && $to_status->place < $from_status->place ) )
        // {
        //     $form['status'] = $from_status->sid;
        // }

        // Check if ticket should be set to started
        $start_status = $this->settings_model->get_setting('work_start_status');
        if($before->sid != $form['status'] && $form['status'] == $start_status)
        {
            $form['started'] = date("Y-m-d H:i:s");
        }

        // Check if ticket should be set to completed
        $complete_status = $this->settings_model->get_setting('work_complete_status');
        if($form['status'] == $complete_status)
        {
            $form['completed'] = date("Y-m-d H:i:s");
        }



        foreach($form as $key=>$value)
        {
            if(property_exists('Tickets_model', $key))
            {
                $data[$key] = $value;
            }
        }

        $this->db->where('tid', $tid);
        $this->db->update('tickets', $data);
        $after = $this->tickets_model->get_ticket($tid);
        $this->versions_model->add_version($tid, $form['comment'], $before, $after);

        if(!empty($form['attachments']))
        {
            foreach ($form['attachments'] as $attachment) {
                if(!empty($attachment->aid))
                {
                    continue;
                }
                $data = array(
                    'tid' => $tid,
                    'title' => $attachment['orig_name'],
                    'filename' => $attachment['file_name'],
                    'title' => null,
                    'description' => null,
                    'upload_by' => $this->session->userdata('uid')
                );
                $this->attachments_model->add_attachment($data);
            }
        }
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

    public function get_by_project($pid = NULL)
    {
        if($pid)
        {
            $this->db->where('project', $pid);
        }
        $this->db->order_by('project', 'asc');
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

    public function search($form)
    {

        $exclude = !empty($form['exclude']) ? $form['exclude'] : array();
        if(!empty($form['author']))
        {
            if( !in_array('author', $exclude ))
            {
                $this->db->where_in('author', $form['author']);
            }
            else
            {
                $this->db->where_not_in('author', $form['author']);
            }
            if(!empty($form['and-author']))
            {
                $this->db->where_in('author', $form['author_and']);
            }
        }
        if(!empty($form['worker']))
        {
            if( !in_array('worker', $exclude ))
            {
                $this->db->where_in('worker', $form['worker']);
            }
            else
            {
                $this->db->where_not_in('worker', $form['worker']);
            }
            if(!empty($form['and-worker']))
            {
                $this->db->where_in('worker', $form['worker_and']);
            }
        }

        if(!empty($form['status']))
        {
            if( !in_array('status', $exclude ))
            {
                $this->db->where_in('status', $form['status']);
            }
            else
            {
                $this->db->where_not_in('status', $form['status']);
            }
            if(!empty($form['and-status']))
            {
                $this->db->where_in('status', $form['status_and']);
            }
        }

        if(!empty($form['category']))
        {
            if( !in_array('category', $exclude ))
            {
                $this->db->where_in('category', $form['category']);
            }
            else
            {
                $this->db->where_not_in('category', $form['category']);
            }
            if(!empty($form['and-category']))
            {
                $this->db->where_in('category', $form['category_and']);
            }
        }

        if(!empty($form['project']))
        {
            if( !in_array('project', $exclude ))
            {
                $this->db->where_in('project', $form['project']);
            }
            else
            {
                $this->db->where_not_in('project', $form['project']);
            }
            if(!empty($form['and-project']))
            {
                $this->db->where_in('project', $form['project_and']);
            }
        }

        if(!empty($form['created_from']))
        {
            $created_from = date('Y-m-d', strtotime($created_from));
            if(!empty($form['created_to']))
            {
                $created_to = date('Y-m-d', strtotime($created_to));
                $this->db->where("tickets.created BETWEEN '$created_from' AND '$created_to'");
            }
            else
            {
                $created_to = date('Y-m-d', strtotime($created_from . '+1 day'));
                $this->db->where("created BETWEEN '$created_from' AND '$created_to'");
            }
        }

        if(!empty($form['modified_from']))
        {
            $modified_from = date('Y-m-d', strtotime($modified_from));
            if(!empty($form['modified_to']))
            {
                $modified_to = date('Y-m-d', strtotime($modified_to));
                $this->db->where("modified BETWEEN '$modified_from' AND '$modified_to'");
            }
            else
            {
                $modified_to = date('Y-m-d', strtotime($modified_from . '+1 day'));
                $this->db->where("modified BETWEEN '$modified_from' AND '$modified_to'");
            }
        }

        return $this->tickets_model->get_tickets();
    }
}