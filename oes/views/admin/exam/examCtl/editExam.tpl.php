<div id="exam_info_div">
		<!-- // 考试设置 -->
		<div class="panel_1 con_input no_margin">
			<div class="title"><span><?php echo $exam_exe_str.L::getText('设置', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<input type="hidden" value="<?php echo $this->exam_obj['exam_id']?>" id="exam_id" name="exam_id" />
			<input type="hidden" value="<?php echo $this->exam_obj['exam_type']?>" id="exam_type" name="exam_type" />
			<div class="content">
				<div class="col_full">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:80px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><?php echo $exam_exe_str.L::getText('名称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td colspan="3"><input name="exam_name" type="text" class="input3 auto_width" id="exam_name" value="<?php echo $this->exam_obj['exam_name']?>" /></td>
						</tr>
						<tr>
							<td class="align_top"><?php echo $exam_exe_str.L::getText('须知', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td colspan="3">
								<!-- // 编辑器 -->
								<div class="editor_item" style="">
									<div class="editor_item_inner">
										<textarea style="width:98%" id="exam_notice" name="exam_notice"><?php echo isset($this->exam_obj['exam_notice'])?urldecode($this->exam_obj['exam_notice']):'';?></textarea>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
		
				<div class="panel_1 con_input">
					<div class="content">
						<div class="col_left col_left_01">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<colgroup>
									<col style="width:80px;" />
									<col style="" />
								</colgroup>
								<tr>
									<td><?php echo $exam_exe_str.L::getText('分类', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td>
									<a href="javascript:void(0)" onclick="examCategoryTreeShow('exam_category_name','exam_category')" id="exam_category_name" name="exam_category_name" ><?php echo $this->exam_obj['exam_category_desc'] == ''?L::getText('请选择分类', array('file'=>__FILE__, 'line'=>__LINE__)):$this->exam_obj['exam_category_desc']; ?></a>
									<input type="hidden" value="<?php echo $this->exam_obj['exam_category'] ?>" name="exam_category" id="exam_category" />
							
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><?php echo $exam_exe_str.L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td>
										<select class="select1 ~auto_width" id="exam_status" name="exam_status">
										<?php foreach($this->exam_status as $esv){
											if($esv['c_cde']!='030304'){?>
										<option value="<?php echo $esv['c_cde']?>" <?php if($esv['c_cde'] == $this->exam_obj['exam_status']){?>selected="selected"<?php }?>><?php echo $esv['desc_cn'] ?></option>
										<?php }}?>
										</select>	
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><?php echo $exam_exe_str.L::getText('模式', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td>
										<select class="select2 ~auto_width" id="exam_mode" name="exam_mode">
										<?php foreach($this->exam_mode as $emv){?>
										<option value="<?php echo $emv['c_cde']?>" <?php if($emv['c_cde'] == $this->exam_obj['exam_mode']){?>selected="selected"<?php }?>><?php echo $emv['desc_cn'] ?></option>
										<?php }?>
										</select>	
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><?php echo L::getText('及格分数', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td><input class="input1 ~auto_width" type="text" name="exam_passing_grade" id="exam_passing_grade" value="<?php echo $this->exam_obj['exam_passing_grade'] ?>" /></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><?php echo L::getText('计算方式', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td>
									
									<select class="select2 ~auto_width" style="width: 187px" id="exam_point_type" name="exam_point_type" onchange="examChangePointType()">
										<?php foreach($this->exam_point_type as $epv){
										if($this->exam_obj['exam_type'] != '0' || $epv['c_cde'] !='030202'){?>
										<option value="<?php echo $epv['c_cde']?>" <?php if($epv['c_cde'] == $this->exam_obj['exam_point_type']){?>selected="selected"<?php }?>><?php echo $epv['desc_cn'] ?></option>
										<?php }
										}?>
										</select>	<label id="exam_point_lb"><input class="input1 ~auto_width" type="text" name="exam_point" id="exam_point" value="<?php echo $this->exam_obj['exam_point'] ?>" />分</label>
									
									</td>
									<td></td>
								</tr>
								
								
							</table>
						</div>
						
						<div class="col_right2">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<colgroup>
									<col style="width:110px;" />
									<col style="" />
								</colgroup>
								<tr>
									<td><?php echo $exam_exe_str.L::getText('时间', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td>
										<input  class="input2 ~auto_width" style="width:160px" id="exam_begin_tm" name="exam_begin_tm" type="text" value="<?php echo $this->exam_obj['exam_begin_tm']?>">
										<input  class="input2 ~auto_width" style="width:160px" id="exam_end_tm" name="exam_end_tm" type="text" value="<?php echo $this->exam_obj['exam_end_tm']?>">
						
									</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td><?php echo L::getText('答卷时长', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td>
										<select class="select2 ~auto_width" id="exam_total_tm_mode" name="exam_total_tm_mode" onchange="examChangeTotalTmMode()">
											<option value="0" <?php if(0 == $this->exam_obj['exam_total_tm']){?>selected="selected"<?php }?>><?php echo L::getText('不限', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
											<option value="1" <?php if(0 != $this->exam_obj['exam_total_tm']){?>selected="selected"<?php }?>><?php echo L::getText('限制时长', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
										</select>	
										<label id="exam_total_tm_lb"><input class="input1 ~auto_width" type="text" name="exam_total_tm" id="exam_total_tm" value="<?php echo $this->exam_obj['exam_total_tm']?>" />分钟</label>
									</td>
								</tr>
								<?php //如果是考试，才会有下面的选项
								 if($this->exam_obj['exam_type'] == '0'){ ?>
								<tr>
									<td><?php echo L::getText('参考次数', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
									<td>
										<select class="select2 ~auto_width" style="width:158px" id="exam_times_mode" name="exam_times_mode" onchange="examChangeTimesMode()">
											<option value="0" <?php if(0 == $this->exam_obj['exam_times']){?>selected="selected"<?php }?>><?php echo L::getText('不限', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
											<option value="1" <?php if(0 != $this->exam_obj['exam_times']){?>selected="selected"<?php }?>><?php echo L::getText('限制每人最多参加次数', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
										</select>	
										<label id="exam_times_lb"><input class="input1 ~auto_width" type="text" name="exam_times" id="exam_times" value="<?php echo $this->exam_obj['exam_times']?>" />次</label>
									
									</td>
								</tr>
						<?php }?>
								<tr>
									<td><a href="javascript:void(0)" class="icon_link" id="exam_add_tag_a" onclick="examDisplayTag()"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;+</a>
									</td>
									<td id="exam_tag_td">
									<?php if(isset($this->exam_obj['tag_ids'])&&$this->exam_obj['tag_ids'][0]!=''){
								foreach ($this->exam_obj['tag_ids'] as $tik=>$tiv){
								?>
								<span class="icon_link" id="exam_tag_span_<?php echo $tiv?>">
								<input type="hidden" name="exam_tags" id="exam_tag_<?php echo $tiv?>" value="<?php echo $tiv?>">
								<a href="javascript:void(0)" ><?php echo $this->exam_obj['tag_names'][$tik]?></a>
								<a class="icon_del" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>" href="javascript:void(0)" onclick="examDelTag('<?php echo $tiv?>')"></a></span>
							<?php }
							}?>
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><?php echo L::getText('数据分组', array('file'=>__FILE__, 'line'=>__LINE__)); ?>：</td>
									<td id="exam_group_td">
									
										</td>
									<td>&nbsp;</td>
								</tr>
								
							</table>
						</div>
						<?php echo admin_user_permissions::dataStratifiedHtml(empty($this->exam_obj['exam_id']) ? null : $this->exam_obj['exam_id'], 't_exam','','exam_group_td'); ?>
						<div class="clear"></div>
						
						<hr class="hr_line" noshade="noshade">
						
						<div class="col_full">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<colgroup>
									<col style="width:80px" />
								</colgroup>
								
								<tr>
									<td>&nbsp;</td>
									<td><label style="cursor:pointer;" for="exam_blank_flg"><input name="exam_blank_flg" type="checkbox" class="checkbox" id="exam_blank_flg" <?php if($this->exam_obj['exam_blank_flg'] == '1'){?>checked="checked"<?php }?> /><?php echo L::getText('填空题按空算分', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<td><label style="cursor:pointer;" for="exam_cloze_flg"><input name="exam_cloze_flg" type="checkbox" class="checkbox" id="exam_cloze_flg" <?php if($this->exam_obj['exam_cloze_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('完形填空题按空算分', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<td><label style="cursor:pointer;" for="exam_user_verify_flg"><input name="exam_user_verify_flg" type="checkbox" class="checkbox" id="exam_user_verify_flg" <?php if($this->exam_obj['exam_user_verify_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('未审核用户不能参加', array('file'=>__FILE__, 'line'=>__LINE__)).$exam_exe_str?></label></td>
									<td>
									<label style="cursor:pointer;" for="exam_time_consistency_flg"><input name="exam_time_consistency_flg" type="checkbox" class="checkbox" id="exam_time_consistency_flg" <?php if($this->exam_obj['exam_time_consistency_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('答卷时长与', array('file'=>__FILE__, 'line'=>__LINE__)).$exam_exe_str.L::getText('时间一致', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
								</tr>
								<?php //如果是考试，才会有下面的选项
								 if($this->exam_obj['exam_type'] == '0'){ ?>
								<tr>
									<td>&nbsp;</td>
									<td><label style="cursor:pointer;" for="exam_publish_result_flg"><input name="exam_publish_result_flg" type="checkbox" class="checkbox" id="exam_publish_result_flg" <?php if($this->exam_obj['exam_publish_result_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('是否显示排名', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<td><label style="cursor:pointer;" for="exam_disable_paste_flg"><input name="exam_disable_paste_flg" type="checkbox" class="checkbox" id="exam_disable_paste_flg" <?php if($this->exam_obj['exam_disable_paste_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('答卷时禁用粘贴', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<td><label style="cursor:pointer;" for="exam_mouse_right_flg"><input name="exam_mouse_right_flg" type="checkbox" class="checkbox" id="exam_mouse_right_flg" <?php if($this->exam_obj['exam_mouse_right_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('答卷时禁用鼠标右键', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<td><label style="cursor:pointer;" for="exam_ie_only_flg"><input name="exam_ie_only_flg" type="checkbox" onclick="examChangeExamQsnLimitTime()" class="checkbox" id="exam_ie_only_flg" <?php if($this->exam_obj['exam_ie_only_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('答题限时', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><label style="cursor:pointer;" for="exam_paper_only_one_flg"><input name="exam_paper_only_one_flg" type="checkbox" class="checkbox" id="exam_paper_only_one_flg" <?php if($this->exam_obj['exam_paper_only_one_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('不在考试列表中显示', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<td><label style="cursor:pointer;" for="exam_passing_again_flg"><input name="exam_passing_again_flg" type="checkbox" class="checkbox" id="exam_passing_again_flg" <?php if($this->exam_obj['exam_passing_again_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('及格后不能再次', array('file'=>__FILE__, 'line'=>__LINE__)).$exam_exe_str?></label></td>
									<td><label style="cursor:pointer;" for="exam_publish_answer_flg"><input name="exam_publish_answer_flg" type="checkbox" class="checkbox" id="exam_publish_answer_flg" <?php if($this->exam_obj['exam_publish_answer_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('允许考生查看卷子和答案', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<td><label style="cursor:pointer;" for="exam_submit_display_result"><input name="exam_submit_display_result" type="checkbox" class="checkbox" id="exam_submit_display_result" <?php if($this->exam_obj['exam_submit_display_result'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('交卷后立刻显示成绩', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									
									<td>
									<label style="cursor:pointer;" for="exam_qsn_random_flg"><input name="exam_qsn_random_flg" type="checkbox" class="checkbox" id="exam_qsn_random_flg" <?php if($this->exam_obj['exam_qsn_random_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('试题顺序随机', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
									</td>
									<?php 
									$exam_mod_hide_count = 0;
									//断电保护
									if(!getLicenceInfo('Disable','exam_recovery')){?>
									<td><label style="cursor:pointer;" for="exam_recovery_flg"><input name="exam_recovery_flg" type="checkbox" class="checkbox" id="exam_recovery_flg" <?php if($this->exam_obj['exam_recovery_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('启用断电保护', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<?php }else{
										$exam_mod_hide_count++;
									}?>
									<?php if(!getLicenceInfo('Disable','monitor_exam')){?>
									<td><label style="cursor:pointer;" for="exam_disable_monitor_flg"><input name="exam_disable_monitor_flg" type="checkbox" class="checkbox" id="exam_disable_monitor_flg" <?php if($this->exam_obj['exam_disable_monitor_flg'] == '0'){?>checked="checked"<?php }?>/><?php echo L::getText('启用监控', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<?php }else{
										$exam_mod_hide_count++;
									}?>
									<?php if(!getLicenceInfo('Disable','exam_full_screen')){?>
									<td><label style="cursor:pointer;" for="exam_full_screen_flg"><input name="exam_full_screen_flg" type="checkbox" class="checkbox" id="exam_full_screen_flg" <?php if($this->exam_obj['exam_full_screen_flg'] == '1'){?>checked="checked"<?php }?>/><?php echo L::getText('试卷全屏防作弊(仅IE浏览器)', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
									<?php }else{
										$exam_mod_hide_count++;
									}?>
									<?php for($i=0;$i<$exam_mod_hide_count;$i++){?>
									<td></td>
									<?php }?>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td colspan="2"><label style="cursor:pointer;" for="exam_publish_result_tm_mode"><input name="exam_publish_result_tm_mode" type="checkbox" class="checkbox" id="exam_publish_result_tm_mode" onclick="examChangePublishResultTmMode()" <?php if(!empty($this->exam_obj['exam_publish_result_tm'])){?>checked="checked" <?php }?>/><?php echo L::getText('成绩发布时间', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
										<label id="exam_publish_result_tm_lb" ><input  class="input2 ~auto_width" style="width:160px" id="exam_publish_result_tm" name="exam_publish_result_tm" type="text" value="<?php echo $this->exam_obj['exam_publish_result_tm']?>"></label>
										</td>
						
									<td colspan="2"><label><?php echo L::getText('开始', array('file'=>__FILE__, 'line'=>__LINE__)).$exam_exe_str?>
										<input class="input1 ~auto_width" type="text" name="exam_disable_minute" id="exam_disable_minute" value="<?php echo $this->exam_obj['exam_disable_minute'] ?>" /><?php echo L::getText('分钟后禁止考生参加', array('file'=>__FILE__, 'line'=>__LINE__))?>
										</label></td>
								</tr>
							
								<tr>
									<td>&nbsp;</td>
									<td colspan="2">
										<label style="cursor:pointer;" for="exam_manual"><input name="exam_manual" type="checkbox" class="checkbox" id="exam_manual" <?php if($this->exam_obj['exam_manual'] == '1'){?>checked="checked"<?php }?> onclick="examChangeExamManualMode()"/><?php echo L::getText('需要人工评分', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
										
											<label id="exam_manual_lb"><a href="javascript:void(0)" onclick="examAdminTreeShow('exam_manual_tree_btn',examAddManual)" id="exam_manual_tree_btn"><?php echo L::getText('请选择评卷人', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
											<label id="exam_manual_list_lb">
											<?php if(isset($this->exam_obj['exam_marker'])){
														foreach($this->exam_obj['exam_marker'] as $em){
												?>
											<label id="exam_manual_<?php echo $em['user_id']?>_lb"><input type="hidden" name="exam_manual_list" id="exam_manual_<?php echo $em['user_id']?>" value="<?php echo $em['user_id']?>"/><?php echo $em['real_name']?>
											<a class="icon_del" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>" href="javascript:void(0)" onclick="examDelManual('<?php echo $em['user_id']?>')"></a></label>
											<?php }
											}?>
											</label>
											</label>
										
									</td>
									<td colspan="2"><label><?php echo L::getText('开始考试', array('file'=>__FILE__, 'line'=>__LINE__))?>
										<input class="input1 ~auto_width" type="text" name="exam_disable_submit" id="exam_disable_submit" value="<?php echo $this->exam_obj['exam_disable_submit'] ?>" /><?php echo L::getText('分钟内禁止考生交卷', array('file'=>__FILE__, 'line'=>__LINE__))?>
										</label></td>
								</tr>
								<?php if(getLicenceInfo('Module','exam_allow_ip')){?>
								<tr>
									<td>&nbsp;</td>
									<td>
										<a id="exam_exclude_user_a" href="javascript:void(0)" onclick="examAllowIpShow()"><?php echo L::getText('添加登录IP段', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
									</td>
									<td colspan="3" id="allow_ip_td">
									<?php if(isset($this->exam_obj['exam_allow_ip'])&&!empty($this->exam_obj['exam_allow_ip'])){
							
									$exam_allow_ip_array = explode(",",$this->exam_obj['exam_allow_ip']);
									
									foreach($exam_allow_ip_array as $eaik=>$eaiv){
										$exam_se_ip = explode("-",$eaiv);
										?>
										<div id="allow_ip_div_<?php echo $eaik?>">
										<input type="hidden" name="allow_ip_mark" id="allow_ip_mark_<?php echo $eaik?>" value="<?php echo $eaik?>"/>
										<input type="text" value="<?php echo $exam_se_ip[0]?>" id="exam_allow_ip_start_<?php echo $eaik?>" name="exam_allow_ip_start" class="input3 ~auto_width">
										-
										<input type="text" value="<?php echo $exam_se_ip[1]?>" id="exam_allow_ip_end_<?php echo $eaik?>" name="exam_allow_ip_end" class="input3 ~auto_width">
										<a class="icon_del" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>" a href="javascript:void(0)" onclick="examDelAllowIp('<?php echo $eaik?>')"></a>
									</div>
									<?php }
									}?>
									</td>
								</tr>
								<?php }?>
							<?php }?>
							</table>
						</div>
						
					</div>
				</div>
				
				
				<!-- // 搜索过滤 -->
				<div class="panel_1 con_input no_margin">
					<div class="title"><span><?php echo L::getText('试卷列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
				</div>
			</div>
		</div>
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
		
			<div class="content">
				<div class="table_content">
					<table width="100%" class="table1">
						<colgroup>
							<col style="width:10px;" />
						</colgroup>
						<thead>
							<tr>
								<th class="align_center"><input name="exam_papr_cb" type="checkbox" class="checkbox" onclick="checkAllCheckBox('exam_papr_id',this)" id="exam_papr_cb" /></th>
								<th><?php echo L::getText('试卷名称', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('分类', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('总分', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('试题数量', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('创建人', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
								<th><?php echo L::getText('操作', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							</tr>
						</thead>
						<tbody id="exam_paprs_tbody">
						<?php if(isset($this->exam_obj['exam_papr'])){
							foreach($this->exam_obj['exam_papr'] as $po){
							?>
							<tr id="exam_papr_tr_<?php echo $po['papr_id']?>"><td class="align_center">
    		<input name="exam_papr_id" value="<?php echo $po['papr_id']?>" type="checkbox" class="checkbox" id="exam_papr_id_cb_<?php echo $po['papr_id']?>"/></td>
				<td><?php echo $po['papr_name']?></td>
				<td><?php echo $po['papr_category_desc']?></td>
				<td><input type="hidden" name="exam_papr_point" id="exam_papr_point_<?php echo $po['papr_point']?>" value="<?php echo $po['papr_point']?>"><?php echo $po['papr_point']?></td>
				<td><?php echo $po['papr_qsn_count']?></td>
				<td><?php echo $po['create_user_name']?></td>
				<td><a class="iframe" href="javascript:void(0)" onclick="examDelPaper('<?php echo $po['papr_id']?>')" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							
				</td>
			</tr>
						<?php }
						}?>	
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				<!-- // toolbar_bottom  -->
				<div class="toolbar_bottom">
					<div class="left">
					<a href="javascript:void(0)" onclick="examAlertAddPaper()" id="selectPaper"><?php echo L::getText('请选择试卷', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					<a href="javascript:void(0)" onclick="examDelPaper('selected')" class="" ><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
					
					<div class="right">
					
					</div>
					
				</div>
			</div>
		</div>
		
		<!-- // 指定人员+表格数据 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('指定参加对象', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="col_full"  id="tabs1">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="">
						<colgroup>
							<col style="width:90px;" />
							<col style="width:400px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><label class="tab_item"><input class="radiobox" name="exam_target" type="radio" id="exam_all_person" <?php if($this->exam_obj['exam_all_person'] == '1'){?>checked="checked"<?php }?> value="exam_all_person" onclick="examChangeExamTarget()"/><?php echo L::getText('所有人', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
							<td><label class="tab_item"><input class="radiobox" name="exam_target" type="radio" id="exam_group_user" <?php if($this->exam_obj['exam_all_person'] != '1'){?>checked="checked"<?php }?> value="exam_group_user" onclick="examChangeExamTarget()" /><?php echo L::getText('指定组/用户', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
							<label id="exam_group_user_lb" style="display: none;">
							<a id="exam_group_a" href="javascript:void(0)" onclick="examGroupTreeShow();return false;"><?php echo L::getText('请选择组', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<a id="exam_user_a" href="javascript:void(0)" onclick="examAlertAddUser();return false;"><?php echo L::getText('请选择用户', array('file'=>__FILE__, 'line'=>__LINE__))?></a></label>
							<a id="exam_exclude_user_a" href="javascript:void(0)" onclick="examAlertExcludeUser();return false;"><?php echo L::getText('请选择排除用户', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							</td>
							<td>
							
							</td>
						</tr>
						<tr>
							<td colspan="3"><label><input name="exam_user_signup_flg" type="checkbox" class="checkbox" id="exam_user_signup_flg" <?php if($this->exam_obj['exam_user_signup_flg'] == '1'){?>checked="checked" <?php }?>/><?php echo L::getText('用户必须报名才能参加', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
						</tr>
					</table>
					
					<!-- // tab -->
					<div id="exam_group_div" class="tab_content">
						<!-- // 指定组-->
					    <?php echo L::getText('指定组', array('file'=>__FILE__, 'line'=>__LINE__))?>：
						<div class="table_content">
							<table width="100%" class="table1">
								<colgroup>
									<col style="width:10px;" />
									<col style="" />
									<col style="width:110px;" />
									<col style="width:560px;" />
								</colgroup>
								<thead>
									<tr>
										<th class="align_center"><input name="exam_group_cb" type="checkbox" class="checkbox" id="exam_group_cb" onclick="checkAllCheckBox('exam_group_id',this)" /></th>
										<th><?php echo L::getText('组名称', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('是否包含下级组', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('组描述', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th></th>
									</tr>
								</thead>
								
								<tbody id="exam_group_tbody">
									<?php if(isset($this->exam_obj['exam_group'])){
							foreach($this->exam_obj['exam_group'] as $gp){
							?>
					<tr id="exam_group_tr_<?php echo $gp['group_id']?>">
    	<td class="align_center">
    	<input name="exam_group_id" type="checkbox" class="checkbox" id="exam_group_cb_<?php echo $gp['group_id']?>" value="<?php echo $gp['group_id']?>" />
    	</td>
    	<td><?php echo $gp['group_name']?></td>
    	<td class="align_center"><input name="exam_is_include_sub" type="checkbox" class="checkbox" <?php if($gp['is_include_sub'] == '1'){?> checked="checked"<?php }?> id="exam_is_include_sub_<?php echo $gp['group_id']?>" value="<?php echo $gp['group_id']?>" />
    	</td>
    	<td><?php echo $gp['group_desc']?></td><td  >&nbsp;
    	<a class="~iframe" href="javascript:void(0)" onclick="examDelGroup('<?php echo $gp['group_id']?>')" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
    	</td></tr>
						<?php }
						}?>	
								</tbody>
								<tfoot>
								</tfoot>
							</table>
						
						</div>
						<div class="toolbar_bottom">
							<div class="left">
								<a href="javascript:void(0)" onclick="examDelGroup('selected')" class="" ><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							</div>
							
							<div class="right">
					
							</div>
							
						</div>
					</div>
					
					<!-- // tab -->
					<div id="exam_user_div" class="tab_content">
					   <?php echo L::getText('指定用户', array('file'=>__FILE__, 'line'=>__LINE__))?>：
						<div class="table_content">
							<table width="100%" class="table1">
								<colgroup>
									<col style="width:10px;" />
									<col style="width:150px;" />
									<col style="width:100px;" />
									<col style="" />
								</colgroup>
								<thead>
									<tr>
										<th class="align_center"><input name="exam_user_cb" type="checkbox" class="checkbox" id="exam_user_cb" onclick="checkAllCheckBox('exam_user_id',this);" /></th>
										<th><?php echo L::getText('用户名', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('姓名', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('电子邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('所属组', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th class="action"></th>
									</tr>
								</thead>
								
								<tbody id="exam_user_tbody">
									<?php if(isset($this->exam_obj['exam_user'])){
							foreach($this->exam_obj['exam_user'] as $uo){
							?>
					<tr id="exam_user_tr_<?php echo $uo['user_id']?>">
					<td class="align_center"><input name="exam_user_id" value="<?php echo$uo['user_id']?>" type="checkbox" class="checkbox" id="exam_user_id_cb_<?php echo$uo['user_id']?>" /></td>
					<td><?php echo$uo['username']?></td>
					<td><?php echo$uo['real_name']?></td>
					<td><?php echo$uo['email']?></td>
					<td><?php echo$uo['group_name']?></td>
					<td><a class="~iframe" href="javascript:void(0)" onclick="examDelUser('<?php echo$uo['user_id']?>')" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a></td>
				</tr>
						<?php }
						}?>	
								</tbody>
								
								<tfoot></tfoot>
							</table>
						
						</div>
						<div class="toolbar_bottom">
							<div class="left">
								<a href="javascript:void(0)" onclick="examDelUser('selected')" class="" ><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							</div>
							
							<div class="right">
					
							</div>
							
						</div>
					</div>
					<div id="exam_exclude_user_div" class="tab_content">
					    <?php echo L::getText('排除用户', array('file'=>__FILE__, 'line'=>__LINE__))?>：
						<div class="table_content">
							<table width="100%" class="table1">
								<colgroup>
									<col style="width:10px;" />
									<col style="width:150px;" />
									<col style="width:100px;" />
									<col style="" />
								</colgroup>
								<thead>
									<tr>
										<th class="align_center"><input name="exam_exclude_user_cb" type="checkbox" class="checkbox" id="exam_exclude_user_cb" onclick="checkAllCheckBox('exam_exclude_user_id',this)" /></th>
										<th><?php echo L::getText('用户名', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('姓名', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('电子邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th><?php echo L::getText('所属组', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
										<th class="action"></th>
									</tr>
								</thead>
								
								<tbody id="exam_exclude_user_tbody">
										<?php if(isset($this->exam_obj['exam_exclude_user'])){
							foreach($this->exam_obj['exam_exclude_user'] as $uo){
							?>
					<tr id="exam_exclude_user_tr_<?php echo $uo['user_id']?>">
					<td class="align_center"><input name="exam_exclude_user_id" value="<?php echo $uo['user_id']?>" type="checkbox" class="checkbox" id="exam_exclude_user_id_cb_<?php echo $uo['user_id']?>" /></td>
					<td><?php echo $uo['username']?></td>
					<td><?php echo $uo['real_name']?></td>
					<td><?php echo $uo['email']?></td>
					<td><?php echo $uo['group_name']?></td>
					<td class="action" ><a class="~iframe" href="javascript:void(0)" onclick="examDelExcludeUser('<?php echo $uo['user_id']?>')" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a></td>
				</tr>
						<?php }
						}?>	
								</tbody>
								
								<tfoot></tfoot>
							</table>
						
						</div>
						<div class="toolbar_bottom">
							<div class="left">
								<a href="javascript:void(0)" onclick="examDelExcludeUser('selected')" class="" ><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							</div>
							
							<div class="right">
					
							</div>
							
						</div>
					</div>
				
				</div>
			</div>
		</div>
		</div>
