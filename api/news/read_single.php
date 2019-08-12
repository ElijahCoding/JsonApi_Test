<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/News.php';

$database = new Database();
$db = $database->connect();

$news = new News($db);

$news->ID = isset($_GET['id']) ? $_GET['id'] : die();

$news->read_single();

$news_arr = [
    'status' => 'ok',
    'payload' => [
        'id' => $news->ID,
        'NewsTitle' => $news->NewsTitle,
        'NewsMessage' => $news->NewsMessage,
        'LikesCounter' => $news->LikesCounter,
        'Participant' => [
            'Participant_Email' => $news->Participant_Email,
            'Participant_Name' => $news->Participant_Name
        ]
    ]
];

print_r(json_encode($news_arr));
