<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('roles_model');
    }

    public function create()
    {        
        $this->load->library('form_validation');

        $this->roles_model->check_permission('role', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('label', 'Role label', 'required');
            $this->form_validation->set_rules('permission_ticket', 'Ticket permission', 'required');
            $this->form_validation->set_rules('permission_category', 'Category permission', 'required');
            $this->form_validation->set_rules('permission_status', 'Status permission', 'required');
            $this->form_validation->set_rules('permission_user', 'User permission', 'required');
            $this->form_validation->set_rules('permission_role', 'Role permission', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $this->roles_model->add_role($form);
                echo site_url('role/all');
                redirect(site_url('role/all'));
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the role.');
            }
        }

        $title = 'New Role';
        $this->load->view('role/create', compact('role', 'title'));
    }

    public function edit($cid)
    {
        $this->roles_model->check_permission('role', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
        echo $form;
            $this->roles_model->set_role($form);
            redirect(site_url('role/all'));
        }
        $role = $this->roles_model->get_role($cid);

        $title = 'Edit Role';
        $this->load->view('role/edit', compact('role', 'title'));
    }

    public function remove($cid)
    {
        $this->roles_model->check_permission('role', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->roles_model->delete_role($cid);
        }
        redirect(site_url('role/all'));
    }

    public function all()
    {
        $roles = $this->roles_model->get_roles();

        $title = 'Roles';
        $this->load->view('role/all', compact('roles', 'title'));
    }

}
