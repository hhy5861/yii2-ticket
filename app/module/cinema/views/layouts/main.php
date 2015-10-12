<?php
use yii\helpers\Url;
use yii\helpers\Html;
use cinema\assets\AppAsset;

$view = AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body>
	<?php $this->beginBody() ?>
	<!-- 头部 -->
		<div class="header" id="header">
			<div class="Logon">
				<span class="your_photo"><img src="<?=TICKET_STATIC_DOMAIN?>/img/u2.png"></span>
						<span class="your_state">
							<span>您好xx经理！</span>
							<a class="loginout">退出登录</a>
						</span>
			</div>
			<ul class="menu">
				<li><a href="<?=Url::toRoute('/cinema/index')?>" onclick="setParam(0)">影院管理</a></li>
				<li><a href="<?=Url::toRoute('/showplan/index')?>" onclick="setParam(1)">放映计划</a></li>
				<li><a href="<?=Url::toRoute('/ticket/index')?>" onclick="setParam(2)">票务操作</a></li>
				<li><a href="<?=Url::toRoute('/analysis/index')?>" onclick="setParam(3)">统计分析</a></li>
			</ul>
		</div>
		<div class="login_message"></div>
		<?=$content?>

		<div class="footer" id="footer">
			版权所有：上海菜苗网络科技有限公司 广告热线/传真：021-62370801</br>
			上海市长宁区虹桥路1438号古北国际财富中心二期30层 信息产业部备案/许可证编号： 沪ICP备14043661号</br>
			Copyright©2014 www.caimiao.cn All Rights Reserved.
		</div>
		<script type="text/javascript">
			//导航高亮
			function setParam(n)
			{
				$(".menu li").eq(n).find("a").addClass("on");
			}
		</script>
	<?php $this->endBody()?>
	</body>
</html>
<?php $this->endPage()?>
<script>
	$('.loginout').click(function(){
		$.ajax({
			type:'post',
			url:'/login/out',
			data:{sign:'login_out'},
			dataType:'json',
			success:function(data){
				if(data.status == 200) {
					$('.login_message').html(data.message);
					window.location = data.url;
				} else {
					$('.login_message').html(data.message);
				}
			}
		});
		return false;
	});
</script>
