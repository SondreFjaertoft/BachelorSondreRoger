<?php

require_once("Controller.php");

class UserController extends Controller {

    public function show($page) {
        if ($page == "userAdm") {
            $this->userAdmPage();
        } else if ($page == "addUserEngine") {
            $this->userCreationEngine();
        } else if ($page == "editUserEngine") {
            $this->userEditEngine();
        } else if ($page == "deleteUserEngine") {
            $this->deleteUserEngine();
        } else if ($page == "searchUserEngine") {
            $this->searchUserEngine();
        }
    }

    private function userAdmPage() {
        $userInfo = $GLOBALS["userModel"];
        

        if (isset($_POST['givenSearchWord'])) {
            $givenSearchWord = "%{$_REQUEST["givenSearchWord"]}%";
            $userModel = $userInfo->getSearchResult($givenSearchWord);
        } else {
            $givenSearchWord = "%%";
            $userModel = $userInfo->getSearchResult($givenSearchWord);
        }

        $restrictionInfo = $GLOBALS["restrictionModel"];
        $restrictionModel = $restrictionInfo->getAllRestrictionInfo();

        //$givenSearchWord = $_REQUEST["givenSearchWord"];
        //if (isset($_POST['givenSearchWord'])) {
        //      $givenSearchResult = $givenSearchWord->getSearchResults();  
        //}


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

    private function deleteUserEngine() {
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

