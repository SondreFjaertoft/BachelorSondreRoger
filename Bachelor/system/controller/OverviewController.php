<?php

require_once("Controller.php");

// Represents home page
class OverviewController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "dummy") {
            $this->showDummy();
         
        } else if ($page == "dummyAdd") {
            $this->addDummy();
            
        }
    }
    

    private function showDummy() {
        $dummyInfo = $GLOBALS["dummy"];
        $dummy = $dummyInfo->getAll();

        $data = array("dummyInfo" => $dummy);
        return $this->render("overview", $data);
    }

    
    private function addDummy() {
        $givenID = $_REQUEST["givenID"];
        $givenUser = $_REQUEST["givenUser"];
        $givenTekst = $_REQUEST["givenTekst"];
        
        $dummyInfo = $GLOBALS["dummy"];
        $added = $dummyInfo->addDummy($givenID,$givenUser, $givenTekst);
        
        $data = array(
            "added"=> $added,
            "givenUser"=>$givenUser
                );
        return $this->render("overview", $data);
    }

}
