<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Participant.php';

$database = new Database();
$db = $database->connect();

$participant = new Participant($db);

$participant->ID = isset($_GET['id']) ? $_GET['id'] : die();

$participant->read_single();

$participant_arr = [
    'status' => 'ok',
    'payload' => [
        'id' => $participant->ID,
        'email' => $participant->Email,
        'name' => $participant->Name,
    ]
];

print_r(json_encode($participant_arr));
