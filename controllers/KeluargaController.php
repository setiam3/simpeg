<?php

namespace app\controllers;

use Yii;
use app\models\MBiodata;
use app\models\MKeluargaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
/**
 * KeluargaController implements the CRUD actions for MBiodata model.
 */
class KeluargaController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all MBiodata models.
     * @return mixed
     */
    public function actionIndex()
    {
        $role=\Yii::$app->tools->getcurrentroleuser();
        if(in_array('karyawan',$role)){
            $where=['parent_id'=>\Yii::$app->user->identity->id_data];
        }else{
            $where='';
        }
        $searchModel = new MKeluargaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MBiodata model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Data Keluarga #".$id,
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

    /**
     * Creates a new MBiodata model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MBiodata();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Data Keluarga",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) ){
                $model->is_pegawai=0;
                if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                    $ext=Yii::$app->tools->upload('MBiodata[foto]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$foto='foto_'.$model->status_hubungan_keluarga.'_'.$model->parent_id);
                    $model->foto=$ext;
                }
                if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                    $ext=Yii::$app->tools->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$fotoNik='fotoNik_'.$model->status_hubungan_keluarga.'_'.$model->nik);
                    $model->fotoNik=$ext;
                }
                $model->save(false);
                return [
<<<<<<< HEAD
                    'forceReload'=>'#crud-datatable-pjax'),
=======
                    'forceReload'=>'#datatable'.md5(get_class($model)).'-pjax',
>>>>>>> 615d336badf3980a6244b12b00f29def154312cc
                    'title'=> "Data Keluarga",
                    'content'=>'<span class="text-success">Create Data Keluarga success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.md5(get_class($model))])

                ];
            }else{
                return [
                    'title'=> "Data Keluarga",
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
            if ($model->load($request->post()) ) {
                $model->is_pegawai=0;
                if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                    $ext=Yii::$app->tools->upload('MBiodata[foto]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$foto='foto_'.$model->status_hubungan_keluarga.'_'.$model->parent_id);
                    $model->foto=$ext;
                }
                if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                    $ext=Yii::$app->tools->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$fotoNik='fotoNik_'.$model->status_hubungan_keluarga.'_'.$model->nik);
                    $model->fotoNik=$ext;
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id_data]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing MBiodata model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldFoto=$model->foto;
        $oldFotoNik=$model->fotoNik;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Data Keluarga #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if( $model->load($request->post()) ){
                $model->is_pegawai=0;
                if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                    if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$oldFoto) && !empty($oldFoto)){
                        unlink($filename);
                    }
                    $ext=Yii::$app->tools->upload('MBiodata[foto]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$foto='foto_'.$model->status_hubungan_keluarga.'_'.$model->parent_id);
                    $model->foto=$ext;
                }
                if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                    if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$oldFotoNik) && !empty($oldFotoNik)){
                        unlink($filename);
                    }
                    $ext=Yii::$app->tools->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$fotoNik='fotoNik_'.$model->status_hubungan_keluarga.'_'.$model->nik);
                    $model->fotoNik=$ext;
                }
                $model->save(false);
                return [
                    'forceReload'=>'#datatable'.md5(get_class($model)).'-pjax',
                    'title'=> "Data Keluarga #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.md5(get_class($model))])
                ];
            }else{
                 return [
                    'title'=> "Update Data Keluarga #".$id,
                    'content'=>$this->renderAjax('update', [
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
            if ($model->load($request->post()) ) {
                if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                    if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$oldFoto) && !empty($oldFoto)){
                        unlink($filename);
                    }
                    $ext=Yii::$app->tools->upload('MBiodata[foto]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$foto='foto_'.$model->status_hubungan_keluarga.'_'.$model->parent_id);
                    $model->foto=$ext;
                }
                if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                    if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$oldFotoNik) && !empty($oldFotoNik)){
                        unlink($filename);
                    }
                    $ext=Yii::$app->tools->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$model->parent->nip.'/'.$fotoNik='fotoNik_'.$model->status_hubungan_keluarga.'_'.$model->nik);
                    $model->fotoNik=$ext;
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id_data]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing MBiodata model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model=$this->findModel($id);
        if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$model->foto) && !empty($model->foto)){
            unlink($filename);
        }
        if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$model->fotoNik) && !empty($model->fotoNik)){
            unlink($filename);
        }
        $model->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#datatable'.md5(get_class($model)).'-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing MBiodata model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$model->foto) && !empty($model->foto)){
                unlink($filename);
            }
            if(file_exists($filename=Yii::getAlias('@uploads').$model->parent->nip.'/'.$model->fotoNik) && !empty($model->fotoNik)){
                unlink($filename);
            }
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#datatable'.md5(get_class($model))];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the MBiodata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MBiodata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MBiodata::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
