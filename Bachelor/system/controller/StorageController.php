<?php 

require_once("Controller.php");

class StorageController extends Controller {

    public function show($page) {
        if ($page == "storageAdm") {
            $this->storageAdmPage();
        } else if ($page == "addStorageEngine"){
            $this->storageCreationEngine();
        } else if ($page == "editStorageEngine") {
            $this->storageEditEngine();
        } else if ($page == "deleteStorageEngine") {
            $this->deleteStorageEngine();
        } else if ($page == "getAllStorageInfo"){
            $this->getAllStorageInfo();
        } else if ($page == "getStorageByID") {
            $this->getStorageByID();
        }
    }

    private function storageAdmPage() {
        
       $storageInfo = $GLOBALS["storageModel"];
       
       if (isset($_POST['givenStorageSearchWord'])) {
           $givenStorageSearchWord = "%{$_REQUEST["givenStorageSearchWord"]}%";
           $storageModel = $storageInfo->getSearchResult($givenStorageSearchWord);
       } else {
           $givenStorageSearchWord = "%%";
           $storageModel = $storageInfo->getSearchResult($givenStorageSearchWord);
       }
       
       $restrictionInfo = $GLOBALS["restrictionModel"];
       $restrictionModel = $restrictionInfo->getAllUserRestrictionInfo();
       
       $inventoryInfo = $GLOBALS["inventoryModel"];
       $inventoryModel = $inventoryInfo->getAllStorageInventory();
       
       $data = array("storageResult" => $storageModel, "storageAccess" => $restrictionModel, "storageInventory" => $inventoryModel);
       
       
        return $this->render("storageAdm", $data);
    }
    
    
    
        private function storageCreationEngine() {
        $givenStorageName = $_REQUEST["givenStorageName"];
  
        $userCreationInfo = $GLOBALS["storageModel"];
        $added = $userCreationInfo->addStorage($givenStorageName);
        
//        $data = array(
//            "added"=>$added,
//            "givenUser"=>$givenUsername
//        );
        header("Location:index.php?page=storageAdm");
        }
    
    
        private function storageEditEngine()    {
            $editStorageID = $_REQUEST["editStorageID"];
            $editStorageName = $_REQUEST["editStorageName"];
            
            $storageEditInfo = $GLOBALS["storageModel"];
            $edited = $storageEditInfo->editStorage($editStorageName, $editStorageID);
            
            header("Location:index.php?page=storageAdm");
        }
        
        
        private function deleteStorageEngine() {
            $removeStorageID = $_REQUEST["deleteStorageID"];
            
            $removeStorage = $GLOBALS["storageModel"];
            $removeStorage->removeStorage($removeStorageID);
            
            echo json_encode("success");
        }
        
        
        private function getAllStorageInfo() {
        $storageInfo = $GLOBALS["storageModel"];
        $storageModel = $storageInfo->getAll();

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
        
        
    
}