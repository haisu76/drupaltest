<?php
$this->printHead(
    array(
        'title' => array('title'=>'测试输出的标题', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/paper/main.css','/paper/layout.css')
        ,'js' => array('/admin/common.js','/exam/exam_papr.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	examDisplayUserAnswer(<?php echo json_encode($this->user_answer);?>);
	//examDisplayUserExamInfo(<?php echo json_encode($this->user_answer);?>);
});

</script>
<?php
$qsn_display = new qsnDisplay_qsnDisplayCtl();
$options = array('is_show_guide'=>true,'is_show_answer'=>true);
$qsn_display->displaySingleQuestion($this->qsn_info,$options);
?>
<div class="button_area_search">
	<div class="center">
		<a href="javascript:void(0)" onclick="window.parent.alertCloseAlertDiv()" class="btn" >关闭</a>
	</div>
</div>