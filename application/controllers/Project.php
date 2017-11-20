<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->library('form_validation');
    }

    public function create()
    {
        $this->roles_model->check_permission('project', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('name', 'Project name', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $this->projects_model->add_project($form);
                echo site_url('project/all');
                redirect(site_url('project/all'));
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the project.');
            }
        }

        $title = 'New Project';
        $this->load->view('project/create', compact('title'));
    }

    public function edit($cid)
    {
        $this->roles_model->check_permission('project', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('name', 'Project name', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $this->projects_model->set_project($form);
                redirect(site_url('project/all'));
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the project.');
            }
        }
        $project = $this->projects_model->get_project($cid);

        $title = 'Edit Project';
        $this->load->view('project/edit', compact('project', 'title'));
    }

    public function remove($cid)
    {
        $this->roles_model->check_permission('project', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->projects_model->remove_project($cid);
        }
        redirect(site_url('project/all'));
    }

    public function all()
    {
        $projects = $this->projects_model->get_projects();

        $title = 'Categories';
        $this->load->view('project/all', compact('projects', 'title'));
    }

}
