<?php

require_once("Controller.php");

// Represents home page
class HomeController extends Controller {

    // Render "Overview" view

    public function show($page) {
        $this->render("home");
         
    }
    
}    
    


