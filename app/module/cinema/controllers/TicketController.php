<?php
namespace cinema\controllers;

use yii\web\Controller;

class TicketController extends Controller
{
	public function init()
	{
		parent::init();
	}

	public function actions()
	{
		return [
		        'index'         => [
			                        'class'             => 'cinema\controllers\action\ticket\IndexAction',
					               ],

				'edit'          => [
									'class'             => 'cinema\controllers\action\ticket\EditAction',
								   ],
               ];
	}
}
