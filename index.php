<?php
set_time_limit(60);
date_default_timezone_set('Asia/Tehran');
header('Content-type: application/json');
    $update = json_decode(file_get_contents('php://input'), true);
    $message = $update["message"];
    $telegram_id = $message['from']['id'];
    $userInput = $message['text'];
    if ($userInput == 'سلام') {
      $replyText = 'سلام' . '/n' . 'یک عدد دلخواه بین 1-10 انتحاب کنید';
    }
    $reply = [
        'method' => 'sendMessage',
        'chat_id' => $message['chat']['id'],
        'text' => $replyText,
    ];
    echo json_encode($reply);
