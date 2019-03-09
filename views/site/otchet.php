<?
use yii\helpers\Html;
use app\assets\SkladAsset;
use yii\helpers\Url;
SkladAsset::register($this);
$this->registerJsFile('/js/jquery.js');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
$this->registerCssFile('https://handsontable.com/static/css/main.css');
$this->registerCssFile('/css/schetprixod.css');
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
<div class="col-md-12">
    <table class="colums" id="dateTable">
        <tr>
            <div class="q">
                <p>Поставшик</p>
            </div>
            <div class="q1">
                <p>Дата(От)</p>
            </div>
            <div class="q2">
                <p>Дата(до)</p>
            </div>
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

</div>
<div>
    <table id="table" class="table">

    </table>
</div>




<?// if($model_name == "ostatok"):?>
<!--        <a href="--><?//=Url::toRoute('table')?><!--"><button> Change view to table</button></a>-->
<!--    --><?// endif;?>
<!--</div>-->