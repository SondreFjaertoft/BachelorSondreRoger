<?php



class RestritionModel{
    
    private $dbConn;
    
    
    const TABLE = "restrictions";
    const SELECT_QUERY = "SELECT * FROM " . RestritionModel::TABLE;
    const INSERT_QUERY = "INSERT INTO " . RestritionModel::TABLE . " (ID, brukernavn, tekst) VALUES (:ID, :Brukernavn, :tekst)";
    
    /** @var PDOStatement Statement for selecting all entries */
    private $selStmt;
    /** @var PDOStatement Statement for adding new entries */
    private $addStmt;
    
    public function __construct(PDO $dbConn) {
    $this->dbConn = $dbConn;
    $this->addStmt = $this->dbConn->prepare(RestritionModel::INSERT_QUERY);
    $this->selStmt = $this->dbConn->prepare(RestritionModel::SELECT_QUERY);
    }
    
    /**
     * Get all info stored in the DB
     * @return array in associative form
     */
    public function getAllRestrictionInfo() {
        // Fetch all customers as associative arrays
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }   
    
    
    
   // Er ikke i bruk for øyeblikket:
    
    public function addRestriction($givenID, $givenUser, $givenTekst){
        return $this->addStmt->execute(array("ID" => $givenID, "Brukernavn" => $givenUser, "tekst" => $givenTekst));
    }
    
    
}
