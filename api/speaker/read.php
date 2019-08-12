<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Speaker.php';

$database = new Database();
$db = $database->connect();

$speaker = new Speaker($db);

$result = $speaker->read();
$num = $result->rowCount();

if ($num > 0) {
    $speakers_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $speaker_item = array(
            'ID' => $ID,
            'Name' => $Name,
        );

        array_push($speakers_arr, $speaker_item);
    }

    $data = [
        'status' => 'ok',
        'payload' => $speakers_arr
    ];

    echo json_encode($data);
} else {
    echo json_encode(
        array('message' => 'No Speakers Found')
    );
}
