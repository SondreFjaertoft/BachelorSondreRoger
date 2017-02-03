<?php

require_once("Controller.php");

// Represents home page
class OverviewController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "overview"){
        $dummytest = $GLOBALS["dummy"];

        $dummy = $dummytest->getAll();
        $data = array("dummy" => $dummy);

        return $this->render("overview", $data);
        }
        else if($page == "addDummy"){
            $this->addDummy();
            
        }
        
        }

}
