<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categories_model');
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->categories_model->add_category($form);
            echo site_url('category/all');
            redirect(site_url('category/all'));
        }
        $this->load->view('category/create');
    }

    public function edit($cid)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $form = $_POST;
            $this->categories_model->set_category($form);
        }
        $category = $this->categories_model->get_category();
        $this->load->view('category/edit', compact('category'));
    }

    public function all()
    {
        $categories = $this->categories_model->get_categories();
        $this->load->view('category/all', compact('categories'));
    }

}
