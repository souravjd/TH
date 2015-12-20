DROP DATABASE IF EXISTS `TH`;
CREATE DATABASE IF NOT EXISTS `TH`;
USE `TH`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	`user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_mail` varchar(128) NOT NULL,
	`user_password` varchar(128) NOT NULL,
	`user_name` varchar(64),
	`user_doj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`user_state` tinyint(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`user_id`)
) AUTO_INCREMENT = 1;

INSERT INTO `users` (`user_id`, `user_mail`, `user_password`, `user_name`, `user_doj`, `user_state`) VALUES
(1, 'demo@demo.demo', 'demo', NULL, '2015-12-20 13:35:45', 1);