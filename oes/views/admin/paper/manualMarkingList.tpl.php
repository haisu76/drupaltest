<?php
$this->printHead(
    array(
        'title' => array('title'=>'题库/试卷/考试-人工评分', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		               '/admin/paper/paper.css',)
        ,'js' => array(
            '/admin/manyTrees.js'
            ,'/admin/paper/manual_marking_list.js'
            ,'/admin/common.js'
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

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		 <?php include(VIEW_DIR . "/admin/exam_top.php");?>
		
		<!-- //搜索  -->
		<div class="panel_1 con_input">
			<div class="title"><span>试卷搜索</span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1>考试名称</h1>
						<input class="input4 ~auto_width" type="text" name="exam_name" id="exam_name" />
					</div>
					
					<div class="search_item">
						<h1>考试分类</h1>
                        <a id="exam_category_name" name="exam_category_name" href="javascript:void(0)" onclick="examCategoryTreeShow('exam_category_name','exam_category')">请选择考试分类</a>
                        <input id="exam_category" type="hidden" value="" name="exam_category">
					</div>

					<div class="search_item">
						<h1>考试时间</h1>
                        <input id="create_tm_start" class="input2 ~auto_width Wdate" type="text" value="" name="create_tm_start" readonly="">
                        <input id="create_tm_end" class="input2 ~auto_width Wdate" type="text" value="" name="create_tm_end" readonly="">
					</div>
					
					<div class="search_item">
						<h1>标签(用“,” 分割多个标签)</h1>
						<input class="input4 ~auto_width" type="text" name="textfield" id="textfield" />
					</div>
					
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="btn2" id="search">搜索</a>
						<a href="#" class="btn2" id="reset">重置</a>
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
					
					<div class="right none">
						审核状态：
						<select name="select" size="1" id="select" class="select2">
								<option>通过</option>
								<option>未通过</option>
								<option>拒绝</option>
						</select>
						&nbsp;
						<input name="checkbox" type="checkbox" class="checkbox" id="checkbox" />仅显示管理员
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
