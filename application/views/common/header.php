<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Campaign</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap-datepicker.min.css">    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        /*#body {
            margin: 0 15px 0 15px;
        }*/

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
        .wrapper{display: flex; justify-content: center;}
        .sidebar-section{border: 1px solid #D0D0D0; margin: 10px; box-shadow: 0 0 8px #D0D0D0;padding: 20px}
        .sidebar-section li{list-style: none;}
        a.sidebar-list {font-size: 15px; line-height: 2;font-weight: 700;}
    </style>
</head>

<body>

<div class="wrapper">
    <div class="col-md-3">
        <ul class="sidebar-section">
            <li><a href="<?=base_url();?>campaign/index" class="sidebar-list">New Campaign</a></li>
            <li><a href="<?=base_url();?>campaign/view" class="sidebar-list">View Campaigns</a></li>
            <li><a href="<?=base_url();?>campaign/invoice" class="sidebar-list">Payment Processing</a></li>            
            <li><a href="<?=base_url();?>client/index" class="sidebar-list">New Client</a></li>
            <li><a href="<?=base_url();?>client/view" class="sidebar-list">View Clients</a></li>
        </ul>
    </div>