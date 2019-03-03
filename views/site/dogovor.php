<?php

use app\assets\PublicAsset;
use yii\helpers\Html;
PublicAsset::register($this);
?>
<div class="container">
    <div class="navbar">
        <img src="/css/images/logo.png">
        <a href="index2.html">Рег.дог</a>
        <a href="index3.html">Рег.клиента</a>
        <a href="schet.html">Склад сырья</a>
        <a href="">Склад-1</a>
        <a href="">Склад-2</a>
        <a href="">Склад ГП</a>
        <a href="">Склад допюсырья</a>
    </div>
</div>
<section>
    <form method="post" action="dogovor">
        <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
    <div class="col1">

        <div class="d-flex">
            <p> Имя </p>
            <?= Html::activeDropDownList($model, 'postavshik',$items) ?>
            <p> Договор №</p>
            <input type="text" name="Dogovor[dogovor_nomer]" placeholder="Договор №.">
            <p>Дата</p>
            <input type="date" name="Dogovor[date]">
            <p>Colums</p>
            <input type="number" id="inputValue" name="columns" placeholder="1" value="1"  style="width: 115px;">
            <button type="button" id="addColumns"><span> Create</span> </button>
        </div>
        <button type="submit" class="button">
            <span>Сохранить</span>
        </button>
        <button class="button">
            <span>Назад</span>
        </button>
    </div>
    <div class="col2" id="columnsDiv">
    </div>
    </form>
</section>


<script type="text/javascript">
    window.onload = function () {

        var buttonAddColumns = document.querySelector('#addColumns');
        var columnsDiv = document.querySelector('#columnsDiv');
        var counter = 0;
        tableCreate();

        buttonAddColumns.addEventListener("click", tableCreate);
        function tableCreate() {
            var columnsDiv = document.querySelector('#columnsDiv');
            columnsDiv.innerHTML = '';
            var inputValue = document.getElementsByName('columns')[0].value
            var body = document.getElementById('columnsDiv');
            var tbl = document.createElement('table');
            tbl.setAttribute('border', '1');
            var tbdy = document.createElement('tbody');
            var tr = document.createElement('tr');
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('Наим. Товара'))
            tr.appendChild(th);
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('Краткое наим'))
            tr.appendChild(th)
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('Ед. изм'))
            tr.appendChild(th)
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('Цена 1'))
            tr.appendChild(th)
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('НДС'))
            tr.appendChild(th)
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('Цена 2'))
            tr.appendChild(th)
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('USD 1'))
            tr.appendChild(th)
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('USD 2'))
            tr.appendChild(th)
            tbdy.appendChild(tr);
            for (var i = 0; i < inputValue; i++) {
                var tr = document.createElement('tr');
                        var td = document.createElement('td');
                        var input = document.createElement('input');
                        input.name = "DogovorTable[tovar][]";
                        input.setAttribute('style', 'width: 100px;');
                        td.appendChild(input);
                        tr.appendChild(td);
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "DogovorTable[kratkoe_naimenovanie][]"
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td)
                tbdy.appendChild(tr);
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "DogovorTable[measure][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td)
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "DogovorTable[cost1][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td)
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "DogovorTable[nds][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td)
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "DogovorTable[cost2][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td)
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "DogovorTable[usd1][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td)
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "DogovorTable[usd2][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td)
            }
            tbl.appendChild(tbdy);
            body.appendChild(tbl)
        }

    }
</script>
