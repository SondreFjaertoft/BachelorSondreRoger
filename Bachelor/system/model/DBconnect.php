<?php


  require_once("dummy.php");
  require_once("UserModel.php");

//connection to the database
$dbConn = new PDO('mysql:host=localhost;dbname=tafjord;charset=utf8mb4', 'root', 'Tafjord123');

// Create data models
$dummy = new Dummy($dbConn);
$userModel = new UserModel($dbConn);


// TODO - create new models here. First create them as a new class
// TODO - once you have more model classes, perhaps some of the functions can be moved to a common parent class?
