<?php



class RestritionModel{
    
    private $dbConn;
    
    
    const TABLE = "restrictions";
    const SELECT_FROM_USERID = "SELECT storage.storageName, restrictions.storageID, restrictions.userID FROM storage INNER JOIN " . RestritionModel::TABLE . " ON storage.storageID = restrictions.storageID WHERE userID = :givenUserID";

    const SELECT_STORAGE_QUERY = "SELECT storage.storageName, restrictions.storageID, restrictions.userID FROM storage INNER JOIN " . RestritionModel::TABLE . " ON storage.storageID = restrictions.storageID";
    const SELECT_USER_QUERY = "SELECT users.name, restrictions.storageID, restrictions.userID FROM users INNER JOIN " . RestritionModel::TABLE . " ON users.userID = restrictions.userID";
    const INSERT_QUERY = "INSERT INTO " . RestritionModel::TABLE . " (userID, storageID) VALUES (:givenUserID, :givenStorageID)";
    
    /** @var PDOStatement Statement for selecting all entries */

    /** @var PDOStatement Statement for adding new entries */
    private $addStmt;
    
    public function __construct(PDO $dbConn) {
    $this->dbConn = $dbConn;
    $this->addStmt = $this->dbConn->prepare(RestritionModel::INSERT_QUERY);
    $this->selStoStmt = $this->dbConn->prepare(RestritionModel::SELECT_STORAGE_QUERY);
    $this->selUserStmt = $this->dbConn->prepare(RestritionModel::SELECT_USER_QUERY);
    $this->SelFromUserID = $this->dbConn->prepare(RestritionModel::SELECT_FROM_USERID);
    }
    
    /**
     * Get all info stored in the DB
     * @return array in associative form
     */
    public function getAllStorageRestrictionInfo() {
        // Fetch all customers as associative arrays
        $this->selStoStmt->execute();
        return $this->selStoStmt->fetchAll(PDO::FETCH_ASSOC);
    }   
    
        public function getAllUserRestrictionInfo() {
        // Fetch all customers as associative arrays
        $this->selUserStmt->execute();
        return $this->selUserStmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    
    public function getAllRestrictionInfoFromUserID($givenUserID) {
        $this->SelFromUserID->execute(array("givenUserID" => $givenUserID));
        return $this->SelFromUserID->fetchAll(PDO::FETCH_ASSOC);
    }   
    
    
    
    
   // Er ikke i bruk for øyeblikket:
    
    public function addRestriction($givenUserID, $givenStorageID){
        return $this->addStmt->execute(array("givenUserID" => $givenUserID, "givenStorageID" => $givenStorageID));
    }
    
    
}
