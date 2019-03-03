<?
use yii\helpers\Html;
use app\assets\SkladAsset;
SkladAsset::register($this);
?>
<input id="rownumb" value="1" >
<button onclick="addRow();">Add row</button>
<div >
    <table id="table" border="1">
    </table>
</div>