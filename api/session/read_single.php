<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Session.php';

$database = new Database();
$db = $database->connect();

$session = new Session($db);

$session->ID = isset($_GET['id']) ? $_GET['id'] : die();

$session->read_single();

$session_arr = [
    'status' => 'ok',
    'payload' => [
        'id' => $session->ID,
        'name' => $session->Name,
        'TimeOfEvent' => $session->TimeOfEvent,
        'Description' => $session->Description
    ]
];

print_r(json_encode($session_arr));
