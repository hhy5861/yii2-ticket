<?php
namespace cinema\controllers;

use yii\web\Controller;

class AnalysisController extends Controller
{
	public function init()
	{
		parent::init();
	}

	public function actions()
	{
		return [
		        'index'         => [
			                        'class'             => 'cinema\controllers\action\analysis\IndexAction',
					               ],

				'edit'          => [
									'class'             => 'cinema\controllers\action\analysis\EditAction',
								   ],
               ];
	}
}
