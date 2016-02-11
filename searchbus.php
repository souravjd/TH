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
					<?php

						$from = $_POST['from'];
						$to = $_POST['to'];

						$from_id = null;
						$to_id = null;

						$sql_from = "SELECT point_id FROM points WHERE  point_name = '{$from}' AND point_status = 'active'";
						$res_from = $con->query($sql_from);
						if ($res_from->num_rows > 0) {
							$from_id = $res_from->fetch_assoc()['point_id'];
						}

						$sql_to = "SELECT point_id FROM points WHERE  point_name = '{$to}' AND point_status = 'active'";
						$res_to = $con->query($sql_to);
						if ($res_to->num_rows > 0) {
							$to_id = $res_to->fetch_assoc()['point_id'];
						}

						$sql_route = "SELECT * FROM routes WHERE mid_points LIKE '%{$from_id},%{$to_id},%' AND status = 'active'";
						$res_route = $con->query($sql_route);
						if ($res_route->num_rows > 0) {
							while($row_route = $res_route->fetch_assoc()) {

								$sql_bus = "SELECT * FROM bus WHERE bus_routes LIKE '%{$row_route['route_id']},%' AND bus_status = 'active'";
								$res_bus = $con->query($sql_bus);
								if ($res_bus->num_rows > 0) {
									while($row_bus = $res_bus->fetch_assoc()) {
										var_dump($row_bus);
									}
								}

							}
						} else {

						}

					?>
						<div class="buses">
							<div class="bus">
								<div class="row">
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4">
										
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