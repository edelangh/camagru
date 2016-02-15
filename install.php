<?php
include("config/database.php");
include("include/mysql.php");
$bdd->query('CREATE DATABASE camagru');
$bdd->query('CREATE TABLE `camagru`.`users` ( `id` INT(10) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `mail` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , UNIQUE (`id`))');
?>