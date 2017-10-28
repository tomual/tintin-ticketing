<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

if(! function_exists('report_query_to_url')){

    function report_query_to_url($rid, $query){
    	$url = base_url() . "report/edit/$rid?";
    	$url .= http_build_query(json_decode($query, true));
    	$url = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $url);
    	// $url = preg_replace('/%C2%AC/simU', '&not', $url);

    	return $url;
    }

}