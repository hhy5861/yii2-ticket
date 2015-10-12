<?php
namespace cinema\controllers;

use yii\web\Controller;

class ShowplanController extends Controller
{
	public function init()
	{
		parent::init();
	}

	public function actions()
	{
		return [
		        'index'         => [
			                        'class'             => 'cinema\controllers\action\showplan\IndexAction',
					               ],

				'edit'          => [
									'class'             => 'cinema\controllers\action\showplan\EditAction',
								   ],
               ];
	}
}
