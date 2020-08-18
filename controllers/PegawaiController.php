<?php
namespace app\controllers;
use Yii;
use app\models\VPegawai;
use app\models\PegawaiSearch;
use app\models\MPegawai;
use app\models\MKeluarga;
use app\models\MBiodata;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PegawaiController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex(){
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id){
        return $this->render('view',['model'=>$this->findModel(['nip'=>$id],'VPegawai')]);
    }
    public function actionCreate(){
        $mpegawai=new MPegawai;
        $mbiodata=new MBiodata;
        if(Yii::$app->request->post()){
            $mbiodata->attributes=$_POST['MBiodata'];
            if($mbiodata->save(false)){
                $mpegawai->attributes=$_POST['MPegawai'];
                $mpegawai->fk_biodata=$mbiodata->id;
                if($mpegawai->save(false)){
                    if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                        $ext=$this->upload('MBiodata[foto]',realpath(Yii::$app->basePath).'/web/uploads/foto/'.$mpegawai->nip);
                        $biodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
                        $biodata->foto=$mpegawai->nip.'.'.$ext;
                        $biodata->save(false);
                    }
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('create',[
            'mpegawai'=>$mpegawai,
            'mbiodata'=>$mbiodata
        ]);
    }
    public function actionUpdate($id){
        $mpegawai=MPegawai::findOne(['nip'=>$id]);
        $mbiodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
        $lastfoto=$mbiodata->foto;
        if(Yii::$app->request->post()){
            $mbiodata->attributes=$_POST['MBiodata'];
            $mbiodata->foto=$lastfoto;
            if($mbiodata->save(false)){
                $mpegawai->attributes=$_POST['MPegawai'];
                $mpegawai->fk_biodata=$mbiodata->id;
                if($mpegawai->save(false)){
                    if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                        $ext=$this->upload('MBiodata[foto]',realpath(Yii::$app->basePath).'/web/uploads/foto/'.$mpegawai->nip);
                        $biodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
                        $biodata->foto=$mpegawai->nip.'.'.$ext;
                        $biodata->save(false);
                    }
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('update', [
            'mpegawai'=>$mpegawai,
            'mbiodata'=>$mbiodata
        ]);
    }
    public function actionAddkeluarga(){
        $mbiodata=new MBiodata;
        $mpegawai=$this->findModel($id);
        if(Yii::$app->request->post()){

        }
        return $this->render('frm_keluarga',['mpegawai'=>$mpegawai,'mbiodata'=>$mbiodata]);
    }
    public function upload($instancename,$path){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $file=UploadedFile::getInstanceByName($instancename);
            $ext=substr($file->name, strrpos($file->name, '.')+1);
            $file->saveAs($path.'.'.$ext);
            return $ext;
    }
    public function actionDelete($id){
        $mpegawai=MPegawai::findOne(['nip'=>$id]);
        $mpegawai->delete();
        $mbiodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
        $filename=realpath(Yii::$app->basePath).'/web/uploads/foto/'.$mbiodata->foto;
        if(!empty($mbiodata->foto)){
            if(file_exists($filename)){
               unlink($filename);
            }
        }
        $mbiodata->delete();
        return $this->redirect(['index']);
    }
    protected function findModel($id,$models){
        $modelx=Yii::createObject([
          'class' => "app\models\\".$models,
         ]);
        if (($model = $modelx::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
