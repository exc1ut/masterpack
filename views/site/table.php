<?
use yii\helpers\Html;
use app\assets\SkladAsset;
SkladAsset::register($this);
$this->registerJsFile('/js/jquery.js');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
?>



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
<button onclick="showTable();">Add row</button>
<div >
    <table id="table" border="1">
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