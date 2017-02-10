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
        $inventoryMac = $inventoryInfo->getAllInventoryMac();
        $inventory = $inventoryInfo->getAllInventory();
  
        $data = array("inventoryMacInfo" => $inventoryMac, "inventoryInfo" => $inventory);
        
        return $this->render("home", $data);
        
        
    }
    

}    
    


