<?php

require_once("Controller.php");

// Represents home page
class transferController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "transfer") {
            $this->transferPage();
        } else if ($page == "testingAjax"){
            $this->testingajax();
        } else if ($page == "getAjaxResult"){
            $this->getAjaxResult();
        }
    }

    private function transferPage() {
        $givenUserID = $_SESSION["userID"];
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromUserID($givenUserID);

        $data = array("restrictionInfo" => $restrictionModel);

        return $this->render("transfer", $data);
    }

    // TESTING:
    
    

   private function testingajax() {
       
             $givenUserID = $_REQUEST["givenUserID"];       //name value sent from form in transfer.php
             $givenStorageID = $_REQUEST["givenStorageID"];   //name value sent from form in transfer.php
             
             //connecte opp mot model for testing (restriction model)
            $restrictionInfo = $GLOBALS["restrictionModel"];
            $restrictionInfo->addRestriction($givenUserID, $givenStorageID);   
            

    }
    
    private function getAjaxResult() {
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllUserRestrictionInfo();   
        
        var_dump($restrictionModel);
        
       
            
        
    }

}
