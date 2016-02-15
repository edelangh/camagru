<?php
include("config/database.php");
include("config/tools/mysql.php");
$db->query('CREATE DATABASE camagru');
$db->query('CREATE TABLE `camagru`.`users` ( `id` INT(10) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `mail` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `token_verif` VARCHAR(15) NOT NULL ,UNIQUE (`id`))');
?>