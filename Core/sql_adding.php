<?php
$localhost = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($localhost, $username, $password);

if(!$conn){
  echo "problem";
}

//Create DB and Select it

$sql = "CREATE DATABASE IF NOT EXISTS phone_book";

if(!mysqli_query($conn, $sql)){
  echo ("Error Creating Database".mysqli_error($conn));
}

$db_selected = mysqli_select_db($conn, 'phone_book' );
if (!$db_selected) {
  die ('Не удалось выбрать базу foo: ' . mysqli_error());
}

//Create table groups

$sql1 = "CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
";

if(!mysqli_query($conn, $sql1)){
  echo ("Error Creating table".mysqli_error($conn));
}

//insert groups (admin, moderator, standart user)
//
//$sql2 = "
//INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
//(1, 'Standart user', ''),
//(2, 'Administrator', '{\r\n\\`admin\\`: 1,\r\n\\`moderator\\`:1\r\n}');";
//
//if(!mysqli_query($conn, $sql2)){
//  echo ("Error Creating Database".mysqli_error($conn));
//}

//Create table phonebook

$sql3 = "CREATE TABLE IF NOT EXISTS `phonebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `email` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";

if(!mysqli_query($conn, $sql3)){
  echo ("Error Creating Database".mysqli_error($conn));
}

//Create table users

$sql4 = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;";

if(!mysqli_query($conn, $sql4)){
  echo ("Error Creating Database".mysqli_error($conn));
}

//Create table user_session

$sql5 = "CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if(!mysqli_query($conn, $sql5)){
  echo ("Error Creating Database".mysqli_error($conn));
}

