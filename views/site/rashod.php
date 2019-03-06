<?
use yii\helpers\Html;
use app\assets\SkladAsset;
SkladAsset::register($this);
?>
<input id="rownumb" value="1" >
<button onclick="addRow();">Add row</button>
<div >
    <form action="rashod" method="post">
        <?=Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
        <table id="table" border="1">
        </table>
        <button type="submit">Submit</button>
    </form>
</div>
<div class="table">
    <table>
<tr>
    <th>Id</th>
    <th>Поставщик</th>
    <th>Договор</th>
    <th>Номер счет фактуры</th>
    <th>Тип</th>
    <th>Вес</th>
    <th>Формат</th>
    <th>Дата</th>
    <th>Время</th>
    <? foreach($items as $item):?>
    <tr>
        <td><?=$item["id"]?></td>
        <td><?=$item["postavshik"]?></td>
        <td><?=$item["dogovor_nomer"]?> от <?=$item["dogovor_date_ru"]?></td>
        <td><?=$item["schet_factura_noemer"]?></td>
        <td><?=$item["tip"]?></td>
        <td><?=$item["ves"]?></td>
        <td><?=$item["format"]?></td>
        <td><?=$item["dater"]?></td>
        <td><?=$item["time"]?></td>

    </tr>
<?  endforeach; ?>
</tr>
        </table>
    </div>