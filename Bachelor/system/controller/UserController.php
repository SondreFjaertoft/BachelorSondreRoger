<?php 

require_once("Controller.php");

class UserController extends Controller {

    public function show($page) {
        if ($page == "createUser") {
            $this->userCreationPage();
        } else if ($page == "addUserEngine"){
            $this->userCreationEngine();
        }
    }

    private function userCreationPage() {
        $userInfo = $GLOBALS["userModel"];
        $userModel = $userInfo->getAllUserInfo();
        
        $data = array("userInfo" => $userModel);
        return $this->render("createUser", $data);
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
        header("Location:index.php?page=createUser");
    }



}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

