<?php

class StorageModel {
    
    private $dbConn;

    const TABLE = "storage";
    const SELECT_QUERY = "SELECT * FROM " . StorageModel::TABLE;
    const INSERT_QUERY = "INSERT INTO " . StorageModel::TABLE . " (storageName) VALUES (:givenStorageName)";
    const DELETE_QUERY = "DELETE FROM " . StorageModel::TABLE . " WHERE username= ?";

    private $selStmt;
    private $addStmt;

    public function __construct(PDO $dbConn) {
        $this->dbConn = $dbConn;
        $this->addStmt = $this->dbConn->prepare(StorageModel::INSERT_QUERY);
        $this->selStmt = $this->dbConn->prepare(StorageModel::SELECT_QUERY);
        $this->delStmt = $this->dbConn->prepare(StorageModel::DELETE_QUERY);
    }


    public function getAll() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    // kommer tilbake til, ved oppretting av bruker
    public function addStorage($givenStorageName) {
        return $this->addStmt->execute(array("givenStorageName" =>  $givenStorageName));
    }
    
    
    // kommer tilbake til, ved sletting av bruker
    public function remove($givenRemoveUser)
    {
       return $this->delStmt->execute(array($givenRemoveUser));

    }

}