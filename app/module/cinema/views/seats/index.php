<?php
$this->registerCssFile(TICKET_STATIC_DOMAIN . '/css/initSeat.css');
$this->registerCssFile(TICKET_STATIC_DOMAIN . '/css/jquery.minicolors.css');
$this->registerCssFile(TICKET_STATIC_DOMAIN .'/vendor/jquery-ui-1.11.4/jquery-ui.css');

$this->registerJsFile(TICKET_STATIC_DOMAIN .'/js/jquery-1.11.1.min.js');
$this->registerJsFile(TICKET_STATIC_DOMAIN .'/vendor/jquery-ui-1.11.4/jquery-ui.js');
$this->registerJsFile(TICKET_STATIC_DOMAIN .'/js/draggabilly.pkgd.js');
$this->registerJsFile(TICKET_STATIC_DOMAIN .'/js/initSeat.js');
$this->registerJsFile(TICKET_STATIC_DOMAIN .'/js/jquery.minicolors.js');
?>
<script type="text/javascript">
	$(function () {
		$(".SelectBox").on('change', function () {
			$(this).triggerHandler('seat-change', true);
		});
		$(".SelectBox").on('seat-change', function (ev, showText) {
			var str;
			if (showText) {
				str = $(this).find("option:selected").text();
			} else {
				str = $(this).find("option:selected").val();
				$('#budText').find(':text').val(str);
			}
			$(this).siblings(".text").text(str);
			$('#budText').find(':text').val(str);
			showAreaInfo();
		});
		function showAreaInfo() {

		}

		$('#current_area_selected').on('change.areaSelected', null, "event-data", function (ev, index, thisAreaData) {
			//片区被选中的时候触发的
			$(".SelectBox").val(String(index));
			$(".SelectBox").triggerHandler('seat-change', true)
		})
		$('#test_cinema_area').initSeartMgr({
			//store: "seat_mgr.json",//从数据库取数据
			useLocalCache: false,
			showType: {type: 'manage'},
			layout: [20, 10],
			screen: {
				width: 100,
				height: 40,
				bgColor: '#000',
				text: '屏幕'
			},
			areas: {
				afterResizing: function () {

				}, onResizing: function () {
					console.dir(this);
				},
				afterDraging: function ($helper) {
				},
				onDraging: function ($helper) {
//                        $helper.html('FUCK');
				},
				onSelected: function (index, thisAreaData) {
					$('#current_area_selected').data('current_area_selected', this).html(index + '-' + thisAreaData).triggerHandler('change.areaSelected', [index, thisAreaData]);
				},
				contains: [{
					name: 'area',
					begin: '1-2',
					end: '5-5', bgColor: 'red',

					areaNameRule: {type: 'odd', rule: 'RL'},//type: 'odd\even\series', rule: 'RL'\LR(default)
					persistent: false,
					memo:"备注"

				}, {
					name: 'area',
					begin: '7-7',
					end: '8-10', bgColor: 'blue'
				}, {
					name: 'area',
					begin: '3-7',
					end: '4-11', bgColor: 'orange'
				}]
			}
		}, function (areasData, seatsData, screenData) {
			$('#budget').empty();
			$.each(areasData, function (i, v) {
				var indx = i + 1, option = null;
				if (indx == 1) {
					option = '<option value=' + i + ' selected="selected">' + (v.name + indx) + '</option>';
				} else {
					option = '<option value=' + i + '>' + (v.name + indx) + '</option>';
				}
				$('#budget').append(option);
			});
		}).initSeartMgr('openDrawAreaFunc', true, '片区', '#ccc', function (index, thisAreaData) {
			var option = '<option value=' + index + '>' + (thisAreaData.name + (index + 1)) + '</option>';
			$('#budget').append(option);
			$('#current_area_selected').data('current_area_selected', this).html(index + '-' + thisAreaData).triggerHandler('change.areaSelected', [index, thisAreaData]);
		});
		//导航高亮
		$('#area_del').on('click', function (ev) {
			alert('del');
		})
		$('#area_save').on('click', function (ev) {
			alert('save');
		})
		$(".menu li").eq(0).find("a").addClass("on");
		$('.color_pw').each(function () {
			$(this).minicolors({
				control: $(this).attr('data-control') || 'hue',
				defaultValue: $(this).attr('data-defaultValue') || '',
				inline: $(this).attr('data-inline') === 'true',
				letterCase: $(this).attr('data-letterCase') || 'lowercase',
				opacity: $(this).attr('data-opacity'),
				position: $(this).attr('data-position') || 'bottom left',
				change: function (hex, opacity) {
					if (!hex) return;
					if (opacity) hex += ', ' + opacity;
					if (typeof console === 'object') {
						console.log(hex); //hex为颜色参数
					}
				},
				theme: 'bootstrap'
			});
		});
	});
</script>

<div class="pw_main" id="pw_main">
	<div class="district">
		<!-- right设置影厅区域start -->
		<div class="district_right">
			<p>设置影厅区域</p><span id="current_area_selected">选择片区</span>
			<ul>
				<li>
					<label>片区编号:</label>

					<div id="bud" class="bud">
						<span class="text">--请选择片区--</span>
						<select name="select" id="budget" class="SelectBox">
							<option value="001">001</option>
							<option value="002">002</option>
							<option value="003" selected="selected">003</option>
							<option value="004">004</option>
						</select>

					</div>
					<div style="position: absolute;left: 280px;width: 48px">
						<button id="area_save">+</button>
						<button id="area_del">-</button>
					</div>

				</li>
				<li>
					<label>片区名称:</label>

					<div id="budText">
						<input type="text" value="第一片区"/>
					</div>
				</li>
				<li>
					<label>备 注:</label>
					<textarea class="for_note"></textarea>
				</li>
				<li>
					<label>片区颜色:</label>
					<input type="text" id="brightness-demo" class="form-control color_pw" data-control="brightness"
					       value="#00ffff">
				</li>
				<li>
					<label>透明度:</label>
					<input type="range" id="area_color_opacity" min="0" max="100"
					       value="50">
				</li>
				<li>
					<label style="font-weight:normal;" title="字母是以ABCDE等命名行号，数字是以12345等命名行号">行号规则:</label>
					<span class="column_number " title="ABCDE...">字母</span>
					<span class="column_number number_on" title="12345...">数字</span>
				</li>
				<li>
					<label style="font-weight:normal;">座位列号:</label>
					<span class="column_number number_on" title="123456">默认</span>
					<span class="column_number " title="奇数135">奇数</span>
					<span class="column_number " title="偶数246">偶数</span>

				</li>
				<li>
					<label style="font-weight:normal;" title="座位号左右规则">左右规则:</label>
					<span class="column_number number_on" title="12345">L-R</span>
					<span class="column_number" title="54321">R-L</span>
				</li>
			</ul>
			<input type="button" class="district_savse " value="保存">
		</div>
		<!-- right设置影厅区域end -->
		<div id="test_cinema_area" class="district_list" style="border: 1px solid #000"></div>

		<!-- left设置影厅区域start -->
		<div class="district_left">

		</div>
	</div>
</div>