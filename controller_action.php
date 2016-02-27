<?php

	include '_config.php';
	$con = connect();

if(isset($_POST["searchBus"]) && $_POST["page_action"]  = "bus"){		
		
	if(isset($_SESSION['halt_cart'])){
		$_SESSION['halt_cart']["bus_id"] =$_POST["busid"];
		$_SESSION['halt_cart']["bus_name"] =$_POST["busname"]; 
		$_SESSION['halt_cart']["bus_time"] = $_POST["bustime"];
		
		$busid = $_POST["busid"];
	$sql = "SELECT * FROM `bus` WHERE `bus_id` = $busid ";
	$sqlquery = $con->query($sql);
	$busdata = $sqlquery->fetch_assoc();
	$_SESSION['halt_cart']["businfo"] = $busdata;
	/*echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	die();*/
	}
	header("location: seatlayout.php");
	exit();
}
	
	
	if($_REQUEST["page_action"]  = "bus_booking"){		
		$seat_location = implode(",",$_REQUEST["seat_location"]);
		$seat_no = implode(",",$_REQUEST["seat_no"]);
		$pnr = rand(1111111111,9999999999);
		$userid = $_REQUEST["user_id"];
		$busid = $_REQUEST["bus_id"];
		$fare = $_REQUEST["fare"];
		$datetravel = $_REQUEST["travel_date"];
		$status = $_REQUEST["book_status"];
		$sql = "INSERT INTO `bookedseat` VALUES ('','".$userid."','".$busid."','".$seat_location."','".$seat_no."','".$fare."','".$pnr."','".$datetravel."',now(),'".$status."') " ;
		
		$res_booking = $con->query($sql);
		//$busdata = $res_booking->fetch_assoc();
		if($res_booking){
		
			unset($_SESSION['halt_cart']);
				//$_SESSION['booked_id'] = last_insert_id();
			echo "booked";
		}else{
			echo "error";
		}
	exit();
	}
	
	
	die("Something going wrong ...");
	?>