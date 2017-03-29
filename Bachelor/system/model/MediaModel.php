<?php

class MediaModel {
    
    private $dbConn;
    
    const TABLE = "media";
    
    const SEARCH_QUERY = "SELECT * FROM " . MediaModel::TABLE . " WHERE mediaName LIKE :givenSearchWord";
    const INSERT_QUERY = "INSERT INTO " . MediaModel::TABLE . " (mediaName, category) VALUES (:givenFileName, :givenCaterogy)";
    const ID_QUERY = "SELECT * FROM " . MediaModel::TABLE . " WHERE mediaID LIKE :givenMediaID";

    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->searchStmt = $this->dbConn->prepare(MediaModel::SEARCH_QUERY);
      $this->addStmt = $this->dbConn->prepare(MediaModel::INSERT_QUERY);
      $this->byIdStmt = $this->dbConn->prepare(MediaModel::ID_QUERY);
    }
    
    public function getAllMediaInfo($givenSearchWord){
        $this->searchStmt->execute(array("givenSearchWord" => $givenSearchWord));
        return $this->searchStmt->fetchAll(PDO::FETCH_ASSOC);

       
    }
    
    public function addMedia($fileName, $givenCaterogy) {
    return $this->addStmt->execute(array("givenFileName" => $fileName, "givenCaterogy" => $givenCaterogy));
    }
    
    public function getMediaByID($givenMediaID){
        $this->byIdStmt->execute(array("givenMediaID" => $givenMediaID));
        return $this->byIdStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

