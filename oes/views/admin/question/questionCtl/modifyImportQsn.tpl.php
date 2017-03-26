<?php
$this->printHead(
                array(
                    'title' => array('title'=>'修改导入试题', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin_question_questionCtl_modifyImportQsn.css')
                    ,'js' => array('/admin/manyTrees.js','/admin/tag/tag.js','/admin/question/question.js','/admin/common.js','/admin/question/qsn_import.js','/order_data.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
<script>
//页面加载完毕后初始化试题
$(document).ready(function(){
	qsnInitEditPage();
});
</script>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		<!-- // 顶部 -->
		
		  	<?php include(VIEW_DIR.'/admin/qsn_top.php');?>
		<!-- 是否是通过弹出层方式调用 -->
		<input type="hidden" id="is_alert_qsn" name="is_alert_qsn" value="false" />
		<!-- 查询页面的条件 -->
		<form id="manage_import_qsn_form" name="manage_import_qsn_form" action="?a=manageImportQsn" method="post">
		<input id="_pageTableParams" type="hidden" name="_pageTableParams" value='<?php echo isset($this->search_condition)?urldecode($this->search_condition):''?>' />
		<input id="_pageTableCurPage" type="hidden" name="_pageTableCurPage" value="<?php echo isset($this->cur_page)?$this->cur_page:'1'?>" />
		<input id="_pageTablePageSize" type="hidden" name="_pageTablePageSize" value="<?php echo isset($this->page_size)?$this->page_size:'10'?>" />
		</form>
		<?php
			include VIEW_DIR.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'question'.DIRECTORY_SEPARATOR.'questionCtl'.DIRECTORY_SEPARATOR.'editQsnTpl.tpl.php';
		?>
		
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area_search" style="margin-top:10px;">
		
			<div class="center">
				<a href="javascript:void(0)" onclick="qsnAddOrUpdateImportQsn();" id="qsn_save_btn" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="javascript:void(0)" onclick="$('#manage_import_qsn_form').submit();return false;" class="btn" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		
		</div>
	
	
		<!-- // footer -->
	 	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->

