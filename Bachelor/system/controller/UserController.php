<?php

require_once("Controller.php");

class UserController extends Controller {

    public function show($page) {
        if ($page == "userAdm") {
            $this->userAdmPage();
        }    else if ($page == "addRestriction") {
            $this->addRestriction();
        } else if ($page == "getUserInfo") {
            $this->getUserInfo(); 
        } else if ($page == "addUserEngine") {
            $this->userCreationEngine();
        } else if ($page == "getUserByID"){
            $this->getUserByID();
        } else if ($page == "getUserRestriction"){
            $this->getUserRestriction();
        } else if ($page == "deleteUserEngine") {
            $this->deleteUserEngine();
        } else if ($page == "editUserEngine") {
            $this->userEditEngine();
        }
            
    }

    private function userAdmPage() {
        return $this->render("userAdm");
    }

    private function userEditEngine() {
        $editUserID = $_REQUEST["editUserID"];
        $editName = $_REQUEST["editName"];
        $editUsername = $_REQUEST["editUsername"];
        $editPassword = $_REQUEST["editPassword"];
        $editUserLevel = $_REQUEST["editUserLevel"];
        $editEmail = $_REQUEST["editEmail"];

        $userEditInfo = $GLOBALS["userModel"];
        $userEditInfo->editUser($editName, $editUsername, $editPassword, $editUserLevel, $editEmail, $editUserID);

        echo json_encode("success");
        
    }

    
    
    private function addRestriction() {
        if (isset($_POST['userRestrictions']) && isset($_POST['storageRestrictions'])) {
            $givenUserArray = $_REQUEST['userRestrictions'];
            $givenStorageArray = $_REQUEST['storageRestrictions'];
            
            $addRestriction = $GLOBALS["restrictionModel"];
            
            foreach ($givenUserArray as $givenUserID) :
                
                foreach ($givenStorageArray as $givenStorageID) :
                $data = $addRestriction->addRestriction($givenUserID, $givenStorageID);
                endforeach;
            endforeach;  
        echo json_encode("success");
            
        } 
        
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
        if($added){
        $data = json_encode("success");
        
        echo $data;
        } else {
        return false;    
        }
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
        
        $removeUserRestriction = $GLOBALS["restrictionModel"];
        $removeUserRestriction->deleteUserRestriction($removeUserID);
        
        $removeUser = $GLOBALS["userModel"];
        $removeUser->removeUser($removeUserID);
        
        
        echo json_encode("success");
    }
    
    private function getUserRestriction(){
        $givenUserID = $_REQUEST['givenUserID'];
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfoFromUserID($givenUserID);
        
        $data = json_encode(array("restriction" => $restrictionModel));
        echo $data;
    }
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

