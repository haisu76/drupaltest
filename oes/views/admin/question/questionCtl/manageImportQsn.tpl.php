<?php
$this->printHead(
    array(
        'title' => array('title'=>'导入试题管理', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		               '/admin/question/question.css',
					   '/components/pageTable/pageTable.css')
        ,'js' => array('/admin/manyTrees.js','/admin/question/question.js','/admin/common.js','/admin/question/qsn_import.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	qsnImportInitqsnImportManage();
});
</script>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		<!-- // 顶部 -->
		
		 	<?php include(VIEW_DIR.'/admin/qsn_top.php');?>
		<!-- // 顶部 -->	
		<!-- 导入试题 -->
		<div class="panel_1 con_input" style="float:none;" id="qsnimport_param_div">
			<div class="title"><span><?php echo L::getText('试题导入', array('file'=>__FILE__, 'line'=>__LINE__))?></span>&nbsp;<a target="_blank" href="<?php echo ROOT_URL?>/data/importQsnTemp/describe.html"><img src="<?php echo ROOT_URL?>/images/icon/q_status_02.png"/></a></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a href="javascript:void(0)" onclick="qsnCategoryTreeShow('qsnimp_category_name','qsnimp_category',false,'imp')" id="qsnimp_category_name" name="qsnimp_category_name"><?php echo L::getText('请选择试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<input type="hidden" id="qsnimp_category" name="qsnimp_category" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a href="javascript:void(0)" onclick="qsnSourceTreeShow('qsnimp_source_name','qsnimp_source',false,'imp')" id="qsnimp_source_name" name="qsnimp_source_name"><?php echo L::getText('请选择试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<input type="hidden" id="qsnimp_source" name="qsnimp_source" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('难度', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select2 ~auto_width" id="qsnimp_level" name="qsnimp_level">
						<option value=""><?php echo L::getText('请选择难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_level as $qlv){?>
						<option value="<?php echo $qlv['c_cde']?>"><?php echo $qlv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('试题模板', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a target="_blank" href="?a=downLoadImportQsnTmp&qsn_temp=shiti" title="<?php echo L::getText('下载试题模板', array('file'=>__FILE__, 'line'=>__LINE__))?>" ><?php echo L::getText('下载', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('答案模板', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a target="_blank" href="?a=downLoadImportQsnTmp&qsn_temp=daan" title="<?php echo L::getText('下载答案模板', array('file'=>__FILE__, 'line'=>__LINE__))?>" ><?php echo L::getText('下载', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题文件', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input type="hidden" name="qsn_file_name" id="qsn_file_name" value="" />
						<input name="qsn_file" type="file" class="" id="qsn_file" size="35" style="display: none; " filecount="0" width="60" height="21">
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('答案文件', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input type="hidden" name="answer_file_name" id="answer_file_name" value="" />
						<input name="answer_file" type="file" class="" id="answer_file" size="35" style="display: none; " filecount="0" width="60" height="21">
					</div>
				</div>
				<!-- // Button -->
				<div class="button_area_search" style="float:left; margin-top:20px;">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="qsnImport()" id="qsn_import_btn" class="btn4" ><?php echo L::getText('导入试题', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					
					</div>
				</div>
			  
			</div><div style="clear:both;"></div>
		</div>
		<!-- //搜索  -->
		<div class="panel_1 con_input" style="float:none;"  id="qsnimport_search_param_div">
			<div class="title"><span onclick="$('#qsnimport_search_param_content').toggle()"><?php echo L::getText('试题搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content" id="qsnimport_search_param_content" >
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						
						<a href="javascript:void(0)" onclick="qsnCategoryTreeShow('qsn_category_name','qsn_category',false)" id="qsn_category_name" name="qsn_category_name"><?php echo L::getText('请选择试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<input type="hidden" id="qsn_category" name="qsn_category" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a href="javascript:void(0)" onclick="qsnSourceTreeShow('qsn_source_name','qsn_source',false)" id="qsn_source_name" name="qsn_source_name"><?php echo L::getText('请选择试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<input type="hidden" id="qsn_source" name="qsn_source" value="" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('题型', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_type" name="qsn_type">
						<option value=""><?php echo L::getText('请选择题型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_type as $qtv){?>
						<option value="<?php echo $qtv['c_cde']?>"><?php echo $qtv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('难度', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select2 ~auto_width" id="qsn_level" name="qsn_level">
						<option value=""><?php echo L::getText('请选择难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_level as $qlv){?>
						<option value="<?php echo $qlv['c_cde']?>"><?php echo $qlv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
				
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box" style="margin-bottom:10px;">
						<a href="javascript:void(0)" onclick="qsnImportSearchQsnList()" id="qsn_search_btn" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="qsnImportResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		<form action="?a=updateImportQsn" method="POST" name="update_import_qsn_form" id="update_import_qsn_form">
		<input type="hidden" name="search_condition" id="search_condition" value="" />
		<input type="hidden" name="cur_page" id="cur_page" value="" />
		<input type="hidden" name="page_size" id="page_size" value="" />
		<input type="hidden" name="update_qsn_id" id="update_qsn_id" value="" />
		</form>
		<div class="clear"></div>
			<div id="qsn_list_div" class="panel_1 con_table">
		 <div class="title"><span><?php echo L::getText('试题列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
           
		<?php 
		echo $this->qsn_obj_tb;
		?>
		</div>
	
		 	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div>
</div>