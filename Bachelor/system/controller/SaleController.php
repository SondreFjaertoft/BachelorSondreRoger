<?php

require_once("Controller.php");

class SaleController extends Controller {

    public function show($page) {
        if ($page == "sale") {
            $this->salePage();
        } else if ($page == "withdrawProduct"){
            $this->withdrawProduct();
        } 
    }

    private function salePage() {
        return $this->render("sale");
    }
    
    private function withdrawProduct(){
        $fromStorageID = $_REQUEST["fromStorageID"];
        $withdrawProductIDArray = $_REQUEST["withdrawProductID"];
        $withdrawQuantityArray = $_REQUEST["withdrawQuantity"];
        $customerNumber = $_REQUEST["customerNumber"];
        $userID = $_SESSION["userID"];
        $comment = $_REQUEST["withdrawComment"];
        $date;
        

        if ($fromStorageID == 0) {
            return false;
        } else {
        
             for ($i = 0; $i < sizeof($withdrawProductIDArray); $i++) {
               
            
                $saleModel = $GLOBALS["saleModel"];
            
                $saleModel->newSale($fromStorageID, $customerNumber, $withdrawProductIDArray[$i], $withdrawQuantityArray[$i], $userID, $comment, $date);
            
             } 
        }
    }
}
    