<?php
use yii\helpers\{Html, ArrayHelper, Url};
?>

<table border="0" width="100%">
    <!--    header-->
    <tr>
        <td><img src="<?= Yii::$app->basePath . '/web/img/logogresik.png' ?>" style="width: 75px" /></td>
        <td style="text-align: center">
            <p style="font-weight: bold;">PEMERINTAH KABUPATEN GRESIK</p>
            <p style="font-size: 20px; font-weight: bold">RUMAH SAKIT UMUM DAERAH IBNU SINA</p>
            <p>Jl. Dr. Wahidin Sudirohusodo No. 243-B Gresik</p>
            <p>Telp. (031) 3951239 - Fax. (031) 3955217</p>
        </td>
        <td><img src="<?= Yii::$app->basePath . '/web/img/logopng.png' ?>" style="width: 75px" />
        </td>
    </tr>
    <!--    end header-->
    <tr>
        <td colspan="3">
            <hr style=" border: 10px;
            border-top: 5px double #8c8c8c;">
        </td>
    </tr>
</table>
<br>
<br>

<table style="width: 100%" border="0">
    <tr>
        <td style="text-align: center">
            <p style="text-decoration: underline; font-weight: bold; font-size: 15px">PAKTA INTEGRITAS</p>
        </td>
    </tr>
</table>
<br>
<br>
<table style="width: 100%" border="0">
    <tr>
        <td colspan="3">
            <p>Saya yang bertandatangan di bawah ini :</p>
        </td>
    </tr>
    <tr>
        <td width="25px" style="text-align: right">
            1.
        </td>
        <td width="100px">
            Nama
        </td>
        <td>
            : <?= $datas[0]['nama'] ?>
        </td>
    </tr>
    <tr>
        <td width="25px" style="text-align: right">
            2.
        </td>
        <td width="100px">
            Jabatan
        </td>
        <td>
            : <?= $datas[0]['jabatan'] ?>
        </td>
    </tr>
</table>
<br>
<table border="0">
    <tr>
        <td colspan="2">
            <p>menyatakan secara sadar dan sungguh-sungguh atas hal-hal berikut:</p>
        </td>
    </tr>
    <tr>
        <td style="width: 4%;vertical-align: top; text-align: right">
            1.
        </td>
        <td style="width: 75%;text-align: justify;line-height:20px">
            <p>Menyetujui dalam bentuk pakta integritas untuk berkomitmen tenaga, perasaan dan pemikiran dalam
                mamajukan kesejahteraan semua civitas hospitalia RSUD Ibnu Sina tanpa memandang latar belakang profesi /
                kelompok kerjanya;</p>
        </td>
    </tr>
    <tr>
        <td style="width: 4%;vertical-align: top; text-align: right">
            2.
        </td>
        <td style="width: 75%;text-align: justify;line-height:20px">
            <p style="line-height: 50px;text-align: justify">Menyetujui pandangan dan sikap bahwa tim remunerasi bukan untuk
                kepentingan primordialisme profesi / kelompok kerja tertentu dan tidak boleh
                hanya untuk memperjuangkan kepentingan profesi / kelompok kerja yang
                diembannya saja;</p>
        </td>
    </tr>
    <tr>
        <td style="width: 4%;vertical-align: top; text-align: right">
            3.
        </td>
        <td style="width: 75%;text-align: justify;line-height: 20px">
            <p> Menyetujui pandangan dan sikap bahwa keanggotaan dalam tim remunerasi
                bersifat tim keahlian yang bisa mengkalkulasi distribusi remunerasi secara
                baik.</p>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="line-height: 50px;text-align: justify; line-height: 20px">
            <p>Surat pakta integritas ini, saya buat dengan sebenarnya, tanpa ada paksaan dari
                pihak manapun, dan agar dapat digunakan sebagaimana mestinya.</p>
        </td>
    </tr>

</table>
<br>
<br>
<table border="0" width="100%" style="text-align: center">
    <tr>
        <td></td>
        <td>
            Gresik, <?php echo date_format(date_create($datas[0]['tanggal']), 'd-m-Y') ?>
        </td>
    </tr>
    <tr>
        <td>
            <p>Mengetahui :</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>Plt.Direktur</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>Sakit Umum Daerah Ibnu Sina</p>
        </td>
        <td>Yang menyatakan:</td>
    </tr>
    <tr>
        <td>
            <p>Yang menyatakan:</p>
        </td>
    </tr>
    <tr>
        <td>

        </td>
        <td>
          <?php
           if(!empty($datas[0]['ttd'])){
               echo "<img src='".$datas[0]['ttd']."' width='200px' style=''/>";
           }else{
               echo "";
           }
           ?>
        </td>
    </tr>
    <tr>
        <td>
            <p style="text-decoration: underline"><?= $direktur[0]['nama'] ?></p>
        </td>
        <td>
            <p style="text-decoration: underline"><?= $datas[0]['nama'] ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p>NIP. <?= $direktur[0]['nip'] ?></p>
        </td>
        <td>
            <p>NIP. <?= $datas[0]['nip'] ?></p>
        </td>
    </tr>
</table>
