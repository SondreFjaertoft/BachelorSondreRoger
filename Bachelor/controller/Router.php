<?php

// Controller layer - the router selects controller to use depending on URL and request parameters

class Router {
    
    // Returns the requested page name
    
    public function getPage() {
        // Get page from request, or use default
        if (isset($_REQUEST["page"])){
            $page = $_REQUEST["page"];
        } else{
            // $page = GLOBALS["DEFAULT_PAGE"];
                $page = "overview";   
        }
        return $page;
    }  
    
    
    // Decide wich page to show
    
    public function getController() {
        $page = $this->getPage();
        switch ($page) {
            case "overview":
                return new OverviewController();
            
            case "addDummy":
            default:
                return new OverviewController();
            
        }
        
        
    }
    
    
    
}