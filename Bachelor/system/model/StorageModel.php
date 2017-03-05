<?php

class StorageModel {
    
    private $dbConn;

    const TABLE = "storage";
    const SELECT_QUERY_STORAGEID = "SELECT * FROM " . StorageModel::TABLE . " WHERE storageID = :givenStorageID";
    const UPDATE_QUERY = "UPDATE " . StorageModel::TABLE . " SET storageName = :editStorageName WHERE storageID = :editStorageID"; 
    const SELECT_QUERY = "SELECT * FROM " . StorageModel::TABLE;
    const SEARCH_QUERY = "SELECT * FROM " . StorageModel::TABLE . " WHERE storageName LIKE :givenSearchWord ";
    const INSERT_QUERY = "INSERT INTO " . StorageModel::TABLE . " (storageName) VALUES (:givenStorageName)";
    const DELETE_QUERY = "DELETE FROM " . StorageModel::TABLE . " WHERE storageID = :removeStorageID";

    private $selStmt;
    private $addStmt;

    public function __construct(PDO $dbConn) {
        $this->dbConn = $dbConn;
        $this->addStmt = $this->dbConn->prepare(StorageModel::INSERT_QUERY);
        $this->selStmt = $this->dbConn->prepare(StorageModel::SELECT_QUERY);
        $this->delStmt = $this->dbConn->prepare(StorageModel::DELETE_QUERY);
        $this->searchStmt = $this->dbConn->prepare(StorageModel::SEARCH_QUERY);
        $this->editStmt = $this->dbConn->prepare(StorageModel::UPDATE_QUERY);
        $this->selStorageID = $this->dbConn->prepare(StorageModel::SELECT_QUERY_STORAGEID);
    }

    public function getSearchResult($givenSearchWord) {
        $this->searchStmt->execute(array("givenSearchWord" => $givenSearchWord));
        return $this->searchStmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function removeStorage($removeStorageID)
    {
       return $this->delStmt->execute(array("removeStorageID" => $removeStorageID));

    }
    
    public function editStorage($editStorageName, $editStorageID){
       return $this->editStmt->execute(array("editStorageName" => $editStorageName, "editStorageID" => $editStorageID)); 
    }
    
    public function getAllStorageInfoFromID($givenStorageID) {
        $this->selStorageID->execute(array("givenStorageID" => $givenStorageID));
        return $this->selStorageID->fetchAll(PDO::FETCH_ASSOC);
    }    

}