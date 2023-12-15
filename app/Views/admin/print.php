<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">

<head>
    <title></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <br />
    <style type="text/css">
        p {
            margin: 0;
            padding: 0;
        }

        .ft10 {
            font-size: 12px;
            font-family: Times;
            color: #000000;
        }

        .ft11 {
            font-size: 17px;
            font-family: Times;
            color: #000000;
        }

        .ft12 {
            font-size: 14px;
            font-family: Times;
            color: #000000;
        }

        .ft13 {
            font-size: 13px;
            font-family: Times;
            color: #000000;
        }

        .ft14 {
            font-size: 14px;
            line-height: 23px;
            font-family: Times;
            color: #000000;
        }

        .ft15 {
            font-size: 13px;
            line-height: 21px;
            font-family: Times;
            color: #000000;
        }

        .ft16 {
            font-size: 13px;
            line-height: 19px;
            font-family: Times;
            color: #000000;
        }

        .ft17 {
            font-size: 13px;
            line-height: 20px;
            font-family: Times;
            color: #000000;
        }
    </style>
</head>

<body bgcolor="#A0A0A0" vlink="blue" link="blue" >
    <div id="page1-div" style="position:relative;width:918px;height:1188px;">
        <img width="918" height="auto" src="data:image/png;base64,<?= base64_encode(file_get_contents('cetak/target001.png')); ?>" alt="background image" />
        <p style="position:absolute;top:514px;left:239px;white-space:nowrap" class="ft10">
            Untuk&#160;Pembayaran&#160;Via&#160;Transfer&#160;:&#160;
        </p>
        <p style="position:absolute;top:535px;left:251px;white-space:nowrap" class="ft10">
            Mandiri&#160;:&#160;155-00-0726500-0&#160;
        </p>
        <p style="position:absolute;top:556px;left:239px;white-space:nowrap" class="ft10">
            BCA&#160;:&#160;8820233167&#160;(an.&#160;Utaryana)&#160;
        </p>
        <p style="position:absolute;top:515px;left:449px;white-space:nowrap" class="ft10">Hormat&#160;Kami,&#160;</p>
        <p style="position:absolute;top:60px;left:206px;white-space:nowrap" class="ft11">CV.&#160;Saluyu&#160;Garfika&#160;</p>
        <p style="position:absolute;top:55px;left:394px;white-space:nowrap" class="ft11">&#160;</p>
        <p style="position:absolute;top:55px;left:445px;white-space:nowrap" class="ft11">&#160;</p>
        <p style="position:absolute;top:55px;left:496px;white-space:nowrap" class="ft11">&#160;</p>
        <p style="position:absolute;top:55px;left:546px;white-space:nowrap" class="ft11">&#160;</p>
        <p style="position:absolute;top:55px;left:597px;white-space:nowrap" class="ft11">&#160;</p>
        <p style="position:absolute;top:60px;left:639px;white-space:nowrap" class="ft12">
            <?php
            setlocale(LC_TIME, 'id_ID');
            $currentDateTime = strftime('%d %B %Y');
            echo 'Tangerang, ' . $currentDateTime;
            ?>
        </p>
        <p style="position:absolute;top:55px;left:790px;white-space:nowrap" class="ft11">&#160;</p>
        <p style="position:absolute;top:81px;left:206px;white-space:nowrap" class="ft14">
            Percetakan&#160;Digital&#160;–&#160;Offset&#160;<br />Sablon&#160;–&#160;Desain&#160;Grafis/Setting&#160;&#160;&#160;
        </p>
        <p style="position:absolute;top:105px;left:496px;white-space:nowrap" class="ft12">&#160;</p>
        <p style="position:absolute;top:105px;left:546px;white-space:nowrap" class="ft12">&#160;</p>
        <p style="position:absolute;top:105px;left:597px;white-space:nowrap" class="ft12">&#160;</p>
        <p style="position:absolute;top:105px;left:616px;white-space:nowrap" class="ft12">
            &#160;&#160;&#160;&#160;&#160;&#160;&#160;Kepada&#160;Yth,&#160;
        </p>
        <p style="position:absolute;top:136px;left:102px;white-space:nowrap" class="ft13">
            Jl.&#160;Proklamasi&#160;No.&#160;27&#160;Cimone,&#160;Kec.&#160;Karawaci&#160;–&#160;Tangerang&#160;
        </p>
        <p style="position:absolute;top:128px;left:546px;white-space:nowrap" class="ft13">&#160;</p>
        <p style="position:absolute;top:128px;left:597px;white-space:nowrap" class="ft13">&#160;</p>
        <p style="position:absolute;top:161px;left:102px;white-space:nowrap" class="ft16">
            Telp.&#160;(021)&#160;5588926,&#160;0812&#160;9580&#160;6767&#160;Email:&#160;saluyugrafika@gmail.com
            &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
            <span style="font-size: 18px; font-weight: bold;">
                <?= $customer['name']; ?>
            </span>&#160;<br />&#160;<br />No.&#160;Faktur&#160;:&#160;{Nomor Faktur}&#160;
        </p>
        <p style="position:absolute;top:221px;left:139px;white-space:nowrap; font-weight: bold;">Qty&#160;</p>
        <p style="position:absolute;top:221px;left:213px;white-space:nowrap; font-weight: bold;">
            Nama&#160;Barang&#160;/&#160;Keterangan&#160;
        </p>
        <p style="position:absolute;top:221px;left:451px;white-space:nowrap; font-weight: bold;">Harga&#160;</p>
        <p style="position:absolute;top:221px;left:638px;white-space:nowrap; font-weight: bold;">Subtotal&#160;</p>

        <?php foreach ($data as $index => $dt) : ?>
            <div>
                <p style="position:absolute;top:<?= 245 + ($index * 20) ?>px;left:144px;white-space:nowrap"><?= $dt['quantity']; ?>&#160;</p>
                <p style="position:absolute;top:<?= 245 + ($index * 20) ?>px;left:213px;white-space:nowrap"><?= $dt['name_product']; ?>&#160;</p>
                <p style="position:absolute;top:<?= 245 + ($index * 20) ?>px;left:451px;white-space:nowrap"><?= 'Rp. ' . number_format($dt['price'], 0, ',', '.') . ',00' ?>&#160;</p>
                <p style="position:absolute;top:<?= 245 + ($index * 20) ?>px;left:639px;white-space:nowrap"><?= 'Rp. ' . number_format($dt['total'], 0, ',', '.') . ',00' ?>&#160;</p>
            </div>
        <?php endforeach; ?>


        <p style="position:absolute;top:480px;left:101px;white-space:nowrap" class="ft17">
            Terbilang&#160;:&#160;{Terbilang}&#160;<br />Tanda&#160;Terima&#160;&#160;
        </p>
        <p style="position:absolute;top:481px;left:591px;white-space:nowrap" class="ft13">
            <span style="font-weight: bold;">
                Total&#160;&#160;&#160;<?= 'Rp. ' . number_format($total_harga, 0, ',', '.') . ',00' ?>
            </span>
        </p>
        <p style="position:absolute;top:503px;left:580px;white-space:nowrap" class="ft13">
            <span>
                Byr/DP&#160;&#160;<?= 'Rp. ' . number_format($dp, 0, ',', '.') . ',00' ?>
            </span>
        </p>
        <p style="position:absolute;top:524px;left:594px;white-space:nowrap" class="ft13">
            <span>
                Disc&#160;&#160;&#160;<?= 'Rp. ' . number_format($diskon, 0, ',', '.') . ',00' ?>
            </span>
        </p>
        <p style="position:absolute;top:546px;left:596px;white-space:nowrap" class="ft13">
            <span style="font-weight: bold;">
                Sisa&#160;&#160;&#160;<?= $sisa; ?>
            </span>
        </p>
        <span style="position:absolute;top:590px;left:723px;white-space:nowrap">
            <!-- <a href="<?= base_url('simpan_print'); ?>" target="_blank" class="badge badge-outline">Cetak Invoice</a> -->
        </span>

        <p style="position:absolute;top:461px;left:609px;white-space:nowrap" class="ft15">&#160;<br />&#160;<br />&#160;<br />&#160;</p>
        <p style="position:absolute;top:548px;left:100px;white-space:nowrap" class="ft15">&#160;<br />&#160;</p>
    </div>
</body>

</html>