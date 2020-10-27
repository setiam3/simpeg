<?php
namespace app\controllers;
use Yii;
use DateTime;
use app\models\Jatahcuti;
use app\models\Pengajuanijin;
use app\models\PengajuanijinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
class PengajuanijinController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $role=\Yii::$app->tools->getcurrentroleuser();
        if(in_array('karyawan',$role)){
            $where=['id_data'=>\Yii::$app->user->identity->id_data];
        } else{
            $where='';
        }
        $searchModel = new PengajuanijinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCetak($id){
        $model=$this->findModel($id);
        $pdf=Yii::$app->pdf;
        $pdf->content=$this->renderPartial('_cetak',['model'=>$model]);
        $pdf->orientation='P';
        $pdf->marginTop=6;
        $pdf->marginBottom=4;
        $pdf->marginHeader=2;
        $pdf->marginFooter=2;
        $pdf->marginLeft=6;
        $pdf->marginRight=6;
        $pdf->cssInline='.thead{border: 1px solid #0003;text-align: center;font-weight: bold;background:#eee;}.tbody{padding:2px;}#tb1 tr:nth-child(even) {background: #eee}#tb1 tr:nth-child(odd) {background: #FFF}';
        $pdf->methods=[
            'SetHeader' => ['RSUD Ibnusina'],
            'SetFooter'=>['{PAGENO}'],
        ];
        return $pdf->render();
    }
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Pengajuanijin #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.md5(get_class($model))])
                ];
        }else{
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Pengajuanijin();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Pengajuanijin",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post())){
                $model->tanggalPengajuan = date('Y-m-d');
                $holidays=ArrayHelper::map(\app\models\Hariliburnasional::find()->all(),'tanggal','tanggal');
                $diajukan=Yii::$app->tools->getWorkingDays($model->tanggalMulai,$model->tanggalAkhir,$holidays);
                if(($sisa=Jatahcuti::find()->where(['id_data'=>$model->id_data])->one())!==null && $sisa->sisa>=$diajukan){
                    $model->save(false);
                    return [
                        'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax',
                        'title'=> "Create new Pengajuanijin",
                        'content'=>'<span class="text-success">Create Pengajuanijin success</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.md5(get_class($model))])
                    ];
                }else{
                    return ['title'=>'error',
                        'content'=>'sisa ijin tidak cukup / jumlah hari yg diajukan salah'
                    ];
                }
            }else{
                return [
                    'title'=> "Create new Pengajuanijin",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Pengajuanijin #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax',
                    'title'=> "Pengajuanijin #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.md5(get_class($model))])
                ];
            }else{
                 return [
                    'title'=> "Update Pengajuanijin #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model=$this->findModel($id);
        $model->delete();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax'];
        }else{
            return $this->redirect(['index']);
        }
    }
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' ));
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable'.md5(get_class($model)).'-pjax'];
        }else{
            return $this->redirect(['index']);
        }
    }
    protected function findModel($id)
    {
        if (($model = Pengajuanijin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
