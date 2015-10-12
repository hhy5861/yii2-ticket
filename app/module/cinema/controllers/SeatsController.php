<?php
namespace cinema\controllers;

use yii\web\Controller;

class SeatsController extends Controller
{
	public function init()
	{
		parent::init();
	}

	public function actions()
	{
		return [
		        'index'         => [
			                        'class'             => 'cinema\controllers\action\seats\IndexAction',
					               ],

               ];
	}
}
