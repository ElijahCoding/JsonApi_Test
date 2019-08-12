<?php

class Session
{
    private $conn;
    private $table = 'Session';

    public $ID;
    public $Name;
    public $TimeOfEvent;
    public $Description;

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
        $query = "SELECT * FROM {$this->table} WHERE ID = ? LIMIT 0,1";

        $statement = $this->conn->prepare($query);

        $statement->bindParam(1, $this->ID);

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->ID = $row['ID'];
        $this->Name = $row['Name'];
        $this->TimeOfEvent = $row['TimeOfEvent'];
        $this->Description = $row['Description'];
    }

    public function create()
    {
        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->TimeOfEvent = htmlspecialchars(strip_tags($this->TimeOfEvent));
        $this->Description = htmlspecialchars(strip_tags($this->Description));

        if ($this->checkUserEmail($this->Name)) {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    Name = :Name,
                    TimeOfEvent = :TimeOfEvent,
                    Description = :Description
            ';

            $statement = $this->conn->prepare($query);

            // Bind data
            $statement->bindParam(':Name', $this->Name);
            $statement->bindParam(':TimeOfEvent', $this->TimeOfEvent);
            $statement->bindParam(':Description', $this->Description);

            // Execute query
            if($statement->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $statement->error);

            return false;
        }
    }

    protected function checkUserEmail($email)
    {
        $query = "SELECT * FROM Participant WHERE Name = ?";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $email);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row ? true : false;

    }
}
