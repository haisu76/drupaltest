<?php
$this->printHead(
                array(
                    'title' => array('title'=>'修改考试', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
		               			'/admin/exam/exam.css',
								'/admin/editor.css')
                    ,'js' => array('/admin/manyTrees.js','/admin/tag/tag.js','/admin/common.js','/admin/exam/exam_modify.js','/admin/paper/paper.js','/admin/userApi.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
<script>
//页面加载完毕后初始化试题
$(document).ready(function(){
	examInitEditPage();
});
</script>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
			<?php include(VIEW_DIR.'/admin/exam_top.php');?>
		<!-- 查询页面的条件 -->
		<form id="manage_exam_form" name="manage_exam_form" action="?a=index" method="post">
		<input id="_pageTableParams" type="hidden" name="_pageTableParams" value='<?php echo isset($this->search_condition)?urldecode($this->search_condition):''?>' />
		<input id="_pageTableCurPage" type="hidden" name="_pageTableCurPage" value="<?php echo isset($this->cur_page)?$this->cur_page:'1'?>" />
		<input id="_pageTablePageSize" type="hidden" name="_pageTablePageSize" value="<?php echo isset($this->page_size)?$this->page_size:'10'?>" />
		</form>
		<?php
			$exam_exe_str = L::getText('考试', array('file'=>__FILE__, 'line'=>__LINE__));
			include VIEW_DIR.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'exam'.DIRECTORY_SEPARATOR.'examCtl'.DIRECTORY_SEPARATOR.'editExam.tpl.php';
		?>
	
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area_search">
			
			<div class="center">
				<a href="javascript:void(0)" onclick="examAddOrUpdateExam();return false;" id="exam_save_btn" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="javascript:void(0)" onclick="$('#manage_exam_form').submit();return false;" class="btn" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
			
		</div>
	
		<!-- // footer -->
		
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->