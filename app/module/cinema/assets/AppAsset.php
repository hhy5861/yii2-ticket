<?php
namespace cinema\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $baseUrl  = TICKET_STATIC_DOMAIN;

	public $basePath = '@static';

    public $css      = [
			            'css/style.css',
			           ];

    public $js       = [
						'js/jquery.min.js',
	                    'js/js.js'
                       ];

    public $depends  = [
				        /*'yii\web\YiiAsset',
				        'yii\bootstrap\BootstrapAsset',*/
				       ];
}
