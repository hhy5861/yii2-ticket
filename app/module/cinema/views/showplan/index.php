<?php
use cinema\widget\CinemaOptionWidgt;
if($data)
{
	$html = '';
	$currentTime = strtotime(date('Y-m-d'));

	/** @var TYPE_NAME $data */
	for($v = 0; $v < count($data); $v++)
	{
		if($data[$v]['business_time'] >= $currentTime)
		{
			$str = '未售';
		}
		else if($data[$v]['business_time'] <= $currentTime)
		{
			$str = '开售';
		}
		else
		{
			$str = '截止';
		}

		$html .= '<tr>';
		$html .= '<td>'.$data[$v]['code'].'</td>';
		$html .= '<td>'.$data[$v]['name'].'</td>';
		$html .= '<td>'.$str.'</td>';
		$html .= '<td>'.$data[$v]['business_time'].'</td>';
		$html .= '<td>';
		$html .= '<a class="plan_view blue">查看</a>';
		$html .= '<a class="plan_alter">修改</a>';
		$html .= '<a class="plan_delete">删除</a>';
        $html .= '</td>';
		$html .= '</tr>';
	}
}
?>
<div class="plan_main" id="plan_main">
	<div class="container">
		<div class="new_plan_wrap"><a href="#" class="new_plan">新增计划</a></div>
		<div class="plan_list">
			<p class="title">映出计划列表：</p>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th>映出计划编码</th>
					<th>电影</th>
					<th>状态</th>
					<th>日期</th>
					<th>操作</th>
				</tr>
				<?=$html?>
			</table>
		</div>
	</div>
</div>
<!-- 放映计划end -->


<!-- 新增计划弹出start -->
<div class="edit_pop" id="edit_pop">
	<div class="content" id="content">
		<h2>新增计划</h2>
		<div class="edit_list">
			<ul>
				<li><div><label>影片：</label>
						<div id="bud" class="bud">
							<span class="text">001</span>
							<?=CinemaOptionWidgt::widget(['selected' => ''])?>
						</div>
					</div>
					<div><label>放映拷贝：</label>
						<div id="bud" class="bud">
							<span class="text">001</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="001" selected="">001</option>
								<option value="002">002</option>
								<option value="003">003</option>
								<option value="004">004</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<div><label>日期：</label><input type="text" class="name_input" value="2015-01-20"></div>
					<div><label>影院：</label><input type="text" class="name_input" value="上海国际影城"></div>
				</li>
				<li>
					<div><label>影厅：</label><input type="text" class="name_input" value="2号影厅"></div>
					<div><label>票价精度：</label>
						<div id="bud" class="bud">
							<span class="text">001</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="001" selected="">001</option>
								<option value="002">002</option>
								<option value="003">003</option>
								<option value="004">004</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<div><label>是否对号入座：</label>
						<div id="bud" class="bud">
							<span class="text">是</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="是" selected="">是</option>
								<option value="否">否</option>
							</select>
						</div>
					</div>
					<div><label>票面版式：</label>
						<div id="bud" class="bud">
							<span class="text">正常</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="正常" selected="">正常</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<div><label>映出时间：</label>
						<div id="bud" class="bud">
							<span class="text">2015-6-30</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="2015-6-30" selected="">2015-6-30</option>
								<option value="2015-7-20">2015-7-20</option>
							</select>
						</div>
					</div>
					<div>
						<label>座位总数：</label><input type="text" value="234" class="name_input" disabled>
					</div>
				</li>
				<li>
					<label>座类：</label>
					<div id="bud" class="bud">
						<span class="text">间隔</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="间隔" selected="">间隔</option>
							<option value="紧凑">紧凑</option>
						</select>
					</div>
					<div id="bud" class="bud">
						<span class="text">02</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="02" selected="">02</option>
							<option value="03">03</option>
						</select>
					</div>
					<input type="text" class="name_input1">
					<span>元</span>
					<span class="add_icon">+</span>
				</li>
				<li>
					<label>放映计划：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
					<a href="#" class="add_movie1">加入影片</a>
				</li>
				<li>
					<div>
						<label>租金：</label>
						<div id="bud" class="bud">
							<span class="text">1200</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="1200" selected="">1200</option>
								<option value="1400">1400</option>
							</select>
						</div>
					</div>
					<div>
						<label>上缴比例：</label>
						<div id="bud" class="bud">
							<span class="text">10%</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="10%" selected="">10%</option>
								<option value="20%">20%</option>
							</select>
						</div>
					</div>
				</li>
			</ul>
			<!--加入影片弹出-->
			<div class="movie1_pop">
				<i class="arrow_up"><img src="img/arrow_up.png"></i>
				<div class="row">
					<label>选择影片：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
				</div>
				<div class="row">
					<label>放映时间：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
				</div>
				<div class="btns_1">
					<a href="#" class="movie_cancel">取消</a>
					<a href="#" class="movie_save">保存</a>
				</div>
			</div>
		</div>

		<div class="plan_btns">
			<a href="#" class="plan_cancel">取消</a>
			<a href="#" class="plan_save">保存</a>
		</div>
	</div>
	<div class="mask"></div>
