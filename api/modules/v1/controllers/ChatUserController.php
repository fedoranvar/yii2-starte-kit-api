<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\resources\ChatUser;
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
use yii\filters\auth\HttpBasicAuth;
/**
 * Class ChatUserController
 */
class ChatUserController extends Controller {

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBasicAuth::className();
        return $behaviors;
    }
/**
     * @SWG\Get(path="/v1/chat-user/index",
     *     tags={"Chat-User"},
     *     summary="Retrieves the collection of pairs Chat-User.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat-User collection response",
     *         @SWG\Schema(ref = "#/definitions/ChatUser")
     *     ),
     * )
     *
     * @SWG\Get(path="/v1/chat-user/view",
     *     tags={"Chat-User"},
     *     summary="Displays data of one chat-user only",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Used to fetch information of a specific chat-user",
     *         @SWG\Schema(ref = "#/definitions/ChatUser")
     *     ),
     * )
     *
     * @SWG\Post(path="/v1/chat-user/create",
     *     tags={"Chat-User"},
     *     summary="Add User to Chat pair",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat-User have been created",
     *         @SWG\Schema(ref = "#/definitions/ChatUser")
     *     ),
     * )
     * @SWG\Delete(path="/v1/chat-user/delete",
     *     tags={"Chat-User"},
     *     summary="Delete user from chat",
     *     @SWG\Response(
     *         response = 200,
     *         description = "User from Chat have been deleted",
     *         @SWG\Schema(ref = "#/definitions/ChatUser")
     *     ),
     * )
     */


    public function actionIndex() {

        $request = Yii::$app->request;

        if (!$request->isGET) {
            return 'Only GET-method allowed!';
        }

        return new ActiveDataProvider(array(
            'query' => ChatUser::find()
        ));
    }


    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function actionView($id) {

        $request = Yii::$app->request;

        if (!$request->isGET) {
            return 'Only GET-method allowed!';
        }

        return $this->findModel($id);
    }



    public function actionCreate() {

        $request = Yii::$app->request;

        if (!$request->isPost) {
            return 'Only POST-method allowed!';
        }

        $jsonResponse = json_decode(Yii::$app->request->getRawBody());
        $model = new ChatUser([
            'chat_id' => $jsonResponse->chat_id,
            'user_id' => $jsonResponse->user_id
        ]);

        if ($model->save()) {

            return [
                'status' => true,
                'data'   => 'User was successfully added to chat'
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

        if ($model->delete()) {

            return [
                'status' => true,
                'data'   => 'User was successfully removed from chat'
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
        $model = ChatUser::find()
            ->where(['id' => $id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }

}
