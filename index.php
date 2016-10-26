<?php
set_time_limit(60);
date_default_timezone_set('Asia/Tehran');
header('Content-type: application/json');
    $update = json_decode(file_get_contents('php://input'), true);
    $int = 1;
    $message = $update["message"];
    $telegram_id = $message['from']['id'];
    $userInput = $message['text'];
    if ($userInput == 'شروع') {
      $replyText = 'یک عدد دلخواه بین 1-10 انتحاب کنید';
    } elseif (1) {
      $replyText = gettype($userInput);
    } else {
      $replyText = 'سلام برای شروع بازی شروع را بزنید';
    }
    $reply = [
        'method' => 'sendMessage',
        'chat_id' => $message['chat']['id'],
        'text' => $replyText,
    ];
    echo json_encode($reply);
//gettype($userInput) == gettype($int)
