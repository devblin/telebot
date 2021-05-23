<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . "/lib/main.php";

$update   = file_get_contents("php://input");
$update   = json_decode($update, true);
$botName  = $_ENV['BOT_NAME'];
$message  = $update['message'];
$commands = ['/start', '/help', '/send', '/show', '/joke', '/quote', '/meme', '/quiz', '/tictactoe'];

if ($message) {
   $messageId = $message['message_id'];
   /**
    *  "from": {
    *       "id":  **********,
    *       "is_bot": false,
    *       "first_name": "Deepanshu",
    *       "username": "devblin",
    *       "language_code": "en"
    *   },
    */
   $from = $message['from'];

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

   $bot = new Bot($message, $from, $chat, $text, $entities);

   if ($entities[0]['type'] === "bot_command") {
      switch ($text) {
         case "/start":
         case "/start@$botName":
            $bot->start();
            break;

         case "/help":
         case "/help@$botName":
            $bot->help();
            break;

         case "/quiz":
         case "/quiz@$botName":
            $bot->quiz();
            break;

         case "/show":
         case "/send":
         case "/joke":
         case "/quote":
         case "/meme":
         case "/tictactoe":
         case "/show@$botName":
         case "/send@$botName":
         case "/joke@$botName":
         case "/quote@$botName":
         case "/meme@$botName":
         case "/tictactoe@$botName":
            $bot->comingSoon();

         default:
            break;
      }
   } else if ($entities[0]['type'] === 'mention' && explode("@", $text)[1] === $botName) {
      $bot->botMention();
   }

}
