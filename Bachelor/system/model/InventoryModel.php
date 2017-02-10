<?php

class Inventory {
    
    private $dbConn;


            
    
    
    const TABLE = "inventory_quantity";
    
    const SELECT_MAC_QUERY = "SELECT products.productName, storage.storageName, inventory.macAdresse FROM products INNER JOIN inventory ON inventory.productID = products.productID INNER JOIN storage ON inventory.storageID = storage.storageID LIKE 1" ;
    const SELECT_QUERY = "SELECT products.productName, storage.storageName, inventory_quantity.quantity FROM products INNER JOIN inventory_quantity ON inventory_quantity.productID = products.productID INNER JOIN storage ON inventory_quantity.storageID = storage.storageID LIKE 1" ;
    const INSERT_QUERY = "INSERT INTO " . Inventory::TABLE . " (name, username, password, userLevel, email) VALUES (:givenName, :givenUsername, :givenPassword, :givenUserLevel, :givenEmail)";
    const DELETE_QUERY = "DELETE FROM " . Inventory::TABLE . " WHERE username= ?";

    private $selStmt;
    private $addStmt;
    private $selMacStmt;

    public function __construct(PDO $dbConn) {
        $this->dbConn = $dbConn;
        $this->addStmt = $this->dbConn->prepare(Inventory::INSERT_QUERY);
        $this->selMacStmt = $this->dbConn->prepare(Inventory::SELECT_MAC_QUERY);
        $this->selStmt = $this->dbConn->prepare(Inventory::SELECT_QUERY);
        $this->delStmt = $this->dbConn->prepare(Inventory::DELETE_QUERY);
    }


    public function getAllInventory() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllInventoryMac(){
             $this->selMacStmt->execute();

        return $this->selMacStmt->fetchAll(PDO::FETCH_ASSOC);

        
        
    }   
    

    
    // kommer tilbake til, ved oppretting av bruker
    //public function addUser($givenName, $givenUsername,$givenPassword, $givenUserLevel, $givenEmail) {
    //    return $this->addStmt->execute(array("givenName" =>  $givenName, "givenUsername" => $givenUsername,"givenPassword" => $givenPassword, "givenUserLevel" => $givenUserLevel, "givenEmail" => $givenEmail));
    //}
    
    
    // kommer tilbake til, ved sletting av bruker
    //public function remove($givenRemoveUser)
    //{
    //   return $this->delStmt->execute(array($givenRemoveUser));

    //}

}