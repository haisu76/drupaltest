<?php
$this->printHead(
                array(
                    'title' => array('title'=>'试题正确率分析', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css','/components/pageTable/pageTable.css',
				   				 '/admin/statistics/statistics.css')
                    ,'js' => array('/admin/manyTrees.js','/admin/common.js','/admin/statistics/statistics_qsn.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>

<script>
$(document).ready(function(){
	statisticsQsnAccuracyInit();
});
</script>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
	
		<!-- // 顶部 -->
				<?php include(VIEW_DIR.'/admin/statistics_top.php');?>
		<div class="panel_1 con_input" style="float:none;" id="statistics_qsn_search_param_div">
			<div class="title"><span><?php echo L::getText('统计搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					
					<div class="search_item">
						<h1><?php echo L::getText('统计样本', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						 <select class="select3 ~auto_width" id="accuracy_type" name="accuracy_type" onchange="statisticsChangeAccuracyType()">
						  <option value="qsnlevel"><?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
			                <option value="qsncategory"><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
			                <option value="qsnsource"><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
			                <option value="qsntype"><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
							<option value="qsntag"><?php echo L::getText('试题标签', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						</select>
						
						
											</div>
											<div  class="search_item" style="display: none;" id="qsn_tag_content">
						<h1>试题标签(用“,” 分割多个标签)</h1>
						<input class="input4 ~auto_width" type="text" name="tag_names" id="tag_names" value="">
					</div>
				
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="statisticsSearchQsnAccuracy()" class="btn2" ><?php echo L::getText('查询', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="statisticsResetQsnAccuracyParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
                    <div style="clear:both;"></div>
				</div>
			  
			</div>
		</div>
		<div id="qsn_accuracy_div" style="margin-top:10px;">
		
		</div>
		
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div>
</div>
		