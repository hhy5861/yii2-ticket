<?php
use yii\helpers\Url;
use cinema\widget\CinemaListWidgt;
?>
<div class="pw_main" id="pw_main">
	<div class="container">
		<form action="<?=Url::toRoute('/cinema/edit')?>" method="post">
		<h4><input type="submit" value="保存" class="submit_btn">上海国际影城</h4>
			<input type="hidden" name="id" value="<?=$data['id']?>">
				<ul class="info">
					<li>
						<div><label>电影院编码：</label><?=$data['code']?></div>
						<div><label>全国编码：</label><?=$data['country_code']?></div>
						<div><label>上报编码：</label><input type="text" name="report_code" value="<?=$data['report_code']?>" class="input_style"></div>
						<div><label>邮政编码：</label><input class="input_style" name="zip_code" type="text" value="<?=$data['zip_code']?>"></div>
					</li>
					<li>
						<div><label>影院地址：</label><input class="input_style1" type="text" name="address" value="<?=$data['address']?>"></div>
						<div><label>联系人：</label><input class="input_style" type="text" name="name" value="<?=$data['name']?>"></div>
						<div><label>联系电话：</label><input class="input_style" type="text" name="telephone" value="<?=$data['telephone']?>"></div>
					</li>
				</ul>
			</form>
		<div class="add_movie_hall">
			<a href="javascript:;" class="add_movie">新增影厅</a>
		</div>
		<?=CinemaListWidgt::widget(['cinema_id' => $data['id']])?>
	</div>
</div>
<!-- 首页主体内容end -->

<!-- 新增影厅弹出strat -->
<div class="add_pop">
	<div class="contetn">
		<h2>新增影厅</h2>
		<ul class="contetn_list">
			<li>
				<!--<div><label>影厅编号：</label>
					<div id="bud">
						<span class="text">001</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="001" selected="">001</option>
							<option value="002">002</option>
							<option value="003">003</option>
							<option value="004">004</option>
						</select>
					</div>
				</div>-->
				<div><label>影厅名称：</label><input type="text" class="name_input"></div>
			</li>
			<li><label>影厅备注：</label><textarea class="remark"></textarea></li>
		</ul>
		<div class="content_btn">
			<a href="javascript:;" class="cancel">取消</a>
			<a href="javascript:;" class="save" onclick="save()">保存</a>
		</div>
	</div>
	<div class="mask"></div>
</div>
<script type="text/javascript">
	var rout = '/cinema/index';
	function save()
	{
		var name = $('.name_input').val();
		if(name == '')
		{
			alert('影厅名称不能为空!')
		}

		var url = '/cinema/screenadd';
		var data = {name        : name,
			        remark      : $('.remark').val(),
			        cinema_id   : <?=$data['id']?>,
			        screen_code : $('#screen_code').val()
		           };

		$.post(url, data, function(result)
		{
			if(result == 0)
			{
				window.location = rout;
			}
		});
	}

	function del(id)
	{
		if(confirm('确定删除影厅吗？'))
		{
			var url = '/cinema/delete';
			$.post(url, {id: id}, function (result)
			{
				if (result == 0)
				{
					window.location = rout;
				}
			})
		}
	}
</script>
