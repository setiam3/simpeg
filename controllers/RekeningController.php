<?php

namespace app\controllers;

use Yii;
use app\models\MRekening;
use app\models\MRekeningSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * RekeningController implements the CRUD actions for MRekening model.
 */
class RekeningController extends Controller
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
     * Lists all MRekening models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MRekeningSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MRekening model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "MRekening #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new MRekening model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MRekening();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new MRekening",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'fotoNpwp'))) {
                    $ext = Yii::$app->tools->upload('MRekening[fotoNpwp]', Yii::getAlias('@uploads') . $model->data->nip . '/npwp_' . $model->npwp);
                    $model->fotoNpwp = $ext;
                }
                if (!empty(UploadedFile::getInstance($model, 'fotoRekening'))) {
                    $ext = Yii::$app->tools->upload('MRekening[fotoRekening]', Yii::getAlias('@uploads') . $model->data->nip . '/rek_' . $model->nomor_rekening);
                    $model->fotoRekening = $ext;
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new MRekening",
                    'content' => '<span class="text-success">Create MRekening success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])

                ];
            } else {
                return [
                    'title' => "Create new MRekening",
                    'content' => $this->renderAjax('create', [
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
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing MRekening model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldNpwp = $model->fotoNpwp;
        $oldRekening = $model->fotoRekening;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update MRekening #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if (!empty(UploadedFile::getInstance($model, 'fotoNpwp'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $oldNpwp)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('MRekening[fotoNpwp]', Yii::getAlias('@uploads') . $model->data->nip . '/npwp_' . $model->npwp);
                    $model->fotoNpwp =  $ext;
                } else {
                    $model->fotoNpwp = $oldNpwp;
                }
                if (!empty(UploadedFile::getInstance($model, 'fotoRekening'))) {
                    if (file_exists($filename = Yii::getAlias('@uploads') . $model->data->nip . '/' . $oldRekening)) {
                        unlink($filename);
                    }
                    $ext = Yii::$app->tools->upload('MRekening[fotoRekening]', Yii::getAlias('@uploads') . $model->data->nip . '/rek_' . $model->nomor_rekening);
                    $model->fotoRekening = $ext;
                } else {
                    $model->fotoRekening = $oldRekening;
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "MRekening #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update MRekening #" . $id,
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
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing MRekening model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model=$this->findModel($id);
        if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoNpwp) && !empty($model->fotoNpwp)){
            unlink($filename);
        }
        if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoRekening) && !empty($model->fotoRekening)){
            unlink($filename);
        }
        $model->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing MRekening model.
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
            $model=$this->findModel($pk);
            if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoNpwp) && !empty($model->fotoNpwp)){
                unlink($filename);
            }
            if(file_exists($filename=Yii::getAlias('@uploads').$model->data->nip.'/'.$model->fotoRekening) && !empty($model->fotoRekening)){
                unlink($filename);
            }
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the MRekening model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MRekening the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MRekening::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
