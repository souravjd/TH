<!DOCTYPE HTML>
<?php

	session_start();

	include '_config.php';
	include '_queries.php';

	$con = connect();

	$sessionState = 0;

	@$error = $_GET['error'];

	if (isset($_SESSION['halt_user'])) {
		$sessionState = 1;

		$res_chkmail = $con->query($sql_users['sessionFetch'] . "'".$_SESSION['halt_user']."'");
		$row_chkmail = $res_chkmail->fetch_assoc();
	}

?>
<html>
	<head>
		<title>Ticket Halt - About Us</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/JFGrid.css" />
		<link rel="stylesheet" type="text/css" href="css/JFFormStyle-1.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="FontAwesome/css/font-awesome.css">

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/pe-icon/css/pe-icon-7-stroke.css">
		<link rel="stylesheet" href="css.pe-icon/css/helper.css">

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
							<li><a href="cencel.html">Cancel Ticket</a></li>

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
		<!-- START MAIN CONTENT -->
		<div class="main_bg">
			<div class="wrap">
				<div class="content-area">
					<div class="content-box">
						<div style="text-align:center;color:#111;font-size:32px;border-bottom:1px solid #999;padding-bottom:10px;margin-bottom:10px;">About Us</div>
						<div style="font-size:20px;color:#444;text-align:center;padding:20px 0px;">
							"Seeking the problems of increasing population and limited seats to travel, we changed the way you perceive to travel"
						</div>
					</div>
				</div>
			</div>
			<div class="bg-light">
				<div class="container">
					<div class="row">
						<div class="col-md-3 text-center">
							<i class="pe-7s-like2 pe-md" style="color:#111;"></i>
						</div>
						<div class="col-md-6">
							Ticket halt offers safe, secure and user friendly online booking of tickets all over India.
						</div>
					</div>
				</div>
			</div>
			<div class="bg-dark">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							Having an experience of developing, designing, as well as the hold in ticket industry, Tickethalt gathered up to introduced this portal for public ticket service to make life easier.
						</div>
						<div class="col-md-3 text-center">
							<i class="pe-7s-rocket pe-md" style="color:#EEE;"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-light">
				<div class="container">
					<div class="row">
						<div class="col-md-3 text-center">
							<i class="pe-7s-user pe-md" style="color:#111;"></i>
						</div>
						<div class="col-md-6">
							Ticket halt is the brand introduced by highly professional graduates in order to make your life easier.
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /END MAIN CONTENT -->	
		<?php include '_footer.php'; ?>
	</body>
</html>