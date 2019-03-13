<?
use yii\helpers\Html;
use app\assets\SkladAsset;
use yii\helpers\Url;
SkladAsset::register($this);
$this->registerCssFile('https://handsontable.com/static/css/main.css');
$this->registerCssFile('/css/prixod.css');


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
<form action="rashod" method="post">
    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<div class="col-md-12">
    <input id="rownumb" value="1" >
    <input type="button" value="Add Row" onclick="addRow();" />
    <table class="colums" id="table">
    </table>
    <button class="send" type="submit"><span>Отправить</span></button>
</div>

</form>
<script>window.onload=()=>{addRow()}</script>





<!--<input id="rownumb" value="1" >-->
<!--<button onclick="addRow();">Add row</button>-->
<!--<div >-->
<!--    <form action="rashod" method="post">-->
<!--        --><?//=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<!--        <table id="table" border="1">-->
<!--        </table>-->
<!--        <button type="submit">Submit</button>-->
<!--    </form>-->
<!--</div>-->
<!--<script>window.onload=()=>{addRow()}</script>-->