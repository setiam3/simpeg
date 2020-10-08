<?php
namespace app\controllers;
use app\models\MBiodata;
use Yii;
use app\models\TransaksiPenggajian;
use app\models\TransaksiPenggajianSearch;
use app\models\TransaksipenggajianDetail;
use app\models\MReferensi;
use app\models\PotonganGaji;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\models\VTranspeng;
class TransaksiPenggajianController extends Controller
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
        $searchModel = new TransaksiPenggajianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $karyawan = MBiodata::find()->all();
        $karyawan = ArrayHelper::map($karyawan, 'id_data', 'nama');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'karyawan' => $karyawan,
        ]);
    }
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "TransaksiPenggajian #" . $id,
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
    public function actionAutonomorgaji(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model=TransaksiPenggajian::find()->select(['nomor_transgaji'])->where(['not',['nomor_transgaji'=>'null']])->orderBy('transgaji_id desc')->one();
        is_object($model)?$getlastjo=$model->nomor_transgaji:$getlastjo=$model;
        $format='GJ';
        if(!empty($getlastjo)){
            $t=trim($getlastjo,$format);
            $lastno=intval($t)+1;
        }else{
            $lastno=1;
        }
            if(strlen($lastno)==1){
                $lastno='000000'.$lastno;
            }elseif(strlen($lastno)==2){
                $lastno='00000'.$lastno;
            }elseif(strlen($lastno)==3){
                $lastno='0000'.$lastno;
            }elseif(strlen($lastno)==4){
                $lastno='000'.$lastno;
            }elseif(strlen($lastno)==5){
                $lastno='00'.$lastno;
            }elseif(strlen($lastno)==6){
                $lastno='0'.$lastno;
            }elseif(strlen($lastno)==7){
                $lastno=$lastno;
            }
        return ['nomor'=>$format.$lastno];
    }
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $transaksipenggajian = new TransaksiPenggajian();
        $potongangaji = new PotonganGaji();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new TransaksiPenggajian",
                    'content' => $this->renderAjax('create', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'potongangaji' => $potongangaji,
                        'klikedid' => isset($_GET['id']) ? $_GET['id'] : '',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($transaksipenggajian->load($request->post())) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $transaksipenggajian->pelaksana_id = \Yii::$app->user->identity->id_data;
                    $transaksipenggajian->save(false);
                    $flag = true;
                    $err=Html::errorSummary($transaksipenggajian);
                    $potongans=$_POST['TransaksiPenggajian']['potong'];
                    if(!empty($potongans) && isset($potongans) && is_array($potongans)){
                        foreach($potongans as $row){
                            $potongangaji=new PotonganGaji();
                            $potongangaji->attributes=$row;
                            $transaksipenggajian->link('potongangajis', $potongangaji);
                            $potongangaji->save(false);
                            if(!($flag=$potongangaji->save())){
                                $transaction->rollBack();
                                $err=Html::errorSummary($potongangaji);
                                break;
                            }
                            $tipereff=new \yii\db\Expression('lower(t.nama_reff_tipe)');
                            $namereff=new \yii\db\Expression('lower(nama_referensi)');
                            $reff=MReferensi::find()->joinWith('tipeReferensi as t')->where(['like',$tipereff,'potongan'])->andWhere(['like',$namereff,strtolower($row['potongan_desc'])])->one();
                            is_object($reff)?$ref=$reff->nama_referensi:$ref=$reff;
                            if(empty($ref)){//insert to ref jenis potongan 13
                                $modelref=new MReferensi;
                                $modelref->nama_referensi=$row['potongan_desc'];
                                $modelref->tipe_referensi=13;
                                $modelref->status=1;
                                $modelref->save(false);
                            }
                        }
                    }
                    if(!$flag){
                        return ['title'=> "eror",'content'=>$err];
                    }else{
                        $transaction->commit();
                        return [
                            'forceReload' => '#crud-datatable' . md5(get_class($transaksipenggajian)) . '-pjax',
                            'title' => "Create new TransaksiPenggajian",
                            'content' => '<span class="text-success">Create TransaksiPenggajian success</span>',
                            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                                Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($transaksipenggajian))])
                        ];
                    }
                }catch (Exception $e) {
                    $transaction->rollBack();
                    return ['title'=> "eror",'content'=>$err];
                }
            } else {
                return [
                    'title' => "Create new TransaksiPenggajian",
                    'content' => $this->renderAjax('create', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'potongangaji' => $potongangaji,
                        'klikedid' => isset($_GET['id']) ? $_GET['id'] : '',
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($transaksipenggajian->load($request->post())) {
                try {
                    $transaksipenggajian->pelaksana_id = \Yii::$app->user->identity->id_data;
                    $transaksipenggajian->save(false);
                    $flag = true;
                    $err=Html::errorSummary($transaksipenggajian);
                    $potongans=$_POST['TransaksiPenggajian']['potong'];
                    if(!empty($potongans) && isset($potongans) && is_array($potongans)){
                        foreach($potongans as $row){
                            $potongangaji=new PotonganGaji();
                            $potongangaji->attributes=$row;
                            $transaksipenggajian->link('potongangajis', $potongangaji);
                            $potongangaji->save(false);
                            if(!($flag=$potongangaji->save())){
                                $transaction->rollBack();
                                $err=Html::errorSummary($potongangaji);
                                break;
                            }
                            $tipereff=new \yii\db\Expression('lower(t.nama_reff_tipe)');
                            $namereff=new \yii\db\Expression('lower(nama_referensi)');
                            $reff=MReferensi::find()->joinWith('tipeReferensi as t')->where(['like',$tipereff,'potongan'])->andWhere(['like',$namereff,strtolower($row['potongan_desc'])])->one();
                            is_object($reff)?$ref=$reff->nama_referensi:$ref=$reff;
                            if(empty($ref)){
                                $modelref=new MReferensi;
                                $modelref->nama_referensi=$row['potongan_desc'];
                                $modelref->tipe_referensi=13;
                                $modelref->status=1;
                                $modelref->save(false);
                            }
                        }
                    }
                    if(!$flag){
                        return $this->render('create', [
                            'transaksipenggajian' => $transaksipenggajian,
                            'potongangaji' => $potongangaji
                        ]);
                    }else{
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $transaksipenggajian->transgaji_id]);
                    }
                }catch (Exception $e) {
                    $transaction->rollBack();
                    return $this->render('create', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'potongangaji' => $potongangaji
                    ]);
                }
            } else {
                return $this->render('create', [
                    'transaksipenggajian' => $transaksipenggajian,
                    'potongangaji' => $potongangaji
                ]);
            }
        }
    }
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $transaksipenggajian = TransaksiPenggajian::findOne(['transgaji_id' => $id]);
        $potongangaji = PotonganGaji::find()->where(['transgaji_id' => $transaksipenggajian->transgaji_id])->all();
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update TransaksiPenggajian #" . $id,
                    'content' => $this->renderAjax('update', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'potongangaji' => $potongangaji
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } elseif ($transaksipenggajian->load($request->post())) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $transaksipenggajian->pelaksana_id = \Yii::$app->user->identity->id_data;
                    $transaksipenggajian->save(false);
                    $flag = true;
                    $err=Html::errorSummary($transaksipenggajian);
                    $potongans=$_POST['TransaksiPenggajian']['potong'];
                    if(!empty($potongans) && isset($potongans) && is_array($potongans)){
                        if(($allpotongan=ArrayHelper::map(PotonganGaji::findAll(['transgaji_id'=>$transaksipenggajian->transgaji_id]),'potongan_id','potongan_id'))!==null){
                            $key=ArrayHelper::map($potongans,'potongan_id','potongan_id');
                            if(($diff=array_diff_key($allpotongan,$key))!==null){
                                if(!(PotonganGaji::deleteAll(['and', 'transgaji_id = :member', ['in', 'potongan_id', $diff]], [':member' =>$transaksipenggajian->transgaji_id]))){
                                    //PotonganGaji::updateAll(['aktif'=>'0'],['in','potongan_id',$diff]);//soft delete
                                }
                            }
                            foreach($potongans as $i=>$kid){
                                if(array_key_exists($kid['potongan_id'],$allpotongan)){//update
                                    if (($pots = PotonganGaji::findOne($kid['potongan_id'])) !== null) {//on exist update
                                        $pots->attributes=$kid;
                                        $pots->save();
                                        }
                                }else{//insert new
                                    $pots=new PotonganGaji();
                                    $pots->attributes=$kid;
                                    $transaksipenggajian->link('potongangajiss', $pots);
                                    $pots->save();

                                    $tipereff=new \yii\db\Expression('lower(t.nama_reff_tipe)');
                                    $namereff=new \yii\db\Expression('lower(nama_referensi)');
                                    $reff=MReferensi::find()->joinWith('tipeReferensi as t')->where(['like',$tipereff,'potongan'])->andWhere(['like',$namereff,strtolower($kid['potongan_desc'])])->one();
                                    is_object($reff)?$ref=$reff->nama_referensi:$ref=$reff;
                                    if(empty($ref)){//insert to ref jenis potongan 13
                                        $modelref=new MReferensi;
                                        $modelref->nama_referensi=$kid['potongan_desc'];
                                        $modelref->tipe_referensi=13;
                                        $modelref->status=1;
                                        $modelref->save(false);
                                    }
                                    if(!($flag=$pots->save())){
                                        $transaction->rollBack();
                                        $err=Html::errorSummary($pots);
                                        break;
                                    }
                                }
                            }
                        }else{
                            foreach(array_keys($potongans) as $kid){//insert new
                                $pots=new PotonganGaji();
                                $pots->attributes=$potongans[$kid];
                                $transaksipenggajian->link('potongangajiss', $pots);
                                $pots->save();

                                $tipereff=new \yii\db\Expression('lower(t.nama_reff_tipe)');
                                $namereff=new \yii\db\Expression('lower(nama_referensi)');
                                $reff=MReferensi::find()->joinWith('tipeReferensi as t')->where(['like',$tipereff,'potongan'])->andWhere(['like',$namereff,strtolower($kid['potongan_desc'])])->one();
                                is_object($reff)?$ref=$reff->nama_referensi:$ref=$reff;
                                if(empty($ref)){//insert to ref jenis potongan 13
                                    $modelref=new MReferensi;
                                    $modelref->nama_referensi=$kid['potongan_desc'];
                                    $modelref->tipe_referensi=13;
                                    $modelref->status=1;
                                    $modelref->save(false);
                                }

                                if(!($flag=$pots->save())){
                                    $transaction->rollBack();
                                    $err=Html::errorSummary($pots);
                                    break;
                                }
                            }
                        }

                    }
                    if(!$flag){
                        return ['title'=> "eror",'content'=>$err];
                    }else{
                        $transaction->commit();
                        return [
                            'forceReload' => '#crud-datatable' . md5(get_class($transaksipenggajian)) . '-pjax',
                            'title' => "Create new TransaksiPenggajian",
                            'content' => '<span class="text-success">Create TransaksiPenggajian success</span>',
                            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                                Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote', 'data-target' => '#' . md5(get_class($transaksipenggajian))])
                        ];
                    }
                }catch (Exception $e) {
                    $transaction->rollBack();
                    return ['title'=> "eror",'content'=>$err];
                }
            } else {
                return [
                    'title' => "Update TransaksiPenggajian #" . $id,
                    'content' => $this->renderAjax('update', [
                        'transaksipenggajian' => $transaksipenggajian,
                        'potongangaji' => $potongangaji
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            if ($transaksipenggajian->load($request->post()) && $transaksipenggajian->save()) {
                return $this->redirect(['view', 'id' => $transaksipenggajian->transgaji_id]);
            } else {
                return $this->render('update', [
                    'transaksipenggajian' => $transaksipenggajian,
                    'potongangaji' => $potongangaji
                ]);
            }
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
    protected function findModel($id)
    {
        if (($model = TransaksiPenggajian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
