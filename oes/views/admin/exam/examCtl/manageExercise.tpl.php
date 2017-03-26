<?php
$this->printHead(
    array(
        'title' => array('title'=>'联系管理', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		               '/admin/exam/exam.css',)
        ,'js' => array('/admin/manyTrees.js','/admin/common.js','/admin/invite/invite.js','/admin/exam/exam_manage.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
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
			 
			<?php include(VIEW_DIR.'/admin/exercise_top.php');?>
		
		
		<!-- //搜索  -->
		<div class="panel_1 con_input" id="exam_search_param_div">
			<div class="title"><span><?php echo L::getText('练习搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('练习名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="exam_name" id="exam_name" />
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('练习分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a style="height:20px; float:left;  padding:0px 2px; line-height:20px; border:1px solid #ccc;" href="javascript:void(0)" onclick="examCategoryTreeShow('exam_category_name','exam_category',false)" id="exam_category_name" name="exam_category_name"><?php echo L::getText('请选择练习分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="exam_category" name="exam_category" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select style="margin-top:2px;" class=" ~auto_width" id="exam_status" name="exam_status">
						<option value="" ><?php echo L::getText('请选择状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->exam_status as $esv){
						if($esv['c_cde']!='030304'){
							?>
						<option value="<?php echo $esv['c_cde']?>" <?php if($esv['c_cde'] == $this->exam_obj['exam_status']){?>selected="selected"<?php }?>><?php echo $esv['desc_cn'] ?></option>
						<?php }
						}?>
						</select>	
					</div>

					<div class="search_item">
						<h1><?php echo L::getText('练习日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						
						
						<input  class="input2 ~auto_width" id="exam_begin_tm" name="exam_begin_tm" type="text" value="">
						<input  class="input2 ~auto_width" id="exam_end_tm" name="exam_end_tm" type="text" value="">
			
						
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('练习标签(用“,” 分割多个标签)', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input4 ~auto_width" type="text" name="tag_names" id="tag_names" />
					</div>
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="examSearchExerciseList()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="examResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		<form action="?a=updateExercise" method="POST" name="update_exercise_form" id="update_exercise_form">
		<input type="hidden" name="search_condition" id="search_condition" value="" />
		<input type="hidden" name="cur_page" id="cur_page" value="" />
		<input type="hidden" name="page_size" id="page_size" value="" />
		<input type="hidden" name="update_exam_id" id="update_exam_id" value="" />
		</form>
		 <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('练习列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
            <div class="content">
                <!-- // toolbar  -->
                
                <div class="table_content"  id="exercise_list_div">
		<?php 
		echo $this->exercise_obj_tb;
		?>
		</div>
            </div>
        </div>
		
		<!-- // footer -->
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
