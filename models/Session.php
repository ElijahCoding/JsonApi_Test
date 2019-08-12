<?php

class Session
{
    private $conn;
    private $table = 'Participant';

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

    }

    public function read_single()
    {

    }

    public function create()
    {
        
    }
}
