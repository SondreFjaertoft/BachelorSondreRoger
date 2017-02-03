<?php



class Dummy{
    
    private $dbConn;
    
    
    const TABLE = "dummy";
    const SELECT_QUERY = "SELECT * FROM " . Dummy::TABLE;
    const INSERT_QUERY = "INSERT INTO " . Dummy::TABLE . " (ID, brukernavn, tekst) VALUES (:ID, :Brukernavn, :tekst)";
    
    /** @var PDOStatement Statement for selecting all entries */
    private $selStmt;
    /** @var PDOStatement Statement for adding new entries */
    private $addStmt;
    
    public function __construct(PDO $dbConn) {
    $this->dbConn = $dbConn;
    $this->addStmt = $this->dbConn->prepare(Dummy::INSERT_QUERY);
    $this->selStmt = $this->dbConn->prepare(Dummy::SELECT_QUERY);
    }
    
    /**
     * Get all info stored in the DB
     * @return array in associative form
     */
    public function getAll() {
        // Fetch all customers as associative arrays
        $this->selStmt->execute();
        return $this->selStmt->fetchAll(PDO::FETCH_ASSOC);
    }   
    
    public function addDummy($ID, $brukernavn, $tekst){
        return $this->addStmt->execute(array("ID" =>$ID, "brukernavn" => $brukernavn, "tekst" => $tekst));
    }
    
    
}


