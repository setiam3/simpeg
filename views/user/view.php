<?php
use yii\widgets\DetailView;
?>
<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at',
            'updated_at',
            ['attribute'=>'id_data',
                'value'=>function($model){
                    return $model->data->namalengkap;
                }
            ]
        ],
    ]) ?>

</div>
