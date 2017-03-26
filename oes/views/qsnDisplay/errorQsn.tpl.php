<div id="qsn_content_div_<?php echo $this->qsn_info['qsn_id'].$this->qsn_info['qsn_sub_id']?>" qsn_sub_id="<?php echo $this->qsn_info['qsn_sub_id']?>"  qsn_id="<?php echo $this->qsn_info['qsn_id']?>" name="qsn_content_div"  class="qt" style="<?php if(!$this->options['is_display']){?>display: none;<?php }?>">
	<div class="qt_main">
		<div class="inner">
			<div class="col_left">
				<?php if($this->options['is_show_qsn_position']){?>
				<h1 class="num"><?php echo isset($this->qsn_info['random_qsn_position'])?$this->qsn_info['random_qsn_position']:$this->qsn_info['qsn_position']?></h1>
				<?php }?>
				
				<h3 class="score"><?php echo $this->qsn_info['qsn_point'];?><?php echo L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?>
				</h3>
			
			</div>
			<div class="col_right_01">
				<!-- // 试题内容 -->
				<div class="content">
					<div class="qt_title">
					 	<?php echo $qsn_error_info?>
					</div>
				</div>
			</div>
		</div><!-- // inner end -->
	</div>
	
</div>