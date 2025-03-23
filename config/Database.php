<?php
class Database {    private $conn;

    public function connect() {
        $host = getenv('HOST');
        $port = getenv('PORT');
        $db_name = getenv('DBNAME');
        $username = getenv('USERNAME');
        $password = getenv('PASSWORD');

		if (!$host || !$port || !$db_name || !$username || !$password) {
            die(json_encode(['message' => 'Missing database environment variables']));
        }
        $dsn = "pgsql:host={$host};port={$port};dbname={$db_name}";

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die(json_encode(['message' => 'Connection Error: ' . $e->getMessage()]));
        }
        return $this->conn;
    }
}
?>