<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RegistrationAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/index2.css',
        'css/main.css',
        'css/bootstrap.css',
        'css/bootstrap-multiselect.css',
    ];
    public $js = [
        'js/jquery.js',
        'js/bootstrap.js',
        'js/bootstrap-multiselect.js',
        'js/main.js',
        'js/xlsx.core.js',
        'js/FileSaver.js',
        'js/tableexport.js',
        'js/Excel.js'

    ];
}
