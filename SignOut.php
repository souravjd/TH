<?php

	session_start();

	include '_config.php';

	session_destroy();
	
	header("location: ".$SITE['url']);

?>