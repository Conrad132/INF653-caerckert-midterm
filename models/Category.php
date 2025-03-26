<?php
class Category {
    // DB stuff
    private $conn;
    private $table = 'categories'; 

    // Properties
    public $id;
    public $category;

    // Constructor with DB 
	public function __construct($db) {
		$this->conn = $db;
	}

    // Get categories
    public function read(){
        // Create query
        $query = 'SELECT
            id, 
            category
        FROM
        ' . $this->table . '
        ORDER BY
            id ASC ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single category by ID
    public function read_single() {
        $query = 'SELECT id, category FROM ' . $this->table . ' WHERE id = :id LIMIT 1';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->category = $row['category'];
            return true;
        }
        return false;
    }
}
?>
