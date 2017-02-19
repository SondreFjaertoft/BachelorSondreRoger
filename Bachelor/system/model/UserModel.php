<?php

class UserModel {
    
    private $dbConn;
   

    const TABLE = "users";
    const UPDATE_QUERY = "UPDATE " . UserModel::TABLE . " SET name = :editName, username = :editUsername, password = :editPassword, userLevel = :editUserLevel, email = :editEmail WHERE userID = :editUserID" ;

   
    const SELECT_QUERY = "SELECT * FROM " . UserModel::TABLE;
    const INSERT_QUERY = "INSERT INTO " . UserModel::TABLE . " (name, username, password, userLevel, email) VALUES (:givenName, :givenUsername, :givenPassword, :givenUserLevel, :givenEmail)";
    const DELETE_QUERY = "DELETE FROM " . UserModel::TABLE . " WHERE userID = :removeUserID";

    private $selStmt;
    private $addStmt;
    private $delStmt;
    private $editStmt;

    public function __construct(PDO $dbConn) {
        $this->dbConn = $dbConn;
        $this->addStmt = $this->dbConn->prepare(UserModel::INSERT_QUERY);
        $this->selStmt = $this->dbConn->prepare(UserModel::SELECT_QUERY);
        $this->delStmt = $this->dbConn->prepare(UserModel::DELETE_QUERY);
        $this->editStmt = $this->dbConn->prepare(UserModel::UPDATE_QUERY);
    }


    public function getAllUserInfo() {
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editUser($editName, $editUsername, $editPassword, $editUserLevel, $editEmail, $editUserID) {
       return $this->editStmt->execute(array("editName" =>  $editName, "editUsername" => $editUsername, "editPassword" => $editPassword, "editUserLevel" => $editUserLevel, "editEmail" => $editEmail, "editUserID" => $editUserID)); 
    }
    
    // kommer tilbake til, ved oppretting av bruker
    public function addUser($givenName, $givenUsername,$givenPassword, $givenUserLevel, $givenEmail) {
        return $this->addStmt->execute(array("givenName" =>  $givenName, "givenUsername" => $givenUsername, "givenPassword" => $givenPassword, "givenUserLevel" => $givenUserLevel, "givenEmail" => $givenEmail));
    }
    
    
    // kommer tilbake til, ved sletting av bruker
    public function removeUser($removeUserID)
    {
       return $this->delStmt->execute(array("removeUserID" => $removeUserID));

    }

}
