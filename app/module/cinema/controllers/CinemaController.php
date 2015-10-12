<?php
namespace cinema\controllers;

use cinema\components\BaseController as Controller;

class CinemaController extends Controller
{
	public function init()
	{
		parent::init();
	}

	public function actions()
	{
		return [
		        'index'         => [
			                        'class'             => 'cinema\controllers\action\cinema\IndexAction',
					               ],

				'edit'          => [
									'class'             => 'cinema\controllers\action\cinema\EditAction',
								   ],

				'delete'        => [
									'class'             => 'cinema\controllers\action\cinema\ScreenDelAction',
								   ],

				'screenadd'     => [
							        'class'             => 'cinema\controllers\action\cinema\ScreenAddAction',
							       ],
               ];
	}
}
