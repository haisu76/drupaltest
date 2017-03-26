<?php
$this->printHead(
    array(
        'title' => array('title'=>'试题管理', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		               '/admin/question/question.css',
					   '/components/pageTable/pageTable.css',
           			   '/admin_question_questionCtl_manageQsn.css')
        ,'js' => array('/admin/manyTrees.js',
        '/admin/question/question.js',
        '/admin/common.js',
        '/admin/question/qsn_manage.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	qsnInitQsnManage();
	});
</script>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">

	<!-- // 顶部 -->

		  	<?php include(VIEW_DIR.'/admin/qsn_top.php');?>
		<!-- //搜索  -->
		<div class="panel_1 con_input" style="float:none;" id="qsn_search_param_div">
			<div class="title"><span><?php echo L::getText('试题搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
            <div style="width:100%">
				<div class="search" style="float:left;">
					<div class="search_item">
						<h1><?php echo L::getText('试题编号', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" id="qsn_id" name="qsn_id" type="text" value="<?php echo isset($this->df_conditions['qsn_id'])?$this->df_conditions['qsn_id']:'';?>">
					</div>

					<div class="search_item">
						<h1><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>

						<a style="height:20px; float:left;  *margin-top:2px; padding:0px 2px; line-height:20px; border:1px solid #ccc;" href="javascript:void(0)" onclick="qsnCategoryTreeShow('qsn_category_name','qsn_category',false)" id="qsn_category_name" name="qsn_category_name"><?php echo isset($this->df_conditions['qsn_category_desc'])?$this->df_conditions['qsn_category_desc']:L::getText('请选择试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="qsn_category" name="qsn_category" value="<?php echo isset($this->df_conditions['qsn_category'])?$this->df_conditions['qsn_category']:'';?>" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a style="height:20px; float:left; *margin-top:2px;  padding:0px 2px; line-height:20px; border:1px solid #ccc;" href="javascript:void(0)" onclick="qsnSourceTreeShow('qsn_source_name','qsn_source',false)" id="qsn_source_name" name="qsn_source_name"><?php echo isset($this->df_conditions['qsn_source_desc'])?$this->df_conditions['qsn_source_desc']:L::getText('请选择试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<input type="hidden" id="qsn_source" name="qsn_source" value="<?php echo isset($this->df_conditions['qsn_source'])?$this->df_conditions['qsn_source']:'';?>" />
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('题型', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_type" name="qsn_type">
						<option value=""><?php echo L::getText('请选择题型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_type as $qtv){?>
						<option value="<?php echo $qtv['c_cde']?>" <?php if(isset($this->df_conditions['qsn_type'])&&$this->df_conditions['qsn_type'] ==$qtv['c_cde']){?>selected="selected"<?php }?> ><?php echo $qtv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('难度', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select2 ~auto_width" id="qsn_level" name="qsn_level">
						<option value=""><?php echo L::getText('请选择难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_level as $qlv){?>
						<option value="<?php echo $qlv['c_cde']?>" <?php if(isset($this->df_conditions['qsn_level'])&&$this->df_conditions['qsn_level'] ==$qlv['c_cde']){?>selected="selected"<?php }?>><?php echo $qlv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select2 ~auto_width" id="qsn_status" name="qsn_status">
						<option value=""><?php echo L::getText('请选择状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_status as $qsv){?>
						<option value="<?php echo $qsv['c_cde']?>" <?php if(isset($this->df_conditions['qsn_status'])&&$this->df_conditions['qsn_status'] ==$qsv['c_cde']){?>selected="selected"<?php }?>><?php echo $qsv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题标签(用“,” 分割多个标签)', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input4 ~auto_width" type="text" name="tag_names" id="tag_names" value="<?php echo isset($this->df_conditions['tag_names'])?$this->df_conditions['tag_names']:'';?>" />
					</div>
                    <div class="clear"></div>
                                   
					<div class="search_item">
						<h1><?php echo L::getText('试题内容', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input2 " id="qsn_content" name="qsn_content" type="text" value="<?php echo isset($this->df_conditions['qsn_content'])?$this->df_conditions['qsn_content']:'';?>">
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('创建人', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input2 ~auto_width" id="create_user_name" name="create_user_name" type="text" value="<?php echo isset($this->df_conditions['create_user_name'])?$this->df_conditions['create_user_name']:'';?>">
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('创建日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input  class="input2 ~auto_width" id="create_tm_start" name="create_tm_start" type="text" value="<?php echo isset($this->df_conditions['create_tm_start'])?$this->df_conditions['create_tm_start']:'';?>">
						<input  class="input2 ~auto_width" id="create_tm_end" name="create_tm_end" type="text" value="<?php echo isset($this->df_conditions['create_tm_end'])?$this->df_conditions['create_tm_end']:'';?>">
					</div>
			
				</div>
				
				<div class="clear"></div>

				</div>
				<!-- // Button -->
				<div class="button_area_search" >
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="qsnSearchQsnList()" id="qsn_search_btn" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="qsnResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
                    <div class="clear"></div>
                
				</div>
			  
			</div>
		</div>
		<form action="?a=updateQsn" method="POST" name="update_qsn_form" id="update_qsn_form">
		<input type="hidden" name="search_condition" id="search_condition" value="" />
		<input type="hidden" name="cur_page" id="cur_page" value="" />
		<input type="hidden" name="page_size" id="page_size" value="" />
		<input type="hidden" name="update_qsn_id" id="update_qsn_id" value="" />
		</form>
		
		<div id="qsn_list_div" class="panel_1 con_table">
		 <div class="title"><span><?php echo L::getText('试题列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
            
		<?php 
		echo $this->qsn_obj_tb;
		?>
		</div>

	<!-- // footer -->
		
	 	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
