<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Participant.php';

$database = new Database();
$db = $database->connect();

$participant = new Participant($db);

$result = $participant->read();
$num = $result->rowCount();

if ($num > 0) {
    $participants_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $participant_item = array(
            'ID' => $ID,
            'Email' => $Email,
            'Name' => $Name,
        );

        array_push($participants_arr, $participant_item);
    }

    $data = [
        'status' => 'ok',
        'payload' => $participants_arr
    ];

    echo json_encode($data);
} else {
    echo json_encode(
        array('message' => 'No Speakers Found')
    );
}
