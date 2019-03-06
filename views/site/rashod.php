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
<script>window.onload=()=>{addRow()}</script>