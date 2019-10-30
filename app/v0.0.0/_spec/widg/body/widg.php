<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link href="<?php echo domain.build.'/'; ?>_spec/widg/body/img/tab_icon.png" rel="shortcut icon">
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
  <!-- Skull Custom -->
  <?php include skull_root.'plug/theme/theme.php'; ?>
  <script src="<?php echo skull_domain; ?>plug/theme/theme.js"></script>
  <link href="<?php echo skull_domain; ?>plug/theme/theme.css" rel="stylesheet">
  <!-- Header Custom -->
  <style>
    .navbar-default{ background-color: <?php echo main; ?>; }
    .navbar-default .navbar-brand{ color: <?php echo font; ?>; }
    .navbar-default .navbar-brand:hover,
    .navbar-default .navbar-brand:focus{ color: <?php echo hove; ?>; }
    .navbar-default .navbar-nav > li > a{ color: <?php echo font; ?>; }
    .navbar-default .navbar-nav > li > a:hover,
    .navbar-default .navbar-nav > li > a:focus{ color: <?php echo hove; ?>; }
    .navbar-default .navbar-nav > .active > a,
    .navbar-default .navbar-nav > .active > a:hover,
    .navbar-default .navbar-nav > .active > a:focus{ color: <?php echo hove; ?>; background-color: <?php echo main; ?>; }
    .navbar-default .navbar-nav > .open > a,
    .navbar-default .navbar-nav > .open > a:hover,
    .navbar-default .navbar-nav > .open > a:focus{ color: <?php echo hove; ?>; background-color: <?php echo main; ?>; }
    .navbar-default .navbar-nav .open .dropdown-menu{ background-color: <?php echo font; ?>; }
    .navbar-default .navbar-nav .open .dropdown-menu > li > a{ color: <?php echo main; ?>; }
    .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
    .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus{ color: <?php echo hove; ?>; background-color: <?php echo main; ?>; }
    @media(max-width: 767px){
      .navbar-default .navbar-toggle{ border-color: <?php echo main; ?>; background-color: <?php echo font; ?>; }
      .navbar-default .navbar-toggle .icon-bar{ background-color: <?php echo main; ?>; }
      .navbar-default .navbar-toggle:hover,
      .navbar-default .navbar-toggle:focus{ background-color: <?php echo hove; ?>; }
      .navbar-default .navbar-collapse{ background-color: <?php echo font; ?>; }
      .navbar-default .navbar-nav > li > a{ color: <?php echo main; ?>; }
      .navbar-default .navbar-nav > li > a:hover,
      .navbar-default .navbar-nav > li > a:focus{ color: <?php echo hove; ?>; background-color: <?php echo main; ?>; }
      .navbar-default .navbar-nav > .open > a,
      .navbar-default .navbar-nav > .open > a:hover,
      .navbar-default .navbar-nav > .open > a:focus{ color: <?php echo hove; ?>; background-color: <?php echo main; ?>; }
      .navbar-default .navbar-nav .open .dropdown-menu{ background-color: <?php echo font; ?>; }
      .navbar-default .navbar-nav .open .dropdown-menu > li > a{ color: <?php echo main; ?>; }
      .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
      .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus{ color: <?php echo hove; ?>; background-color: <?php echo main; ?>; }
    }
    footer{
      color: <?php echo font; ?>;
      background-color: <?php echo main; ?>;
    }
  </style>
  <link href="<?php echo domain.build.'/'; ?>_spec/widg/body/theme.css" rel="stylesheet">
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
          <a href="<?php $this->link('temp/'); ?>" class="dropdown-toggle" data-toggle="dropdown">Temp <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu">
            <li><?php $this->a('temp/test/', 'Test'); ?></li>
            <li><?php $this->a('temp/docs/', 'Docs'); ?></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="<?php $this->link('user/'); ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu">
            <?php if($this->userdata['active']){ ?>
              <li><?php $this->a('user/profile/', $this->userdata['name'].' : '.$this->userdata['level']); ?></li>
              <li class="divider"></li>
            <?php } ?>
            <li><?php $this->a('user/manager/', 'User Manager'); ?></li>
            <?php if($this->userdata['active']){ ?>
              <li><a href="<?php $this->link('user/signout/'); ?>" onclick="signout(); return false">Sign out</a></li>
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
<br><br><br>
</div>
<footer>
  &nbsp;<?php echo version; ?><a href="<?php echo site; ?>" class="rest float_right" target="blank"><?php echo firm; ?>&nbsp;</a>
</footer>
<?php $this->bottom(); ?>
</body>
</html>