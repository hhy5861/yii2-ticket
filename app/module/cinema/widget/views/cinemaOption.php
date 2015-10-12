<?php
$html = '<select name="select" id="budget" class="SelectBox">';
if($data)
{
	foreach($data as $v)
	{
		if($v['id'] == $selected) $selected = 'selected';
		$html .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['name'].'</option>';
	}
}
$html .= '</select>';
echo $html;