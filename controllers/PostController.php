<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Post::find()->where(['status' => Post::STATUS_PUBLISHED])->with('comments');
        $tag = Yii::$app->request->get('tag');
        if(isset($tag)) {
            $query = $query->filterWhere(['like', 'tags', '%' . $tag . '%', false]);
        }
        $searchModel = new PostSearch();

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5,
                ],
                'sort' => [
//                    'attributes' => ['created_time']
                    'defaultOrder' => [
                        'create_time' => SORT_DESC,
                    ]
                ],
            ]
        );

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
