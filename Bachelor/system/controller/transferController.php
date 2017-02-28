<?php

require_once("Controller.php");

// Represents home page
class transferController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "transfer") {
            $this->transferPage();
        }
    }
    
    private function transferPage() {
        
        $storageInfo = $GLOBALS["storageModel"];
        $storageModel = $storageInfo->getAll();
        
        $data = array("storageInfo" => $storageModel);
        
    return $this->render("transfer", $data);
    }
            
            
}