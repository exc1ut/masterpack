<?
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\SkladAsset;
SkladAsset::register($this);

$this->registerCssFile('/css/bootstrap.css');
$this->registerJsFile('/js/jquery.js');
$this->registerCssFile('/css/main.css');
$this->registerCssFile('/css/ostatok_table.css');
?>
<div class="container">
 <div class="row1">
 	<a href="<?= Url::toRoute(['/'])?>"><img src="/images/logo.png"></a>
 </div>
 <div class="row2">
<select id="chkveg" multiple="multiple">-->
    <? foreach($kn as $key => $item):?>
        <option value="<?=$key?>"><?=$item?></option>
    <? endforeach;?>

</select>
<select id="format" multiple="multiple">-->
    <? foreach($format as $key => $item):?>
        <option value="<?=$key?>"><?=$item?></option>
    <? endforeach;?>

</select>

<input type="date" id="dateTable">
<button class="bt" onclick="showTable();">Add row</button>
</div>
<div >
    <table id="excelTable" border="1">
        <tbody>
        <tr>
        <th>
            Format/Tip
        </th>
        <? foreach ($headers as $header):?>
            <th>
                <?=$header?>
            </th>
        <?endforeach;?>
        <th>
            Total
        </th>
        </tr>
        <? foreach ($rows as $row):?>
        <tr>
             <? foreach ($row as $r):?>
                <td>
                    <?=$r?>
                </td>
            <?endforeach;?>
        </tr>
        <?endforeach;?>
        </tbody>
    </table>
</div>
</div>