<?php

use app\assets\PrihodAsset;
use yii\helpers\Html;
PrihodAsset::register($this);
?>
<div class="navbar">
    <a href="#">Рег.дог</a>
    <a href="#">Склад сырья</a>
    <a href="#">Склад-1</a>
    <a href="#">Склад-2</a>
    <a href="#">Склад ГП</a>
    <a href="#">Склад допюсырья</a>
</div>
<form method="post" action="prihod">
<div class="sidenav">
    <div id="mySidenav">
        <button type="submit"><a href="#" id="about" >Принять</a></button>
        <a href="#" id="blog" >Очистить</a>
        <a href="#" id="projects" >Назад</a>
    </div>
</div>

    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<div class="row">
    <div class="col1">
        <h1>Тип Договора</h1>
        <div class="da">
            <p>Поставщик</p>
            <?= Html::activeDropDownList($model, 'postavshik_id',$items,[
                'id'=>'postavshik',
                'prompt'=>'Select',
            ]) ?>
        </div>
        <div id="dogovor" class="da1">
            <p>Договор</p>
            <?= Html::activeDropDownList($model, 'dogovor_id',[],[
                'prompt'=>'Select',
                'class'=>'selected',
            ]) ?>
        </div>
        <div class="da2">
            <p>Счет-Фактура</p>
            <input type="text" name="PostavshikSchetFaktura[schet_faktura_nomer]" placeholder="Фактура">
        </div>
        <div class="da3">
            <p>Дата</p>
            <input type="date" name="PostavshikSchetFaktura[schet_faktura_date]" placeholder="ДД/ММ/ГГ">
        </div>
        <div class="da4">
            <p>Гос№ Автомашина</p>
            <input type="text" name="PostavshikSchetFaktura[auto]" placeholder="Введите № автомашины">
        </div>
    </div>
    <div class="col2">
        <h1>Тип Продукта</h1>


        <div class="da5">
            <p>Тип</p>
            <?= Html::activeDropDownList($sklad, 'postavshik_schet_faktura_id[]',[],[
                'prompt'=>'Select',
                'class'=>'odk',
            ]) ?>
        </div>
        <div class="da6">
            <p>Формат</p>
            <input type="text" name="SkladSirya[format][]" placeholder="Формат Бумаги(мм)">
        </div>
        <div class="da7">
            <p>Вес</p>
            <input type="text" name="SkladSirya[ves][]" placeholder="Вес Бумаги(кг)">
        </div>
    </div>
</div>
</div>
</form>
</div>