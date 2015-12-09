<!DOCTYPE HTML>
<html>
	<head>
		<title>Ticket Halt - Sign In</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<link rel="stylesheet" href="FontAwesome/css/font-awesome.css">
		<!--
		<script src="js/jquery-ui.js"></script>
			<script>
				  $(function() {
				    $( "#datepicker" ).datepicker();
				  });
			</script>
		-->
		<link rel="stylesheet" type="text/css" href="css/signin.css">
		<link type="text/css" rel="stylesheet" href="css/JFGrid.css" />
		<link type="text/css" rel="stylesheet" href="css/JFFormStyle-1.css" />
		<script type="text/javascript" src="js/JFCore.js"></script>
		<script type="text/javascript" src="js/JFForms.js"></script>
		<!-- START NAV SCRIPT -->
		<script>
				$(function() {
					var pull 		= $('#pull');
						menu 		= $('nav ul');
						menuHeight	= menu.height();

					$(pull).on('click', function(e) {
						e.preventDefault();
						menu.slideToggle();
					});

					$(window).resize(function(){
		        		var w = $(window).width();
		        		if(w > 320 && menu.is(':hidden')) {
		        			menu.removeAttr('style');
		        		}
		    		});
				});
		</script>
		<!-- /END NAV SCRIPT -->
	</head>
	<body>
		<!-- START HEADER -->
		<div class="header_bg">
			<div class="wrap">
				<div class="header">
					<div class="logo">
						<a href="index.html"><img src="images/logo.png" alt=""></a>
					</div>
					<!-- START MENU -->
					<div class="h_right">
						<ul class="menu" style="float:right;">
							| <li><a href="index.php">Home</a></li> |
							<li><a href="cancel.html">Print / Cancel Ticket</a></li> | |
							<li class="active"><a href="signin.php">Sign In</a></li> |
							<li><a href="signup.html">Sign Up</a></li> |
							<div class="clear"></div>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="top-nav">
					<nav class="clearfix">
							<ul>
								<li><a href="index.php">Home</a></li> 
								<li><a href="cencel.html">Cancel Ticket</a></li> 
								<li class="active"><a href="signin.php">Sign In</a></li> 
								<li><a href="signup.html">Sign Up</a></li>
							</ul>
							<a href="#" id="pull">Menu</a>
						</nav>
					</div>
					<!-- /END MENU -->
				</div>
			</div>
		</div>
		<!-- /END HEADER -->
		<div class="main_bg" style="background:url('images/slider-bg.jpg') no-repeat fixed center top / cover;">
			<!-- START MAIN CONTENT -->
			<div class="wrap" style="padding:185px 0 40px 0">
				<div class="sign-box">
					<div class="head">Sign In</div>
					<div class="body">
						<form method="post" action="signin.php">
							<div class="label">
								<h5>Email :</h5>
							</div><div class="lcontent">
								<input type="text" name="email">
							</div>
							<div class="label">
								<h5>Password :</h5>
							</div><div class="lcontent">
								<input type="password" name="pass">
							</div>
							<input type="submit" name="sub" value="Sign In Now">
						</form>
					</div>
					<div class="foot"></div>
				</div>
			</div>
			<!-- /END MAIN CONTENT -->
		</div>
		<!-- START FOOTER -->
		<div class="footer_bg">
			<div class="wrap">
				<div class="footer">
					<div class="copy">
						<p class="link"><span>© All rights reserved | Designed by <a href="#"> {{OUR COMPANY}}</a></span></p>
					</div>
					<div class="f_nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="rooms.html">About Us</a></li>
							<li><a href="reservation.html">Privacy Policy</a></li>
							<li><a href="contact.html">Tearm of Use</a></li>
						</ul>
					</div>
					<div class="soc_icons">
						<ul>
							<li><a class="icon1" href="#"></a></li>
							<li><a class="icon2" href="#"></a></li>
							<li><a class="icon3" href="#"></a></li>
							<div class="clear"></div>
						</ul>	
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<!-- /END FOOTER -->
	</body>
</html>