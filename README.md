# TeleBot

###### Note: If you have created the new bot follow following instructions to use.

##### 1. Get your telegram API_KEY.

##### 2. Open env_sample.php file in setup folder and replace 'YOUR_API_KEY' with the one you have.

##### 3. Enter you DataBase credentials in env.php file and export the given SQL to you DB.

##### 4. Go to https://api.telegram.org/botYOUR_API_KEY/setWebhook?url=BASE_HTTPS_URL

- YOU WILL SEE FOLLOWING:
  > {"ok":true,"result":true,"description":"Webhook was set"}
- GO TO FOLLOWING AND CHECK:
  > Go to URL https://api.telegram.org/botYOUR_API_KEY/getWebhookInfo
- You WILL SEE:
  > {"ok":true,"result":{"url":"https://92468decce2c.ngrok.io/TeleBot/","has_custom_certificate":false,"pending_update_count":0,"max_connections":40}}
- IF NOT:
  > Go to URL https://api.telegram.org/botYOUR_API_KEY/deleteWebhook
- Then do step-3 again :)
