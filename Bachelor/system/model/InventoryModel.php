<?php

class InventoryModel {
    
    private $dbConn;


    
    const TABLE = "inventory";
    
    const SELECT_QUERY = "SELECT storageID, products.productName, products.productID, quantity FROM " . InventoryModel::TABLE . " INNER JOIN products ON products.productID = inventory.productID";
    const SELECT_QUERY_STORAGEID = "SELECT storageID, products.productName, products.productID, quantity FROM " . InventoryModel::TABLE . " INNER JOIN products ON products.productID = inventory.productID WHERE storageID = :givenStorageID";
    
    private $selStmt;

    public function __construct(PDO $dbConn) {
        $this->dbConn = $dbConn;
        $this->selStmt = $this->dbConn->prepare(InventoryModel::SELECT_QUERY);
        $this->selStorageID = $this->dbConn->prepare(InventoryModel::SELECT_QUERY_STORAGEID);
    }


    public function getAllStorageInventory() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllStorageInventoryByStorageID($givenStorageID){
        $this->selStorageID->execute(array("givenStorageID" => $givenStorageID));
        return $this->selStorageID->fetchAll(PDO::FETCH_ASSOC);
    }


        
    }   
    

    
