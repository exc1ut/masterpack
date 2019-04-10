<?php

use app\assets\RegistrationAsset;
use yii\helpers\Html;
use yii\helpers\Url;
RegistrationAsset::register($this);
?>











<div class="navbar">
   <a href="<?= Url::toRoute(['/'])?>">Главный</a>
    <a href="<?= Url::toRoute(['site/dogovor'])?>">Рег.дог</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.поставшика</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.клиента</a>
    <a href="<?= Url::toRoute(['site/sklad'])?>">Склад сырья</a>
    <a href="lala.html">Склад-1</a>
    <a href="">Склад-2</a>
    <a href="">Склад ГП</a>
    <a href="">Склад допюсырья</a>
</div>
<form id="form"  name="myForm" onsubmit="return validateForm(event)" method="post" action="addbank">
    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<div class="container">
    <div class="row">
        <div class="col-md-1">
            
        </div>
        <div class="col-md-3">
            <p>Имя</p>
            <?= Html::activeDropDownList($model, 'postavshik_id',$items) ?>
            <p>Договор №</p>
            <input type="button" value="Добавить товар" onclick="add('dateTable')"/>
            <button class="button" type="submit">
                <span>Сохранить</span>
            </button>
            <button class="button">
                <span><a href="<?=Url::toRoute(['site/registration'])?>">Назад</a></span>
            </button>
        </div>
        <div class="col-md-7">
            <table class="columns" id="dateTable">
                <tr>
                    <div class="bank">
                        <p>Банк</p>
                    </div>
                    <div class="mfo">
                        <p>МФО</p>
                    </div>
                    <div class="schet">
                        <p>Счёт</p>
                    </div>
                    <td>
                        <input type="text" name="PostavshikBank[bank_name][]" style="width: 200px; margin-bottom: 10px;">
                    </td>
                    <td>
                        <input type="text" name="PostavshikBank[bank_mfo][]" style="width: 100px; margin-bottom: 10px;">
                    </td>
                    <td>
                        <input type="number" name="PostavshikBank[schet][]" style="width: 200px; margin-bottom: 10px;">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</form>
<script>
    function add(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var colCount = table.rows[0].cells.length;

        for (var i = 0; i < colCount; i++) {

            var newcell = row.insertCell(i);

            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
            //alert(newcell.childNodes);
            switch (newcell.childNodes[0].type) {
                case "text":
                    newcell.childNodes[0].value = "";
                    break;
            }
        }
    }
    function validateForm(e) {


    e.preventDefault();
    localStorage.removeItem("myKey");
        var form = document.getElementById("form");
        var mfo_empty = false;
        var name_empty = false;
        var schet_empty = false;
        var name = document.getElementsByName("PostavshikBank[bank_name][]");
        var mfo = document.getElementsByName("PostavshikBank[bank_mfo][]"); 
        var schet = document.getElementsByName("PostavshikBank[schet][]");
        for(var key in name)
        {
            if(name[key].value == "" ||mfo[key].value == "" ||schet[key].value == "")
            {
                if(!(name[key].value == "" && mfo[key].value == "" &&schet[key].value == ""))
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
