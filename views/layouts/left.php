<?php
use app\models\Menu;
//use mdm\admin\models\Menu;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
$images='';
$model=\app\models\MBiodata::findOne(Yii::$app->user->identity->id_data);
if(Yii::$app->user->isGuest || !is_object($model)){
    $images=$directoryAsset."/img/user2-160x160.jpg";
}elseif(is_object($model) && $model->foto!==NULL){
    $images=\Yii::getAlias('@web/uploads/foto/'.$model->foto);
}elseif(is_object($model)){
    $images = ($model->jenisKelamin==10)?\Yii::getAlias('@web/uploads/foto/avatarfemale.jpg'):\Yii::getAlias('@web/uploads/foto/avatar-male.jpg');
}
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=$images?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=(Yii::$app->user->isGuest)?'Guest':Yii::$app->user->identity->username;?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
    <?php
        $menu[]=Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login'],'icon'=>'glyphicon glyphicon-log-in']
            ) : (
                ['label' => 'Logout', 'url' => ['/site/logout'],'icon'=>'glyphicon glyphicon-log-out']
            );
    ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'iconClassPrefix'=>'',//default fa fa-
                'items' => (!Yii::$app->user->isGuest)?ArrayHelper::merge(Menu::getMenu(),$menu):$menu
            ]
        ) ?>
    </section>
</aside>
