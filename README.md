# Yii 2 Starter Kit (fedoranvar edit.)

## Quickstart
---
1. [Install composer](https://getcomposer.org)
2. [Install docker](https://docs.docker.com/install/)
3. [Install docker-compose](https://docs.docker.com/compose/install/)
4. Run
    ```bash
    git clone git@github.com:fedoranvar/yii2-starter-kit-api.git
    cd myproject.com
    composer run-script docker:build
    ```
5. Go to [http://yii2-starter-kit.localhost](http://yii2-starter-kit.localhost)

## Usage

### API token authentication
1. Go to http://backend.yii2-starter-kit.localhost/user/index and log in with `webmaster:webmaster`
2. Choose user which token you want to use by clickig `eye`-icon
3. Copy and paste `API access_token` in request as HTTPBasicAuth username (password leave blank)

### API

*  **Chat**
    * GET    - */v1/chat*                - fetch all chats
    * GET    - */v1/chat/view?id={id}*   - fetch chat with id={`id`}
    * POST   - */v1/chat/create*         - create new chat
        * Context: [ `title` ]
    * PATCH  - */v1/chat/update?id={id}* - Edit chat with id={`id`}
        * Context: [ `title` ]
    * DELETE - */v1/chat/delete?id={id}* - Delete (set `deleted_at` and don't show GET) chat with id={`id`}
*  **Chat Message**
    * GET    - */v1/chat-message*                - fetch all chats messages
    * GET    - */v1/chat-message/view?id={id}*   - fetch chat message with id={`id`}
    * POST   - */v1/chat-message/create*         - create new chat message
        * Context: [ `user_id`, `chat_id`, `content` ]
    * PATCH  - */v1/chat-message/update?id={id}* - Edit chat message with id={`id`}
        * Context: [ `content` ]
    * DELETE - */v1/chat-message/delete?id={id}* - Delete (set `deleted_at` and don't show GET) chat message with id={`id`}
*  **Chat User**  
    * GET    - */v1/chat-user*                - fetch all chat-users
    * GET    - */v1/chat-user/view?id={id}*   - fetch chat-user with id={`id`}
    * POST   - */v1/chat-user/create*         - Join `user_id` in `chat_id`
        * Context: [ `user_id`, `chat_id` ]
    * DELETE - */v1/chat-user/delete?id={id}* - Remove `user_id` from `chat_id` (context taken from chat-user with id={`id`})

For more details refer to: 
http://api.yii2-starter-kit.localhost/site/docs#/




