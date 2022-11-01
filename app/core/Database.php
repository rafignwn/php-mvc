<?php
class Database
{
    private $DB_HOST = HOST;
    private $DB_NAME = DATABASE;
    private $DB_USER = USER;
    private $DB_PASS = PASSWORD;
    private $db_handler;
    private $statement;

    public function __construct()
    {
        // DATA SOURCE NAME
        $DSN = "mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME;

        // OPTIONS
        $OPTIONS = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // Connecting to Database
        try {
            $this->db_handler = new PDO($DSN, $this->DB_USER, $this->DB_PASS, $OPTIONS);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    // add query
    public function query(string $query)
    {
        $this->statement = $this->db_handler->prepare($query);
    }

    // binding value
    public function bind(string $param, $value, $type = null)
    {
        if (is_null($type)) {
            switch ($value) {
                case is_int($value): {
                        $type = PDO::PARAM_INT;
                        break;
                    }
                case is_string($value): {
                        $type = PDO::PARAM_STR;
                        break;
                    }
                case is_bool($value): {
                        $type = PDO::PARAM_BOOL;
                        break;
                    }
                default: {
                        $type = PDO::PARAM_NULL;
                    }
            }
        }
        $this->statement->bindValue($param, $value, $type);
    }

    // query execution
    public function execute()
    {
        return $this->statement->execute();
    }

    // get all data
    public function fetchAllResult()
    {
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // get single data 
    public function single()
    {
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    // get row count
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
