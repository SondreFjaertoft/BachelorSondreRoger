<?php

// Controller layer - the router selects controller to use depending on URL and request parameters

class Router {

    // Returns the requested page name

    public function getPage() {
        // Get page from request, or use default
        if (isset($_REQUEST["page"])) {
            $page = $_REQUEST["page"];
        } else {
            // $page = GLOBALS["DEFAULT_PAGE"];
            $page = "home";
        }
        return $page;
    }

    public function getLoginController() {
        return new LoginController();
    }

    // Decide wich page to show

    public function getController() {
        $page = $this->getPage();

        if ((isset($_SESSION["AreLoggedIn"])) && ($_SESSION["AreLoggedIn"] == "true")) {


            switch ($page) {
                case "home":
                    return new HomeController();
                    
                case "loginEngine":
                    return new LoginController();
                    
                case "userAdm"    :
                case "addUserEngine" :
                case "editUserEngine":    
                case "deleteUserEngine":    
                    return new UserController();
                
                case "dummy" :
                    return new OverviewController();
                    
                case "storageAdm":
                case "addStorageEngine":
                    return new StorageController();
                    
                
                    
                    
                    
                    
                    
                    
                    
            }
            
            
        } else {
            return new LoginController();
        }
    }

}