</div>
<!-- 新增计划弹出end -->

<!-- 修改计划弹出strat -->
<div class="edit_pop" id="edit_pop1">
	<div class="content" id="content1">
		<h2>修改计划</h2>
		<div class="edit_list">
			<ul>
				<li><div><label>影片：</label>
						<div id="bud" class="bud">
							<span class="text">001</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="001" selected="">001</option>
								<option value="002">002</option>
								<option value="003">003</option>
								<option value="004">004</option>
							</select>
						</div>
					</div>
					<div><label>放映拷贝：</label>
						<div id="bud" class="bud">
							<span class="text">001</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="001" selected="">001</option>
								<option value="002">002</option>
								<option value="003">003</option>
								<option value="004">004</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<div><label>日期：</label><input type="text" class="name_input" disabled value="2015-01-20"></div>
					<div><label>影院：</label><input type="text" class="name_input" disabled value="上海国际影城"></div>
				</li>
				<li>
					<div><label>影厅：</label><input type="text" class="name_input" disabled value="2号影厅"></div>
					<div><label>票价精度：</label>
						<div id="bud" class="bud">
							<span class="text">001</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="001" selected="">001</option>
								<option value="002">002</option>
								<option value="003">003</option>
								<option value="004">004</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<div><label>是否对号入座：</label>
						<div id="bud" class="bud">
							<span class="text">是</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="是" selected="">是</option>
								<option value="否">否</option>
							</select>
						</div>
					</div>
					<div><label>票面版式：</label>
						<div id="bud" class="bud">
							<span class="text">正常</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="正常" selected="">正常</option>
							</select>
						</div>
					</div>
				</li>
				<li>
					<div><label>映出时间：</label>
						<div id="bud" class="bud">
							<span class="text">2015-6-30</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="2015-6-30" selected="">2015-6-30</option>
								<option value="2015-7-20">2015-7-20</option>
							</select>
						</div>
					</div>
					<div>
						<label>座位总数：</label><input type="text" value="234" class="name_input" disabled>
					</div>
				</li>
				<li>
					<label>座类：</label>
					<div id="bud" class="bud">
						<span class="text">间隔</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="间隔" selected="">间隔</option>
							<option value="紧凑">紧凑</option>
						</select>
					</div>
					<div id="bud" class="bud">
						<span class="text">01</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="01" selected="">01</option>
							<option value="02">02</option>
						</select>
					</div>
					<input type="text" class="name_input1">
					<span>元</span>
					<span class="add_icon">+</span>
				</li>
				<li>
					<label>放映计划：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
					<a href="#" class="add_movie1">加入影片</a>
				</li>
				<li>
					<div>
						<label>租金：</label>
						<div id="bud" class="bud">
							<span class="text">1200</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="1200" selected="">1200</option>
								<option value="1400">1400</option>
							</select>
						</div>
					</div>
					<div>
						<label>上缴比例：</label>
						<div id="bud" class="bud">
							<span class="text">10%</span>
							<select name="select" id="budget" class="SelectBox">
								<option value="10%" selected="">10%</option>
								<option value="20%">20%</option>
							</select>
						</div>
					</div>
				</li>
			</ul>
			<!--加入影片弹出-->
			<div class="movie1_pop">
				<i class="arrow_up"><img src="img/arrow_up.png"></i>
				<div class="row">
					<label>选择影片：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
				</div>
				<div class="row">
					<label>放映时间：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
				</div>
				<div class="btns_1">
					<a href="#" class="movie_cancel">取消</a>
					<a href="#" class="movie_save">保存</a>
				</div>
			</div>
		</div>

		<div class="plan_btns">
			<a href="#" class="plan_cancel">取消</a>
			<a href="#" class="plan_save">保存</a>
		</div>
	</div>
	<div class="mask"></div>
</div>
<!-- 修改计划弹出end -->

