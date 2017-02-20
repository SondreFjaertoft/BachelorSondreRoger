<?php

class InventoryModel {
    
    private $dbConn;


    
    const TABLE = "inventory";
    
    const SELECT_QUERY = "SELECT storageID, products.productName FROM " . InventoryModel::TABLE . " INNER JOIN products ON products.productID = inventory.productID";

    private $selStmt;
    private $addStmt;
    private $selKSStmt;

    public function __construct(PDO $dbConn) {
        $this->dbConn = $dbConn;
        $this->selStmt = $this->dbConn->prepare(InventoryModel::SELECT_QUERY);

    }


    public function getAllStorageInventory() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
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
    

    
