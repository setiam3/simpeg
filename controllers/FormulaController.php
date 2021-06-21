<?php

namespace app\controllers;

use app\models\Formula;
use app\models\MsBobot;
use Yii;
use app\models\MsFormula;
use app\models\MsFormulaSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * FormulaController implements the CRUD actions for MsFormula model.
 */
class FormulaController extends Controller
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
        $searchModel = new MsFormulaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "MsFormula #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MsFormula();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new MsFormula",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post())){
                $skor =0; $pir=Yii::$app->db_remun->createCommand('Select pir from pir')->queryScalar();
                foreach ($_POST['bobot'] as $a){//cari skor
                    $getSkor = json_decode($this->actionFormula())->data;
                    $sk = array_column(ArrayHelper::toArray($getSkor),'skor','id');
                    $score[]=ArrayHelper::getValue($sk,$a);
                }
                $data = [];
                foreach ($_POST['bobot'] as $a){
                    $Mkategory = MsBobot::findOne($a)->kategory;
                    $data[] = ['id_bobot'=>$a,'kategory'=>$Mkategory];
                }

                $model->load($request->post());
                $model->id_bobot = json_encode($data);
                $model->total_score=array_sum($score);
                $model->estimasi=$model->total_score*(float)$pir;
                $model->save();

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new MsFormula",
                    'content'=>'<span class="text-success">Create MsFormula success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Create new MsFormula",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
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

        $data=json_decode($model->id_bobot);

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update MsFormula #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,'kategory'=>$data,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post())){

                $skor =0; $pir=Yii::$app->db_remun->createCommand('Select pir from pir')->queryScalar();
                foreach ($_POST['bobot'] as $a){//cari skor
                    $getSkor = json_decode($this->actionFormula())->data;
                    $sk = array_column(ArrayHelper::toArray($getSkor),'skor','id');
                    $score[]=ArrayHelper::getValue($sk,$a);
                }
                $data = [];
                foreach ($_POST['bobot'] as $a){
                    $Mkategory = MsBobot::findOne($a)->kategory;
                    $data[] = ['id_bobot'=>$a,'kategory'=>$Mkategory];
                }
                $model->load($request->post());
                $model->id_bobot = json_encode($data);
                $model->total_score=array_sum($score);
                $model->estimasi=$model->total_score*(float)$pir;
                $model->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "MsFormula #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Update MsFormula #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,'kategory'=>$data,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,'kategory'=>$data,
                ]);
            }
        }
    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    protected function findModel($id)
    {
        if (($model = MsFormula::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFormula(){
        $sql = "select x.id,x.level,x.uraian,x.nilai_rasio,x.bobot,x.kategory,
if(x.level=1,@coi:=x.cum,round(@coi:=@coi*x.cum,0))as skor
from (
SELECT mb.id,mb.bobot,mb.level,mb.nilai_rasio,mb.uraian,mb.kategory,
COALESCE(p2.p1,skor1.skor)as cum
from ms_bobot mb
left join (
	select mb3.kategory,mb3.level,((SELECT value from setting where param='nilaiterendah')*(mb3.bobot/100))as skor from ms_bobot mb3
)skor1 on skor1.level=mb.level and skor1.kategory=mb.kategory
left join (
	select mb4.kategory,mb4.level,((SELECT mb2.nilai_rasio FROM ms_bobot mb2
        WHERE mb2.level <= mb4.level
        ORDER BY mb2.level DESC LIMIT 1)/
        (SELECT mb1.nilai_rasio FROM ms_bobot mb1
        WHERE mb1.level < mb4.level
        ORDER BY mb1.level DESC LIMIT 1))as p1 from ms_bobot mb4
)p2 on p2.level=mb.level and p2.kategory=mb.kategory
group by mb.kategory,mb.id
)x,(select @coi:=1)i
order by x.id";
        $data['data']=Yii::$app->db_remun->createCommand($sql)->queryAll();
        return json_encode($data);


    }


}
