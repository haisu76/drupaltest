<?php
$this->printHead(
                array(
                    'title' => array('title'=>'修改投票', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/main.css')
                    ,'js' => array('/admin/common.js','/admin/vote/vote_modify.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
<script>
//页面加载完毕后初始化试题
$(document).ready(function(){
	voteInitEditPage();
});
</script>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
			<div class="header">
			
			<?php include(VIEW_DIR.'/admin/vote_top.php');?>
			
		</div>
	<form id="manage_vote_form" name="manage_vote_form" action="?a=index" method="post">
		<input id="_pageTableParams" type="hidden" name="_pageTableParams" value='<?php echo isset($this->search_condition)?urldecode($this->search_condition):''?>' />
		<input id="_pageTableCurPage" type="hidden" name="_pageTableCurPage" value="<?php echo isset($this->cur_page)?$this->cur_page:'1'?>" />
		<input id="_pageTablePageSize" type="hidden" name="_pageTablePageSize" value="<?php echo isset($this->page_size)?$this->page_size:'10'?>" />
		</form>
<div id="vote_info_div">
<input type="hidden" id='vote_id' value="<?php echo $this->vote_obj['vote_id']?>"/>
<?php echo L::getText('投票标题', array('file'=>__FILE__, 'line'=>__LINE__))?>：
<input class="input3 auto_width"  type="text" id="vote_title" value="<?php echo $this->vote_obj['vote_title']?>" /><br>
<?php echo L::getText('投票内容', array('file'=>__FILE__, 'line'=>__LINE__))?>：
<textarea style="width:98%" id="vote_content" style="height:200px"><?php echo $this->vote_obj['vote_content']?></textarea>
<br>

<?php echo L::getText('投票类型', array('file'=>__FILE__, 'line'=>__LINE__))?>：
<select class="select1 ~auto_width" id="vote_type" name="vote_type">
	<?php foreach($this->vote_type as $vtv){
		?>
	<option value="<?php echo $vtv['c_cde']?>" <?php if($vtv['c_cde'] == $this->vote_obj['vote_type']){?>selected="selected"<?php }?>><?php echo $vtv['desc_cn'] ?></option>
	<?php }?>
	
</select>
<?php echo L::getText('投票状态', array('file'=>__FILE__, 'line'=>__LINE__))?>:<select class="select1 ~auto_width" id="vote_status" name="vote_status">
	<?php foreach($this->vote_status as $vsv){
		if($vsv['c_cde'] != '040404'){?>
	<option value="<?php echo $vsv['c_cde']?>" <?php if($vsv['c_cde'] == $this->vote_obj['vote_status']){?>selected="selected"<?php }?>><?php echo $vsv['desc_cn'] ?></option>
	<?php }
		}?>
	</select>
	<br>
	<?php echo L::getText('投票时间', array('file'=>__FILE__, 'line'=>__LINE__))?>：<input class="input2 ~auto_width" style="width:160px" type="text" value="<?php echo $this->vote_obj['start_tm']?>" id="start_tm" />
			<input class="input2 ~auto_width" style="width:160px" type="text" value="<?php echo $this->vote_obj['end_tm']?>" id="end_tm" /><br>
	<?php echo L::getText('选项数量', array('file'=>__FILE__, 'line'=>__LINE__))?>：
			<select class="select1 ~auto_width" id="selection_num" onchange="voteSelectionNumChange();" name="selection_num">
			<option value="2" <?php if(count($this->vote_obj['vote_selection'])=='2' ){?>selected="selected"<?php }?>>2</option>
			<option value="3" <?php if(count($this->vote_obj['vote_selection'])=='3' ){?>selected="selected"<?php }?>>3</option>
			<option value="4" <?php if(count($this->vote_obj['vote_selection'])=='4' ){?>selected="selected"<?php }?>>4</option>
			<option value="5" <?php if(count($this->vote_obj['vote_selection'])=='5' ){?>selected="selected"<?php }?>>5</option>
			<option value="6" <?php if(count($this->vote_obj['vote_selection'])=='6' ){?>selected="selected"<?php }?>>6</option>
			<option value="7" <?php if(count($this->vote_obj['vote_selection'])=='7' ){?>selected="selected"<?php }?>>7</option>
			<option value="8" <?php if(count($this->vote_obj['vote_selection'])=='8' ){?>selected="selected"<?php }?>>8</option>
			<option value="9" <?php if(count($this->vote_obj['vote_selection'])=='9' ){?>selected="selected"<?php }?>>9</option>
			<option value="10" <?php if(count($this->vote_obj['vote_selection'])=='10' ){?>selected="selected"<?php }?>>10</option>
			<option value="11" <?php if(count($this->vote_obj['vote_selection'])=='11' ){?>selected="selected"<?php }?>>11</option>
			<option value="12" <?php if(count($this->vote_obj['vote_selection'])=='12' ){?>selected="selected"<?php }?>>12</option>
			</select>
<br>
<?php echo L::getText('选项', array('file'=>__FILE__, 'line'=>__LINE__))?>：
		<div id="vote_selection_list" class="single_qsn">
		<ul>
		<li id="selection_mark_li_1" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_1" value="<?php echo isset($this->vote_obj['vote_selection'][0]['selection_mark'])?$this->vote_obj['vote_selection'][0]['selection_mark']:'1'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_1"><?php echo isset($this->vote_obj['vote_selection'][0]['selection_content'])?$this->vote_obj['vote_selection'][0]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_2" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" class="short_word" id="selection_mark_2" value="<?php echo isset($this->vote_obj['vote_selection'][1]['selection_mark'])?$this->vote_obj['vote_selection'][1]['selection_mark']:'2'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_2"><?php echo isset($this->vote_obj['vote_selection'][1]['selection_content'])?$this->vote_obj['vote_selection'][1]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_3" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_3" value="<?php echo isset($this->vote_obj['vote_selection'][2]['selection_mark'])?$this->vote_obj['vote_selection'][2]['selection_mark']:'3'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_3"><?php echo isset($this->vote_obj['vote_selection'][2]['selection_content'])?$this->vote_obj['vote_selection'][2]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_4" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_4" value="<?php echo isset($this->vote_obj['vote_selection'][3]['selection_mark'])?$this->vote_obj['vote_selection'][3]['selection_mark']:'4'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_4"><?php echo isset($this->vote_obj['vote_selection'][3]['selection_content'])?$this->vote_obj['vote_selection'][3]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_5" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_5" value="<?php echo isset($this->vote_obj['vote_selection'][4]['selection_mark'])?$this->vote_obj['vote_selection'][4]['selection_mark']:'5'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_5"><?php echo isset($this->vote_obj['vote_selection'][4]['selection_content'])?$this->vote_obj['vote_selection'][4]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_6" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_6" value="<?php echo isset($this->vote_obj['vote_selection'][5]['selection_mark'])?$this->vote_obj['vote_selection'][5]['selection_mark']:'6'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_6"><?php echo isset($this->vote_obj['vote_selection'][5]['selection_content'])?$this->vote_obj['vote_selection'][5]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_7" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_7" value="<?php echo isset($this->vote_obj['vote_selection'][6]['selection_mark'])?$this->vote_obj['vote_selection'][6]['selection_mark']:'7'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_7"><?php echo isset($this->vote_obj['vote_selection'][6]['selection_content'])?$this->vote_obj['vote_selection'][6]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_8" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_8" value="<?php echo isset($this->vote_obj['vote_selection'][7]['selection_mark'])?$this->vote_obj['vote_selection'][7]['selection_mark']:'8'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_8"><?php echo isset($this->vote_obj['vote_selection'][7]['selection_content'])?$this->vote_obj['vote_selection'][7]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_9" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_9" value="<?php echo isset($this->vote_obj['vote_selection'][8]['selection_mark'])?$this->vote_obj['vote_selection'][8]['selection_mark']:'9'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_9"><?php echo isset($this->vote_obj['vote_selection'][8]['selection_content'])?$this->vote_obj['vote_selection'][8]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_10" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_10" value="<?php echo isset($this->vote_obj['vote_selection'][9]['selection_mark'])?$this->vote_obj['vote_selection'][9]['selection_mark']:'10'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_10"><?php echo isset($this->vote_obj['vote_selection'][9]['selection_content'])?$this->vote_obj['vote_selection'][9]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_11" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_11" value="<?php echo isset($this->vote_obj['vote_selection'][10]['selection_mark'])?$this->vote_obj['vote_selection'][10]['selection_mark']:'11'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_11"><?php echo isset($this->vote_obj['vote_selection'][10]['selection_content'])?$this->vote_obj['vote_selection'][10]['selection_content']:''?></textarea></li>
		<li id="selection_mark_li_12" name="selection_mark_li">
		<?php echo L::getText('选项标识', array('file'=>__FILE__, 'line'=>__LINE__))?>:<input type="text" name="selection_mark" id="selection_mark_12" value="<?php echo isset($this->vote_obj['vote_selection'][11]['selection_mark'])?$this->vote_obj['vote_selection'][11]['selection_mark']:'12'?>" />
		<textarea style="width:98%" name="selection_content" id="selection_content_12"><?php echo isset($this->vote_obj['vote_selection'][11]['selection_content'])?$this->vote_obj['vote_selection'][11]['selection_content']:''?></textarea></li>
		</ul>
		</div>
	
		<br><?php echo L::getText('是否允许匿名', array('file'=>__FILE__, 'line'=>__LINE__))?>：
			<select id="allow_anonymous" name="allow_anonymous">
				<option value="1" <?php if($this->vote_obj['allow_anonymous']=='1' ){?>selected="selected"<?php }?>><?php echo L::getText('允许', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
				<option value="0" <?php if($this->vote_obj['allow_anonymous']=='0' ){?>selected="selected"<?php }?>><?php echo L::getText('不允许', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
			</select>
		
		<br><?php echo L::getText('是否允许评论', array('file'=>__FILE__, 'line'=>__LINE__))?>：
			<select id="allow_review" name="allow_review">
				<option value="1" <?php if($this->vote_obj['allow_review']=='1' ){?>selected="selected"<?php }?>><?php echo L::getText('允许', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
				<option value="0" <?php if($this->vote_obj['allow_review']=='0' ){?>selected="selected"<?php }?>><?php echo L::getText('不允许', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
			</select>
	    <br>
	 </div>
	    <a href="javascript:void(0)" onclick="voteAddOrUpdateVote()"><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
	    <a href="javascript:void(0)" onclick="$('#manage_vote_form').submit();"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>

	 <?php include(VIEW_DIR.'/admin/footer.php');?>
	</div>
	
</div>
