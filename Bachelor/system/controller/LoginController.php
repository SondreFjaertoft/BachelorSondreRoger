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

        $userModel = $GLOBALS["userModel"];
        $Users = $userModel->getAll();

        foreach ($Users as $User) {
            if ($User["username"] == $givenUsername) {
                if ($User["password"] == $givenPassword) {
                    $_SESSION["AreLoggedIn"] = "true";
                    
                }  
            }       
        }
        header("Location:system/");
    }

}
