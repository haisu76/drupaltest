<?php
$this->printHead(
                array(
                    'title' => array('title'=>'考试成绩分析', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
				   				 '/admin/statistics/statistics.css')
                    ,'js' => array('/admin/manyTrees.js','/admin/common.js','/admin/statistics/statistics_exam.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
<script>
$(document).ready(function(){
	statisticsExamInit();
});
</script>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/statistics_top.php');?>
		<div class="panel_1 con_input" style="float:none;" id="statistics_exam_search_param_div">
			<div class="title"><span><?php echo L::getText('统计搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					
					<div class="search_item">
						<h1><?php echo L::getText('考试名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="exam_name" id="exam_name" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a href="javascript:void(0)" onclick="statisticsExamCategoryTreeShow('exam_category_name','exam_category',false)" id="exam_category_name" name="exam_category_name"><?php echo L::getText('请选择考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="exam_category" name="exam_category" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('考试日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input2 ~auto_width" id="exam_begin_tm" name="exam_begin_tm" type="text" value="">
						<input class="input2 ~auto_width" id="exam_end_tm" name="exam_end_tm" type="text" value="">
					</div>
					
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="statisticsSearchExamStatistics()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="statisticsResetExamSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
                    <div style="clear:both;"></div>
				</div>
			  
			</div>
		</div>
		<div id="exam_statistics_list_div" style="margin-top:10px;">
		<?php 
		echo $this->exam_statistics_obj_tb;
		?>
		</div>
		
			<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div>
</div>
		