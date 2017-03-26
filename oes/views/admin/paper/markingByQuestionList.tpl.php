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
            ,'/admin/paper/marking_by_question_list.js'
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
	markingInitMarkingQuestion();
});
</script>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		 <?php include(VIEW_DIR . "/admin/exam_top.php");?>
		<input type="hidden" id="exam_id" value="<?php echo $this->examId; ?>">
		<!-- //搜索  -->
		<div class="panel_1 con_input" id="exam_search_param_div">
			<div class="title"><span>试题搜索</span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1>选择试卷</h1>
                        <select id="papr_id" class="select4" size="1" name="papr_id" onchange="markingGetQsnType()">
                            <option value="0">请选择</option>
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
						<h1>试卷题目</h1>
                        <select id="papr_qsn_type_position" class="select4" size="1" name="papr_qsn_type_position" onclick="">
                            <option value="0">请选择</option>
                        </select>
					</div>
					<div class="search_item">
						<h1>参考次数</h1>
						<input class="input1 ~auto_width" value="1" type="text" name="exam_times" id="exam_times" />
					</div>
				</div>
				
				<div class="clear"></div>
			</div>
			<div class="button_area_search">
					<div class="inner_box">
						
						<a href="javascript:void(0)" onclick="markingGetPaper()" class="btn2" id="search">搜索</a>
					</div>
				</div>
		</div>
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span>试题列表</span></div>
			<div class="content">
				<!-- // toolbar  -->
				<div class="table_content" id="papr_content">
				
				</div>
			</div>
		</div>
		<!-- // footer -->
        <?php include(VIEW_DIR . "/admin/footer.php");?>
	</div><!-- // box_inner end -->
</div><!-- // box end -->