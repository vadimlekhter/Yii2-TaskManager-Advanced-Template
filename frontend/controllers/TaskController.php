<?php

namespace frontend\controllers;

use common\config\AuthItems;
use common\models\ProjectUser;
use Yii;
use common\models\Task;
use common\models\search\TaskSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
//                        'actions' => ['index', 'view'],
                        'allow' => true,
//                        'roles' => ['@'],
                        'roles' => [AuthItems::ROLE_USER],
                    ],


//                    [
//                        'actions' => ['update', 'delete'],
//                        'allow' => true,
//                        'matchCallback' => function ($rule, $action) {
//
//            $projectId = ->project_id;
////            var_dump($projectId);
//            $roles = ProjectUser::find()->select('role')->where(['project_id'=>$projectId])->column();
////            var_dump($roles);exit();
//                            return in_array(ProjectUser::ROLE_MANAGER, $roles);
//                        }
//                    ],
//                    [
//                        'allow' => true,
//                        'roles' => ['role_name'],
//                    ],


                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->byUser(Yii::$app->user->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws ForbiddenHttpException if user has no right for this action
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if (!in_array(ProjectUser::ROLE_MANAGER, Yii::$app->userService->getAllRoles())) {
            throw new ForbiddenHttpException();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException if user has no right for this action
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity)) {
            throw new ForbiddenHttpException();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException if user has no right for this action
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity)) {
            throw new ForbiddenHttpException();
        }

        $model->delete();



        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws ForbiddenHttpException if user has no right for this action
     */
    public function actionTake($id)
    {

        $model = $this->findModel($id);

        if (!Yii::$app->taskService->canTake($model, Yii::$app->user->identity)) {
            throw new ForbiddenHttpException();
        }

        if (Yii::$app->taskService->takeTask($model, Yii::$app->user->identity)) {
            Yii::$app->session->setFlash('success', 'Вы взяли задачу');
            return $this->redirect(['task/view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws ForbiddenHttpException if user has no right for this action
     */
    public function actionComplete($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->taskService->canComplete($model, Yii::$app->user->identity)) {
            throw new ForbiddenHttpException();
        }

        if (Yii::$app->taskService->completeTask($model)) {
            Yii::$app->session->setFlash('success', 'Задача завершена');
            return $this->redirect(['task/view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }
}
