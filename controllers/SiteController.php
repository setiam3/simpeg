<?php

namespace app\controllers;

use app\models\Jatahcuti;
use app\models\MBiodata;
use app\models\MKepangkatan;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }
    public function actionPhpinfo()
    {
        phpinfo();
    }
    public function actionPdftoimg($pathfile)
    {
        $preview = '';
        $ext = pathinfo($pathfile);
        $image = ['jpg', 'jpeg', 'png'];

        if ($ext['extension'] == 'pdf') {
            $this->genPdfThumbnail($pathfile, $ext['basename'] . '.jpeg');
            $preview = \Yii::getAlias('@web/uploads/foto/510204244/') . $ext['basename'] . '.jpeg';
        } elseif (in_array(strtolower($ext['extension']), $image)) {
            //$preview=Yii::getAlias('@urlUpload').$model->cv;
        } else {
            $preview = '';
        }
        return $preview;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionChild($model)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = $model == 'Kecamatan' ? $this->findModelAll(['regency_id' => $id], $model) : $this->findModelAll(['district_id' => $id], $model);
            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['name']];
                    if ($i == 0) {
                        $selected = $account['id'];
                    }
                }
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionSisaijin($id)
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Jatahcuti::findOne(['id_data' => $id]);
        return [$model->sisa];

    }

    public function actiontunjangan($model)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = $model == 'Kecamatan' ? $this->findModelAll(['regency_id' => $id], $model) : $this->findModelAll(['district_id' => $id], $model);
            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['name']];
                    if ($i == 0) {
                        $selected = $account['id'];
                    }
                }
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionSwitch($id)
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Jatahcuti::findOne(['id_data' => $id]);
        return [$model->sisa];

    }

    protected function findModel($id, $models)
    {
        $modelx = Yii::createObject([
            'class' => "app\models\\" . $models,
        ]);
        if (($model = $modelx::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelAll($id, $models)
    {
        $modelx = Yii::createObject([
            'class' => "app\models\\" . $models,
        ]);
        if (($model = $modelx::findAll($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionNotifdoc(){
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $where = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $where = '';
        }

        $sql = MBiodata::find()
            ->Join('join', 'm_rekening as r','m_biodata.id_data = r.id_data')
            ->joinWith('riwayatdiklats as d')
            ->joinWith('riwayatjabatans as j')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('kepangkatans as k')
            ->where(['is_pegawai' => '1'])
            ->where($where)
            ->distinct('id_data')
            ->count();
        return $sql;
    }

    public function actionLisnotifdoc(){
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $where = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $where = '';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sql = MBiodata::find()
            ->select([
                'm_biodata.id_data',
                'r.id as id_rekening',
                'fotoNik',
                'foto',
                'r.fotoRekening',
                'p.dokumen as dokumen_pendidikan',
                'j.dokumen as dokumen_jabatan',
                'd.dokumen as dokumen_diklat',
                'k.dokumen as dokumen_kepangkatan'])
            ->Join('join', 'm_rekening as r','m_biodata.id_data = r.id_data')
            ->joinWith('riwayatdiklats as d')
            ->joinWith('riwayatjabatans as j')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('kepangkatans as k')
            ->where(['is_pegawai' => '1'])
            ->where($where)
            ->all();
        return [$sql];
    }



    public function actionLisnotifdok(){
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $where = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $where = '';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sql = MBiodata::find()
            ->select([
                'm_biodata.id_data',
                'm_biodata.nama as nama',
                'r.id as id_rekening',
                'fotoNik',
                'foto',
                'r.fotoRekening',
                'p.dokumen as fotoRekening',
                'j.dokumen as dokumen_jabatan',
                'd.dokumen as dokumen_diklat',
                'k.dokumen as dokumen_kepangkatan'])
            ->Join('join', 'm_rekening as r','m_biodata.id_data = r.id_data')
            ->joinWith('riwayatdiklats as d')
            ->joinWith('riwayatjabatans as j')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('kepangkatans as k')
            ->where(['is_pegawai' => '1'])
            ->where($where)
//                ->groupBy('m_biodata.id_data')
            ->all();

        if (!empty($sql)){
            foreach ($sql as $row){
//                echo (empty($row['fotoNik']))?'<li>'..'</li>':'';
                $list []= (empty($row['fotoNik']))?'<li><a href="">'.$row['nama'].'foto NIK belum diupload</a></li>':'';
                $list []= (empty($row['foto']))?'<li><a href="'.Yii::$app->homeUrl.'/biodata/update?id='.$row['id_data'].'">foto belum diupload</a></li>':'';
                $list []= (empty($row['fotoRekening']))?'<li><a href="#">foto rekening belum diupload</a></li>':'';
                $list []= (empty($row['dokumen_jabatan']))?'<li><a href="#">foto jabatan belum diupload</a></li>':'';
                $list []= (empty($row['dokumen_diklat']))?'<li><a href="#">foto diklat belum diupload</a></li>':'';
                $list []= (empty($row['dokumen_kepangkatan']))?'<li><a href="#">kepangkatan belum diupload</a></li>':'';


            }
        }
        else{
            $list = '<li><a href="#">data tidak ada</a></li>';
        }

        return $list;
    }

    public function actionNotifgaji(){
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $whereid = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $whereid = '';
        }
        $where = new Expression('MOD((EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "tmt"))::INTEGER, 2)');
       $gaji = MKepangkatan::find()
       ->joinWith('data')
       ->where(['=',$where,'0'])
       ->andwhere($whereid)
       ->count();
      return $gaji;
    }

    public function actionListgaji(){
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $whereid = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $whereid = '';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $where = new Expression('MOD((EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "tmt"))::INTEGER, 2)');
        $gaji = MKepangkatan::find()
            ->joinWith('data')
            ->where(['=',$where,'0'])
            ->andWhere($whereid)
            ->all();
        if (!empty($gaji)){
            foreach ($gaji as $row){
                $list[] = '<li><a href="#">'.$row->data->nama.'</a></li>';
            }
        }else{
            $list = '<li><a href="#">data tidak ada</a></li>';
        }
        return $list;
    }

    public function actionKenaikanpangkat(){
//        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $whereid = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $whereid = '';
        }
        $where = new Expression('MOD((EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "kepangkatan"."tmtPangkat"))::INTEGER, 4) = 0');
        $wherecon = new Expression('EXTRACT(YEAR FROM "kepangkatan"."tmtPangkat") < EXTRACT(YEAR FROM NOW())');
        $gaji = MBiodata::find()
            ->join('join','kepangkatan','m_biodata.id_data = kepangkatan.id_data')
            ->join('join','penggolongangaji','kepangkatan.penggolongangaji_id = penggolongangaji.id')
            ->join('join','m_referensi','penggolongangaji.pangkat_id = m_referensi.reff_id')
            ->andWhere(['is_pegawai' => '1'])
            ->andWhere(['m_referensi.tipe_referensi' => '6'])
            ->andWhere($where)
            ->andWhere($wherecon)
            ->andWhere($whereid)
            ->count();

        return $gaji;
    }

    public function actionLisenaikanpangkat(){
       Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $whereid = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $whereid = '';
        }
        $where = new Expression('MOD((EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "kepangkatan"."tmtPangkat"))::INTEGER, 4) = 0');
        $wherecon = new Expression('EXTRACT(YEAR FROM "kepangkatan"."tmtPangkat") < EXTRACT(YEAR FROM NOW())');
        $gaji = MBiodata::find()
            ->join('join','kepangkatan','m_biodata.id_data = kepangkatan.id_data')
            ->join('join','penggolongangaji','kepangkatan.penggolongangaji_id = penggolongangaji.id')
            ->join('join','m_referensi','penggolongangaji.pangkat_id = m_referensi.reff_id')
            ->andWhere(['is_pegawai' => '1'])
            ->andWhere(['m_referensi.tipe_referensi' => '6'])
            ->andWhere($where)
            ->andWhere($wherecon)
            ->andWhere($whereid)
            ->all();

            if (!empty($gaji)){
                foreach ($gaji as $row){
                    $list[] = '<li><a href="#">'.$row['nama'].'</a></li>';
                }
            }else{
                $list = '<li><a href="#">data tidak ada</a></li>';
            }
    return $list;

    }
}
