<?php

class UserModel {
    
    private $dbConn;

    const TABLE = "users";
    const UPDATE_QUERY = "UPDATE" . UserModel::TABLE . " SET `name` = :editName, `username` = :editUsername, `password` = :editPassword, `userLevel` = :editUserLevel, `email` = :editEmail WHERE `userID` = :editUserID";

   
    const SELECT_QUERY = "SELECT * FROM " . UserModel::TABLE;
    const INSERT_QUERY = "INSERT INTO " . UserModel::TABLE . " (name, username, password, userLevel, email) VALUES (:givenName, :givenUsername, :givenPassword, :givenUserLevel, :givenEmail)";
    const DELETE_QUERY = "DELETE FROM " . UserModel::TABLE . " WHERE username= ?";

    private $selStmt;
    private $addStmt;
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

    public function editUser($editUserID, $editName, $editUsername, $editPassword, $editUserLevel, $editEmail) {
       return $this->editStmt->execute(array("editUserID" => $editUserID, "editName" =>  $editName, "editUsername" => $editUsername, "editPassword" => $editPassword, "editUserLevel" => $editUserLevel, "editEmail" => $editEmail)); 
    }
    
    // kommer tilbake til, ved oppretting av bruker
    public function addUser($givenName, $givenUsername,$givenPassword, $givenUserLevel, $givenEmail) {
        return $this->addStmt->execute(array("givenName" =>  $givenName, "givenUsername" => $givenUsername, "givenPassword" => $givenPassword, "givenUserLevel" => $givenUserLevel, "givenEmail" => $givenEmail));
    }
    
    
    // kommer tilbake til, ved sletting av bruker
    public function remove($givenRemoveUser)
    {
       return $this->delStmt->execute(array($givenRemoveUser));

    }

}
