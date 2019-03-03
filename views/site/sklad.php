<?php

use app\assets\SkladAsset;
use yii\helpers\Url;
use yii\helpers\Html;
SkladAsset::register($this);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/handsontable-pro@latest/dist/handsontable.full.min.css');
$this->registerCssFile('https://handsontable.com/static/css/main.css');
?>
<body>
<div class="navbar">
    <a href="index2.html">Рег.дог</a>
    <a href="index3.html">Рег.клиента</a>
    <a href="#">Склад сырья</a>
    <a href="#">Склад-1</a>
    <a href="#">Склад-2</a>
    <a href="#">Склад ГП</a>
    <a href="#">Склад допюсырья</a>
</div>
<section>
    <div class="container">
        <div class="block-flex">
            <img src="/images/logo.png">
        </div>
    </div>
</section>
<section>
    <div class="blocks">
        <a href="<?= Url::to('prihod')?>">
            <button class="button">
                <span>Приход</span>
            </button>
        </a>
        <a href="#">
            <button class="button">
                <span>Расход</span>
            </button>
        </a>
        <a href="#">
            <button class="button">
                <span>Отчет</span>
            </button>
        </a>
    </div>
</section>
<section>
    <div class="container">
        <div class="table">

        </div>
    </div>
</section>
<div class="table">
    <table>
        <tr>
            <th>Id</th>
            <th>Поставщик</th>
            <th>Договор</th>
            <th>Номер счет фактуры</th>
            <th>Тип</th>
            <th>Вес</th>
            <th>Формат</th>
            <th>Дата</th>
            <th>Время</th>
            <? foreach($model as $item):?>
                <tr>
                    <td><?=$item["id"]?></td>
                    <td><?=$item["postavshik"]?></td>
                    <td><?=$item["dogovor_nomer"]?> от <?=$item["dogovor_date_ru"]?></td>
                    <td><?=$item["schet_factura_noemer"]?></td>
                    <td><?=$item["tip"]?></td>
                    <td><?=$item["ves"]?></td>
                    <td><?=$item["format"]?></td>
                    <td><?=$item["dater"]?></td>
                    <td><?=$item["time"]?></td>

                </tr>
            <?  endforeach; ?>
        </tr>\
    </table>
</div>
