<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>AFSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo base_url('assets/basic/'); ?>css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo base_url('assets/basic/'); ?>css/style.css" rel="stylesheet">
<link href="<?php echo base_url('assets/basic/'); ?>color/default.css" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo base_url('assets/basic/'); ?>img/favicon.ico">
<script src="<?php echo base_url('assets/basic/'); ?>js/jquery.js"></script>
<style type="text/css">

  .dark-link a:link,a:visited,a:active{
    color: #023d5f ;
}
</style>


<!-- <link rel="stylesheet" href="<?php// echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php// echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
    iCheck
    <link rel="stylesheet" href="<?php// echo base_url('assets/plugins/iCheck/square/blue.css'); ?>"> -->
<!-- =======================================================
    Theme Name: AFSS Alumni
    Theme URL: https://bootstrapmade.com/AFSS Alumni-free-onepage-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
<- ======================================================= -->


</head>
<body>
<!-- navbar -->
<div class="navbar-wrapper">
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <!-- Responsive navbar -->
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </a>
        <span class="brand"><a href="<?php echo base_url(); ?>">Alumni</a></span>
        <!-- navigation -->
        <nav class="pull-right nav-collapse collapse">
        <ul id="menu-main" class="nav">
          <li><a title="team" href="<?php echo base_url(); ?>#about">About</a></li>
          <li><a title="services" href="<?php echo base_url(); ?>#services">Services</a></li>
          <li><a title="works" href="<?php echo base_url(); ?>#works">Works</a></li>
          <li><a title="blog" href="<?php echo base_url(); ?>#blog">Blog</a></li>
          <li><a title="contact" href="<?php echo base_url(); ?>#contact">Contact</a></li>
          <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">Account</a>
            <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url('basic/election'); ?>">Election</a></li>
                  <li><a href="<?php echo base_url('basic/edit_user'); ?>">Edit Account</a></li>
                  <li><a href="<?php echo base_url('auth/logout'); ?>">logout</a></li>
            </ul>
          </li>
        </ul>
        <span class="brand"><img class ="img-circle" width="30px" src="<?php echo  $user_image;?>"></span>
        </nav>


      </div>
    </div>
  </div>
</div>
<!-- Header area -->