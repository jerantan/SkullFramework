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
</style>