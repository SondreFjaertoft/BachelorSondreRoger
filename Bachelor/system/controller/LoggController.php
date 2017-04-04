<?php

require_once("Controller.php");

class LoggController extends Controller {
    
    public function show($page){
        if ($page == "logg"){
            $this->loggPage();
        } else if ($page == "getAllLoggInfo"){
            $this->getAllLoggInfo();
        }
    }
    
    private function loggPage() {
        return $this->render("logg");
    }
    
    private function getAllLoggInfo(){
        $loggModel = $GLOBALS["loggModel"];
        $LoggInfo = $loggModel->getAllLoggInfo();
        
        $data = json_encode(array("allLoggInfo" => $LoggInfo));
        echo $data;
        
        $params = 
                array("type" => "innlogging", 
                    "dec" => "bruker logger inn", 
                    "storageID" => "storageID", 
                    "fromStorageID" => "fromStorageID", 
                    "toStorageID" => "toStorageID", 
                    "quantity" => "quantity", 
                    "oldQuantity" => "oldQuantity", 
                    "newQuantity" => "newQuantity", 
                    "differential" => "differential", 
                    "userID" => "userID", 
                    "onUserID" => "onUserID", 
                    "productID" => "productID", 
                    "date" => "date", 
                    "customerNr" => "customerNr");

    }
    
}
