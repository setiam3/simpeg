<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
        <table id="table_id" class="display" style="width: 100%">
            <thead>
            <tr>
                <th>id</th>
                <th>Kategory</th>
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
$this->registerJsVar('baseurl', yii\helpers\Url::home());
if (!$model->isNewRecord){
    $this->registerJsVar('kategory',$kategory);
$format = <<< js
    $(document).ready( function () {
        var groupColumn = 1;
    var table = $('#table_id').DataTable({
    "columnDefs": [
        { "visible": false, "targets": groupColumn }
    ],
    "drawCallback": function ( settings ) {
        var api = this.api();
        var rows = api.rows( {page:'current'} ).nodes();
        var last=null;
        api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
            if ( last !== group ) {
                $(rows).eq( i ).before(
                    '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                )
                last = group;
            }
        });
    },
    
    lengthChange: false,
    "paging": false,
    info: false,
        ajax:{
            url:baseurl+'formula/formula',
            dataSrc: 'data',
        },
        columns: [
            { data: 'id' },
            { data: 'kategory' },
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
        var i=0;
        for (i;i<=kategory.length;i++){
            $("input[name='bobot["+kategory[i].kategory+"]'][value='"+kategory[i].id_bobot+"']").prop('checked',true);

        }
        },3000);




});
js;
}else{
$format = <<< js
    $(document).ready( function () {
        var groupColumn = 1;
    var table = $('#table_id').DataTable({
    "columnDefs": [
        { "visible": false, "targets": groupColumn }
    ],
    // "order": [[ groupColumn, 'asc' ]],
    "drawCallback": function ( settings ) {
        var api = this.api();
        var rows = api.rows( {page:'current'} ).nodes();
        var last=null;
        api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
            if ( last !== group ) {
                $(rows).eq( i ).before(
                    '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                )
                last = group;
            }
        });
    },
    
    lengthChange: false,
    "paging": false,
    info: false,
        ajax:{
            url:baseurl+'formula/formula',
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'kategory' },
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

});
js;
}
$this->registerJs($format);
$style = <<< CSS
    tr.group,
    tr.group:hover {
        background-color: #ddd !important;
    }
    .group{
        text-transform: uppercase;
        font-weight: bold;
        font-size: 15px;
    }
CSS;
$this->registerCss($style);