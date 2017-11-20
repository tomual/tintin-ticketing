<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets_model');
        $this->load->model('statuses_model');
        $this->load->model('categories_model');
        $this->load->model('projects_model');
        $this->load->model('versions_model');
        $this->load->model('reports_model');
        $this->load->library('form_validation');
    }

    public function add()
    {
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $query = $this->input->post('query');
        $report_by = $this->session->userdata('uid');
        
        $rid = $this->reports_model->add_report($title, $description, $query, $report_by);
        redirect("/report/run/$rid");
    }

    public function run($rid)
    {
        $report = $this->reports_model->get_report($rid);

        $title = $report->title;
        $description = $report->description;
        $query = json_decode($report->query, true);

        $tickets = $this->tickets_model->search($query);
        $pagination = array('total' => count($tickets), 'limit' => PER_PAGE);
        $tickets = $this->paginate($tickets);

        $this->load->view('report/run', compact('tickets', 'title', 'description', 'pagination'));
    }

    public function manage()
    {        
        $reports = $this->reports_model->get_reports();

        $title = 'Reports';
        $this->load->view('report/manage', compact('reports', 'title'));
    }

    public function edit($rid)
    {
        $this->roles_model->check_permission('report', 2);

        $users = $this->users_model->get_users();
        $statuses = $this->statuses_model->get_statuses();
        $projects = $this->projects_model->get_projects();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('title', 'Report name', 'required');
            $this->form_validation->set_rules('description', 'Report description', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $data = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'query' => $this->input->post('query')
                );
                
                $this->reports_model->set_report($rid, $data);
                redirect("/report/run/$rid");
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the report.');
            }
        }

        $tickets = array();
        if($this->input->get())
        {
            $form = array(
                'author' => $this->input->get('author'),
                'worker' => $this->input->get('worker'),
                'status' => $this->input->get('status'),
                'category' => $this->input->get('category'),
                'project' => $this->input->get('project'),
                'and-author' => $this->input->get('and-author'),
                'and-worker' => $this->input->get('and-worker'),
                'and-status' => $this->input->get('and-status'),
                'and-category' => $this->input->get('and-category'),
                'and-project' => $this->input->get('and-project'),
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

        $report = $this->reports_model->get_report($rid);
        $count = count($this->reports_model->get_reports());

        $title = 'Edit Report';
        $this->load->view('report/edit', compact('report', 'count', 'tickets', 'pagination', 'title', 'users', 'statuses', 'categories', 'projects' ));
    }

    public function remove($rid)
    {
        $this->roles_model->check_permission('report', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->reports_model->remove_report($rid);
        }
        redirect(site_url('report/manage'));
    }

    public function create()
    {
        $users = $this->users_model->get_users();
        $statuses = $this->statuses_model->get_statuses();
        $categories = $this->categories_model->get_categories();
        $projects = $this->projects_model->get_projects();

        if($this->input->get())
        {
            $form = array(
                'author' => $this->input->get('author'),
                'worker' => $this->input->get('worker'),
                'status' => $this->input->get('status'),
                'category' => $this->input->get('category'),
                'project' => $this->input->get('project'),
                'and-author' => $this->input->get('and-author'),
                'and-worker' => $this->input->get('and-worker'),
                'and-status' => $this->input->get('and-status'),
                'and-category' => $this->input->get('and-category'),
                'and-project' => $this->input->get('and-project'),
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

        $title = 'Custom Report';
        $this->load->view('ticket/advanced', compact('tickets', 'users', 'statuses', 'categories', 'projects', 'pagination', 'title'));

    }

    public function all()
    {
        $tickets = $this->tickets_model->get_tickets();
        $this->load->view('report/all', compact('tickets'));
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

        $this->load->view('report/status', compact('tickets', 'statuses'));
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
        $this->load->view('report/user', compact('tickets', 'users'));
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
        $this->load->view('report/category', compact('tickets', 'categories'));
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
