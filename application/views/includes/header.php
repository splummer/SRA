<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo ( isset( $title ) ) ? $title.' Squirrel Registration Authority' : 'Squirrel Registration Authority' ; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?php echo asset_url();?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>css/bootstrap-responsive.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo asset_url();?>ico/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo asset_url();?>ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo asset_url();?>ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo asset_url();?>ico/apple-touch-icon-114x114.png">
  </head>

<!-- id=<?php echo $this->router->fetch_class() . '-' . $this->router->fetch_method(); ?>" class="<?php echo $this->router->fetch_class(); ?>-controller <?php echo $this->router->fetch_method(); ?>-method -->
  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo base_url();?>">SRA</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
            <p class="navbar-text pull-right">
            <?php echo ( $this->tank_auth->is_logged_in() ) ? 'Logged in as ' . anchor('user_profile', $this->session->userdata('username')) . ' | ' . anchor('/auth/logout/', 'Logout') : anchor('auth/login', 'Login') ; ?>
            </p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="sidebar-nav">
            <div class="well">
              <h5>Sidebar</h5>
              <ul>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
              </ul>
            </div> <!-- /well -->
            <div class="well">
              <h5>Event Stuff</h5>
              <ul>
                <li><?php echo anchor('event/create', 'Create Event'); ?></li>
                <li><a href="#">Link</a></li>
              </ul>
              <h5>Sidebar</h5>
              <ul>
                <li><a href="#">Link</a></li>
              </ul>
            </div> <!-- /well -->
            </div> <!-- /.sidebar-nav -->
      </div><!-- /span -->
      <div class="span10">
        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit">
          <h1>Squirrel Registration Authority</h1>
          <p>This is the squirrel registration authority. Create, signup for, and manage conventions here!</p>
          <p><a class="btn primary large">Learn more &raquo;</a></p>
        </div>
        <!-- Template content starts after this -->
	
