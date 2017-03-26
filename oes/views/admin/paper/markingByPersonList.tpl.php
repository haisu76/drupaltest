<?php
$this->printHead(
    array(
        'title' => array('title'=>'题库/试卷/考试-试卷管理', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array(                  //加载css
            '/main.css'
        )
        ,'js' => array(
           '/admin/common.js'
            ,'/admin/manyTrees.js'
            ,'/admin/paper/marking_by_person_list.js'
        )//加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>

<!--[if IE 6]>
<script type="text/javascript" src="../js/DD_belatedPNG_0.0.8a-min.js" ></script>
<script type="text/javascript">
//DD_belatedPNG.fix('button,img,div,input,a,a:hover');
</script>
<![endif]-->
<script>
$(document).ready(function(){
	markingInitMarkingPersion();
});
</script>
<input type="hidden" id="exam_id" value="<?php echo $this->examId; ?>">
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		 <?php include(VIEW_DIR . "/admin/exam_top.php");?>
		
		<!-- //搜索  -->
		<div class="panel_1 con_input" id="exam_search_param_div">
			<div class="title"><span>试卷搜索</span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1>选择试卷</h1>
                        <select id="papr_id" class="select4" size="1" name="papr_id">
                            <option value="">请选择</option>
							<?php
							foreach($this->arrPaper as $v){
							?>
							    <option value="<?php echo $v['papr_id']; ?>"><?php echo $v['papr_name']; ?></option>
							<?php
							}
							?>
                        </select>
					</div>
					
					<div class="search_item">
						<h1>参考次数</h1>
                        <input class="input1 ~auto_width" value="" type="text" name="exam_times" id="exam_times" />
					</div>

					<div class="search_item">
						<h1>用户组</h1>
                        <select id="user_group" class="select2" size="1" name="user_group">
                            <option value="0">请选择</option>
<?php
foreach($this->arrExamTimes as $v){
?>
                            <option value="<?php echo $v['exam_times']; ?>"><?php echo $v['exam_times']; ?></option>
<?php
}
?>
                        </select>
					</div>
					
					<div class="search_item">
						<h1>用户名/ID/用户姓名/邮件</h1>
						<input class="input4 ~auto_width" type="text" name="username" id="username" />
					</div>
					
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						
						<a href="javascript:void(0)" onclick="markingSearchUserList()" class="btn2" id="search">搜索</a>
						<a href="javascript:void(0)" onclick="markingResetSearchParams()"class="btn2" id="reset">重置</a>
					</div>
				</div>
			  
			</div>
		</div>
		
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span>试卷列表</span></div>
			<div class="content">
				<!-- // toolbar  -->
				<div class="toolbar_top none">
					<div class="left">
						<a class="btn2 iframe" href="dialog_marking_paper.html" title="人工评卷">人工评卷</a>
					</div>
					
					
				</div>
				
				<div class="table_content">
					<?php
					echo $this->pageTableHtml;
					?>	
				</div>
				
			</div>
		
		</div>
		
		
		
	
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area none">
			<div class="left">
				<a href="#" class="btn" >全部清除</a>
			</div>
			
			<div class="center">
				<a href="#" class="btn" >保存</a>
				<a href="#" class="btn" >关闭</a>
			</div>
			<div class="right">
				<a href="#" class="btn" >保存并复制</a>
				<a href="#" class="btn" >保存并新建</a>
			</div>
			
		</div>
	
	
		<!-- // footer -->
        <?php include(VIEW_DIR . "/admin/footer.php");?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->