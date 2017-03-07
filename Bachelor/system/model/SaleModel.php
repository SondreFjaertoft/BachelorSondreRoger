<?php

class SaleModel {
    
    private $dbConn;
    
    const TABLE = "sales";
    
    const SELECT_QUERY = "SELECT * FROM " . SaleModel::TABLE;
    const UPDATE_QUERY = "UPDATE " . SaleModel::TABLE . " SET productName = :editProductName, buyPrice = :editBuyPrice, salePrice = :editSalePrice, categoryID = :editCategoryID, mediaID = :editMediaID, productNumber = :editProductNumber WHERE productID = :editProductID" ;
    const INSERT_QUERY = "INSERT INTO " . SaleModel::TABLE . " (productID, date, customerNr, comment, userID, storageID, quantity) VALUES (:givenProductID, :givenDate, :givenCustomerNumber, :givenComment, :givenUserID, :givenStorageID, :givenQuantity)";
    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->editStmt = $this->dbConn->prepare(SaleModel::UPDATE_QUERY);  
      $this->addStmt = $this->dbConn->prepare(SaleModel::INSERT_QUERY);
      $this->selStmt = $this->dbConn->prepare(SaleModel::SELECT_QUERY);
    }
    

    public function getAllSaleInfo() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function editSale($editProductName, $editBuyPrice, $editSalePrice, $editCategoryID, $editMediaID, $editProductNumber, $editProductID) {
       return $this->editStmt->execute(array("editProductName" =>  $editProductName, "editBuyPrice" => $editBuyPrice, "editSalePrice" => $editSalePrice, "editCategoryID" => $editCategoryID, "editMediaID" => $editMediaID, "editProductNumber" => $editProductNumber, "editProductID" => $editProductID)); 
    }
    
    public function newSale($givenStorageID, $givenCustomerNumber, $givenProductID, $givenQuantity, $givenUserID, $givenComment, $givenDate) {
        return $this->addStmt->execute(array("givenStorageID" =>  $givenStorageID, "givenCustomerNumber" => $givenCustomerNumber, "givenProductID" => $givenProductID, "givenQuantity" => $givenQuantity, "givenUserID" => $givenUserID, "givenComment" => $givenComment, "givenDate" => $givenDate));
    }
}