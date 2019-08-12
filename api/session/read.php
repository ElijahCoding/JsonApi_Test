<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Session.php';

$database = new Database();
$db = $database->connect();

$session = new Session($db);

$result = $session->read();
$num = $result->rowCount();

if ($num > 0) {
    $sessions_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $session_item = array(
            'ID' => $ID,
            'Name' => $Name,
            'TimeOfEvent' => $TimeOfEvent,
            'Description' => $Description
        );

        array_push($sessions_arr, $session_item);
    }

    $data = [
        'status' => 'ok',
        'payload' => $sessions_arr
    ];

    echo json_encode($data);
} else {
    echo json_encode(
        array('message' => 'No Sessions Found')
    );
}
