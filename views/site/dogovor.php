<?php

use app\assets\DogovorAsset;
use yii\helpers\Html;
use yii\helpers\Url;
DogovorAsset::register($this);
?>











<div class="navbar">
   <a href="header.html"> <img src="/images/logo.png"></a>
    <a href="<?= Url::toRoute(['site/dogovor'])?>">Рег.дог</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.поставшика</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.клиента</a>
    <a href="<?= Url::toRoute(['site/sklad'])?>">Склад сырья</a>
    <a href="lala.html">Склад-1</a>
    <a href="">Склад-2</a>
    <a href="">Склад ГП</a>
    <a href="">Склад допюсырья</a>
</div>
<form method="post" action="dogovor">
    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <p>Имя</p>
            <?= Html::activeDropDownList($model, 'postavshik',$items) ?>
            <p>Договор №</p>
            <input type="text" name="Dogovor[dogovor_nomer]">
            <p>Дата</p>
            <input type="date" name="Dogovor[date]">
            <p></p>
            <input type="button" value="Добавить товар" onclick="add('dateTable')"/>
            <button class="button" type="submit">
                <span>Сохранить</span>
            </button>
            <button class="button">
                <span>Назад</span>
            </button>
        </div>
        <div class="col-md-10">
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
                        <input type="text" name="DogovorTable[measure][]" style="width:80px;">
                    </td>
                    <td>
                        <input type="text" name="DogovorTable[cost1][]" style="width:80px;">
                    </td>
                    <td>
                        <input type="text" name="DogovorTable[nds][]" style="width: 80px;">
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















<!--<div class="container">-->
<!--    <div class="navbar">-->
<!--        <img src="/css/images/logo.png">-->
<!--        <a href="index2.html">Рег.дог</a>-->
<!--        <a href="index3.html">Рег.клиента</a>-->
<!--        <a href="schet.html">Склад сырья</a>-->
<!--        <a href="">Склад-1</a>-->
<!--        <a href="">Склад-2</a>-->
<!--        <a href="">Склад ГП</a>-->
<!--        <a href="">Склад допюсырья</a>-->
<!--    </div>-->
<!--</div>-->
<!--<section>-->
<!--    <form method="post" action="dogovor">-->
<!--        --><?//=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<!--    <div class="col1">-->
<!---->
<!--        <div class="d-flex">-->
<!--            <p> Имя </p>-->
<!--            --><?//= Html::activeDropDownList($model, 'postavshik',$items) ?>
<!--            <p> Договор №</p>-->
<!--            <input type="text" name="Dogovor[dogovor_nomer]" placeholder="Договор №.">-->
<!--            <p>Дата</p>-->
<!--            <input type="date" name="Dogovor[date]">-->
<!--            <p>Colums</p>-->
<!--            <input type="number" id="inputValue" name="columns" placeholder="1" value="1"  style="width: 115px;">-->
<!--            <button type="button" id="addColumns"><span> Create</span> </button>-->
<!--        </div>-->
<!--        <button type="submit" class="button">-->
<!--            <span>Сохранить</span>-->
<!--        </button>-->
<!--        <button class="button">-->
<!--            <span>Назад</span>-->
<!--        </button>-->
<!--    </div>-->
<!--    <div class="col2" id="columnsDiv">-->
<!--    </div>-->
<!--    </form>-->
<!--</section>-->
<!---->
<!---->
<!--<script type="text/javascript">-->
<!--    window.onload = function () {-->
<!---->
<!--        var buttonAddColumns = document.querySelector('#addColumns');-->
<!--        var columnsDiv = document.querySelector('#columnsDiv');-->
<!--        var counter = 0;-->
<!--        tableCreate();-->
<!---->
<!--        buttonAddColumns.addEventListener("click", tableCreate);-->
<!--        function tableCreate() {-->
<!--            var columnsDiv = document.querySelector('#columnsDiv');-->
<!--            columnsDiv.innerHTML = '';-->
<!--            var inputValue = document.getElementsByName('columns')[0].value-->
<!--            var body = document.getElementById('columnsDiv');-->
<!--            var tbl = document.createElement('table');-->
<!--            tbl.setAttribute('border', '1');-->
<!--            var tbdy = document.createElement('tbody');-->
<!--            var tr = document.createElement('tr');-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('Наим. Товара'))-->
<!--            tr.appendChild(th);-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('Краткое наим'))-->
<!--            tr.appendChild(th)-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('Ед. изм'))-->
<!--            tr.appendChild(th)-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('Цена 1'))-->
<!--            tr.appendChild(th)-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('НДС'))-->
<!--            tr.appendChild(th)-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('Цена 2'))-->
<!--            tr.appendChild(th)-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('USD 1'))-->
<!--            tr.appendChild(th)-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('USD 2'))-->
<!--            tr.appendChild(th)-->
<!--            tbdy.appendChild(tr);-->
<!--            for (var i = 0; i < inputValue; i++) {-->
<!--                var tr = document.createElement('tr');-->
<!--                        var td = document.createElement('td');-->
<!--                        var input = document.createElement('input');-->
<!--                        input.name = "DogovorTable[tovar][]";-->
<!--                        input.setAttribute('style', 'width: 100px;');-->
<!--                        td.appendChild(input);-->
<!--                        tr.appendChild(td);-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "DogovorTable[kratkoe_naimenovanie][]"-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td)-->
<!--                tbdy.appendChild(tr);-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "DogovorTable[measure][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td)-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "DogovorTable[cost1][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td)-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "DogovorTable[nds][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td)-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "DogovorTable[cost2][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td)-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "DogovorTable[usd1][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td)-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "DogovorTable[usd2][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td)-->
<!--            }-->
<!--            tbl.appendChild(tbdy);-->
<!--            body.appendChild(tbl)-->
<!--        }-->
<!---->
<!--    }-->
<!--</script>-->
