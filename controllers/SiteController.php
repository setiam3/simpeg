<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                    'logout' => ['post'],
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
    public function actionDashboard(){
        return $this->render('dashboard');
    }
    public function actionPhpinfo(){
        phpinfo();
    }
    public function actionPdftoimg($pathfile){
      $preview='';
      $ext=pathinfo($pathfile);
      $image=['jpg','jpeg','png'];
     
      if($ext['extension']=='pdf'){
        $this->genPdfThumbnail($pathfile,$ext['basename'].'.jpeg');
        $preview=\Yii::getAlias('@web/uploads/foto/510204244/').$ext['basename'].'.jpeg';
      }elseif(in_array(strtolower($ext['extension']),$image)){
        //$preview=Yii::getAlias('@urlUpload').$model->cv;
      }else{
        $preview='';
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
    
    public function actionChild($model) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = $model=='Kecamatan'?$this->findModelAll(['regency_id'=> $id],$model):$this->findModelAll(['district_id'=> $id],$model);
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

    protected function findModel($id,$models){
        $modelx=Yii::createObject([
          'class' => "app\models\\".$models,
         ]);
        if (($model = $modelx::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelAll($id,$models){
        $modelx=Yii::createObject([
          'class' => "app\models\\".$models,
         ]);
        if (($model = $modelx::findAll($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
