<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="<?php echo skull_domain; ?>img/tab_icon.png" rel="shortcut icon">
	<title><?php echo version.' - '.$this->title; ?></title>
	<!-- jQuery -->
	<script src="<?php echo skull_domain; ?>plug/jquery/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo skull_domain; ?>plug/bootstrap/bootstrap.min.js"></script>
	<link href="<?php echo skull_domain; ?>plug/bootstrap/bootstrap.min.css" rel="stylesheet">
	<!-- NavBar -->
	<script src="<?php echo skull_domain; ?>plug/navbar/jquery.bootstrap-autohidingnavbar.js"></script>
	<script>
		$(function(){
			$('.navbar-fixed-top').autoHidingNavbar();
		});
	</script>
	<!-- Custom -->
	<?php include skull_root.'plug/custom/theme.php'; ?>
	<script src="<?php echo skull_domain; ?>plug/custom/theme.js"></script>
	<link href="<?php echo skull_domain; ?>plug/custom/theme.css" rel="stylesheet">

	<?php include 'plug/custom/theme.php'; ?>
	<link href="<?php echo domain.build.'/'; ?>_spec/widg/header/plug/custom/theme.css" rel="stylesheet">
	<!-- DatePicker -->
	<script src="<?php echo skull_domain; ?>plug/datepicker/bootstrap-datepicker.min.js"></script>
	<link href="<?php echo skull_domain; ?>plug/datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
	<!-- Chosen -->
	<script src="<?php echo skull_domain; ?>plug/chosen/chosen.jquery.min.js"></script>
	<link href="<?php echo skull_domain; ?>plug/chosen/bootstrap-chosen.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php $this->link(''); ?>" class="navbar-brand"><?php echo project; ?></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown">Temp <b class="caret"></b></a>	
					<ul class="dropdown-menu" role="menu">
						<li><?php $this->a('temp/test/', 'Test'); ?></li>
						<li><?php $this->a('temp/docs/', 'Docs'); ?></li>
					</ul>
				</li>				
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($this->userdata['active']){ ?>
							<li><?php $this->a('user/profile/', $this->userdata['name'].' : '.$this->userdata['level']); ?></li>
							<li class="divider"></li>
						<?php } ?>
						<li><?php $this->a('user/manager/', 'User Manager'); ?></li>
						<?php if($this->userdata['active']){ ?>
							<li><a href="" onclick="signout(); return false">Sign out</a></li>
						<?php } ?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a><?php echo $this->title; ?>&nbsp;&nbsp;&nbsp;</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid <?php echo $this->page; ?>">
<br><br><br><br><br>