<?php

use app\assets\DogovorAsset;
use yii\helpers\Html;
use yii\helpers\Url;
DogovorAsset::register($this);
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
<form id="form" class="form" name="myForm" onsubmit="return validateForm(event)" method="post" action="dogovor">
    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <p>Имя</p>
            <?= Html::activeDropDownList($model, 'postavshik',$items) ?>
            <p>Договор №</p>
            <input required type="text" name="Dogovor[dogovor_nomer]">
            <p>Дата</p>
            <input required type="date" name="Dogovor[date]">
            <p></p>
            <input type="button" value="Добавить товар" onclick="add('dateTable')"/>
            <button class="button" type="submit">
                <span>Сохранить</span>
            </button>
            <button class="button">
                <span>Назад</span>
            </button>
        </div>
        <div class="col-md-9">
            <table class="columns" id="dateTable">
                <tr>
                    <div class="main">
                        <p> Наим.Товара </p>
                    </div>
                    <div class="krat">
                        <p> Краткое</p>
                    </div>
                    <div class="krat2">
                        <p>наим</p>
                    </div>
                    <div class="izmer">
                        <p> Ед.изм.</p>
                    </div>
                    <div class="cena1">
                        <p> Цена 1 </p>
                    </div>
                    <div class="nds">
                        <p> НДС </p>
                    </div>
                    <div class="cena2">
                        <p> Цена 2 </p>
                    </div>
                    <div class="usd1">
                        <p> USD 1 </p>
                    </div>
                    <div class="usd2">
                        <p> USD 2 </p>
                    </div>

                    <td>
                        <input type="text" name="DogovorTable[tovar][]" style="width: 180px;">
                    </td>
                    <td>
                        <input type="text" name="DogovorTable[kratkoe_naimenovanie][]" style="width:80px;">
                    </td>
                    <td>
                        <input  type="text" name="DogovorTable[measure][]" style="width:80px;">
                    </td>
                    <td>
                        <input  type="text" name="DogovorTable[cost1][]" style="width:80px;">
                    </td>
                    <td>
                        <input  type="text" name="DogovorTable[nds][]" style="width: 80px;">
                    </td>
                    <td>
                        <input type="text" name="DogovorTable[cost2][]" style="width: 80px;">
                    </td>
                    <td>
                        <input type="text" name="DogovorTable[usd1][]" style="width: 80px;">
                    </td>
                    <td>
                        <input type="text" name="DogovorTable[usd2][]" style="width: 80px;">
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
</script>
<script type="text/javascript">
     function validateForm(e) {


    e.preventDefault();
    localStorage.removeItem("myKey");
        var form = document.getElementById("form");
        var mfo_empty = false;
        var name_empty = false;
        var schet_empty = false; 
        var tovar = document.getElementsByName("DogovorTable[tovar][]");
        var kn = document.getElementsByName("DogovorTable[kratkoe_naimenovanie][]");
        var measure = document.getElementsByName("DogovorTable[measure][]");
        var cost1 = document.getElementsByName("DogovorTable[cost1][]");
        var cost2 = document.getElementsByName("DogovorTable[cost2][]");
        var nds = document.getElementsByName("DogovorTable[nds][]");
        var usd1 = document.getElementsByName("DogovorTable[usd1][]");
        var usd2 = document.getElementsByName("DogovorTable[usd2][]");
        for(var key in tovar)
        {
            if(tovar[key].value == "" || kn[key].value == "" || measure[key].value == ""|| cost1[key].value == "" || nds[key].value == "" || cost2[key].value == "" || usd1[key].value == "" || usd2[key].value == "")
            {
                if(!(tovar[key].value == "" && kn[key].value == "" && measure[key].value == ""&& cost1[key].value == ""))
                {
                 if(nds[key].value == "" && cost2[key].value == "" && usd1[key].value == "" && usd2[key].value == "")   
                 {
                mfo_empty = true;
                }
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