<!DOCTYPE HTML>
<?php

	include '_config.php';
	include '_queries.php';

	$con = connect();

	$sessionState = 0;

	$error = @$_GET['error'];

	if (@isset($_SESSION['halt_user'])) {
		$sessionState = 1;

		$res_chkmail = $con->query($sql_users['sessionFetch'] . "'".$_SESSION['halt_user']."'");
		$row_chkmail = $res_chkmail->fetch_assoc();
	}
	?>	

<html>
	<head>
		<title>Ticket Halt - Bus Search</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/JFGrid.css" />
		<link rel="stylesheet" type="text/css" href="css/JFFormStyle-1.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="css/style-dev.css" media="all" />
		<link rel="stylesheet" type="text/css" href="css/searchbus.css">
		<link rel="stylesheet" type="text/css" href="FontAwesome/css/font-awesome.css">

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>


		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/pe-icon/css/pe-icon-7-stroke.css">
		<link rel="stylesheet" href="css.pe-icon/css/helper.css">

		<!-- START DATEPICKER SCRIPT -->
		<script>
			$(function() {
				$( "#datepicker" ).datepicker();
			});
		</script>
		<!-- /END DATEPICKER SCRIPT -->

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
						<li><a href="cancel.php">Print / Cancel Ticket</a></li> | |

						<?php
							if ($sessionState == 1) {
						?>

						<li class="active"><a href="account.php"><?php
													if ($row_chkmail['user_name'] != '') {
														echo $row_chkmail['user_name'];
													} else {
														echo $row_chkmail['user_mail'];
													}
												?></a></li> |
						<li><a href="signout.php">Sign Out</a></li> |

						<?php
							} else {
						?>

						<li><a href="signin.php">Sign In</a></li> |
						<li><a href="signup.php">Sign Up</a></li> |

						<?php
							}
						?>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="top-nav">
				<nav class="clearfix">
						<ul>
							<li><a href="index.php">Home</a></li> 
							<li><a href="cancel.php">Cancel Ticket</a></li>

							<?php
								if ($sessionState == 1) {
							?>

							<li class="active"><a href="account.php"><?php
														if ($row_chkmail['user_name'] != '') {
															echo $row_chkmail['user_name'];
														} else {
															echo $row_chkmail['user_mail'];
														}
													?></a></li>
							<li><a href="signout.php">Sign Out</a></li>

							<?php
								} else {
							?>

							<li><a href="signin.php">Sign In</a></li>
							<li><a href="signup.php">Sign Up</a></li>

							<?php
								}
							?>

						</ul>
						<a href="#" id="pull">Menu</a>
					</nav>
				</div>
				<!-- /END MENU -->
			</div>
		</div>
		</div>
		<!-- /END HEADER -->

		<!-- ROUTE HEADER -->
		<div class="route-head">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-4"><b>From : </b><span class="value"><?php echo $_SESSION['halt_cart']['bus_from'] ?></span></div>
					<div class="col-md-4"><b>To : </b><span class="value"><?php echo $_SESSION['halt_cart']['bus_to'] ?></div>
					<div class="col-md-4"><b>Date : </b><span class="value"><?php echo $_SESSION['halt_cart']['bus_on'] ?></div>
					
				</div>
			</div>
		</div>
		<!-- /END ROUTE HEADER -->

		<!-- START MAIN CONTENT -->

		<div class="main_bg">
			<div class="wrap">
				<div class="content-area">
			
	<?php 
	$seats = $_SESSION['seat_booked']['seat_no'];?>
	
	<form method="POST" action="controller_action.php" id="pdetail">
	<div class="col-md-8">
	<h3 style="text-decoration:underline;text-align:center">Passenger Details</h3><br />
	<?php foreach($seats as $var){ 	?>
	
	<div class="col-md-3">Seat No. <input type="text" name="seat[]" class="pseat" value="<?php echo $var;?>" readonly style="border=0px"></span></div>
	<div class="col-md-4">Name <input type="text" name="pname[]" class="pname" placeholder ="Name" required></div>
	<div class="col-md-3">Gender  <input type="checkbox" name="pgender[]" class="pgender" value="Male"> M <input type="checkbox" name="pgender[]" value="Female"> F</div>	 
	<div class="col-md-2">Age <input type="text" name="page[]" class="page" placeholder="Age" required></div>
	 <div class="space"></div>
	<?php } ?>
	</div>
	<div id="busdet" class="col-md-4">
	<h3 style="text-decoration:underline">Bus Details</h3><br />
	<span style="text-transform: uppercase;"><?php echo $_SESSION['halt_cart']['bus_from'] ?></span> to <span style="text-transform: uppercase;"><?php echo $_SESSION['halt_cart']['bus_to'] ;?></span><br>
	Bus Name : <?php echo $_SESSION['halt_cart']['bus_name'];?><br />
	Bus Number : <?php echo $_SESSION['halt_cart']["businfo"]['bus_number'];?><br />
	Bus Detail : <?php echo $_SESSION['halt_cart']["businfo"]['bus_details'];?><br />
	Seats : <?php  foreach($seats as $var){ echo $var.', ';}?><br />
	</div>
	<div class="col-md-8">
	<div class="col-md-12">
	Mobile <input type="text" name="mobile" placeholder="Mobile No." required><br /><span style="font-size:12px;    margin-left: 78px;"> (SMS will be sent on this number)</span> <br /><br /></div>
	<div class="col-md-4"></div><div class="col-md-8"><span class="agree"><input type="checkbox" required> I agree with Terms & Conditions</span><br /><br /></div>
	<input type="hidden" name="page_action" value="passenger">
	<div class="col-md-12" height="30px"></div>
	<div class="col-md-4"></div><div class="col-md-8"><input type="submit" id="procedtopay" name="psubmit" value="Proceed to Pay">
	<input type="button" id="canceltopay" value= "Cancel"></div></div>
	
</form>	
<div id ="paymentval" class="col-md-4">
	<h3 style="text-decoration:underline">Payment Summary</h3>
	Base Fare :  <?php echo $_SESSION['halt_cart']["businfo"]['route_price'];?><br />
	Total Fare : <?php echo count($seats)* $_SESSION['halt_cart']["businfo"]['route_price'];?>
	</div>
		</div>
		<!-- /END MAIN CONTENT -->	
		<?php include '_footer.php'; ?>
	</body>
</html>
<?php
	

?>
