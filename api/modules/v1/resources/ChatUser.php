<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;


class ChatUser extends \console\models\ChatUser implements Linkable
{
    public function fields()
    {
        return ['id', 'user_id', 'chat_id'];
    }

    // /**
    //  * Returns a list of links.
    //  *
    //  * @return array the links
    //  */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['chat-user/view', 'id' => $this->id], true)
        ];
    }
}
