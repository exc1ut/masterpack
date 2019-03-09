<?php

use app\assets\PublicAsset;
use yii\helpers\Html;
use yii\helpers\Url;
PublicAsset::register($this);
$this->registerCssFile('/css/index2.css');
?>

<div class="navbar">
    <img src="/images/logo.png">
    <a href="<?= Url::toRoute(['site/dogovor'])?>">Рег.дог</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.поставшика</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.клиента</a>
    <a href="<?= Url::toRoute(['site/sklad'])?>">Склад сырья</a>
    <a href="lala.html">Склад-1</a>
    <a href="">Склад-2</a>
    <a href="">Склад ГП</a>
    <a href="">Склад допюсырья</a>
</div>
<form method="post" action="registration">
    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<div class="container">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-3">
            <p>Имя</p>
            <input type="text" name="ClientRegistration[name]">
            <p>Адрес</p>
            <input type="text" name="ClientRegistration[address]">
            <p>ИНН</p>
            <input type="number" name="ClientRegistration[inn]">
            <p>ОКЭД</p>
            <input type="number" name="ClientRegistration[oked]">
            <p></p>
            <input type="button" value="Добавить счёт" onclick="addRow('dateTable')"/>
            <button class="button" type="submit">
                <span>Сохранить</span>
            </button>
            <button class="button">
                <span>Назад</span>
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
<!--<form method="post" action="registration">-->
<!--    --><?//=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<!--<section>-->
<!---->
<!--    <div class="col1">-->
<!--        <div class="d-flex">-->
<!--            <p>Имя</p>-->
<!--            <input type="text" name="ClientRegistration[name]">-->
<!--            <p>Адрес</p>-->
<!--            <input type="text" name="ClientRegistration[address]">-->
<!--            <p>ИНН</p>-->
<!--            <input type="number" name="ClientRegistration[inn]">-->
<!--            <p>ОКЭД</p>-->
<!--            <input type="number" name="ClientRegistration[oked]">-->
<!---->
<!--            <input type="number" name="columns" placeholder="1" value="1" style="width: 115px;">-->
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
<!--</section>-->
<!--</form>-->
<!---->
<!--<script type="text/javascript">-->
<!--    window.onload = function () {-->
<!---->
<!--        var buttonAddColumns = document.querySelector('#addColumns');-->
<!--        var columnsDiv = document.querySelector('#columnsDiv');-->
<!--        var counter = 0;-->
<!--        tableCreate();-->
<!--        buttonAddColumns.addEventListener("click", tableCreate);-->
<!--        function tableCreate() {-->
<!--            var columnsDiv = document.querySelector('#columnsDiv');-->
<!--            columnsDiv.innerHTML = '';-->
<!--            var inputValue = document.getElementsByName('columns')[0].value-->
<!--            var body = document.getElementById('columnsDiv');-->
<!--            var tbl = document.createElement('table');-->
<!--            tbl.style.width = '100%';-->
<!--            tbl.setAttribute('border', '1');-->
<!--            var tbdy = document.createElement('tbody');-->
<!--            var tr = document.createElement('tr');-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('Банк '))-->
<!--            tr.appendChild(th);-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('МФО '))-->
<!--            tr.appendChild(th)-->
<!--            var th = document.createElement('th');-->
<!--            th.appendChild(document.createTextNode('Счёт'))-->
<!--            tr.appendChild(th)-->
<!--            tbdy.appendChild(tr);-->
<!--            for (var i = 0; i < inputValue; i++) {-->
<!--                var tr = document.createElement('tr');-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "PostavshikBank[bank_name][]"-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td);-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "PostavshikBank[bank_mfo][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td);-->
<!--                var td = document.createElement('td');-->
<!--                var input = document.createElement('input');-->
<!--                input.name = "PostavshikBank[schet][]";-->
<!--                input.setAttribute('style', 'width: 100px;');-->
<!--                td.appendChild(input);-->
<!--                tr.appendChild(td);-->
<!--                tbdy.appendChild(tr);-->
<!--            }-->
<!--            tbl.appendChild(tbdy);-->
<!--            body.appendChild(tbl)-->
<!--        }-->
<!---->
<!--    }-->
<!--</script>-->
</form>
<script>
    function addRow(tableID) {

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