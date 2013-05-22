	<h3>按照题库来分</h3>
	<ul>
		<li class="statistics"><a href="statistics" >题库</a></li>
		<li class="statistics_date"><a href="statistics_date" >日期</a></li>
		<li class="statistics_auditexam"><a href="statistics_auditexam" >审核题库</a></li>
		<li class="statistics_origin"><a href="statistics_origin">出题人</a></li>
		<li class="statistics_type"><a href="statistics_type">题库类型</a></li>
		<li class="statistics_difficulty"><a href="statistics_difficulty">难度类型</a></li>
		<li class="statistics_questiontype"><a href="statistics_questiontype" >题目类型</a></li>
		<li class="statistics_theme"><a href="statistics_theme">题目题材</a></li>
		<li class="statistics_pics"><a href="statistics_pics">图片题目</a></li>
	</ul>			
	<table>
		<tr>
			<th>审核题库中的题目总数</th>
			<th>使用题库中的题目总数</th>
		</tr>
		<tr class="odd">
			<td><?php echo $exam['audit'];?></td>
			<td><?php echo $exam['use'];?></td>
		</tr>
	</table>