<?php
$this->printHead(
                array(
                    'title' => array('title'=>'题库参数设置', 'file'=>__FILE__, 'line'=>__LINE__)
                    ,'css'=>array('/admin/index/backhead.css',
		              			 '/admin/question/question.css')
                    ,'js' => array('/admin/manyTrees.js','/admin/question/question.js','/admin/common.js','/admin/question/qsn_default_setting.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
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
 * @param 	$this_qsn_setting 已经设置的参数
 * @param 	$setting_name 需要设置的参数名称
 * @param 	$indent_sign array('    ','|-') 缩进符号 
 * @param 	$level 第几层子内容
 * @return  
 */
function displaySubQsnContent($p_qsn_content,$this_qsn_content,$this_qsn_setting_val,$indent_sign = array('&nbsp;&nbsp;&nbsp;&nbsp;','|-'),$level=1){
	foreach($this_qsn_content[$p_qsn_content['c_cde']] as $qsv)
	{
?>
	<option value="<?php echo $qsv['c_cde']?>" <?php if($qsv['c_cde'] == $this_qsn_setting_val){?>selected="selected"<?php }?>><?php $lv=$level; while($lv){echo $indent_sign[0];$lv--;} echo $indent_sign[1]; ?><?php echo  $qsv['desc_cn']?></option>	
<?php 
		if($qsv['sub_cde_count']>0){
			displaySubQsnSource($qsv,$level++);
		}
	}
}
?>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
	<?php include(VIEW_DIR.'/admin/qsn_top.php');?>
	<!-- //全局设置  -->
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('全局设置', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('默认试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
							<a href="javascript:void(0)" onclick="qsnCategoryTreeShow('qsn_category_name','qsn_category')" id="qsn_category_name" >

<?php $is_qsn_category_exist = false; foreach($this->qsn_category as $qsc){
	 if($qsc['c_cde'] == $this->qsn_setting['qsn_category']['setting_value']){echo $qsc['desc_cn'];$is_qsn_category_exist = true;}
	
 }
 if(!$is_qsn_category_exist)
 {
 	echo L::getText('请选择试题分类', array('file'=>__FILE__, 'line'=>__LINE__));
 }
 ?>
</a>
<input type="hidden" value="<?php echo $this->qsn_setting['qsn_category']['setting_value'];?>" id="qsn_category" name="qsn_category" />
					
						
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('默认试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
				<a href="javascript:void(0)" onclick="qsnSourceTreeShow('qsn_source_name','qsn_source')" id="qsn_source_name" name="qsn_source_name">

<?php $is_qsn_source_exist = false;  foreach($this->qsn_source as $qsv){
	 if($qsv['c_cde'] == $this->qsn_setting['qsn_source']['setting_value'] ){echo $qsv['desc_cn'];$is_qsn_source_exist=true;}
 }
  if(!$is_qsn_source_exist)
 {
 	echo '请选择试题来源';
 }?>
</a>
							<input type="hidden" id="qsn_source" name="qsn_source" value="<?php echo $this->qsn_setting['qsn_source']['setting_value'];?>" />
					
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('默认试题状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_status" name="qsn_status">
						<?php foreach($this->qsn_status as $qsv){
							if($qsv['c_cde'] !='010304'){?>
						<option value="<?php echo $qsv['c_cde']?>" <?php if($qsv['c_cde'] == $this->qsn_setting['qsn_status_selected']['setting_value']){?>selected="selected"<?php }?>><?php echo $qsv['desc_cn'] ?></option>
						<?php }
							}?>
						</select>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('默认试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_level" name="qsn_level">
						<?php foreach($this->qsn_level as $qlv){?>
						<option value="<?php echo $qlv['c_cde']?>" <?php if($qlv['c_cde'] == $this->qsn_setting['qsn_level_selected']['setting_value']){?>selected="selected"<?php }?>><?php echo $qlv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
										
					<div class="search_item">
						<h1><?php echo L::getText('默认试题分数', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" id="qsn_point" name="qsn_point" type="text" value="<?php echo $this->qsn_setting['qsn_point']['setting_value']?>">
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('默认答题时限', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" id="qsn_limit_tm" name="qsn_limit_tm" type="text" value="<?php echo $this->qsn_setting['qsn_limittime']['setting_value']?>">
						<select class="select2" size="1" id="time_unit" name="time_unit" onchange="formatQsnLimitTm('qsn_limit_tm',$(this).val())" >
						<option value="m" selected="selected"><?php echo L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__))?></option><option value="h"><?php echo L::getText('小时', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						</select>
					</div>
					
				</div>
				
				
			</div>
		</div>
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('试题设置', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('默认试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_type" name="qsn_type">
						<?php foreach($this->qsn_type as $qtv){?>
						<option value="<?php echo $qtv['c_cde']?>" <?php if($qtv['c_cde'] == $this->qsn_setting['qsn_type']['setting_value']){?>selected="selected"<?php }?>><?php echo $qtv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('单选题默认选项数量', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_single_count" name="qsn_single_count">
						<?php foreach($this->qsn_option_count as $qocv){?>
						<option value="<?php echo $qocv['desc_cn']?>" <?php if((int)$qocv['desc_cn'] == (int)$this->qsn_setting['qsn_single_count']['setting_value']){?>selected="selected"<?php }?>><?php echo $qocv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('多选题默认选项数量', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_multi_count" name="qsn_multi_count">
						<?php foreach($this->qsn_option_count as $qocv){?>
						<option value="<?php echo $qocv['desc_cn']?>" <?php if((int)$qocv['desc_cn'] == (int)$this->qsn_setting['qsn_multi_count']['setting_value']){?>selected="selected"<?php }?>><?php echo $qocv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('判断题默认答案', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select3 ~auto_width" id="qsn_judge_radio_yes" name="qsn_judge_radio_yes">
						<option value="yes" <?php if($this->qsn_setting['qsn_judge_radio_yes']['setting_value'] == 'yes'){?>selected="selected"<?php }?>><?php echo L::getText('正确', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<option value="no" <?php if($this->qsn_setting['qsn_judge_radio_yes']['setting_value'] == 'no'){?>selected="selected"<?php }?>><?php echo L::getText('错误', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						</select>
					</div>
				</div>
			</div>
		</div>
        <div class="clear"></div>
	<!-- // 主按钮区(分左中右) -->
		<div class="button_area">
			<div class="left">
				<!--<a href="#" class="btn" >全部清除</a> -->
			</div>
			
			<div class="center">
				<a href="javascript:void(0)" onclick="submitQsnDefaultSettingVal()" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<!-- <a href="#" class="btn" >关闭</a> -->
			</div>
			<div class="right">
				
			</div>
			
		</div>
        <!-- add  2012 11 22 ↓ -->
         <div class="clear"></div>
        <!-- add  2012 11 22 ↑ -->
		<!-- // footer -->
		<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


