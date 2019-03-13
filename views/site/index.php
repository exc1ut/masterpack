<?php

/* @var $this yii\web\View */
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = 'My Yii Application';
?>



<header class="img">
    <div class="container">
        <div class="block-flex">
           <a href="header.html"> <img src="/images/logo.png"  class="rotate-vert-center"></a>
        </div>
    </div>
</header>
<section>
    <div class="col-md-2">

    </div>
    <div class="container">
        <div class="d-flex category">
            <a href="<?= Url::toRoute(['site/registration'])?>">
                <div class="red">
                    <h1> Регистрация поставщика</h1>
                </div>
            </a>
            <a href=""></a>
            <a href="<?= Url::toRoute(['site/registration'])?>">
                <div class="red">
                    <h1>Регистрация клиента</h1>
                </div>
            </a>
            <a href="<?= Url::toRoute(['site/dogovor'])?>">
                <div class="red">
                    <h1>Регистрация договора</h1>
                </div>
            </a>
            <a href="<?= Url::toRoute(['site/sklad'])?>">
                <div class="red">
                    <h1>Склад сырья</h1>
                </div>
            </a>
            <a href="sklad1.html">
                <div class="blue">
                    <h1>Промежуточный склад-1</h1>
                </div>
            </a>
            <a href="#">
                <div class="red">
                    <h1>Промежуточный склад-2</h1>
                </div>
            </a>
            <a href="#">
                <div class="red">
                    <h1>Склад ГП</h1>
                </div>
            </a>
            <a href="#">
                <div class="red">
                    <h1>Склад доп. сырья</h1>
                </div>
            </a>
        </div>
    </div>
</section>



<!--<header class="img">-->
<!--    <div class="container">-->
<!--        <div class="block-flex">-->
<!--            <img src=""  class="rotate-vert-center">-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->
<!--<section>-->
<!--    <div class="container">-->
<!--        <div class="d-flex category">-->
<!--            <a href="--><?//= Url::toRoute(['site/dogovor'])?><!--">-->
<!--                <div class="red">-->
<!--                    <h1> Регистратция договора</h1>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a href="--><?//= Url::toRoute(['site/registration'])?><!--">-->
<!--                <div class="red">-->
<!--                    <h1>Регистратция клиента</h1>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a href="--><?//= Url::toRoute(['site/sklad'])?><!--">-->
<!--                <div class="red">-->
<!--                    <h1>Склад сырья</h1>-->
<!--                </div>-->
<!--            </a>-->
<!---->
<!---->
<!--            <a href="#">-->
<!--                <div class="red">-->
<!--                    <h1>Промежуточный склад-1</h1>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <div class="blue">-->
<!--                    <h1>Промежуточный склад-2</h1>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <div class="red">-->
<!--                    <h1>Склад ГП</h1>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <div class="red">-->
<!--                    <h1>Склад ГП</h1>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <div class="red">-->
<!--                    <h1>Склад допюсырья</h1>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
