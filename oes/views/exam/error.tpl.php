<?php
$this->printHead(
    array(
        'title' => array('title'=>L::getText('ERROR', array('file'=>__FILE__, 'line'=>__LINE__)), 'file'=>__FILE__, 'line'=>__LINE__)
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
			<?php echo $this->error_info;?>
            </p>
		</div>
	</div></div>