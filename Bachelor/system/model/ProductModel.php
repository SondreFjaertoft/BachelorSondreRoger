<?php

class ProductModel {
    
    private $dbConn;
    
    const TABLE = "products";
    
    const SELECT_QUERY = "SELECT * FROM " . ProductModel::TABLE;
    const UPDATE_QUERY = "UPDATE " . ProductModel::TABLE . " SET productName = :editProductName, buyPrice = :editBuyPrice, salePrice = :editSalePrice, categoryID = :editCategoryID, mediaID = :editMediaID, productNumber = :editProductNumber WHERE productID = :editProductID" ;
    const SEARCH_QUERY = "SELECT * FROM " . ProductModel::TABLE . " WHERE productName LIKE :givenSearchWord";
    const INSERT_QUERY = "INSERT INTO " . ProductModel::TABLE . " (productName, BuyPrice, SalePrice, CategoryID, MediaID, ProductNumber, date, macAdresse) VALUES (:givenProductName, :givenBuyPrice, :givenSalePrice, :givenCategoryID, :givenMediaID, :givenProductNumber, :givenProductDate, :givenMacAdresse)";
    const DELETE_QUERY = "DELETE FROM " . ProductModel::TABLE . " WHERE productID = :removeProductID";
    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->editStmt = $this->dbConn->prepare(ProductModel::UPDATE_QUERY);  
      $this->searchStmt = $this->dbConn->prepare(ProductModel::SEARCH_QUERY);
      $this->addStmt = $this->dbConn->prepare(ProductModel::INSERT_QUERY);
      $this->selStmt = $this->dbConn->prepare(ProductModel::SELECT_QUERY);
      $this->delStmt = $this->dbConn->prepare(ProductModel::DELETE_QUERY);
      
    }
    
    public function getSearchResult($givenSearchWord) {
        $this->searchStmt->execute(array("givenSearchWord" => $givenSearchWord));
        return $this->searchStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllProductInfo() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function editProduct($editProductName, $editBuyPrice, $editSalePrice, $editCategoryID, $editMediaID, $editProductNumber, $editProductID) {
       return $this->editStmt->execute(array("editProductName" =>  $editProductName, "editBuyPrice" => $editBuyPrice, "editSalePrice" => $editSalePrice, "editCategoryID" => $editCategoryID, "editMediaID" => $editMediaID, "editProductNumber" => $editProductNumber, "editProductID" => $editProductID)); 
    }
    
    public function addProduct($givenProductName, $givenBuyPrice, $givenSalePrice, $givenCategoryID, $givenMediaID, $givenProductNumber, $givenProductDate, $givenMacAdresse) {
        return $this->addStmt->execute(array("givenProductName" =>  $givenProductName, "givenBuyPrice" => $givenBuyPrice, "givenSalePrice" => $givenSalePrice, "givenCategoryID" => $givenCategoryID, "givenMediaID" => $givenMediaID, "givenProductNumber" => $givenProductNumber, "givenProductDate" => $givenProductDate, "givenMacAdresse" => $givenMacAdresse));
    }
    
    public function removeProduct($removeProductID)
    {
       return $this->delStmt->execute(array("removeProductID" => $removeProductID));

    }
    
}