<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('attachments_model');
        $this->load->library('form_validation');
    }

    public function details($tid)
    {
        $attachments = $this->session->flashdata('attachments');

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $aids = $this->input->post('aids');

            foreach ($aids as $aid) {
                $attachment = $this->attachments_model->get_attachment($aid);
                $data = array(
                    'title' => $this->input->post("$aid-title") ? $this->input->post("$aid-title") : $attachment->filename,
                    'description' => $this->input->post("$aid-description"),
                );
                $this->attachments_model->set_attachment($aid, $data);
            }
            
            redirect("/ticket/view/$tid");
        }
        
        $title = 'Attachment Information';
        $this->load->view('attachment/details', compact('title', 'attachments'));
    }

    public function view($aid)
    {
        $attachment = $this->attachments_model->get_attachment($aid);
        $title = $attachment->title;
        $this->load->view('attachment/view', compact('title', 'attachment'));

    }

    public function edit($cid)
    {
        $this->roles_model->check_permission('category', 2);
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->form_validation->set_rules('name', 'Attachment name', 'required');

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

        $title = 'Edit Attachment';
        $this->load->view('category/edit', compact('category', 'title'));
    }

    public function remove($tid, $aid)
    {
        $this->roles_model->check_permission('ticket', 2);
        $this->attachments_model->remove_attachment($aid);
        redirect("/ticket/edit/$tid");
    }

    public function all()
    {
        $categories = $this->categories_model->get_categories();

        $title = 'Categories';
        $this->load->view('category/all', compact('categories', 'title'));
    }

}
