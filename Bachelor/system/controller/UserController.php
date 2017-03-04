<?php

require_once("Controller.php");

class UserController extends Controller {

    public function show($page) {
        if ($page == "userAdm") {
            $this->userAdmPage();
        }  else if ($page == "editUserEngine") {
            $this->userEditEngine();
        } else if ($page == "deleteUserEngine") {
            $this->deleteUserEngine();
        } else if ($page == "addRestriction") {
            $this->addRestriction();
        }
        
        //AJAX CALL
          else if ($page == "getUserInfo") {
            $this->getUserInfo(); 
        } else if ($page == "addUserEngine") {
            $this->userCreationEngine();
        } else if ($page== "getUserByID"){
            $this->getUserByID();
        }
            
    }

    private function userAdmPage() {
        $userInfo = $GLOBALS["userModel"];
        

        if (isset($_POST['givenUserSearchWord'])) {
            $givenSearchWord = "%{$_REQUEST["givenUserSearchWord"]}%";
            $userModel = $userInfo->getSearchResult($givenSearchWord);
        } else {
            $givenSearchWord = "%%";
            $userModel = $userInfo->getSearchResult($givenSearchWord);
        }

        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllStorageRestrictionInfo();
        
        $storageInfo = $GLOBALS["storageModel"];
        $storageModel = $storageInfo->getAll();

        //$givenSearchWord = $_REQUEST["givenSearchWord"];
        //if (isset($_POST['givenSearchWord'])) {
        //      $givenSearchResult = $givenSearchWord->getSearchResults();  
        //}


        $data = array("userInfo" => $userModel, "restrictionInfo" => $restrictionModel, "storageInfo" => $storageModel);
        return $this->render("userAdm", $data);
    }

    private function userEditEngine() {
        $editUserID = $_REQUEST["editUserID"];
        $editName = $_REQUEST["editName"];
        $editUsername = $_REQUEST["editUsername"];
        $editPassword = $_REQUEST["editPassword"];
        $editUserLevel = $_REQUEST["editUserLevel"];
        $editEmail = $_REQUEST["editEmail"];

        $userEditInfo = $GLOBALS["userModel"];
        $edited = $userEditInfo->editUser($editName, $editUsername, $editPassword, $editUserLevel, $editEmail, $editUserID);

        header("Location:index.php?page=userAdm");
        
    }

    
    
    private function addRestriction() {
        if (isset($_POST['userRestrictions']) && isset($_POST['storageRestrictions'])) {
            $givenUserArray = $_REQUEST['userRestrictions'];
            $givenStorageArray = $_REQUEST['storageRestrictions'];
            
            $addRestriction = $GLOBALS["restrictionModel"];
   
            
            foreach ($givenUserArray as $givenUserID) :
                
                foreach ($givenStorageArray as $givenStorageID) :
                $addRestriction->addRestriction($givenUserID, $givenStorageID);
                endforeach;
            endforeach;
            
            
            
            
            
        }
        
        header("Location:index.php?page=userAdm");
        
    }
    
    // FORESPØRSLER GJOR VED AJAX
    
    private function getUserInfo() {
        $userInfo = $GLOBALS["userModel"];
          
        if (isset($_POST['givenUserSearchWord'])) {
        $givenSearchWord = "%{$_REQUEST["givenUserSearchWord"]}%";
        $userModel = $userInfo->getSearchResult($givenSearchWord);
        } else {
        $givenSearchWord = "%%";
        $userModel = $userInfo->getSearchResult($givenSearchWord);
        }
        
        $data = json_encode(array("users" => $userModel));
        echo $data;
    }

    
    private function userCreationEngine() {
        $givenName = $_REQUEST["givenName"];
        $givenUsername = $_REQUEST["givenUsername"];
        $givenPassword = $_REQUEST["givenPassword"];
        $givenUserLevel = $_REQUEST["givenUserLevel"];
        $givenEmail = $_REQUEST["givenEmail"];

        $userCreationInfo = $GLOBALS["userModel"];
        $added = $userCreationInfo->addUser($givenName, $givenUsername, $givenPassword, $givenUserLevel, $givenEmail);
        
        $addedUser = $userCreationInfo->getAllUserInfoFromID($added);
        $data = json_encode(array("addedUser" => $addedUser));
        
        echo $data;
    }
    
    private function getUserByID(){
        $givenUserID = $_REQUEST["givenUserID"];
        
        $userInfo = $GLOBALS["userModel"];
        $userModel = $userInfo->getAllUserInfoFromID($givenUserID);
        
        $data = json_encode(array("user" => $userModel));
        echo $data;
        
    }
    
        private function deleteUserEngine() {
        $removeUserID = $_REQUEST["deleteUserID"];

        $removeUser = $GLOBALS["userModel"];
        $removeUser->removeUser($removeUserID); 
        
        echo json_encode("success");
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

