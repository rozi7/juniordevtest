<!DOCTYPE html>
<html lang="id">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Junior Dev Test</title>
    
    <!-- jQuery -->
    <script src="<?php echo url();?>js/jquery.min.js"></script>
    
    
    <!-- Bootstrap -->
    <link href="<?php echo url();?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo url();?>css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo url();?>css/nprogress.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo url();?>css/select2.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo url();?>css/iCheck-green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo url();?>css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url();?>css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url();?>css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url();?>css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo url();?>css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo url();?>css/daterangepicker.css" rel="stylesheet">    
    <!-- Switchery -->
    <link href="<?php echo url();?>css/switchery.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo url();?>css/custom.css" rel="stylesheet">
    <link href="<?php echo url();?>css/admin.css" rel="stylesheet">
    
    <script src="<?php echo url();?>js/lodash.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo url();?>js/select2.full.min.js"></script>
  </head>

  <body class="nav-sm">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo url('home');?>" class="site_title text-center">
                <b>JDT</b>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3></h3>
                <div class="clear"></div>
                <ul class="nav side-menu">
                  <li><a href="<?php echo url('register');?>"><i class="fa fa-user"></i> Register</a></li>
                  <li><a href="<?php echo url('produk');?>"><i class="fa fa-box"></i> Produk</a></li>
                  <li><a><i class="fa fa-list-alt"></i> Sales <span class="fa fa-chevron-down"></span></a><ul class="nav child_menu">
                      <li><a href="<?php echo url('sales');?>">View Sales</a></li>
                      <li><a href="<?php echo url('sales_list');?>">Sales List</a></li>
                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php //echo $app->sess->nama; ?> &nbsp;
                    <img src="<?php echo url();?>img/img.png" alt="">
                    <span class=" fa fa-angle-down"></span>
                  </a
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div>
            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo url();?>" />