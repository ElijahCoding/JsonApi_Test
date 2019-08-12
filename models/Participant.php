<?php

class Participant
{
    private $conn;
    private $table = 'Participant';

    public $ID;
    public $Email;
    public $Name;

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
