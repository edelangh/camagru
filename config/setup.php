<?php
include_once("config/database.php");
include_once("config/tools/mysql.php");

echo "Init DATABASE: ";
	$db->query('CREATE DATABASE IF NOT EXISTS `camagru`');
echo "OK </br>";

echo "Init User Table: ";
$db->query('CREATE TABLE IF NOT EXISTS `camagru`.`users` ( `id` INT(10) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `mail` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `token_verif` VARCHAR(255) NOT NULL, `token_recup` VARCHAR(255) NOT NULL ,UNIQUE (`id`))');
echo "OK </br>";

echo "Init Image Table: ";
$db->query('CREATE TABLE IF NOT EXISTS `camagru`.`images` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`user_id` INT NOT NULL ,
	`name` VARCHAR(255) NOT NULL ,
	`comment` TEXT NOT NULL,
	`path` VARCHAR(255) NOT NULL ,
	`timestamp` TIMESTAMP NOT NULL ,
	UNIQUE (`id`)) ENGINE = InnoDB;');
echo "OK </br>";
?>
