<?php

namespace app\controllers;

use Yii;
use app\models\Riwayatdiklat;
use app\models\RiwayatdiklatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * RiwayatdiklatController implements the CRUD actions for Riwayatdiklat model.
 */
class RiwayatdiklatController extends Controller
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
     * Lists all Riwayatdiklat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $role=\Yii::$app->tools->getcurrentroleuser();
        if(in_array('karyawan',$role)){
            $where=['id_data'=>\Yii::$app->user->identity->id_data];
        }else{
            $where='';
        }
        $searchModel = new RiwayatdiklatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$where);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Riwayatdiklat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Riwayatdiklat #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $model,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
            ];
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Riwayatdiklat model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Riwayatdiklat();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Riwayatdiklat get",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'klikedid'=>isset($_GET['id'])?$_GET['id']:'',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                    $ext = Yii::$app->tools->upload('Riwayatdiklat[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ridik_' . $model->data->nip);
                    $model->dokumen =  $ext;
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable'.md5(get_class($model)).'-pjax',
                    'title' => "Create new Riwayatdiklat",
                    'content' => '<span class="text-success">Create Riwayatdiklat success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])

                ];
            } else {
                return [
                    'title' => "Create new Riwayatdiklat",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'klikedid'=>isset($_GET['id'])?$_GET['id']:'',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                    $ext = Yii::$app->tools->upload('Riwayatdiklat[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ridik_' . $model->data->nip);
                    $model->dokumen =  $ext;
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Riwayatdiklat model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $olddokumen = $model->dokumen;
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Riwayatdiklat #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $olddokumen)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('Riwayatdiklat[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ridik_' . $model->data->nip);
                    $model->dokumen = $ext;
                } else {
                    $model->dokumen = $olddokumen;
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Riwayatdiklat #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update Riwayatdiklat #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'dokumen'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $olddokumen)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('Riwayatdiklat[dokumen]', Yii::getAlias('@uploads') . $model->data->nip . '/ridik_' . $model->data->nip);
                    $model->dokumen = $ext;
                } else {
                    $model->dokumen = $olddokumen;
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Riwayatdiklat model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->dokumen) && !empty($model->dokumen)) {
            unlink($filename);
        }
        $model->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Riwayatdiklat model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $model->dokumen) && !empty($model->dokumen)) {
                unlink($filename);
            }
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Riwayatdiklat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Riwayatdiklat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Riwayatdiklat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
