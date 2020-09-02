<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use dosamigos\chartjs\ChartJs;
$this->title =Yii::$app->name;
?>
<div class="site-index">
    <section class="col-lg-7 connectedSortable">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <?= Highcharts::widget([
                            'options' => [
                                'title' => ['text' => 'Fruit Consumption'],
                                'xAxis' => [
                                    'categories' => ['Apples', 'Bananas', 'Oranges']
                                ],
                                'yAxis' => [
                                    'title' => ['text' => 'Fruit eaten']
                                ],
                                'series' => [
//                ['name' => 'Jane', 'data' => [1, 0, 4]],
//                ['name' => 'John', 'data' => [5, 7, 3]]

                                    [
                                        'type' => 'pie',
                                        'name' => 'Total consumption',
                                        'data' => [
                                            [
                                                'name' => 'Jane',
                                                'y' => 13,
                                                'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
                                            ],
                                            [
                                                'name' => 'John',
                                                'y' => 23,
                                                'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                                            ],
                                            [
                                                'name' => 'Joe',
                                                'y' => 19,
                                                'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
                                            ],
                                        ],
                                    ]
                                ]
                            ]
                        ]); ?>
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
                            <strong>Golongan</strong>
                        </p>
                        <div class="box-footer no-border">
                            <div class="row">
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
                                                    'labels' => ['Perempuan', 'Pria'], // Your labels
                                                    'datasets' => [
                                                        [
                                                            'data' => ['35.6', '46.9'], // Your dataset
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
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <p class="text-center">
                            <strong>Golongan</strong>
                        </p>
                        <div class="box-footer no-border">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>jenis pegawai</strong>
                                    </p>
                                    <br>
                                    <div class="box-footer no-border">
                                        <div class="row">
                                            <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                                <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                                                       data-fgColor="#39CCCC">

                                                <div class="knob-label"><h4>PNS</h4></div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                                <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                                                       data-fgColor="#39CCCC">

                                                <div class="knob-label"><h4>BLUD</h4></div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                                <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                                                       data-fgColor="#39CCCC">

                                                <div class="knob-label"><h4>frerlance</h4></div>
                                            </div>
                                            <div class="col-xs-3 text-center">
                                                <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                                                       data-fgColor="#39CCCC">

                                                <div class="knob-label"><h4>Pensiunan</h4></div>
                                            </div>
                                            <!-- ./col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<!---->
<!--<section class="content">-->
<!---->
<!---->
<!---->
<!--    <section class="col-lg-7 connectedSortable">-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="box">-->
<!--                    <div class="box-header with-border">-->
<!---->
<!--                        <div class="col-md-12">-->
<!--                            <!-- <p class="text-center">-->
<!--                                <strong>golongan</strong>-->
<!--                                </p> -->-->
<!--                            <figure class="highcharts-figure">-->
<!--                                <div id="container"></div>-->
<!---->
<!--                            </figure>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!---->
<!---->
<!--    <section class="col-lg-5 connectedSortable">-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="box">-->
<!--                    <div class="box-header with-border">-->
<!---->
<!--                        <div class="col-md-12">-->
<!--                            <p class="text-center">-->
<!--                                <strong>jenis pegawai</strong>-->
<!--                            </p>-->
<!--                            <br>-->
<!--                            <div class="box-footer no-border">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">-->
<!--                                        <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"-->
<!--                                               data-fgColor="#39CCCC">-->
<!---->
<!--                                        <div class="knob-label"><h4>PNS</h4></div>-->
<!--                                    </div>-->
<!--                                    <!-- ./col -->-->
<!--                                    <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">-->
<!--                                        <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"-->
<!--                                               data-fgColor="#39CCCC">-->
<!---->
<!--                                        <div class="knob-label"><h4>BLUD</h4></div>-->
<!--                                    </div>-->
<!--                                    <!-- ./col -->-->
<!--                                    <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">-->
<!--                                        <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"-->
<!--                                               data-fgColor="#39CCCC">-->
<!---->
<!--                                        <div class="knob-label"><h4>frerlance</h4></div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-3 text-center">-->
<!--                                        <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"-->
<!--                                               data-fgColor="#39CCCC">-->
<!---->
<!--                                        <div class="knob-label"><h4>Pensiunan</h4></div>-->
<!--                                    </div>-->
<!--                                    <!-- ./col -->-->
<!--                                </div>-->
<!--                                <!-- /.row -->-->
<!--                            </div>-->
<!---->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!--            </div>-->
<!---->
<!---->
<!--            <div class="col-md-12">-->
<!--                <div class="box">-->
<!--                    <div class="box-header with-border">-->
<!---->
<!--                        <div class="col-md-12">-->
<!--                            <p class="text-center">-->
<!--                                <strong>pegawai (L/P)</strong>-->
<!--                            </p>-->
<!--                            <br>-->
<!--                            <div class="progress-group">-->
<!--                                <span class="progress-text">Pegawai Pria</span>-->
<!--                                <span class="progress-number"><b>160</b>/200</span>-->
<!---->
<!--                                <div class="progress sm">-->
<!--                                    <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <!-- /.progress-group -->-->
<!--                            <div class="progress-group">-->
<!--                                <span class="progress-text">Wanita</span>-->
<!--                                <span class="progress-number"><b>40</b>/200</span>-->
<!---->
<!--                                <div class="progress sm">-->
<!--                                    <div class="progress-bar progress-bar-red" style="width: 80%"></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!---->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!---->
<!--            <section class="col-lg-6 connectedSortable">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="box box-warning direct-chat direct-chat-warning">-->
<!--                            <div class="box-header with-border">-->
<!--                                <h3 class="box-title">Ulang tahun pegawai</h3>-->
<!--                            </div>-->
<!--                            <div class="box-body">-->
<!--                                <table id="example2" class="table table-bordered table-hover">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th>nama</th>-->
<!--                                        <th>tanggal</th>-->
<!--                                        <th>tahun</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!---->
<!--            </section>-->
<!---->
<!--            <section class="col-lg-6 connectedSortable">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="box box-warning direct-chat direct-chat-warning">-->
<!--                            <div class="box-header with-border">-->
<!--                                <h3 class="box-title">Pagawai akan pensiun</h3>-->
<!--                            </div>-->
<!---->
<!--                            <div class="box-body">-->
<!--                                <table id="example2" class="table table-bordered table-hover">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th>nama</th>-->
<!--                                        <th>tanggal</th>-->
<!--                                        <th>tahun</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!--            </section>-->
<!---->
<!---->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!---->
<!--            <section class="col-lg-6 connectedSortable">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="box box-warning direct-chat direct-chat-warning">-->
<!--                            <div class="box-header with-border">-->
<!--                                <h3 class="box-title">Ulang tahun pegawai</h3>-->
<!--                            </div>-->
<!--                            <div class="box-body">-->
<!--                                <table id="example2" class="table table-bordered table-hover">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th>nama</th>-->
<!--                                        <th>tanggal</th>-->
<!--                                        <th>tahun</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!---->
<!--            </section>-->
<!---->
<!--            <section class="col-lg-6 connectedSortable">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="box box-warning direct-chat direct-chat-warning">-->
<!--                            <div class="box-header with-border">-->
<!--                                <h3 class="box-title">Pagawai akan pensiun</h3>-->
<!--                            </div>-->
<!---->
<!--                            <div class="box-body">-->
<!--                                <table id="example2" class="table table-bordered table-hover">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th>nama</th>-->
<!--                                        <th>tanggal</th>-->
<!--                                        <th>tahun</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>Pijar</td>-->
<!--                                        <td>12-09-2020</td>-->
<!--                                        <td>25</td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </section>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</section>-->
