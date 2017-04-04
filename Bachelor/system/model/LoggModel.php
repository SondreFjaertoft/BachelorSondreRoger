<?php

class LoggModel {
    
    private $dbConn;
    
    const TABLE = "logg";
    const SELECT_QUERY = 
         "SELECT l.type, l.desc, s1.storageName, s2.storageName AS fromStorage, s3.storageName AS toStorage, l.quantity, l.oldQuantity, l.newQuantity, l.differential, u1.username, u2.username AS onUsername, p.productName, l.customerNr, l.date FROM " . LoggModel::TABLE . " AS l "
        ."LEFT JOIN storage as s1 ON l.storageID = s1.storageID "
        ."LEFT JOIN storage as s2 ON l.fromStorageID = s2.storageID "
        ."LEFT JOIN storage as s3 ON l.toStorageID = s3.storageID "
        ."LEFT JOIN users as u1 ON l.userID = u1.userID "
        ."LEFT JOIN users as u2 ON l.onUserID = u2.userID "
        ."LEFT JOIN products as p ON l.productID = p.productID";
    
    const INSERT_QUERY = "INSERT INTO " . LoggModel::TABLE . " (type, desc, storageID, fromStorageID, toStorageID, quantity, oldQuantity, newQuantity, differential, userID, onUserID, productID, date, customerNr) "
            . "VALUES (:type, :desc, :storageID, :fromStorageID, :toStorageID, :quantity, :oldQuantity, :newQuantity, :differential, :userID, :onUserID, :productID, :date, :customerNr)";

    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->selStmt = $this->dbConn->prepare(LoggModel::SELECT_QUERY);
      $this->addStmt = $this->dbConn->prepare(LoggModel::INSERT_QUERY);
    }   
    
    public function getAllLoggInfo(){
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addLogg($arguments) {
        return $this->addStmt->execute(array($arguments));
    }
    

    
}