<?
use yii\helpers\Html;
use app\assets\SkladAsset;
use yii\helpers\Url;
SkladAsset::register($this);
$this->registerCssFile('https://handsontable.com/static/css/main.css');
$this->registerCssFile('/css/prixod.css');


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
<form id="form"  name="myForm" onsubmit="return validateForm(event)" method="post" action="rashod">
    <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
<div class="col-md-12">
    <input id="rownumb" value="1" >
    <input type="button" value="Add Row" onclick="addRow();" />
    <table class="colums" id="table">
    </table>
    <button class="send" type="submit"><span>Отправить</span></button>
</div>

</form>
<script>
    window.onload=()=>{addRow()}

    function validateForm(e) {


    e.preventDefault();
    localStorage.removeItem("myKey");
        var form = document.getElementById("form");
        var mfo_empty = false;
        var name_empty = false;
        var schet_empty = false; 
        var id = document.getElementsByName("id[]");
        
        

        for(var key in id)
        {
            if(id[key].value == "" || id[key].value == "Выбрать")
            {
                 mfo_empty = true;
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
