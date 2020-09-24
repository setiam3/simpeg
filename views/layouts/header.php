<?php

use yii\helpers\Html;

$notifDOK = \Yii::$app->tools->getNotifdokumen();
/* @var $this \yii\web\View */
/* @var $content string */
//$kgb=\Yii::$app->tools->notifKenaikanGaji();
//var_dump($notifDOK);
//die();
$this->registerJsVar('baseurl',yii\helpers\Url::home());
$this->registerJs('$("document").ready(function(){
 function loadDoc() {
     $.ajax({
         url:"site/notifdoc/",
         method:"POST",
         dataType:"json",
         success:function(data){
         $("#count_notifdok").html(data);
         }
     })
 }
 
 $(document).on("click", ".dropdown-toggle", function(){
  $.ajax({
   url:"site/lisnotifdok",
   method:"GET",    
   success:function(data){
        $(".dok").html(data);
   }
  })
 });
 
 setInterval(function(){
    loadDoc()
    notifgaji()
    countpangkat()
 },5000)
 
 
 function notifgaji(){
     $.ajax({
         url:"site/notifgaji/",
         method:"GET",
         dataType:"json",
         success:function(data){
            $("#countgaji").html(data);
         }
     })
 }
 
  $(document).on("click", ".dropdown-toggle", function(){
      $.ajax({
           url:"site/listgaji",
           method:"GET",
           dataType:"json",
           success:function(data){
                $(".gaji").html(data);
           }
      })
 });
 
 function countpangkat() {
     $.ajax({
         url:"site/kenaikanpangkat/",
         method:"POST",
         dataType:"json",
         success:function(data){
         console.log(data);
         $("#count-notif-pang").html(data);
         }
     })
 }
 
  $(document).on("click", ".dropdown-toggle", function(){
      $.ajax({
           url:"site/lisenaikanpangkat",
           method:"POST",
           dataType:"json",
           success:function(data){
                $(".gaji").html(data);
           }
      })
 });
 
 });'
    );

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Yii::$app->name . '</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li role="separator" class="divider"></li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                        <li role="separator" class="divider"></li>-->
<!--                        <li><a href="#">One more separated link</a></li>-->
<!--                    </ul>-->
<!--                </li>-->

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success" id="count_notifdok">0</span>
                    </a>
                    <ul class="dropdown-menu dok">

                    </ul>
                </li>



                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success" id="countgaji">0</span>
                    </a>
                    <ul class="dropdown-menu gaji">

                    </ul>
                </li>


<!--                notifikasi dokumen-->
                <li class="dropdown notifications-menu ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning" id="count-notif-pang">0
                        </span>
                    </a>
                    <ul class="dropdown-menu ">
                        <li class="header">You have 0 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">



<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may-->
<!--                                        not fit into the page and may cause design problems-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-users text-red"></i> 5 new members joined-->
<!--                                    </a>-->
<!--                                </li>-->
<!---->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-user text-red"></i> You changed your username-->
<!--                                    </a>-->
<!--                                </li>-->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->

<!--                notif kenaikan gaji-->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" >
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger" id="">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image" />
                        <span class="hidden-xs"><?= (Yii::$app->user->isGuest) ? 'Guest' : Yii::$app->user->identity->username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                            <p><?= (Yii::$app->user->isGuest) ? 'Guest' : Yii::$app->user->identity->username; ?></p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a('Profile', ['profile/index'], ['class' => 'btn btn-default btn-flat']) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>





















<script>
    // function loadDoc() {
    //     setInterval(function () {
    //         var xhttp = new XMLHttpRequest();
    //         xhttp.onreadystatechange = function() {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 document.getElementById("count_notif").innerHTML = this.responseText;
    //             }
    //         };
    //         xhttp.open("GET", "site/notifdoc", true);
    //         xhttp.send();
    //     },1000)
    // }loadDoc();

</script>








<!--<script>-->
<!--    // function loadDoc() {-->
<!--    //     setInterval(function () {-->
<!--    //         var xhttp = new XMLHttpRequest();-->
<!--    //         xhttp.onreadystatechange = function() {-->
<!--    //             if (this.readyState == 4 && this.status == 200) {-->
<!--    //                 document.getElementById("count_notif").innerHTML = this.responseText;-->
<!--    //             }-->
<!--    //         };-->
<!--    //         xhttp.open("GET", "site/notifdoc", true);-->
<!--    //         xhttp.send();-->
<!--    //     },5000)-->
<!--    //-->
<!--    // }-->
<!--    //-->
<!--    // loadDoc();-->
<!--    //-->
<!--    // $(document).ready(function () {-->
<!--    //     // $('#count_notif').load(function () {-->
<!--    //         $.get(-->
<!--    //             "site/notifdoc",-->
<!--    //             function (data) {-->
<!--    //                 console.log(data);-->
<!--    //                 // $('#count_notif').html(data);-->
<!--    //             }-->
<!--    //         )-->
<!--    //     // })-->
<!--    // })-->
<!---->
<!--    // $(document).ready(function () {-->
<!--    //     $('#list_notif').click(function () {-->
<!--    //         $.ajax({-->
<!--    //             type:'get',-->
<!--    //             url:'site/ListNotifDoc',-->
<!--    //             success: function (data) {-->
<!--    //                 console.log(data);-->
<!--    //                 // $('#sisaijin').html(data);-->
<!--    //             }-->
<!--    //         })-->
<!--    //     })-->
<!--    // })-->
<!---->
<!--</script>-->
