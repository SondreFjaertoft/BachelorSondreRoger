<?php

class ReturnModel {
    
    private $dbConn;
    
    const TABLE = "returns";
    
    const SELECT_QUERY = "SELECT * FROM " . ReturnModel::TABLE;
   
    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->selStmt = $this->dbConn->prepare(ReturnModel::SELECT_QUERY);
      
    }
    
    public function getAllReturnInfo(){
       $this->selStmt->execute();
       return $this->selStmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

