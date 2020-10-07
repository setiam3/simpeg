<?php
namespace app\controllers;
use Yii;
use app\models\MmasterchecklogPegawai;
use app\models\MBiodata;
use app\models\MmasterchecklogPegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
class MasterchecklogPegawaiController extends Controller
{
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
    public function actionIndex()
    {
        $searchModel = new MmasterchecklogPegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionCreate()
    {
        $model = new MmasterchecklogPegawai();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $biodata = MBiodata::findOne($model->id_data);
            $biodata->checklog_id = $model->checklogpegawai_id;
            if($biodata->update()){
                return $this->redirect(['view', 'id' => $model->checklogpegawai_id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $biodata = MBiodata::findOne($model->id_data);
            $biodata->checklog_id = $model->checklogpegawai_id;
            if($biodata->update()){
                return $this->redirect(['view', 'id' => $model->checklogpegawai_id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = MmasterchecklogPegawai::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
