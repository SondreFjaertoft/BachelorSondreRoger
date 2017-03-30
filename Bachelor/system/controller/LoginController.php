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

        foreach ($Users as $User) {
            if ($User["username"] == $givenUsername) {
                if ($User["password"] == $givenPassword) {
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
