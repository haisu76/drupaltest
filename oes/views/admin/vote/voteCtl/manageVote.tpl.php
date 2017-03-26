<?php
$this->printHead(
    array(
        'title' => array('title'=>'投票管理', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/main.css')
        ,'js' => array('/admin/common.js','/admin/vote/vote_manage.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	voteInitVoteManage();
	});
</script>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
			<div class="header">
			
			<?php include(VIEW_DIR.'/admin/vote_top.php');?>
		</div>
	<div class="panel_1 con_input" id="vote_search_param_div">
			<div class="title"><span><?php echo L::getText('投票搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('投票名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="vote_title" id="vote_title" />
					</div>
					<div class="search_item">
						<h1><?php echo L::getText('投票类型', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class=" ~auto_width" id="vote_type" name="vote_type">
						<option value="" ><?php echo L::getText('请选择类型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->vote_type as $vtv){
							?>
						<option value="<?php echo $vtv['c_cde']?>"><?php echo L::getText($vtv['desc_cn'], array('file'=>__FILE__, 'line'=>__LINE__)) ?></option>
						<?php }?>
						</select>	
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class=" ~auto_width" id="vote_status" name="vote_status">
						<option value="" ><?php echo L::getText('请选择状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						<?php foreach($this->vote_status as $vsv){
						if($vsv['c_cde']!='040404'){
							?>
						<option value="<?php echo $vsv['c_cde']?>" ><?php echo L::getText($vsv['desc_cn'], array('file'=>__FILE__, 'line'=>__LINE__)) ?></option>
						<?php }
						}?>
						</select>	
					</div>

					<div class="search_item">
						<h1><?php echo L::getText('投票日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input  class="input2 ~auto_width" id="start_tm" name="start_tm" type="text" value="">
						<input  class="input2 ~auto_width" id="end_tm" name="end_tm" type="text" value="">
					</div>
				
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="voteSearchVoteList()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="javascript:void(0)" onclick="voteResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		<form action="?a=updateVote" method="POST" name="update_vote_form" id="update_vote_form">
		<input type="hidden" name="search_condition" id="search_condition" value="" />
		<input type="hidden" name="cur_page" id="cur_page" value="" />
		<input type="hidden" name="page_size" id="page_size" value="" />
		<input type="hidden" name="update_vote_id" id="update_vote_id" value="" />
		</form>
		<div id="vote_list_div">
		<?php 
		echo $this->vote_obj_tb;
		?>
		</div>
		
		 		<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div>
</div>