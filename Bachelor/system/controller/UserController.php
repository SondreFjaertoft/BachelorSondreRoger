<?php 

require_once("Controller.php");

class UserController extends Controller {

    public function show($page) {
        if ($page == "userAdm") {
            $this->userCreationPage();
        } else if ($page == "addUserEngine"){
            $this->userCreationEngine();
        } else if ($page == "editUserEngine"){
            $this->userEditEngine();
        } else if ($page == "deleteUserEngine"){
            $this->deleteUserEngine();
        }
    }

    private function userCreationPage() {
        $userInfo = $GLOBALS["userModel"];
        $userModel = $userInfo->getAllUserInfo();
            
        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfo();
        
        
        
        $data = array("userInfo" => $userModel, "restrictionInfo" => $restrictionModel);
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
    
    private function userCreationEngine() {
        $givenName = $_REQUEST["givenName"];
        $givenUsername = $_REQUEST["givenUsername"];
        $givenPassword = $_REQUEST["givenPassword"];
        $givenUserLevel = $_REQUEST["givenUserLevel"];
        $givenEmail = $_REQUEST["givenEmail"];
        
        $userCreationInfo = $GLOBALS["userModel"];
        $added = $userCreationInfo->addUser($givenName, $givenUsername, $givenPassword, $givenUserLevel, $givenEmail);
        
//        $data = array(
//            "added"=>$added,
//            "givenUser"=>$givenUsername
//        );
        header("Location:index.php?page=userAdm");
    }
    
    private function deleteUserEngine(){
        $removeUserID = $_REQUEST["deleteUserID"];
        
        $removeUser = $GLOBALS["userModel"];
        $removeUser->removeUser($removeUserID);
        
       header("Location:index.php?page=userAdm"); 
    }



}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

