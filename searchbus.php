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

	if (isset($_SESSION['halt_cart']['bus_from'])) {
	
	
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
					<div class="buses">
					<?php
						$params = @$_SESSION['halt_cart'];
						$from = $params['bus_from'];
						$to = $params['bus_to'];
						$on = $params['bus_on'];
						$from_id = null;
						$to_id = null;

						$sql_from = "SELECT point_id FROM points WHERE  point_name = '{$from}' AND point_status = 'active'";
						$res_from = $con->query($sql_from);
						if ($res_from->num_rows > 0) {
							$from_id = $res_from->fetch_assoc();
							$from_id = $from_id['point_id'];
							
						}

						$sql_to = "SELECT point_id FROM points WHERE  point_name = '{$to}' AND point_status = 'active'";
						$res_to = $con->query($sql_to);
						if ($res_to->num_rows > 0) {
							$to_id = $res_to->fetch_assoc();
							$to_id = $to_id['point_id'];
						}

						$sql_route = "SELECT * FROM routes WHERE mid_points LIKE '%{$from_id},%{$to_id},%' AND status = 'active'";
						$res_route = $con->query($sql_route);
						if ($res_route->num_rows > 0) {?>
							<div class="row">
							<div class="col-md-3">Bus Name</div>
							<div class="col-md-3">Price( in Rs.)</div>
							<div class="col-md-3">Depart</div>
							<div class="col-md-3">Seats</div>
							</div>
							<?php 
							while($row_route = $res_route->fetch_assoc()) {

								$sql_bus = "SELECT * FROM bus WHERE bus_routes LIKE '%{$row_route['route_id']},%' AND bus_status = 'active'";
								$res_bus = $con->query($sql_bus);
								if ($res_bus->num_rows > 0) {
							
							 while($row_bus = $res_bus->fetch_assoc()) {
										$bus_id = $row_bus['bus_id'];
										$bus_name = $row_bus['bus_name'];
						?>
							<div class="bus" data-toggle="collapse" data-target="#bus_<?php echo $bus_id; ?>"  aria-expanded="false">
								<div class="row">
									<div class="col-md-3 head">
										<div class="row">
											<div class="col-md-12"><?php echo $bus_name; ?></div>
											<div class="col-md-12" style="font-weight:normal;font-size:75%;color:#444;"><?php echo $row_bus['bus_details'] ?></div>
										</div>
									</div>
									
									<div class="col-md-3"> <?php echo $row_bus['route_price']; ?></div>
									<?php $depart = $row_bus['time'];?>
									<div class="col-md-3"> <?php echo date("H:i A", strtotime($depart));?></div>
									<div class="col-md-3">
									<form method="post" action="controller_action.php">
									<input type="hidden" name="busid" value="<?php echo $bus_id; ?>">
									<input type="hidden" name="busname" value="<?php echo $bus_name; ?>">
									<input type="hidden" name="bustime" value="<?php echo $depart; ?>">
									<input type="hidden" name="page_action" value="bus">
									<input type="submit" name="searchBus" value="Select Seats">
									</form>
							</div>
							</div>
							</div>
							
							
						<?php
									}
								}
 
							}
						} else {
					?>
						<div class="bus text-center" style="padding:20px;">Sorry! No Bus Found...</div>
					<?php
						}

					?>
					</div>
							
					</div>
				</div>
						
			</div>
		</div>
		<!-- /END MAIN CONTENT -->	
		<?php include '_footer.php'; ?>
	</body>
</html>
<?php
	} else {
		header("location: index.php");
	}

?>
