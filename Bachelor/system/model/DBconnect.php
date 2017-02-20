<?php


  require_once("dummy.php");
  require_once("UserModel.php");
  require_once("InventoryQuantityModel.php");
  require_once("StorageModel.php");
  require_once("RestrictionModel.php");
  require_once("InventoryModel.php");

//connection to the database
$dbConn = new PDO('mysql:host=localhost;dbname=tafjord;charset=utf8mb4', 'root', 'Tafjord123');

// Create data models
$dummy = new Dummy($dbConn);
$userModel = new UserModel($dbConn);
$storageModel = new StorageModel($dbConn);
$restrictionModel = new RestritionModel($dbConn);
$inventoryQuantityModel = new InventoryQuantityModel($dbConn);
$inventoryModel = new InventoryModel($dbConn);


// TODO - create new models here. First create them as a new class
// TODO - once you have more model classes, perhaps some of the functions can be moved to a common parent class?

