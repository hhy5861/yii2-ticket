<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/24/15
 * Time: 14:17
 */
namespace cinema\controllers\action\showplan;

use Yii;
use yii\base\Action;

class IndexAction extends Action
{
	public function run()
	{
		$params[':cinema_id']    = 1;
		$params[':publish_date'] = strtotime(date('Y-m-d'));
		$condition = 'b.publish_date > :publish_date AND a.cinema_id = :cinema_id AND a.valid = 0';

		$cls = Yii::createObject(['class'   => 'cinema\business\showplan\MShowPlan',
								  'columns' => ['b.name','a.*']
							     ]);

		$data = $cls->getShowPlanList($condition,$params,true);

		return $this->controller->render('index', ['data' => $data]);
	}
}