<?php
use yii\helpers\Url;
$html   = '';
$screen = 0;
if($data)
{
	for($i=0; $i < count($data); $i++)
	{
		if($screen < $data[$i]['screen_code'])
		{
			$screen = $data[$i]['screen_code'];
		}

		$html .= '<tr>';
        $html .= '<td>'.$data[$i]['screen_code'].'</td>';
        $html .= '<td>'.$data[$i]['name'].'</td>';
        $html .= '<td><a class="view">查看</a><a class="add_area" href="'.Url::toRoute('/seats/index').'">新增片区</a><a class="delete" onclick="del('.$data[$i]['id'].')">删除</a></td>';
        $html .= '</tr>';
	}
}
$screen++;
?>
<div class="add_list">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<input type="hidden" value="<?=$screen?>" id="screen_code">
		<tr>
			<th>影厅编号</th>
			<th>影厅名称</th>
			<th width="510">操作</th>
		</tr>
		<?=$html?>
	</table>
</div>