<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/News.php';

$database = new Database();
$db = $database->connect();

$news = new News($db);

$result = $news->read();
$num = $result->rowCount();

if ($num > 0) {
    $news_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $news_item = array(
            'ID' => $ID,
            'NewsTitle' => $NewsTitle,
            'NewsMessage' => $NewsMessage,
            'LikesCounter' => $LikesCounter,
            'Participant' => [
                'Email' => $Email,
                'Name' => $Name
            ]
        );

        array_push($news_arr, $news_item);
    }

    $data = [
        'status' => 'ok',
        'payload' => $news_arr
    ];

    echo json_encode($data);
} else {
    echo json_encode(
        array('message' => 'No News Found')
    );
}
