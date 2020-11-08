<?php

namespace api\modules\v1\models\definitions;

/**
 * @SWG\Definition(required={"user_id", "chat_id", "content"})
 *
 * @SWG\Property(property="id", type="integer")
 * @SWG\Property(property="user_id", type="integer")
 * @SWG\Property(property="chat_id", type="integer")
 * @SWG\Property(property="content", type="string")
 * @SWG\Property(property="created_at", type="integer")
 * @SWG\Property(property="updated_at", type="integer")
 * @SWG\Property(property="deleted_at", type="integer")
 */
class ChatMessage
{
    // dummy class for Swagger definitions
}
