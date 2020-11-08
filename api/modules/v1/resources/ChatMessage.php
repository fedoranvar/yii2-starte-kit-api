<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;


class ChatMessage extends \console\models\ChatMessage implements Linkable
{
    public function fields()
    {
        return ['id', 'user_id', 'chat_id', 'content', 'created_at', 'updated_at', 'deleted_at'];
    }

    // /**
    //  * Returns a list of links.
    //  *
    //  * @return array the links
    //  */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['chat-message/view', 'id' => $this->id], true)
        ];
    }
}
