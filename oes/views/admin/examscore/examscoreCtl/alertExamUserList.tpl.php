<?php
$this->printHead(
    array(
        'title' => array('title'=>'考试人员列表', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		               '/admin/paper/paper.css',
		 				'/components/pageTable/pageTable.css')
        ,'js' => array('/admin/manyTrees.js','/admin/examscore/examscore_manage.js','/admin/common.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>


<div class="box block_1" style="width: 720px;"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner" style="width: 720px;">
		
		<!-- // 搜索过滤 -->
	
		<div class="panel_1 con_table">
		<div class="title"><span><?php echo L::getText('用户列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="exportExamUserList('<?php echo $this->exam_id?>','<?php echo $this->exam_times?>',<?php echo $this->list_type?>)" class="btn2" ><?php echo L::getText('导出用户列表', array('file'=>__FILE__, 'line'=>__LINE__))?></a></div>
            <table class="pageTable" style="width:100%;" >
<thead>
<tr><th _bottomth=""><font name="thTitle"><?php echo L::getText('用户名', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
<th style="text-align: left;"><font name="thTitle"><?php echo L::getText('姓名', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
<th _bottomth="" style="text-align: left;"><font name="thTitle"><?php echo L::getText('性别', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
<th _bottomth="" style="text-align: left;"><font name="thTitle" ><?php echo L::getText('所属组', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
</tr></thead>

<tbody>
<?php foreach($this->exam_user_objs as $euo){?>
<tr class="odd_bg">
<td ><?php echo $euo['username']?></td>
<td><?php echo $euo['real_name']?></td>
<td><?php echo $euo['gender']?></td>
<td><?php echo $euo['group_name']?></td></tr>
<?php }?>

</tbody>
</table>

		</div>
		
		</div>
		
		
	</div>