<!DOCTYPE HTML>
<?php

	@$error = $_GET['error'];

	if (isset($_POST['sub'])) {
		if ($_POST['email'] != '') {
			
		} else {
			header("location: forgot.php?error=empty");
		}
	} else {
?>
<html>
	<head>
		<title>Ticket Halt - Forgot Password</title>
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
						<a href="index.php"><img src="images/logo.png" alt=""></a>
					</div>
					<!-- START MENU -->
					<div class="h_right">
						<ul class="menu" style="float:right;">
							| <li><a href="index.php">Home</a></li> |
							<li><a href="cancel.html">Print / Cancel Ticket</a></li> | |
							<li><a href="signin.php">Sign In</a></li> |
							<li><a href="signup.php">Sign Up</a></li> |
							<div class="clear"></div>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="top-nav">
					<nav class="clearfix">
							<ul>
								<li><a href="index.php">Home</a></li> 
								<li><a href="cencel.html">Cancel Ticket</a></li> 
								<li><a href="signin.php">Sign In</a></li> 
								<li><a href="signup.php">Sign Up</a></li>
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
					<div class="head">Forgot Password</div>
					<div class="body">
						<?php

							if ($error == 'empty') {
						?>
						<div class="error">Field can't be empty.</div>
						<?php
							} elseif ($error == 'wrong') {
						?>
						<div class="error">No account exits with this Email.</div>
						<?php
							} elseif ($error == 'none') {
						?>
						<div class="success">Your recovey link is sent to you given email.</div>
						<?php
							}

						?>
						<form method="post" action="forgot.php">
							<div class="label">
								<h5>Email :</h5>
							</div><div class="lcontent">
								<input type="email" name="email" placeholder="Enter your Email Id">
							</div>
							<input type="submit" name="sub" value="Recover Password">
						</form>
					</div>
					<div class="foot">
						<div class="txt-up"><a href="sign.php">Sign In</a>
							<div class="right txt-up"><a href="signup.php">Sign Up</a></div>
						</div>
					</div>
				</div>
			</div>
			<!-- /END MAIN CONTENT -->
		</div>
		<?php include '_footer.php'; ?>
	</body>
</html>
<?php
	}
?>