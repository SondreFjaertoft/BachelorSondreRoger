<?php

require_once("Controller.php");

class StorageController extends Controller {

    public function show($page) {
        if ($page == "storageAdm") {
            $this->storageAdmPage();
        } else if ($page == "addStorageEngine") {
            $this->storageCreationEngine();
        } else if ($page == "editStorageEngine") {
            $this->storageEditEngine();
        } else if ($page == "deleteStorageEngine") {
            $this->deleteStorageEngine();
        } else if ($page == "getAllStorageInfo") {
            $this->getAllStorageInfo();
        } else if ($page == "getStorageByID") {
            $this->getStorageByID();
        } else if ($page == "getStorageRestriction") {
            $this->getStorageRestriction();
        } else if ($page == "getStorageProduct") {
            $this->getStorageProduct();
        } else if ($page == "chartProduct"){
            $this->chartProduct();
        } else if ($page == "deleteSingleProd"){
            $this->deleteSingleProd();
        } else if ($page == "stocktacking"){
            $this->stocktacking();
        } 
    }

    
    private function storageAdmPage() {
        return $this->render("storageAdm");
    }

    private function storageCreationEngine() {
        $givenStorageName = $_REQUEST["givenStorageName"];
        $sessionID = $_SESSION["userID"];
        
        $setSessionID = $GLOBALS["userModel"];
        $setSessionID->setSession($sessionID);
        
        $storageCreationInfo = $GLOBALS["storageModel"];
        $storageCreationInfo->addStorage($givenStorageName);

        echo json_encode("success");
    }

    private function storageEditEngine() {
        $editStorageID = $_REQUEST["editStorageID"];
        $editStorageName = $_REQUEST["editStorageName"];

        $storageEditInfo = $GLOBALS["storageModel"];
        $storageEditInfo->editStorage($editStorageName, $editStorageID);

        echo json_encode("success");
    }

    private function deleteStorageEngine() {
        $removeStorageID = $_REQUEST["deleteStorageID"];

        if($removeStorageID != 1){
        $deleteInventory = $GLOBALS["inventoryModel"];
        $deleteInventory->deleteInventory($removeStorageID);
        
        $removeStorage = $GLOBALS["storageModel"];
        $removeStorage->removeStorage($removeStorageID);
        
        $restrictionModel = $GLOBALS["restrictionModel"];
        $restrictionModel->deleteResStorageID($removeStorageID);

        echo json_encode("success");
        }
    }

    private function getAllStorageInfo() {
        $storageInfo = $GLOBALS["storageModel"];

        if (isset($_POST['givenStorageSearchWord'])) {
            $givenStorageSearchWord = "%{$_REQUEST["givenStorageSearchWord"]}%";
            $storageModel = $storageInfo->getSearchResult($givenStorageSearchWord);
        } else {
            $givenStorageSearchWord = "%%";
            $storageModel = $storageInfo->getSearchResult($givenStorageSearchWord);
        }

        $data = json_encode(array("storageInfo" => $storageModel));

        echo $data;
    }

    private function getStorageByID() {
        $givenStorageID = $_REQUEST["givenStorageID"];

        $storageInfo = $GLOBALS["storageModel"];
        $storageModel = $storageInfo->getAllStorageInfoFromID($givenStorageID);

        $data = json_encode(array("storage" => $storageModel));
        echo $data;
    }

    private function getStorageRestriction() {
        $givenStorageID = $_REQUEST['givenStorageID'];

        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromStorageID($givenStorageID);

        $data = json_encode(array("storageRestriction" => $restrictionModel));
        echo $data;
    }

    private function getStorageProduct() {       
        $inventoryInfo = $GLOBALS["inventoryModel"];
        
        if (isset($_POST['givenStorageID'])) {
            $givenStorageID = $_REQUEST['givenStorageID'];
            $inventoryModel = $inventoryInfo->getAllStorageInventoryByStorageID($givenStorageID);
        } else {
            $givenUserID = $_SESSION["userID"];
            $restrictionInfo = $GLOBALS["restrictionModel"];
            $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromUserID($givenUserID);
            
            $givenStorageID = $restrictionModel[0]['storageID'];;
            $inventoryModel = $inventoryInfo->getAllStorageInventoryByStorageID($givenStorageID);
        }

        

        $data = json_encode(array("storageProduct" => $inventoryModel));
        echo $data;
    }

    private function chartProduct() {
        $givenStorageID = $_REQUEST['givenStorageID'];

        $inventoryInfo = $GLOBALS["inventoryModel"];
        $inventoryModel = $inventoryInfo->getAllStorageInventoryByStorageID($givenStorageID);

        $data = json_encode($inventoryModel);
        echo $data;
    }
    
    private function deleteSingleProd(){
        $givenProductID = $_REQUEST["givenProductID"];
        $givenStorageID = $_REQUEST["givenStorageID"];
        $sessionID = $_SESSION["userID"];
        
        $setSessionID = $GLOBALS["userModel"];
        $deletedProd = $GLOBALS["inventoryModel"];
        
        $setSessionID->setSession($sessionID);
        $deleted = $deletedProd->deleteSingleProduct($givenProductID, $givenStorageID);
        
        if($deleted){
        echo json_encode("success");
        }
    }
    
    private function stocktacking(){
        if (isset($_POST['oldQuantityArray'])) {
        $givenStorageID = $_REQUEST["givenStorageID"];
        $givenProductIDArray = $_REQUEST["givenProductArray"]; 
        $oldQuantityArray = $_REQUEST["oldQuantityArray"];  
        $givenProductNameArray = $_REQUEST["givenProductNameArray"];
        $givenQuantityArray = $_REQUEST["givenQuantityArray"];
    
        for ($i = 0; $i < sizeof($givenProductIDArray); $i++){
            $differance = $givenQuantityArray[$i] - $oldQuantityArray[$i];

            $differanceArray[] = (object) array('productID' => $givenProductIDArray[$i], 'differance' => $differance, 'oldQuantity' => $oldQuantityArray[$i], 
                'newQuantity' => $givenQuantityArray[$i], 'productName' => $givenProductNameArray[$i], 'storageID' =>  $givenStorageID);
        }
        
        $data = json_encode(array("differanceArray" => $differanceArray));
        echo $data;
        
        }else{

        $givenStorageID = $_REQUEST["givenStorageID"];
        $givenProductIDArray = $_REQUEST["givenProductArray"];
        $givenQuantityArray = $_REQUEST["givenQuantityArray"];
        
        for ($i = 0; $i < sizeof($givenProductIDArray); $i++){

            $inventoryInfo = $GLOBALS["inventoryModel"];
            $inventoryInfo->updateInventory($givenStorageID, $givenProductIDArray[$i], $givenQuantityArray[$i]);
        }
        
        echo json_encode("success");
        

        }   
    }

}
