<?php

namespace app\controllers;

use Yii;
use app\models\Paktaintegritas;
use app\models\PaktaintegritasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class PaktaintegritasController extends Controller
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
        $searchModel = new PaktaintegritasSearch();
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
        $model = new Paktaintegritas();

        if ($model->load(Yii::$app->request->post())) {
            $model->tanggal = Yii::$app->request->post('tanggal');
            $model->save(false);
            if ($model->save() == false){
                Yii::$app->getSession()->setFlash(
                    'success','Data gagal di simpan!'
                );
            }else{
                Yii::$app->getSession()->setFlash(
                    'success','Data behasil!'
                );
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->tanggal = Yii::$app->request->post('tanggal');
            $model->save();
            if ($model->save() == false){
                Yii::$app->getSession()->setFlash(
                    'success','Data gagal di simpan!'
                );
            }else{
                Yii::$app->getSession()->setFlash(
                    'success','Data behasil!'
                );
            }
            return $this->redirect(['index']);
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
        if (($model = Paktaintegritas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCetak($id)
    {
        $sql = "SELECT pi.jabatan, pi.tanggal, pi.ttd,mb.nip, mb.nama FROM pakta_integritas pi
JOIN m_biodata mb ON pi.id_data = mb.id_data WHERE pi.id = $id";
        $datas = \Yii::$app->db->createCommand($sql)->queryAll();

        $direktur = (new Paktaintegritas())->ttdDirektur();

        $pdf = Yii::$app->pdf;
        $pdf->content = $this->renderPartial('cetak', ['datas'=>$datas, 'direktur'=>$direktur]);
        $pdf->orientation = 'P';
        $pdf->marginTop = 15;
        $pdf->marginBottom = 4;
        $pdf->marginHeader = 2;
        $pdf->marginFooter = 2;
        $pdf->marginLeft = 30;
        $pdf->marginRight = 20;
        $pdf->cssInline = '.thead{border: 1px solid #0003;text-align: center;font-weight: bold;background:#eee;}.tbody{padding:2px;}#tb1 tr:nth-child(even) {background: #eee}#tb1 tr:nth-child(odd) {background: #FFF}';
        return $pdf->render();
    }
}
