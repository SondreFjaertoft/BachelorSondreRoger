<?php

class SaleModel {
    
    private $dbConn;
    
    const TABLE = "sales";
    
    const SELECT_QUERY = "SELECT * FROM " . SaleModel::TABLE;
    const SELECT_MY_SALES = "SELECT salesID, customerNr, products.productName, sales.date, comment, storage.storageName, quantity FROM " . SaleModel::TABLE . 
            " INNER JOIN products ON sales.productID = products.productID INNER JOIN storage ON sales.storageID = storage.storageID WHERE customerNr LIKE :givenProductSearchWord OR comment LIKE "
            . ":givenProductSearchWord OR productName LIKE :givenProductSearchWord OR storageName LIKE :givenProductSearchWord AND userID = :givenUserID ORDER BY date DESC";
    const SELECT_STORAGE = "SELECT * FROM " . SaleModel::TABLE . " WHERE storageID = :givenStorageID";
    const UPDATE_QUERY = "UPDATE " . SaleModel::TABLE . " SET customerNr = :editCustomerNr, comment = :editComment  WHERE salesID = :editSaleID" ;
    const INSERT_QUERY = "INSERT INTO " . SaleModel::TABLE . " (productID, date, customerNr, comment, userID, storageID, quantity) VALUES (:givenProductID, :givenDate, :givenCustomerNumber, :givenComment, :givenUserID, :givenStorageID, :givenQuantity)";
    const SELECT_FROM_ID = "SELECT * FROM " . SaleModel::TABLE . " WHERE salesID = :givenSalesID";
    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->editStmt = $this->dbConn->prepare(SaleModel::UPDATE_QUERY);  
      $this->addStmt = $this->dbConn->prepare(SaleModel::INSERT_QUERY);
      $this->selStmt = $this->dbConn->prepare(SaleModel::SELECT_QUERY);
      $this->selStorage = $this->dbConn->prepare(SaleModel::SELECT_STORAGE);
      $this->mySales = $this->dbConn->prepare(SaleModel::SELECT_MY_SALES);
      $this->selFromID = $this->dbConn->prepare(SaleModel::SELECT_FROM_ID);
    }
    

    public function getAllSaleInfo() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getSaleFromStorageID($givenStorageID){
        return $this->selStorage->execute(array("givenStorageID" =>  $givenStorageID)); 
    }
    
    public function editMySale($editSaleID, $editCustomerNr, $editComment) {
       return $this->editStmt->execute(array("editSaleID" =>  $editSaleID, "editCustomerNr" => $editCustomerNr, "editComment" => $editComment)); 
    }
    
    public function newSale($givenStorageID, $givenCustomerNumber, $givenProductID, $givenQuantity, $givenUserID, $givenComment, $givenDate) {
        return $this->addStmt->execute(array("givenStorageID" =>  $givenStorageID, "givenCustomerNumber" => $givenCustomerNumber, "givenProductID" => $givenProductID, "givenQuantity" => $givenQuantity, "givenUserID" => $givenUserID, "givenComment" => $givenComment, "givenDate" => $givenDate));
    }
    
    public function getMySales($givenUserID, $givenProductSearchWord){
        $this->mySales->execute(array("givenUserID" =>  $givenUserID, "givenProductSearchWord" => $givenProductSearchWord));
        return $this->mySales->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getSaleFromID($givenSalesID){
        $this->selFromID->execute(array("givenSalesID" =>  $givenSalesID)); 
        return $this->selFromID->fetchAll(PDO::FETCH_ASSOC);  
    }
    
}