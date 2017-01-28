<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>

<nav class="container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="/ticket/create">New Ticket</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tickets</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/ticket/all">All tickets</a>
                        <a class="dropdown-item" href="#">By Status</a>
                        <a class="dropdown-item" href="#">By User</a>
                        <a class="dropdown-item" href="#">By Category</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Custom Report</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/settings/">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                <li class="nav-item" style="float: right;">
                    <?php if($this->session->has_userdata('username')): ?>
                        <a class="nav-link" href="#"><?php echo $this->session->userdata('username') ?></a>
                    <?php else: ?>
                        <a class="nav-link" href="#">Log In</a>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
