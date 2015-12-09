<!DOCTYPE HTML>
<html>
	<head>
		<title>Ticket Halt</title>
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
		<link rel="stylesheet" href="css/main.css">
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
						| <li class="active"><a href="index.php">Home</a></li> |
						<li><a href="cancel.html">Print / Cancel Ticket</a></li> | |
						<li><a href="signin.php">Sign In</a></li> |
						<li><a href="signup.html">Sign Up</a></li> |
						<div class="clear"></div>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="top-nav">
				<nav class="clearfix">
						<ul>
							<li class="active"><a href="index.php">Home</a></li> 
							<li><a href="cencel.html">Cancel Ticket</a></li> 
							<li><a href="signin.php">Sign In</a></li> 
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
		<!-- START MAIN CONTENT -->
		<div class="main_bg" style="background:url('images/slider-bg.jpg') no-repeat fixed center top / cover;">
			<div class="wrap" style="padding:185px 0 0 0">
				<div class="online_reservation">
					<div class="b_room">
						<div class="h-head">
							<h4>Book Bus Ticket Online</h4>
							<p>India's largest real time tickets booking system</p>
						</div>
						<div class="h-body">
							<div class="cell">
								<h5>From :</h5>
								<input type="text" placeholder="Select City">
							</div><div class="cell">
								<h5>To :</h5>
								<input type="text" placeholder="Select City">
							</div><div class="cell book_date">
								<h5>Date :</h5>
								<input type="text" id="datepicker" class="date hasDatepicker" placeholder="DD/MM/YYYY">
							</div><div class="cell">
								<h5></h5>
								<input type="submit" value="Search Bus">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main_bg">
			<div class="wrap">
				<div class="space"></div>
				<div class="grids_of_3">
					<div class="grid1_of_3">
						<div style="text-align:center;"><i class="fa fa-shopping-cart" style="font-size:800%;color:#191919;"></i></div>
						<p>Ticket Halt is an e-commerce booking portal which not only provides the best services without any hassle but also seeking the quality standards of your journey with economical and pocket friendly prices.</p>
					</div>
					<div class="grid1_of_3">
						<div style="text-align:center;"><i class="fa fa-rupee" style="font-size:800%;color:#191919;"></i></div>
						<p>No extra amounts have to be paid for such services. Be the part of ticket halt and make your experience worth. Tickethalt.com is introduced for the convenience of people who travel a lot but find difficulties in their travelling part. Time is an important part in one’s life and we take care of that by not letting you stand in long que.</p>
					</div>
					<div class="grid1_of_3">
						<div style="text-align:center;"><i class="fa fa-female" style="font-size:800%;color:#191919;"></i></div>
						<p>We offer reserved seats for the ladies without any hassle.comfort and luxury is what we give preference for the public service. No hassle around with the bus operators. </p>
					</div>
					<div class="clear"></div>
				</div>	
			</div>
		</div>
		<!-- /END MAIN CONTENT -->	
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