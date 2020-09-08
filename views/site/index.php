<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use dosamigos\chartjs\ChartJs;
$this->title =Yii::$app->name;
//echo \Yii::$app->tools->pdftoimg(\Yii::getAlias('@uploads').'510204244/apksiwa.pdf');

$populasi=\Yii::$app->tools->grafikPopulasi();
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
                                    'categories' => [
                                            'Juru Muda	I/a',
                                        'Juru Muda Tingkat I I/b',
                                        'Juru	I/c',
                                        'Juru Tingkat I I/d',
                                        'Pengatur Muda	II/a',
                                        'Pengatur Muda Tingkat I II/b',
                                        'Pengatur II/c',
                                        'Pengatur Tingkat I II/d',
                                        'Penata III/c',
                                        'Penata Tingkat I III/d',
                                        'Pembina IV/a',
                                        'Pembina Tingkat I IV/b',
                                        'Pembina Utama Muda IV/c',
                                        'Pembina Utama Madya IV/d',
                                        'Pembina Utama IV/e',
                                        ]
                                ],
                                'yAxis' => [
                                    'title' => ['text' => 'Jumlah']
                                ],
                                'series' => [
                                    [
                                        'type' => 'column',

//                                        'data' => [3, 2, 1, 3, 4],
                                        'data' => [
                                                ['name'=>'Juru Muda	I/a',
                                                'y'=>3,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[0]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>2,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[1]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>1,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[2]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>5,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[3]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>9,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[4]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>2,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[5]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>3,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[6]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>4,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[7]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>7,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[8]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>7,
                                                    'color'=>new JsExpression('Highcharts.getOptions().colors[9]'),],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>6,
                                                    'color'=>'#2f7ed8',],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>3,
                                                    'color'=>'#0d233a',],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>1,
                                                    'color'=>'#8bbc21',],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>7,
                                                    'color'=>'#910000',],
                                            ['name'=>'Juru Muda	I/a',
                                                'y'=>4,
                                                    'color'=>'#1aadce',],
                                        ],
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
                                    <th>tahun</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Pijar</td>
                                    <td>12-09-2020</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>Pijar</td>
                                    <td>12-09-2020</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>Pijar</td>
                                    <td>12-09-2020</td>
                                    <td>25</td>
                                </tr>
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
                                            'name' => 'Total consumption',
                                            'data' => [
                                                [
                                                    'name' => 'PNS',
                                                    'y' => 13,
                                                    'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
                                                ],
                                                [
                                                    'name' => 'BLUD',
                                                    'y' => 23,
                                                    'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                                                ],
                                                [
                                                    'name' => 'Freelance',
                                                    'y' => 19,
                                                    'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
                                                ],
                                                [
                                                    'name' => 'Pensiunan',
                                                    'y' => 19,
                                                    'color' => new JsExpression('Highcharts.getOptions().colors[3]'), // Joe's color
                                                ],
                                            ],
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
                            <thead>
                            <tr>
                                <th>nama</th>
                                <th>tanggal</th>
                                <th>tahun</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
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
                                <th>tahun</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
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
                                <th>tanggal</th>
                                <th>tahun</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Pijar</td>
                                <td>12-09-2020</td>
                                <td>25</td>
                            </tr>
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
