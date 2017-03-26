 <?php 
//如果不是综合题的子试题
if(!$this->options['is_sub_qsn']){?>
<div id="qsn_content_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_id="<?php echo $this->qsn_info['qsn_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>" name="qsn_content_div" class="qt" style=" <?php if(!$this->options['is_display']){?>display: none;<?php }?>">
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
				<a class="icon_label_off" id="exam_mark_icon_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" title="<?php echo L::getText('进行标记', array('file'=>__FILE__, 'line'=>__LINE__))?>" href="javascript:void(0)" onclick="examMarkQsn('<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>');return false;" ></a>
				</h2>
				<?php }?>
				
				<h3 class="score"><?php echo $this->qsn_info['qsn_point'];?><?php echo L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?>
				<input type="hidden" id="exam_qsn_point_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_point" value="<?php echo $this->qsn_info['qsn_point'];?>" />
				</h3>
				<?php if($this->options['is_show_result']){?>
				<span class="score">
				<h4 class="exam_result" name="exam_qsn_result" id="exam_qsn_result_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">
					<!-- // icon_exam_result_01:正确, icon_exam_result_02：错误, icon_exam_result_03：部分正确 -->
					<div class="icon_exam_result icon_exam_result_02" id="exam_qsn_result_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">&nbsp;</div>
				</h4>
				</span>
				<?php }?>
			</div>
			
			<div class="col_right_01" style="width: 90%">
				<!-- // 试题内容 -->
				<div class="content">
					<div class="qt_title">
						<?php echo htmlspecialchars_decode($this->qsn_info['qsn_content']);?>
					</div>
					<!-- // 答题内容 -->
					<?php //
					 if(!isset($this->qsn_info['sub_questions'])){if($this->options['is_show_hidden_answer']){?>
				
					<input type="hidden" id="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_answer" value='<?php echo str_replace("'",'\u0022',json_encode($this->qsn_info['qsn_answer']))?>' />
					<?php }?>
					<?php if(!$this->options['is_show_user_answer']){?>
					<div class="qt_content">
						<div class="textareaHolder"><!-- // 文本框 -->
							<div class="textarea_inner">
								<textarea class="input_bg1 auto_width" style="height:80px" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"  qsn_id="<?php echo $this->qsn_info['qsn_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>" rows="2"></textarea>
							</div>
						</div>
					</div>
					<?php }?>
					<?php }else{?>
					<!-- 显示子试题 start -->
						<?php $sub_qsn_position = 1;
						$sub_qsn_point = 0;//子试题的分数，在非按提算分的情况下使用即 exam_point_type != '030202'
						switch ($this->options['exam_point_type'])
						{
							case '030202':
								break;
							default:
								$sub_qsn_point = round($this->qsn_info['qsn_point']/count($this->qsn_info['sub_questions']),2);
								break;
						}
						 foreach($this->qsn_info['sub_questions'] as $sq){if($this->options['is_show_hidden_answer']){?>
							<input type="hidden" id="exam_qsn_answer_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>" name="exam_qsn_answer" value="<?php echo json_encode($sq['qsn_answer'])?>" />
							<?php }?>
							<div class="qt_content">
								<div class="qt_title qt_title_sub">
									<h1><?php echo L::getText('子问题', array('file'=>__FILE__, 'line'=>__LINE__))?><?php echo $sub_qsn_position?>：</h1>
									<span class="score"><?php echo $this->options['exam_point_type'] == '030202'?$sq['qsn_point']:$sub_qsn_point?><?php echo L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?>
									<input type="hidden" id="exam_qsn_point_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>" name="exam_qsn_point" value="<?php echo $this->options['exam_point_type'] == '030202'?$sq['qsn_point']:$sub_qsn_point?>" />
									</span>
									<?php //是否显示答案是否正确
									if($this->options['is_show_result']){?>
									<h4 class="exam_result" name="exam_qsn_result" id="exam_qsn_result_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>">
										<!--  // icon_exam_result_01:正确, icon_exam_result_02：错误, icon_exam_result_03：部分正确  -->
										<div class="icon_exam_result icon_exam_result_01" id="exam_qsn_result_div_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>">&nbsp;</div>
									</h4>
									<?php }?>
									<hr>
									<div class="">
										<?php echo htmlspecialchars_decode($sq['qsn_content']);?>
									</div>
									<?php if(!$this->options['is_show_user_answer']){?>
									<h1><?php echo L::getText('答', array('file'=>__FILE__, 'line'=>__LINE__))?>：</h1>
									<div class="textareaHolder"><!-- // 文本框 -->
										<div class="textarea_inner">
											<textarea class="input_bg1 auto_width" style="height:80px" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_id="<?php echo $sq['qsn_id']?>" qsn_sub_id="<?php echo $sq['qsn_sub_id']?>" rows=""></textarea>
										</div>
									</div>
									<?php }?>
									<?php if($this->options['is_show_info']){?>
									<!-- // 答案与解析 -->
									<div class="qt_result" name="qsn_answer_info_div">
										<div class="inner">
										<?php if($this->options['is_show_answer']){?>
											<dl class="answer_st">
												<dt><?php echo L::getText('标准答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
												<dd>
													<?php $sq_answer = isset($sq['qsn_answer'])?reset($sq['qsn_answer']):array('qsn_answer'=>'');
													echo htmlspecialchars_decode($sq_answer['qsn_answer'])?>
												</dd>
											</dl>
										<?php }?>
										<?php if($this->options['is_show_user_answer']){?>
											<dl class="answer_user answer_01 ~answer_02 ~answer_03">
												<dt><?php echo L::getText('用户答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
												<dd>
													<!-- // 答题内容 -->
													<div class="qt_content">
														<div class="content" id="user_answer_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>">
															
														</div>
													</div>
												</dd>
											</dl>
										<?php }?>
										<?php if($this->options['is_show_marking']){?>
											<dl class="answer_user answer_01 ~answer_02 ~answer_03">
												<dt><?php echo L::getText('评分', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
												<dd>
													<a href="javascript:void(0)" onclick="markingAlertMarking('<?php echo $sq['qsn_id']?>','<?php echo $sq['qsn_sub_id']?>')"><?php echo L::getText('评分', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
													<label id="is_marking_lab_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>"></label>
												</dd>
											</dl>
										<?php }?>
										<?php if($this->options['is_show_remark']){?>
										<dl class="answer_comment">
											<dt><?php echo L::getText('评语', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
											<dd id="remark_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>"></dd>
										</dl>
										<?php }?>
										</div>
									</div>
									<?php }?>
								</div>
							</div>
							<?php $sub_qsn_position++;
						 }?>
					<!-- 显示子试题end -->
					<?php }?>
				</div>
			</div>
		</div><!-- // inner end -->
	</div>
	<!-- // 答案与解析 -->
	<?php if($this->options['is_show_info']){?>
	<div class="qt_result" name="qsn_answer_info_div">
		<div class="inner">
		<?php //如果没有子试题，答案直接显示在试题下
			if(!isset($this->qsn_info['sub_questions'])){?>
			<?php if($this->options['is_show_answer']){?>
			<dl class="answer_st">
				<dt><?php echo L::getText('标准答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
				<dd>
					<?php $qn_answer = isset($this->qsn_info['qsn_answer'])?reset($this->qsn_info['qsn_answer']):array('qsn_answer'=>'');
					echo htmlspecialchars_decode($qn_answer['qsn_answer'])?>
				</dd>
			</dl>
			<?php }?>
			<?php if($this->options['is_show_user_answer']){?>
			<dl class="answer_user answer_01 ~answer_02 ~answer_03">
				<dt><?php echo L::getText('用户答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
				<dd  id="user_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></dd>
			</dl>
			<?php }?>
			<?php if($this->options['is_show_marking']){?>
					<dl class="answer_user answer_01 ~answer_02 ~answer_03">
						<dt><?php echo L::getText('评分', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
						<dd>
						<a href="javascript:void(0)" onclick="markingAlertMarking('<?php echo $this->qsn_info['qsn_id']?>','<?php echo $this->qsn_info['qsn_sub_id']?>')">评分</a>
						<label id="is_marking_lab_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></label>
						</dd>
					</dl>
				<?php }?>
				<?php if($this->options['is_show_remark']){?>
				<dl class="answer_comment">
					<dt><?php echo L::getText('评语', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
					<dd id="remark_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></dd>
				</dl>
				<?php }?>
		<?php }?>
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
<?php }else{?>
<div class="qt_content" id="qsn_content_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>" qsn_id="<?php echo $this->qsn_info['qsn_id']?>" name="qsn_content_div" class="qt" style="">
	<input type="hidden" id="qsn_content_absposition_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="qsn_content_absposition" value="<?php echo $this->qsn_info['qsn_absposition']?>"  />
	<input type="hidden" id="exam_qsn_type_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_type" value="<?php echo $this->qsn_info['qsn_type']?>"  />
	<input type="hidden" id="exam_qsn_type_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_type_pos" value="<?php echo $this->qsn_info['qsn_type_position']?>"  />
	<input type="hidden" id="exam_qsn_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_pos" value="<?php echo $this->qsn_info['qsn_position']?>"  />
		<input type="hidden" id="exam_qsn_abs_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_abs_pos" value="<?php echo isset($this->qsn_info['qsn_abs_pos'])?$this->qsn_info['qsn_abs_pos']:1?>"  />
		<input type="hidden" id="is_sub_qsn_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="is_sub_qsn" value="1"  />
	<div class="qt_title qt_title_sub">
		<h1><?php echo L::getText('问题', array('file'=>__FILE__, 'line'=>__LINE__))?><?php echo $this->qsn_info['sub_qsn_position']?>：</h1>
		<span class="score"><?php echo $this->qsn_info['qsn_point'];?>分
		<input type="hidden" id="exam_qsn_point_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_point" value="<?php echo $this->qsn_info['qsn_point'];?>" />
		</span>
		<?php if($this->options['is_show_result']){?>
		<span class="score">
		<h4 class="exam_result" name="exam_qsn_result" id="exam_qsn_result_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"><!--  // icon_exam_result_01:正确, icon_exam_result_02：错误, icon_exam_result_03：部分正确  -->
		<div class="icon_exam_result icon_exam_result_01" id="exam_qsn_result_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">&nbsp;</div>
		</h4>
		</span>
		<?php }?>
		<hr>
		<div class="content">
					<div class="qt_title">
						<?php echo htmlspecialchars_decode($this->qsn_info['qsn_content']);?>
					</div>
					<!-- // 答题内容 -->
					<?php if(!isset($this->qsn_info['sub_questions'])){
						if($this->options['is_show_hidden_answer']){?>
						<input type="hidden" id="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_answer" value='<?php echo str_replace("'",'\u0022',json_encode($this->qsn_info['qsn_answer']))?>'/>
					<?php }?>
					<?php if(!$this->options['is_show_user_answer']){?>
					<div class="qt_content">
						<div class="textareaHolder"><!-- // 文本框 -->
							<div class="textarea_inner">
								<textarea class="input_bg1 auto_width"  style="height:80px" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_id="<?php echo $this->qsn_info['qsn_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>" rows="2"></textarea>
							</div>
						</div>
					</div>
					<?php }?>
					<?php }else{?>
					<!-- 显示子试题 start -->
						<?php $sub_qsn_position = 1;
						$sub_qsn_point = 0;//子试题的分数，在非按提算分的情况下使用即 exam_point_type != '030202'
						
						switch ($this->options['exam_point_type'])
						{
							case '030202':
								break;
							default:
								$sub_qsn_point = round($this->qsn_info['qsn_point']/count($this->qsn_info['sub_questions']),2);
								break;
						}
						 foreach($this->qsn_info['sub_questions'] as $sq){//显示试题隐藏答案
							if($this->options['is_show_hidden_answer']){?>
							<input type="hidden" id="exam_qsn_answer_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>" name="exam_qsn_answer" value='<?php echo json_encode($sq['qsn_answer'])?>' />
							<?php }?>
							<div class="qt_content">
								<div class="qt_title qt_title_sub">
									<h1><?php echo L::getText('子问题', array('file'=>__FILE__, 'line'=>__LINE__))?><?php echo $sub_qsn_position?>：</h1>
									<span class="score"><?php echo $this->options['exam_point_type'] == '030202'?$sq['qsn_point']:$sub_qsn_point?><?php echo L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?>
									<input type="hidden" id="exam_qsn_point_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>" name="exam_qsn_point" value="<?php echo $this->options['exam_point_type'] == '030202'?$sq['qsn_point']:$sub_qsn_point?>" />
									</span>
									<?php //是否显示答案是否正确
									if($this->options['is_show_result']){?>
									<span class="score">
									<h4 class="exam_result" name="exam_qsn_result" id="exam_qsn_result_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>">
										<!--  // icon_exam_result_01:正确, icon_exam_result_02：错误, icon_exam_result_03：部分正确  -->
										<div class="icon_exam_result icon_exam_result_01" id="exam_qsn_result_div_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>">&nbsp;</div>
									</h4>
									</span>
									<?php }?>
									<hr>
									<div class="">
										<?php echo htmlspecialchars_decode($sq['qsn_content']);?>
									</div>
									<?php if(!$this->options['is_show_user_answer']){?>
									<h1><?php echo L::getText('答', array('file'=>__FILE__, 'line'=>__LINE__))?>：</h1>
									<div class="textareaHolder"><!-- // 文本框 -->
										<div class="textarea_inner">
											<textarea class="input_bg1 auto_width" style="height:80px" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_id="<?php echo $sq['qsn_id']?>" qsn_sub_id="<?php echo $sq['qsn_sub_id']?>" rows=""></textarea>
										</div>
									</div>
									<?php }?>
									<!-- // 答案与解析 -->
									<?php if($this->options['is_show_info']){?>
								
									<div class="qt_result" name="qsn_answer_info_div">
										<div class="inner">
										<?php if($this->options['is_show_answer']){?>
											<dl class="answer_st">
												<dt><?php echo L::getText('标准答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
												<dd>
													<?php $sq_answer = isset($sq['qsn_answer'])?reset($sq['qsn_answer']):array('qsn_answer'=>'');
													echo htmlspecialchars_decode($sq_answer['qsn_answer'])?>
												</dd>
											</dl>
										<?php }?>
										<?php if($this->options['is_show_user_answer']){?>
											<dl class="answer_user answer_01 ~answer_02 ~answer_03">
												<dt><?php echo L::getText('用户答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
												<dd>
													<!-- // 答题内容 -->
													<div class="qt_content">
														<div class="content" id="user_answer_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>">
															
														</div>
													</div>
												</dd>
											</dl>
										<?php }?>
										<?php if($this->options['is_show_marking']){?>
											<dl class="answer_user answer_01 ~answer_02 ~answer_03">
												<dt><?php echo L::getText('评分', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
												<dd>
													<!-- // 答题内容 -->
													
														<a href="javascript:void(0)" onclick="markingAlertMarking('<?php echo $sq['qsn_id']?>','<?php echo $sq['qsn_sub_id']?>')"><?php echo L::getText('评分', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
										
													<label id="is_marking_lab_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>"></label>
												</dd>
											</dl>
										<?php }?>
										<?php if($this->options['is_show_remark']){?>
										<dl class="answer_comment">
											<dt><?php echo L::getText('评语', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
											<dd id="remark_<?php echo $sq['qsn_id'].$sq['qsn_sub_id']?>"></dd>
										</dl>
										<?php }?>
											
										</div>
									</div>
									<?php }?>
								</div>
							</div>
							<?php $sub_qsn_position++;
						 }?>
					<!-- 显示子试题end -->
					<?php }?>
				</div>
		<!-- // 答案与解析 -->
		<?php if($this->options['is_show_info']){?>
		<div class="qt_result" name="qsn_answer_info_div">
			<div class="inner">
			<?php //如果有子试题，答案直接显示在子试题下
				if(!isset($this->qsn_info['sub_questions'])){?>
				<?php if($this->options['is_show_answer']){?>
				<dl class="answer_st">
					<dt><?php echo L::getText('标准答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
					<dd>
						<?php  $qn_answer = isset($this->qsn_info['qsn_answer'])?reset($this->qsn_info['qsn_answer']):array('qsn_answer'=>'');
						 echo htmlspecialchars_decode($qn_answer['qsn_answer'])?>
					</dd>
				</dl>
				<?php }?>
				<?php if($this->options['is_show_user_answer']){?>
				<dl class="answer_user answer_01 ~answer_02 ~answer_03">
					<dt><?php echo L::getText('用户答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
					<dd id="user_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></dd>
				</dl>
				<?php }?>
				<?php if($this->options['is_show_marking']){?>
					<dl class="answer_user answer_01 ~answer_02 ~answer_03">
						<dt><?php echo L::getText('评分', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
						<dd>
						<a href="javascript:void(0)" onclick="markingAlertMarking('<?php echo $this->qsn_info['qsn_id']?>','<?php echo $this->qsn_info['qsn_sub_id']?>')"><?php echo L::getText('评分', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<label id="is_marking_lab_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></label>
						</dd>
					</dl>
				<?php }?>
				<?php if($this->options['is_show_remark']){?>
				<dl class="answer_comment">
					<dt><?php echo L::getText('评语', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
					<dd id="remark_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></dd>
				</dl>
				<?php }?>
			<?php }?>
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
</div>
<?php }?>