<?php

namespace app\controllers;

use Yii;
use app\models\Paktaintegritas;
use app\models\PaktaintegritasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaktainteritasController implements the CRUD actions for Paktaintegritas model.
 */
class PaktaintegritasController extends Controller
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
     * Lists all Paktaintegritas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaktaintegritasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paktaintegritas model.
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
     * Creates a new Paktaintegritas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paktaintegritas();

        if ($model->load(Yii::$app->request->post())) {
            $model->jabatan = Yii::$app->request->post('jabatan');
            $model->tanggal = Yii::$app->request->post('tanggal');
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Paktaintegritas model.
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
     * Deletes an existing Paktaintegritas model.
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
     * Finds the Paktaintegritas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paktaintegritas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
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


//        var_dump($datas[0]['tanggal']);die();
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
//        $pdf->methods = [
//
//            'SetTitle' => 'Notulen '.$model[0]['acara'],
//
//        ];

        return $pdf->render();
//        return $pdf->content;
    }
}
