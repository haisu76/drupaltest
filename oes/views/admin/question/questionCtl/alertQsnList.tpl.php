<?php
$this->printHead(
    array(
        'title' => array('title'=>'试题列表', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin_question_questionCtl_alertQsnList.css')
        ,'js' => array('/admin/question/question.js',
        '/admin/question/qsn_manage.js',
        '/admin/common.js',
        '/admin/manyTrees.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>

<?php if(isset($this->alert_option)){?>
<script>
$(document).ready(function(){
	qsnInitQsnManage();
	});
/**
 * 插入弹出层的添加试题
 * 
 * @author	Dai
 * @date		11.12.2
 * @Copyright (c) 2007-2010 Orivon.Inc
 * @since    	
 * @param 
 * @return 	
 */

function qsnAlertGetQsnList()
{
	var result = {'count':0,'ids':{}};
	$(":checkbox[name='qsn_cb']").each(function(i){
		   if(this.checked)
		   {
			   isid =  $(this).val();
			   isid = isid.split("_");
			   var isnsid = {'qsn_id':isid[0],'qsn_sub_id':isid[1]};
			   result.ids[result.count] = isnsid;
			   result.count ++;
		   }
	 });
	 if(result.count == 0)
	 {
		 oDialogDivInfo(window.L.getText('请选择至少一条数据'));
	 }else{
		window.parent.qsnCloseSubQsn();
		window.parent.<?php echo $this->alert_option['click_yes']?>(result);
	 }
	
}
</script>
<?php }?>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
			<!-- //搜索  -->
				<div class="panel_1 con_input" style="float:none;" id="qsn_search_param_div">
			<div class="title"><span><?php echo L::getText('试题搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
			<!-- 排除的ID -->
				<input type="hidden" value="<?php echo urlencode(json_encode($this->alert_option['exclude_ids']))?>" id="exclude_ids" name="exclude_ids" />
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('试题编号', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" id="qsn_id" name="qsn_id" type="text" value="">
					</div>
					
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
						<select <?php if($this->alert_option['qsn_type']!=''){?>disabled="disabled"<?php }?> class="select3 ~auto_width" id="qsn_type" name="qsn_type">
						
						<option value=""><?php echo L::getText('请选择题型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_type as $qtv){?>
						<option value="<?php echo $qtv['c_cde']?>" <?php if($this->alert_option['qsn_type'] ==$qtv['c_cde'] ){?>selected="selected"<?php }?>><?php echo $qtv['desc_cn'] ?></option>
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
					
					<div class="search_item">
						<h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select2 ~auto_width" id="qsn_status" name="qsn_status">
						<option value=""><?php echo L::getText('请选择状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->qsn_status as $qsv){?>
						<option value="<?php echo $qsv['c_cde']?>"><?php echo $qsv['desc_cn'] ?></option>
						<?php }?>
						</select>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('试题标签(用“,” 分割多个标签)', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input4 ~auto_width" type="text" name="tag_names" id="tag_names" />
					</div><div style="clear:both"></div>
					<div class="search_item">
						<h1><?php echo L::getText('创建人', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input2 ~auto_width" id="create_user_name" name="create_user_name" type="text" value="">
	
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('试题内容', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input2 ~auto_width" id="qsn_content" name="qsn_content" type="text" value="">
	
					</div>
					
					
					<div class="search_item">
						<h1><?php echo L::getText('创建日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input  class="input2 ~auto_width" id="create_tm_start" name="create_tm_start" type="text" value="">
						<input  class="input2 ~auto_width" id="create_tm_end" name="create_tm_end" type="text" value="">
					</div>
					
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search" style="margin-bottom:10px;">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="qsnAlertSearchQsnList()" id="qsn_search_btn" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="qsnResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div><div style="clear:both"></div>
				</div>
			  
			</div>
		</div>
		
		<div id="qsn_list_div">
		<?php 
		echo $this->qsn_obj_tb;
		?>
		</div>
			
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area_search">
		
			<div class="center">
				<a href="javascript:void(0)" onclick="qsnAlertGetQsnList()" class="btn" >保存</a>
				<a href="javascript:void(0)" onclick="window.parent.qsnCloseSubQsn()" class="btn" >关闭</a>
			</div>
		
		</div>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