<!-- 设置弹出strat -->
<div class="edit_pop" id="edit_pop2">
	<div class="content" id="content2">
		<h2>设置</h2>
		<div class="edit_list">
			<ul>
				<li><div><label>影片：</label>
						<input type="text" class="name_input" disabled value="生化危机">
					</div>
					<div><label>放映拷贝：</label>
						<input type="text" class="name_input" disabled value="生化危机">
					</div>
				</li>
				<li>
					<div><label>日期：</label><input type="text" class="name_input" disabled value="2015-01-20"></div>
					<div><label>影院：</label><input type="text" class="name_input" disabled value="上海国际影城"></div>
				</li>
				<li>
					<div><label>影厅：</label><input type="text" class="name_input" disabled value="2号影厅"></div>
					<div><label>票价精度：</label>
						<input type="text" class="name_input" disabled value="票价精度">
					</div>
				</li>
				<li>
					<div><label>是否对号入座：</label>
						<input type="text" class="name_input" disabled value="是">
					</div>
					<div><label>票面版式：</label>
						<input type="text" class="name_input" disabled value="正常">
					</div>
				</li>
				<li>
					<div><label>映出时间：</label>
						<input type="text" class="name_input" disabled value="2015-7-2">
					</div>
					<div>
						<label>座位总数：</label><input type="text" value="234" class="name_input" disabled>
					</div>
				</li>
				<li>
					<label>座类：</label>
					<input type="text" class="name_input" disabled value="紧凑">
					<input type="text" class="name_input" disabled value="01">
					<input type="text" class="name_input1" disabled value="128">
					<span>元</span>
					<span class="add_icon1">+</span>
				</li>
				<li>
					<label>放映计划：</label>
					<input type="text" value="计划" class="name_input" disabled>
					<a href="#" class="add_movie1">加入影片</a>
				</li>
				<li>
					<div>
						<label>租金：</label>
						<input type="text" value="1200" class="name_input" disabled>
					</div>
					<div>
						<label>上缴比例：</label>
						<input type="text" value="20%" class="name_input" disabled>
					</div>
				</li>
			</ul>
			<!--加入影片弹出-->
			<div class="movie1_pop">
				<i class="arrow_up"><img src="img/arrow_up.png"></i>
				<div class="row">
					<label>选择影片：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
				</div>
				<div class="row">
					<label>放映时间：</label>
					<div id="bud" class="bud">
						<span class="text">是</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="是" selected="">是</option>
							<option value="否">否</option>
						</select>
					</div>
				</div>
				<div class="btns_1">
					<a href="#" class="movie_cancel">取消</a>
					<a href="#" class="movie_save">保存</a>
				</div>
			</div>
		</div>

		<div class="plan_btns">
			<a href="#" class="plan_cancel plan_cancel_s">取消</a>
			<a href="#" class="plan_save">保存</a>
		</div>
	</div>
	<div class="mask"></div>
</div>
<!-- 设置弹出end -->

<!-- 查看弹出strat -->
<div class="edit_pop" id="edit_pop3" ><!--style="display:block; top:50%"-->
	<div class="content" id="content3">
		<h2>查看</h2>
		<div class="edit_list">
			<table class="view_box" width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="45">影片：</td>
					<td height="45">生化危机</td>
					<td height="45">001放映拷贝：</td>
					<td height="45">001</td>
				</tr>
				<tr>
					<td height="45">日期：</td>
					<td height="45">2015-7-2</td>
					<td height="45">影院：</td>
					<td height="45">上海国际影城</td>
				</tr>
				<tr>
					<td height="45">影厅：</td>
					<td height="45">2号影厅</td>
					<td height="45">票价精度：</td>
					<td height="45">20%</td>
				</tr>
				<tr>
					<td height="45">是否对号入座：</td>
					<td height="45">是</td>
					<td height="45">是票面版式：</td>
					<td height="45">正常</td>
				</tr>
				<tr>
					<td height="45">映出时间：</td>
					<td height="45">2015-6-30</td>
					<td height="45">座位总数：</td>
					<td height="45">236</td>
				</tr>
				<tr>
					<td height="45">座类：</td>
					<td height="45" colspan="3">间隔 <span style=" padding-left:30px;">01</span> <span style=" padding-left:30px;">元</span></td>

				</tr>
				<tr>
					<td height="45">放映计划：</td>
					<td height="45" colspan="3">是</td>
				</tr>
				<tr>
					<td height="45">租金：</td>
					<td height="45">1200</td>
					<td height="45">上缴比例：</td>
					<td height="45">10%</td>
				</tr>
			</table>
		</div>

		<div class="plan_btns">
			<a href="#" class="plan_cancel plan_cancel_c" style="width:300px">取消</a>
		</div>
	</div>
	<div class="mask"></div>
</div>
<!-- 查看弹出end -->