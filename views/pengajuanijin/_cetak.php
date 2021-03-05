<?php

use yii\helpers\Html;
?>

<div id="area_1">
    <table style="width:100%;">
        <tbody>
            <tr>
                <td style="width:60%;"></td>
                <td style="width:40%;" align="left">
                    <!-- Lampiran SPM<br> -->
                    <table>
                        <tbody>
                            <tr>
                                <td>Gresik :</td>
                                <td><?php echo Yii::$app->formatter->asDate($model->tanggalPengajuan, 'long') ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Kepada</td>
                            </tr>
                            <tr>
                                <td>Yth :</td>
                                <td>Direktur RSUD Ibnu Sina Kab. Gresik</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Mengetahui Kepala ...... di</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Gresik</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div style="text-align: center;">
    <h4>
        <p style="font-weight: bold;;
            ">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</p>
    </h4>
</div>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td colspan="4" style="padding-left: 10px;">I. DATA PEGAWAI</td>
    </tr>

    <tr>
        <td style="padding-left: 10px;">Nama</td>
        <td style="padding-left: 10px;"><?php echo $model->data->namalengkap  ?></td>
        <td style="padding-left: 10px;">NIP</td>
        <td style="padding-left: 10px;"><?php echo $model->data->nip ?></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;">Jabatan</td>
        <td style="padding-left: 10px;"><?php echo $model->data->riwayatjabatan->jabatan->nama_referensi ?></td>
        <td style="padding-left: 10px;">Masa Kerja</td>
        <td style="padding-left: 10px;"><?php echo $model->data->kepang->penggolongangaji->masa_kerja ?></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;">Unit Kerja</td>
        <td style="padding-left: 10px;"><?php echo $model->data->riwayatjabatan->unitKerja->unit ?></td>
        <td style="padding-left: 10px;"></td>
        <td style="padding-left: 10px;"></td>
    </tr>
</table>
<br>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td colspan="4" style="padding-left: 10px;"> II. JENIS CUTI YANG DIAMBIL</td>
    </tr>

    <tr>
        <td style="padding-left: 10px;"> 1. Cuti Tahunan</td>
        <td style="padding-left: 10px;"> <?= ($model->jenisIjin == 144) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
        <td style="padding-left: 10px;"> 4. Cuti Besar</td>
        <td style="padding-left: 10px;"> <?= ($model->jenisIjin == 62) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;"> 2. Cuti Sakit</td>
        <td style="padding-left: 10px;"><?= ($model->jenisIjin == 141) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
        <td style="padding-left: 10px;"> 5. Cuti Melahirkan</td>
        <td style="padding-left: 10px;"><?= ($model->jenisIjin == 63) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;"> 3. Cuti Karena Alasan Penting</td>
        <td style="padding-left: 10px;"><?= ($model->jenisIjin == 142) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
        <td style="padding-left: 10px;"> 6. Cuti Diluar Tanggungan Negara</td>
        <td style="padding-left: 10px;"><?= ($model->jenisIjin == 143) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
    </tr>
</table>
<br>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td style="padding-left: 10px;">III. ALASAN CUTI</td>
    </tr>
    <tr>
        <td style="padding-left: 10px;"><?php echo $model->alasan ?></td>
    </tr>
</table>
<br>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td colspan="6" style="padding-left: 10px;">IV. LAMANYA CUTI</td>
    </tr>
    <tr>
        <td style="text-align:center;">Selama</td>
        <td style="text-align:center;"><?php $endDate = strtotime($model->tanggalAkhir);
                                        $startDate = strtotime($model->tanggalMulai);
                                        $days = ($endDate - $startDate) / 86400 + 1;
                                        echo  $days; ?> hari</td>
        <td style="text-align:center;">Mulai Tanggal</td>
        <td style="text-align:center;"><?php echo $model->tanggalMulai ?></td>
        <td style="text-align:center;">Sd</td>
        <td style="text-align:center;"><?php echo $model->tanggalAkhir ?></td>
    </tr>
</table>
<br>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td colspan="5" style="padding-left: 10px;">V. CATATAN CUTI</td>
    </tr>
    <tr>
        <td colspan="3" style="padding-left: 10px;">1. CUTI TAHUNAN</td>
        <td style="padding-left: 10px;">2. CUTI BESAR</td>
        <td style="padding-left: 10px;"></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;">Tahun</td>
        <td style="padding-left: 10px;">Sisa</td>
        <td style="padding-left: 10px;">Keterangan</td>
        <td style="padding-left: 10px;">3. CUTI SAKIT</td>
        <td style="padding-left: 10px;"></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;">N-2</td>
        <td style="padding-left: 10px;"></td>
        <td style="padding-left: 10px;"></td>
        <td style="padding-left: 10px;">4. CUTI MELAHIRKAN</td>
        <td style="padding-left: 10px;"></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;">N-1</td>
        <td style="padding-left: 10px;"></td>
        <td style="padding-left: 10px;"></td>
        <td style="padding-left: 10px;">5. CUTI KARENA ALASAN PENTING</td>
        <td style="padding-left: 10px;"></td>
    </tr>
    <tr>
        <td style="padding-left: 10px;">N</td>
        <td style="padding-left: 10px;"><?php echo $model->data->sisacuti->sisa ?></td>
        <td style="padding-left: 10px;"></td>
        <td style="padding-left: 10px;">6. CUTI DILUAR TANGGUNGAN NEGARA</td>
        <td style="padding-left: 10px;"></td>
    </tr>
</table>
<br>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td colspan="3" style="padding-left: 10px;">VI. ALAMAT SAAT MENJALANKAN CUTI</td>
    </tr>
    <tr>
        <td rowspan="2" style="padding-left: 10px;"><?php echo $model->data->alamat ?></td>
        <td width="25%" style="padding-left: 10px;">TELP</td>
        <td width="25%" style="padding-left: 10px;"><?php echo $model->data->telp ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;" width="50%">Hormat Saya
            <br>
            <br>
            <br>
            <br>
            <br>
            <p style="text-decoration: underline;"><?php echo $model->data->namalengkap ?></p>
            NIP. <?php echo $model->data->nip ?>
        </td>

    </tr>
</table>
<br>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td colspan="2" style="padding-left: 10px;"> VII. PERTIMBANGAN ATASAN LANGSUNG</td>

    </tr>
    <tr>
        <td style="padding-left: 10px;">Disetuhui</td>
        <td style="padding-left: 10px;">Tidak Disetujui</td>
    </tr>
    <tr>
        <td style="padding-left: 10px;"><?= ($model->disetujui == 1) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
        <td style="padding-left: 10px;"><?= ($model->disetujui == 0) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td style="text-align:center;" width="50%">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </td>
    </tr>
</table>
<br>
<table border="1" style="border: 1px solid black;
        border-collapse: collapse;" width="100%">
    <tr>
        <td colspan="2" style="padding-left: 10px;">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</td>

    </tr>
    <tr>
        <td style="padding-left: 10px;"> Disetujui</td>
        <td style="padding-left: 10px;"> Tidak di Setujui</td>
    </tr>
    <tr>
        <td style="padding-left: 10px;"><?= ($model->disetujui == 1) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
        <td style="padding-left: 10px;"><?= ($model->disetujui == 0) ? Html::img('uploads/foto/ceklist.png', ['style' => 'width:11px;height:11px;']) : ''; ?></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td style="text-align:center;" width="50%">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </td>
    </tr>
</table>