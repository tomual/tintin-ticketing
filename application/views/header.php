<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/datepicker.css">
    <style type="text/css">
        <?php echo $this->css ?>
    </style>

</head>
<body>

<nav>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="/" class="nav-link logo"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Tintin</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tickets</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/ticket/create">New ticket</a>
                        <a class="dropdown-item" href="/ticket/all">All tickets</a>
                        <a class="dropdown-item" href="/ticket/status">By Status</a>
                        <a class="dropdown-item" href="/ticket/user">By User</a>
                        <a class="dropdown-item" href="/ticket/category">By Category</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/ticket/advanced">Advanced Search</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Settings</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/status/all">Statuses</a>
                        <a class="dropdown-item" href="/category/all">Categories</a>
                        <a class="dropdown-item" href="/user/all">Users</a>
                        <a class="dropdown-item" href="/role/all">Roles</a>
                        <a class="dropdown-item" href="/settings/">System</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                    <?php if($this->session->has_userdata('username')): ?>
                    <li class="nav-item dropdown" style="float: right;">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('username') ?></a>
                        <div class="dropdown-menu user-nav">
                            <a class="dropdown-item" href="/tickets/me">My Tickets</a>
                            <a class="dropdown-item" href="/user/edit">Account</a>
                            <a class="dropdown-item" href="/logout/">Log Out</a>
                        </div>
                    </li>
                    <?php else: ?>                                
                        <li class="nav-item" style="float: right;">
                                <a class="nav-link" href="/login"0/>Log In</a>
                        </li>
                    <?php endif ?>
            </ul>
        </div>
    </div>
    </div>   
</nav>

<div class="container">
    <div class="row">
