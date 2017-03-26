<?php
$this->printHead(
    array(
        'title' => array('title'=>'成绩管理', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
		                         '/admin/paper/paper.css',
								 '/components/pageTable/pageTable.css')
        ,'js' => array('/admin/manyTrees.js','/admin/examscore/examscore_manage.js','/admin/common.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	examscoreInitExamscoreManage();
	});
</script>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/exam_top.php');?>

		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search" id="examscore_search_param_div">
			<div class="title"><span><?php echo L::getText('搜索考试', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('考试名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="exam_name" id="exam_name" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('考试次数', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input1 ~auto_width" type="text" name="exam_times" id="exam_times" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('用户名/姓名/邮箱/ID', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="user_name" id="user_name" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						
						<a href="javascript:void(0)" onclick="examCategoryTreeShow('exam_category_name','exam_category',false)" id="exam_category_name" name="exam_category_name"><?php echo L::getText('请选择考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="exam_category" name="exam_category" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('组', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a href="javascript:void(0)" onclick="examGroupTreeShow('group_id_name','group_id',false)" id="group_id_name" name="group_id_name"><?php echo L::getText('请选择组', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="group_id" name="group_id" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('考试时间', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="exam_begin_tm" id="exam_begin_tm" />
						<input class="input3 ~auto_width" type="text" name="exam_end_tm" id="exam_end_tm" />
					
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('是否及格', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select2 ~auto_width" name="is_failed" size="1" id="is_failed">
							<option value=""><?php echo L::getText('请选择', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
							<option value="true"><?php echo L::getText('是', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
							<option value="false"><?php echo L::getText('否', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						</select>
					</div>
					<form action="?a=exportUserExamscore" name="examscore_export_form" id="examscore_export_form" method="post" target="_blank">
						<input type="hidden" value="" name="export_params" id="export_params" />
					</form>
				</div>
                <!--add 2013 01 10-->
                <div class="clear"></div>
				<div class="button_area_search">
					<div class="inner_box btn_box">
						<a href="javascript:void(0)" onclick="examscoreSearchExamscoreList()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="examscoreResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		<div class="panel_1 con_table">
		<div class="title"><span><?php echo L::getText('考试列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
            
<?php 
		echo $this->examscore_obj_tb;
		?>
		</div>
		
			<?php include(VIEW_DIR.'/admin/footer.php');?>
		</div>
		
		
	</div>