<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use dosamigos\chartjs\ChartJs;
use app\widgets\Advquery;
$this->title =Yii::$app->name;

$populasi=\Yii::$app->tools->grafikPopulasi();
$jenispegawai=\Yii::$app->tools->gjenisPegawai();
$golpeg=\Yii::$app->tools->golonganPegawai();
$kategori=\Yii::$app->tools->kategori();
$pegultah=\Yii::$app->tools->ultahPegawai();
$pensiun=\Yii::$app->tools->nextPensiun();

$str=\Yii::$app->tools->str();
$sip=\Yii::$app->tools->sip();

if(empty($jenispegawai)){
    $arrayJenispegawai[] = '';
}else{
    foreach($jenispegawai as $row){
        $arrayJenispegawai[]=['name'=>$row['nama_referensi'],'y'=>$row['jumlah']];
    }
}
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

if(empty($golpeg)){
    $arrayGolPeg[]='';
}else{
    foreach ($golpeg as $row){
        $arrayGolPeg[]=[
            'name'=>$row['nama_referensi'],'y'=>$row['jumlah'],'color'=>'#'.random_color()
        ];
    }
}
?>
<section class="content">
    <div class="row">
<div class="site-index">
    <section class="col-lg-7 connectedSortable">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <?= Highcharts::widget([
                            'options' => [
                                'title' => ['text' => 'Golongan'],
                                    'xAxis' => [
                                        'categories'=>$kategori
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => 'Jumlah']
                                    ],
                                'series' => [
                                    [
                                        'name'=>'jumlah',
                                        'type' => 'column',
                                        'data' => $arrayGolPeg,
                                        'center' => [100, 80],
                                        'size' => 100,
                                        'showInLegend' => false,
                                        'dataLabels' => ['enabled' => true,]
                                    ],
                                ]
                            ]
                        ]); ?>

                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                        <p class="text-center">
                            <strong>Pegawai Ulang Tahun</strong>
                        </p>
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>nama</th>
                                    <th>tanggal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($pegultah as $row){ ?>
                                <tr>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['tanggalLahir'] ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="col-lg-5 connectedSortable">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <p class="text-center">
                            <strong>Pegawai</strong>
                        </p>
                        <div class="box-footer no-border">
                            <div class="row">
                                <div class="col-md-12">
                                <?=
                                ChartJs::widget([
                                    'type' => 'doughnut',
                                    'id' => 'structurePie',
                                    'options' => [
                                        'height' => 200,
                                        'width' => 400,
                                    ],
                                    'data' => [
                                        'radius' =>  "90%",
                                        'labels' => ArrayHelper::getColumn($populasi,'nama_referensi'), // Your labels
                                        'datasets' => [
                                            [
                                                'data' => [ArrayHelper::getValue($populasi,'0.jumlah'),ArrayHelper::getValue($populasi,'1.jumlah')],
                                                'label' => '',
                                                'backgroundColor' => [
                                                    '#ADC3FF',
                                                    '#FF9A9A',
                                                    'rgba(190, 124, 145, 0.8)'
                                                ],
                                                'borderColor' =>  [
                                                    '#fff',
                                                    '#fff',
                                                    '#fff'
                                                ],
                                                'borderWidth' => 1,
                                                'hoverBorderColor'=>["#999","#999","#999"],
                                            ]
                                        ]
                                    ],


                                ])
                                ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <div class="box-footer no-border">
                        <?= Highcharts::widget([
                                'options' => [
                                    'title' => ['text' => 'Jenis Pegawai'],
                                    'series' => [
                                        [
                                            'type' => 'pie',
                                            'name' => 'Total',
                                            'data' => $arrayJenispegawai,
                                        ]
                                    ]
                                ]
                            ]); ?>
                        <!-- /.row -->
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="col-lg-12 connectedSortable">
        <div class="col-md-4">
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <p class="text-center">
                        <strong>pegawai yg akan pensiun</strong>
                    </p>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <!-- <thead>
                            <tr>
                                <th>nama</th>
                            </tr>
                            </thead> -->
                            <tbody>
                            <?php foreach ($pensiun as $row){ ?>
                            <tr>
                                <td><?= $row['nama'] ?></td>
                            </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <p class="text-center">
                        <strong>STR akan habis</strong>
                    </p>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>nama</th>
                                <th>tanggal</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if (!empty($str)){
                            foreach ($str as $row){ ?>
                            <tr>
                                <td><?= $row->data->namalengkap ?></td>
                                <td><?= $row['tgl_berlaku_ijin'] ?></td>

                            </tr>
                            <?php };}else{ ?>
                            <tr>

                            </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <p class="text-center">
                        <strong>SIP akan habis</strong>
                    </p>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>nama</th>
                                <th>tgl berakhir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($sip)){
                            foreach ($sip as $row){ ?>
                            <tr>
                                <td><?= $row->data->namalengkap ?></td>
                                <td><?= $row->tgl_berlaku_ijin ?></td>
                            </tr>
                            <?php };}else{ ?>

                            <?php };?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
    </div>
</section>


