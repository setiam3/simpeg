<?php

namespace app\controllers;

use Yii;
use app\models\TransaksiPenggajian;
use app\models\TransaksiPenggajianSearch;
use app\models\TransaksipenggajianDetail;
use app\models\PotonganGaji;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\models\VTranspeng;

/**
 * TransaksiPenggajianController implements the CRUD actions for TransaksiPenggajian model.
 */
class TransaksiPenggajianController extends Controller
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
     * Lists all TransaksiPenggajian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransaksiPenggajianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TransaksiPenggajian model.
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
                'title' => "TransaksiPenggajian #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' =>$model,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])
            ];
        } else {
            return $this->render('view', [
                'model' =>$model,
            ]);
        }
    }

    /**
     * Creates a new TransaksiPenggajian model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $transaksipenggajian = new TransaksiPenggajian();
        $transaksipenggajiandetail = new TransaksipenggajianDetail();
        $potongangaji = new PotonganGaji();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new TransaksiPenggajian",
                    'content' => $this->renderAjax('create', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'transaksipenggajiandetail' => $transaksipenggajiandetail,
                        'potongangaji' => $potongangaji
                    ]),

                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($transaksipenggajian->load($request->post())) {
                $transaksipenggajian->attributes = $_POST['TransaksiPenggajian'];
                if ($transaksipenggajian->save(false)) {
                    $transaksipenggajiandetail->attributes = $_POST['TransaksipenggajianDetail'];
                    $transaksipenggajiandetail->transgaji_id = $transaksipenggajian->transgaji_id;
                    $transaksipenggajiandetail->save(false);
                    if ($transaksipenggajiandetail->save(false)) {
                        $potongangaji->attributes = $_POST['PotonganGaji'];
                        $potongangaji->transgaji_id = $transaksipenggajiandetail->transgaji_id;
                        $potongangaji->save(false);
                    }
                }
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new TransaksiPenggajian",
                    'content' => '<span class="text-success">Create TransaksiPenggajian success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])

                ];
            } else {
                return [
                    'title' => "Create new TransaksiPenggajian",
                    'content' => $this->renderAjax('create', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'transaksipenggajiandetail' => $transaksipenggajiandetail,
                        'potongangaji' => $potongangaji
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($transaksipenggajian->load($request->post()) && $transaksipenggajian->save()) {
                return $this->redirect(['view', 'id' => $transaksipenggajian->transgaji_id]);
            } else {
                return $this->render('create', [
                    'transaksipenggajian' => $transaksipenggajian,
                    'transaksipenggajiandetail' => $transaksipenggajiandetail,
                    'potongangaji' => $potongangaji
                ]);
            }
        }
    }

    /**
     * Updates an existing TransaksiPenggajian model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $transaksipenggajian = TransaksiPenggajian::findOne(['transgaji_id' => $id]);
        $transaksipenggajiandetail = TransaksipenggajianDetail::findOne(['transgaji_id' => $transaksipenggajian->transgaji_id]);
        $potongangaji = PotonganGaji::findOne(['transgaji_id' => $transaksipenggajiandetail->transgaji_id]);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update TransaksiPenggajian #" . $id,
                    'content' => $this->renderAjax('update', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'transaksipenggajiandetail' => $transaksipenggajiandetail,
                        'potongangaji' => $potongangaji
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($transaksipenggajian->load($request->post())) {
                $transaksipenggajian->attributes = $_POST['TransaksiPenggajian'];
                if ($transaksipenggajian->save(false)) {
                    $transaksipenggajiandetail->attributes = $_POST['TransaksipenggajianDetail'];
                    $transaksipenggajiandetail->transgaji_id = $transaksipenggajian->transgaji_id;
                    $transaksipenggajiandetail->save(false);
                    if ($transaksipenggajiandetail->save(false)) {
                        $potongangaji->attributes = $_POST['PotonganGaji'];
                        $potongangaji->transgaji_id = $transaksipenggajiandetail->transgaji_id;
                        $potongangaji->save(false);
                    }
                }
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Riwayatpendidikan #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $transaksipenggajian,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote','data-target'=>'#'.md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update TransaksiPenggajian #" . $id,
                    'content' => $this->renderAjax('update', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'transaksipenggajiandetail' => $transaksipenggajiandetail,
                        'potongangaji' => $potongangaji
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($transaksipenggajian->load($request->post()) && $transaksipenggajian->save()) {
                return $this->redirect(['view', 'id' => $transaksipenggajian->transgaji_id]);
            } else {
                return $this->render('update', [
                    'transaksipenggajian' => $transaksipenggajian,
                    'transaksipenggajiandetail' => $transaksipenggajiandetail,
                    'potongangaji' => $potongangaji
                ]);
            }
        }
    }

    /**
     * Delete an existing TransaksiPenggajian model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

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
     * Delete multiple existing TransaksiPenggajian model.
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
     * Finds the TransaksiPenggajian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiPenggajian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransaksiPenggajian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
