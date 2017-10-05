<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo empty($title) ? '' : $title . ' | ' ?>Tintin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/toggle-switch.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/style.css">
    <style type="text/css">
        <?php echo $this->css ?>
    </style>

</head>
<body>

<nav class="header">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>" class="nav-link logo"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Tintin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>ticket/create">New ticket</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url() ?>" role="button" aria-haspopup="true" aria-expanded="false">Tickets</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url() ?>ticket/all">All tickets</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>ticket/status">By Status</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>ticket/user">By User</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>ticket/category">By Category</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url() ?>ticket/advanced">Advanced Search</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url() ?>" role="button" aria-haspopup="true" aria-expanded="false">Settings</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url() ?>status/all">Statuses</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>category/all">Categories</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>user/all">Users</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>role/all">Roles</a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>settings/">System</a>
                    </div>
                </li>
                    <?php if($this->session->has_userdata('username')): ?>
                    <li class="nav-item dropdown" style="float: right;">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url() ?>" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('username') ?></a>
                        <div class="dropdown-menu user-nav">
                            <a class="dropdown-item" href="<?php echo base_url() ?>ticket/me">My Tickets</a>
                            <a class="dropdown-item" href="<?php echo base_url() ?>user/edit">Account</a>
                            <a class="dropdown-item" href="<?php echo base_url() ?>logout/">Log Out</a>
                        </div>
                    </li>
                    <?php else: ?>                                
                        <li class="nav-item" style="float: right;">
                                <a class="nav-link" href="<?php echo base_url() ?>login"0/>Log In</a>
                        </li>
                    <?php endif ?>
            </ul>
        </div>
    </div>
    </div>   
</nav>

<div class="container">
    <div class="row">
