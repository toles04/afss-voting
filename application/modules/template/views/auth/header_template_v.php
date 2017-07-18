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
    <!-- <link rel="stylesheet" href="<?php// echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php// echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
    iCheck
    <link rel="stylesheet" href="<?php// echo base_url('assets/plugins/iCheck/square/blue.css'); ?>"> -->
<link rel="shortcut icon" href="<?php echo base_url('assets/basic/'); ?>img/favicon.ico">
<script type="text/javascript">

    function change_city()
 {
  var state = $('#country_id').val();
  $('#state_id').load('<?php echo base_url(); ?>home/state/'+state);
 }
</script>
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
        <h1 class="brand"><a href="<?php echo base_url(); ?>">Alumni</a></h1>
        <!-- navigation -->
        <nav class="pull-right nav-collapse collapse">
        <ul id="menu-main" class="nav">
          <li><a title="team" href="<?php echo base_url(); ?>">Home</a></li>
          <li><a title="team" href="<?php echo base_url(); ?>#about">About</a></li>
          <li><a href="<?php echo base_url('login'); ?>">Sign In</a></li>
          <li><a href="<?php echo base_url('register'); ?>">Sign Up</a></li>
          <li><a title="contact" href="<?php echo base_url(); ?>#contact">Contact</a></li>
        </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- Header area -->
