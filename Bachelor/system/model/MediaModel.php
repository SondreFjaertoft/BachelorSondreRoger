<?php

class MediaModel {
    
    private $dbConn;
    
    const TABLE = "media";
    
    const SELECT_QUERY = "SELECT * FROM " . MediaModel::TABLE;
    const INSERT_QUERY = "INSERT INTO " . MediaModel::TABLE . " (mediaName, category) VALUES (:givenFileName, :givenCaterogy)";
   
    
    public function __construct(PDO $dbConn) { 
      $this->dbConn = $dbConn;
      $this->selStmt = $this->dbConn->prepare(MediaModel::SELECT_QUERY);
      $this->addStmt = $this->dbConn->prepare(MediaModel::INSERT_QUERY);
    }
    
    public function getAllMediaInfo(){
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);

       
    }
    
    public function addMedia($fileName, $givenCaterogy) {
    return $this->addStmt->execute(array("givenFileName" => $fileName, "givenCaterogy" => $givenCaterogy));
    }
}

