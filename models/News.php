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

    }

    public function read_single()
    {

    }
}
