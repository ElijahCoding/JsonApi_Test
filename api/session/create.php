<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Session.php';

$database = new Database();
$db = $database->connect();

$session = new Session($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$session->Name = $data->Name;
$session->TimeOfEvent = $data->TimeOfEvent;
$session->Description = $data->Description;

if($session->create()) {
    echo json_encode(
        array('message' => 'Session Created')
    );
} else {
    echo json_encode(
        array('message' => 'Session Not Created')
    );
}
