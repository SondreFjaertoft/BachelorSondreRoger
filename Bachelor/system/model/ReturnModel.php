<?php

class ReturnModel {
    
    private $dbConn;
    
    const TABLE = "returns";
    
    const SELECT_QUERY = "SELECT * FROM " . ReturnModel::TABLE . " WHERE userID = :givenUserID";
    const INSERT_QUERY = "INSERT INTO " . ReturnModel::TABLE . " (productID, date, customerNr, comment, userID, storageID, quantity) VALUES (:givenProductID, :givenDate, :givenCustomerNumber, :givenComment, :givenUserID, :givenStorageID, :givenQuantity)";
   
    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->selStmt = $this->dbConn->prepare(ReturnModel::SELECT_QUERY);
      $this->addStmt = $this->dbConn->prepare(ReturnModel::INSERT_QUERY);
    }
    
    public function getAllReturnInfo($givenUserID){
        $this->selStmt->execute(array("givenUserID" =>  $givenUserID));
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC); 

       
    }
    
    public function newReturn($givenStorageID, $givenCustomerNumber, $givenProductID, $givenQuantity, $givenUserID, $givenComment, $givenDate) {
    return $this->addStmt->execute(array("givenStorageID" =>  $givenStorageID, "givenCustomerNumber" => $givenCustomerNumber, "givenProductID" => $givenProductID, "givenQuantity" => $givenQuantity, "givenUserID" => $givenUserID, "givenComment" => $givenComment, "givenDate" => $givenDate));
    }
}

