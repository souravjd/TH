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
	$viewdata = $_REQUEST;
	
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
		
		<!-- /END ROUTE HEADER -->

		<!-- START MAIN CONTENT -->
	<?php 
		if(isset($viewdata['pnr']) ){
		$sql = "SELECT * from `bookedseat` b LEFT JOIN `bus` bs ON b.bus_id = bs.bus_id LEFT JOIN `routes` r ON bs.bus_routes = r.route_id  where b.pnr_no = '".$viewdata['pnr']."' AND b.book_status = '1'";	
	$sqlquery = $con->query($sql);
	$ticketdata = $sqlquery->fetch_assoc();	
	if($ticketdata['book_status'] == '1'){
	$seats = explode(',',$ticketdata['seat_no']);
	foreach($seats as $bukseat) {
    $sql1 = "SELECT * from passengerlist where id = '".$bukseat."'"; 
	$sqlquery = $con->query($sql1);
	$seatdata[] = $sqlquery->fetch_assoc();
	}
	
	foreach($seatdata as $seatval){
	$seatno[]	 =  $seatval['seatnum'];
	}
	$seats = implode(",",$seatno);
	?>
		<div class="main_bg">
			<div class="wrap">
				<div class="content-area">
			<div class="row">
			
				<div class="col-md-8"><span style="text-transform: uppercase" ><?php echo $ticketdata['from']; ?> -------> <span style="text-transform: uppercase" ><?php echo $ticketdata['to']; ?> </div><div class="col-md-4" >PNR Number</div> 
				<div class="col-md-8"><?php echo $ticketdata['travel_date']; ?></div><div class="col-md-4"><?php echo $ticketdata['pnr_no']; ?></div>
				<div class="col-md-12" style="border-bottom:1px solid black;margin-bottom:30px"></div>
				</div>
				
			<div class="row">
				<div class="col-md-3"></div><div class="col-md-9"><b>Bus name :  </b><span class="value"><?php echo $ticketdata['bus_name']; ?></div>
					<div class="col-md-3"></div><div class="col-md-9" style="margin:3px 0px"><b>Bus no. : </b><span class="value"><?php echo $ticketdata['bus_number']; ?></span></div>
					<div class="col-md-3"></div><div class="col-md-9" style="margin:3px 0px"><b>Bus Type: </b><span class="value"><?php echo $ticketdata['bus_details']; ?></span></div>
					<div class="col-md-3"></div><div class="col-md-9" style="margin:3px 0px"><b>Seats : </b><span class="value"><?php echo $seats; ?></span></div>
					<div class="col-md-3"></div><div class="col-md-9" style="margin:3px 0px"><b>Boarding Point : </b><span class="value"></span></div>
					<div class="col-md-3"></div><div class="col-md-9" style="margin:3px 0px"><b>Departure Time : </b><span class="value"><?php echo date("H:i A", strtotime($ticketdata['time'])); ?></div>
					<div class="col-md-3"></div><div class="col-md-9" style="margin-bottom:30px"><b>Reporting Time : </b><span class="value"></span></div>
					<div class="col-md-12" style="border-bottom:1px solid black;margin-bottom:30px"></div>
			</div>		
			
			<div class="row">
				
			<div class="col-md-12" style="margin-bottom:7px"><h3>Passenger Details</h3></div>
			<?php foreach($seatdata as $seatdetail){ ?>
			<div class="col-md-4"><b>Name : </b><span class="value"><?php echo $seatdetail['name']; ?></div> 
			<div class="col-md-4"><b>Age : </b><span class="value"><?php echo $seatdetail['age']; ?></div>
			<div class="col-md-4"><b>Seat No. : </b><span class="value"><?php echo $seatdetail['seatnum']; ?></div>
			<br/>
			<?php }?>  
			<div class="col-md-12" style="border-bottom:1px solid black;margin-bottom:30px"></div>
			</div>
			<div class="col-md-7"></div><div class="col-md-5"><b>Total Fare : </b><span class="value"><?php echo $ticketdata['fare'] ?></div>
			
			<?php if(isset($_REQUEST['cancel']) && $_REQUEST['cancel'] == 1) { ?>
			<div class="row">
			<form method ="POST" action="controller_action.php">
			<input type="hidden" name="cancelid" value="<?php echo $ticketdata['id'];?>">
			<input type="hidden" name="page_action" value="canceltic">
			<div class="col-md-3"></div><div class="col-md-9"><input type="submit" id="cancelticket" name="cancel" value="Cancel Ticket"></div>
			</form>
			</div>
			<?php } ?>
			
		</div>
			</div>
		</div>
		<?php } else {
		echo " No Ticket Found";
		}
		} ?>
		<!-- /END MAIN CONTENT -->	
		<?php include '_footer.php'; ?>
	</body>
</html>
<?php
	

?>
