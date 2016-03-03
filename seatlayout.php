<!DOCTYPE HTML>
<?php

	

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
	$params = @$_SESSION["halt_cart"];

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
		<link rel="stylesheet" type="text/css" href="css/jquery.seat-charts.css">
		<link rel="stylesheet" type="text/css" href="FontAwesome/css/font-awesome.css">

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery.seat-charts.js"></script>
        <script type="text/javascript" src="js/jquery.seat-charts.min.js"></script>

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
			<div class="container3">
				<div class="text-center">
					<div class="col-md-4"><b>From : </b><span class="value"><?php echo $params['bus_from'] ?></span></div>
					<div class="col-md-4"><b>To : </b><span class="value"><?php echo $params['bus_to'] ?></div>
					<div class="col-md-4"><b>Date : </b><span class="value"><?php echo $params['bus_on'] ?></div>
					<div class="col-md-4"><b>Bus Name : </b><span class="value"><?php echo $params['bus_name']; ?></div>
					<?php $bustim = $params['bus_time'] ;?>
					<div class="col-md-4"><b>Bus Time : </b><span class="value"><?php echo date("H:i A", strtotime($bustim)); ?></div>
				</div>
			</div>
		</div>
		<!-- /END ROUTE HEADER -->

		<!-- START MAIN CONTENT -->
<div class="wrapper">
			<div class="container">
				<div id="seat-map">
					<div class="front-indicator">Front</div>
					
				</div>
				<div class="booking-details">
					<h2>Booking Details</h2>
					
					<h3> Selected Seats (<span id="counter">0</span>):</h3>
					<ul id="selected-seats"></ul>
					
					Total: Rs.<b><span id="total">0</span></b>
					
					<button class="checkout-button" id="click_checkout">Checkout &raquo;</button>
					
					<div id="legend"></div>
					<br>
					<br>
					<div id="boardingpoint">
					<form
					<label>Boarding Points <select name="boardpoint">
							<option value="Point1">Point 1</option>
							<option value="Point2">Point 2</option>
							<option value="Point3">Point 3</option>
							</select>
							</form>
							</div>
				</div>
				
			</div>
			
		</div>
		
		<script>
			var firstSeatLabel = 1;
		
			$(document).ready(function() {
				var $cart = $('#selected-seats'),
					$counter = $('#counter'),
					$total = $('#total'),
					sc = $('#seat-map').seatCharts({
					map: [
						'ff_ff',
						'ff_ff',
						'ff_ff',
						'ff_ff',
						'ff_ff',
						'ff_ff',
						'ff_ff',
						'ff_ff',
						'fffff',
						
					],
					seats: {
						f: {
							price   : <?php echo $params["businfo"]["route_price"]; ?>,
							classes : 'available', //your custom CSS class
							category: 'Available seat'
						},
						e: {
							price   : 40,
							classes : 'booked', //your custom CSS class
							category: 'Booked seat'
						}					
					
					},
					naming : {
						top : false,
						getLabel : function (character, row, column) {
							return firstSeatLabel++;
						},
					},
					legend : {
						node : $('#legend'),
					    items : [
							[ 'f', 'available',   'Available seat' ],
							[ 'e', 'unavailable',   'Booked seat'],
							[ '', 'selected', 'Selected seat']
					    ]					
					},
					click: function () {
						if (this.status() == 'available') {
							//let's create a new <li> which we'll add to the cart items
							$('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>Rs.'+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a><span id="booked_seat" rel="'+this.settings.label+'"></li>')
								.attr('id', 'cart-item-'+this.settings.id)
								.attr('rel',this.settings.id)
								.data('seatId', this.settings.id)
								.appendTo($cart);
								
								//console.log($cart);
							
							/*
							 * Lets update the counter and total
							 *
							 * .find function will not find the current seat, because it will change its stauts only after return
							 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
							 */
							$counter.text(sc.find('selected').length+1);
							$total.text(recalculateTotal(sc)+this.data().price);
							
							return 'selected';
						} else if (this.status() == 'selected') {
							//update the counter
							$counter.text(sc.find('selected').length-1);
							//and total
							$total.text(recalculateTotal(sc)-this.data().price);
						
							//remove the item from our cart
							$('#cart-item-'+this.settings.id).remove();
						
							//seat has been vacated
							return 'available';
						} else if (this.status() == 'unavailable') {
							//seat has been already booked
							return 'unavailable';
						} else {
							return this.style();
						}
					}
				});

				//this will handle "[cancel]" link clicks
				$('#selected-seats').on('click', '.cancel-cart-item', function () {
					//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
					sc.get($(this).parents('li:first').data('seatId')).click();
				});

				//let's pretend some seats have already been booked
					<?php foreach($_SESSION['halt_cart']["seatlocation"] as $seatloc){?>
				sc.get(['<?php echo $seatloc;?>',]).status('unavailable');<?php }?>
		
		
		$("#click_checkout").click( function() {
		
		//console.log($("ul#selected-seats"));
		var location = [];
		var seatNo = [];
			$("ul#selected-seats li").each( function(){
				
				var seat_location = $(this).attr("rel");
				var seat_no = $(this).find("span#booked_seat").attr("rel");
				location.push(seat_location);
				seatNo.push(seat_no);
			});
		
		//console.log(seatNo);
		
						var formData = {'page_action': 'bus_booking', 'user_id': 1, 'bus_id': <?php echo (int)$params["businfo"]["bus_id"];?>, 'seat_location': location, 'seat_no':seatNo, 'fare': '<?php echo $params["businfo"]["route_price"]; ?>', 'travel_date': '<?php echo $params["bus_on"];?>', 'book_status':1 };
				var url = 'controller_action.php';
				
				$.ajax({
				url: url,
				type : "POST",
				data: formData,
				success : function(data,textStatus,jqXHR)
				{
					
					if(data == "booked"){
						window.location = "passengerdetail.php";
					}
						
				
				},
				error:function (jqXHR,textStatus,error)
				{
				alert("Error");
				}
					
				
				});

		
		
		});
		
		
		
		});

		function recalculateTotal(sc) {
			var total = 0;
		
			//basically find every selected seat and sum its price
			sc.find('selected').each(function () {
				total += this.data().price;
			});
			
			return total;
		}
		
		
		
		</script>


		<?php include '_footer.php'; ?>
		
