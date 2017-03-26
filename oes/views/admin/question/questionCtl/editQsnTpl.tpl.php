<!-- 给完形填空题准备选项数量和标记,考虑设置完型填空初始选项数量,现在是4个 -->
<script>
var qsn_option_cloze_count = '<?php foreach($this->qsn_option_count as $qocv){?><option value="<?php echo $qocv['desc_cn']?>" <?php if($qocv['desc_cn'] == 4){?> selected="selected" <?php }?>><?php echo $qocv['desc_cn'] ?></option><?php }?>';
var QSN_MAX_OPTION_COUNT = <?php echo $this->qsn_max_option_count;?>;
var QSN_OPTION_TAG = new Array(<?php foreach($this->qsn_option_tag as $qot){?>'<?php echo $qot['desc_cn']?>',<?php }?>'over');
var QSN_TYPE = {<?php foreach($this->qsn_type as $qtv){?>'<?php echo $qtv['c_cde']?>':'<?php echo $qtv['desc_cn'] ?>',<?php }?>'x':'x'};
</script>
<input type="hidden" name="qsn_id" id="qsn_id" value="<?php echo $this->qsn_obj['qsn_id']?>" />
<input type="hidden" name="qsn_sub_id" id="qsn_sub_id" value="<?php echo $this->qsn_obj['qsn_sub_id']?>" />
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('试题数据', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="col_full">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:80px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td width="9%"><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
							<a href="javascript:void(0)" onclick="qsnCategoryTreeShow('qsn_category_name','qsn_category')" id="qsn_category_name" name="qsn_category_name"><?php echo !isset($this->qsn_obj['qsn_category_desc'])||$this->qsn_obj['qsn_category_desc'] == ''?L::getText('请选择试题分类', array('file'=>__FILE__, 'line'=>__LINE__)):$this->qsn_obj['qsn_category_desc'] ?></a>
							<input type="hidden" id="qsn_category" name="qsn_category" value="<?php echo $this->qsn_obj['qsn_category']?>" />
							</td>
							<td><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
							<a href="javascript:void(0)" onclick="qsnSourceTreeShow('qsn_source_name','qsn_source')" id="qsn_source_name" name="qsn_source_name"><?php echo !isset($this->qsn_obj['qsn_source_desc'])||$this->qsn_obj['qsn_source_desc'] == ''?L::getText('请选择试题来源', array('file'=>__FILE__, 'line'=>__LINE__)):$this->qsn_obj['qsn_source_desc'] ?></a>
							<input type="hidden" id="qsn_source" name="qsn_source" value="<?php echo $this->qsn_obj['qsn_source']?>" />
							</td>
							<td><?php echo L::getText('试题状态', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
							<select class="select1 ~auto_width" id="qsn_status" name="qsn_status">
							<?php foreach($this->qsn_status as $qsv){
								if($qsv['c_cde'] !='010304'){?>
							<option value="<?php echo $qsv['c_cde']?>" <?php if($qsv['c_cde'] == $this->qsn_obj['qsn_status']){?>selected="selected"<?php }?>><?php echo $qsv['desc_cn'] ?></option>
							<?php }
								}?>
							</select>
							</td>
							<td><?php echo L::getText('答题时限', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;</td>
							<td><input class="input1 ~auto_width" id="qsn_limit_tm" name="qsn_limit_tm" type="text" value="<?php echo $this->qsn_obj['qsn_limit_tm']?>">
							<select class="~select ~auto_width" id="time_unit" name="time_unit" onchange="formatQsnLimitTm('qsn_limit_tm',$(this).val())" ><option value="m" selected="selected"><?php echo L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__))?></option><option value="h"><?php echo L::getText('小时', array('file'=>__FILE__, 'line'=>__LINE__))?></option></select>
							&nbsp;</td>
						</tr>
						<tr>
							<td><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
								<select class="select3 ~auto_width" id="qsn_type" name="qsn_type" <?php if($this->qsn_obj['qsn_id'] !== ''||(isset($this->is_alert_qsn)&&$this->is_alert_qsn)){?>disabled="disabled"<?php }?> onchange="qsnTypeChange()">
								<?php foreach($this->qsn_type as $qtv){?>
								<option value="<?php echo $qtv['c_cde']?>" <?php if($qtv['c_cde'] == $this->qsn_obj['qsn_type']){?>selected="selected"<?php }?>><?php echo $qtv['desc_cn'] ?></option>
								<?php }?>
								</select>
								&nbsp;&nbsp;
								<?php echo L::getText('选项数目', array('file'=>__FILE__, 'line'=>__LINE__))?>：
								<select class="select1 ~auto_width" id="qsn_option_count" name="qsn_option_count" onchange="qsnOptionCountChange()">
								<?php 
								$def_qsn_option_count = $this->qsn_obj['qsn_type']=='010102'?$this->qsn_obj['qsn_multi_count']:$this->qsn_obj['qsn_single_count'];
								foreach($this->qsn_option_count as $qocv){?>
								<option value="<?php echo $qocv['desc_cn']?>" <?php if($qocv['desc_cn'] == $def_qsn_option_count){?> selected="selected" <?php }?>><?php echo $qocv['desc_cn'] ?></option>
								<?php }?>
								</select>
						
							</td>
							<td><?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
								<select class="select3 ~auto_width" id="qsn_level" name="qsn_level">
								<?php foreach($this->qsn_level as $qlv){?>
								<option value="<?php echo $qlv['c_cde']?>" <?php if($qlv['c_cde'] == $this->qsn_obj['qsn_level']){?> selected="selected" <?php }?>><?php echo $qlv['desc_cn'] ?></option>
								<?php }?>
								</select>
							</td>
							<td><?php echo L::getText('默认分数', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 ~auto_width" id="qsn_point" name="qsn_point" type="text" value="<?php echo $this->qsn_obj['qsn_point']?>"></td>
							<td>
							<?php // if(!$this->is_import){?>
							<?php echo L::getText('数据分组', array('file'=>__FILE__, 'line'=>__LINE__)); ?>：
							<?php // }?>
							</td>
							<td>
							<?php //if(!$this->is_import){?>
							<div id="qsn_group_td" style="width: 125px;"></div>
							<?php echo admin_user_permissions::dataStratifiedHtml(empty($this->qsn_obj['qsn_id']) ? null : $this->qsn_obj['qsn_id'], 't_question','','qsn_group_td'); ?>
							<?php //}?>
							</td>
						</tr>
						<tr>
							<td width="9%"><a href="javascript:void(0)" class="icon_link" id="qsn_add_tag_a" onclick="qsnDisplayTag()"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;+</a>
							</td>
							<td id="qsn_tag_td" colspan="5">
							<?php if(isset($this->qsn_obj['tag_ids'])&&$this->qsn_obj['tag_ids'][0]!=''){
								foreach ($this->qsn_obj['tag_ids'] as $tik=>$tiv){
								?>
								<span class="icon_link" id="qsn_tag_span_<?php echo $tiv?>">
								<input type="hidden" name="qsn_tags" id="qsn_tag_<?php echo $tiv?>" value="<?php echo $tiv?>">
								<a href="javascript:void(0)" ><?php echo $this->qsn_obj['tag_names'][$tik]?></a>
								<a class="icon_del" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>" href="javascript:void(0)" onclick="qsnDelTag('<?php echo $tiv?>')"></a></span>
							<?php }
							}?>
							</td>
							<td></td>
							<td></td>
						</tr>
						
					</table>
				</div>
		
			</div>
		</div>
		
		
		<!-- //  -->
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('试题描述', array('file'=>__FILE__, 'line'=>__LINE__))?></span><span id="qsn_blank_cond_span" style="display: none; float: right; margin-right: 20px;"><input type="checkbox" value="1" id="qsn_blank_upper_flg" name="qsn_blank_upper_flg" <?php if($this->qsn_obj['qsn_single_count'] == '97' ||$this->qsn_obj['qsn_single_count'] == '99'){?>checked="checked""<?php }?>/><label for="qsn_blank_upper_flg"><?php echo L::getText('答案不区分大小写', array('file'=>__FILE__, 'line'=>__LINE__))?></label><input type="checkbox" value="1" id="qsn_blank_order_flg" name="qsn_blank_order_flg" <?php if($this->qsn_obj['qsn_single_count'] == '98' ||$this->qsn_obj['qsn_single_count'] == '99'){?>checked="checked""<?php }?>/><label for="qsn_blank_order_flg"><?php echo L::getText('答案不区分顺序', array('file'=>__FILE__, 'line'=>__LINE__))?></label></span></div>
			<div class="content">
				<!-- // 编辑器 -->
				<div class="editor_item" >
						<!-- 普通试题内容层start -->
						<div class="editor_item_inner" id="qsn_normal_content_div" name="qsn_content_div">
						<textarea style="width:98%; height:150px;" id="qsn_normal_content" name="qsn_normal_content"><?php echo isset($this->qsn_obj['qsn_content_edit'])?urldecode($this->qsn_obj['qsn_content_edit']):'';?></textarea>
						</div>
						<!-- 普通试题内容层end -->
						
						<!-- 填空题试题内容层start -->
						<div class="editor_item_inner" id="qsn_blank_content_div" name="qsn_content_div">
						<textarea style="width:98%; height:150px;" id="qsn_blank_content" name="qsn_blank_content"><?php echo isset($this->qsn_obj['qsn_content_edit'])?urldecode($this->qsn_obj['qsn_content_edit']):'';?></textarea>
							
						</div>
						<!-- 填空题试题内容层end -->
						
						<!-- 完型填空题试题内容层start -->
						<div class="editor_item_inner" id="qsn_cloze_content_div" name="qsn_content_div">
						<textarea style="width:98%; height:150px;" id="qsn_cloze_content" name="qsn_cloze_content"><?php echo isset($this->qsn_obj['qsn_content_edit'])?urldecode($this->qsn_obj['qsn_content_edit']):'';?></textarea>
						</div>
						<!-- 完型填空题试题内容层end -->	
				</div>
			</div>
		</div>
		<!-- 填空题选项(010104)start --> 
		<div>
		<ul class="item_q q_2" name="qsn_blank_div" id="qsn_blank_div">
		<?php if(isset($this->qsn_obj['qsn_answer'])){foreach($this->qsn_obj['qsn_answer'] as $qa){?>
		<li id="qsn_blank_answer_div_<?php echo $qa['qsn_item_id']?>"  style=" height:30px; line-height:30px; padding-right:10px; margin:0px auto;" > 
		<table class="editor_exam" border="0" cellSpacing="0" cellPadding="0" width="100%">
		<colgroup><col span="1"><col span="1">
		</colgroup><tbody><tr>
		<td style="background: rgb(100, 180, 255); border: 1px solid rgb(1, 193, 255); width: 30px; height: 25px; text-align: center; color: rgb(255, 255, 255); line-height: 25px; margin-right: 5px; float: left;" class="item_left"><?php echo $qa['qsn_item_id']?></td>
		<td style="background: rgb(189, 234, 248); margin: 0px auto; border: 1px solid rgb(1, 193, 255); width: 130px; height: 25px; line-height: 25px; float: left;" class="item_right">
		<div class="editor_item">
		<input style="background: rgb(189, 234, 248); height: 23px; line-height: 23px; width:130px; margin-top: 2px;"  type="text" qsn_item_id="<?php echo $qa['qsn_item_id']?>" name="qsn_blank_answer" id="qsn_blank_answer_<?php echo $qa['qsn_item_id']?>" value="<?php echo urldecode($qa['qsn_answer'])?>"/></div></td>
		<td style="line-height: 25px;">
		<div class="toolbar_bottom">
		<a href="javascript:void(0)" class="icon_link" onclick="qsnCleanBlank(<?php echo $qa['qsn_item_id']?>)">
		<span class="icon_del"></span><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a></div>
		</td> </tr></tbody></table></li>
		
		
		
	
		<?php }}?>
		</ul>
		</div>
		<!-- 填空题选项end --> 
		<!-- 完型填空题选项(010108)start --> 
		<div class="panel_1" id="qsn_cloze_div" name="qsn_cloze_div">
			<div class="title"><span><?php echo L::getText('填空内容', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="table_content exam_fill">
					<table width="100%" class="table1" id="qsn_cloze_tb">
						<colgroup>
							<col style="width:10px;" />
							<col style="width:40px;" />
							<col style="width:50px;" />
						</colgroup>
						<thead>
							<tr>
								<th class="align_center"><input name="checkbox" type="checkbox" class="checkbox" id="checkbox" /></th>
								<th><?php echo L::getText('序号', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('数量', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('选项内容', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th class="action"></th>
							</tr>
						</thead>
						<tbody>
						<?php if(isset($this->qsn_obj['qsn_answer'])){
							 foreach($this->qsn_obj['qsn_answer'] as $qa){
								$qsn_option_cloze_count = '';//选项数量select option
								$cloze_option_content = ''; //选项内容
								$cloze_option_count = 0;
								
								foreach($this->qsn_obj['qsn_option'] as $qo){
									if($qo['qsn_item_id'] == $qa['qsn_item_id'])
									{
										$cloze_option_count++;
										$is_checked = '';
										if($qo['qsn_item_tag'] ==$qa['qsn_answer'] )
										{
											$is_checked = 'checked="checked"';
										}
										$cloze_option_content .='<div style="float:left" id="qsn_cloze_option_item_div_'.$qa['qsn_item_id'].'_'.($qo['qsn_item_sub_id']-1).'" value="1">
										<input type="radio" name="qsn_cloze_value_'.$qa['qsn_item_id'].'" value="'.$qo['qsn_item_tag'].'" '.$is_checked.'/>'.$qo['qsn_item_tag'].'
										<input type="text" name="qsn_cloze_option_item_'.$qa['qsn_item_id'].'" id="qsn_cloze_option_item_'.$qa['qsn_item_id'].'_'.($qo['qsn_item_sub_id']-1).'" value="'.urldecode($qo['option_content_edit']).'" /></div>';
									}
								}
								foreach($this->qsn_option_count as $qocv){
									$is_selected = '';
									if($cloze_option_count == $qocv['desc_cn'])
									{
										$is_selected = 'selected="selected"';
									}
									$qsn_option_cloze_count.='<option value="'.$qocv['desc_cn'].'" '.$is_selected.'  >'.$qocv['desc_cn'].'</option>';
								}
						 
						 ?>
						<tr id="qsn_cloze_answer_tr_<?php echo $qa['qsn_item_id'] ?>" name="qsn_cloze_answer_tr" qsn_item_id="<?php echo $qa['qsn_item_id'] ?>">
						<td class="align_center">
						<input name="qsn_cloze_answer_checkbox" type="checkbox" class="checkbox" id="qsn_cloze_answer_checkbox<?php echo $qa['qsn_item_id'] ?>" value="<?php echo $qa['qsn_item_id'] ?>" />
						</td>
						<td class="align_center"><?php echo $qa['qsn_item_id'] ?></td>
						<td>
						<select id="qsn_cloze_option_count_<?php echo $qa['qsn_item_id'] ?>" onchange="qsnClozeOptionCountChange(<?php echo $qa['qsn_item_id'] ?>)">
						<?php echo $qsn_option_cloze_count;?>
						</select>
						</td>
						<td><div id="qsn_cloze_option_items_div_<?php echo $qa['qsn_item_id'] ?>"><?php echo $cloze_option_content?></div></td>
						<td class="action">&nbsp;<div class="action_toolbar">
						<div class="inner">
						<div class="right">
						</div><div class="inner_box">
						<div class="action_link">
						<a class="iframe" href="javascript:void(0)" onclick="qsnCleanCloze(<?php echo $qa['qsn_item_id'] ?>)"  title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						</div></div></div></div>
						</td>
						</tr>
						<?php }
						}?>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				
				<!-- // toolbar_bottom  -->
				
			</div>
		</div>
		<!-- 完型填空题选项end --> 
		
		<!-- 选择题选项(010101,010102)start --> 
		<div class="panel_1 con_input" id="qsn_options_div" name="qsn_options_div">
			<div class="title"><span><?php echo L::getText('答案选项', array('file'=>__FILE__, 'line'=>__LINE__))?></span><span style="color:#a0a0a0;float:left;margin-left:5px"><?php echo L::getText('通过勾选每个选项编号下面的框可以设置正确答案', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content item_q_col_2">
			<ul class="item_q q_1">
			<?php for($i = 0;$i<$this->qsn_max_option_count;$i++){?>
			<?php $is_answer = false; //是否是答案
			
			if(isset($this->qsn_obj['qsn_answer'])){
				foreach($this->qsn_obj['qsn_answer'] as $qa){
					if($qa['qsn_item_id'] == ($i+1))
					$is_answer = true;
				}
			}?>
				<li id="qsn_option_item_div_<?php echo $i+1;?>" name="qsn_option_item_div">
					<table class="editor_exam" width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col span="" style="" />
							<col span="" style="" />
						</colgroup>
						<tr>
							<td class="item_left">
								<h1 class=""><?php echo $this->qsn_option_tag[$i]['desc_cn']?></h1>
								<input type="radio" name="qsn_single_option" qsn_item_id="<?php echo $i+1;?>" <?php if($is_answer){?>checked="checked"<?php }?> value="<?php echo $this->qsn_option_tag[$i]['desc_cn']?>" />
								<input type="checkbox" name="qsn_multi_option" qsn_item_id="<?php echo $i+1;?>" <?php if($is_answer){?>checked="checked"<?php }?> value="<?php echo $this->qsn_option_tag[$i]['desc_cn']?>" />
							</td>
							<td class="item_right">
								<div class="editor_item">
									<textarea style="height:63px;" id="qsn_option_content_<?php echo $i+1;?>" name="qsn_option_content"><?php echo isset($this->qsn_obj['qsn_option'][($i+1).'_0']['option_content_edit'])?urldecode($this->qsn_obj['qsn_option'][($i+1).'_0']['option_content_edit']):''?></textarea>
								</div>
							</td>
						</tr>
					</table>
				</li>
			<?php }?>
			</ul>
			</div>
		</div>
		<!-- 选择题选项end --> 
		<!-- 判断题选项(010103)start --> 
		<div class="panel_1 con_input" id="qsn_judge_div" name="qsn_judge_div">
			<div class="title"><span><?php echo L::getText('答案选项', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content item_q_p2">
				<!-- // 主按钮区(分左中右) -->
				<div class="button_area_search">
					<div class="center">
						<label><input class="radiobox" type="radio" id="qsn_judge_option_yes" name="qsn_judge_option" value="yes" <?php if($this->qsn_obj['qsn_judge_select'] == 'yes'){?>checked="checked"<?php }?>/><label for="qsn_judge_option_yes"><img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_01.png" width="24" height="24" /> </label></label>
						&nbsp;&nbsp;
						<label><input class="radiobox" type="radio" id="qsn_judge_option_no" name="qsn_judge_option" value="no" <?php if($this->qsn_obj['qsn_judge_select'] == 'no'){?>checked="checked"<?php }?>/><label for="qsn_judge_option_no"><img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_02.png" width="24" height="24" /> </label></label>
					</div>
				</div>
			</div>
		</div>
		<!-- 判断题选项end --> 
		<!-- 问答题答案(010105,010106)start -->
		<div id="qsn_qna_div" name="qsn_qna_div" class="content">
			<div class="toolbar_top">
				<div class="left">
					<label><input class="radiobox" type="radio" name="has_sub_qsn" value="0" onclick="qsnQnaIsSubChange()" <?php if(empty($this->qsn_obj['sub_questions'])) {?> checked="checked"<?php }?> /><?php echo L::getText('问题答案', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
					<label><input class="radiobox" type="radio" name="has_sub_qsn" value="1" onclick="qsnQnaIsSubChange()" <?php if(!empty($this->qsn_obj['sub_questions'])) {?> checked="checked"<?php }?>/><?php echo L::getText('一问多答', array('file'=>__FILE__, 'line'=>__LINE__))?></label>&nbsp;
				<label id="qsn_qna_sub_answers_lab" name="qsn_qna_sub_answers_lab" ><a href="javascript:void(0)" onclick="qsnQnaAddSubQsn()"><span class="icon_add"></span><?php echo L::getText('添加子试题', array('file'=>__FILE__, 'line'=>__LINE__))?></a></label>
				</div>
			</div>
			<!-- // 编辑器 -->
			<div class="editor_item" style="" id="qsn_qna_answer_div" name="qsn_qna_answer_div">
				<div class="editor_item_inner">
					<textarea style="height:63px;" id="qsn_qna_answer"><?php  $qo_answer = isset($this->qsn_obj['qsn_answer'])?reset($this->qsn_obj['qsn_answer']):null;
					echo isset($qo_answer['qsn_answer'])?urldecode($qo_answer['qsn_answer']):'';?></textarea>
				</div>	
			</div>
			<div id="qsn_qna_sub_answers_div" name="qsn_qna_sub_answers_div">
			<?php if(!empty($this->qsn_obj['sub_questions'])){ 
				foreach($this->qsn_obj['sub_questions'] as $sq){ 
					$sq_answer = isset($sq['qsn_answer'])?reset($sq['qsn_answer']):null;?>
				<table class="item_q_con" width="100%" border="0" cellspacing="0" cellpadding="0" id="qsn_qna_sub_answer_div_<?php echo $sq['qsn_sub_position']?>" name="qsn_qna_sub_answer_div" value="<?php echo $sq['qsn_sub_position']?>">
				<colgroup><col style="" /><col style="" /><col style="" /></colgroup>
				<tr><td class="padding_right_15px">
				<div class="toolbar_top"><div class="left ~none"><?php echo L::getText('问题', array('file'=>__FILE__, 'line'=>__LINE__))?>：&nbsp;&nbsp;
				
				<?php echo L::getText('分数', array('file'=>__FILE__, 'line'=>__LINE__))?>：<input type="text" value="<?php echo $sq['qsn_point']?>" id="qsn_qna_point_<?php echo $sq['qsn_sub_position']?>" class="input_num ~auto_width" />
				&nbsp;&nbsp;<span name="qsn_qna_func_span"></span></div></div>
				<table class="editor_exam" width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup><col span="" style="" /><col span="" style="" /></colgroup>
				<tr><td class="item_left"><h1 class="" name="qsn_qna_sub_num_h">
				<?php echo $sq['qsn_sub_position']?></h1></td><td class="item_right">
				<div class="editor_item"><div class="editor_item_inner">
				<textarea style="width:500px;height:63px;" id="qsn_qna_content_<?php echo $sq['qsn_sub_position']?>" name="qsn_qna_content">
				<?php echo urldecode($sq['qsn_content_edit'])?></textarea></div>
				</div></td></tr></table></td><td><div class="toolbar_top">
				<div class="left ~none"><?php echo L::getText('答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：&nbsp;&nbsp;</div></div>
				<table class="editor_exam" width="100%" border="0" cellspacing="0" cellpadding="0"><colgroup>
				<col span="" style="" /><col span="" style="" /></colgroup>
				<tr><td class="item_left_a"><h1 class=""></h1>
				</td><td class="item_right"><div class="editor_item">
				<div class="editor_item_inner">
				<textarea style="width:400px;height:63px;" id="qsn_qna_answer_<?php echo $sq['qsn_sub_position']?>" name="qsn_qna_answer"><?php echo isset($sq_answer['qsn_answer'])?urldecode($sq_answer['qsn_answer']):''?></textarea>
				</div></div></td></tr></table><div class="toolbar_bottom"></div></td></tr></table>
			<?php }
			}?>
			</div>
		</div>
		<!-- 问答题答案end --> 	
	
		<!-- 综合题子试题列表(010107) -->
		<div class="panel_1 con_table" id="qsn_integrate_div" name="qsn_integrate_div">
			<div class="title"><span><?php echo L::getText('子试题', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<!-- // toolbar  -->
				<div class="toolbar_top">
					<div class="left">
						<a class="icon_link" href="javascript:void(0)" onclick="qsnAddOrUpdateSubQsn()" ><span class="icon_add"></span><?php echo L::getText('添加子试题', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
		
					</div>
				</div>
				<div class="clear"></div>
				<div class="table_content">
					<table width="100%" class="table1">
						<colgroup>
							<col style="width:10px;" />
							<col style="width:40px;" />
							<col style="width:90px;" />
						</colgroup>
						<thead>
							<tr>
								<th class="align_center"><input name="checkbox" type="checkbox" class="checkbox" id="checkbox" /></th>
								<th class="align_center"><?php echo L::getText('序号', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th class="align_center"><?php echo L::getText('排序', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('试题内容', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('题型', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('分数', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th class="action"></th>
							</tr>
						</thead>
						<tbody id="qsn_integrate_tbody">
							<?php if(!empty($this->qsn_obj['sub_questions'])){
									foreach($this->qsn_obj['sub_questions'] as $sq){
							?>
							<tr id="<?php echo (int)$sq['qsn_sub_position'] ?>">
							<td class="align_center">
						
							<input type="hidden" name="qsn_sub_info" id="qsn_sub_info_<?php echo (int)$sq['qsn_sub_position'] ?>" value="<?php echo urlencode(json_encode($sq));?>"/>
							<input name="qsn_sub_num" type="checkbox" class="checkbox" value="<?php echo (int)$sq['qsn_sub_position'] ?>"/>
							</td>
							<td class="align_center"><?php echo (int)$sq['qsn_sub_position'] ?></td>
							<td></td>
							<td><?php echo urldecode($sq['qsn_content_edit'])?></td>
							<td><?php echo $sq['qsn_type_desc']?></td>
							<td><?php echo $sq['qsn_point']?></td>
							<td class="action">&nbsp;
							<div class="action_toolbar" >
							<div class="inner"><div class="right"></div><div class="inner_box"><div class="action_link"><a class="iframe" href="javascript:void(0)" onclick="qsnAddOrUpdateSubQsn(<?php echo (int)$sq['qsn_sub_position'] ?>)" title="<?php echo L::getText('编辑', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('编辑', array('file'=>__FILE__, 'line'=>__LINE__))?></a></div></div></div></div>
							</td></tr>
							<?php }
								}?>
						</tbody>
						<tfoot></tfoot>
					</table>
					
				</div>
				
			</div>
		</div>
		<!-- 综合题子试题列表 end-->
		<!-- 答题解析start -->
		<div class="panel_1 con_input">
			<div class="title"><span onclick="$('#qsn_guide_div').toggle()"><?php echo L::getText('答题解析', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="editor_item" >
					<!-- 答题解析start -->
					<div class="editor_item_inner" id="qsn_guide_div" name="qsn_guide_div">
						<textarea style="width:98%; height:65px" id="qsn_guide" name="qsn_guide"><?php echo isset($this->qsn_obj['qsn_guide'])?urldecode($this->qsn_obj['qsn_guide']):'';?></textarea>
					</div>
					<!-- 答题解析end -->
								
				</div>
				
			</div>      
		</div>
        <div style=" clear:both;"></div>
<!-- 答题解析end -->
<input type="hidden" name="qsn_single_count" id="qsn_single_count" value="<?php echo (int)$this->qsn_obj['qsn_single_count']?>" />
<input type="hidden" name="qsn_multi_count" id="qsn_multi_count" value="<?php echo (int)$this->qsn_obj['qsn_multi_count']?>" />
