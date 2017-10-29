<?php

class Notifications_model extends CI_Model {

    public $tid;
    public $uid;

    public function subscribe($tid, $uid)
    {
        $this->tid = $tid;
        $this->uid = $uid;

        $this->db->insert('notifications', $this);
    }

    public function unsubscribe($tid, $uid)
    {
        $this->db->where('tid', $tid);
        $this->db->where('uid', $uid);
        $this->db->delete('notifications'); 
    }

    public function get_subscribed($tid)
    {
        $this->db->select('nid, tid, username, email');
        $this->db->where('tid', $tid);
        $this->db->join('users', 'notifications.uid = users.uid', 'left');
        return $this->db->get('notifications')->result(); 
    }

    public function notify($tid, $status = null, $comment = null)
    {
        $this->load->library('email');
        $this->load->model('tickets_model');
        $this->load->model('versions_model');

        $subscibers = $this->get_subscribed($tid);

        $ticket = $this->tickets_model->get_ticket($tid);
        $version = $this->versions_model->get_latest_version($tid);

        foreach ($subscibers as $subscriber) {
            if($status)
            {
                $this->email->from('noreply@localhost', 'Tintin Mailer');
                $this->email->to($subscriber->email);

                $this->email->subject("[STATUS] {$ticket->status} - {$ticket->title}");

                $this->email->message($this->load->view('email/ticket', compact('ticket', 'version'), TRUE));

                $this->email->send();
            }

            if($comment)
            {
                $this->email->from('noreply@localhost', 'Tintin Mailer');
                $this->email->to($subscriber->email);

                $preview = substr($comment, 0, 50) . '...';

                $this->email->subject("[COMMENT] \"{$preview}\" - {$ticket->title}");

                $this->email->message($this->load->view('email/ticket', compact('ticket', 'version'), TRUE));

                $this->email->send();
            }
        }


    }

}