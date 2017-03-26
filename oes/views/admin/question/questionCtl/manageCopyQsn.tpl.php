<?php 
 /**
 * 用<option></option>的格式输出试题参数的子内容
 * (此方法需要和commonCdeMethod的format方法配合使用)
 * @author	Dai
 * @date		2011.11.16
 * @Copyright (c) 2007-2010 Orivon.Inc
 * @since 
 * @param 	$p_qsn_content 参数父内容
 * @param 	$this_qsn_content 参数子内容
 * @param 	$indent_sign array('    ','|-') 缩进符号 
 * @param 	$level 第几层子内容
 * @return  
 */
function displaySubQsnContent($p_qsn_content,$this_qsn_content,$indent_sign = array('&nbsp;&nbsp;&nbsp;&nbsp;','|-'),$level=1){
	foreach($this_qsn_content[$p_qsn_content['c_cde']] as $qsv)
	{
?>
	<option value="<?php echo $qsv['c_cde']?>" ><?php $lv=$level; while($lv){echo $indent_sign[0];$lv--;} echo $indent_sign[1]; ?><?php echo  $qsv['desc_cn']?></option>	
<?php 
		if($qsv['sub_cde_count']>0){
			displaySubQsnSource($qsv,$level++);
		}
	}
}
?>

<!-- //搜索  -->
<div class="panel_1 con_input">
	<div class="content">
		<div class="search">
			
			<div class="search_item">
				<h1><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
				<a href="javascript:void(0)" onclick="qsnCategoryTreeShow('modify_qsn_category_name','modify_qsn_category',true)" id="modify_qsn_category_name" name="modify_qsn_category_name"><?php echo L::getText('请选择试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<input type="hidden" id="modify_qsn_category" name="modify_qsn_category" value="" />
			</div>
			
			<div class="search_item">
				<h1><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
				<a href="javascript:void(0)" onclick="qsnSourceTreeShow('modify_qsn_source_name','modify_qsn_source',true)" id="modify_qsn_source_name" name="modify_qsn_source_name"><?php echo L::getText('请选择试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<input type="hidden" id="modify_qsn_source" name="modify_qsn_source" value="" />
			</div>
			
			
			<div class="search_item">
				<h1><?php echo L::getText('难度', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
				<select class="select2 ~auto_width" id="modify_qsn_level" name="modify_qsn_level">
				<option value=""><?php echo L::getText('请选择难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
				<?php foreach($this->qsn_level as $qlv){?>
				<option value="<?php echo $qlv['c_cde']?>"><?php echo $qlv['desc_cn'] ?></option>
				<?php }?>
				</select>
			</div>
			
			<div class="search_item">
				<h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
				<select class="select2 ~auto_width" id="modify_qsn_status" name="modify_qsn_status">
				<option value=""><?php echo L::getText('请选择状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
				<?php foreach($this->qsn_status as $qsv){
					if($qsv['c_cde'] !='010304'){?>
				<option value="<?php echo $qsv['c_cde']?>"><?php echo $qsv['desc_cn'] ?></option>
				<?php }}?>
				</select>
			</div>
			<div class="search_item">
				<h1><?php echo L::getText('缺省分数', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
				<input class="input1 ~auto_width" id="modify_qsn_point" name="modify_qsn_point" type="text" value="">		
			</div>
			<div class="search_item">
				<h1><?php echo L::getText('答题时限', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input1 ~auto_width" id="modify_qsn_limit_tm" name="modify_qsn_limit_tm" type="text" value="">
				<select class="~select ~auto_width" id="modify_time_unit" name="modify_time_unit" onchange="formatQsnLimitTm('modify_qsn_limit_tm',$(this).val())" ><option value="m" selected="selected"><?php echo L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__))?></option><option value="h"><?php echo L::getText('小时', array('file'=>__FILE__, 'line'=>__LINE__))?></option></select>
			</div>
		
		</div>
		
		<div class="clear"></div>
		
		<!-- // Button -->
		<div class="button_area_search">
			<div class="inner_box">
				<a href="javascript:void(0)" onclick="qsnModifyCopyQsn(<?php echo $this->is_select;?>)" class="btn2" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				
				<a href="javascript:void(0)" onclick="qsnCloseSubQsn()" class="btn2" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>
	  
	</div>
</div>