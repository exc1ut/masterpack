<?
use yii\helpers\Html;
use app\assets\PrihodAsset;
use yii\helpers\Url;
PrihodAsset::register($this);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/handsontable-pro@latest/dist/handsontable.full.min.css');
$this->registerCssFile('https://handsontable.com/static/css/main.css');
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
            <a href="header.html"> <img src="logo.png"></a>
        </div>
    </div>
</section>
<section>
    <div class="blocks">
        <a href="<?= Url::toRoute(['/site/prihodpage'])?>">
            <button class="button">
                <span>Остаток</span>
            </button>
        </a>
        <a href="<?= Url::toRoute(['/site/rashodpage'])?>">
            <button class="button">
                <span>Остаток</span>
            </button>
        </a>
        <a href="<?= Url::toRoute(['/site/ostatok'])?>">
            <button class="button">
                <span>Остаток</span>
            </button>
        </a>
    </div>
</section>



<!--<a href="--><?//=Url::toRoute(['prihodpage'])?><!--"><p>Приход</p></a>-->
<!--<a href="--><?//=Url::toRoute(['rashodpage'])?><!--"><p>Расход</p></a>-->
