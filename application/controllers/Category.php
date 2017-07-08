<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->library('form_validation');
    }

    public function create()
    {
        $this->roles_model->check_permission('category', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('name', 'Category name', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $this->categories_model->add_category($form);
                echo site_url('category/all');
                redirect(site_url('category/all'));
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the category.');
            }
        }

        $title = 'New Category';
        $this->load->view('category/create', compact('title'));
    }

    public function edit($cid)
    {
        $this->roles_model->check_permission('category', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('name', 'Category name', 'required');

            if($this->form_validation->run() != FALSE)
            {
                $form = $_POST;
                $this->categories_model->set_category($form);
                redirect(site_url('category/all'));
            }
            else
            {
                $this->session->set_flashdata('error', 'There are errors in the category.');
            }
        }
        $category = $this->categories_model->get_category($cid);

        $title = 'Edit Category';
        $this->load->view('category/edit', compact('category', 'title'));
    }

    public function remove($cid)
    {
        $this->roles_model->check_permission('category', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->categories_model->remove_category($cid);
        }
        redirect(site_url('category/all'));
    }

    public function all()
    {
        $categories = $this->categories_model->get_categories();

        $title = 'Categories';
        $this->load->view('category/all', compact('categories', 'title'));
    }

}
