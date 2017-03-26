<?php
$this->printHead(
                array(
                    'title' => array('title'=>'统计详细信息', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
				   				 '/admin/statistics/statistics.css')
                    ,'js' => array('/admin/manyTrees.js','/admin/common.js','/admin/statistics/statistics_exam.js'
                   ,'/flot/excanvas.min.js' ,'/flot/jquery.flot.min.js','/flot/jquery.flot.selection.min.js'
                    
                    )    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
<?php $exam_point_list = "";
foreach ($this->exam_scores_obj as $eso){
	$exam_point_list.="{'exam_point': ".$eso['user_exam_scoring']."},";
}
$exam_point_list = rtrim($exam_point_list,',');
?>
<script>
STATISTICS_EXAM_POINT = <?php  echo $this->exam_statistics_obj['exam_point']?>;
STATISTICS_EXAM_PASSING_GRADE = <?php  echo $this->exam_statistics_obj['exam_passing_grade']?>;
STATISTICS_EXAM_POINT_LIST = new Array(<?php echo $exam_point_list;?>);
$(document).ready(function(){
	statisticsExamRankInit();
	<?php if(count($this->exam_paprs)== 1){?>
	statisticsGetQsnTypePosition();
	<?php }?>
});
</script>
<input type="hidden" name="exam_id" id="exam_id" value="<?php echo $this->exam_statistics_obj['exam_id']?>" />
<input type="hidden" name="exam_times" id="exam_times" value="<?php echo $this->exam_statistics_obj['exam_times']?>" />
<div class="statistics_box">

    <div class="statistics_content">
        <div class="statistics_content_title"><?php echo $this->exam_statistics_obj['exam_name']?></div>
        <div class="statistics_content_info"><span><?php echo L::getText('考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?>：<?php echo $this->exam_statistics_obj['exam_category_desc']?></span></div>
        <ul>
            <li><span class="l"><?php echo L::getText('及格人数', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['pass_count']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('不及格人数', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['fail_count']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('及格率', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo round($this->exam_statistics_obj['pass_count']/$this->exam_statistics_obj['join_count']*100,2)?>%</div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('最高分', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['max_score']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('最低分', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['min_score']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('平均分', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['avg_score']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('标准差', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['std_score']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('应参考人数', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['total_join_count']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('实际参考人数', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['join_count']?></div><div class="statistics_num_bg_right l"></div></li>
            <li><span class="l"><?php echo L::getText('未参考人数', array('file'=>__FILE__, 'line'=>__LINE__))?>:</span><div class="statistics_num_bg_left l"></div><div class="statistics_num_bg_mid l"><?php echo $this->exam_statistics_obj['unjoin_count']?></div><div class="statistics_num_bg_right l"></div></li>
        </ul>
        <div>
           <div id="exam_rand_div" name="exam_info_item_div" class="statistics_search_box">
           
				<div class="panel_1 con_input" id="statistics_rank_search_param_div">
						<div class="statistics_search_icon l"></div>
						<?php if($this->conditions['statistics_type'] == 'question'){?>
			            <div class="statistics_search_title l"><?php echo L::getText('试题搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></div>
						<div class="statistics_search_con">
			                <span>						   <a id="qsn_category_desc" name="qsn_category_desc" href="javascript:void(0)" onclick="statisticsQsnCategoryTreeShow('qsn_category_desc','qsn_category')" ><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a></span><input class="input3 ~auto_width" type="hidden" name="qsn_category" id="qsn_category" />
			                <span style="margin-left:5px;"><a id="qsn_source_desc" name="qsn_source_desc" onclick="statisticsQsnSourceTreeShow('qsn_source_desc','qsn_source')"><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></a></span><input class="input3 ~auto_width" type="hidden" name="qsn_source" id="qsn_source" />
			                <span style="margin-left:5px;">
			                <select class="select3 ~auto_width" id="qsn_level" name="qsn_level">
			                <option value=""><?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<?php foreach($this->qsn_level as $qlv){?>
								<option value="<?php echo $qlv['c_cde']?>" ><?php echo $qlv['desc_cn'] ?></option>
								<?php }?>
								</select></span>
			                <span style="margin-left:5px;"><select class="select3 ~auto_width" id="qsn_type" name="qsn_type" >
								<option value=""><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<?php foreach($this->qsn_type as $qtv){?>
								<option value="<?php echo $qtv['c_cde']?>" ><?php echo $qtv['desc_cn'] ?></option>
								<?php }?>
								</select></span>
							<!-- 	<span style="margin-left:5px;">
								<?php echo L::getText('试题标签(用“,” 分割多个标签)', array('file'=>__FILE__, 'line'=>__LINE__))?>
					<input type="text" name="tag_names" id="tag_names" value=""></span> -->

								<a href="javascript:void(0)" onclick="statisticsSearchExamQuestion()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
								<a href="javascript:void(0)" onclick="statisticsResetExamRankParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
								<a href="javascript:void(0)" onclick="statisticsExport('question')" class="btn2" ><?php echo L::getText('导出', array('file'=>__FILE__, 'line'=>__LINE__))?></a>						
			            </div>
			            <?php }?>
						<?php if($this->conditions['statistics_type'] == 'rank'){?>
			            <div class="statistics_search_title l"><?php echo L::getText('排名搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></div>
						<div class="statistics_search_con">
			                <span><?php echo L::getText('用户名', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span><input class="input3 ~auto_width" type="text" name="username" id="username" />
			                <span style="margin-left:5px;"><?php echo L::getText('真实姓名', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span><input class="input3 ~auto_width" type="text" name="real_name" id="real_name" />
			                <span style="margin-left:5px;"><?php echo L::getText('用户组', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span>
<!--add 2012 11 21 <span> ↓-->
                            <span><a href="javascript:void(0)" onclick="statisticGroupTreeShow('group_name','group_id',false)" id="group_name" name="group_name"><?php echo L::getText('请选择用户组', array('file'=>__FILE__, 'line'=>__LINE__))?></a></span>
 <!--add 2012 11 21 </span> ↑-->
 <input type="hidden" id="group_id" name="group_id" value="" />
								<a href="javascript:void(0)" onclick="statisticsSearchExamRank()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
									<a href="javascript:void(0)" onclick="statisticsResetExamRankParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>						
			           			<a href="javascript:void(0)" onclick="statisticsExport('rank')" class="btn2" ><?php echo L::getText('导出', array('file'=>__FILE__, 'line'=>__LINE__))?></a>	
			            </div>
			            <?php }?>
			            <?php if($this->conditions['statistics_type'] == 'group'){?>
			            <div class="statistics_search_title l"><?php echo L::getText('组搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></div>
						<div class="statistics_search_con">
<!--add 2012 11 21 <span> ↓-->
                            <span><a href="javascript:void(0)" onclick="statisticGroupTreeShow('group_name','group_id',false)" id="group_name" name="group_name"><?php echo L::getText('请选择用户组', array('file'=>__FILE__, 'line'=>__LINE__))?></a></span>
 <!--add 2012 11 21 </span> ↑-->
 <input type="hidden" id="group_id" name="group_id" value="" />
								<a href="javascript:void(0)" onclick="statisticsSearchExamGroup()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
									<a href="javascript:void(0)" onclick="statisticsResetExamRankParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>						
			           			<a href="javascript:void(0)" onclick="statisticsExport('group')" class="btn2" ><?php echo L::getText('导出', array('file'=>__FILE__, 'line'=>__LINE__))?></a>	
			        
			            </div>
			            <?php }?>
			            <?php if($this->conditions['statistics_type'] == 'user'){?>
			            <div class="statistics_search_title l"><?php echo L::getText('组搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></div>
						<div class="statistics_search_con">
<!--add 2012 11 21 <span> ↓-->
                            <span><a href="javascript:void(0)" onclick="statisticGroupTreeShow('group_name','group_id',false)" id="group_name" name="group_name"><?php echo L::getText('请选择用户组', array('file'=>__FILE__, 'line'=>__LINE__))?></a></span>
 <!--add 2012 11 21 </span> ↑-->
  <span>						   <a id="qsn_category_desc" name="qsn_category_desc" href="javascript:void(0)" onclick="statisticsQsnCategoryTreeShow('qsn_category_desc','qsn_category')" ><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a></span><input class="input3 ~auto_width" type="hidden" name="qsn_category" id="qsn_category" />
			                <span style="margin-left:5px;"><a id="qsn_source_desc" name="qsn_source_desc" onclick="statisticsQsnSourceTreeShow('qsn_source_desc','qsn_source')"><?php echo L::getText('试题来源', array('file'=>__FILE__, 'line'=>__LINE__))?></a></span><input class="input3 ~auto_width" type="hidden" name="qsn_source" id="qsn_source" />
			                <span style="margin-left:5px;"><select class="select3 ~auto_width" id="qsn_level" name="qsn_level">
			                <option value=""><?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<?php foreach($this->qsn_level as $qlv){?>
								<option value="<?php echo $qlv['c_cde']?>" ><?php echo $qlv['desc_cn'] ?></option>
								<?php }?>
								</select></span>
			                <span style="margin-left:5px;"><select class="select3 ~auto_width" id="qsn_type" name="qsn_type" >
								<option value=""><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<?php foreach($this->qsn_type as $qtv){?>
								<option value="<?php echo $qtv['c_cde']?>" ><?php echo $qtv['desc_cn'] ?></option>
								<?php }?>
								</select></span>
 <input type="hidden" id="group_id" name="group_id" value="" />
								<a href="javascript:void(0)" onclick="statisticsSearchExamUser()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
									<a href="javascript:void(0)" onclick="statisticsResetExamRankParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>						
			            	<a href="javascript:void(0)" onclick="statisticsExport('user')" class="btn2" ><?php echo L::getText('导出', array('file'=>__FILE__, 'line'=>__LINE__))?></a>	
			        
			            </div>
			            <?php }?>
					</div>
					<form target="_blank" method="post" id="statistics_export_form" name="statistics_export_form" action="?a=exportStatistics">
						<input type="hidden" id="export_params" name="export_params" value="">
						<input type="hidden" id="export_type" name="export_type" value="">
					</form>
			
			<?php 
				echo $this->exam_obj_tb;
			?>
			</div>
			<div id="exam_other_div" name="exam_info_item_div" style="display: none;"  class="statistics_search_box">
			
				<div class="statistics_search_con">
			            <span><?php echo L::getText('用户数', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span><input type="text" value="10" id="exam_score_area" name="exam_score_area" />
			            <a href="javascript:void(0)" onclick="statisticsShowScoreAreaFlot()" class="btn2" ><?php echo L::getText('统计', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				</div>
				
				<div id="exam_score_area_flot_div" style="width: 98%; margin-top: 40px;" >
				</div>
			</div>
			<div id="exam_analysis_div" name="exam_info_item_div" style=" display: none;"  class="statistics_search_box">
			 <div class="statistics_search_title l"><?php echo L::getText('试卷分析', array('file'=>__FILE__, 'line'=>__LINE__))?></div><br><?php 
			//超过一张试卷让用户选择试卷
			if(count($this->exam_paprs)>1){?>
			<select id="papr_id" onchange="statisticsGetQsnTypePosition()">
			<option value=""><?php echo L::getText('请选择试卷', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
			<?php foreach($this->exam_paprs as $ep){?>
			<option value="<?php echo $ep['papr_id']?>"><?php echo $ep['papr_name']?></option>
			<?php }?>
			</select>
			<?php }
			//只有一张试卷的话，就分析这一张就好了
			elseif(count($this->exam_paprs)== 1){
			?>
			<?php echo $this->exam_paprs[0]['papr_name']?>
			<input type="hidden" value="<?php echo $this->exam_paprs[0]['papr_id']?>" name="papr_id" id="papr_id">
			<?php }else{
			?>
				<?php echo L::getText('没有可以分析的试卷', array('file'=>__FILE__, 'line'=>__LINE__))?>
			<?php }?>
			<?php if(count($this->exam_paprs)>= 1){?>
				<div id="exam_papr_info">
					<?php echo L::getText('大题标题', array('file'=>__FILE__, 'line'=>__LINE__))?><select class="select3 ~auto_width" id="qsn_type_position" name="qsn_type_position">
							<option value=""><?php echo L::getText('请选择大题标题', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
							
							</select>
					<?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?><select class="select3 ~auto_width" id="qsn_level" name="qsn_level">
								<option value=""><?php echo L::getText('请选择试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
											<?php foreach($this->qsn_level as $qlv){?>
											<option value="<?php echo $qlv['c_cde']?>" <?php if($qlv['c_cde'] == $this->qsn_obj['qsn_level']){?>selected="selected"<?php }?>><?php echo $qlv['desc_cn'] ?></option>
											<?php }?>
											</select>
					<a href="javascript:void(0)" onclick="statisticsSearchExamQsnAnalysis()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				</div>
				<div id="exam_qsn_analysis_div">
				<?php 
					echo $this->qsn_analysis_obj_tb;
				?>
				</div>
				<div id="exam_qsn_analysis_flot_div" style="width: 98%;" >
				</div>
				<?php }?>
			</div>
        </div>
        
    </div>
    
</div>







