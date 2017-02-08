<?php

class UserModel {
    
    private $dbConn;

    const TABLE = "users";
    const SELECT_QUERY = "SELECT * FROM " . UserModel::TABLE;
    const INSERT_QUERY = "INSERT INTO " . UserModel::TABLE . " (username, password) VALUES (:givenAdminUsername, :givenAdminPassword)";
    const DELETE_QUERY = "DELETE FROM " . UserModel::TABLE . " WHERE username= ?";

    private $selStmt;
    private $addStmt;

    public function __construct(PDO $dbConn) {
        $this->dbConn = $dbConn;
        $this->addStmt = $this->dbConn->prepare(UserModel::INSERT_QUERY);
        $this->selStmt = $this->dbConn->prepare(UserModel::SELECT_QUERY);
        $this->delStmt = $this->dbConn->prepare(UserModel::DELETE_QUERY);
    }


    public function getAll() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    // kommer tilbake til, ved oppretting av bruker
    public function add($givenUsername,$givenPassword) {
        return $this->addStmt->execute(array("givenUsername" => $givenUsername,"givenPassword" => sha1($givenPassword)));
    }
    
    
    // kommer tilbake til, ved sletting av bruker
    public function remove($givenRemoveUser)
    {
       return $this->delStmt->execute(array($givenRemoveUser));

    }

}
