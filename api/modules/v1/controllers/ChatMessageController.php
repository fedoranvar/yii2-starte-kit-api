<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\resources\ChatMessage;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\rest\IndexAction;
use yii\rest\OptionsAction;
use yii\rest\CreateAction;
use yii\rest\UpdateAction;
use yii\rest\DeleteAction;
use yii\rest\Serializer;
use yii\rest\ViewAction;
use yii\rest\Controller;
use yii\web\HttpException;

/**
 * Class ChatController
 */
class ChatMessageController extends Controller
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\ChatMessage';
    /**
     * @SWG\Get(path="/v1/chat-message/index",
     *     tags={"Chat Message"},
     *     summary="Retrieves the collection of Chat Messages.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chats collection response",
     *         @SWG\Schema(ref = "#/definitions/ChatMessage")
     *     ),
     * )
     *
     * @SWG\Get(path="/v1/chat-message/view",
     *     tags={"Chat Message"},
     *     summary="Displays data of one chat message only",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Used to fetch information of a specific chat
     *         message.",
     *         @SWG\Schema(ref = "#/definitions/ChatMessage")
     *     ),
     * )
     *
     * @SWG\Post(path="/v1/chat-message/create",
     *     tags={"Chat Message"},
     *     summary="Create chat message",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat Message have been created",
     *         @SWG\Schema(ref = "#/definitions/ChatMessage")
     *     ),
     * )
     * @SWG\Patch(path="/v1/chat-message/update",
     *     tags={"Chat Message"},
     *     summary="Update chat message",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat Message have been updated",
     *         @SWG\Schema(ref = "#/definitions/ChatMessage")
     *     ),
     * )
     * @SWG\Delete(path="/v1/chat-message/delete",
     *     tags={"Chat Message"},
     *     summary="Delete chat message",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat Message have been deleted",
     *         @SWG\Schema(ref = "#/definitions/Chat")
     *     ),
     * )
     */

    public function actionSecurity() {
        return Yii::$app->user->identity;
    }

    public function actionIndex() {
        return new ActiveDataProvider(array(
            'query' => ChatMessage::find()
        ));
    }


    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function actionView($id) {
        return $this->findModel($id);
    }


    public function actionCreate() {

        $request = Yii::$app->request;

        if (!$request->isPost) {
            return 'Only POST-method allowed!';
        }

        $jsonResponse = json_decode(Yii::$app->request->getRawBody());
        $model = new ChatMessage([
            'created_at' => date('Y-m-d H:i:s'),
            'content' => $jsonResponse->content,
            'chat_id' => $jsonResponse->chat_id,
            'user_id' => $jsonResponse->user_id,
        ]);

        if ($model->save()) {

            return [
                'status' => true,
                'data'   => 'Chat Message was successfully created'
            ];
        } else {

            return [
                'status' => false,
                'data'   => $model->errors
            ];
        }
    }


    public function actionUpdate($id) {

        $request = Yii::$app->request;

        if (!$request->isPatch) {
            return 'Only PATCH-method allowed!';
        }

        $jsonResponse = json_decode(Yii::$app->request->getRawBody());
        $model = $this->findModel($id);
        $model->setAttributes([
            'updated_at' => date('Y-m-d H:i:s'),
            'content' => $jsonResponse->content,
        ]);

        if ($model->save()) {

            return [
                'status' => true,
                'data'   => 'Chat Message was successfully updated'
            ];
        } else {

            return [
                'status' => false,
                'data'   => $model->errors
            ];
        }
    }


    public function actionDelete($id) {

        $request = Yii::$app->request;

        if (!$request->isDelete) {
            return 'Only DELETE-method allowed!';
        }

        $model = $this->findModel($id);

        if (!empty($model->deleted_at)) {
            return [
                'status' => false,
                'data'   => 'Chat Message already deleted.'
            ];
        }

        $model->setAttributes([
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        if ($model->save()) {

            return [
                'status' => true,
                'data'   => 'Chat Message was successfully deleted'
            ];
        } else {

            return [
                'status' => false,
                'data'   => $model->errors
            ];
        }
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id) {
        $model = ChatMessage::find()
            ->where(['id' => (int)$id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }

}
