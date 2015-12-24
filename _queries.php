<?php

	## SIGNUP QUERIES
	$sql_users['checkMail'] = "SELECT `user_mail` FROM `users` WHERE `user_mail` = ";
	$sql_users['signUp'] = "INSERT INTO `users` (`user_mail`, `user_password`) VALUES ";

	## SIGNIN QUERIES
	$sql_users['signInCheck'] = "SELECT * FROM `users` WHERE `user_mail` = ";

	## SESSION QUERIES
	$sql_users['sessionFetch'] = "SELECT `user_id`, `user_mail`, `user_name`, `user_doj`, `user_state` FROM `users` WHERE MD5(`user_mail`) = ";

	## ACCOUNT QUERIES
	$sql_users['changeName'] = "UPDATE `users` SET `user_name` = ";
	$sql_users['mailPasswordCheck'] = "SELECT count(`user_doj`) AS chk FROM `users` WHERE MD5(`user_mail`) = ";
	$sql_users['changePassword'] = "UPDATE `users` SET `user_password` = ";
?>