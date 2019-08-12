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
    public $Participant_Email;
    public $Participant_Name;

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
        $query = "SELECT n.ID, n.NewsTitle, n.NewsMessage, n.LikesCounter, p.ID, p.Email, p.Name
                  FROM {$this->table} n
                  LEFT JOIN Participant p
                  ON n.ParticipantId = p.ID
                  WHERE n.ID = ?
                  LIMIT 0,1";

        $statement = $this->conn->prepare($query);

        $statement->bindParam(1, $this->ID);

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->ID = $row['ID'];
        $this->NewsTitle = $row['NewsTitle'];
        $this->NewsMessage = $row['NewsMessage'];
        $this->LikesCounter = $row['LikesCounter'];
        $this->Participant_Email = $row['Email'];
        $this->Participant_Name = $row['Name'];
    }
}
