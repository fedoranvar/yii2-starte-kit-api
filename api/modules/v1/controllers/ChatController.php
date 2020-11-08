<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\resources\Chat;
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
 * Class ChatController
 */
class ChatController extends Controller
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\Chat';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBasicAuth::className();
        return $behaviors;
    }

   /**
     * @SWG\Get(path="/v1/chat/index",
     *     tags={"Chat"},
     *     summary="Retrieves the collection of Chats.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chats collection response",
     *         @SWG\Schema(ref = "#/definitions/Chat")
     *     ),
     * )
     *
     * @SWG\Get(path="/v1/chat/view",
     *     tags={"Chat"},
     *     summary="Displays data of one chat only",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Used to fetch information of a specific chat.",
     *         @SWG\Schema(ref = "#/definitions/Chat")
     *     ),
     * )
     *
     * @SWG\Post(path="/v1/chat/create",
     *     tags={"Chat"},
     *     summary="Create chat",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat have been created",
     *         @SWG\Schema(ref = "#/definitions/Chat")
     *     ),
     * )
     * @SWG\Patch(path="/v1/chat/update",
     *     tags={"Chat"},
     *     summary="Update chat",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat have been updated",
     *         @SWG\Schema(ref = "#/definitions/Chat")
     *     ),
     * )
     * @SWG\Delete(path="/v1/chat/delete",
     *     tags={"Chat"},
     *     summary="Delete chat",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Chat have been deleted",
     *         @SWG\Schema(ref = "#/definitions/Chat")
     *     ),
     * )
     */


    public function actionIndex() {
        return new ActiveDataProvider(array(
            'query' => Chat::find()->where(['deleted_at' => null])
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
        $model = new Chat([
            'created_at' => date('Y-m-d H:i:s'),
            'title' => $jsonResponse->title
        ]);

        if ($model->save()) {

            return [
                'status' => true,
                'data'   => 'Chat was successfully saved'
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
            'title' => $jsonResponse->title
        ]);

        if ($model->save()) {

            return [
                'status' => true,
                'data'   => 'Chat was successfully updated'
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
            return 'Only DELETE allowed!';
        }

        $model = $this->findModel($id);

        if (!empty($model->deleted_at)) {
            return [
                'status' => false,
                'data'   => 'Chat already deleted.'
            ];
        }

        $model->setAttributes([
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        if ($model->save()) {

            return [
                'status' => true,
                'data'   => 'Chat was successfully deleted'
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
        $model = Chat::find()
            ->where(['id' => $id])
            ->andWhere(['deleted_at' => null])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }

}
