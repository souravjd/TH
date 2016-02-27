<?php
session_start();


	$SITE['url'] = "http://localhost/TH/";

	function connect() {

		$HOST = "localhost";
		$USER = "root";
		$PASSWORD = "";
		$DATABASE = "th";
	
		return mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
	}

?>