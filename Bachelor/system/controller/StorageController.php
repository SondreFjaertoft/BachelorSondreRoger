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
       
       
       
       $data = array("storageResult" => $storageModel);
       
       
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
            
            header("Location:index.php?page=storageAdm"); 
        }
    
}