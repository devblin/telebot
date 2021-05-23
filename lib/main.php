<?php
require_once __DIR__ . "/helpers.php";

/**
 * Chat types: [supergroup, private]
 * Entities types: [bot_command]
 */
class Bot
{
   private $messageId;
   private $userId, $isBot, $userName, $firstName;
   private $chatId, $chatTyype, $chatUsername, $chatTitle;
   private $text;
   private $entities;
   private $commandList = "<b>Command List:</b>
   /start : Start your journey with devblin_bot.
   /help : Get help.
   /send : Send bulk messages to users or groups.
   /show : Get list of your users or groups, who use devblin_bot.
   /joke : Get joke.
   /quote : Get quote.
   /meme : Get meme.
   /tictactoe : Play tic-tac-toe game with freinds or devblin_bot.";

   public function __construct($messageId, $from, $chat, $text, $entities = [])
   {
      $this->messageId = $messageId;

      //From
      if ($from) {
         $this->userId    = $from['id'];
         $this->isBot     = $from['is_bot'];
         $this->userName  = $from['username'];
         $this->firstName = $from['first_name'];
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

   public function __sendMessage($query, $method = 'sendMessage')
   {
      $http                = new Http($method);
      $query['parse_mode'] = 'HTML';
      $http->getReq($query);
   }

   public function start()
   {
      $text = "<b>🤖 Welcome, $this->firstName</b>\nI am devblin_bot, a multipurpose, feature-rich telegram bot for your entertainment purposes.\n\n";
      $text .= $this->commandList;
      $query = ['chat_id' => $this->chatId, 'text' => $text];
      $this->__sendMessage($query);
   }

   public function help()
   {
      $query = ['chat_id' => $this->chatId, 'text' => $this->commandList];
      $this->__sendMessage($query);
   }

   public function comingSoon()
   {
      $text  = "⏰ Sorry, the command is currently unavailable.";
      $query = ['chat_id' => $this->chatId, 'text' => $text, 'reply_to_message_id' => $this->messageId];
      $this->__sendMessage($query);
   }

   public function botMention()
   {
      $text  = "Yes, $this->firstName. How can I help you?";
      $query = ['chat_id' => $this->chatId, 'text' => $text, 'reply_to_message_id' => $this->messageId];
      $this->__sendMessage($query);
   }

   public function defaultReply()
   {
   }

   public function sendHelp()
   {}

   public function saveUser()
   {}

   public function getJoke()
   {}

   public function getQuote()
   {}

   public function getMeme()
   {}

   public function createPoll()
   {}

   public function tictactoeGame($position = [])
   {}
}
