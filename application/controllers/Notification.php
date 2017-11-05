<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('notifications_model');
    }

    public function subscribe($tid)
    {
        $uid = $this->session->userdata('uid');
        $this->notifications_model->subscribe($tid, $uid);
        $this->session->set_flashdata('subscribed', TRUE);
        redirect("/ticket/view/$tid");
    }

    public function unsubscribe($tid)
    {
        $uid = $this->session->userdata('uid');
        $this->notifications_model->unsubscribe($tid, $uid);
        $this->session->set_flashdata('unsubscribed', TRUE);
        redirect("/ticket/view/$tid");
    }

}
