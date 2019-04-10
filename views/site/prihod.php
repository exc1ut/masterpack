<?php

use app\assets\PAsset;
use yii\helpers\Html;
use yii\helpers\Url;
PAsset::register($this);

?>

<div class="navbar">
    <a href="<?= Url::toRoute(['/'])?>"> Главный</a>
    <a href="<?= Url::toRoute(['site/dogovor'])?>">Рег.дог</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.поставшика</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.клиента</a>
    <a href="<?= Url::toRoute(['site/sklad'])?>">Склад сырья</a>
    <a href="lala.html">Склад-1</a>
    <a href="">Склад-2</a>
    <a href="">Склад ГП</a>
    <a href="">Склад допюсырья</a>
</div>
<form id="form"  name="myForm" onsubmit="return validateForm(event)" method="post" action="prihod">
<div class="sidenav">
    <a href="#" id="about"  class="about">
     <div id="mySidenav">
       <button type="submit">Принять</button>
    </div>
</a>
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
            <input required type="text" name="PostavshikSchetFaktura[schet_faktura_nomer]" placeholder="Фактура">
        </div>
        <div class="da3">
            <p>Дата</p>
            <input required type="date" name="PostavshikSchetFaktura[schet_faktura_date]" placeholder="ДД/ММ/ГГ">
        </div>
        <div class="da4">
            <p>Гос№ Автомашина</p>
            <input required type="text" name="PostavshikSchetFaktura[auto]" placeholder="Введите № автомашины">
        </div>
    </div>
    <div id="skladItems" id class="col2">
        <h1>Тип Продукта</h1>

        <button onclick="addPrihod(event);">Add</button>
        <div id="skladItem">
        <div class="da5">
            <p>Тип</p>
            <?= Html::activeDropDownList($sklad, 'postavshik_schet_faktura_id[]',[],[
                'prompt'=>'Select',
                'class'=>'odk',
            ]) ?>
        </div>
        <div class="da6">
            <p>Формат</p>v
            <input type="text" name="SkladSirya[format][]" placeholder="">
        </div>
        <div class="da7">
            <p>Вес</p>
            <input type="text" name="SkladSirya[ves][]" placeholder="">
        </div>
        </div>
    </div>
</div>
</div>
</form>
</div>
<script type="text/javascript">
    function validateForm(e) {


    e.preventDefault();
    localStorage.removeItem("myKey");
        var form = document.getElementById("form");
        var mfo_empty = false;
        var name_empty = false;
        var schet_empty = false; 
        var tip = document.getElementsByName("SkladSirya[postavshik_schet_faktura_id][]");
        var format = document.getElementsByName("SkladSirya[format][]");
        var ves = document.getElementsByName("SkladSirya[ves][]");
        
        var id = document.getElementsByName("SkladSirya[postavshik_schet_faktura_id][]");

        for(var key in format)
        {
            if(format[key].value == "" || ves[key].value == "" || tip[key].value == "")
            {
                if(!(format[key].value == "" && ves[key].value == "" && tip[key].value == ""))
                {
                 mfo_empty = true;
                }
            }
        }
        if(mfo_empty == true) {
            alert("Заполните");
            return false;
                } 
    else 
    {
        form.submit();
    }
    
}
</script>