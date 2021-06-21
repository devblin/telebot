<p align="center">
    <img src="https://i.imgur.com/yKOqsaL.png" alt="BotPic"/>
</p>

# Telebot

🤖 A multipurpose, feature-rich telegram bot for your entertainment purposes.

## Contents:

- [Setup](#setup)
- [Commands](#commands)

## Setup

- Make sure you have [composer](https://getcomposer.org/):
    ```shell
    $ composer -V
    Composer version 2.X.XX YYYY-MM-DD HH:MM:SS
    ```
- Install dependencies:
    ```shell
    $ composer install
    ```
    [Install composer](https://getcomposer.org/download/)


- Bot Configurations:
    1. Get your bot token using BotFather.
    2. Create .env using .env.example and replace <TOKEN> with the bot token generated.
    3. Go to https://api.telegram.org/bot[TOKEN]/setWebhook?url=[BASE_HTTPS_URL].

    - Set web-hook:
      ```js
      {
        "ok": true,
        "result": true,
        "description": "Webhook was set"
      }
      ```
    - Check if web-hook is set:

      Go to URL: https://api.telegram.org/bot[TOKEN]/getWebhookInfo

        - Response
          ```js
          {
            "ok":true,
            "result":{
              "url":"BASE_HTTPS_URL",
              "has_custom_certificate":false,
              "pending_update_count":0,
              "max_connections":40
              }
          }
          ```
    - If not set:

      Go to URL https://api.telegram.org/bot[TOKEN]/deleteWebhook

- Then, repeat from Step-3 again :).


## Commands

- /start : Start your journey with devblin_bot.
- /help : Get help.
- /send : Send bulk messages to users or groups.
- /show : Get list of your users or groups, who use devblin_bot.
- /quiz : Play technical quiz.
- /poll : Create a poll.
- /joke : Get joke for today.
- /quote : Get quote for today.
- /meme : Get meme.