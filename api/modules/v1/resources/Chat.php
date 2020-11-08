<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;


class Chat extends \console\models\Chat implements Linkable
{
    public function fields()
    {
        return ['id', 'title', 'created_at', 'updated_at', 'deleted_at'];
    }

    // /**
    //  * Returns a list of links.
    //  *
    //  * @return array the links
    //  */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['chat/view', 'id' => $this->id], true)
        ];
    }
}
