<?php

class News
{
    private $conn;
    private $table = 'News';

    public $ID;
    public $ParticipantId;
    public $NewsTitle;
    public $NewsMessage;
    public $LikesCounter;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT n.ID, n.NewsTitle, n.NewsMessage, n.LikesCounter, p.ID, p.Email, p.Name
                  FROM {$this->table} n
                  LEFT JOIN Participant p
                  ON n.ParticipantId = p.ID";

        $statement = $this->conn->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function read_single()
    {

    }
}
