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

	if (isset($_POST['changename'])) {
		$con->query($sql_users['changeName']."'".$_POST['name']."' WHERE MD5(`user_mail`) = '".$_SESSION['halt_user']."'");
		header("location: ".$SITE['url']."account.php");
	} elseif (isset($_POST['changepass'])) {
		if (empty($_POST['newpass']) || empty($_POST['repass'] || empty($_POST['oldpass']))) {
			header("location: ".$SITE['url']."account.php?change=password&error=empty");
		} else {
			if ($_POST['newpass'] == $_POST['repass']) {
				$resPass = $con->query($sql_users['mailPasswordCheck']."'".$_SESSION['halt_user']."' AND `user_password` = '".$_POST['oldpass']."'");
				$rowPass = $resPass->fetch_assoc();
				if ($rowPass['chk'] == 1) {
					$con->query($sql_users['changePassword']."'".$_POST['newpass']."' WHERE MD5(`user_mail`) = '".$_SESSION['halt_user']."'");
					header("location: ".$SITE['url']."account.php");
				} else {
					header("location: ".$SITE['url']."account.php?change=password&error=wrong");
				}
			} else {
				header("location: ".$SITE['url']."account.php?change=password&error=notmatch");
			}
		}
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

		<style>
.enjoy-css {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  cursor: pointer;
  border: none;
  font: normal 72px/normal "Passero One", Helvetica, sans-serif;
  color: rgba(255,255,255,1);
  text-align: center;
  -o-text-overflow: clip;
  text-overflow: clip;
  text-shadow: 0 1px 0 rgb(204,204,204) , 0 2px 0 rgb(201,201,201) , 0 3px 0 rgb(187,187,187) , 0 4px 0 rgb(185,185,185) , 0 5px 0 rgb(170,170,170) , 0 6px 1px rgba(0,0,0,0.0980392) , 0 0 5px rgba(0,0,0,0.0980392) , 0 1px 3px rgba(0,0,0,0.298039) , 0 3px 5px rgba(0,0,0,0.2) , 0 5px 10px rgba(0,0,0,0.247059) , 0 10px 10px rgba(0,0,0,0.2) , 0 20px 20px rgba(0,0,0,0.14902) ;
  -webkit-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
  -moz-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
  -o-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
  transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
}

.enjoy-css:hover {
  color: rgba(169,214,169,1);
  text-shadow: 0 1px 0 rgba(255,255,255,1) , 0 2px 0 rgba(255,255,255,1) , 0 3px 0 rgba(255,255,255,1) , 0 4px 0 rgba(255,255,255,1) , 0 5px 0 rgba(255,255,255,1) , 0 6px 1px rgba(0,0,0,0.0980392) , 0 0 5px rgba(0,0,0,0.0980392) , 0 1px 3px rgba(0,0,0,0.298039) , 0 3px 5px rgba(0,0,0,0.2) , 0 -5px 10px rgba(0,0,0,0.247059) , 0 -7px 10px rgba(0,0,0,0.2) , 0 -15px 20px rgba(0,0,0,0.14902) ;
  -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
  -moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
  -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
  transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
}
		</style>

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

		<!-- ROUTE HEADER -->
		<div class="route-head">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-4"><b>From : </b><span class="value"><?php echo $_POST['from'] ?></span></div>
					<div class="col-md-4"><b>To : </b><span class="value"><?php echo $_POST['to'] ?></div>
					<div class="col-md-4"><b>Date : </b><span class="value"><?php echo $_POST['on'] ?></div>
				</div>
			</div>
		</div>
		<!-- /END ROUTE HEADER -->

		<!-- START MAIN CONTENT -->
		<div class="main_bg">
			<div class="wrap">
				<div class="content-area">
						<div class="content-box text-center enjoy-css" style="background:#79d19d !important;padding:60px 20px;">
							Comming Soon
						</div>
						<div class="buses">
							<div class="bus">
								<div class="row">
									<div class="col-md-4">
										<table style="width:100%;">
											<tr>
												<td>
													<i class="pe-7s-plane pe-sm"></i>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
									<div class="col-md-4">
										<table style="width:100%;">
											<tr>
												<td>
													<i class="pe-7s-clock pe-sm"></i>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
									<div class="col-md-4">
										<table style="width:100%">
											<tr>
												<td>
													<i class="pe-7s-pin pe-sm"></i>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="bus">
								<div class="row">
									<div class="col-md-4">
										<table style="width:100%;">
											<tr>
												<td>
													<i class="pe-7s-plane pe-sm"></i>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
									<div class="col-md-4">
										<table style="width:100%;">
											<tr>
												<td>
													<i class="pe-7s-clock pe-sm"></i>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
									<div class="col-md-4">
										<table style="width:100%">
											<tr>
												<td>
													<i class="pe-7s-pin pe-sm"></i>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						
			</div>
		</div>
		<!-- /END MAIN CONTENT -->	
		<?php include '_footer.php'; ?>
	</body>
</html>