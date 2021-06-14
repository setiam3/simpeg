<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MsFormula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ms-formula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idpekerjaan')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MsPekerjaan::find()->where(['status' => '1'])->all(),'id','nama_pekerjaan'),
            'pluginOptions' => [
                'allowClear' => false
            ],
            'options' => ['placeholder' => 'Select a pekerjaan ...'],
            'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

<div>
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>id</th>
<!--            <th>No</th>-->
            <th>level</th>
            <th>uraian</th>
            <th>Pilih</th>

        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>







	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJsVar('kategory',$kategory);
$this->registerJsVar('baseurl', yii\helpers\Url::home());
if (!$model->isNewRecord){
    $format = <<< js
        $(document).ready( function () {
        $('#table_id').DataTable({
        lengthChange: false,
        "paging": false,
        info: false,
            ajax:{
               url:baseurl+'formula/formula', 
               dataSrc: 'data'
            },
            columns: [  
                { data: 'id' },
                { data: 'level' },
                { data: 'uraian' },
                { 
                    'searchable':false,
                    'orderable':false,
                    data: 'id',
                    render: function(data, type, full, meta){
                        return '<input type="radio" name="bobot['+full.kategory+']" value="'+data+'"/>';
                    }
                 },
            ]
        });
        
        setTimeout(function(){
            console.log(kategory);
            var i=0;
            for (i;i<=kategory.length;i++){
                $("input[name='bobot["+kategory[i].kategory+"]'][value='"+kategory[i].id_bobot+"']").prop('checked',true);
                
            }
           // console.log(id);
           },3000);
        
           
        
    
    });
    js;

}else{
    $format = <<< js
$(document).ready( function () {
    $('#table_id').DataTable({
    lengthChange: false,
    "paging": false,
    info: false,
        ajax:{
           url:baseurl+'formula/formula', 
           dataSrc: 'data'
        },
       
        columns: [  
            { data: 'id' },
            { data: 'level' },
            { data: 'uraian' },
            { 
                'searchable':false,
                'orderable':false,
                data: 'id',
                render: function(data, type, full, meta){
                    console.log(full)
                    // return '<input type="radio" name="bobot['+full.kategory+']" value="'+data+'"/>';
                }
             },
        ]
    });
    
        
    
});
js;
}


$this->registerJs($format);


