<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程审批', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
						'/admin/verify/verify.css')
        ,'js' => array('/admin/manyTrees.js','/admin/common.js','/admin/verify/verify.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	verifyInitStudyPlan();
	});
</script>


<div class="box block_6"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		
		<?php include(VIEW_DIR.'/admin/verify_top.php');?>
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search" id="verify_search_param_div">
			<div class="title"><span><?php echo L::getText('课程', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
            <!-- 2012 11 21 uptate span to div -->
				<div class="search_item">
					<h1><?php echo L::getText('课程名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input4 ~auto_width" type="text" name="c_name" id="c_name" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('课程分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<a href="javascript:void(0)" onclick="verifyCCategoryTreeShow('c_category_name','c_category')" id="c_category_name" name="c_category_name" ><?php echo L::getText('请选择课程分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					<input type="hidden" value="" name="c_category" id="c_category" />	
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('申请时间', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input2 ~auto_width" id="app_begin_tm" name="app_begin_tm" type="text" value="">
					<input class="input2 ~auto_width" id="app_end_tm" name="app_end_tm" type="text" value="">
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('申请人', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="textfield" id="textfield" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('审批状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select1 ~auto_width" id="opinion" name="opinion">
						<option value=""><?php echo L::getText('请选择审批状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->verify_status as $vs){
						?>
						<option value="<?php echo $vs['c_cde']?>" ><?php echo L::getText($vs['desc_cn'], array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
						<?php }?>
						</select>
				</div>
				
				
				
				<div class="clear"></div>
				<!-- // 搜索按钮 -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="verifySearchVerifyList('course')" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="verifyResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span><?php echo L::getText('课程列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				
				<div class="table_content">
					<?php echo $this->course_verify_obj_tb;?>
					
				</div>
			</div>
		
	
		</div>

		<!-- // footer -->
		<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->