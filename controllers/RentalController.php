<?php

namespace app\controllers;

use app\models\Car;
use app\models\User;
use DateTime;
use yii\filters\AccessControl;
use Yii;
use app\models\Rental;
use app\models\search\RentalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * RentalController implements the CRUD actions for Rental model.
 */
class RentalController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','update','delete','income'],
                'rules' => [
                    [
                        'actions' => ['index','update','delete','income'],
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
     * Lists all Rental models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RentalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rental model.
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
     * Creates a new Rental model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rental();

        if ($model->load(Yii::$app->request->post()) && $model->save() && Car::findOne($model->car_id)->status == Car::STATUS_ACTIVE) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rental model.
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
     * Deletes an existing Rental model.
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
     * Cancels a rental
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCancel($id)
    {
        $model = $this->findModel($id);

        $model->status = Rental::STATUS_CANCELED;

        $model->save();

        return $this->redirect(['rental/rental-history']);
    }

    /**
     * Finds the Rental model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rental the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rental::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists user's all past rentals
     * @return mixed
     */
    public function actionRentalHistory()
    {
        $searchModel = new RentalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //extra parameter:filter where user_id = current user's id
        $dataProvider->query->andWhere(['user_id'=> Yii::$app->user->getId()]);

        return $this->render('rental-history', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIncome()
    {
        $model = new Rental();

        $searchModel = new RentalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('income', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);


    }


    /**
     * Change car status to broken
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionBreakdowncar($id)
    {
        $rentalModel = $this->findModel($id);

        $carModel = Car::findOne($rentalModel->car_id);

        $carModel->status = Car::STATUS_BROKEN;

        $carModel->save();

        return $this->redirect(['rental/rental-history']);
    }

    /**
     * Ajax Response
     * Get car id ,start date, end date, then
     * returns calculated value to represent cost on rental create site
     *
     * @param $id
     * @param $sdate
     * @param $edate
     * @return string JSON encoded
     * @throws \Exception
     */
    public function actionAjaxcarprice($id, $sdate, $edate)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = Car::findOne($id);
        $basePrice = Rental::RENTAL_BASE_PRICE;
        $rate = $model->rate;

        $diffInSec = strtotime($edate)-strtotime($sdate);//calculate two date's difference in seconds
        $numberOfDays = $diffInSec/60/60/24;//calc seconds to days
        $numberOfDays = ceil($numberOfDays);//round it up
        $numberOfDays = abs($numberOfDays);//then get its absolute value

        $costInPeriod = $numberOfDays*$rate;
        $sumOfCosts = $basePrice+$rate+$costInPeriod;


        $response["basePrice"] = $basePrice;
        $response["rate"] = $rate;
        $response["numberOfDays"] = $numberOfDays;
        $response["costInPeriod"] = $costInPeriod;
        $response["sumOfCosts"] = $sumOfCosts;

        $response=Json::encode($response);

        return $response;
    }

}
