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
                    
                case "transfer" :
                case "getTransferRestriction" :
                case "transferProduct" :    
                    return new TransferController();
                    
                case "sale" :
                case "withdrawProduct" :  
                case "getProdQuantity" :   
                case "mySales" :   
                case "getMySales"   : 
                    return new SaleController();
                    
                case "return" :
                case "myReturns" :
                case "getMyReturns" :
                case "returnProduct" :    
                    return new ReturnController();
                    
                case "getAllProductInfo" :
                case "getProductByID" :
                case "getProductLocation" :    
                    return new ProductController();    
                    
                case "getAllStorageInfo" :  
                case "getStorageByID" :
                case "getStorageRestriction" :
                case "getStorageProduct" :  
                case "chartProduct" :    
                    return new StorageController(); 
                  
                case "getUserInfo" :    
                case "getUserByID" :   
                case "getUserRestriction" :   
                    return new UserController();     
                        
            }
            
            if ($_SESSION["userLevel"] == "Administrator") {   
                    switch ($page) {
                case "productAdm" :
                case "addProductEngine" :
                case "editProductEngine" :
                case "deleteProductEngine" :  
                    return new ProductController();
                    
                case "storageAdm":
                case "addStorageEngine":
                case "editStorageEngine" :
                case "deleteStorageEngine" :
                    return new StorageController();
                    
                case "userAdm"    :
                case "editUserEngine" :           
                case "addRestriction" :    
                case "addUserEngine" : 
                case "deleteUserEngine" : 
                case "deleteSingleRes" :
                    return new UserController();    
                    
                case "mediaAdm" :
                case "uploadImage" :  
                case "getAllMediaInfo" :
                case "uploadImageShortcut" :   
                    return new mediaController();
                    }
                }
            
            
        } else {
            return new LoginController();
        }
    }

}
