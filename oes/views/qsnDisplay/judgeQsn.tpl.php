<?php 
//如果不是综合题的子试题
//显示试题隐藏答案
if($this->options['is_show_hidden_answer']){
?>

<input type="hidden" id="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_answer" value='<?php echo json_encode($this->qsn_info['qsn_answer'])?>' />
<?php }
if(!$this->options['is_sub_qsn']){?>
<div id="qsn_content_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>" qsn_id="<?php echo $this->qsn_info['qsn_id']?>" name="qsn_content_div"  class="qt" style="<?php if(!$this->options['is_display']){?>display: none;<?php }?>">
	
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
				<h4 class="exam_result" name="exam_qsn_result" id="exam_qsn_result_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">
					<!-- // icon_exam_result_01:正确, icon_exam_result_02：错误, icon_exam_result_03：部分正确 -->
					<div class="icon_exam_result icon_exam_result_02" id="exam_qsn_result_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">&nbsp;</div>
				</h4>
				<?php }?>
			</div>
			
			<div class="col_right_01">
				<!-- // 试题内容 -->
				<div class="content">
					<div class="qt_title">
						<?php echo htmlspecialchars_decode($this->qsn_info['qsn_content']);?>
					</div>
					<!-- // 答题内容 -->
					
					<div class="qt_content">
						<dl class="qt_exam_title">
							<dt>
							<input class="radiobox" id="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_yes" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" type="radio" value="yes" />
							 </dt>
							<dd>
								<div class="qt_c">
								<label for="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_yes"><img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_01.png" width="24" height="24" /> </label>
								</div>
							</dd>
						</dl>
						
						<dl class="qt_exam_title">
							<dt>
							
							<input class="radiobox" id="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_no" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" type="radio" value="no" />
							 </dt>
							<dd>
								<div class="qt_c">
								<label for="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_no"><img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_02.png" width="24" height="24" /> </label>
								</div>
							</dd>
						</dl>
						
					</div>
				</div>
			</div>
		</div><!-- // inner end -->
	</div>

	<!-- // 答案与解析 -->
	<?php if($this->options['is_show_info']){?>
	<div class="qt_result" name="qsn_answer_info_div">
		<div class="inner">
			<?php if($this->options['is_show_answer']){?>
			<dl class="answer_st">
				<dt><?php echo L::getText('标准答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
				<dd>
				
					<?php 
					$qsn_answer = isset($this->qsn_info['qsn_answer'])?reset($this->qsn_info['qsn_answer']):array('qsn_answer'=>'');
					if( $qsn_answer['qsn_answer'] == 'yes'){?>
					<img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_01.png" width="24" height="24" /> 
					<?php }else{?>
					<img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_02.png" width="24" height="24" /> 
					<?php }?>
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
			<?php if($this->options['is_show_guide']){?>
			<dl class="answer_analysis">
				<dt><?php echo L::getText('答题解析', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
				<dd><?php echo htmlspecialchars_decode($this->qsn_info['qsn_guide'])?></dd>
			</dl>
			<?php }?>		
			<?php if($this->options['is_show_remark']){?>
			<dl class="answer_comment">
				<dt><?php echo L::getText('评语', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
				<dd id="remark_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></dd>
			</dl>
			<?php }?>
		</div>
	</div>
	<?php }?>
</div>
<?php }else{?>
<div class="qt_content ~none" id="qsn_content_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>" qsn_id="<?php echo $this->qsn_info['qsn_id']?>" name="qsn_content_div"  style="">
	<input type="hidden" id="qsn_content_absposition_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="qsn_content_absposition" value="<?php echo $this->qsn_info['qsn_absposition']?>"  />
	<input type="hidden" id="exam_qsn_type_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_type" value="<?php echo $this->qsn_info['qsn_type']?>"  />
	<input type="hidden" id="exam_qsn_type_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_type_pos" value="<?php echo $this->qsn_info['qsn_type_position']?>"  />
	<input type="hidden" id="exam_qsn_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_pos" value="<?php echo $this->qsn_info['qsn_position']?>"  />
		<input type="hidden" id="exam_qsn_abs_pos_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_abs_pos" value="<?php echo isset($this->qsn_info['qsn_abs_pos'])?$this->qsn_info['qsn_abs_pos']:1?>"  />
		<input type="hidden" id="is_sub_qsn_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="is_sub_qsn" value="1"  />
	<div class="qt_title qt_title_sub">
		<h1><?php echo L::getText('问题', array('file'=>__FILE__, 'line'=>__LINE__))?><?php echo $this->qsn_info['sub_qsn_position']?>：</h1>
		
		<span class="score"><?php echo $this->qsn_info['qsn_point'];?><?php echo L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?>
		<input type="hidden" id="exam_qsn_point_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" name="exam_qsn_point" value="<?php echo $this->qsn_info['qsn_point'];?>" />
		</span>
		<?php if($this->options['is_show_result']){?>
		<span class="score">
		<h4 class="exam_result" name="exam_qsn_result" id="exam_qsn_result_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">
				<!--  // icon_exam_result_01:正确, icon_exam_result_02：错误, icon_exam_result_03：部分正确  -->
		<div class="icon_exam_result icon_exam_result_01" id="exam_qsn_result_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>">&nbsp;</div>
		</h4>
		</span>
		<?php }?>
			
			
		
		<hr>
		<div class="content">
			<!-- // 试题内容 -->
			<div class="qt_title">
			<?php echo htmlspecialchars_decode($this->qsn_info['qsn_content']);?>
			</div>
			<!-- // 答题内容 -->
			<div class="qt_content">
				<dl class="qt_exam_title">
					<dt>
					<input class="radiobox" id="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_yes" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" type="radio" value="yes" />
					 </dt>
					<dd>
						<div class="qt_c">
						<label for="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_yes"><img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_01.png" width="24" height="24" /> </label>
								
						</div>
					</dd>
				</dl>
				<dl class="qt_exam_title">
					<dt>
					<input class="radiobox" id="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_no" name="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" type="radio" value="no" />
					 </dt>
					<dd>
						<div class="qt_c">
						<label for="exam_qsn_answer_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>_no"><img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_02.png" width="24" height="24" /> </label>
						</div>
					</dd>
				</dl>
			</div>
		</div>

		<!-- // 答案与解析 -->
		<?php if($this->options['is_show_info']){?>
		<div class="qt_result" name="qsn_answer_info_div">
			<div class="inner">
				<?php if($this->options['is_show_answer']){?>
				<dl class="answer_st">
					<dt><?php echo L::getText('标准答案', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
					<dd>
							<?php 
								$qsn_answer = isset($this->qsn_info['qsn_answer'])?reset($this->qsn_info['qsn_answer']):array('qsn_answer'=>'');
							if( $qsn_answer['qsn_answer'] == 'yes'){?>
							<img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_01.png" width="24" height="24" /> 
							<?php }else{?>
							<img src="<?php echo ROOT_URL; ?>/images/icon/exam_result_02.png" width="24" height="24" /> 
							<?php }?>
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
				<?php if($this->options['is_show_guide']){?>
				<dl class="answer_analysis">
					<dt><?php echo L::getText('答题解析', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
					<dd><?php echo htmlspecialchars_decode($this->qsn_info['qsn_guide'])?></dd>
				</dl>
				<?php }?>		
				<?php if($this->options['is_show_remark']){?>
				<dl class="answer_comment">
					<dt><?php echo L::getText('评语', array('file'=>__FILE__, 'line'=>__LINE__))?>：</dt>
					<dd id="remark_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>"></dd>
				</dl>
				<?php }?>
			</div>
		</div>
		<?php }?>
	</div>
</div>
<?php }?>