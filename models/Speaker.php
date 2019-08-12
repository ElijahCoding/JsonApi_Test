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

    }

    public function read_single()
    {

    }
}
