<?php
include("config/database.php");
include("config/tools/mysql.php");
$db->query('CREATE DATABASE camagru');

$db->query('CREATE TABLE `camagru`.`users` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(255) NOT NULL ,
	`mail` VARCHAR(255) NOT NULL ,
	`password` VARCHAR(255) NOT NULL ,
	`token_verif` VARCHAR(255) NOT NULL
	,UNIQUE (`id`))');

$db->query('CREATE TABLE `camagru`.`images` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`user_id` INT NOT NULL ,
	`name` VARCHAR(255) NOT NULL ,
	`comment` TEXT NOT NULL,
	`path` VARCHAR(255) NOT NULL ,
	`timestamp` TIMESTAMP NOT NULL ,
	UNIQUE (`id`)) ENGINE = InnoDB;');
echo "ok";
?>
