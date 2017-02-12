<?php

require_once("Controller.php");

// Represents home page
class HomeController extends Controller {

    // Render "Overview" view

    public function show($page) {
        if ($page == "home"){
            $this->showInventory();
        }
         
    }
    
    private function showInventory(){
        $inventoryInfo = $GLOBALS["inventory"];
        $inventoryKS = $inventoryInfo->getAllInventoryKS();
        $inventory = $inventoryInfo->getAllInventory();
  
        $data = array("inventoryKSInfo" => $inventoryKS, "inventoryInfo" => $inventory);
        
        return $this->render("home", $data);
        
        
    }
    

}    
    


