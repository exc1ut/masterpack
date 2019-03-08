<?
use yii\helpers\Html;
use app\assets\SkladAsset;
SkladAsset::register($this);
?>
<?= Html::activeDropDownList($model, 'id',$kn,[
'id'=>'tip',
'prompt'=>'Select',
]) ?>
<?= Html::activeDropDownList($model, 'id',$format,[
'id'=>'format',
'prompt'=>'Select',
]) ?>
<input type="date" id="dateTable">
<button onclick="showTable();">Add row</button>
<div >
    <table id="table" border="1">
    </table>
</div>