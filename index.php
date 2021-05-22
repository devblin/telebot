<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . "/lib/helpers.php";

$update  = file_get_contents("php://input");
$update  = json_decode($update, true);
$message = $update['message'];

if ($message) {
   /**
    *  "from": {
    *       "id": **********,
    *       "is_bot": false,
    *       "first_name": "Deepanshu",
    *       "username": "devblin",
    *       "language_code": "en"
    *   },
    */
   $messageFrom = $message['from'];

   /**
    *  "chat": {
    *       "id": **********,
    *       "first_name": "Deepanshu",
    *       "username": "devblin",
    *       "type": "private"
    *   },
    */
   $chat = $message['chat'];
   $text = $message['text'];

   /**
    *  "entities": [
    *       {
    *           "offset": 0,
    *           "length": 5,
    *           "type": "bot_command"
    *       }
    *   ]
    */
   $entities = $message['entities'];
}
