<?php

	include '_config.php';
	$con = connect();
if(isset($_POST["sbus"]) && $_POST["page_action"]  = "sbus"){

		$_SESSION['halt_cart']["bus_from"] = $_POST["from"];
		$_SESSION['halt_cart']["bus_to"] = $_POST["to"];
		$_SESSION['halt_cart']["bus_on"] = $_POST["on"];
		header("location: searchbus.php");
		exit();
		
}
if(isset($_POST["searchBus"]) && $_POST["page_action"]  = "bus"){		
		
	if(isset($_SESSION['halt_cart'])){
		$_SESSION['halt_cart']["bus_id"] =$_POST["busid"];
		$_SESSION['halt_cart']["bus_name"] =$_POST["busname"]; 
		$_SESSION['halt_cart']["bus_time"] = $_POST["bustime"];
		
		$busid = $_POST["busid"];
	$sql = "SELECT * FROM `bus` WHERE `bus_id` = '".$busid."' ";
	$sqlquery = $con->query($sql);
	$busdata = $sqlquery->fetch_assoc();
	$_SESSION['halt_cart']["businfo"] = $busdata;
	$sql = "SELECT seat_location FROM `bookedseat` WHERE  `bus_id` = '".$busid."' AND `travel_date` = '".$_SESSION['halt_cart']['bus_on']."'";
	$sqlquery = $con->query($sql);
	while($locationdata = $sqlquery->fetch_assoc()){
	$locationda[] = $locationdata;
	}
	$out =array();
	$count = count($locationda);
	for($i=0;$i<$count;$i++){
	$locdata[] = explode(',',$locationda[$i]['seat_location']);
	}
	$count3 = count($locdata);
	$aary = array();
	for($i=0;$i<$count3;$i++){
	$aary = array_merge($aary,$locdata[$i]);}
	$_SESSION['halt_cart']["seatlocation"] = $aary;
	
	/*echo "<pre>";
	print_r($locdata);
	echo "</pre>";
	die();*/
	}
	header("location: seatlayout.php");
	exit();
}
	
	

	if($_REQUEST["page_action"]  == "bus_booking"){
		$_SESSION['seat_booked'] = $_REQUEST;
			//unset($_SESSION['halt_cart']);
				//$_SESSION['booked_id'] = last_insert_id();
			echo "booked";
			exit();
		}
	
	if(isset($_POST["psubmit"]) && $_POST["page_action"]  = "passenger"){
		$totalseat = count($_POST['seat']);
		$userid = 1;
		for($i=0;$i<$totalseat;$i++){
		$sql = "INSERT INTO `passengerlist` ( `seatnum`, `name`, `gender`, `age`, `fare`, `userid`) VALUES('".$_POST['seat'][$i]."','".$_POST['pname'][$i]."','".$_POST['pgender'][$i]."',".$_POST['page'][$i].",'".$_SESSION['seat_booked']["fare"][$i]."','".$userid."')";
		$sqlquery = $con->query($sql);
		$last_id[] = $con->insert_id;
			} 
			

		$seat_location = implode(",",$_SESSION['seat_booked']["seat_location"]);
		$seat_no = implode(",",$last_id);
		$pnr = rand(1111111111,9999999999);
		$userid = $_SESSION['seat_booked']["user_id"];
		$busid = $_SESSION['seat_booked']["bus_id"];
		$fare = count($_SESSION['seat_booked']["seat_location"]) * $_SESSION['seat_booked']["fare"];
		$from = $_SESSION['halt_cart']["bus_from"];
		$to = $_SESSION['halt_cart']["bus_to"];
		$datetravel = $_SESSION['seat_booked']["travel_date"];
		$status = $_SESSION['seat_booked']["book_status"];
		$sql3 = "INSERT INTO `bookedseat` (`user_id`, `bus_id`, `seat_location`, `seat_no`, `fare`, `pnr_no`,`from`,`to`, `travel_date`, `datetime`, `book_status`)VALUES ('".$userid."','".$busid."','".$seat_location."','".$seat_no."','".$fare."','".$pnr."','".$from."','".$to."','".$datetravel."',now(),'".$status."') " ;
		$res_booking = $con->query($sql3);
		$lastid = $con->insert_id;
		$sql4 = "SELECT pnr_no FROM bookedseat where id = '".$lastid."'";
		$getpnr = $con->query($sql4);
		$pnrdata = $getpnr->fetch_assoc();
		$pnr_no = $pnrdata['pnr_no'];
		unset($_SESSION['halt_cart']);
		header("Location: viewtickets.php?pnr=$pnr_no");
		die();
	}
	if(isset($_POST["cancel"]) && $_POST["page_action"]  = "canceltic"){
		$sql = "UPDATE `bookedseat` SET book_status = '2' where id = ".$_POST['cancelid']."" ;
		$query = $con->query($sql);
		echo "<script type='text/javascript'>alert('Ticket Cancelled');</script>";
		}
		header("Location: index.php");
		exit();
	?>