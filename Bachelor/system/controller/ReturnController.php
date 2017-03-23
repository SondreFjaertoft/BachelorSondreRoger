<?php

require_once("Controller.php");

class ReturnController extends Controller {
    
    public function show($page){
        if ($page == "return"){
            $this->returnPage();
        } else if ($page == "myReturns"){
            $this->myReturnsPage();
        } else if ($page == "getMyReturns"){
            $this->getAllMyReturns();
        }
    }
    
    private function returnPage() {
        return $this->render("return");
    }
    
    private function myReturnsPage(){
        return $this->render("myReturns");
    }
    
    
    private function getAllMyReturns(){
        $givenUserID = $_SESSION["userID"];
        
        $returnModel = $GLOBALS["returnModel"];
        $myReturns = $returnModel->getAllReturnInfo($givenUserID);
        
        $data = json_encode(array("myReturns" => $myReturns));
        echo $data;
    }
    
}