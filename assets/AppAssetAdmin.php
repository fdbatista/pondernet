<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
use Yii;

class AppAssetAdmin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/assets/sitio/css/site.css',
        '/assets/sitio/css/file-tree.css',
        '/assets/sitio/css/style-metronic.css',
        '/assets/sitio/css/style.css',
        '/assets/sitio/css/style-responsive.css',
        '/assets/sitio/font-awesome/css/font-awesome.min.css',
        '/assets/sitio/typeahead/typeahead-styles.css',
    ];
    
    public $js = [
        '/assets/sitio/js/php_file_tree_jquery.js',
        '/assets/sitio/js/ie10-viewport-bug-workaround.js',
        '/assets/sitio/js/jquery.validate.js',
        '/assets/sitio/typeahead/typeahead.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
