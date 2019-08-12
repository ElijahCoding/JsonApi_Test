<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Speaker.php';

$database = new Database();
$db = $database->connect();

$speaker = new Speaker($db);

$speaker->ID = isset($_GET['id']) ? $_GET['id'] : die();

$speaker->read_single();

$speaker_arr = [
    'status' => 'ok',
    'payload' => [
        'id' => $speaker->ID,
        'name' => $speaker->Name,
    ]
];

print_r(json_encode($speaker_arr));
