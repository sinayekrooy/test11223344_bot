<?php
session_start();
set_time_limit(60);
date_default_timezone_set('Asia/Tehran');
header('Content-type: application/json');
    $update = json_decode(file_get_contents('php://input'), true);

    $message = $update["message"];
    $telegram_id = $message['from']['id'];
    $userInput = $message['text'];
    $replyText = "";

    if (!isset($_SESSION['appName'])) {
      switch ($userInput) {
        case 's':
          $_SESSION['appName'] = "gameStart";
          break;

        default:
          $replyText = "دستور مورد نظر یافت نشد.";
          $replyText .= "\n";
          $replyText .= "لطفا یکی از گزینه های موجود را انتخاب کنید:";
          $replyText .= "\n";
          $replyText .= "شروع بازی";
          break;
      }
    }

    if (isset($_SESSION['appName'])) {
      if ($_SESSION['appName'] == 'gameStart') {
          $replyText = gameStart($userInput);
      }
    }

    function gameStart($input) {
        if ($input == 'خروج') {
          session_destroy();
          return "bye";
        } elseif ($input == "بیشتر") {

          $_SESSION['big'] = $_SESSION['rand'];
          $_SESSION['rand'] = rand($_SESSION['small'], $_SESSION['big']);

          $output = "\n" . "آیا عدد انتخاب شده" . $_SESSION['rand'] . "می باشد؟"
                  . "پاسخ را به صورت '" . "کمتر'" . "'بشتر'" . "'مساوی'" . "ارسال کنید";
          return $output;
        }
        elseif ($input == "کمتر") {

         $_SESSION['small'] = $_SESSION['rand'];
         $_SESSION['rand'] = rand($_SESSION['small'], $_SESSION['big']);
         $output = "\n" . "آیا عدد انتخاب شده" . $_SESSION['rand'] . "می باشد؟"
                 . "پاسخ را به صورت '" . "کمتر'" . "'بشتر'" . "'مساوی'" . "ارسال کنید";
         return $output;

       } elseif ($input == "مساوی" ) {

         $output = "تبریک عدد مورد نظر یافت شد";
         return $output;

       } elseif ($input == "شروع بازی") {

          $_SESSION['big'] = 10;
          $_SESSION['small'] = 1;
          $_SESSION['rand'] = rand($_SESSION['small'], $_SESSION['big']);

          $output = "به بازی حدس عدد خوش آمدید" . "\n" . "یک عدد دلخواه از 1 تا 10 در نظر بگیرید"
            . "\n" . "آیا عدد انتخاب شده" . $_SESSION['rand'] . "می باشد؟"
            . "پاسخ را به صورت '" . "کمتر'" . "'بشتر'" . "'مساوی'" . "ارسال کنید";
          return $output;

        } else {
          return "دستور وارد شده صحیح نمی باشد" . "مجدد تلاش فرمایید";
        }
    }

    $reply = [
        'method' => 'sendMessage',
        'chat_id' => $message['chat']['id'],
        'text' => $replyText,
    ];
    echo json_encode($reply);
//gettype($userInput) == gettype($int)
