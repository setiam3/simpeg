<?php
namespace app\controllers;//lokasi files
use Yii; //use panggil library
use app\models\VPegawai;
use app\models\PegawaiSearch;
use app\models\MPegawai;
use app\models\MKeluarga;
use app\models\MBiodata;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use \yii\web\Response;

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
    public function actionInfo($id){
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('infopegawai',[
            'model'=>$this->findModel(['nip'=>$id],'VPegawai'),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id){
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "MPegawai #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel(['nip'=>$id],'VPegawai'),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view',[
                'model'=>$this->findModel(['id'=>$id],'VPegawai'),
            ]);
        }
    }
    public function actionCreate(){
        $mpegawai=new MPegawai;
        $mbiodata=new MBiodata;
        if(Yii::$app->request->post()){
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $mbiodata->attributes=$_POST['MBiodata'];
              if ($mbiodata->save(false)) {
                $mpegawai->attributes=$_POST['MPegawai'];
                $mpegawai->fk_biodata=$mbiodata->id;
                if($mpegawai->save(false)){
                    if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                        $ext=$this->upload('MBiodata[foto]',Yii::getAlias('@uploads').$mpegawai->nip);
                        $biodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
                        $biodata->foto=$mpegawai->nip.'.'.$ext;
                        $biodata->save();
                    }
                    if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                        $ext=$this->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$mbiodata->nik);
                        $biodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
                        $biodata->fotoNik=$mbiodata->nik.'.'.$ext;
                        $biodata->save();
                    }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success',' data berhasil disimpan');
                    return $this->redirect(['index']);
                }

              }
              $transaction->rollBack();
            } catch (\Exception $ecx) {
              $transaction->rollBack();
              throw $ecx;
            }
        }
        return $this->render('create',[
            'mpegawai'=>$mpegawai,
            'mbiodata'=>$mbiodata
        ]);
    }

    public function actionUpdate($id){
        $mpegawai=MPegawai::findOne(['nip'=>$id]);//cari nip = id. select * from mpegawai where nip=id
        $mbiodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
        $lastfoto=$mbiodata->foto;
        $lastfotoNik=$mbiodata->fotoNik;
        if(Yii::$app->request->post()){
            $mbiodata->attributes=$_POST['MBiodata'];//ambil semua attribute 
            $mbiodata->foto=$lastfoto;
            $mbiodata->fotoNik=$lastfotoNik;
            if($mbiodata->save(false)){//tanpa validasi
                $mpegawai->attributes=$_POST['MPegawai'];
                $mpegawai->fk_biodata=$mbiodata->id;
                if($mpegawai->save(false)){
                    if(!empty(UploadedFile::getInstanceByName('MBiodata[foto]'))){
                        if(file_exists($filename=Yii::getAlias('@uploads').$lastfoto)){
                            unlink($filename);
                         }
                        $ext=$this->upload('MBiodata[foto]',Yii::getAlias('@uploads').$mpegawai->nip);
                        $biodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
                        $biodata->foto=$mpegawai->nip.'.'.$ext;
                        $biodata->save(false);
                    }
                    if(!empty(UploadedFile::getInstanceByName('MBiodata[fotoNik]'))){
                        if(file_exists($filename=Yii::getAlias('@uploads').$lastfoto)){
                            unlink($filename);
                         }
                        $ext=$this->upload('MBiodata[fotoNik]',Yii::getAlias('@uploads').$mbiodata->nik);
                        $biodata=MBiodata::findOne(['id'=>$mpegawai->fk_biodata]);
                        $biodata->fotoNik=$mbiodata->nik.'.'.$ext;
                        $biodata->save(false);
                    }
                    Yii::$app->session->setFlash('success',' data berhasil diupdate');
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
        $mbiodata=MBiodata::findOne(['id'=>$id]);
        $filename=Yii::getAlias('@uploads').$mbiodata->foto;
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
