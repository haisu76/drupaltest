<?php
$this->printHead(
                array(
                    'title' => array('title'=>'试题明细分析', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
				   				 '/admin/statistics/statistics.css')
                    ,'js' => array('/admin/manyTrees.js','/admin/common.js','/admin/statistics/statistics_qsn.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>

<script>
$(document).ready(function(){
	statisticsQsnDetailInit();
});
</script>
<form target="_blank" method="post" id="statistics_export_form" name="statistics_export_form" action="?a=exportStatistics">
						<input type="hidden" id="export_params" name="export_params" value="">
						<input type="hidden" id="export_type" name="export_type" value="">
					</form>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/statistics_top.php');?>
		<div class="panel_1 con_input" style="float:none;" id="statistics_qsn_search_param_div">
			<div class="title"><span><?php echo L::getText('统计搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					
					<div class="search_item">
						<h1><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					  <a id="qsn_category_desc" name="qsn_category_desc" href="javascript:void(0)" onclick="statisticsQsnCategoryTreeShow('qsn_category_desc','qsn_category')" ><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					  <input class="input3 ~auto_width" type="hidden" name="qsn_category" id="qsn_category" />
			            
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<a id="qsn_source_desc" name="qsn_source_desc" onclick="statisticsQsnSourceTreeShow('qsn_source_desc','qsn_source')"><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input class="input3 ~auto_width" type="hidden" name="qsn_source" id="qsn_source" />
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_level" name="qsn_level">
			                <option value=""><?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<?php foreach($this->qsn_level as $qlv){?>
								<option value="<?php echo $qlv['c_cde']?>" ><?php echo $qlv['desc_cn'] ?></option>
								<?php }?>
								</select>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						  <span style="margin-left:5px;"><select class="select3 ~auto_width" id="qsn_type" name="qsn_type" >
								<option value=""><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<?php foreach($this->qsn_type as $qtv){?>
								<option value="<?php echo $qtv['c_cde']?>" ><?php echo $qtv['desc_cn'] ?></option>
								<?php }?>
								</select>
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('试题标签', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input4 ~auto_width" type="text" name="tag_names" id="tag_names" value="">
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('试题内容', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input2 " id="qsn_content" name="qsn_content" type="text" value="">
					</div>
					
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="statisticsSearchQsnDetail()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="statisticsResetQsnAccuracyParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				
	<a href="javascript:void(0)" onclick="statisticsExport('qsndetail')" class="btn2" ><?php echo L::getText('导出', array('file'=>__FILE__, 'line'=>__LINE__))?></a>	
			        
</div>
                    <div style="clear:both;"></div>
				</div>
			  
			</div>
		</div>
		<div id="exam_statistics_list_div" style="margin-top:10px;">
		<?php 
		echo $this->qsn_detail_statistics_obj_tb;
		?>
		</div>
		
			<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div>
</div>
		