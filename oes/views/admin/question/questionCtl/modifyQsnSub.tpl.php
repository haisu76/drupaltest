<?php
$this->printHead(
         array(
             'title' => array('title'=>'修改子试题', 'file'=>__FILE__, 'line'=>__LINE__)
            ,'css'=>array('/main.css')
             ,'js' => array('/admin/question/question.js','/admin/common.js','/order_data.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
         )
     );
$commonPackage = new Of_Com_CommonPackage();
?>
<script>
//页面加载完毕后初始化试题
$(document).ready(function(){
	qsnInitEditPage(true);
});
</script>
<!-- 给完形填空题准备选项数量和标记,考虑设置完型填空初始选项数量,现在是4个 -->
<script>
var qsn_option_cloze_count = '<?php foreach($this->qsn_option_count as $qocv){?><option value="<?php echo $qocv['desc_cn']?>" <?php if($qocv['desc_cn'] == 4){?> selected="selected" <?php }?>><?php echo $qocv['desc_cn'] ?></option><?php }?>';
var QSN_MAX_OPTION_COUNT = <?php echo $this->qsn_max_option_count;?>;
var QSN_OPTION_TAG = new Array(<?php foreach($this->qsn_option_tag as $qot){?>'<?php echo $qot['desc_cn']?>',<?php }?>'over');
var QSN_TYPE = {<?php foreach($this->qsn_type as $qtv){?>'<?php echo $qtv['c_cde']?>':'<?php echo $qtv['desc_cn'] ?>',<?php }?>'x':'x'};
</script>
<div style="width: 760px" class="box block_1" id="qsn_params_div"><!-- // block_## 序号对应全局的颜色定义 -->
	<div style="width: 740px" class="box_inner">
<input type="hidden" id="is_alert_qsn" name="is_alert_qsn" value="<?php echo $this->is_alert_qsn;?>" />
	
<input type="hidden" name="qsn_id" id="qsn_id" value="<?php echo $this->qsn_obj['qsn_id']?>" />
<input type="hidden" name="qsn_sub_id" id="qsn_sub_id" value="<?php echo $this->qsn_obj['qsn_sub_id']?>" />
<input type="hidden" name="qsn_sub_qsn_num" id="qsn_sub_qsn_num" value="<?php echo $this->qsn_obj['qsn_sub_qsn_num']?>" />
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
							<td><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
							<select class="select3 ~auto_width" id="qsn_type" name="qsn_type" <?php if($this->qsn_obj['qsn_sub_qsn_num'] !== ''){?>disabled="disabled"<?php }?> onchange="qsnTypeChange(true)">
								<?php foreach($this->qsn_type as $qtv){
									if($qtv['c_cde']!="010107"){?>
								<option value="<?php echo $qtv['c_cde']?>" <?php if($qtv['c_cde'] == $this->qsn_obj['qsn_type']){?>selected="selected"<?php }?>><?php echo $qtv['desc_cn'] ?></option>
								<?php }}?>
								</select>
								&nbsp;&nbsp;
								<?php echo L::getText('选项数目', array('file'=>__FILE__, 'line'=>__LINE__))?>：
								<select class="select1 ~auto_width" id="qsn_option_count" name="qsn_option_count" onchange="qsnOptionCountChange(true)">
								<?php foreach($this->qsn_option_count as $qocv){?>
								<option value="<?php echo $qocv['desc_cn']?>" <?php if($qocv['desc_cn'] == ($this->qsn_obj['qsn_type']=='010102'?$this->qsn_obj['qsn_multi_count']:$this->qsn_obj['qsn_single_count'])){?>selected="selected"<?php }?>><?php echo $qocv['desc_cn'] ?></option>
								<?php }?>
								</select>
							</td>
							
							<td><?php echo L::getText('缺省分数', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 ~auto_width" id="qsn_point" name="qsn_point" type="text" value="<?php echo $this->qsn_obj['qsn_point']?>"></td>
					
						</tr>
						
					
					</table>
				</div>
				
			
			  
			</div>
		</div>
<input type="hidden" name="qsn_single_count" id="qsn_single_count" value="<?php echo $this->qsn_obj['qsn_single_count']?>" />
<input type="hidden" name="qsn_multi_count" id="qsn_multi_count" value="<?php echo $this->qsn_obj['qsn_multi_count']?>" />
	<!-- //  -->
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('试题描述', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<!-- // 编辑器 -->
				<div class="editor_item" style="">
					
						<!-- 普通试题内容层start -->
						<div class="editor_item_inner" id="qsn_normal_content_div" name="qsn_content_div">
						<textarea id="qsn_normal_content" style="width:98%; height:150px;" name="qsn_normal_content"><?php echo isset($this->qsn_obj['qsn_content_edit'])?urldecode($this->qsn_obj['qsn_content_edit']):'';?></textarea>
						</div>
						<!-- 普通试题内容层end -->
						
						<!-- 填空题试题内容层start -->
						<div class="editor_item_inner" id="qsn_blank_content_div" name="qsn_content_div">
						<textarea id="qsn_blank_content" style="width:98%; height:150px;" name="qsn_blank_content"><?php echo isset($this->qsn_obj['qsn_content_edit'])?urldecode($this->qsn_obj['qsn_content_edit']):'';?></textarea>
							
						</div>
						<!-- 填空题试题内容层end -->
						
						<!-- 完型填空题试题内容层start -->
						<div class="editor_item_inner" id="qsn_cloze_content_div" name="qsn_content_div">
						<textarea id="qsn_cloze_content" style="width:98%; height:150px;" name="qsn_cloze_content"><?php echo isset($this->qsn_obj['qsn_content_edit'])?urldecode($this->qsn_obj['qsn_content_edit']):'';?></textarea>
						</div>
						<!-- 完型填空题试题内容层end -->	
				</div>
			</div>
		</div>
		<!-- 填空题选项(010104)start --> 
		<div >
			<ul class="item_q q_2" name="qsn_blank_div" id="qsn_blank_div">
		<?php if(isset($this->qsn_obj['qsn_answer'])){foreach($this->qsn_obj['qsn_answer'] as $qa){?>
		<li id="qsn_blank_answer_div_<?php echo $qa['qsn_item_id']?>"  style=" height:30px; line-height:30px; padding-right:10px; margin:0px auto;" > 
		<table class="editor_exam" border="0" cellSpacing="0" cellPadding="0" width="100%">
		<colgroup><col span="1"><col span="1">
		</colgroup><tbody><tr>
		<td style="background: rgb(100, 180, 255); border: 1px solid rgb(1, 193, 255); width: 30px; height: 25px; text-align: center; color: rgb(255, 255, 255); line-height: 25px; margin-right: 5px; float: left;" class="item_left"><?php echo $qa['qsn_item_id']?></td>
		<td style="background: rgb(189, 234, 248); margin: 0px auto; border: 1px solid rgb(1, 193, 255); width: 80px; height: 25px; line-height: 25px; float: left;" class="item_right">
		<div class="editor_item">
		<input style="background: rgb(189, 234, 248); height: 23px; line-height: 23px; width:80px; margin-top: 2px;"  type="text" qsn_item_id="<?php echo $qa['qsn_item_id']?>" name="qsn_blank_answer" id="qsn_blank_answer_<?php echo $qa['qsn_item_id']?>" value="<?php echo urldecode($qa['qsn_answer'])?>"/></div></td>
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
										<input type="text" name="qsn_cloze_option_item_'.$qa['qsn_item_id'].'" id="qsn_cloze_option_item_'.$qa['qsn_item_id'].'_'.($qo['qsn_item_sub_id']-1).'" value="'.$qo['option_content_edit'].'" /></div>';
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
						<td class="action"><div class="action_toolbar">
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
			<div class="title"><span><?php echo L::getText('答案选项', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content item_q_col_2">
			<?php echo L::getText('通过勾选每个选项编号下面的框可以设置正确答案', array('file'=>__FILE__, 'line'=>__LINE__))?>
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
						<label><input class="radiobox" type="radio" name="qsn_judge_option" value="yes" <?php if($this->qsn_obj['qsn_judge_select'] == 'yes'){?>checked="checked"<?php }?> /><?php echo L::getText('正确答案', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
						&nbsp;&nbsp;
						<label><input class="radiobox" type="radio" name="qsn_judge_option" value="no" <?php if($this->qsn_obj['qsn_judge_select'] == 'no'){?>checked="checked"<?php }?>/><?php echo L::getText('错误答案', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
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
					<label><input class="radiobox" type="radio" name="has_sub_qsn" value="1" onclick="qsnQnaIsSubChange()" <?php if(!empty($this->qsn_obj['sub_questions'])) {?> checked="checked"<?php }?>/><?php echo L::getText('一问多答', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
					<label id="qsn_qna_sub_answers_lab" name="qsn_qna_sub_answers_lab" ><a href="javascript:void(0)" onclick="qsnQnaAddSubQsn(true)"><span class="icon_add"></span><?php echo L::getText('添加子试题', array('file'=>__FILE__, 'line'=>__LINE__))?></a></label>
				</div>
			</div>
			
			<!-- // 编辑器 -->
			<div class="editor_item" style="" id="qsn_qna_answer_div" name="qsn_qna_answer_div">
				<div class="editor_item_inner">
					<textarea style="height:63px;" id="qsn_qna_answer"><?php $qo_answer = isset($this->qsn_obj['qsn_answer'])?reset($this->qsn_obj['qsn_answer']):null;
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
				<?php echo L::getText('分数', array('file'=>__FILE__, 'line'=>__LINE__))?>：<input type="text" value="0" id="qsn_qna_point_<?php echo $sq['qsn_sub_position']?>" class="input_num ~auto_width" />
				&nbsp;&nbsp;<span name="qsn_qna_func_span"></span></div></div>
				<table class="editor_exam" width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup><col span="" style="" /><col span="" style="" /></colgroup>
				<tr><td class="item_left"><h1 class="" name="qsn_qna_sub_num_h">
				<?php echo $sq['qsn_sub_position']?></h1></td><td class="item_right">
				<div class="editor_item"><div class="editor_item_inner">
				<textarea style="height:63px;width:350px;" id="qsn_qna_content_<?php echo $sq['qsn_sub_position']?>" name="qsn_qna_content">
				<?php echo urldecode($sq['qsn_content_edit'])?></textarea></div>
				</div></td></tr></table></td><td><div class="toolbar_top">
				<div class="left ~none"><?php echo L::getText('答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：&nbsp;&nbsp;</div></div>
				<table class="editor_exam" width="100%" border="0" cellspacing="0" cellpadding="0"><colgroup>
				<col span="" style="" /><col span="" style="" /></colgroup>
				<tr><td class="item_left_a"><h1 class=""></h1>
				</td><td class="item_right"><div class="editor_item">
				<div class="editor_item_inner">
				<textarea style="height:63px;width:300px;" id="qsn_qna_answer_<?php echo $sq['qsn_sub_position']?>" name="qsn_qna_answer"><?php echo isset($sq_answer['qsn_answer'])?urldecode($sq_answer['qsn_answer']):''?></textarea>
				</div></div></td></tr></table><div class="toolbar_bottom"></div></td></tr></table>
			<?php }
			}?>
			</div>
		</div>
		<!-- 问答题答案end --> 	
<!-- 答题解析start -->
<div class="panel_1 con_input">
			<div class="title"><span onclick="$('#qsn_guide_div').toggle()"><?php echo L::getText('答题解析', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="editor_item" style="">
					<!-- 答题解析start -->
					<div class="editor_item_inner" id="qsn_guide_div" name="qsn_guide_div">
						<textarea style="height:63px;" id="qsn_guide" name="qsn_guide"><?php echo isset($this->qsn_obj['qsn_guide'])?urldecode($this->qsn_obj['qsn_guide']):'';?></textarea>
					</div>
					<!-- 答题解析end -->
				</div>
				
			</div>
		</div>
<!-- 答题解析end -->
<a href="javascript:void(0)" onclick="qsnModifySubQsn()" class="btn"><?php echo L::getText('确认', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
<a href="javascript:void(0)" onclick="window.parent.qsnCloseSubQsn(<?php echo $this->is_alert_qsn;?>)" class="btn"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
	</div><!-- // box_inner end -->
</div><!-- // box end -->