<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets_model');
        $this->load->model('statuses_model');
        $this->load->model('categories_model');
        $this->load->model('versions_model');
    }

    public function all()
    {
        $tickets = $this->tickets_model->get_tickets();
        $pagination = array('total' => count($tickets), 'limit' => PER_PAGE);
        $tickets = $this->paginate($tickets);

        $title = 'All Tickets';
        $this->load->view('ticket/all', compact('tickets', 'pagination', 'title'));
    }

    public function me() 
    {
        $uid = $this->session->userdata('uid');

        $this->db->where('worker', $uid);

        $tickets = $this->tickets_model->get_tickets();
        $pagination = array('total' => count($tickets), 'limit' => PER_PAGE);
        $tickets = $this->paginate($tickets);

        $title = 'My Tickets';
        $this->load->view('ticket/me', compact('tickets', 'pagination', 'title'));
    }

    public function advanced()
    {
        $users = $this->users_model->get_users();
        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();

        if($this->input->get())
        {
            $form = array(
                'author' => $this->input->get('author'),
                'worker' => $this->input->get('worker'),
                'status' => $this->input->get('status'),
                'category' => $this->input->get('category'),
                'and-author' => $this->input->get('and-author'),
                'and-worker' => $this->input->get('and-worker'),
                'and-status' => $this->input->get('and-status'),
                'and-category' => $this->input->get('and-category'),
                'created_from' => $this->input->get('created_from'),
                'createf_to' => $this->input->get('createf_to'),
                'modified_from' => $this->input->get('modified_from'),
                'modified_to' => $this->input->get('modified_to'),
                'exclude' => $this->input->get('exclude')
            );
            $tickets = $this->tickets_model->search($form);
            $pagination = array('total' => count($tickets), 'limit' => PER_PAGE);
            $tickets = $this->paginate($tickets);
        }

        $title = 'Advanced Search';
        $this->load->view('ticket/advanced', compact('tickets', 'users', 'statuses', 'categories', 'pagination', 'title'));
    }

    public function view($tid)
    {
        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();
        $ticket = $this->tickets_model->get_ticket($tid);
        $versions = $this->versions_model->get_versions($tid);
        $next_status = $this->statuses_model->get_next($ticket->sid);
        $users = $this->users_model->get_users();

        if($ticket->sid == 0)
        {
            $last_status = $this->versions_model->get_last_status($tid);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->roles_model->check_permission('ticket', 2);
            $form = $_POST;
            $this->tickets_model->set_ticket($tid, $form);

            redirect("/ticket/view/$tid");
        }

        $title = $ticket->title;
        $this->load->view('ticket/view', compact('ticket', 'versions', 'users', 'statuses', 'categories', 'next_status', 'last_status', 'title'));
    }

    public function edit($tid)
    {
        $this->load->library('form_validation');

        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();
        $ticket = $this->tickets_model->get_ticket($tid);
        $versions = $this->versions_model->get_versions($tid);

        if($ticket->author == $this->session->userdata('uid'))
        {
            $this->roles_model->check_permission('ticket', 3);
        }
        else
        {
            $this->roles_model->check_permission('ticket', 4);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('title', 'Ticket title', 'required');
            $this->form_validation->set_rules('description', 'Ticket description', 'required');
            $this->form_validation->set_rules('category', 'Ticket category', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $before = $ticket;
                $this->tickets_model->set_ticket($form);
                $after = $this->tickets_model->get_ticket($tid);
                $this->versions_model->add_version($tid, '', $before, $after);
                $ticket = $after;

                redirect("/ticket/view/$tid");
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the ticket.');
            }
        }

        $title = 'Edit Ticket';
        $this->load->view('ticket/edit', compact('ticket', 'versions', 'statuses', 'categories', 'title'));
    }

    public function create()
    {
        $this->load->library('form_validation');

        $this->roles_model->check_permission('ticket', 3);
        $categories = $this->categories_model->get_categories();
    	if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
            $this->form_validation->set_rules('title', 'Ticket title', 'required');
            $this->form_validation->set_rules('description', 'Ticket description', 'required');
            $this->form_validation->set_rules('category', 'Ticket category', 'required');

            if($this->form_validation->run() != FALSE)
            {
        		$form = $_POST;
                $form['author'] = $this->session->userdata('uid');
                $tid = $this->tickets_model->add_ticket($form);
                redirect("/ticket/view/$tid");
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the ticket.');
            }
    	}

        $title = 'New Ticket';
        $this->load->view('ticket/create', compact('categories', 'title'));
    }

    public function status()
    {
        $statuses = $this->statuses_model->get_statuses();
        if($this->input->get('status'))
        {
            $status = $this->input->get('status');
            $tickets = $this->tickets_model->get_by_status($status);
        }
        else
        {
            $tickets = $this->tickets_model->get_by_status();
        }

        $title = 'Tickets by Status';
        $this->load->view('report/status', compact('tickets', 'statuses', 'title'));
    }

    public function user()
    {
        $users = $this->users_model->get_users();

        if($this->input->get('user'))
        {
            $user = $this->input->get('user');
            $tickets = $this->tickets_model->get_by_user($user);
        }
        else
        {
            $tickets = $this->tickets_model->get_by_user();
        }

        $title = 'Tickets by User';
        $this->load->view('report/user', compact('tickets', 'users', 'title'));
    }

    public function category()
    {
        $categories = $this->categories_model->get_categories();
        if($this->input->get('category'))
        {
            $category = $this->input->get('category');
            $tickets = $this->tickets_model->get_by_category($category);
        }
        else
        {
            $tickets = $this->tickets_model->get_by_category();
        }

        $title = 'Tickets by Category';
        $this->load->view('report/category', compact('tickets', 'categories', 'title'));
    }

    public function paginate($results)
    {
        $page = $this->input->get('page');
        $offset = ($page - 1) * PER_PAGE;
        $length = PER_PAGE;
        $pages = ceil(count($results) / $length);
        if($page)
        {
            return array_slice($results, $offset, $length);

        }
        return array_slice($results, 0, $length);
    }
}
