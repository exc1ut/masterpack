<?
use yii\helpers\Html;
use app\assets\SkladAsset;
use yii\helpers\Url;
SkladAsset::register($this);
$this->registerJsFile('/js/jquery.js');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
?>



<a href="<?=Url::toRoute(['prihodpage'])?>"><p>Приход</p></a>
<a href="<?=Url::toRoute(['rashodpage'])?>"><p>Расход</p></a>
