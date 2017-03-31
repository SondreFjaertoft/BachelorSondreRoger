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
        } else if ($page == "getProdQuantity"){
            $this->getProdQuantity (); 
        } else if ($page == "mySales") {
            $this->getMySalesPage();
        } else if ($page == "getMySales"){
            $this->getAllMySales();
        } else if ($page == "getSalesFromID"){
            $this->getSalesFromID();
        } else if ($page == "editMySale"){
            $this->editMySale();
        }
    }

    private function salePage() {
        return $this->render("sale");
    }
    
    private function getMySalesPage() {
        return $this->render("mySales");
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
    
    private function getProdQuantity(){
        $givenStorageID = $_REQUEST["givenStorageID"];
        $givenProductID = $_REQUEST["givenProductID"];
        
        $inventoryInfo = $GLOBALS["inventoryModel"];
        
        $inventoryModel = $inventoryInfo->getProdFromStorageIDAndProductID($givenStorageID, $givenProductID);

        $data = json_encode(array("prodInfo" => $inventoryModel));
        echo $data;   
    }
    
    private function getAllMySales(){
        $givenUserID = $_SESSION["userID"];
        
        $saleModel = $GLOBALS["saleModel"];

        if (isset($_POST['givenProductSearchWord'])) {
            $givenProductSearchWord = "%{$_REQUEST["givenProductSearchWord"]}%";
            $mySales = $saleModel->getMySales($givenUserID, $givenProductSearchWord);
        } else {
            $givenProductSearchWord = "%%";
            $mySales = $saleModel->getMySales($givenUserID, $givenProductSearchWord);
        }
        
        $data = json_encode(array("mySales" => $mySales));
        echo $data;
    }
    
    private function getSalesFromID(){
        $givenSalesID = $_REQUEST["givenSalesID"];
        
        $saleModel = $GLOBALS["saleModel"];
        
        $saleFromID = $saleModel->getSaleFromID($givenSalesID);
        
        $data = json_encode(array("sale" => $saleFromID));
        echo $data;
    }
    
    private function editMySale(){
        $editSaleID = $_REQUEST["editSaleID"];
        $editCustomerNr = $_REQUEST["editCustomerNr"];
        $editComment = $_REQUEST["editComment"];
        
        $saleModel = $GLOBALS["saleModel"];
        $edited = $saleModel->editMySale($editSaleID, $editCustomerNr, $editComment);        
           
        if($edited){
            echo json_encode("success");
        }
    }
}
    