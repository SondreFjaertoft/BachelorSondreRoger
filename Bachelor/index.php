<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Creae a new session with the client
session_start();

//init of the AreLoggedIn Session variable, default false
$_SESSION["AreLoggedIn"] = false;


// View layer - The Same header for all pages
 require("view/header.html");
 
// Controller layer - select page to display (controller will handle it)
// This will select necassary $template and $data
require_once("controller/controllers.php");
require_once("controller/Router.php");
 
// View layer - The same footer for all pages
// require("view/footer.html");

// Global configuration
// require_once("config");

// Model layer - Database functions
 require_once("model/DBconnect.php");


//Creates a new Router
$router = new Router();

//Gets the logincontroller
$controller = $router->getLoginController();

//Calls the show function of the logincontroller
$controller->show($router->getPage());

//Check if the user are logged in, if true the user will be redirected to the main index file.
if($_SESSION["AreLoggedIn"] == true)
{
    header("Location:system/index.php");
}
    
    

