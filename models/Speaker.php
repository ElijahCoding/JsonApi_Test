<?php

class Speaker
{
    private $conn;
    private $table = 'Speaker';

    public $ID;
    public $Name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM {$this->table}";

        $statement = $this->conn->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function read_single()
    {
        $query = "SELECT * FROM {$this->table} WHERE ID = ?";

        $statement = $this->conn->prepare($query);

        $statement->bindParam(1, $this->ID);

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->ID = $row['ID'];
        $this->Name = $row['Name'];
    }
}
