<div id="qsn_content_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>"  qsn_id="<?php echo $this->qsn_info['qsn_id']?>" name="qsn_content_div"  class="qt" style="<?php if(!$this->options['is_display']){?>display: none;<?php }?>">
	<input type="hidden" id="qsn_content_absposition_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="qsn_content_absposition" value="<?php echo $this->qsn_info['qsn_absposition']?>"  />
	<input type="hidden" id="exam_qsn_type_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_type" value="<?php echo $this->qsn_info['qsn_type']?>"  />
	<input type="hidden" id="exam_qsn_type_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_type_pos" value="<?php echo $this->qsn_info['qsn_type_position']?>"  />
	<input type="hidden" id="exam_qsn_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_pos" value="<?php echo $this->qsn_info['qsn_position']?>"  />
		<input type="hidden" id="exam_qsn_abs_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_abs_pos" value="<?php echo isset($this->qsn_info['qsn_abs_pos'])?$this->qsn_info['qsn_abs_pos']:1?>"  />
		<input type="hidden" id="is_sub_qsn_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="is_sub_qsn" value="0"  />
	<input type="hidden" id="qsn_limit_tm_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="qsn_limit_tm" value="<?php echo $this->qsn_info['qsn_limit_tm']?>"  />
	<div class="qt_main">
		<div class="inner">
			<div class="col_left">
				<?php if($this->options['is_show_qsn_position']){?>
				<h1 class="num"><?php echo isset($this->qsn_info['random_qsn_position'])?$this->qsn_info['random_qsn_position']:$this->qsn_info['qsn_position']?></h1>
				<?php }?>
				<?php if($this->options['allow_mark']){?>
				<h2 class="label_btn">
				<a class="icon_label_off" id="exam_mark_icon_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" title="进行标记" href="javascript:void(0)" onclick="examMarkQsn('<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>');return false;" ></a>
			</h2>
				<?php }?>
				<h3 class="score"><?php echo $this->qsn_info['qsn_point'];?><?php echo L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?>
				<input type="hidden" id="exam_qsn_point_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_point" value="<?php echo $this->qsn_info['qsn_point'];?>" />
				</h3>
				<?php if($this->options['is_show_result']){?>
			<h4 class="exam_result" name="exam_qsn_result" id="exam_qsn_result_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">
				<!-- // icon_exam_result_01:正确, icon_exam_result_02：错误, icon_exam_result_03：部分正确 -->
				<div class="icon_exam_result icon_exam_result_02" id="exam_qsn_result_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">&nbsp;</div>
			</h4>
				<?php }?>
			</div>
			<div class="col_right_01" style="width:90%">
				<!-- // 试题内容 -->
				<div class="content">
					<div class="qt_title">
						<?php echo htmlspecialchars_decode($this->qsn_info['qsn_content']);?>
					</div>
					<!-- 显示子试题 start -->
						<?php 
						$sub_qsn_position = 1;
						$qsn_display = new qsnDisplay_qsnDisplayCtl();
						$sub_options = $this->options;
						$sub_options['is_sub_qsn'] = true;
						$sub_qsn_point = 0;//子试题的分数，在非按提算分的情况下使用即 exam_point_type != '030202'
						if(isset($this->qsn_info['sub_questions'])){
							switch ($this->options['exam_point_type'])
							{
								case '030202':
									break;
								default:
									$sub_qsn_point = round($this->qsn_info['qsn_point']/count($this->qsn_info['sub_questions']),2);
									break;
							}
						
							foreach($this->qsn_info['sub_questions'] as $sq){
							 	$sq['sub_qsn_position'] = $sub_qsn_position;//子试题编号
							 	$sq['qsn_point'] = $this->options['exam_point_type']=='030202'?$sq['qsn_point']:$sub_qsn_point;//子试题分数
								$sq['qsn_absposition'] = $this->qsn_info['qsn_absposition'];
								$sq['qsn_type_position'] = $this->qsn_info['qsn_type_position'];
								$sq['qsn_position'] = $this->qsn_info['qsn_position'];
							 	$qsn_display->displaySingleQuestion($sq,$sub_options);
							 	$sub_qsn_position++;
							}
						}?>
					<!-- 显示子试题end -->
					
				</div>
			</div>
		</div><!-- // inner end -->
	</div>
	<!-- // 答案与解析 -->
	<?php if($this->options['is_show_info']){?>
	<div class="qt_result" name="qsn_answer_info_div">
		<div class="inner">
		
			<?php if($this->options['is_show_guide']){?>
			<dl class="answer_analysis">
				<dt><?php echo L::getText('答题解析', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
				<dd><?php echo htmlspecialchars_decode($this->qsn_info['qsn_guide'])?></dd>
			</dl>
			<?php }?>		
			
		</div>
	</div>
	<?php }?>
</div>