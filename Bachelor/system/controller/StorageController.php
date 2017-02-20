<?php 

require_once("Controller.php");

class StorageController extends Controller {

    public function show($page) {
        if ($page == "storageAdm") {
            $this->storageCreationPage();
        } else if ($page == "addStorageEngine"){
            $this->storageCreationEngine();
        }
    }

    private function storageCreationPage() {
        
       $storageInfi = $_GLOBALS["storageModel"];
       
       if (isset($_POST['givenStorageSearchWord'])) {
           $givenStorageSearchWord = "%{$_REQUEST["givenStorageSearchWord"]}%";
       }
       
       
        return $this->render("storageAdm");
    }
    
        private function storageCreationEngine() {
        $givenStorageName = $_REQUEST["givenStorageName"];
  
        $userCreationInfo = $GLOBALS["storageModel"];
        $added = $userCreationInfo->addStorage($givenStorageName);
        
//        $data = array(
//            "added"=>$added,
//            "givenUser"=>$givenUsername
//        );
        return $this->render("storageAdm");
    }
}