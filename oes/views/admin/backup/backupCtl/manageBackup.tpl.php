<?php
$this->printHead(
    array(
        'title' => array('title'=>'数据恢复', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		 			   '/admin/backup/backup.css')
        ,'js' => array('/admin/common.js','/admin/backup/backup.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>

<div class="box block_15"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/databackup_top.php');?>
		
		<!-- // 搜索过滤 -->
		
		<div id="backup_list_div" class="panel_1">
		<?php 
		echo $this->backup_obj_tb;
		?>
		</div>
		
<script>
$('#page_nav').hide();
</script>
	
		<!-- // footer -->
<?php include(VIEW_DIR.'/admin/footer.php');?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->