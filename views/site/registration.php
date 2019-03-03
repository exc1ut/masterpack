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
<form method="post" action="registration">
    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<section>

    <div class="col1">
        <div class="d-flex">
            <p>Имя</p>
            <input type="text" name="ClientRegistration[name]">
            <p>Адрес</p>
            <input type="text" name="ClientRegistration[address]">
            <p>ИНН</p>
            <input type="number" name="ClientRegistration[inn]">
            <p>ОКЭД</p>
            <input type="number" name="ClientRegistration[oked]">

            <input type="number" name="columns" placeholder="1" value="1" style="width: 115px;">
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
</section>
</form>

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
            tbl.style.width = '100%';
            tbl.setAttribute('border', '1');
            var tbdy = document.createElement('tbody');
            var tr = document.createElement('tr');
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('Банк '))
            tr.appendChild(th);
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('МФО '))
            tr.appendChild(th)
            var th = document.createElement('th');
            th.appendChild(document.createTextNode('Счёт'))
            tr.appendChild(th)
            tbdy.appendChild(tr);
            for (var i = 0; i < inputValue; i++) {
                var tr = document.createElement('tr');
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "PostavshikBank[bank_name][]"
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td);
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "PostavshikBank[bank_mfo][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td);
                var td = document.createElement('td');
                var input = document.createElement('input');
                input.name = "PostavshikBank[schet][]";
                input.setAttribute('style', 'width: 100px;');
                td.appendChild(input);
                tr.appendChild(td);
                tbdy.appendChild(tr);
            }
            tbl.appendChild(tbdy);
            body.appendChild(tbl)
        }

    }
</script>
