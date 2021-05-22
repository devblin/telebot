# Telebot

🤖 A multipurpose, feature-rich telegram bot.

## Contents:

- [Setup](#setup)
- [Commands](#commands)

## Setup

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

  Go to URL: https://api.telegram.org/botYOUR_API_KEY/getWebhookInfo

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

  Go to URL https://api.telegram.org/botYOUR_API_KEY/deleteWebhook

- Then, repeat from Step-3 again :).


## Commands

- /start : Start journey with the bot.
- /poll : Create poll.
- /send : Send message to users/groups.