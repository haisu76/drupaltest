<?php
$this->printHead(
    array(
        'title' => array('title'=>L::getText('考试', array('file'=>__FILE__, 'line'=>__LINE__)), 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/paper/main.css','/paper/layout.css')
        ,'js' => array('/admin/common.js','/exam/exam_papr.js','/switch_div.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<style>
#tmp_message{ width:870px;	margin:0 auto;	height:100%;}
.tmp_info{margin:120px auto;border:1px solid #BABABA;width:320px;padding:40px;height:80px;}
.tmp_info p{text-align:center;}
</style>
<div id="exam_perload_div"><div id="tmp_message">
		<div class="tmp_info">
		    <p>
			<?php echo L::getText('正在加载中，请稍后', array('file'=>__FILE__, 'line'=>__LINE__))?>...
            </p>
		</div>
	</div></div>
<script>
<?php //是否提示关闭窗口
if($this->options['is_confirm_close_window']){?>
window.onbeforeunload = function()
{
    return "";
}
<?php }?>
EXAM_START_TIME = 0;
EXAM_LAST_TIME = <?php echo isset($this->papr_info['exam_last_time'])?$this->papr_info['exam_last_time']:0?>;
//已经考试时间
EXAM_EXAMED_TIME = <?php echo isset($this->papr_info['examed_time'])?$this->papr_info['examed_time']:0?>;
EXAM_DISABLE_SUBMIT = <?php echo isset($this->papr_info['exam_disable_submit'])?$this->papr_info['exam_disable_submit']:0?>;

<?php //是否启用倒计时
if($this->options['is_counting_down']){?>
EXAM_TIME_CONSISTENCY_FLG = <?php echo isset($this->papr_info['exam_time_consistency_flg'])?$this->papr_info['exam_time_consistency_flg']:1?>;
//考试剩余时间

<?php }?>
$(document).ready(function(){
	window.L.openCom('oDialogDiv');
	var d=new Date();
	EXAM_START_TIME = Math.round(d.getTime()/1000)-EXAM_EXAMED_TIME;
	<?php //是否启用倒计时
			if($this->options['is_counting_down']){?>
	
	
	//EXAM_LAST_TIME = EXAM_LAST_TIME-EXAM_EXAMED_TIME;
	//开始倒计时
	examStartCountingDown();
	<?php }?>
	<?php if($this->options['is_show_exam_notice']){?>
	//开始考试须知倒计时
	examNoticeCountingDown();
	<?php }?>
	<?php //还原用户答案
	if(isset($this->papr_info['user_exam_answer']) &&!empty($this->papr_info['user_exam_answer'])){?>
	examDisplayUserAnswer(<?php echo json_encode($this->papr_info['user_exam_answer']);?>);
		<?php //跳转到已经答到的题目
		if(isset($this->papr_info['user_exam_answer'][0]['answered_qsn_count']) &&$this->papr_info['user_exam_answer'][0]['answered_qsn_count'] !=null &&($this->papr_info['exam_qsn_random_flg'] == '0')){?>
		examDisplsyQsn(<?php echo ($this->papr_info['user_exam_answer'][0]['answered_qsn_count'] );?>);
		<?php }else {?>
		examDisplsyQsn(0);//加载页面后显示第一道题
		<?php }?>
	<?php }else{?>
	examDisplsyQsn(0);//加载页面后显示第一道题
	<?php }?>
	<?php //答题限时
	if($this->papr_info['exam_ie_only_flg'] == '1'){?>
	examInitQsnLimit();
	<?php }?>
	
	<?php //是否显示滚动条
	if($this->options['is_show_toolbar']){?>
	//初始化滚动条
	examInitToolBar();
	<?php }?>
	
	<?php //还原答案状态
		if(isset($this->papr_info['user_exam_info']) &&!empty($this->papr_info['user_exam_info'])){?>
		examDisplayUserExamInfo(<?php echo json_encode($this->papr_info['user_exam_info']);?>);
		
	<?php }?>
	<?php //以下功能管理员不启用
		if(!$this->options['is_admin']){?>
	<?php //启用全屏
	if($this->papr_info['exam_full_screen_flg'] == '1' && (!getLicenceInfo('Disable','exam_full_screen'))){
	?>
	examSetFullScreen(true);
	$('#foot a').attr('href','#');
	<?php }else{?>
	
	<?php }?>
	<?php //启用考试监控
	if($this->papr_info['exam_disable_monitor_flg'] == '0' && (!getLicenceInfo('Disable','monitor_exam'))){
	?>
	examGetExamCmd();
	<?php }?>
	<?php //练习模式隐藏考试答案
	if($this->papr_info['exam_type'] == '1'){?>
	examHideResultInfo();
	<?php }?>
	<?php //启用断电保护
	if($this->papr_info['exam_recovery_flg'] && (!getLicenceInfo('Disable','exam_recovery'))){?>
	examRecovery();
	<?php }?>
	<?php //禁用鼠标右键
	if($this->papr_info['exam_mouse_right_flg']){?>
	$(document).bind("contextmenu",function(e){
         return false;
   });
	<?php }?>
	<?php //禁用选中
	if(isset($this->papr_info['exam_disable_paste_flg'])&&$this->papr_info['exam_disable_paste_flg']){?>
	$(document).bind("selectstart",function(){return false;}); 
	$(document).bind("copy",function(){return false;}); 
	$(document).bind("paste",function(){return false;}); 
	<?php }?>
	<?php }?>
});
</script>
<?php //以下功能管理员不启用
if(!$this->options['is_admin']){?>
	<style>
	<?php //禁用选中firefox
	if(isset($this->papr_info['exam_disable_paste_flg'])&&$this->papr_info['exam_disable_paste_flg']){?>
	*{ 
	-moz-user-select:none 
	} 
	 <?php }?>
	</style>
<?php }?>
<object id="ie" width=1 height=1 classid="clsid:68acce8b-f896-4091-bdc5-a93115a051dc">
    <param name="_version" value="65536">
    <param name="_extentx" value="164">
    <param name="_extenty" value="164">
    <param name="_stockprops" value="0">
</object>
<input type="hidden" id="exam_mode" value="030102" />
<input type="hidden" id="exam_times" value="<?php  echo $this->papr_info['user_exam_times']?>" />
<input type="hidden" id="user_id" value="<?php echo $this->papr_info['user_id']?>" />
<input type="hidden" id="papr_id" value="<?php  echo $this->papr_info['papr_id']?>" />
<input type="hidden" id="exam_id" value="<?php  echo $this->papr_info['exam_id']?>" />
<input type="hidden" id="exam_type" value="<?php echo $this->papr_info['exam_type']?>" />
<input type="hidden" id="exam_ie_only_flg" value="<?php echo $this->papr_info['exam_ie_only_flg']?>" />
<input type="hidden" id="exam_blank_flg" value="<?php echo $this->papr_info['exam_blank_flg']?>" />
<input type="hidden" id="exam_cloze_flg" value="<?php echo $this->papr_info['exam_cloze_flg']?>" />
<input type="hidden" id="exam_submit_display_result" value="<?php echo $this->papr_info['exam_submit_display_result']?>" />

<div id="container" class="box block_12">
	<div class="box_inner">
		<div class="paper_header">
			<div class="col_left avatar avatar_male_default"></div>
			<div class="col_right">
				<h1><?php  echo $this->papr_info['papr_name']?></h1>
				<div class="left">
					<ul>
						<li><?php echo L::getText('考试时间', array('file'=>__FILE__, 'line'=>__LINE__))?>：<?php echo $this->papr_info['exam_begin_tm']?> ~ <?php echo $this->papr_info['exam_end_tm']?></li>
						<li><?php echo L::getText('当前用户', array('file'=>__FILE__, 'line'=>__LINE__))?>：<?php echo $this->papr_info['user_name']?></li>
						<li><?php echo L::getText('所属组', array('file'=>__FILE__, 'line'=>__LINE__))?>：<?php echo $this->papr_info['user_group_name']?></li>
					</ul>
				</div>
		
				<div class="right">
					<ul>
						<li><?php echo L::getText('答卷时间', array('file'=>__FILE__, 'line'=>__LINE__))?>：<?php echo $this->papr_info['exam_total_tm'] == 0?L::getText('不限', array('file'=>__FILE__, 'line'=>__LINE__)):$this->papr_info['exam_total_tm'].L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?> </li>
						<li><?php echo L::getText('试题总数', array('file'=>__FILE__, 'line'=>__LINE__))?>：<?php echo $this->papr_info['papr_qsn_count']?></li>
						<li><?php echo L::getText('试题总分', array('file'=>__FILE__, 'line'=>__LINE__))?>：<?php echo $this->papr_info['papr_point']?><?php echo L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__))?></li>
					</ul>
				</div>
			</div>
		</div>	
		
		<div class="clear"></div>
		<?php if($this->options['is_show_exam_notice']){?>
		<!-- 考场须知start -->
		<div class="paper_notice" id="exam_notice_div">
			<h1 class="title_level_1"><a href="javascript:void(0)" onclick="examToggleExamNotice();return false;"><?php echo L::getText('考试须知', array('file'=>__FILE__, 'line'=>__LINE__))?></a></h1>
			<div class="contnet" id="exam_content_notice_div">
				<div class="inner">
					<?php echo $this->papr_info['exam_notice']?>
					<div class="clear"></div>
					
					<!-- // Button -->
					<div class="button_area button_center ~button_left ~button_right">
						<div class="inner_box">
							<a href="javascript:void(0)" onclick="examToggleExamNotice();return false;" class="btn btn_disable" ><span class="timeout_txt"  id="exam_notice_cd_span">(60)</span><?php echo L::getText('确认已读', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 考场须知end -->
		<?php }?>
		<?php if($this->options['is_show_toolbar']){?>
		<!-- 工具条start -->
		<div class="paper_filter" style="height:40px; width:1000px; z-index: 10;" id="exam_toolbar">
			<div class="inner">
				<div class="paper_filter_timeout timeout_01 ~timeout_02 ~timeout_03"><?php echo L::getText('剩余时间', array('file'=>__FILE__, 'line'=>__LINE__))?>：<label id="exam_last_time_label">00:00:00</label></div>
				<?php if($this->options['is_show_qsn_index']){?>
				<div class="questions_index">
					<a href="javascript:void(0)" onclick="examDisplayDiv('exam_index_div');return false;"  class="btn btn_autowidth"><?php echo L::getText('试题索引', array('file'=>__FILE__, 'line'=>__LINE__))?><span class="small_icon icon_view_list"></span></a>
					<div class="popup content" name="exam_ims_div" id="exam_index_div">
						<div class="inner">
							<h1><?php echo L::getText('共', array('file'=>__FILE__, 'line'=>__LINE__))?><?php echo $this->papr_info['papr_qsn_count']?><?php echo L::getText('题', array('file'=>__FILE__, 'line'=>__LINE__))?>，<?php echo L::getText('已答数目', array('file'=>__FILE__, 'line'=>__LINE__))?>：<label id="exam_answered_qsn_count_label">0</label>，<?php echo L::getText('未答数目', array('file'=>__FILE__, 'line'=>__LINE__))?>：<label id="exam_unanswered_qsn_count_label">0</label></h1>
							<div class="" id="exam_answered_qsn_div">
								<span><?php echo L::getText('已答', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span>
							</div>
							<div class="" id="exam_unanswered_qsn_div">
								<span><?php echo L::getText('未答', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				<?php if($this->options['allow_mark']){?>
				<div class="questions_label">
					<a href="javascript:void(0)" onclick="examDisplayDiv('exam_mark_div');return false;" class="btn btn_autowidth"><?php echo L::getText('标记的试题', array('file'=>__FILE__, 'line'=>__LINE__))?><span class="small_icon icon_view_list"></span></a>
					<div class="popup content" name="exam_ims_div" id="exam_mark_div">
						<div class="inner">
							<h1><?php echo L::getText('共', array('file'=>__FILE__, 'line'=>__LINE__))?><?php echo $this->papr_info['papr_qsn_count']?><?php echo L::getText('题', array('file'=>__FILE__, 'line'=>__LINE__))?>，<?php echo L::getText('已标记试题数', array('file'=>__FILE__, 'line'=>__LINE__))?>：<label id="exam_mark_qsn_count_label">0</label></h1>
							<div class="" id="exam_mark_qsn_div">
								<span><?php echo L::getText('标记试题', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				<?php if($this->options['is_show_toolbar_statistics']){?>
				
					<div class="answer_result">
					<a  href="javascript:void(0)" onclick="examDisplayDiv('exam_statistics_div');return false;" class="btn btn_autowidth"><?php echo L::getText('答题结果', array('file'=>__FILE__, 'line'=>__LINE__))?><span class="small_icon icon_view_list"></span></a>
					<div class="popup content" name="exam_ims_div" id="exam_statistics_div">
						<div class="inner">
							<h1><?php echo L::getText('共', array('file'=>__FILE__, 'line'=>__LINE__))?><?php echo $this->papr_info['papr_qsn_count']?><?php echo L::getText('题', array('file'=>__FILE__, 'line'=>__LINE__))?>，<?php echo L::getText('正确', array('file'=>__FILE__, 'line'=>__LINE__))?>：<label id="exam_correct_qsn_count_label">0</label>，<?php echo L::getText('错误', array('file'=>__FILE__, 'line'=>__LINE__))?>：<label id="exam_error_qsn_count_label">0</label>，<?php echo L::getText('半对', array('file'=>__FILE__, 'line'=>__LINE__))?>：<label id="exam_half_correct_qsn_count_label">0</label></h1>
							<hr>
							<div class=""  id="exam_correct_qsn_div">
								<span><?php echo L::getText('正确', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span>
							</div>
							
							<div class="" id="exam_error_qsn_div">
								<span><?php echo L::getText('错误', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span>
							</div>
							<div class="" id="exam_half_correct_qsn_div">
								<span><?php echo L::getText('部分正确', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span>
							</div>
						</div>
					</div>
				</div>
				
				<?php }?>
				<?php if($this->options['is_show_submit_btn']){?>
				<a  href="javascript:void(0)" onclick="examSubmitPapr();return false;" id="exam_submit_btn" class="btn2 ~btn_autowidth float_right"><?php echo L::getText('交卷', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<?php }?>
			</div>
		</div>
		<!-- 工具条end -->		
		<?php }?>
		<?php //试题显示类
		$qsn_display = new qsnDisplay_qsnDisplayCtl();?>
		<div class="paper_content" style="overflow:hidden;" >
		<?php foreach($this->papr_info['papr_qsn_type'] as $papr_qsn_type){?>
			<!-- <div class="paper_list">
				<h1 class="title_level_1"><b><?php echo $papr_qsn_type['qsn_type_position']?>、<?php echo $papr_qsn_type['qsn_type_desc']?></b></h1>
				<div class="paper_info">
					<p>每题<?php echo $papr_qsn_type['qsn_point'] ?>分，共<?php echo $papr_qsn_type['qsn_point']*$papr_qsn_type['qsn_count']?>分</p>
					<p><?php echo $papr_qsn_type['qsn_type_title']?></p>
				</div>
				 -->
		<?php }?>
			<div id="paper_content_div" name="paper_content_div" style="width: 1001px">
			<?php 
			$qsn_absposition = 0 ;//试题相对于试卷的绝对位置
			foreach($this->papr_info['papr_qsn_type'] as $papr_qsn_type){
				$qsn_abs_pos = 1;
				switch ($this->options['exam_point_type'])
				{
					case '030203'://考试分数折算
						$papr_qsn_type['qsn_point'] = round($this->papr_info['exam_point']/count($this->papr_info['papr_qsn_type'])/$papr_qsn_type['qsn_count'], 2);
						break;
					case '030202'://按题算分
						break;
					default :
						break;
				}
				if(isset($this->papr_info['exam_qsn_random_flg'])&&$this->papr_info['exam_qsn_random_flg'] == '1'){//打乱试题顺序
				$random_qsn_position = 1;//随机绝对位置
					while(true)
					{
						if(empty($papr_qsn_type['papr_qsn_content'] ))
						{
							break;
						}
						$qsn_content_key = array_rand($papr_qsn_type['papr_qsn_content'] ,1);
    					$qsn_content = $papr_qsn_type['papr_qsn_content'][$qsn_content_key];
    					unset($papr_qsn_type['papr_qsn_content'][$qsn_content_key]);
						$qsn_content['qsn_absposition'] = $qsn_absposition;
						$qsn_content['qsn_abs_pos'] = $qsn_abs_pos;
						$qsn_content['random_qsn_position'] = $random_qsn_position;
						$qsn_abs_pos++;
						$random_qsn_position++;
						$qsn_absposition++;
						switch ($this->options['exam_point_type'])
						{
							case '030202'://按题算分
								
								break;
							default :
								$qsn_content['qsn_point'] = $papr_qsn_type['qsn_point'];
								break;
						}
						$qsn_display->displaySingleQuestion($qsn_content,$this->options['qsn_options']); 	
					}
					
				}else{
					foreach ($papr_qsn_type['papr_qsn_content'] as $qsn_content){
						$qsn_content['qsn_absposition'] = $qsn_absposition;
						$qsn_content['qsn_abs_pos'] = $qsn_abs_pos;
						$qsn_abs_pos++;
						$qsn_absposition++;
						switch ($this->options['exam_point_type'])
						{
							case '030202'://按题算分
								
								break;
							default :
								$qsn_content['qsn_point'] = $papr_qsn_type['qsn_point'];
								break;
						}
						$qsn_display->displaySingleQuestion($qsn_content,$this->options['qsn_options']); 	
					}
				}
			}?>
			</div>
		</div>
		<!-- // 按钮 -->
		<div class="btn_area align_center">
			<div class="inner">
				<span class="btn_left_con"><?php echo L::getText('第', array('file'=>__FILE__, 'line'=>__LINE__))?><label id="exam_current_qsn_num">1</label> <?php echo L::getText('题', array('file'=>__FILE__, 'line'=>__LINE__))?>，<?php echo L::getText('共', array('file'=>__FILE__, 'line'=>__LINE__))?> <?php echo $this->papr_info['papr_qsn_count']?> <?php echo L::getText('题', array('file'=>__FILE__, 'line'=>__LINE__))?></span>
				<a class="btn" href="javascript:void(0)" onclick="examDisplsyQsn('prev'); return false;" <?php if($this->papr_info['exam_ie_only_flg'] == '1'){?>style="display: none;"<?php }?>><?php echo L::getText('上一题', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a class="btn" href="javascript:void(0)" onclick="examDisplsyQsn('next');<?php	if($this->papr_info['exam_ie_only_flg'] == '1'){?>examInitQsnLimit(false);<?php }?> return false;"><?php echo L::getText('下一题', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>
	</div><!-- // box_inner -->
	
	<div class="clear"></div>
	 <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
<script>
$(document).ready(function(){
	$('#exam_perload_div').hide();
});
</script>
<script language="javascript"> 
/*
* 描述:限制oEditor的ofPlayer播放次数
* 使用:放在所有DOM节点之下,或放在$(document).ready(function(){这里})
*/
(function()
{
    var thisFun=arguments.callee;
    if(thisFun.ofPlayer==null)
    {
        var objectList=document.getElementsByTagName('object');
        thisFun.ofPlayer=[];
        //初始化,识别出所有需要播放限制和进度条禁用的ofPlayer对象
        for(var i=0,l=objectList.length;i<l;i++)
        {
            if(objectList[i].id.substr(0,9)=='player_id'&&objectList[i].getAttribute('playcount')!==null)
            {
                objectList[i].playcount=parseInt(objectList[i].getAttribute('playcount'));
                thisFun.ofPlayer[thisFun.ofPlayer.length]=objectList[i];
            }
        }
    }
    if(thisFun.ofPlayer.length)
    {
        if(typeof(JS_OFplayer)=='function')
        {
            for(var i=0,l=thisFun.ofPlayer.length;i<l;i++)
            {
                //播放次数限制
                if(!isNaN(thisFun.ofPlayer[i].playcount))
                {
                    try
                    {
                        var playTimeProgress = JS_OFplayer(thisFun.ofPlayer[i].id, 'getinfo', 'playback','PlayTimeProgress');
                        var state=JS_OFplayer(thisFun.ofPlayer[i].id, 'getinfo', 'playback','State');
                        if(playTimeProgress<2)
                        {
                            if(thisFun.ofPlayer[i].playcount==0&&(state=='Ready'||state=='Playing'||state=='Stop'))
                            {
                                //锁定相关按钮
                                JS_OFplayer(thisFun.ofPlayer[i].id, 'stop');
                                if(typeof(JS_OFplayer(thisFun.ofPlayer[i].id, 'getatt','play','y'))=='number')
                                {
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'play','hidden','false');
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'play','disable','true');
                                }
                                if(typeof(JS_OFplayer(thisFun.ofPlayer[i].id, 'getatt','fullscreen','y'))=='number')
                                {
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'fullscreen','hidden','false');
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'fullscreen','disable','true');
                                }
                                if(typeof(JS_OFplayer(thisFun.ofPlayer[i].id, 'getatt','progress','y'))=='number')
                                {
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'progress','prop','');
                                }
                                if(typeof(JS_OFplayer(thisFun.ofPlayer[i].id, 'getatt','volslide','y'))=='number')
                                {
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'volslide','prop','');
                                }
                                if(typeof(JS_OFplayer(thisFun.ofPlayer[i].id, 'getatt','unmute','y'))=='number')
                                {
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'unmute','hidden','true');
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'unmute','disable','true');
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'mute','hidden','false');
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'mute','disable','true');
                                }
                                if(typeof(JS_OFplayer(thisFun.ofPlayer[i].id, 'getatt','video','y'))=='number')
                                {
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'setsize', 'video',0,0);
                                }
                                if(typeof(JS_OFplayer(thisFun.ofPlayer[i].id, 'getatt','bigPlay','y'))=='number')
                                {
                                    JS_OFplayer(thisFun.ofPlayer[i].id, 'adjust', 'bigPlay','disable','true');
                                }
                                //并移除该对像
                                if(!JS_OFplayer(thisFun.ofPlayer[i].id,'getinfo','playerinfo','isFullScreen'))
                                {
                                    thisFun.ofPlayer.splice(i,1);
                                }
                            }
                            else
                            {
                                thisFun.ofPlayer[i].PlayCountTime=true;
                            }
                        }
                        else if(playTimeProgress>98&&thisFun.ofPlayer[i].PlayCountTime)
                        {
                            thisFun.ofPlayer[i].PlayCountTime=false;
                            thisFun.ofPlayer[i].playcount--;
                        }
                    }
                    catch(e){};
                }
            }
        }
        if(thisFun.ofPlayer.length)
        {
            setTimeout(thisFun,300);
        }
    }
})()
</script>