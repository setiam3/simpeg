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

    public function actionIndex()
    {
        return $this->render('index');
    }
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
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
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
        if(($model)!==null){
            return [$model->sisa];
        }else{
            return ['0'];
        }
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
    public function actionNotifdoc()
    {
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $where = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $where = '';
        }
        $sql = MBiodata::find()
            ->Join('join', 'm_rekening as r', 'm_biodata.id_data = r.id_data')
            ->joinWith('riwayatdiklats as d')
            ->joinWith('riwayatjabatans as j')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('riwayatpendidikans as p')
            ->joinWith('kepangkatans as k')
            ->where(['is_pegawai' => '1'])
            ->andwhere($where)
            ->count();
        return $sql;
    }

    public function actionLisnotifdok(){
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $where = ['mb.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $where = '';
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = new Query;
        $query->from('m_biodata as mb')
            ->select(['mb.id_data','nama','fotoNik','foto',
                'mr.id as idrekening','mr.fotoRekening',
                'rd.id as iddiklat','rd.dokumen as dokumen_diklat',
                'rj.id as idjabatan','rj.dokumen as dokumen_jabatan',
                'rp.id as idpendidikan','rp.dokumen as dokumen_pendidikan',
                'k.id as idkepangkatan','k.dokumen as dokumen_kepangkatan'])
            ->join('join','m_rekening as mr','mb.id_data = mr.id_data ')
            ->join('left join','riwayatdiklat as rd','mb.id_data = rd.id_data')
            ->join('left join','riwayatjabatan as rj','mb.id_data = rj.id_data')
            ->join('left join','riwayatpendidikan as rp','mb.id_data = rp.id_data')
            ->join('left join','kepangkatan as k','mb.id_data = k.id_data')
            ->where(['=','mb.is_pegawai','1'])
            ->andWhere($where)
            ->distinct
        ;
        $command = $query->createCommand();
        $dok = $command->queryAll();

        if (!empty($dok)){
            foreach ($dok as $row){
                $list []= (!empty($row['id_data']) && empty($row['fotoNik']))?'<li><a href="'.Yii::$app->homeUrl.'biodata/update?id='.$row['id_data'].'">'.$row['nama'].' foto NIK belum diupload</a></li>':'';
                $list []= (empty($row['foto']))?'<li><a href="'.Yii::$app->homeUrl.'biodata/update?id='.$row['id_data'].'">'.$row['nama'].' foto belum diupload</a></li>':'';
                $list []= (empty($row['fotoRekening']) && empty($row['id_rekening']))?'<li><a href="'.Yii::$app->homeUrl.'rekening/update?id='.$row['idrekening'].'">'.$row['nama'].' foto rekening belum diupload</a></li>':'';
                $list []= (empty($row['dokumen_jabatan']) && !empty($row['rj.id']))?'<li><a href="'.Yii::$app->homeUrl.'riwayatjabatan/update?id='.$row['idjabatan'].'">'.$row['nama'].' foto jabatan belum diupload</a></li>':'';
                $list []= (empty($row['dokumen_diklat']) && !empty($row['rd.id']))?'<li><a href="'.Yii::$app->homeUrl.'riwayatdiklat/update?id='.$row['iddiklat'].'">'.$row['nama'].' foto diklat belum diupload</a></li>':'';
                $list []= (empty($row['dokumen_kepangkatan']) && !empty($row['k.id']))?'<li><a href="'.Yii::$app->homeUrl.'riwayatdiklat/update?id='.$row['idkepangkatan'].'">'.$row['nama'].' kepangkatan belum diupload</a></li>':'';
                $list []= (empty($row['dokumen_pendidikan']) && !empty($row['rp.id']))?'<li><a href="'.Yii::$app->homeUrl.'riwayatpendidikan/update?id='.$row['idpendidikan'].'">'.$row['nama'].' kepangkatan belum diupload</a></li>':'';

            }
        } else {
            $list = '<li><a href="#">data tidak ada</a></li>';
        }
        return $list;
    }
    public function actionNotifgaji()
    {
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $whereid = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $whereid = '';
        }
        $where = new Expression('MOD((EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "tmt"))::INTEGER, 2)');
        $gaji = MKepangkatan::find()
            ->joinWith('data')
            ->where(['=', $where, '0'])
            ->andwhere($whereid)
            ->count();
        return $gaji;
    }
    public function actionListgaji()
    {
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
            ->where(['=', $where, '0'])
            ->andWhere($whereid)
            ->all();
        if (!empty($gaji)) {
            foreach ($gaji as $row) {
                $list[] = '<li><a href="' . Yii::$app->homeUrl . 'kepangkatan/update?id=' . $row['id'] . '"> ' . $row->data->nama . ' </a></li>';
            }
        } else {
            $list = '<li><a href="#">data tidak ada</a></li>';
        }
        return $list;
    }
    public function actionKenaikanpangkat()
    {
        $role = \Yii::$app->tools->getcurrentroleuser();
        if (in_array('karyawan', $role)) {
            $whereid = ['m_biodata.id_data' => \Yii::$app->user->identity->id_data];
        } else {
            $whereid = '';
        }
        $where = new Expression('MOD((EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM "kepangkatan"."tmtPangkat"))::INTEGER, 4) = 0');
        $wherecon = new Expression('EXTRACT(YEAR FROM "kepangkatan"."tmtPangkat") < EXTRACT(YEAR FROM NOW())');
        $gaji = MBiodata::find()
            ->join('join', 'kepangkatan', 'm_biodata.id_data = kepangkatan.id_data')
            ->join('join', 'penggolongangaji', 'kepangkatan.penggolongangaji_id = penggolongangaji.id')
            ->join('join', 'm_referensi', 'penggolongangaji.pangkat_id = m_referensi.reff_id')
            ->andWhere(['is_pegawai' => '1'])
            ->andWhere(['m_referensi.tipe_referensi' => '6'])
            ->andWhere($where)
            ->andWhere($wherecon)
            ->andWhere($whereid)
            ->count();
        return $gaji;
    }
    public function actionLisenaikanpangkat()
    {
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
            ->join('join', 'kepangkatan', 'm_biodata.id_data = kepangkatan.id_data')
            ->join('join', 'penggolongangaji', 'kepangkatan.penggolongangaji_id = penggolongangaji.id')
            ->join('join', 'm_referensi', 'penggolongangaji.pangkat_id = m_referensi.reff_id')
            ->andWhere(['is_pegawai' => '1'])
            ->andWhere(['m_referensi.tipe_referensi' => '6'])
            ->andWhere($where)
            ->andWhere($wherecon)
            ->andWhere($whereid)
            ->all();
        if (!empty($gaji)) {
            foreach ($gaji as $row) {
                $list[] = '<li><a href=""> ' . $row['nama'] . ' </a></li>';
            }
        } else {
            $list = '<li><a href="#">data tidak ada</a></li>';
        }
        return $list;
    }
}
