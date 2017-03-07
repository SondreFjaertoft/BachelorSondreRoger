<?php

require_once("Controller.php");

class SaleController extends Controller {

    public function show($page) {
        if ($page == "sale") {
            $this->salePage();
        } else if ($page == "withdrawProduct"){
            $this->withdrawProduct();
        } else if ($page == "saleFromStorageID"){
            $this->saleFromStorageID();
        }
    }

    private function salePage() {
        return $this->render("sale");
    }
    
    private function saleFromStorageID(){
        $givenStorageID = $_REQUEST["saleStorageID"];
        $saleModel = $GLOBALS["saleModel"];
        $saleInfo = $saleModel->getSaleFromStorageID($givenStorageID);
        
        $data = json_encode(array("saleFromStorage" => $saleInfo));
        echo $data;

    }
    
    private function withdrawProduct(){
        $fromStorageID = $_REQUEST["fromStorageID"];
        $withdrawProductIDArray = $_REQUEST["withdrawProductID"];
        $withdrawQuantityArray = $_REQUEST["withdrawQuantity"];
        $customerNumber = $_REQUEST["customerNumber"];
        $userID = $_SESSION["userID"];
        $comment = $_REQUEST["withdrawComment"];
        $date = $_REQUEST["date"];
        

        if ($fromStorageID == 0) {
            return false;
        } else {
        
             for ($i = 0; $i < sizeof($withdrawProductIDArray); $i++) {
               
            
                $saleModel = $GLOBALS["saleModel"];
                $inventoryInfo = $GLOBALS["inventoryModel"];
            
                $saleModel->newSale($fromStorageID, $customerNumber, $withdrawProductIDArray[$i], $withdrawQuantityArray[$i], $userID, $comment, $date);
                $inventoryInfo->transferFromStorage($fromStorageID, $withdrawProductIDArray[$i], $withdrawQuantityArray[$i]);
                
                
             } 
             echo json_encode("success");
        }
    }
}
    