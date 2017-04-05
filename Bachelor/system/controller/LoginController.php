<?php

require_once("Controller.php");

class LoginController extends Controller {

    public function show($page) {
        if ($page == "loginEngine") {
            $this->loginEngine();
        } else {
            $this->displayLoginPage();
            
        }
    }

    public function displayLoginPage() {
        return $this->render("loginPage");
    }

    public function loginEngine() {
        
        $givenUsername = $_REQUEST["givenUsername"];
        $givenPassword = $_REQUEST["givenPassword"];
        $givenLastLogin = $_REQUEST["givenLastLogin"]; 
        

        $userModel = $GLOBALS["userModel"];
        $userModel->updateLastLogin($givenLastLogin, $givenUsername);
        
        $Users = $userModel->getAllUserInfo();
        
        $hsah = '$2y$10$KvGNnb4q7nFZ9gnb/uB/z.XgiSNhqaheJne3CoKgiSmCVPNZwrK6y';
        foreach ($Users as $User) {
            if ($User["username"] == $givenUsername) {
                if (password_verify($User["username"], $hsah)) {
                    $_SESSION["AreLoggedIn"] = "true";
                    $_SESSION["nameOfUser"] = $User["name"];  
                    $_SESSION["userID"] = $User["userID"]; 
                    $_SESSION["userLevel"] = $User["userLevel"];
                }  
            }       
        }
        header("Location:system/");
    }

}
        //foreach ($Users as $User) {
        //                $hashpas = $User["passord"];
        //                $Uid = $User["username"];
        //            if ($Uid == $givenUsername) {


//                          if (password_verify($givenPassword, $hashpas)) {
//                              $_SESSION["AreLoggedIn"] = "true";
//                              $_SESSION["nameOfUser"] = $User["name"];  
//                              $_SESSION["userID"] = $User["userID"]; 
//                              $_SESSION["userLevel"] = $User["userLevel"];
//                          }  
//                      }       
//                  }