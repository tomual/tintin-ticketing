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
        $this->roles_model->check_permission('role', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->roles_model->add_role($form);
            echo site_url('role/all');
            redirect(site_url('role/all'));
        }
        $this->load->view('role/create');
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
        $this->load->view('role/edit', compact('role'));
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
        $this->load->view('role/all', compact('roles'));
    }

}
