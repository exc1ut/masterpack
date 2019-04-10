<?
use yii\helpers\Html;
use app\assets\SkladAsset;
use yii\helpers\Url;
SkladAsset::register($this);
$this->registerJsFile('/js/jquery.js');
$this->registerCssFile('https://handsontable.com/static/css/main.css');
$this->registerCssFile('/css/schetprixod.css');
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
<div class="col-md-2">
    
</div>
<div class="col-md-8">
    <table class="colums" id="dateTable">
        <tr>
           <th>
                <p>Поставшик</p>
            </th>
            <th>
                <p>Дата(От)</p>
            </th>
            <th>
                <p>Дата(до)</p>
            </th>
        </tr>
        <tr>
            <td>
                <select id="chkveg" multiple="multiple">-->
                                <? foreach($items as $key => $item):?>
                                <option value="<?=$key?>"><?=$item?></option>
                                <? endforeach;?>

                            </select>
            </td>

            <td>
                <input id="start_date" type="date" />
            </td>
            <td>
                 <input id="end_date" type="date" />
            </td>
        </tr>
    </table>
    <button class="send" onclick="addOtchet('<?=$model_name?>')"><span>Синхронизовать</span></button>
    <? if($model_name == "ostatok"):?>
       <a href="<?=Url::toRoute('site/table')?>"><button> Change view to table</button></a>-->
   <? endif;?>
</div>
<div class="col-md-2">
    
</div>

</div>
<div>
<table id="table" class="table">

</table>
</div>
