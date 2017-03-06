<?php

require_once("Controller.php");

// Represents home page
class transferController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "transfer") {
            $this->transferPage();
        } else if ($page == "getTransferRestriction"){
            $this->getTransferRestriction();
        }
    }

    private function transferPage() {
        $givenUserID = $_SESSION["userID"];
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromUserID($givenUserID);

        $data = array("restrictionInfo" => $restrictionModel);

        return $this->render("transfer", $data);
    }
    
    private function getTransferRestriction(){
        $givenUserID = $_SESSION["userID"];
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromUserID($givenUserID);
    
        $data = json_encode(array("transferRestriction" => $restrictionModel));
        echo $data;
    }

}
