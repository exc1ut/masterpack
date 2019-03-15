<?
use yii\helpers\Html;
use yii\helpers\Url;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/handsontable-pro@latest/dist/handsontable.full.min.css');
$this->registerCssFile('https://handsontable.com/static/css/main.css');
$this->registerCssFile('/css/otchet.css');

?>


<div class="navbar">
    <a href="<?= Url::toRoute(['site/dogovor'])?>">Рег.дог</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.поставшика</a>
    <a href="<?= Url::toRoute(['site/registration'])?>">Рег.клиента</a>
    <a href="<?= Url::toRoute(['site/sklad'])?>">Склад сырья</a>
    <a href="lala.html">Склад-1</a>
    <a href="">Склад-2</a>
    <a href="">Склад ГП</a>
    <a href="">Склад допюсырья</a>
</div>
<section>
    <div class="container">
        <div class="block-flex">
            <a href="header.html"> <img src="/images/logo.png"></a>
        </div>
    </div>
</section>
<section>
    <div class="blocks">
        <a href="<?= Url::toRoute(['/site/prihodpage'])?>">
            <button class="button">
                <span>Приход</span>
            </button>
        </a>
        <a href="<?= Url::toRoute(['/site/rashodpage'])?>">
            <button class="button">
                <span>Расход</span>
            </button>
        </a>
        <a href="<?= Url::toRoute(['/site/table'])?>">
            <button class="button">
                <span>Остаток</span>
            </button>
        </a>
    </div>
</section>
<table id="excelTable">
        <tr>
            <th>Id</th>
            <th>Поставшик</th>
            <th>Номер дата договора</th>
            <th>Номер счет-фактуры</th>
            <th>Тип</th>
            <th>Вес</th>
            <th>Формат</th>
            <th>Дата</th>
            <th>Время</th>
        </tr>
        <?if($ostatok !== null):?>
                    <? foreach($ostatok as $ok):?>
                        <tr>
                            <td><?=$ok["id"]?></td>
                            <td><?=$ok["postavshik"]?></td>
                            <td><?=$ok["dogovor_nomer"]?> от <?=$ok["dogovor_date_ru"]?></td>
                            <td><?=$ok["schet_factura_noemer"]?>  от <?=$ok["dates"]?></td>
                            <td><?=$ok["tip"]?></td>
                            <td><?=$ok["ves"]?></td>
                            <td><?=$ok["format"]?></td>
                            <td><?=$ok["dater"]?></td>
                            <td><?=$ok["time"]?></td>

                        </tr>
                    <?  endforeach; ?>
                <? endif;?>
                <?if($rashod !== null):?>
                    <? foreach($rashod as $rh):?>
                        <tr>
                            <td><?=$rh["id"]?></td>
                            <td><?=$rh["postavshik"]?></td>
                            <td><?=$rh["dogovor_nomer"]?> от <?=$rh["dogovor_date_ru"]?></td>
                            <td><?=$rh["schet_factura_noemer"]?> от <?=$rh["dates"]?></td>
                            <td><?=$rh["tip"]?></td>
                            <td><?=$rh["ves"]?></td>
                            <td><?=$rh["format"]?></td>
                            <td><?=$rh["dater"]?></td>
                            <td><?=$rh["time"]?></td>

                        </tr>
                    <?  endforeach; ?>
                <? endif;?>
                <?if($prihod !== null):?>
                    <? foreach($prihod as $pr):?>
                        <tr>
                            <td><?=$pr["id"]?></td>
                            <td><?=$pr["postavshik"]?></td>
                            <td><?=$pr["dogovor_nomer"]?> от <?=$pr["dogovor_date_ru"]?></td>
                            <td><?=$pr["schet_factura_noemer"]?>  от <?=$pr["dates"]?></td>
                            <td><?=$pr["tip"]?></td>
                            <td><?=$pr["ves"]?></td>
                            <td><?=$pr["format"]?></td>
                            <td><?=$pr["dater"]?></td>
                            <td><?=$pr["time"]?></td>

                        </tr>
                    <?  endforeach; ?>
                <? endif;?>
    </table>


<!--<a href="--><?//=Url::toRoute(['prihodpage'])?><!--"><p>Приход</p></a>-->
<!--<a href="--><?//=Url::toRoute(['rashodpage'])?><!--"><p>Расход</p></a>-->
