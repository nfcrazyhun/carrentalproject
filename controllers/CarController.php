<?php

namespace app\controllers;

use app\models\User;
use yii\filters\AccessControl;
use Yii;
use app\models\Car;
use app\models\search\CarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarController implements the CRUD actions for Car model.
 */
class CarController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->getId());
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Car models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Car model.
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
     * Creates a new Car model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Car();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Car model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Car model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws
     * NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Car model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Car the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Car::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists all Car models which ones is broken
     * @return mixed
     */
    public function actionWreck()
    {
        $searchModel = new CarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //extra parameter:filter where status = broker
        $dataProvider->query->andWhere(['status'=>Car::STATUS_BROKEN]);

        return $this->render('wreck', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Car models which ones is available to rent
     * @return mixed
     */
    public function actionAvailable()
    {
        $searchModel = new CarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //extra parameter:filter where status = active
        $dataProvider->query->andWhere(['status'=>Car::STATUS_ACTIVE]);

        return $this->render('available', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUsage()
    {
        $searchModel = new CarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('usage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Restore car which one has been repaired
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRestorecarbacktofleet($id)
    {
        $model = $this->findModel($id);

        $model->status = Car::STATUS_ACTIVE;

        $model->save();

        return $this->redirect(['car/index']);
    }

    public function actionListcarprice($id)
    {
        $carModels = Car::find()->where(['id'=>$id])->all();
        $countcar = Car::find()->where(['id'=>$id])->count();

        if ($countcar > 0) {
            foreach ($carModels as $item) {
                echo $item->rate;
            }
        }

    }
}
