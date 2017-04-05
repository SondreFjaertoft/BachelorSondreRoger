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

    const INSERT_TRANS_LOGG = "INSERT INTO " . LoggModel::TABLE . " (logg.type, logg.desc, logg.fromStorageID, logg.toStorageID, logg.quantity, logg.userID, logg.productID, logg.date) VALUES "
            . "(:givenType, :givenDesc, :givenFromStorageID, :givenToStorageID, :givenQuantity, :givenSessionID, :givenProductID, NOW())";
    
    const INSERT_DELIV_LOGG = "INSERT INTO " . LoggModel::TABLE . " (logg.type, logg.desc, logg.toStorageID, logg.quantity, logg.userID, logg.productID, logg.date) VALUES "
            . "(:givenType, :givenDesc, :givenToStorageID, :givenQuantity, :givenSessionID, :givenProductID, NOW())";
    
    const INSERT_StOCKTAKE_LOGG = "INSERT INTO " . LoggModel::TABLE . " (logg.type, logg.desc, logg.storageID, logg.newQuantity, logg.oldQuantity, logg.differential, logg.productID, logg.userID,logg.date) VALUES "
            . "(:givenType, :givenDesc, :givenStorageID, :givenQuantity, :givenOldQuantity, :givenDifferanse, :givenProductID, :givenSessionID, NOW())";
    
    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->selStmt = $this->dbConn->prepare(LoggModel::SELECT_QUERY);
      $this->addStmt = $this->dbConn->prepare(LoggModel::INSERT_QUERY);
      $this->addTransLogg = $this->dbConn->prepare(LoggModel::INSERT_TRANS_LOGG);
      $this->addDeliveryLogg = $this->dbConn->prepare(LoggModel::INSERT_DELIV_LOGG);
      $this->stocktakeLogg = $this->dbConn->prepare(LoggModel::INSERT_StOCKTAKE_LOGG);
    }   
    
    public function getAllLoggInfo(){
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function transferLogg($type, $descript, $sessionID, $fromStorageID, $toStorageID, $transferProductID, $transferQuantity) {
        return $this->addTransLogg->execute(array("givenType" => $type, "givenDesc" => $descript, "givenSessionID" => $sessionID, "givenFromStorageID" => $fromStorageID, "givenToStorageID" => $toStorageID, "givenProductID" => $transferProductID, "givenQuantity" => $transferQuantity));
    }
    
    public function stockdelivery($type, $descript, $sessionID, $toStorageID, $transferProductID, $transferQuantity) {
        return $this->addDeliveryLogg->execute(array("givenType" => $type, "givenDesc" => $descript, "givenSessionID" => $sessionID, "givenToStorageID" => $toStorageID, "givenProductID" => $transferProductID, "givenQuantity" => $transferQuantity));
    }
    
    public function stocktaking($type, $descript, $sessionID, $givenStorageID, $givenProductID, $givenQuantity, $oldQuantity, $differance){
        return $this->stocktakeLogg->execute(array("givenType" => $type, "givenDesc" => $descript, "givenSessionID" => $sessionID, "givenStorageID" => $givenStorageID, "givenProductID" => $givenProductID, "givenQuantity" => $givenQuantity, "givenOldQuantity" => $oldQuantity, "givenDifferanse" => $differance));

    }
    

    
}