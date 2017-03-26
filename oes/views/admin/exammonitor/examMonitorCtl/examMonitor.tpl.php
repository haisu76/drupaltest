<?php
$this->printHead(
                array(
                    'title' => array('title'=>'考试监控', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
		                         '/admin/paper/paper.css',)
                    ,'js' => array('/admin/manyTrees.js','/admin/common.js','/admin/exammonitor/exam_monitor.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
<script>
//页面加载完毕后初始化试题
$(document).ready(function(){
	examInitExamMonitor();
});
</script>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/exam_top.php');?>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('搜索条件', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content" id="exam_search_param_div">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('考试名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="exam_name" id="exam_name" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a href="javascript:void(0)" onclick="examCategoryTreeShow('exam_category_name','exam_category',false)" id="exam_category_name" name="exam_category_name"><?php echo L::getText('请选择考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="exam_category" name="exam_category" value="" />
					</div>

					<div class="search_item">
						<h1><?php echo L::getText('考试时间', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input  class="input2 ~auto_width" id="exam_begin_tm" name="exam_begin_tm" type="text" value="">
						<input  class="input2 ~auto_width" id="exam_end_tm" name="exam_end_tm" type="text" value="">
				</div>
				</div>
				
				<!-- // *************************************************** -->
                <!--add 2013 01 10-->
                <div class="clear"></div>
				<div class="button_area_search">
					<div class="inner_box btn_box">
						<a href="javascript:void(0)" onclick="examSearchExamMonitorList()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="examResetMonitorSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span><?php echo L::getText('考试列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<!-- //  -->
				<div class="table_content">
						<?php 
		echo $this->exam_monitor_obj_tb;
		?>
				</div>
				
			</div>
		
	
		</div>
	
		
		<!-- // footer -->
		
			<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->