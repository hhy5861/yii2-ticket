<?php
namespace cinema\controllers;

use cinema\components\BaseController as Controller;

class LoginController extends Controller
{
	public function init()
	{
		parent::init();
	}

	public function actions()
	{
		return [
		        'index'         => [
			                        'class'             => 'cinema\controllers\action\login\IndexAction',
					               ],
				'out'         => [
									'class'             => 'cinema\controllers\action\login\OutAction',
									],
               ];
	}
}
