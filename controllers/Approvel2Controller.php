<?php

namespace app\controllers;

use app\models\Jatahcuti;
use Yii;
use app\models\Pengajuanijin;
use app\models\Approvel2Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class Approvel2Controller extends Controller
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
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (ArrayHelper::keyExists('approval2', $role)) {
            $where = 'approval1 != 0 and approval2 IS NULL ';
        } else {
            $where = 'disetujui IS NULL';
        }
        $searchModel = new Approvel2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $where);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Pengajuanijin #" . $id,
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
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Pengajuanijin();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Pengajuanijin",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Create new Pengajuanijin",
                    'content' => '<span class="text-success">Create Pengajuanijin success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Create new Pengajuanijin",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
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
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet && $model == "null") {
                return [
                    'title' => "Update Pengajuanijin #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                if ($model->approval2 == 1) {
                    $model->approval2 = \Yii::$app->user->identity->id_data;
                    $model->disetujui = "1";
                    $holidays =(!$model->shift)?ArrayHelper::map(\app\models\Hariliburnasional::find()->all(), 'tanggal', 'tanggal'):[];
                    $diajukan = Yii::$app->tools->getWorkingDays($model->tanggalMulai, $model->tanggalAkhir, $holidays);
                    $sisa = Jatahcuti::find()->where(['id_data' => $model->id_data])->one();
                    if ($sisa !== null && $sisa->sisa >= $diajukan) {
                        $sisa->sisa -= $diajukan;
                        $sisa->save(false);
                    } else {
                        return [
                            'title' => 'error',
                            'content' => 'sisa ijin tidak cukup / jumlah hari yg diajukan salah'
                        ];
                    }
                } elseif ($model->approval2 == 0) {
                    $model->approval2 = \Yii::$app->user->identity->id_data;
                    $model->disetujui = "0";
                }
                $model->save(false);
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Pengajuanijin #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
                    //.Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($model))])
                ];
            } else {
                return [
                    'title' => "Update Pengajuanijin #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            // if ($model->load($request->post()) && $model->save()) {
            //     return $this->redirect(['view', 'id' => $model->id]);
            // } else {
            //     return $this->render('update', [
            //         'model' => $model,
            //     ]);
            // }
        }
    }
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->delete();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks'));
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionAccizin()
    {
        $request = Yii::$app->request;
        $model = new Pengajuanijin();
        $pks = explode(',', $request->post('pks'));
        $selection = implode(',',$pks);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                print_r('fom1');die();
                return [
                    'title' => "Create new Pengajuanijin",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {
                $ids = explode(',',$request->post('selection'));
                if($model->approval2 == 1){
                    foreach ($ids as $row) {
                        $model = Pengajuanijin::findOne($row);
                        $model->approval2 = \Yii::$app->user->identity->id_data;
                        $model->disetujui = "1";
                        $model->keterangan = $request->post('keterangan');
                        $holidays =(!$model->shift)?ArrayHelper::map(\app\models\Hariliburnasional::find()->all(), 'tanggal', 'tanggal'):[];
                        $diajukan = Yii::$app->tools->getWorkingDays($model->tanggalMulai, $model->tanggalAkhir, $holidays);
                        $sisa = Jatahcuti::find()->where(['id_data' => $model->id_data])->one();
                        if ($sisa !== null && $sisa->sisa >= $diajukan) {
                            $sisa->sisa-=$diajukan;
                            $sisa->save(false);
                        } else {
                            return [
                                'title' => 'error',
                                'content' => 'sisa ijin tidak cukup / jumlah hari yg diajukan salah'
                            ];
                        }
                        $model->save(false);
                    }
                }elseif($model->approval2 == 0){
                    foreach ($ids as $row) {
                        $model = Pengajuanijin::findOne($row);
                        $model->approval2 = \Yii::$app->user->identity->id_data;
                        $model->disetujui = "0";
                        $model->keterangan = $request->post('keterangan');
                        $model->save(false);
                    }
                }
                return [
                    'forceReload' => '#crud-datatable' . md5(get_class($model)) . '-pjax',
                    'title' => "Create new Pengajuanijin",
                    'content' => '<span class="text-success">Create Pengajuanijin success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
                ];
            } else {
                return [
                    'title' => "Create new Pengajuanijin",
                    'content' => $this->renderAjax('accizin', [
                        'model' => $model,'selection'=>$selection
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
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
