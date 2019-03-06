<?
use yii\helpers\Html;
use app\assets\SkladAsset;
SkladAsset::register($this);
$this->registerJsFile('/js/jquery.js');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
?>


<body>

<form id="form1">

    <div style="padding:20px">

        <select id="chkveg" multiple="multiple">
            <? foreach($items as $key => $item):?>
            <option value="<?=$key?>"><?=$item?></option>
            <? endforeach;?>

        </select>
        <input id="start_date" type="date" />
        <input id="end_date" type="date" />

    </div>

</form>

</body>
</html>


<button onclick="addOtchet('<?=$model_name?>');">Add row</button>
<div >
    <table id="table" border="1">
    </table>
</div>