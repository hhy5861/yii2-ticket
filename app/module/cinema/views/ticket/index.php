<div class="pw_main" id="pw_main">
	<div class="tickit_mian">
		<!-- 搜索start -->
		<div class="search_box">
			<label>搜素：</label><input type="text" class="search_kuan"><a href="#" class="search_btn">搜素</a>
		</div>
		<!-- 搜索end -->

		<!-- 筛选start -->
		<div class="filtrate">
			<label>筛选：</label>
			<div id="bud" class="bud">
				<span class="text">日期</span><label for="select"></label>
				<select name="select" id="budget" class="SelectBox">
					<option value="2015-6-30" selected="">2015-6-30</option>
					<option value="2015-7-20">2015-7-20</option>
				</select>
			</div>
			<input type="text" class="time_input">
			<span>至</span>
			<input type="text" class="time_input">
			<a href="javascript:;" class="filtrate_btn">确定筛选</a>
		</div>
		<!-- 筛选end -->

		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<th>日期</th>
				<th>电影名称</th>
				<th>影厅</th>
				<th>放映时间</th>
				<th>结束时间</th>
				<th>操作</th>
			</tr>
			<tr>
				<td>2015-6-13</td>
				<td>傲慢与偏见</td>
				<td>1号厅</td>
				<td>7：50</td>
				<td>9：30</td>
				<td><a href="ticket.html" class="ticket_btn">售票</a><a href="refund.html" class="refund">退票</a><a href="bd_ticket.html" class="actualizar">补登</a></td>
			</tr>
			<tr>
				<td>2015-6-13</td>
				<td>傲慢与偏见</td>
				<td>1号厅</td>
				<td>7：50</td>
				<td>9：30</td>
				<td><a href="ticket.html" class="ticket_btn">售票</a><a href="refund.html" class="refund">退票</a><a href="bd_ticket.html" class="actualizar">补登</a></td>
			</tr>
		</table>
	</div>
</div>
<!-- 票务操作主体内容end -->