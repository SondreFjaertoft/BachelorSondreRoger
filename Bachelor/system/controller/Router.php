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
                    
                
                case "dummy" :
                    return new OverviewController();
                    
                
                        
            }
            
            if ($_SESSION["userLevel"] == "Administrator") {   
                    switch ($page) {
                case "productAdm" :
                case "addProductEngine" :
                case "editProductEngine" :
                case "deleteProductEngine" :  
                case "getAllProductInfo" :
                case "getProductByID" :
                case "getProductLocation" :    
                    return new ProductController();
                    
                case "storageAdm":
                case "addStorageEngine":
                case "editStorageEngine" :
                case "deleteStorageEngine" :
                case "getAllStorageInfo" :  
                case "getStorageByID" :
                case "getStorageRestriction" :
                case "getStorageProduct" :    
                    return new StorageController();
                    
                case "userAdm"    :
                case "editUserEngine" :           
                case "addRestriction" :    
                case "getUserInfo" :
                case "addUserEngine" :   
                case "getUserByID" :
                case "deleteUserEngine" :    
                case "getUserRestriction" :   
                    return new UserController();    
                    
                case "transfer" :
                case "getTransferRestriction" :
                case "transferProduct" :    
                    return new transferController();
                    
                    
                    
                    }
                }
            
            
        } else {
            return new LoginController();
        }
    }

}
