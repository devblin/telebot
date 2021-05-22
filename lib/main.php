<?php
/**
 * Chat types: [supergroup, private]
 * Entities types: [bot_command]
 */
class Bot
{
   public function __construct($messageFrom, $chat, $text, $entities = [])
   {
      //From
      if ($messageFrom) {
         $this->userId    = $messageFrom['id'];
         $this->isBot     = $messageFrom['is_bot'];
         $this->userName  = $messageFrom['username'];
         $this->firstName = $messageFrom['first_name'];
      }

      //Chat
      if ($chat) {
         $this->chatId       = $chat['id'];
         $this->chatType     = $chat['type'];
         $this->chatUsername = $chat['username'];
         $this->chatTitle    = $chat['title'];
      }

      //Text
      if ($text) {
         $this->text = $text;
      }

      //Entities
      if ($entities) {
         $this->entities = $entities;
      }

   }
   public function getText()
   {
      echo $this->text;
   }
}

$test = new Bot([], [], 'hello');
$test->getText();
