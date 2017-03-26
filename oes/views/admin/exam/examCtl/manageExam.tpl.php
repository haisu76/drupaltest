<?php
$this->printHead(
    array(
        'title' => array('title'=>'考试管理', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		               '/admin/exam/exam.css',)
        ,'js' => array('/admin/manyTrees.js',
        '/admin/common.js',
        '/admin/invite/invite.js',
        '/admin/exam/exam_manage.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	examInitExamManage();
	});
</script>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
			<?php include(VIEW_DIR.'/admin/exam_top.php');?>
		<!-- //搜索  -->
		<div class="panel_1 con_input" style="float:none;" id="exam_search_param_div">
			<div class="title"><span><?php echo L::getText('考试搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('考试名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="exam_name" id="exam_name" value="<?php echo isset($this->df_conditions['exam_name'])?$this->df_conditions['exam_name']:'';?>" />
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a href="javascript:void(0)" onclick="examCategoryTreeShow('exam_category_name','exam_category',false)" id="exam_category_name" name="exam_category_name"><?php echo isset($this->df_conditions['exam_category_desc'])?$this->df_conditions['exam_category_desc']:L::getText('请选择考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="exam_category" name="exam_category" value="<?php echo isset($this->df_conditions['exam_category'])?$this->df_conditions['exam_category']:'';?>" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class=" ~auto_width" id="exam_status" name="exam_status">
						<option value="" ><?php echo L::getText('请选择状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->exam_status as $esv){
						if($esv['c_cde']!='030304'){
							?>
						<option value="<?php echo $esv['c_cde']?>" <?php if($esv['c_cde'] == $this->df_conditions['exam_status']){?>selected="selected"<?php }?>><?php echo $esv['desc_cn'] ?></option>
						<?php }
						}?>
						</select>	
					</div>

					<div class="search_item">
						<h1><?php echo L::getText('考试日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input  class="input2 ~auto_width" id="exam_begin_tm" name="exam_begin_tm" type="text" value="<?php echo isset($this->df_conditions['create_tm_start'])?$this->df_conditions['create_tm_start']:'';?>">
						<input  class="input2 ~auto_width" id="exam_end_tm" name="exam_end_tm" type="text" value="<?php echo isset($this->df_conditions['create_tm_end'])?$this->df_conditions['create_tm_end']:'';?>">
			
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('考试标签(用“,” 分割多个标签)', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input4 ~auto_width" type="text" name="tag_names" id="tag_names" value="<?php echo isset($this->df_conditions['exam_name'])?$this->df_conditions['exam_name']:'';?>" />
					</div>
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="examSearchExamList()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="examResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		<form action="?a=updateExam" method="POST" name="update_exam_form" id="update_exam_form">
		<input type="hidden" name="search_condition" id="search_condition" value="" />
		<input type="hidden" name="cur_page" id="cur_page" value="" />
		<input type="hidden" name="page_size" id="page_size" value="" />
		<input type="hidden" name="update_exam_id" id="update_exam_id" value="" />
		</form>
		 <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('考试列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
            <div class="content">
                <!-- // toolbar  -->
                
                <div class="table_content"  id="exam_list_div">
		<?php 
		echo $this->exam_obj_tb;
		?>
		</div>
            </div>
        </div>
		
		<!-- // footer -->
		<?php include(VIEW_DIR.'/admin/footer.php');?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
