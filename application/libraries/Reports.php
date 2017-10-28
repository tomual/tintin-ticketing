<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports {

    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
            // Assign the CodeIgniter super-object
            $this->CI =& get_instance();
    }

    public function get_reports()
    {
    	$this->CI->load->model('reports_model');
    	$reports = $this->CI->reports_model->get_reports();

    	return $reports;
    }
}